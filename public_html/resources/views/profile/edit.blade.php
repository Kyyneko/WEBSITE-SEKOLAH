<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">{{ __('Edit Profil') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            
            <div class="row g-4">
                <div class="col-lg-8">
                    {{-- Update Profile --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                        <div class="p-4">
                            <h5 class="mgmt-title mb-3" style="border-bottom:2px solid var(--dash-border);padding-bottom:0.65rem;">
                                <i class="fas fa-user-edit me-2"></i>Informasi Profil
                            </h5>
                            <div class="mt-3">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>

                    {{-- Update Password --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4">
                            <h5 class="mgmt-title mb-3" style="border-bottom:2px solid var(--dash-border);padding-bottom:0.65rem;">
                                <i class="fas fa-lock me-2"></i>Ubah Password
                            </h5>
                            <div class="mt-3">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    {{-- Delete Account --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4">
                            <h5 class="mgmt-title mb-3" style="border-bottom:2px solid var(--dash-border);padding-bottom:0.65rem;color:var(--dash-danger);">
                                <i class="fas fa-exclamation-triangle me-2"></i>Zona Bahaya
                            </h5>
                            <div class="mt-3">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
