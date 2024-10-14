<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mata Pelajaran Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Table Subjects --}}
                <div class="p-6 mx-5">
                    <h1 class="text-center p-6" style="font-weight: 900; font-size:30px">List Mata Pelajaran</h1>
                    <div class="mb-3">
                        <a href="{{ route('subjects.create') }}" class="btn btn-success"> Tambah Mapel </a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center align-center">#</th>
                                <th class="text-center align-center">Name</th>
                                <th class="text-center align-center">Deskripsi</th>
                                <th class="text-center align-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $subject)
                                <tr>
                                    <td class="text-center align-center">{{ $loop->iteration }}</td>
                                    <td class="text-center align-center">{{ $subject->name }}</td>
                                    <td class="text-center align-center">{!! $subject->description !!}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-primary mb-1">Edit</a>
                                            <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="color: #fff; background-color: #dc3545; border-color: #dc3545;">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center">
                        {{ $subjects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
