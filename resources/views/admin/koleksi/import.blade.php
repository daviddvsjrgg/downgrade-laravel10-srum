@extends('layouts.admin.app')

@section('title', 'Impor Koleksi')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Impor Koleksi</h2>

    <div class="bg-white shadow-md rounded-lg p-8 space-y-6">
        {{-- Instruction --}}
       <div class="text-gray-700">
            <p>Impor data secara massal dengan mengunggah file berformat <strong>.csv</strong>. Sebelum mengunggah, pastikan data Anda telah sesuai dengan template kolom yang disediakan.</p>
            <p>Anda dapat mengunduh contoh template CSV melalui tautan di bawah ini:</p>
            <a href="{{ asset('images/template-import-koleksi.csv') }}"
                download
                class="text-indigo-600 font-bold underline mt-2 inline-block"
                >
                    Download Template CSV
            </a>
        </div>

        {{-- Error Message --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <strong>Terjadi kesalahan:</strong>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- File Upload Form --}}
        <form action="{{ route('admin.koleksi.store.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="upload-form">
            @csrf

            <div 
                id="dropzone"
                class="w-full h-48 border-2 border-dashed border-gray-300 rounded-lg flex flex-col justify-center items-center text-gray-500 hover:border-blue-400 hover:bg-blue-50 transition cursor-pointer relative"
            >
                <p class="mb-2 text-center">Tarik dan lepaskan file CSV di sini atau</p>
                <button
                    type="button"
                    id="selectFileBtn"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none"
                >
                    Pilih file
                </button>
                <p class="text-sm text-gray-400 mt-2">Hanya file .csv yang diizinkan, maksimal ukuran file 5 MB</p>
                <input type="file" id="csv_file" name="csv_file" accept=".csv" required class="hidden" />
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('admin.koleksi.index') }}" class="px-6 py-2 border rounded border-gray-400 hover:bg-gray-100">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-800 cursor-pointer">Impor Data</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('csv_file');
        const selectFileBtn = document.getElementById('selectFileBtn');

        const displayFileName = () => {
            const existing = dropzone.querySelector('.selected-file');
            if (existing) existing.remove();

            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const fileName = file.name;
                const fileSize = formatFileSize(file.size);

                const info = document.createElement('p');
                info.className = "text-sm text-green-600 mt-2 selected-file";
                info.textContent = `File dipilih: ${fileName} (${fileSize})`;
                dropzone.appendChild(info);
            }
        };

        const formatFileSize = (bytes) => {
            if (bytes < 1024) return `${bytes} B`;
            if (bytes < 1024 * 1024) return `${(bytes / 1024).toFixed(1)} KB`;
            return `${(bytes / (1024 * 1024)).toFixed(2)} MB`;
        };

        dropzone.addEventListener('click', () => {
            fileInput.click();
        });

        selectFileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            fileInput.click();
        });

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('border-blue-500', 'bg-blue-50');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('border-blue-500', 'bg-blue-50');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-blue-500', 'bg-blue-50');
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                displayFileName();
            }
        });

        fileInput.addEventListener('change', () => {
            displayFileName();
        });
    });
</script>
@endsection

