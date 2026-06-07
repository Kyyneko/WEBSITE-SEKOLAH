<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">{{ __('Manajemen Prestasi Sekolah') }}</h2>
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
                    <div class="dash-header-card-icon"><i class="fas fa-trophy text-white"></i></div>
                    <div>
                        <h3 class="dash-header-card-title">Prestasi Sekolah</h3>
                        <p class="dash-header-card-desc">Kelola pencapaian, penghargaan, dan medali membanggakan yang diraih oleh siswa-siswi.</p>
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
                                <div class="mgmt-stat-icon" style="background:rgba(37,99,235,0.08);color:#2563eb;"><i class="fas fa-trophy"></i></div>
                                <div>
                                    <div class="mgmt-stat-val">{{ $achievements->count() }}</div>
                                    <div class="mgmt-stat-lbl">Total Prestasi</div>
                                </div>
                            </div>
                            <div class="mgmt-stat">
                                <div class="mgmt-stat-icon" style="background:rgba(245,158,11,0.08);color:#f59e0b;"><i class="fas fa-award text-amber-500"></i></div>
                                <div>
                                    <div class="mgmt-stat-val">{{ $achievements->where('medal', 'gold')->count() }}</div>
                                    <div class="mgmt-stat-lbl">Emas / Juara 1</div>
                                </div>
                            </div>
                            <div class="mgmt-stat">
                                <div class="mgmt-stat-icon" style="background:rgba(148,163,184,0.08);color:#94a3b8;"><i class="fas fa-award text-slate-400"></i></div>
                                <div>
                                    <div class="mgmt-stat-val">{{ $achievements->where('medal', 'silver')->count() }}</div>
                                    <div class="mgmt-stat-lbl">Perak / Juara 2</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('achievements.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Prestasi
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
                                    <th class="text-center" width="5%">#</th>
                                    <th width="10%">Foto</th>
                                    <th class="text-center" width="10%">Medali</th>
                                    <th width="25%">Judul Prestasi</th>
                                    <th width="18%">Peraih (Siswa/Tim)</th>
                                    <th width="12%">Kategori</th>
                                    <th width="10%">Tanggal</th>
                                    <th class="text-center" width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($achievements as $achievement)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">
                                            <div class="w-16 h-12 rounded-md border bg-slate-50 d-flex align-items-center justify-content-center overflow-hidden shadow-sm">
                                                @if($achievement->photo_path)
                                                    <img src="{{ asset('storage/' . str_replace('public/', '', $achievement->photo_path)) }}" alt="Foto {{ $achievement->title }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full d-flex align-items-center justify-content-center bg-slate-100 text-slate-300">
                                                        <i class="fas fa-trophy text-lg"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            @if($achievement->medal == 'gold')
                                                <span class="badge bg-amber-50 text-amber-700 border border-amber-200 px-2 py-1 text-xs font-semibold">
                                                    🥇 Emas
                                                </span>
                                            @elseif($achievement->medal == 'silver')
                                                <span class="badge bg-slate-100 text-slate-700 border border-slate-200 px-2 py-1 text-xs font-semibold">
                                                    🥈 Perak
                                                </span>
                                            @else
                                                <span class="badge bg-orange-50 text-orange-700 border border-orange-200 px-2 py-1 text-xs font-semibold">
                                                    🥉 Perunggu
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex flex-column">
                                                <span style="font-weight:600;font-size:0.88rem;" class="text-slate-800">{{ $achievement->title }}</span>
                                                <small class="text-slate-400 text-xs"><i class="fas fa-map-marker-alt mr-1"></i>{{ $achievement->location }}</small>
                                            </div>
                                        </td>
                                        <td class="align-middle text-slate-700 font-medium" style="font-size: 0.85rem;">
                                            <i class="fas fa-user-circle text-slate-400 mr-1"></i>{{ $achievement->student }}
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge bg-blue-50 text-blue-700 border border-blue-100 px-2 py-1" style="font-size: 0.75rem;">
                                                {{ $achievement->category }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-slate-500" style="font-size: 0.82rem;">
                                            <i class="far fa-calendar-alt mr-1"></i>{{ $achievement->date }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('achievements.edit', $achievement->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('achievements.destroy', $achievement->id) }}" method="POST" class="d-inline" id="delete-form-{{ $achievement->id }}" onsubmit="return confirmDelete('delete-form-{{ $achievement->id }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="mgmt-empty">
                                                <i class="fas fa-trophy text-slate-300 mb-2" style="font-size:3rem;"></i>
                                                <p class="mb-1 font-semibold text-slate-500">Belum ada data prestasi</p>
                                                <small class="text-slate-400">Silakan tambahkan data prestasi untuk ditampilkan di halaman prestasi.</small>
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
