<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ads Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-center p-6 font-bold text-2xl">Ads List</h1>
                    <div class="mb-3">
                        <a href="{{ route('ads.create') }}" class="btn btn-success">Add Ad</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Photo</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ads as $ad)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $ad->title }}</td>
                                    <td class="text-center">
                                        <img 
                                            src="{{ asset('storage/' . $ad->photo_path) }}" alt=""
                                            width="200">
                                    </td>
                                    <td class="text-center">{!! $ad->description !!}</td>
                                    <td class="text-center d-flex justify-content-center gap-2">
                                        <a href="{{ route('ads.edit', $ad->id) }}" class="btn btn-primary mb-1">Edit</a>
                                        <form action="{{ route('ads.destroy', $ad->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this ad?')"
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
