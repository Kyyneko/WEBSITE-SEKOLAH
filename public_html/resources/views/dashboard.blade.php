<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PROFILE') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-0">
                            <!-- Header Section with Photo -->
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-5 text-center">
                                <div class="mb-3">
                                    @php
                                        $photoPath = auth()->user()->photo_path;
                                        $photoUrl = null;
                                        
                                        if ($photoPath) {
                                            // Handle multiple path formats
                                            if (str_starts_with($photoPath, 'public/photos/')) {
                                                $photoUrl = asset('storage/' . str_replace('public/', '', $photoPath));
                                            } elseif (str_starts_with($photoPath, 'public/image/')) {
                                                $photoUrl = asset(str_replace('public/', '', $photoPath));
                                            } elseif (str_starts_with($photoPath, 'photos/')) {
                                                $photoUrl = asset('storage/' . $photoPath);
                                            } elseif (str_starts_with($photoPath, 'image/')) {
                                                $photoUrl = asset($photoPath);
                                            } else {
                                                $photoUrl = asset('storage/' . $photoPath);
                                            }
                                        }
                                    @endphp

                                    @if ($photoUrl)
                                        {{-- Foto profil --}}
                                        <img src="{{ $photoUrl }}"
                                             alt="User Photo"
                                             class="rounded-circle border border-4 border-white shadow-lg mx-auto d-block"
                                             style="width: 150px; height: 150px; object-fit: cover;"
                                             onerror="this.style.display='none'; document.getElementById('fallback-avatar-{{ auth()->user()->id }}').style.display='flex';">
                                        
                                        {{-- Fallback avatar kalau gambar gagal dimuat --}}
                                        <div id="fallback-avatar-{{ auth()->user()->id }}"
                                             class="rounded-circle border border-4 border-white shadow-lg mx-auto d-none align-items-center justify-content-center bg-indigo-100"
                                             style="width: 150px; height: 150px;">
                                            <i class="fas fa-user text-indigo-600" style="font-size: 4rem;"></i>
                                        </div>
                                    @else
                                        {{-- Tidak ada photo_path, tampilkan avatar default --}}
                                        <div class="rounded-circle border border-4 border-white shadow-lg mx-auto d-flex align-items-center justify-content-center bg-indigo-100"
                                             style="width: 150px; height: 150px;">
                                            <i class="fas fa-user text-indigo-600" style="font-size: 4rem;"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                {{-- Nama User --}}
                                <h4 class="text-white font-weight-bold mb-2">{{ auth()->user()->name }}</h4>
                                <p class="text-white-50 mb-0">
                                    <span class="badge badge-light">
                                        {{ ucfirst(auth()->user()->role) }}
                                    </span>
                                </p>
                            </div>

                            <!-- Profile Information -->
                            <div class="p-4 p-md-5">
                                <h5 class="font-weight-bold text-gray-800 mb-4 border-bottom pb-2">
                                    <i class="fas fa-user-circle mr-2"></i>Informasi Profile
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small font-weight-bold mb-1">NIK</label>
                                        <p class="mb-0 text-gray-900">{{ auth()->user()->nik ?? 'Belum diisi' }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small font-weight-bold mb-1">NIP</label>
                                        <p class="mb-0 text-gray-900">{{ auth()->user()->nip ?? 'Belum diisi' }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small font-weight-bold mb-1">Tempat, Tanggal Lahir</label>
                                        <p class="mb-0 text-gray-900">{{ auth()->user()->ttl ?? 'Belum diisi' }}</p>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small font-weight-bold mb-1">No. Telepon</label>
                                        <p class="mb-0 text-gray-900">{{ auth()->user()->phone ?? 'Belum diisi' }}</p>
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <label class="text-muted small font-weight-bold mb-1">Email</label>
                                        <p class="mb-0 text-gray-900">{{ auth()->user()->email }}</p>
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <label class="text-muted small font-weight-bold mb-1">Mata Pelajaran</label>
                                        <p class="mb-0 text-gray-900">
                                            @if (auth()->user()->subject_id)
                                                {{ \App\Models\Subject::find(auth()->user()->subject_id)->name ?? 'Tidak ditemukan' }}
                                            @else
                                                Belum diisi
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Alert Info -->
                                <div class="alert alert-info mt-4 mb-0" role="alert">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    <strong>Info:</strong> Untuk mengubah profile, klik tab yang berisi nama Anda, kemudian pilih menu <strong>Profile</strong>.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-to-r {
            background: linear-gradient(to right, #3b82f6, #2563eb);
        }
        
        .card {
            border-radius: 12px;
            overflow: hidden;
        }
        
        .text-white-50 {
            color: rgba(255, 255, 255, 0.8);
        }
        
        .badge-light {
            background-color: rgba(255, 255, 255, 0.9);
            color: #2563eb;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
        
        .alert-info {
            background-color: #e0f2fe;
            border-color: #bae6fd;
            color: #075985;
            border-radius: 8px;
        }
        
        label.small {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .text-gray-900 {
            font-size: 1rem;
            font-weight: 500;
            color: #111827;
        }
        
        .shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        /* Fallback Avatar Styling */
        .bg-indigo-100 {
            background-color: #e0e7ff;
        }
        
        .text-indigo-600 {
            color: #4f46e5;
        }
        
        /* Responsive Image */
        img.rounded-circle {
            object-position: center;
        }
    </style>
</x-app-layout>