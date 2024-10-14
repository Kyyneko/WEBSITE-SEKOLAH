<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Organisasi Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-center p-6 font-bold text-2xl">Organisasi List</h1>
                    <div class="mb-3">
                        <a href="{{ route('organisasi.create') }}" class="btn btn-success">Add Organisasi</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Deskripsi</th>
                                <th class="text-center">Photos</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($organisasis as $organisasi)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $organisasi->nama }}</td>
                                    <td class="text-center">{!! $organisasi->description !!}</td>
                                    <td class="text-center">
                                        @if ($organisasi->photo_path)
                                            @foreach (json_decode($organisasi->photo_path) as $photo)
                                                <div style="text-align: center;">
                                                    <img src="{{ asset('storage/' . $photo) }}"
                                                        alt="Photo" width="200"
                                                        style="display: inline-block; margin: auto;">
                                                </div>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="text-center d-flex justify-content-center gap-2">
                                        <a href="{{ route('organisasi.edit', $organisasi->id) }}"
                                            class="btn btn-primary mb-1">Edit</a>
                                        <form action="{{ route('organisasi.destroy', $organisasi->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this organisasi?')"
                                                style="color: #fff;">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
