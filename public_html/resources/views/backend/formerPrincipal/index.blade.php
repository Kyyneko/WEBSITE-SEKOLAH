<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">{{ __('Mantan Kepala Sekolah') }}</h2>
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
                    <div class="dash-header-card-icon"><i class="fas fa-history text-white"></i></div>
                    <div>
                        <h3 class="dash-header-card-title">Mantan Kepala Sekolah</h3>
                        <p class="dash-header-card-desc">Kelola data deretan mantan kepala sekolah yang pernah memimpin UPT SPF SMPN 14 Bulukumba.</p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            {{-- Stats & Action Header --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div class="d-flex gap-3">
                            <div class="mgmt-stat">
                                <div class="mgmt-stat-icon" style="background:rgba(37,99,235,0.08);color:#2563eb;"><i class="fas fa-user-tie"></i></div>
                                <div>
                                    <div class="mgmt-stat-val">{{ $principals->count() }}</div>
                                    <div class="mgmt-stat-lbl">Total Mantan Kepsek</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('former-principals.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Mantan Kepsek
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
                                    <th width="10%">Foto</th>
                                    <th width="35%">Nama Lengkap</th>
                                    <th width="35%">Masa Jabatan (Periode)</th>
                                    <th class="text-center" width="14%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($principals as $principal)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">
                                            <div class="w-12 h-14 rounded-md border bg-slate-50 d-flex align-items-center justify-content-center overflow-hidden shadow-sm">
                                                @if($principal->photo_path)
                                                    <img src="{{ asset('storage/' . str_replace('public/', '', $principal->photo_path)) }}" alt="Foto {{ $principal->name }}" class="w-full h-full object-cover">
                                                @else
                                                    <i class="fas fa-user-tie text-slate-300 text-lg"></i>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <span style="font-weight:600;font-size:0.88rem;" class="text-slate-800">{{ $principal->name }}</span>
                                        </td>
                                        <td class="align-middle" style="font-size:0.85rem;color:var(--dash-text-light);">
                                            @if($principal->period)
                                                <span class="badge bg-blue-50 text-blue-700 border border-blue-200 px-2 py-1"><i class="far fa-calendar-alt mr-1"></i>{{ $principal->period }}</span>
                                            @else
                                                <span class="text-slate-400 italic">Masa jabatan belum diatur</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('former-principals.edit', $principal->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                                 <form action="{{ route('former-principals.destroy', $principal->id) }}" method="POST" class="d-inline" id="delete-form-{{ $principal->id }}" onsubmit="return confirmDelete('delete-form-{{ $principal->id }}')">
                                                     @csrf @method('DELETE')
                                                     <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                                 </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="mgmt-empty">
                                                <i class="fas fa-history text-slate-300 mb-2" style="font-size:3rem;"></i>
                                                <p class="mb-1 font-semibold text-slate-500">Belum ada mantan kepala sekolah</p>
                                                <small class="text-slate-400">Silakan tambahkan data untuk ditampilkan di halaman profil.</small>
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
