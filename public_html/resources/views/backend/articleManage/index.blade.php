<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Article Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 mx-5">
                   <h1 class="text-center p-6" style="font-weight: 900;font-size:30px">Article List</h1>
                    <div class="mb-3">
                        <a href="{{ route('articles.create') }}" class="btn btn-success">Add Article</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Photos</th>
                                <th class="text-center">Author</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $article->title }}</td>
                                    <td class="text-center">
                                        @foreach (json_decode($article->photo_path) as $photo)
                                            <div style="text-align: center;">
                                                <img src="{{ asset('storage/' . $photo) }}" alt="Photo" width="150" style="display: inline-block; margin: auto;">
                                            </div>
                                        @endforeach
                                    </td>

                                    <td class="text-center">{{ $article->user->name }}</td>
                                    <td class="text-center d-flex justify-content-center gap-2">
                                        <a href="{{ route('articles.edit', $article->id) }}"
                                            class="btn btn-primary mb-1">Edit</a>
                                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this article?')"
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
