<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">{{ __('Kelola Organisasi') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mgmt-title mb-0"><i class="fas fa-sitemap me-2"></i>Daftar Organisasi</h5>
                        <a href="{{ route('organisasi.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Organisasi
                        </a>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="mgmt-stat">
                            <div class="mgmt-stat-icon" style="background:rgba(124,58,237,0.08);color:#7c3aed;"><i class="fas fa-sitemap"></i></div>
                            <div><div class="mgmt-stat-val">{{ $organisasis->count() }}</div><div class="mgmt-stat-lbl">Total Organisasi</div></div>
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
                                <th width="20%">Nama</th>
                                <th width="35%">Deskripsi</th>
                                <th class="text-center" width="15%">Foto</th>
                                <th class="text-center" width="12%">Aksi</th>
                            </tr></thead>
                            <tbody>
                                @forelse ($organisasis as $organisasi)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="mgmt-icon" style="background:rgba(124,58,237,0.08);color:#7c3aed;"><i class="fas fa-sitemap"></i></div>
                                                <span style="font-weight:600;font-size:0.84rem;">{{ $organisasi->nama }}</span>
                                            </div>
                                        </td>
                                        <td class="align-middle" style="font-size:0.82rem;color:var(--dash-text-light);">
                                            {!! Str::limit(strip_tags($organisasi->description), 100) !!}
                                        </td>
                                        <td class="text-center align-middle">
                                            @if ($organisasi->photo_path)
                                                @php
                                                    $photos = json_decode($organisasi->photo_path);
                                                    $photoCount = is_array($photos) ? count($photos) : 0;
                                                @endphp
                                                @if($photoCount > 0)
                                                    @php
                                                        $firstPhoto = $photos[0];
                                                        if (str_starts_with($firstPhoto, 'public/organisasi_photos/')) {
                                                            $imageUrl = asset('storage/' . str_replace('public/', '', $firstPhoto));
                                                        } elseif (str_starts_with($firstPhoto, 'public/image/')) {
                                                            $imageUrl = asset(str_replace('public/', '', $firstPhoto));
                                                        } elseif (str_starts_with($firstPhoto, 'organisasi_photos/')) {
                                                            $imageUrl = asset('storage/' . $firstPhoto);
                                                        } elseif (str_starts_with($firstPhoto, 'image/')) {
                                                            $imageUrl = asset($firstPhoto);
                                                        } else {
                                                            $imageUrl = asset('storage/' . $firstPhoto);
                                                        }
                                                    @endphp
                                                    <div style="position:relative;display:inline-block;">
                                                        <img src="{{ $imageUrl }}" alt="{{ $organisasi->nama }}" 
                                                             style="width:64px;height:48px;object-fit:cover;border-radius:6px;border:1.5px solid var(--dash-border);"
                                                             onerror="this.src='{{ asset('image/placeholder-org.png') }}';">
                                                        @if($photoCount > 1)
                                                            <span style="position:absolute;bottom:-4px;right:-6px;background:var(--dash-primary-light);color:#fff;font-size:0.6rem;font-weight:700;padding:0.1rem 0.35rem;border-radius:4px;">+{{ $photoCount - 1 }}</span>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="mgmt-no-photo"><i class="fas fa-image"></i></div>
                                                @endif
                                            @else
                                                <div class="mgmt-no-photo"><i class="fas fa-image"></i></div>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('organisasi.edit', $organisasi->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('organisasi.destroy', $organisasi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus organisasi ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center py-5"><div class="mgmt-empty"><i class="fas fa-sitemap"></i><p>Belum ada organisasi</p></div></td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if(method_exists($organisasis, 'links'))
                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3" style="border-top:1px solid var(--dash-border);">
                            <small style="color:var(--dash-text-light);">Menampilkan <strong>{{ $organisasis->firstItem() ?? 0 }}</strong> – <strong>{{ $organisasis->lastItem() ?? 0 }}</strong> dari <strong>{{ $organisasis->total() }}</strong></small>
                            <div>{{ $organisasis->links() }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
