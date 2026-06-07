<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Sekolah') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Success Message Alert --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-lg shadow-sm animate-fade-in flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center mr-3 flex-shrink-0 text-emerald-600">
                            <i class="fas fa-check-circle text-md"></i>
                        </div>
                        <span class="text-sm font-medium text-emerald-800">{{ session('success') }}</span>
                    </div>
                    <button type="button" class="text-emerald-400 hover:text-emerald-600" onclick="this.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            {{-- Error Message Alert --}}
            @if($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 rounded-lg shadow-sm">
                    <div class="flex items-center mb-3">
                        <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center mr-3 flex-shrink-0 text-rose-600">
                            <i class="fas fa-exclamation-circle text-md"></i>
                        </div>
                        <span class="text-sm font-bold text-rose-800">Mohon perbaiki kesalahan berikut:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs text-rose-700 space-y-1 pl-11">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Page Header Card --}}
            <div class="dash-header-card mb-5 relative overflow-hidden rounded-2xl bg-gradient-to-r from-slate-900 to-indigo-950 p-6 text-white shadow-lg border border-slate-800">
                <div class="dash-header-card-content flex items-center gap-4 relative z-10">
                    <div class="dash-header-card-icon w-12 h-12 rounded-xl bg-white/10 backdrop-blur-md flex items-center justify-center text-xl flex-shrink-0 border border-white/10">
                        <i class="fas fa-sliders-h text-indigo-300"></i>
                    </div>
                    <div>
                        <h3 class="dash-header-card-title text-lg font-bold">Pengaturan Portal Sekolah</h3>
                        <p class="dash-header-card-desc text-xs text-slate-300">Ubah identitas, visi-misi, teks halaman, dan profil kepala sekolah secara live.</p>
                    </div>
                </div>
                <div class="absolute -top-12 -right-8 w-44 h-44 rounded-full bg-white/5 blur-xl"></div>
                <div class="absolute -bottom-16 right-24 w-36 h-36 rounded-full bg-indigo-500/5 blur-xl"></div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-slate-100">
                <div class="p-6 sm:p-8">

                    {{-- Tabs Navigation --}}
                    <div class="flex border-b border-slate-200 mb-6 overflow-x-auto whitespace-nowrap scrollbar-thin pb-1">
                        <button type="button" onclick="switchTab('tab-identitas')" id="btn-tab-identitas" class="tab-btn py-3 px-4 text-sm font-semibold border-b-2 border-transparent text-slate-500 hover:text-indigo-600 focus:outline-none flex items-center">
                            <i class="fas fa-id-card mr-2 text-md"></i>Identitas Sekolah
                        </button>
                        <button type="button" onclick="switchTab('tab-kepsek')" id="btn-tab-kepsek" class="tab-btn py-3 px-4 text-sm font-semibold border-b-2 border-transparent text-slate-500 hover:text-indigo-600 focus:outline-none flex items-center">
                            <i class="fas fa-user-tie mr-2 text-md"></i>Profil Kepala Sekolah
                        </button>
                        <button type="button" onclick="switchTab('tab-visimisi')" id="btn-tab-visimisi" class="tab-btn py-3 px-4 text-sm font-semibold border-b-2 border-transparent text-slate-500 hover:text-indigo-600 focus:outline-none flex items-center">
                            <i class="fas fa-bullseye mr-2 text-md"></i>Visi & Misi
                        </button>
                        <button type="button" onclick="switchTab('tab-kontak')" id="btn-tab-kontak" class="tab-btn py-3 px-4 text-sm font-semibold border-b-2 border-transparent text-slate-500 hover:text-indigo-600 focus:outline-none flex items-center">
                            <i class="fas fa-map-marked-alt mr-2 text-md"></i>Kontak & Alamat
                        </button>
                        <button type="button" onclick="switchTab('tab-teks')" id="btn-tab-teks" class="tab-btn py-3 px-4 text-sm font-semibold border-b-2 border-transparent text-slate-500 hover:text-indigo-600 focus:outline-none flex items-center">
                            <i class="fas fa-file-alt mr-2 text-md"></i>Teks Halaman
                        </button>
                        <button type="button" onclick="switchTab('tab-foto')" id="btn-tab-foto" class="tab-btn py-3 px-4 text-sm font-semibold border-b-2 border-transparent text-slate-500 hover:text-indigo-600 focus:outline-none flex items-center">
                            <i class="fas fa-images mr-2 text-md"></i>Foto Website
                        </button>
                    </div>

                    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- TAB 1: IDENTITAS SEKOLAH --}}
                        <div id="tab-identitas" class="tab-content block space-y-6">

                            {{-- Maintenance Mode Section --}}
                            <div class="settings-card bg-amber-50/40 rounded-xl p-5 border border-amber-100">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="pr-4">
                                        <h4 class="text-sm font-bold text-slate-800 flex items-center mb-1">
                                            <i class="fas fa-tools text-amber-500 mr-2"></i>Mode Pemeliharaan (Maintenance Mode)
                                        </h4>
                                        <p class="text-xs text-slate-500 leading-relaxed">
                                            Aktifkan untuk membatasi akses pengunjung umum ke website saat Anda sedang memperbarui data. Administrator, Guru, dan Staff tetap dapat masuk dan mengakses dashboard untuk mengelola data.
                                        </p>
                                    </div>
                                    <div class="flex items-center flex-shrink-0">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="is_maintenance" value="1" {{ $isMaintenance ? 'checked' : '' }} class="sr-only peer">
                                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="settings-card bg-slate-50/50 rounded-xl p-5 border border-slate-100">
                                <h4 class="text-sm font-bold text-slate-800 border-b border-slate-200 pb-2 mb-4 flex items-center"><i class="fas fa-info-circle text-indigo-600 mr-2"></i>Informasi Umum</h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="school_name" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Nama Sekolah <span class="text-rose-500">*</span></label>
                                        <input type="text" id="school_name" name="school_name" value="{{ old('school_name', $settings->school_name) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" required>
                                    </div>
                                    <div>
                                        <label for="npsn" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">NPSN <span class="text-rose-500">*</span></label>
                                        <input type="text" id="npsn" name="npsn" value="{{ old('npsn', $settings->npsn) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" required>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                    <div>
                                        <label for="akreditasi" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Akreditasi <span class="text-rose-500">*</span></label>
                                        <input type="text" id="akreditasi" name="akreditasi" value="{{ old('akreditasi', $settings->akreditasi) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" placeholder="Contoh: A, B, C" required>
                                    </div>
                                    <div>
                                        <label for="kurikulum" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Kurikulum <span class="text-rose-500">*</span></label>
                                        <input type="text" id="kurikulum" name="kurikulum" value="{{ old('kurikulum', $settings->kurikulum) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" required>
                                    </div>
                                    <div>
                                        <label for="status_sekolah" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Status Sekolah <span class="text-rose-500">*</span></label>
                                        <select id="status_sekolah" name="status_sekolah" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" required>
                                            <option value="Negeri" {{ old('status_sekolah', $settings->status_sekolah) == 'Negeri' ? 'selected' : '' }}>Negeri</option>
                                            <option value="Swasta" {{ old('status_sekolah', $settings->status_sekolah) == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <label for="bentuk_pendidikan" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Bentuk Pendidikan <span class="text-rose-500">*</span></label>
                                        <input type="text" id="bentuk_pendidikan" name="bentuk_pendidikan" value="{{ old('bentuk_pendidikan', $settings->bentuk_pendidikan) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" placeholder="Contoh: SMP" required>
                                    </div>
                                    <div>
                                        <label for="dapodik_link" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Link Dapodik Kemendikbud <span class="text-rose-500">*</span></label>
                                        <input type="url" id="dapodik_link" name="dapodik_link" value="{{ old('dapodik_link', $settings->dapodik_link) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" required>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                    <div>
                                        <label for="kecamatan" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Kecamatan <span class="text-rose-500">*</span></label>
                                        <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $settings->kecamatan) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" required>
                                    </div>
                                    <div>
                                        <label for="kabupaten" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Kabupaten/Kota <span class="text-rose-500">*</span></label>
                                        <input type="text" id="kabupaten" name="kabupaten" value="{{ old('kabupaten', $settings->kabupaten) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" required>
                                    </div>
                                    <div>
                                        <label for="provinsi" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Provinsi <span class="text-rose-500">*</span></label>
                                        <input type="text" id="provinsi" name="provinsi" value="{{ old('provinsi', $settings->provinsi) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" required>
                                    </div>
                                </div>
                            </div>

                            <div class="settings-card bg-slate-50/50 rounded-xl p-5 border border-slate-100 mt-5">
                                <h4 class="text-sm font-bold text-slate-800 border-b border-slate-200 pb-2 mb-4 flex items-center"><i class="fas fa-chart-line text-indigo-600 mr-2"></i>Statistik Real-time Beranda</h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="p-4 bg-white border border-slate-200 rounded-xl flex items-center shadow-sm hover:border-indigo-300 transition-all">
                                        <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl mr-4 flex-shrink-0">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <label for="jumlah_siswa" class="block text-xs font-bold text-slate-400 uppercase mb-0.5">Jumlah Siswa <span class="text-rose-500">*</span></label>
                                            <input type="number" id="jumlah_siswa" name="jumlah_siswa" value="{{ old('jumlah_siswa', $settings->jumlah_siswa) }}" min="0" class="w-full text-lg font-bold border-0 p-0 focus:ring-0 text-slate-800" required>
                                        </div>
                                    </div>
                                    <div class="p-4 bg-white border border-slate-200 rounded-xl flex items-center shadow-sm hover:border-indigo-300 transition-all">
                                        <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl mr-4 flex-shrink-0">
                                            <i class="fas fa-users-cog"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <label for="jumlah_staff" class="block text-xs font-bold text-slate-400 uppercase mb-0.5">Jumlah Staf/Staff <span class="text-rose-500">*</span></label>
                                            <input type="number" id="jumlah_staff" name="jumlah_staff" value="{{ old('jumlah_staff', $settings->jumlah_staff) }}" min="0" class="w-full text-lg font-bold border-0 p-0 focus:ring-0 text-slate-800" required>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-xxs text-slate-400 mt-3 flex items-center"><i class="fas fa-info-circle mr-1 text-indigo-500"></i>Angka di atas disinkronisasi langsung pada kotak counter statistik halaman utama beranda publik.</p>
                            </div>
                        </div>

                        {{-- TAB 2: PROFIL KEPALA SEKOLAH --}}
                        <div id="tab-kepsek" class="tab-content hidden space-y-6">
                            <div class="settings-card bg-slate-50/50 rounded-xl p-5 border border-slate-100">
                                <h4 class="text-sm font-bold text-slate-800 border-b border-slate-200 pb-2 mb-4 flex items-center"><i class="fas fa-user-circle text-indigo-600 mr-2"></i>Identitas Kepala Sekolah</h4>
                                
                                <div>
                                    <label for="kepsek_name" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Nama Kepala Sekolah <span class="text-rose-500">*</span></label>
                                    <input type="text" id="kepsek_name" name="kepsek_name" value="{{ old('kepsek_name', $settings->kepsek_name) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" required>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center mt-5">
                                    <div class="col-span-1 flex flex-col items-center">
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Foto Kepala Sekolah Aktif</label>
                                        <div class="w-40 h-52 border-2 border-dashed border-slate-200 rounded-2xl bg-white flex items-center justify-center overflow-hidden shadow-sm relative group">
                                            @if($settings->kepsek_photo_path)
                                                <img id="preview-kepsek" src="{{ asset('storage/' . str_replace('public/', '', $settings->kepsek_photo_path)) }}" alt="Foto Kepala Sekolah" class="w-full h-full object-cover">
                                            @else
                                                <div id="placeholder-kepsek" class="text-center p-3">
                                                    <i class="fas fa-user-tie text-5xl text-slate-300"></i>
                                                    <p class="text-xxs text-slate-400 mt-2">Belum ada foto</p>
                                                </div>
                                                <img id="preview-kepsek" class="w-full h-full object-cover hidden">
                                            @endif
                                            <div class="absolute inset-0 bg-slate-950/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold gap-1.5 pointer-events-none">
                                                <i class="fas fa-upload"></i> Ganti Foto
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="kepsek_photo" class="block text-xs font-bold text-slate-500 uppercase mb-2">Unggah Foto Baru</label>
                                        <div class="premium-upload-container">
                                            <input type="file" id="kepsek_photo" name="kepsek_photo" accept="image/jpeg,image/png,image/jpg,image/webp" onchange="previewImage(this, 'preview-kepsek', 'placeholder-kepsek')">
                                            <div class="flex flex-col items-center">
                                                <div class="upload-zone-icon w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl mb-2">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                                <span class="upload-zone-text text-sm font-semibold text-slate-700">Pilih berkas foto kepala sekolah</span>
                                                <span class="upload-zone-hint text-xxs text-slate-400 mt-1">Format: JPG, PNG, WEBP. Maksimal file: 4 MB.</span>
                                                <span id="file-name-kepsek" class="text-xs text-indigo-600 font-semibold mt-2 hidden"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <label for="kepsek_welcome_text" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Sambutan & Kata Pengantar <span class="text-rose-500">*</span></label>
                                    <textarea id="kepsek_welcome_text" name="kepsek_welcome_text" rows="6" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all text-slate-700 leading-relaxed" required>{{ old('kepsek_welcome_text', $settings->kepsek_welcome_text) }}</textarea>
                                    <p class="text-xxs text-slate-400 mt-1.5 flex items-center"><i class="fas fa-info-circle mr-1 text-indigo-500"></i>Teks sambutan ini tampil di halaman beranda depan dan detail profil sekolah.</p>
                                </div>
                            </div>
                        </div>

                        {{-- TAB 3: VISI & MISI --}}
                        <div id="tab-visimisi" class="tab-content hidden space-y-6">
                            <div class="settings-card bg-slate-50/50 rounded-xl p-5 border border-slate-100">
                                <h4 class="text-sm font-bold text-slate-800 border-b border-slate-200 pb-2 mb-4 flex items-center"><i class="fas fa-gem text-indigo-600 mr-2"></i>Arah Strategis & Pedoman</h4>
                                
                                <div>
                                    <label for="visi" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Visi Sekolah <span class="text-rose-500">*</span></label>
                                    <textarea id="visi" name="visi" rows="3" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all font-semibold italic text-slate-700" placeholder="Tuliskan visi sekolah..." required>{{ old('visi', $settings->visi) }}</textarea>
                                </div>

                                <div class="mt-5">
                                    <label for="misi" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Misi Sekolah <span class="text-rose-500">*</span></label>
                                    <textarea id="misi" name="misi" rows="8" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all text-slate-700 leading-relaxed" placeholder="Tuliskan poin-poin misi sekolah..." required>{{ old('misi', $settings->misi) }}</textarea>
                                    <div class="mt-2.5 p-3 bg-amber-50 rounded-lg border border-amber-200 flex items-start text-xxs text-amber-800">
                                        <i class="fas fa-lightbulb text-amber-600 text-sm mr-2 mt-0.5 flex-shrink-0 animate-bounce"></i>
                                        <div>
                                            <strong>Tips Penulisan Misi:</strong> Tuliskan setiap satu poin misi pada baris baru (tekan <strong>Enter</strong>). Sistem pada website utama secara pintar akan memecah paragraf di atas menjadi susunan poin list bernomor atau ber-bullet yang sangat rapi dan estetik secara otomatis!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- TAB 4: KONTAK & ALAMAT --}}
                        <div id="tab-kontak" class="tab-content hidden space-y-6">
                            <div class="settings-card bg-slate-50/50 rounded-xl p-5 border border-slate-100">
                                <h4 class="text-sm font-bold text-slate-800 border-b border-slate-200 pb-2 mb-4 flex items-center"><i class="fas fa-address-book text-indigo-600 mr-2"></i>Informasi Kontak & Google Maps</h4>
                                
                                <div>
                                    <label for="address" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Alamat Lengkap</label>
                                    <textarea id="address" name="address" rows="3" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all text-slate-700" placeholder="Tuliskan alamat lengkap sekolah...">{{ old('address', $settings->address) }}</textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <label for="phone" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Nomor Telepon/HP</label>
                                        <input type="text" id="phone" name="phone" value="{{ old('phone', $settings->phone) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" placeholder="Contoh: 08123456789">
                                    </div>
                                    <div>
                                        <label for="email" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Email Sekolah Resmi</label>
                                        <input type="email" id="email" name="email" value="{{ old('email', $settings->email) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" placeholder="Contoh: smpn14bulukumba@gmail.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- TAB 5: TEKS HALAMAN --}}
                        <div id="tab-teks" class="tab-content hidden space-y-6">
                            <div class="settings-card bg-slate-50/50 rounded-xl p-5 border border-slate-100">
                                <h4 class="text-sm font-bold text-slate-800 border-b border-slate-200 pb-2 mb-4 flex items-center"><i class="fas fa-home text-indigo-600 mr-2"></i>Teks Halaman Utama (Beranda)</h4>
                                
                                <div>
                                    <label for="hero_subtitle" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Sub-judul Carousel Banner (Hero) <span class="text-rose-500">*</span></label>
                                    <input type="text" id="hero_subtitle" name="hero_subtitle" value="{{ old('hero_subtitle', $settings->hero_subtitle) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" required>
                                </div>

                                <div class="mt-4">
                                    <label for="hero_description" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Deskripsi Carousel Banner (Hero) <span class="text-rose-500">*</span></label>
                                    <textarea id="hero_description" name="hero_description" rows="4" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all text-slate-700 leading-relaxed" required>{{ old('hero_description', $settings->hero_description) }}</textarea>
                                </div>

                                <div class="grid grid-cols-1 gap-4 mt-5 border-t border-slate-200 pt-5">
                                    <div>
                                        <label for="about_title" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Judul Seksi Tentang Sekolah <span class="text-rose-500">*</span></label>
                                        <input type="text" id="about_title" name="about_title" value="{{ old('about_title', $settings->about_title) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" required>
                                    </div>
                                    <div class="mt-2">
                                        <label for="about_description" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Deskripsi Seksi Tentang Sekolah <span class="text-rose-500">*</span></label>
                                        <textarea id="about_description" name="about_description" rows="4" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all text-slate-700 leading-relaxed" required>{{ old('about_description', $settings->about_description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="settings-card bg-slate-50/50 rounded-xl p-5 border border-slate-100 mt-5">
                                <h4 class="text-sm font-bold text-slate-800 border-b border-slate-200 pb-2 mb-4 flex items-center"><i class="fas fa-history text-indigo-600 mr-2"></i>Artikel Halaman Profil</h4>
                                
                                <div>
                                    <label for="history_title" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Judul Sejarah Sekolah <span class="text-rose-500">*</span></label>
                                    <input type="text" id="history_title" name="history_title" value="{{ old('history_title', $settings->history_title) }}" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all" required>
                                </div>

                                <div class="mt-4">
                                    <label for="history_description" class="block text-xs font-bold text-slate-500 uppercase mb-1.5">Artikel Sejarah Lengkap <span class="text-rose-500">*</span></label>
                                    <textarea id="history_description" name="history_description" rows="10" class="w-full text-sm border-slate-200 rounded-lg focus:border-indigo-500 focus:ring focus:ring-indigo-100 transition-all text-slate-700 leading-relaxed" required>{{ old('history_description', $settings->history_description) }}</textarea>
                                    <p class="text-xxs text-slate-400 mt-1.5"><i class="fas fa-info-circle mr-1 text-indigo-500"></i>Gunakan baris kosong (tekan **Enter** dua kali) untuk memisahkan antar paragraf agar tampil terpisah rapi di halaman profil luar.</p>
                                </div>
                            </div>
                        </div>

                        {{-- TAB 6: FOTO WEBSITE --}}
                        <div id="tab-foto" class="tab-content hidden space-y-6">
                            <div class="settings-card bg-slate-50/50 rounded-xl p-5 border border-slate-100">
                                <h4 class="text-sm font-bold text-slate-800 border-b border-slate-200 pb-2 mb-4 flex items-center"><i class="fas fa-images text-indigo-600 mr-2"></i>Dokumentasi Banner & Carousel Sekolah</h4>
                                
                                <div class="p-4 bg-indigo-50 border-l-4 border-indigo-500 rounded-r-xl text-xxs text-indigo-900 mb-6 leading-relaxed shadow-sm">
                                    <div class="flex">
                                        <i class="fas fa-info-circle mr-2.5 text-md mt-0.5 flex-shrink-0 text-indigo-600"></i>
                                        <div>
                                            <strong class="text-xs">Ketentuan Unggah Gambar Website:</strong>
                                            <ul class="list-disc list-inside mt-1.5 space-y-1 pl-1">
                                                <li>Mendukung file gambar: <strong>JPG, JPEG, PNG, WEBP, atau HEIC/HEIF</strong> (langsung dari kamera iPhone).</li>
                                                <li>Jika gambar berformat HEIC/HEIF diunggah, server akan **mengonversinya otomatis** menjadi JPEG universal.</li>
                                                <li>Disarankan memakai foto **ber-aspek rasio landscape lebar (16:9)** demi tampilan slider yang simetris dan mewah.</li>
                                                <li>Ukuran file maksimal per gambar: <strong>10 MB</strong>.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    {{-- Hero Photo 1 --}}
                                    <div class="border border-slate-200/80 rounded-2xl p-4 bg-white shadow-sm flex flex-col justify-between hover:shadow-md transition-all">
                                        <div>
                                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1.5">Beranda Hero Slide #1</span>
                                            <div class="aspect-video w-full border border-slate-100 rounded-xl bg-slate-50 flex items-center justify-center overflow-hidden mb-4 relative group shadow-inner">
                                                @if($settings->hero_photo_1 && file_exists(public_path('storage/' . str_replace('public/', '', $settings->hero_photo_1))))
                                                    <img id="preview-hero-1" src="{{ asset('storage/' . str_replace('public/', '', $settings->hero_photo_1)) }}" class="w-full h-full object-cover">
                                                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">Ganti Foto</div>
                                                @else
                                                    <img id="preview-hero-1" src="{{ asset('image/homePic/3.jpg') }}" class="w-full h-full object-cover opacity-60">
                                                    <div id="badge-hero-1" class="absolute top-2.5 left-2.5 bg-amber-500 text-white text-3xs px-2 py-0.5 rounded font-bold uppercase shadow-sm">Default</div>
                                                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">Ganti Foto</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <label for="hero_photo_1" class="block text-xs font-bold text-slate-500 mb-1.5">Ganti Foto Slide #1</label>
                                            <div class="premium-upload-container py-2.5 px-3 rounded-lg border-dashed">
                                                <input type="file" id="hero_photo_1" name="hero_photo_1" accept="image/jpeg,image/png,image/jpg,image/webp,image/heic,image/heif" onchange="previewImage(this, 'preview-hero-1', null, 'badge-hero-1')">
                                                <span class="text-xxs font-semibold text-slate-500"><i class="fas fa-file-image mr-1"></i>Pilih Foto Slide #1</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Hero Photo 2 --}}
                                    <div class="border border-slate-200/80 rounded-2xl p-4 bg-white shadow-sm flex flex-col justify-between hover:shadow-md transition-all">
                                        <div>
                                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1.5">Beranda Hero Slide #2</span>
                                            <div class="aspect-video w-full border border-slate-100 rounded-xl bg-slate-50 flex items-center justify-center overflow-hidden mb-4 relative group shadow-inner">
                                                @if($settings->hero_photo_2 && file_exists(public_path('storage/' . str_replace('public/', '', $settings->hero_photo_2))))
                                                    <img id="preview-hero-2" src="{{ asset('storage/' . str_replace('public/', '', $settings->hero_photo_2)) }}" class="w-full h-full object-cover">
                                                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">Ganti Foto</div>
                                                @else
                                                    <img id="preview-hero-2" src="{{ asset('image/homePic/2.jpg') }}" class="w-full h-full object-cover opacity-60">
                                                    <div id="badge-hero-2" class="absolute top-2.5 left-2.5 bg-amber-500 text-white text-3xs px-2 py-0.5 rounded font-bold uppercase shadow-sm">Default</div>
                                                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">Ganti Foto</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <label for="hero_photo_2" class="block text-xs font-bold text-slate-500 mb-1.5">Ganti Foto Slide #2</label>
                                            <div class="premium-upload-container py-2.5 px-3 rounded-lg border-dashed">
                                                <input type="file" id="hero_photo_2" name="hero_photo_2" accept="image/jpeg,image/png,image/jpg,image/webp,image/heic,image/heif" onchange="previewImage(this, 'preview-hero-2', null, 'badge-hero-2')">
                                                <span class="text-xxs font-semibold text-slate-500"><i class="fas fa-file-image mr-1"></i>Pilih Foto Slide #2</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Hero Photo 3 --}}
                                    <div class="border border-slate-200/80 rounded-2xl p-4 bg-white shadow-sm flex flex-col justify-between hover:shadow-md transition-all">
                                        <div>
                                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1.5">Beranda Hero Slide #3</span>
                                            <div class="aspect-video w-full border border-slate-100 rounded-xl bg-slate-50 flex items-center justify-center overflow-hidden mb-4 relative group shadow-inner">
                                                @if($settings->hero_photo_3 && file_exists(public_path('storage/' . str_replace('public/', '', $settings->hero_photo_3))))
                                                    <img id="preview-hero-3" src="{{ asset('storage/' . str_replace('public/', '', $settings->hero_photo_3)) }}" class="w-full h-full object-cover">
                                                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">Ganti Foto</div>
                                                @else
                                                    <img id="preview-hero-3" src="{{ asset('image/homePic/1.jpg') }}" class="w-full h-full object-cover opacity-60">
                                                    <div id="badge-hero-3" class="absolute top-2.5 left-2.5 bg-amber-500 text-white text-3xs px-2 py-0.5 rounded font-bold uppercase shadow-sm">Default</div>
                                                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">Ganti Foto</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <label for="hero_photo_3" class="block text-xs font-bold text-slate-500 mb-1.5">Ganti Foto Slide #3</label>
                                            <div class="premium-upload-container py-2.5 px-3 rounded-lg border-dashed">
                                                <input type="file" id="hero_photo_3" name="hero_photo_3" accept="image/jpeg,image/png,image/jpg,image/webp,image/heic,image/heif" onchange="previewImage(this, 'preview-hero-3', null, 'badge-hero-3')">
                                                <span class="text-xxs font-semibold text-slate-500"><i class="fas fa-file-image mr-1"></i>Pilih Foto Slide #3</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border border-slate-200/80 rounded-2xl p-5 bg-white shadow-sm mt-5 hover:shadow-md transition-all">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                                        <div class="md:col-span-1">
                                            <span class="text-xs font-bold text-slate-800 uppercase tracking-wider block mb-1">Banner Halaman Profil</span>
                                            <p class="text-xxs text-slate-400 leading-relaxed">Tampil megah melintang penuh di bagian atas halaman profil sekolah.</p>
                                        </div>
                                        <div class="md:col-span-1">
                                            <div class="aspect-video w-full border border-slate-100 rounded-xl bg-slate-50 flex items-center justify-center overflow-hidden relative group shadow-sm shadow-inner">
                                                @if($settings->profile_banner_photo && file_exists(public_path('storage/' . str_replace('public/', '', $settings->profile_banner_photo))))
                                                    <img id="preview-banner" src="{{ asset('storage/' . str_replace('public/', '', $settings->profile_banner_photo)) }}" class="w-full h-full object-cover">
                                                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">Ganti Banner</div>
                                                @else
                                                    <img id="preview-banner" src="{{ asset('image/homePic/1.jpg') }}" class="w-full h-full object-cover opacity-60">
                                                    <div id="badge-banner" class="absolute top-2.5 left-2.5 bg-amber-500 text-white text-3xs px-2 py-0.5 rounded font-bold uppercase shadow-sm">Default</div>
                                                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">Ganti Banner</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="md:col-span-1">
                                            <label for="profile_banner_photo" class="block text-xs font-bold text-slate-500 mb-1.5">Ganti Banner Profil</label>
                                            <div class="premium-upload-container py-3 px-4 rounded-xl border-dashed">
                                                <input type="file" id="profile_banner_photo" name="profile_banner_photo" accept="image/jpeg,image/png,image/jpg,image/webp,image/heic,image/heif" onchange="previewImage(this, 'preview-banner', null, 'badge-banner')">
                                                <span class="text-xs font-semibold text-slate-500"><i class="fas fa-image mr-1"></i>Pilih File Banner Baru</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-8 pt-5 border-t border-slate-100 flex items-center justify-end space-x-3">
                            <a href="{{ route('dashboard') }}" class="py-2.5 px-6 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all flex items-center shadow-sm">
                                <i class="fas fa-times mr-2 text-sm"></i>Batal
                            </a>
                            <button type="submit" class="py-2.5 px-7 text-xs font-bold text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 rounded-xl shadow-md hover:shadow-lg transition-all flex items-center border-none">
                                <i class="fas fa-save mr-2 text-sm"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs & Upload Styling & Handling --}}
    @push('styles')
    <style>
        /* Tabs Transitions with Fade-in and Slide-up */
        .tab-content {
            animation: tabFadeInUp 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        
        @keyframes tabFadeInUp {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Sleek Premium Tab Buttons */
        .tab-btn {
            position: relative;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            border-bottom: 2px solid transparent !important;
        }
        
        .tab-btn:hover {
            color: #4f46e5 !important;
            background-color: rgba(79, 70, 229, 0.03);
            border-radius: 8px 8px 0 0;
        }
        
        .tab-btn.active-tab {
            color: #4f46e5 !important;
            border-bottom: 2px solid #4f46e5 !important;
            background-color: rgba(79, 70, 229, 0.05) !important;
            font-weight: 700 !important;
            border-radius: 8px 8px 0 0;
        }

        /* Card Group Styling */
        .settings-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .settings-card:hover {
            box-shadow: 0 8px 24px rgba(30, 58, 95, 0.04);
            border-color: #e2e8f0;
        }

        /* Interactive File Upload Zones */
        .premium-upload-container {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: #f8fafc;
            padding: 1.25rem;
            text-align: center;
            transition: all 0.25s ease;
            position: relative;
            cursor: pointer;
        }
        
        .premium-upload-container:hover {
            border-color: #4f46e5;
            background: rgba(79, 70, 229, 0.02);
        }
        
        .premium-upload-container input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 10;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Real-time dynamic tab active states
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial active tab state
            const initialTabBtn = document.getElementById('btn-tab-identitas');
            if (initialTabBtn) {
                initialTabBtn.classList.add('active-tab');
            }
        });

        // Tab switcher with animation support
        function switchTab(tabId) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('block');
            });

            // Show active tab content
            const activeContent = document.getElementById(tabId);
            activeContent.classList.remove('hidden');
            activeContent.classList.add('block');

            // Deactivate all tab buttons
            const tabButtons = document.querySelectorAll('.tab-btn');
            tabButtons.forEach(btn => {
                btn.classList.remove('active-tab');
            });

            // Activate active tab button
            const activeBtn = document.getElementById('btn-' + tabId);
            if (activeBtn) {
                activeBtn.classList.add('active-tab');
            }
        }

        // Live Image Preview Functionality
        function previewImage(input, previewId, placeholderId, badgeId) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewElement = document.getElementById(previewId);
                    if (previewElement) {
                        previewElement.src = e.target.result;
                        previewElement.classList.remove('hidden');
                        previewElement.style.opacity = '1';
                    }
                    
                    const placeholderElement = document.getElementById(placeholderId);
                    if (placeholderElement) {
                        placeholderElement.classList.add('hidden');
                    }

                    const badgeElement = document.getElementById(badgeId);
                    if (badgeElement) {
                        // Dynamically update default badge to preview state
                        badgeElement.textContent = 'Preview';
                        badgeElement.className = 'absolute top-2.5 left-2.5 bg-indigo-600 text-white text-3xs px-2 py-0.5 rounded font-bold uppercase shadow-sm animate-pulse';
                    }

                    // Toast Feedback
                    if (typeof Swal !== 'undefined') {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'bottom-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Gambar berhasil dimuat ke pratinjau!'
                        });
                    }
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
    @endpush
</x-app-layout>
