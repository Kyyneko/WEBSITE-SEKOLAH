<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">{{ __('Manajemen Fasilitas Sekolah') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            {{-- Header Card --}}
            <div class="dash-header-card mb-4">
                <div class="dash-header-card-content">
                    <div class="dash-header-card-icon"><i class="fas fa-building text-white"></i></div>
                    <div>
                        <h3 class="dash-header-card-title">Fasilitas Sekolah</h3>
                        <p class="dash-header-card-desc">Kelola sarana dan prasarana penunjang kegiatan belajar mengajar yang ada di sekolah.</p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            {{-- Stats & Action Header --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div class="d-flex gap-3 flex-wrap">
                            <div class="mgmt-stat">
                                <div class="mgmt-stat-icon" style="background:rgba(37,99,235,0.08);color:#2563eb;"><i class="fas fa-building"></i></div>
                                <div>
                                    <div class="mgmt-stat-val">{{ $facilities->count() }}</div>
                                    <div class="mgmt-stat-lbl">Total Fasilitas</div>
                                </div>
                            </div>
                            <div class="mgmt-stat">
                                <div class="mgmt-stat-icon" style="background:rgba(16,185,129,0.08);color:#10b981;"><i class="fas fa-microscope"></i></div>
                                <div>
                                    <div class="mgmt-stat-val">{{ $facilities->where('category', 'Akademik')->count() }}</div>
                                    <div class="mgmt-stat-lbl">Akademik</div>
                                </div>
                            </div>
                            <div class="mgmt-stat">
                                <div class="mgmt-stat-icon" style="background:rgba(245,158,11,0.08);color:#f59e0b;"><i class="fas fa-laptop"></i></div>
                                <div>
                                    <div class="mgmt-stat-val">{{ $facilities->where('category', 'Teknologi')->count() }}</div>
                                    <div class="mgmt-stat-lbl">Teknologi</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('facilities.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Fasilitas
                        </a>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="6%">#</th>
                                    <th width="12%">Foto</th>
                                    <th width="25%">Nama Fasilitas</th>
                                    <th width="15%">Kategori</th>
                                    <th width="28%">Fitur Penunjang</th>
                                    <th class="text-center" width="14%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($facilities as $facility)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">
                                            <div class="w-16 h-12 rounded-md border bg-slate-50 d-flex align-items-center justify-content-center overflow-hidden shadow-sm">
                                                @if($facility->photo_path)
                                                    <img src="{{ asset('storage/' . str_replace('public/', '', $facility->photo_path)) }}" alt="Foto {{ $facility->name }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full d-flex align-items-center justify-content-center bg-slate-100 text-slate-300">
                                                        <i class="fas fa-building text-lg"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex flex-column">
                                                <span style="font-weight:600;font-size:0.88rem;" class="text-slate-800">{{ $facility->name }}</span>
                                                <small class="text-slate-400 text-xs text-truncate" style="max-width: 250px;">{{ Str::limit($facility->description, 50) }}</small>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge bg-slate-100 text-slate-700 border border-slate-200 px-2 py-1" style="font-size: 0.75rem;">
                                                {{ $facility->category }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            @if($facility->features && is_array($facility->features))
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach($facility->features as $feature)
                                                        <span class="badge bg-blue-50 text-blue-700 border border-blue-100 px-2 py-1 text-xs" style="font-size: 0.7rem;">
                                                            <i class="fas fa-check text-xxs mr-1"></i>{{ $feature }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-slate-400 italic text-xs">Tidak ada fitur</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('facilities.edit', $facility->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('facilities.destroy', $facility->id) }}" method="POST" class="d-inline" id="delete-form-{{ $facility->id }}" onsubmit="return confirmDelete('delete-form-{{ $facility->id }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="mgmt-empty">
                                                <i class="fas fa-building text-slate-300 mb-2" style="font-size:3rem;"></i>
                                                <p class="mb-1 font-semibold text-slate-500">Belum ada data fasilitas</p>
                                                <small class="text-slate-400">Silakan tambahkan data untuk ditampilkan di halaman fasilitas.</small>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
