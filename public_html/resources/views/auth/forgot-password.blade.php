<x-guest-layout>
    <h1 class="text-center p-4 text-justify" style="font-weight: 800;font-size:30px">LUPA PASSWORD
    </h1>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa password? tidak masalah. masukkan email yang terdaftar pada website lalu tekan tombol "EMAIL PASSWORD RESET LINK" lalu ke gmail dari email yang anda masukkan untuk merest password') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
