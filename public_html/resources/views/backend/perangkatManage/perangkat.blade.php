<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Form File --}}
                <div class="form-group row p-6 mx-5">
                    <h1 class="text-center my-6" style="font-weight: 900; font-size: 30px;">Upload Dokumen</h1>
                    <form action="/upload" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="file" class="text-center block mb-4 text-gray-700">Pilih File
                            (PDF/Word):</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="file"
                                class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md cursor-pointer hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                <span class="text-base leading-normal text-gray-700">Pilih File</span>
                                <input type="file" id="file" name="file" class="hidden"
                                    accept=".pdf,.doc,.docx">
                            </label>
                            <span id="file-name" class="ml-4"></span>
                        </div>
                       <div class="text-center"> <!-- Tambahkan kelas text-center untuk menengahkan tombol -->
                            <button class="btn btn-success py-2 mt-2 px-4 rounded-md text-base font-medium text-black bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" style="margin-left:-18px" type="submit">Upload</button>
                        </div>
                    </form>
                </div>

                {{-- Table Dokumen untuk File Admin --}}
                <div class="p-6 mx-5">
                    <h1 class="text-center p-6" style="font-weight: 900;font-size:30px">
                        @if (auth()->user()->role == 'admin')
                            File Yang Anda Upload
                        @else
                            File Dari Admin
                        @endif

                    </h1>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Dokumen</th>
                                    <th class="text-center">Uploader</th>
                                    <th class="text-center">Waktu Upload</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($adminDocuments)
                                    @foreach ($adminDocuments as $document)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ substr(basename($document->file_path), 11) }}</td>
                                        
                                            @if (auth()->user()->role == 'admin')
                                                <td class="text-center">{{ $document->user->name }}</td>
                                            @else
                                                <td class="text-center">Admin</td>
                                            @endif
                                            
                                            <td class="text-center">{{ $document->created_at->diffForHumans() }}</td>
                                            <td class="d-flex gap-1 justify-content-center">
                                                @if (auth()->user()->role == 'admin')
                                                    <form action="{{ route('documents.destroy', $document->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="color: black"
                                                            class="btn btn-danger">Delete</button>
                                                    </form>
                                                @else
                                                
                                                @endif

                                                <a href="{{ route('documents.download', $document->id) }}"
                                                    class="btn btn-primary">Download</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Table Dokumen untuk File Non-Admin --}}
                <div class="p-6 mx-5">
                    <h1 class="text-center p-6" style="font-weight: 900;font-size:30px">
                        @if (auth()->user()->role == 'admin')
                            File Yang Telah Di Upload User
                        @else
                            File Yang Anda Upload
                        @endif

                    </h1>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Dokumen</th>
                                    <th>Uploader</th>
                                    <th>Waktu Upload</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($nonAdminDocuments)
                                    @foreach ($nonAdminDocuments as $document)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ substr(basename($document->file_path), 22) }}</td>
                                            <td>{{ $document->user->name }}</td>
                                            <td>{{ $document->created_at->diffForHumans() }}</td>
                                            <td class="d-flex gap-1 justify-content-center">
                                                @if (auth()->user()->role == 'teacher')
                                                    <form action="{{ route('documents.destroy', $document->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="color: black"
                                                            class="btn btn-danger">Delete</button>
                                                    </form>
                                                @else
                                                
                                                @endif
                                                <a href="{{ route('documents.download', $document->id) }}"
                                                    class="btn btn-primary">Download</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
    <script>
        document.getElementById('file').addEventListener('change', function() {
            const fileName = this.files[0].name;
            document.getElementById('file-name').textContent = fileName;
        });
    </script>

</x-app-layout>
