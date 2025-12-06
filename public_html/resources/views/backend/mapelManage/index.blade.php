<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mata Pelajaran Management') }}
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
                                <i class="fas fa-book text-success mr-2"></i>Daftar Mata Pelajaran
                            </h2>
                            <p class="text-muted mb-0">Kelola data mata pelajaran</p>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <a href="{{ route('subjects.create') }}" class="btn btn-success btn-lg">
                                <i class="fas fa-plus mr-2"></i>Tambah Mata Pelajaran
                            </a>
                        </div>
                    </div>

                    <!-- Statistics Card -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-success shadow-sm stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-1 small text-success font-weight-bold">Total Mata Pelajaran</p>
                                            <h3 class="mb-0 font-weight-bold text-success">
                                                @if(method_exists($subjects, 'total'))
                                                    {{ $subjects->total() }}
                                                @else
                                                    {{ $subjects->count() }}
                                                @endif
                                            </h3>
                                        </div>
                                        <div class="stat-icon bg-success">
                                            <i class="fas fa-book-open fa-2x text-white"></i>
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
                                    <th width="25%">Nama Mata Pelajaran</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
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
                                            <div class="d-flex align-items-center">
                                                <div class="subject-icon bg-success text-white mr-3">
                                                    <i class="fas fa-book"></i>
                                                </div>
                                                <span class="font-weight-medium">{{ $subject->name }}</span>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="description-text">
                                                {!! Str::limit(strip_tags($subject->description), 100) !!}
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('subjects.edit', $subject->id) }}" 
                                                   class="btn btn-sm btn-warning text-white">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('subjects.destroy', $subject->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                                            <p class="text-muted mb-0">Belum ada mata pelajaran</p>
                                            <small class="text-muted">Klik tombol "Tambah Mata Pelajaran" untuk menambahkan data baru</small>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if(method_exists($subjects, 'links'))
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                        <div class="text-muted small mb-3 mb-sm-0">
                            Menampilkan <strong>{{ $subjects->firstItem() ?? 0 }}</strong> 
                            sampai <strong>{{ $subjects->lastItem() ?? 0 }}</strong> 
                            dari <strong>
                                @if(method_exists($subjects, 'total'))
                                    {{ $subjects->total() }}
                                @else
                                    {{ $subjects->count() }}
                                @endif
                            </strong> mata pelajaran
                        </div>
                        <div>
                            {{ $subjects->links() }}
                        </div>
                    </div>
                    @elseif($subjects->count() > 0)
                    <div class="text-center text-muted small mt-4">
                        Total <strong>{{ $subjects->count() }}</strong> mata pelajaran
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .subject-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
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
        
        .description-text {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.5;
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

        /* Custom scrollbar for table */
        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }
        
        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        
        .table-responsive::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 4px;
        }
        
        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }

        /* Smooth transitions */
        button, a {
            transition: all 0.2s ease-in-out;
        }
    </style>
</x-app-layout>