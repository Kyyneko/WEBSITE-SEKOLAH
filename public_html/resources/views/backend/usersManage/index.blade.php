<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-6">
                            <h2 class="text-2xl font-weight-bold mb-2">
                                <i class="fas fa-users text-primary mr-2"></i>Daftar Pengguna
                            </h2>
                            <p class="text-muted mb-0">Kelola data pengguna sistem</p>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <a href="{{ route('users.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus mr-2"></i>Tambah Pengguna
                            </a>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card border-primary shadow-sm stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-1 small text-primary font-weight-bold">Total Pengguna</p>
                                            <h3 class="mb-0 font-weight-bold text-primary">
                                                @if(method_exists($users, 'total'))
                                                    {{ $users->total() }}
                                                @else
                                                    {{ $users->count() }}
                                                @endif
                                            </h3>
                                        </div>
                                        <div class="stat-icon bg-primary">
                                            <i class="fas fa-users fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card border-success shadow-sm stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-1 small text-success font-weight-bold">Guru</p>
                                            <h3 class="mb-0 font-weight-bold text-success">
                                                {{ $users->where('role', 'teacher')->count() }}
                                            </h3>
                                        </div>
                                        <div class="stat-icon bg-success">
                                            <i class="fas fa-chalkboard-teacher fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card border-info shadow-sm stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-1 small text-info font-weight-bold">Admin</p>
                                            <h3 class="mb-0 font-weight-bold text-info">
                                                {{ $users->where('role', 'admin')->count() }}
                                            </h3>
                                        </div>
                                        <div class="stat-icon bg-info">
                                            <i class="fas fa-user-shield fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Mata Pelajaran</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
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
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-primary text-white mr-3">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <span class="font-weight-medium">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="align-middle">{{ $user->email }}</td>
                                        <td class="text-center align-middle">
                                            @if($user->role === "teacher")
                                                <span class="badge badge-success px-3 py-2" style="color: #000000;">
                                                    <i class="fas fa-chalkboard-teacher mr-1"></i>Guru
                                                </span>
                                            @else
                                                <span class="badge badge-info px-3 py-2" style="color: #000000;">
                                                    <i class="fas fa-user-shield mr-1"></i>Admin
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            @if ($user->role === "teacher")
                                                <span class="badge badge-primary px-3 py-2" style="color: #000000;">
                                                    {{ $user->subject->name }}
                                                </span>
                                            @else
                                                <span class="text-dark">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('users.edit', $user->id) }}" 
                                                   class="btn btn-sm btn-warning text-black">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger text-black">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                            <p class="text-muted mb-0">Belum ada pengguna</p>
                                            <small class="text-muted">Klik tombol "Tambah Pengguna" untuk menambahkan pengguna baru</small>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if(method_exists($users, 'links'))
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted small">
                            Menampilkan <strong>{{ $users->firstItem() ?? 0 }}</strong> 
                            sampai <strong>{{ $users->lastItem() ?? 0 }}</strong> 
                            dari <strong>
                                @if(method_exists($users, 'total'))
                                    {{ $users->total() }}
                                @else
                                    {{ $users->count() }}
                                @endif
                            </strong> pengguna
                        </div>
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>
                    @elseif($users->count() > 0)
                    <div class="text-center text-muted small mt-4">
                        Total <strong>{{ $users->count() }}</strong> pengguna
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
        }
        
        .stat-card {
            transition: transform 0.2s, box-shadow 0.2s;
            border-width: 2px;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1) !important;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.9;
        }
        
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            background-color: #f8f9fa !important;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        .badge {
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .btn-group .btn {
            margin: 0 2px;
        }
        
        .font-weight-medium {
            font-weight: 500;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
    </style>
</x-app-layout>