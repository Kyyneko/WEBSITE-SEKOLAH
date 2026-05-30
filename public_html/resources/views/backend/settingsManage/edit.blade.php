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
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-md shadow-sm animate-pulse">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 text-lg mr-3"></i>
                        <span class="text-sm font-medium text-green-800">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            {{-- Error Message Alert --}}
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-md shadow-sm">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle text-red-500 text-lg mr-3"></i>
                        <span class="text-sm font-bold text-red-800">Mohon perbaiki kesalahan berikut:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Page Header Card --}}
            <div class="dash-header-card mb-4">
                <div class="dash-header-card-content">
                    <div class="dash-header-card-icon">
                        <i class="fas fa-school text-white"></i>
                    </div>
                    <div>
                        <h3 class="dash-header-card-title">Pengaturan Portal Sekolah</h3>
                        <p class="dash-header-card-desc">Ubah identitas, visi-misi, teks halaman, dan profil kepala sekolah UPT SPF SMPN 14 Bulukumba.</p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            <div class="bg-white overflow-hidden shadow-md rounded-xl border border-gray-100">
                <div class="p-6 sm:p-8">

                    {{-- Tabs Navigation --}}
                    <div class="flex border-b border-gray-200 mb-6 overflow-x-auto whitespace-nowrap scrollbar-thin">
                        <button type="button" onclick="switchTab('tab-identitas')" id="btn-tab-identitas" class="tab-btn py-3 px-4 text-sm font-medium border-b-2 border-blue-600 text-blue-600 focus:outline-none flex items-center">
                            <i class="fas fa-id-card mr-2"></i>Identitas Sekolah
                        </button>
                        <button type="button" onclick="switchTab('tab-kepsek')" id="btn-tab-kepsek" class="tab-btn py-3 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-blue-600 focus:outline-none flex items-center">
                            <i class="fas fa-user-tie mr-2"></i>Profil Kepala Sekolah
                        </button>
                        <button type="button" onclick="switchTab('tab-visimisi')" id="btn-tab-visimisi" class="tab-btn py-3 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-blue-600 focus:outline-none flex items-center">
                            <i class="fas fa-bullseye mr-2"></i>Visi & Misi
                        </button>
                        <button type="button" onclick="switchTab('tab-kontak')" id="btn-tab-kontak" class="tab-btn py-3 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-blue-600 focus:outline-none flex items-center">
                            <i class="fas fa-map-marked-alt mr-2"></i>Kontak & Alamat
                        </button>
                        <button type="button" onclick="switchTab('tab-teks')" id="btn-tab-teks" class="tab-btn py-3 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-blue-600 focus:outline-none flex items-center">
                            <i class="fas fa-file-alt mr-2"></i>Teks Halaman
                        </button>
                        <button type="button" onclick="switchTab('tab-foto')" id="btn-tab-foto" class="tab-btn py-3 px-4 text-sm font-medium border-b-2 border-transparent text-gray-500 hover:text-blue-600 focus:outline-none flex items-center">
                            <i class="fas fa-images mr-2"></i>Foto Website
                        </button>
                    </div>

                    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- TAB 1: IDENTITAS SEKOLAH --}}
                        <div id="tab-identitas" class="tab-content block space-y-5">
                            <h4 class="text-md font-bold text-gray-700 border-b pb-2 mb-4"><i class="fas fa-info-circle text-blue-500 mr-2"></i>Informasi Umum</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="school_name" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Nama Sekolah <span class="text-red-500">*</span></label>
                                    <input type="text" id="school_name" name="school_name" value="{{ old('school_name', $settings->school_name) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="npsn" class="block text-xs font-semibold text-gray-600 uppercase mb-1">NPSN <span class="text-red-500">*</span></label>
                                    <input type="text" id="npsn" name="npsn" value="{{ old('npsn', $settings->npsn) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                <div>
                                    <label for="akreditasi" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Akreditasi <span class="text-red-500">*</span></label>
                                    <input type="text" id="akreditasi" name="akreditasi" value="{{ old('akreditasi', $settings->akreditasi) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: A, B, C" required>
                                </div>
                                <div>
                                    <label for="kurikulum" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Kurikulum <span class="text-red-500">*</span></label>
                                    <input type="text" id="kurikulum" name="kurikulum" value="{{ old('kurikulum', $settings->kurikulum) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="status_sekolah" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Status Sekolah <span class="text-red-500">*</span></label>
                                    <select id="status_sekolah" name="status_sekolah" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                        <option value="Negeri" {{ old('status_sekolah', $settings->status_sekolah) == 'Negeri' ? 'selected' : '' }}>Negeri</option>
                                        <option value="Swasta" {{ old('status_sekolah', $settings->status_sekolah) == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label for="bentuk_pendidikan" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Bentuk Pendidikan <span class="text-red-500">*</span></label>
                                    <input type="text" id="bentuk_pendidikan" name="bentuk_pendidikan" value="{{ old('bentuk_pendidikan', $settings->bentuk_pendidikan) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: SMP" required>
                                </div>
                                <div>
                                    <label for="dapodik_link" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Link Dapodik Kemendikbud <span class="text-red-500">*</span></label>
                                    <input type="url" id="dapodik_link" name="dapodik_link" value="{{ old('dapodik_link', $settings->dapodik_link) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="kecamatan" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Kecamatan <span class="text-red-500">*</span></label>
                                    <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $settings->kecamatan) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="kabupaten" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Kabupaten/Kota <span class="text-red-500">*</span></label>
                                    <input type="text" id="kabupaten" name="kabupaten" value="{{ old('kabupaten', $settings->kabupaten) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label for="provinsi" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Provinsi <span class="text-red-500">*</span></label>
                                    <input type="text" id="provinsi" name="provinsi" value="{{ old('provinsi', $settings->provinsi) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                </div>
                            </div>

                            <h4 class="text-md font-bold text-gray-700 border-b pb-2 mb-4 mt-6"><i class="fas fa-chart-bar text-blue-500 mr-2"></i>Statistik Jumlah Siswa & Staf</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="jumlah_siswa" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Jumlah Peserta Didik (Siswa) <span class="text-red-500">*</span></label>
                                    <input type="number" id="jumlah_siswa" name="jumlah_siswa" value="{{ old('jumlah_siswa', $settings->jumlah_siswa) }}" min="0" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                    <p class="text-xxs text-gray-400 mt-1"><i class="fas fa-info-circle mr-1"></i>Angka ini akan ditampilkan secara dinamis di seksi statistik halaman depan.</p>
                                </div>
                                <div>
                                    <label for="jumlah_staff" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Jumlah Tenaga Kependidikan (Staf) <span class="text-red-500">*</span></label>
                                    <input type="number" id="jumlah_staff" name="jumlah_staff" value="{{ old('jumlah_staff', $settings->jumlah_staff) }}" min="0" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                    <p class="text-xxs text-gray-400 mt-1"><i class="fas fa-info-circle mr-1"></i>Angka ini akan ditampilkan secara dinamis di seksi statistik halaman depan.</p>
                                </div>
                            </div>
                        </div>

                        {{-- TAB 2: PROFIL KEPALA SEKOLAH --}}
                        <div id="tab-kepsek" class="tab-content hidden space-y-5">
                            <h4 class="text-md font-bold text-gray-700 border-b pb-2 mb-4"><i class="fas fa-user-circle text-blue-500 mr-2"></i>Identitas Kepala Sekolah</h4>
                            
                            <div>
                                <label for="kepsek_name" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Nama Kepala Sekolah <span class="text-red-500">*</span></label>
                                <input type="text" id="kepsek_name" name="kepsek_name" value="{{ old('kepsek_name', $settings->kepsek_name) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center mt-4">
                                <div class="col-span-1 flex flex-col items-center">
                                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Foto Saat Ini</label>
                                    <div class="w-40 h-48 border rounded-lg bg-gray-50 flex items-center justify-center overflow-hidden shadow-sm">
                                        @if($settings->kepsek_photo_path)
                                            <img src="{{ asset('storage/' . str_replace('public/', '', $settings->kepsek_photo_path)) }}" alt="Foto Kepala Sekolah" class="w-full h-full object-cover">
                                        @else
                                            <div class="text-center p-3">
                                                <i class="fas fa-user-tie text-4xl text-gray-300"></i>
                                                <p class="text-xxs text-gray-400 mt-2">Belum ada foto</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="kepsek_photo" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Unggah Foto Baru</label>
                                    <input type="file" id="kepsek_photo" name="kepsek_photo" accept="image/jpeg,image/png,image/jpg,image/webp" class="w-full text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 bg-white file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 file:cursor-pointer">
                                    <p class="text-xxs text-gray-400 mt-1"><i class="fas fa-info-circle mr-1"></i>Format yang didukung: JPG, PNG, WEBP. Maksimal ukuran file: 4MB.</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="kepsek_welcome_text" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Sambutan & Kata Pengantar <span class="text-red-500">*</span></label>
                                <textarea id="kepsek_welcome_text" name="kepsek_welcome_text" rows="6" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>{{ old('kepsek_welcome_text', $settings->kepsek_welcome_text) }}</textarea>
                                <p class="text-xxs text-gray-400 mt-1"><i class="fas fa-info-circle mr-1"></i>Sambutan ini akan ditampilkan di halaman beranda dan halaman profil sekolah.</p>
                            </div>
                        </div>

                        {{-- TAB 3: VISI & MISI --}}
                        <div id="tab-visimisi" class="tab-content hidden space-y-5">
                            <h4 class="text-md font-bold text-gray-700 border-b pb-2 mb-4"><i class="fas fa-gem text-blue-500 mr-2"></i>Arah Strategis</h4>
                            
                            <div>
                                <label for="visi" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Visi Sekolah <span class="text-red-500">*</span></label>
                                <textarea id="visi" name="visi" rows="3" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" placeholder="Tuliskan visi sekolah..." required>{{ old('visi', $settings->visi) }}</textarea>
                            </div>

                            <div class="mt-4">
                                <label for="misi" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Misi Sekolah <span class="text-red-500">*</span></label>
                                <textarea id="misi" name="misi" rows="8" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" placeholder="Tuliskan poin-poin misi sekolah. Tekan Enter untuk memisahkan setiap poin misi..." required>{{ old('misi', $settings->misi) }}</textarea>
                                <p class="text-xxs text-gray-400 mt-1"><i class="fas fa-lightbulb text-yellow-500 mr-1"></i><strong>Tips:</strong> Ketikkan setiap poin misi pada baris baru (tekan Enter). Di halaman publik, setiap baris akan otomatis dirender sebagai poin list peluru yang rapi.</p>
                            </div>
                        </div>

                        {{-- TAB 4: KONTAK & ALAMAT --}}
                        <div id="tab-kontak" class="tab-content hidden space-y-5">
                            <h4 class="text-md font-bold text-gray-700 border-b pb-2 mb-4"><i class="fas fa-address-book text-blue-500 mr-2"></i>Kontak & Hubungan Publik</h4>
                            
                            <div>
                                <label for="address" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Alamat Sekolah</label>
                                <textarea id="address" name="address" rows="3" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" placeholder="Tuliskan alamat lengkap sekolah...">{{ old('address', $settings->address) }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label for="phone" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Nomor Telepon/HP</label>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone', $settings->phone) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: 08123456789">
                                </div>
                                <div>
                                    <label for="email" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Email Sekolah</label>
                                    <input type="email" id="email" name="email" value="{{ old('email', $settings->email) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: smpn14bulukumba@gmail.com">
                                </div>
                            </div>
                        </div>
                        
                        {{-- TAB 5: TEKS HALAMAN --}}
                        <div id="tab-teks" class="tab-content hidden space-y-5">
                            <h4 class="text-md font-bold text-gray-700 border-b pb-2 mb-4"><i class="fas fa-home text-blue-500 mr-2"></i>Konten Teks Beranda</h4>
                            
                            <div>
                                <label for="hero_subtitle" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Sub-judul Slide Utama (Hero) <span class="text-red-500">*</span></label>
                                <input type="text" id="hero_subtitle" name="hero_subtitle" value="{{ old('hero_subtitle', $settings->hero_subtitle) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                            </div>

                            <div class="mt-4">
                                <label for="hero_description" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Deskripsi Slide Utama (Hero) <span class="text-red-500">*</span></label>
                                <textarea id="hero_description" name="hero_description" rows="4" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>{{ old('hero_description', $settings->hero_description) }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 gap-4 mt-6">
                                <div>
                                    <label for="about_title" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Judul Profil Singkat Beranda <span class="text-red-500">*</span></label>
                                    <input type="text" id="about_title" name="about_title" value="{{ old('about_title', $settings->about_title) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                </div>
                                <div class="mt-2">
                                    <label for="about_description" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Deskripsi Profil Singkat Beranda <span class="text-red-500">*</span></label>
                                    <textarea id="about_description" name="about_description" rows="4" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>{{ old('about_description', $settings->about_description) }}</textarea>
                                </div>
                            </div>

                            <h4 class="text-md font-bold text-gray-700 border-b pb-2 mb-4 mt-8"><i class="fas fa-history text-blue-500 mr-2"></i>Konten Teks Halaman Profil</h4>
                            
                            <div>
                                <label for="history_title" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Judul Sejarah Sekolah <span class="text-red-500">*</span></label>
                                <input type="text" id="history_title" name="history_title" value="{{ old('history_title', $settings->history_title) }}" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                            </div>

                            <div class="mt-4">
                                <label for="history_description" class="block text-xs font-semibold text-gray-600 uppercase mb-1">Artikel Sejarah Sekolah Lengkap <span class="text-red-500">*</span></label>
                                <textarea id="history_description" name="history_description" rows="10" class="w-full text-sm border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>{{ old('history_description', $settings->history_description) }}</textarea>
                                <p class="text-xxs text-gray-400 mt-1"><i class="fas fa-info-circle mr-1"></i>Anda dapat memisahkan paragraf sejarah dengan menekan tombol Enter dua kali (baris kosong). Format paragraf akan otomatis dirender rapi di halaman profil publik.</p>
                            </div>
                        </div>

                        {{-- TAB 6: FOTO WEBSITE --}}
                        <div id="tab-foto" class="tab-content hidden space-y-6">
                            <h4 class="text-md font-bold text-gray-700 border-b pb-2 mb-4"><i class="fas fa-images text-blue-500 mr-2"></i>Pengaturan Foto Banner & Carousel Halaman Publik</h4>
                            
                            <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-md text-xs text-blue-800 mb-6">
                                <div class="flex">
                                    <i class="fas fa-info-circle mr-2 text-sm mt-0.5 flex-shrink-0"></i>
                                    <div>
                                        <strong>Informasi Format Foto:</strong>
                                        <ul class="list-disc list-inside mt-1 space-y-1">
                                            <li>Dapat mengunggah foto berformat <strong>JPG, JPEG, PNG, WEBP, atau HEIC/HEIF</strong> (dari iPhone/iPad).</li>
                                            <li>Jika mengunggah format HEIC/HEIF, sistem akan mengonversinya secara otomatis ke JPEG terkompresi.</li>
                                            <li>Gunakan rasio <strong>lanskap lebar (16:9 atau lebih lebar)</strong> dan resolusi tinggi untuk tampilan terbaik pada layar besar.</li>
                                            <li>Ukuran file maksimal: <strong>10 MB</strong> per foto.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                {{-- Hero Photo 1 --}}
                                <div class="border border-gray-100 rounded-xl p-4 bg-gray-50/50 shadow-sm flex flex-col justify-between">
                                    <div>
                                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-1">Beranda Hero Slide #1</span>
                                        <div class="aspect-video w-full border rounded-lg bg-gray-100 flex items-center justify-center overflow-hidden mb-3 relative group shadow-inner">
                                            @if($settings->hero_photo_1)
                                                <img src="{{ asset('storage/' . str_replace('public/', '', $settings->hero_photo_1)) }}" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">Aktif</div>
                                            @else
                                                <img src="{{ asset('image/DSCF4229.JPG') }}" class="w-full h-full object-cover opacity-60">
                                                <div class="absolute top-2 left-2 bg-yellow-500 text-white text-2xs px-1.5 py-0.5 rounded font-medium shadow-sm">Default</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <label for="hero_photo_1" class="block text-xs font-bold text-gray-600 mb-1">Ganti Foto Slide #1</label>
                                        <input type="file" id="hero_photo_1" name="hero_photo_1" accept="image/jpeg,image/png,image/jpg,image/webp,image/heic,image/heif" class="w-full text-xs border border-gray-200 rounded bg-white file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-2xs file:font-semibold file:bg-blue-50 file:text-blue-700 file:cursor-pointer">
                                    </div>
                                </div>

                                {{-- Hero Photo 2 --}}
                                <div class="border border-gray-100 rounded-xl p-4 bg-gray-50/50 shadow-sm flex flex-col justify-between">
                                    <div>
                                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-1">Beranda Hero Slide #2</span>
                                        <div class="aspect-video w-full border rounded-lg bg-gray-100 flex items-center justify-center overflow-hidden mb-3 relative group shadow-inner">
                                            @if($settings->hero_photo_2)
                                                <img src="{{ asset('storage/' . str_replace('public/', '', $settings->hero_photo_2)) }}" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">Aktif</div>
                                            @else
                                                <img src="{{ asset('image/DSCF4231.JPG') }}" class="w-full h-full object-cover opacity-60">
                                                <div class="absolute top-2 left-2 bg-yellow-500 text-white text-2xs px-1.5 py-0.5 rounded font-medium shadow-sm">Default</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <label for="hero_photo_2" class="block text-xs font-bold text-gray-600 mb-1">Ganti Foto Slide #2</label>
                                        <input type="file" id="hero_photo_2" name="hero_photo_2" accept="image/jpeg,image/png,image/jpg,image/webp,image/heic,image/heif" class="w-full text-xs border border-gray-200 rounded bg-white file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-2xs file:font-semibold file:bg-blue-50 file:text-blue-700 file:cursor-pointer">
                                    </div>
                                </div>

                                {{-- Hero Photo 3 --}}
                                <div class="border border-gray-100 rounded-xl p-4 bg-gray-50/50 shadow-sm flex flex-col justify-between">
                                    <div>
                                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-1">Beranda Hero Slide #3</span>
                                        <div class="aspect-video w-full border rounded-lg bg-gray-100 flex items-center justify-center overflow-hidden mb-3 relative group shadow-inner">
                                            @if($settings->hero_photo_3)
                                                <img src="{{ asset('storage/' . str_replace('public/', '', $settings->hero_photo_3)) }}" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">Aktif</div>
                                            @else
                                                <img src="{{ asset('image/DSCF4258.JPG') }}" class="w-full h-full object-cover opacity-60">
                                                <div class="absolute top-2 left-2 bg-yellow-500 text-white text-2xs px-1.5 py-0.5 rounded font-medium shadow-sm">Default</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <label for="hero_photo_3" class="block text-xs font-bold text-gray-600 mb-1">Ganti Foto Slide #3</label>
                                        <input type="file" id="hero_photo_3" name="hero_photo_3" accept="image/jpeg,image/png,image/jpg,image/webp,image/heic,image/heif" class="w-full text-xs border border-gray-200 rounded bg-white file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-2xs file:font-semibold file:bg-blue-50 file:text-blue-700 file:cursor-pointer">
                                    </div>
                                </div>
                            </div>

                            <div class="border border-gray-100 rounded-xl p-6 bg-gray-50/50 shadow-sm mt-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                                    <div class="md:col-span-1">
                                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-1">Banner Halaman Profil</span>
                                        <p class="text-xxs text-gray-400 leading-relaxed">Banner utama yang tampil secara megah di bagian atas halaman profil sekolah.</p>
                                    </div>
                                    <div class="md:col-span-1">
                                        <div class="aspect-video w-full border rounded-lg bg-gray-100 flex items-center justify-center overflow-hidden relative group shadow-sm">
                                            @if($settings->profile_banner_photo)
                                                <img src="{{ asset('storage/' . str_replace('public/', '', $settings->profile_banner_photo)) }}" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold">Aktif</div>
                                            @else
                                                <img src="{{ asset('image/DSCF4258.JPG') }}" class="w-full h-full object-cover opacity-60">
                                                <div class="absolute top-2 left-2 bg-yellow-500 text-white text-2xs px-1.5 py-0.5 rounded font-medium shadow-sm">Default</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="md:col-span-1">
                                        <label for="profile_banner_photo" class="block text-xs font-bold text-gray-600 mb-1">Ganti Banner Profil</label>
                                        <input type="file" id="profile_banner_photo" name="profile_banner_photo" accept="image/jpeg,image/png,image/jpg,image/webp,image/heic,image/heif" class="w-full text-xs border border-gray-200 rounded bg-white file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-2xs file:font-semibold file:bg-blue-50 file:text-blue-700 file:cursor-pointer">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-8 pt-4 border-t border-gray-100 flex items-center justify-end space-x-3">
                            <a href="{{ route('dashboard') }}" class="py-2 px-5 text-sm font-semibold text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors flex items-center">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="py-2 px-6 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-md hover:shadow-lg transition-all flex items-center">
                                <i class="fas fa-save mr-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs Handling Javascript --}}
    <script>
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
                btn.classList.remove('border-blue-600', 'text-blue-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });

            // Activate active tab button
            const activeBtn = document.getElementById('btn-' + tabId);
            activeBtn.classList.add('border-blue-600', 'text-blue-600');
            activeBtn.classList.remove('border-transparent', 'text-gray-500');
        }
    </script>
</x-app-layout>
