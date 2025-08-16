<div>
    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
        Bukti Transfer
    </h3>
    {{-- $getRecord() akan mengambil data order saat ini --}}
    @if ($path = $getRecord()->proof_of_transaction)
        <a href="{{ Storage::url($path) }}" target="_blank" class="block">
            <img src="{{ Storage::url($path) }}" 
                 alt="Bukti Transfer" 
                 style="max-height: 400px; width: auto; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);">
        </a>
    @else
        <div class="flex items-center justify-center h-48 bg-gray-100 rounded-md">
            <p class="text-gray-500">Tidak ada bukti transfer yang diunggah.</p>
        </div>
    @endif
</div>