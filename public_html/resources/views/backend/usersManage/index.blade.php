<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">{{ __('Kelola Users') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mgmt-title mb-0"><i class="fas fa-users me-2"></i>Daftar Pengguna</h5>
                        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah User
                        </a>
                    </div>
                    <div class="d-flex gap-3">
                        @php
                            $totalUsers = $users->count();
                            $guruCount = $users->where('role', 'teacher')->count();
                            $adminCount = $users->where('role', 'admin')->count();
                        @endphp
                        <div class="mgmt-stat"><div class="mgmt-stat-icon" style="background:rgba(37,99,235,0.08);color:#2563eb;"><i class="fas fa-users"></i></div><div><div class="mgmt-stat-val">{{ $totalUsers }}</div><div class="mgmt-stat-lbl">Total</div></div></div>
                        <div class="mgmt-stat"><div class="mgmt-stat-icon" style="background:rgba(16,185,129,0.08);color:#059669;"><i class="fas fa-chalkboard-teacher"></i></div><div><div class="mgmt-stat-val">{{ $guruCount }}</div><div class="mgmt-stat-lbl">Guru</div></div></div>
                        <div class="mgmt-stat"><div class="mgmt-stat-icon" style="background:rgba(124,58,237,0.08);color:#7c3aed;"><i class="fas fa-shield-alt"></i></div><div><div class="mgmt-stat-val">{{ $adminCount }}</div><div class="mgmt-stat-lbl">Admin</div></div></div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead><tr>
                                <th class="text-center" width="5%">#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th class="text-center">Jabatan</th>
                                <th class="text-center">Mata Pelajaran</th>
                                <th class="text-center" width="12%">Aksi</th>
                            </tr></thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="text-center align-middle">
                                            @if(method_exists($users, 'currentPage'))
                                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                            @else
                                                {{ $loop->iteration }}
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="mgmt-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                                <span style="font-weight:600;font-size:0.84rem;">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="align-middle" style="font-size:0.82rem;color:var(--dash-text-light);">{{ $user->email }}</td>
                                        <td class="text-center align-middle">
                                            @if($user->role === "teacher")
                                                <span class="badge badge-success"><i class="fas fa-chalkboard-teacher me-1"></i>Guru</span>
                                            @else
                                                <span class="badge badge-primary"><i class="fas fa-shield-alt me-1"></i>Admin</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            @if ($user->role === "teacher" && $user->subject)
                                                <span class="badge badge-info">{{ $user->subject->name }}</span>
                                            @else
                                                <span style="color:#cbd5e1;">—</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" id="delete-form-{{ $user->id }}" onsubmit="return confirmDelete('delete-form-{{ $user->id }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center py-5"><div class="mgmt-empty"><i class="fas fa-users"></i><p>Belum ada pengguna</p></div></td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3" style="border-top:1px solid var(--dash-border);">
                            <small style="color:var(--dash-text-light);">Menampilkan <strong>{{ $users->firstItem() ?? 0 }}</strong> – <strong>{{ $users->lastItem() ?? 0 }}</strong> dari <strong>{{ $users->total() }}</strong></small>
                            <div>{{ $users->links() }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>