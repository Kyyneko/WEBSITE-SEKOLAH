<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">{{ __('Mata Pelajaran') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mgmt-title mb-0"><i class="fas fa-book me-2"></i>Daftar Mata Pelajaran</h5>
                        <a href="{{ route('subjects.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Mapel
                        </a>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="mgmt-stat">
                            <div class="mgmt-stat-icon" style="background:rgba(245,158,11,0.08);color:#d97706;"><i class="fas fa-book"></i></div>
                            <div>
                                <div class="mgmt-stat-val">{{ $subjects->count() }}</div>
                                <div class="mgmt-stat-lbl">Total Mapel</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead><tr>
                                <th class="text-center" width="5%">#</th>
                                <th width="30%">Nama Mata Pelajaran</th>
                                <th>Deskripsi</th>
                                <th class="text-center" width="12%">Aksi</th>
                            </tr></thead>
                            <tbody>
                                @forelse ($subjects as $subject)
                                    <tr>
                                        <td class="text-center align-middle">
                                            @if(method_exists($subjects, 'currentPage'))
                                                {{ ($subjects->currentPage() - 1) * $subjects->perPage() + $loop->iteration }}
                                            @else
                                                {{ $loop->iteration }}
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="mgmt-icon" style="background:rgba(245,158,11,0.08);color:#d97706;"><i class="fas fa-book"></i></div>
                                                <span style="font-weight:600;font-size:0.84rem;">{{ $subject->name }}</span>
                                            </div>
                                        </td>
                                        <td class="align-middle" style="font-size:0.82rem;color:var(--dash-text-light);">
                                            {!! Str::limit(strip_tags($subject->description), 100) !!}
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline" id="delete-form-{{ $subject->id }}" onsubmit="return confirmDelete('delete-form-{{ $subject->id }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center py-5"><div class="mgmt-empty"><i class="fas fa-book"></i><p>Belum ada mata pelajaran</p></div></td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if(method_exists($subjects, 'links') && $subjects instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3" style="border-top:1px solid var(--dash-border);">
                            <small style="color:var(--dash-text-light);">Menampilkan <strong>{{ $subjects->firstItem() ?? 0 }}</strong> – <strong>{{ $subjects->lastItem() ?? 0 }}</strong> dari <strong>{{ $subjects->total() }}</strong></small>
                            <div>{{ $subjects->links() }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>