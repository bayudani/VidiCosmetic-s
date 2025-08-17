<div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-12">
    <div class="relative bg-white px-6 pt-10 pb-9 shadow-xl mx-auto w-full max-w-lg rounded-2xl">
        <div class="mx-auto flex w-full max-w-md flex-col space-y-16">
            <div class="flex flex-col items-center justify-center text-center space-y-2">
                <div class="font-serif text-3xl font-bold">
                    <p>Verifikasi Email</p>
                </div>
                <div class="flex flex-row text-sm font-medium text-gray-400">
                    <p>Kami telah mengirimkan 6 digit kode ke email Anda: {{ $email }}</p>
                </div>
            </div>

            <div>
                <form wire:submit="verifyOtp">
                    <div class="flex flex-col space-y-16">
                        {{-- Input OTP dengan Alpine.js untuk auto-focus --}}
                        <div 
                            x-data="{ 
                                otp: @entangle('otp_code'),
                                inputs: [],
                                handleInput(index, event) {
                                    const value = event.target.value;
                                    if (value.length > 1) {
                                        event.target.value = value.slice(0, 1);
                                    }
                                    if (value && index < 5) {
                                        this.inputs[index + 1].focus();
                                    }
                                    this.updateOtp();
                                },
                                handleBackspace(index, event) {
                                    if (event.key === 'Backspace' && !event.target.value && index > 0) {
                                        this.inputs[index - 1].focus();
                                    }
                                },
                                updateOtp() {
                                    this.otp = this.inputs.map(input => input.value).join('');
                                }
                            }"
                            x-init="inputs = Array.from($el.querySelectorAll('input'))"
                            class="flex flex-row items-center justify-between mx-auto w-full max-w-xs"
                        >
                            @for ($i = 0; $i < 6; $i++)
                                <div class="w-16 h-16">
                                    <input 
                                        x-ref="input{{ $i }}"
                                        @input="handleInput({{ $i }}, $event)"
                                        @keydown.backspace="handleBackspace({{ $i }}, $event)"
                                        maxlength="1"
                                        class="w-full h-full flex flex-col items-center justify-center text-center px-5 outline-none rounded-xl border border-gray-200 text-lg bg-white focus:bg-gray-50 focus:ring-1 focus:ring-pink-500" 
                                        type="text" 
                                        pattern="[0-9]*"
                                        inputmode="numeric"
                                    >
                                </div>
                            @endfor
                        </div>
                        
                        @error('otp_code')
                            <div class="text-center text-sm text-red-500 -mt-12">{{ $message }}</div>
                        @enderror

                        <div class="flex flex-col space-y-5">
                            <div>
                                <button class="flex flex-row items-center justify-center text-center w-full border rounded-xl outline-none py-5 bg-pink-500 border-none text-white text-sm shadow-sm hover:bg-pink-600 transition">
                                    Verifikasi Akun
                                </button>
                            </div>

                            <div class="flex flex-row items-center justify-center text-center text-sm font-medium space-x-1 text-gray-500">
                                <p>Tidak menerima kode?</p> 
                                <button type="button" wire:click="resendOtp" class="flex flex-row items-center text-pink-600 hover:underline">Kirim Ulang</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>