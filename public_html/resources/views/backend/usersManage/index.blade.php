<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Table Users --}}
                <div class="p-6 mx-5">
                    <h1 class="text-center p-6" style="font-weight: 900;font-size:30px">User List</h1>
                    <div class="mb-3">
                        <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Jabatan</th>
                                <th class="text-center">Mata Pelajaran</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center" style="padding-top:8px">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    
                                    <td class="text-center text-uppercase">
                                        @if($user->role === "teacher")
                                        {{ $user->role }}
                                        @else
                                        Admin
                                        @endif
                                        </td>
                                    <td class="text-center">
                                        @if ($user->role === "teacher")
                                            {{ $user->subject->name }}
                                        @else
                                            Admin
                                        @endif
                                    </td>

                                    <td class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                style="color: #fff; background-color: #dc3545; border-color: #dc3545;">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
