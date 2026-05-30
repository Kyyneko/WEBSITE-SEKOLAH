<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Perangkat Pembelajaran') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

            {{-- Page Header Card --}}
            <div class="dash-header-card mb-4">
                <div class="dash-header-card-content">
                    <div class="dash-header-card-icon">
                        <i class="fas fa-folder text-white"></i>
                    </div>
                    <div>
                        <h3 class="dash-header-card-title">Perangkat Pembelajaran</h3>
                        <p class="dash-header-card-desc">Unggah dan kelola berkas/dokumen perangkat pembelajaran resmi sekolah.</p>
                    </div>
                </div>
                <div class="dash-header-card-deco1"></div>
                <div class="dash-header-card-deco2"></div>
            </div>

            {{-- Upload Section --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-4">
                    <h5 class="perangkat-section-title mb-3">
                        <i class="fas fa-cloud-upload-alt me-2"></i>Upload Dokumen
                    </h5>

                    <form action="/upload" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="perangkat-upload-row">
                            <label for="file" class="perangkat-upload-zone mb-0" id="uploadZone">
                                <div class="perangkat-upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div>
                                    <div class="perangkat-upload-text">
                                        <strong>Klik untuk pilih file</strong> atau drag & drop
                                    </div>
                                    <div class="perangkat-upload-hint">PDF, DOC, DOCX, XLS, XLSX — Maks. 10MB</div>
                                </div>
                                <input type="file" id="file" name="file" style="display:none" accept=".pdf,.doc,.docx,.xls,.xlsx">
                            </label>
                            <button type="submit" class="btn btn-primary perangkat-upload-btn">
                                <i class="fas fa-upload me-1"></i> Upload
                            </button>
                        </div>

                        <div id="file-selected" class="perangkat-file-preview d-none mt-2">
                            <i class="fas fa-file-alt" style="color: var(--dash-primary-light);"></i>
                            <span id="file-name" class="perangkat-file-name"></span>
                            <button type="button" id="remove-file" class="perangkat-file-remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Admin Documents Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="perangkat-section-title mb-0" style="border: none; padding-bottom: 0;">
                            <i class="fas fa-folder me-2" style="color: var(--dash-primary-light);"></i>
                            @if (auth()->user()->role == 'admin')
                                File Yang Anda Upload
                            @else
                                File Dari Admin
                            @endif
                        </h5>
                        <span class="perangkat-count">
                            {{ $adminDocuments ? count($adminDocuments) : 0 }} file
                        </span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th>Nama Dokumen</th>
                                    <th class="text-center">Uploader</th>
                                    <th class="text-center">Waktu Upload</th>
                                    <th class="text-center" width="18%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($adminDocuments && count($adminDocuments) > 0)
                                    @foreach ($adminDocuments as $document)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="perangkat-file-icon">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </div>
                                                    <span class="perangkat-doc-name">
                                                        {{ substr(basename($document->file_path), 11) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-primary">
                                                    {{ $document->user->name }}
                                                </span>
                                            </td>
                                            <td class="text-center" style="color: var(--dash-text-light); font-size: 0.82rem;">
                                                {{ $document->created_at->diffForHumans() }}
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    @if (auth()->user()->role == 'admin')
                                                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('Yakin ingin menghapus?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <button type="button" class="btn btn-sm btn-info text-white btn-preview-file" 
                                                            data-url="{{ route('documents.preview', $document->id) }}" 
                                                            data-name="{{ substr(basename($document->file_path), 11) }}"
                                                            data-ext="{{ pathinfo($document->file_path, PATHINFO_EXTENSION) }}"
                                                            title="Pratinjau Dokumen"
                                                            style="background-color: var(--dash-accent); border-color: var(--dash-accent);">
                                                        <i class="fas fa-eye text-white"></i>
                                                    </button>
                                                    <a href="{{ route('documents.download', $document->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="perangkat-empty">
                                                <i class="fas fa-folder-open"></i>
                                                <p>Belum ada dokumen</p>
                                                <small>Dokumen yang diunggah akan muncul di sini</small>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Non-Admin Documents Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="perangkat-section-title mb-0" style="border: none; padding-bottom: 0;">
                            <i class="fas fa-users me-2" style="color: var(--dash-accent);"></i>
                            @if (auth()->user()->role == 'admin')
                                File Dari Guru
                            @else
                                File Yang Anda Upload
                            @endif
                        </h5>
                        <span class="perangkat-count">
                            {{ $nonAdminDocuments ? count($nonAdminDocuments) : 0 }} file
                        </span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th>Nama Dokumen</th>
                                    <th>Uploader</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Waktu Upload</th>
                                    <th class="text-center" width="18%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($nonAdminDocuments && count($nonAdminDocuments) > 0)
                                    @foreach ($nonAdminDocuments as $document)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="perangkat-file-icon" style="background: rgba(13,148,136,0.08); color: var(--dash-accent);">
                                                        <i class="fas fa-file-alt"></i>
                                                    </div>
                                                    <span class="perangkat-doc-name">
                                                        {{ substr(basename($document->file_path), 22) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">
                                                    {{ $document->user->name }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if ($document->status === 'approved')
                                                    <span class="badge" style="background: rgba(16, 185, 129, 0.1); color: rgb(16, 185, 129); border: 1px solid rgba(16, 185, 129, 0.2); font-weight: 600; padding: 0.35em 0.65em;">
                                                        <i class="fas fa-check-circle me-1"></i>Disetujui
                                                    </span>
                                                @elseif ($document->status === 'rejected')
                                                    <span class="badge" style="background: rgba(239, 68, 68, 0.1); color: rgb(239, 68, 68); border: 1px solid rgba(239, 68, 68, 0.2); font-weight: 600; padding: 0.35em 0.65em;">
                                                        <i class="fas fa-times-circle me-1"></i>Ditolak
                                                    </span>
                                                @else
                                                    <span class="badge" style="background: rgba(245, 158, 11, 0.1); color: rgb(245, 158, 11); border: 1px solid rgba(245, 158, 11, 0.2); font-weight: 600; padding: 0.35em 0.65em;">
                                                        <i class="fas fa-clock me-1"></i>Menunggu
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center" style="color: var(--dash-text-light); font-size: 0.82rem;">
                                                {{ $document->created_at->diffForHumans() }}
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1 align-items-center">
                                                    @if (auth()->user()->role == 'admin')
                                                        @if ($document->status === 'pending')
                                                            <form action="{{ route('documents.approve', $document->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-sm btn-success" title="Setujui" style="background-color: rgb(16, 185, 129); border-color: rgb(16, 185, 129);">
                                                                    <i class="fas fa-check text-white"></i>
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('documents.reject', $document->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-sm btn-warning" title="Tolak" style="background-color: rgb(245, 158, 11); border-color: rgb(245, 158, 11);">
                                                                    <i class="fas fa-times text-white"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('Yakin ingin menghapus?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if (auth()->user()->role == 'teacher' && $document->user_id == auth()->id())
                                                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('Yakin ingin menghapus?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <button type="button" class="btn btn-sm btn-info text-white btn-preview-file" 
                                                            data-url="{{ route('documents.preview', $document->id) }}" 
                                                            data-name="{{ substr(basename($document->file_path), 22) }}"
                                                            data-ext="{{ pathinfo($document->file_path, PATHINFO_EXTENSION) }}"
                                                            title="Pratinjau Dokumen"
                                                            style="background-color: var(--dash-accent); border-color: var(--dash-accent);">
                                                        <i class="fas fa-eye text-white"></i>
                                                    </button>
                                                    <a href="{{ route('documents.download', $document->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="perangkat-empty">
                                                <i class="fas fa-folder-open"></i>
                                                <p>Belum ada dokumen</p>
                                                <small>Dokumen yang diunggah akan muncul di sini</small>
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

    {{-- Preview Modal --}}
    <div id="previewModal" class="preview-modal d-none">
        <div class="preview-modal-backdrop"></div>
        <div class="preview-modal-content bg-white shadow-2xl rounded-xl overflow-hidden">
            <div class="preview-modal-header d-flex align-items-center justify-content-between p-3 border-bottom">
                <h5 class="preview-modal-title mb-0 font-bold text-gray-800 d-flex align-items-center gap-2" style="font-size: 0.95rem; font-weight: 700; color: var(--dash-text);">
                    <i class="fas fa-file-pdf text-danger"></i>
                    <span id="previewModalLabel">Preview Dokumen</span>
                </h5>
                <button type="button" class="btn-close-preview" id="closePreviewBtn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="preview-modal-body p-0" id="previewModalBody">
                <!-- Content will be injected dynamically -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fileInput = document.getElementById('file');
            const fileSelected = document.getElementById('file-selected');
            const fileName = document.getElementById('file-name');
            const removeFileBtn = document.getElementById('remove-file');
            const uploadZone = document.getElementById('uploadZone');

            if (!fileInput || !fileSelected || !fileName || !removeFileBtn) return;

            fileInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    fileName.textContent = this.files[0].name;
                    fileSelected.classList.remove('d-none');
                    uploadZone.classList.add('has-file');
                }
            });

            removeFileBtn.addEventListener('click', function () {
                fileInput.value = '';
                fileSelected.classList.add('d-none');
                fileName.textContent = '';
                uploadZone.classList.remove('has-file');
            });

            // Drag & Drop
            if (uploadZone) {
                ['dragenter', 'dragover'].forEach(e => {
                    uploadZone.addEventListener(e, (ev) => { ev.preventDefault(); uploadZone.classList.add('dragover'); });
                });
                ['dragleave', 'drop'].forEach(e => {
                    uploadZone.addEventListener(e, (ev) => { ev.preventDefault(); uploadZone.classList.remove('dragover'); });
                });
                uploadZone.addEventListener('drop', (ev) => {
                    const dt = ev.dataTransfer;
                    if (dt.files && dt.files[0]) {
                        fileInput.files = dt.files;
                        fileName.textContent = dt.files[0].name;
                        fileSelected.classList.remove('d-none');
                        uploadZone.classList.add('has-file');
                    }
                });
            }

            // Preview File Modal Logic
            const previewModal = document.getElementById('previewModal');
            const previewModalLabel = document.getElementById('previewModalLabel');
            const previewModalBody = document.getElementById('previewModalBody');
            const closePreviewBtn = document.getElementById('closePreviewBtn');

            if (previewModal && closePreviewBtn) {
                document.querySelectorAll('.btn-preview-file').forEach(button => {
                    button.addEventListener('click', function() {
                        const url = this.getAttribute('data-url');
                        const name = this.getAttribute('data-name');
                        const ext = this.getAttribute('data-ext').toLowerCase();

                        previewModalLabel.textContent = name;
                        previewModalBody.innerHTML = ''; // Clear previous preview

                        if (ext === 'pdf') {
                            // Show PDF inside iframe
                            const iframe = document.createElement('iframe');
                            iframe.src = url;
                            iframe.className = 'preview-iframe';
                            previewModalBody.appendChild(iframe);
                        } else {
                            // Non-previewable files (docx, doc, xlsx, etc.)
                            let iconClass = 'fa-file-word text-primary';
                            if (ext === 'xlsx' || ext === 'xls') {
                                iconClass = 'fa-file-excel text-success';
                            }
                            
                            previewModalBody.innerHTML = `
                                <div class="preview-fallback-container">
                                    <div class="preview-fallback-icon" style="font-size: 3.5rem; margin-bottom: 1rem;">
                                        <i class="fas ${iconClass}"></i>
                                    </div>
                                    <h6 class="font-bold text-gray-700 mb-2" style="font-size: 0.95rem; font-weight: 700; color: var(--dash-text);">Pratinjau Tidak Tersedia</h6>
                                    <p class="text-sm text-gray-500 mb-4" style="font-size: 0.8rem; max-width: 320px; color: var(--dash-text-light);">Berkas dengan ekstensi .${ext.toUpperCase()} tidak dapat dipreview langsung di browser.</p>
                                    <a href="${url.replace('/preview', '/download')}" class="btn btn-primary px-4 py-2 text-sm d-inline-flex align-items-center gap-2">
                                        <i class="fas fa-download"></i> Unduh Berkas
                                    </a>
                                </div>
                            `;
                        }

                        previewModal.classList.remove('d-none');
                    });
                });

                closePreviewBtn.addEventListener('click', function() {
                    previewModal.classList.add('d-none');
                    previewModalBody.innerHTML = ''; // Stop streaming/iframe load
                });

                previewModal.querySelector('.preview-modal-backdrop').addEventListener('click', function() {
                    previewModal.classList.add('d-none');
                    previewModalBody.innerHTML = '';
                });
            }
        });
    </script>

    @push('styles')
    <style>
        /* Upload Row */
        .perangkat-upload-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .perangkat-upload-btn {
            padding: 0.7rem 1.5rem;
            white-space: nowrap;
            flex-shrink: 0;
        }

        @media (max-width: 575.98px) {
            .perangkat-upload-row {
                flex-direction: column;
                align-items: stretch;
            }
        }

        /* Upload Zone */
        .perangkat-upload-zone {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--dash-border);
            border-radius: var(--dash-radius-sm);
            cursor: pointer;
            transition: all 0.2s ease;
            background: #fafbfc;
            flex: 1;
            min-width: 0;
        }

        .perangkat-upload-zone:hover,
        .perangkat-upload-zone.dragover {
            border-color: var(--dash-primary-light);
            background: rgba(37,99,235,0.02);
        }

        .perangkat-upload-zone.has-file {
            border-color: var(--dash-success);
            background: rgba(16,185,129,0.02);
        }

        .perangkat-upload-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: rgba(37,99,235,0.08);
            color: var(--dash-primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .perangkat-upload-text {
            font-size: 0.85rem;
            color: var(--dash-text);
        }

        .perangkat-upload-hint {
            font-size: 0.72rem;
            color: var(--dash-text-light);
            margin-top: 0.1rem;
        }

        /* File Preview */
        .perangkat-file-preview {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 0.85rem;
            background: rgba(37,99,235,0.04);
            border-radius: 6px;
            border: 1px solid rgba(37,99,235,0.1);
        }

        .perangkat-file-name {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--dash-text);
            flex: 1;
        }

        .perangkat-file-remove {
            background: none;
            border: none;
            color: var(--dash-danger);
            cursor: pointer;
            padding: 0.15rem 0.35rem;
            border-radius: 4px;
            font-size: 0.75rem;
            transition: all 0.15s ease;
        }

        .perangkat-file-remove:hover {
            background: rgba(239,68,68,0.08);
        }

        /* Section Title */
        .perangkat-section-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--dash-text);
            border-bottom: 2px solid var(--dash-border);
            padding-bottom: 0.65rem;
        }

        /* File Count Badge */
        .perangkat-count {
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.3rem 0.65rem;
            background: rgba(37,99,235,0.06);
            color: var(--dash-primary-light);
            border-radius: 20px;
        }

        /* File Icon */
        .perangkat-file-icon {
            width: 32px;
            height: 32px;
            border-radius: 7px;
            background: rgba(37,99,235,0.08);
            color: var(--dash-primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .perangkat-doc-name {
            font-size: 0.84rem;
            font-weight: 500;
            color: var(--dash-text);
            max-width: 280px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Empty State */
        .perangkat-empty {
            color: var(--dash-text-light);
        }

        .perangkat-empty i {
            font-size: 2.5rem;
            color: #e2e8f0;
            margin-bottom: 0.5rem;
        }

        .perangkat-empty p {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.15rem;
        }

        .perangkat-empty small {
            font-size: 0.78rem;
        }

        /* Preview Modal Styles */
        .preview-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1050;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .preview-modal-backdrop {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            transition: all 0.3s ease;
        }

        .preview-modal-content {
            position: relative;
            width: 100%;
            max-width: 900px;
            height: 80vh;
            display: flex;
            flex-direction: column;
            z-index: 1051;
            animation: modalSlideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            background: #ffffff;
            border-radius: var(--dash-radius-md, 12px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        @keyframes modalSlideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .btn-close-preview {
            background: none;
            border: none;
            color: var(--dash-text-light);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-close-preview:hover {
            background: rgba(239, 68, 68, 0.08);
            color: var(--dash-danger);
        }

        .preview-modal-body {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            overflow: hidden;
        }

        .preview-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .preview-fallback-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2.5rem;
        }

        .preview-fallback-icon {
            color: var(--dash-primary-light);
        }
    </style>
    @endpush
</x-app-layout>