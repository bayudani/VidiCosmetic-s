<div>
    <h2>Verifikasi Email Anda</h2>
    <p>Kami telah mengirimkan kode OTP ke email {{ $email }}.</p>

    <form wire:submit.prevent="verify">
        <input type="text" wire:model="otp" placeholder="Masukkan 6 digit OTP">
        @error('otp') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Verifikasi</button>
    </form>
</div>