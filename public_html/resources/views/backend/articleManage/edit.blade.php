<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('articles.update', $article->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ $article->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <!-- Trix Editor -->
                            <input id="description" type="hidden" name="description"
                                value="{{ $article->description }}">
                            <trix-editor input="description"></trix-editor>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Existing Photos</label>
                            @if ($article->photo_path)
                                @foreach (json_decode($article->photo_path) as $photo)
                                    <div class="p-2">
                                        <img src="{{ asset('storage/' . $photo) }}" alt="Photo"
                                            width="200" style="display: inline-block; margin: auto;">
                                        <input type="checkbox" name="delete_photos[]" value="{{ $photo }}">
                                        Delete
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="new_photo" class="form-label">New Photos</label>
                            <input type="file" class="form-control" id="new_photo" name="new_photo[]" multiple>
                        </div>


                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
