<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">{{ __('Kelola Pengumuman') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mgmt-title mb-0"><i class="fas fa-bullhorn me-2"></i>Daftar Pengumuman</h5>
                        <a href="{{ route('ads.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Pengumuman
                        </a>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="mgmt-stat">
                            <div class="mgmt-stat-icon" style="background:rgba(239,68,68,0.08);color:#dc2626;"><i class="fas fa-bullhorn"></i></div>
                            <div><div class="mgmt-stat-val">{{ $ads->count() }}</div><div class="mgmt-stat-lbl">Total Pengumuman</div></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    @forelse ($ads as $ad)
                        <div class="ads-card mb-3">
                            <div class="row g-0">
                                <div class="col-md-3">
                                    <div class="ads-img-wrap">
                                        @if($ad->photo_path)
                                            @php
                                                $photoPath = $ad->photo_path;
                                                if (str_starts_with($photoPath, 'public/ads_photos/')) {
                                                    $imageUrl = asset('storage/' . str_replace('public/', '', $photoPath));
                                                } elseif (str_starts_with($photoPath, 'public/image/')) {
                                                    $imageUrl = asset(str_replace('public/', '', $photoPath));
                                                } elseif (str_starts_with($photoPath, 'ads_photos/')) {
                                                    $imageUrl = asset('storage/' . $photoPath);
                                                } elseif (str_starts_with($photoPath, 'image/')) {
                                                    $imageUrl = asset($photoPath);
                                                } else {
                                                    $imageUrl = asset('storage/' . $photoPath);
                                                }
                                            @endphp
                                            <img src="{{ $imageUrl }}" alt="{{ $ad->title }}" class="ads-img"
                                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                            <div class="ads-img-fallback" style="display:none;">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @else
                                            <div class="ads-img-fallback">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="ads-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="ads-title">{{ $ad->title }}</h6>
                                                <div class="ads-desc">{!! Str::limit(strip_tags($ad->description), 150) !!}</div>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-1 mt-auto pt-2">
                                            <a href="{{ route('ads.edit', $ad->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit me-1"></i>Edit</a>
                                            <form action="{{ route('ads.destroy', $ad->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengumuman ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash me-1"></i>Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <div class="mgmt-empty">
                                <i class="fas fa-bullhorn"></i>
                                <p>Belum ada pengumuman</p>
                                <a href="{{ route('ads.create') }}" class="btn btn-primary btn-sm mt-2"><i class="fas fa-plus me-1"></i> Tambah Pengumuman</a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .ads-card {
            border: 1px solid var(--dash-border);
            border-radius: var(--dash-radius-sm);
            overflow: hidden;
            transition: all 0.2s ease;
        }
        .ads-card:hover {
            box-shadow: 0 3px 10px rgba(0,0,0,0.06);
        }
        .ads-img-wrap {
            height: 100%;
            min-height: 140px;
            background: var(--dash-bg);
        }
        .ads-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            min-height: 140px;
        }
        .ads-img-fallback {
            height: 100%;
            min-height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 2rem;
            background: var(--dash-bg);
        }
        .ads-body {
            padding: 1rem 1.25rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .ads-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--dash-text);
            margin-bottom: 0.35rem;
        }
        .ads-desc {
            font-size: 0.8rem;
            color: var(--dash-text-light);
            line-height: 1.5;
        }
    </style>
    @endpush
</x-app-layout>
