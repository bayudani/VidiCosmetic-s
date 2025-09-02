<?php

namespace App\Notifications;

use App\Models\Consultation; // <-- Import model Consultation
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Filament\Notifications\Notification as FilamentNotification;
use Filament\Notifications\Actions\Action;

class NewConsultationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private int $consultationId;

    public function __construct(int $consultationId)
    {
        $this->consultationId = $consultationId;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $consultation = Consultation::find($this->consultationId);
        $customer = User::find($consultation->user_id);

        if (!$consultation || !$customer) {
            return [];
        }

        return FilamentNotification::make()
            ->title('Jadwal Konsultasi Baru!')
            ->body("{$customer->name} telah mem-booking jadwal konsultasi baru.")
            ->icon('heroicon-o-calendar-days') // Ikon yang lebih relevan
            ->iconColor('warning')
            ->actions([
                Action::make('view')
                    ->label('Lihat Jadwal')
                    ->url(route('filament.admin.resources.consultations.edit', ['record' => $consultation->id]))
                    ->markAsRead(),
            ])
            ->getDatabaseMessage();
    }
}