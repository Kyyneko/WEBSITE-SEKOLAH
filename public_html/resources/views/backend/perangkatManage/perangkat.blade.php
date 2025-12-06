<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Upload Section --}}
            <div class="bg-white border border-slate-200/70 overflow-hidden shadow-sm sm:rounded-xl mb-8">
                <div class="p-6 sm:p-8">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-2">
                            <i class="fas fa-cloud-upload-alt mr-2"></i>
                            Upload Dokumen
                        </h2>
                        <p class="text-slate-500 text-sm sm:text-base">
                            Unggah file PDF atau Word untuk dibagikan
                        </p>
                    </div>

                    <form action="/upload" method="POST" enctype="multipart/form-data" class="max-w-2xl mx-auto space-y-6">
                        @csrf

                        <div>
                            <label for="file" class="block text-sm font-semibold text-slate-700 mb-2">
                                Pilih File (PDF/Word)
                            </label>

                            <div class="flex flex-col items-center justify-center w-full">
                                <label for="file"
                                       class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed rounded-xl cursor-pointer bg-slate-50 border-slate-300 hover:bg-slate-100 hover:border-blue-400 transition-all duration-200">
                                    <div class="flex flex-col items-center justify-center pt-4 pb-5 text-center px-4">
                                        <svg class="w-12 h-12 mb-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <p class="mb-1 text-sm text-slate-600">
                                            <span class="font-semibold text-slate-700">Klik untuk upload</span> atau drag and drop
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            PDF, DOC, atau DOCX (MAX. 10MB)
                                        </p>
                                    </div>
                                    <input type="file" id="file" name="file" class="hidden" accept=".pdf,.doc,.docx">
                                </label>

                                <div id="file-selected" class="mt-4 hidden w-full">
                                    <div class="flex items-center p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                        <svg class="w-8 h-8 text-blue-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-semibold text-slate-700 uppercase tracking-wide">
                                                File terpilih
                                            </p>
                                            <p id="file-name" class="text-sm text-slate-700 truncate"></p>
                                        </div>
                                        <button type="button" id="remove-file"
                                                class="ml-3 text-red-500 hover:text-red-600 transition-colors">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                      clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-black hover:bg-blue-700 text-white text-sm sm:text-base font-semibold rounded-lg shadow-md transition-all duration-200 transform hover:scale-[1.02]">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                Upload Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Table Dokumen untuk File Admin --}}
            <div class="bg-white border border-slate-200/70 overflow-hidden shadow-sm sm:rounded-xl mb-8">
                <div class="p-6 sm:p-8">
                    <div class="mb-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-slate-800 mb-1 flex items-center">
                            <i class="fas fa-folder text-yellow-500 mr-2"></i>
                            @if (auth()->user()->role == 'admin')
                                File Yang Anda Upload
                            @else
                                File Dari Admin
                            @endif
                        </h2>
                        <p class="text-slate-500 text-sm">
                            Daftar dokumen yang telah diunggah oleh admin
                        </p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm divide-y divide-slate-200">
                            <thead class="bg-slate-100/80">
                                <tr>
                                    <th class="px-6 py-3 text-left text-[0.7rem] font-semibold text-slate-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-left text-[0.7rem] font-semibold text-slate-500 uppercase tracking-wider">Nama Dokumen</th>
                                    <th class="px-6 py-3 text-center text-[0.7rem] font-semibold text-slate-500 uppercase tracking-wider">Uploader</th>
                                    <th class="px-6 py-3 text-center text-[0.7rem] font-semibold text-slate-500 uppercase tracking-wider">Waktu Upload</th>
                                    <th class="px-6 py-3 text-center text-[0.7rem] font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @if ($adminDocuments && count($adminDocuments) > 0)
                                    @foreach ($adminDocuments as $document)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-800">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 text-slate-800">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                              d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                              clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="truncate max-w-[260px] sm:max-w-xs">
                                                        {{ substr(basename($document->file_path), 11) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                @if (auth()->user()->role == 'admin')
                                                    <span class="inline-flex px-2.5 py-1 bg-blue-50 text-blue-700 border border-blue-100 rounded-full text-xs font-semibold">
                                                        {{ $document->user->name }}
                                                    </span>
                                                @else
                                                    <span class="inline-flex px-2.5 py-1 bg-purple-50 text-purple-700 border border-purple-100 rounded-full text-xs font-semibold">
                                                        Admin
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 text-center">
                                                {{ $document->created_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    @if (auth()->user()->role == 'admin')
                                                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-[0.7rem] font-semibold rounded-md transition-colors"
                                                                    onclick="return confirm('Yakin ingin menghapus dokumen ini?')">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    @endif

                                                    <a href="{{ route('documents.download', $document->id) }}"
                                                       class="inline-flex items-center px-3 py-2 bg-red-600 hover:!bg-blue-700 text-white text-[0.7rem] font-semibold rounded-md transition-colors">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                        </svg>
                                                        Download
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                            <div class="inline-flex flex-col items-center">
                                                <svg class="w-16 h-16 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="text-base font-semibold mb-1">Belum ada dokumen</p>
                                                <p class="text-sm">Dokumen yang diunggah akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Table Dokumen untuk File Non-Admin --}}
            <div class="bg-white border border-slate-200/70 overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-6 sm:p-8">
                    <div class="mb-6">
                        <h2 class="text-xl sm:text-2xl font-bold text-slate-800 mb-1 flex items-center">
                            <i class="fas fa-users text-green-500 mr-2"></i>
                            @if (auth()->user()->role == 'admin')
                                File Yang Telah Di Upload User
                            @else
                                File Yang Anda Upload
                            @endif
                        </h2>
                        <p class="text-slate-500 text-sm">
                            Daftar dokumen yang telah diunggah oleh pengguna
                        </p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm divide-y divide-slate-200">
                            <thead class="bg-slate-100/80">
                                <tr>
                                    <th class="px-6 py-3 text-left text-[0.7rem] font-semibold text-slate-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-left text-[0.7rem] font-semibold text-slate-500 uppercase tracking-wider">Nama Dokumen</th>
                                    <th class="px-6 py-3 text-left text-[0.7rem] font-semibold text-slate-500 uppercase tracking-wider">Uploader</th>
                                    <th class="px-6 py-3 text-center text-[0.7rem] font-semibold text-slate-500 uppercase tracking-wider">Waktu Upload</th>
                                    <th class="px-6 py-3 text-center text-[0.7rem] font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @if ($nonAdminDocuments && count($nonAdminDocuments) > 0)
                                    @foreach ($nonAdminDocuments as $document)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-800">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 text-slate-800">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 text-emerald-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                              d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                              clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="truncate max-w-[260px] sm:max-w-xs">
                                                        {{ substr(basename($document->file_path), 22) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-800">
                                                <span class="inline-flex px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-full text-xs font-semibold">
                                                    {{ $document->user->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 text-center">
                                                {{ $document->created_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    @if (auth()->user()->role == 'teacher')
                                                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-[0.7rem] font-semibold rounded-md transition-colors"
                                                                    onclick="return confirm('Yakin ingin menghapus dokumen ini?')">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    @endif

                                                    <a href="{{ route('documents.download', $document->id) }}"
                                                       class="inline-flex items-center px-3 py-2 bg-red-600 hover:!bg-blue-700 text-white text-[0.7rem] font-semibold rounded-md transition-colors">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                        </svg>
                                                        Download
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                            <div class="inline-flex flex-col items-center">
                                                <svg class="w-16 h-16 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="text-base font-semibold mb-1">Belum ada dokumen</p>
                                                <p class="text-sm">Dokumen yang diunggah akan muncul di sini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // File input handler (dikasih guard biar aman kalau element tidak ketemu)
        document.addEventListener('DOMContentLoaded', () => {
            const fileInput = document.getElementById('file');
            const fileSelected = document.getElementById('file-selected');
            const fileName = document.getElementById('file-name');
            const removeFileBtn = document.getElementById('remove-file');

            if (!fileInput || !fileSelected || !fileName || !removeFileBtn) return;

            fileInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    fileName.textContent = this.files[0].name;
                    fileSelected.classList.remove('hidden');
                }
            });

            removeFileBtn.addEventListener('click', function () {
                fileInput.value = '';
                fileSelected.classList.add('hidden');
                fileName.textContent = '';
            });
        });
    </script>

    <style>
        /* Custom scrollbar for tables */
        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</x-app-layout>