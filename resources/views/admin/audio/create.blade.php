@extends('layouts.admin.app')

@section('title', $title)

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="max-w-6xl mx-auto py-8">
    <h2 class="text-2xl font-bold">
        Text to speech
    </h2>
    <p class="text-sm text-gray-500 mb-2">
        {{ $collection->judul_tugas_akhir }} - {{ $collection->nama_penulis }}
    </p>

    <div class="bg-white shadow-md rounded-lg p-8">
        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <strong>Errors occurred:</strong>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.audio.by.koleksi.store', ['collectionId' => $collection->id]) }}" method="POST" class="space-y-6" enctype="multipart/form-data" id="ttsForm">
            @csrf

            {{-- Abstrak --}}
            <div>
                <label for="abstrak" class="font-medium mb-2 block">
                    {{ $language == 'id' ? 'Abstrak Bahasa Indonesia' : 'Abstrak English' }}
                </label>
                @php
                    $abstrakText = old('abstrak') ?? ($language == 'id' ? $collection->abstrak_indo : $collection->abstrak_eng);
                @endphp
                <textarea
                    id="abstrak"
                    name="abstrak"
                    rows="8"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100"
                    readonly
                >{{ $abstrakText }}</textarea>

                <div class="text-sm text-gray-500 mt-2 text-right">
                    {{ strlen($abstrakText) }} karakter
                </div>
            </div>

            {{-- Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Left column --}}
                <div class="space-y-6 md:col-span-2">
                    <div class="bg-white rounded-lg shadow p-6 space-y-4">
                        <h3 class="font-semibold mb-2">Voice Option</h3>

                        <div>
                            <label for="language" class="block text-sm font-medium text-gray-700 mb-1">Bahasa</label>
                            <input
                                type="text"
                                id="language"
                                value="{{ $language == 'id' ? 'Indonesia' : ($language == 'en' ? 'English' : 'Unknown') }}"
                                readonly
                                class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 cursor-not-allowed"
                            >
                        </div>

                        <div>
                            <label for="voice" class="block text-sm font-medium text-gray-700 mb-1">Suara</label>
                            <select
                                name="voice"
                                id="voice"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                            @if ($language == 'id')
                            <option value="MALE" data-voice='{"languageCode":"id-ID","name":"id-ID-Standard-B","ssmlGender":"MALE"}' {{ old('voice', $collection->voice ?? '') == 'MALE' ? 'selected' : '' }}>Male</option>
                                <option value="FEMALE" data-voice='{"languageCode":"id-ID","name":"id-ID-Standard-A","ssmlGender":"FEMALE"}' {{ old('voice', $collection->voice ?? '') == 'FEMALE' ? 'selected' : '' }}>Female</option>
                            @elseif ($language == 'en')
                                <option value="MALE" data-voice='{"languageCode":"en-US","name":"en-US-Standard-A","ssmlGender":"MALE"}' {{ old('voice', $collection->voice ?? '') == 'MALE' ? 'selected' : '' }}>Male</option>
                                <option value="FEMALE" data-voice='{"languageCode":"en-US","name":"en-US-Standard-C","ssmlGender":"FEMALE"}' {{ old('voice', $collection->voice ?? '') == 'FEMALE' ? 'selected' : '' }}>Female</option>
                            @endif
                            </select>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="font-semibold mb-2">Output Format</h3>
                        <select name="output_format" id="output_format" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="MP3" {{ ($collection->output_format ?? '') === 'MP3' ? 'selected' : '' }}>MP3</option>
                            <option value="LINEAR16" {{ ($collection->output_format ?? '') === 'LINEAR16' ? 'selected' : '' }}>WAV</option>
                        </select>
                    </div>
                </div>

                {{-- Right column --}}
                <div class="bg-white rounded-lg shadow p-6 space-y-6">
                    <h3 class="font-semibold mb-4 text-lg">Audio Settings</h3>

                    <div>
                        <label for="speakingRate" class="block font-semibold mb-2">
                            Speaking Rate: <span id="speakingRateValue" class="text-blue-600 font-medium">{{ old('speakingRate', $collection->speakingRate ?? 1.0) }}</span>
                        </label>
                        <input type="range" step="0.01" min="0.25" max="4.0" name="speakingRate" id="speakingRate"
                            value="{{ old('speakingRate', $collection->speakingRate ?? 1.0) }}"
                            class="w-full h-3 rounded-lg bg-gradient-to-r from-blue-400 to-blue-600 cursor-pointer accent-blue-600 focus:outline-none">
                    </div>

                    <div>
                        <label for="pitch" class="block font-semibold mb-2">
                            Pitch: <span id="pitchValue" class="text-blue-600 font-medium">{{ old('pitch', $collection->pitch ?? 0.0) }}</span>
                        </label>
                        <input type="range" step="0.1" min="-20.0" max="20.0" name="pitch" id="pitch"
                            value="{{ old('pitch', $collection->pitch ?? 0.0) }}"
                            class="w-full h-3 rounded-lg bg-gradient-to-r from-blue-400 to-blue-600 cursor-pointer accent-blue-600 focus:outline-none">
                    </div>

                    <div>
                        <button type="button" id="testAudioBtn" class="w-full bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-800 cursor-pointer">
                            <span id="testAudioText">Uji Audio</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ session('redirect_url', route('admin.koleksi.index')) }}" class="px-6 py-2 border rounded border-gray-400 hover:bg-gray-100">
                    Kembali
                </a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-800 cursor-pointer">Ubah ke Audio</button>
            </div>
        </form>
    </div>
</div>

<script>
    const speakingRateSlider = document.getElementById('speakingRate');
    const speakingRateValue = document.getElementById('speakingRateValue');
    const pitchSlider = document.getElementById('pitch');
    const pitchValue = document.getElementById('pitchValue');
    const testBtn = document.getElementById('testAudioBtn');
    const testText = document.getElementById('testAudioText');
    let currentAudio = null;

    speakingRateSlider.addEventListener('input', () => {
        speakingRateValue.textContent = speakingRateSlider.value;
    });

    pitchSlider.addEventListener('input', () => {
        pitchValue.textContent = pitchSlider.value;
    });

    document.getElementById('testAudioBtn').addEventListener('click', async () => {
        // Don't allow another test until current audio is cleared
        if (currentAudio) {
             Swal.fire({
                icon: 'info',
                title: 'Uji Audio Sudah Ada',
                text: 'Silakan hapus audio saat ini sebelum mengetes suara yang baru.',
                confirmButtonText: 'Mengerti'
            });
            return;
        }

        const abstrakText = document.getElementById('abstrak').value.trim();
        if (!abstrakText || abstrakText.length < 20) {
            Swal.fire({
                icon: 'warning',
                title: 'Teks Terlalu Pendek',
                text: 'Teks abstrak terlalu pendek untuk diproses.',
                confirmButtonText: 'OK'
            });
            return;
        }

        const voiceSelect = document.getElementById('voice');
        const selectedVoiceOption = voiceSelect.options[voiceSelect.selectedIndex];
        const voiceData = JSON.parse(selectedVoiceOption.getAttribute('data-voice'));
        const outputFormat = document.getElementById('output_format').value;
        const speakingRate = parseFloat(speakingRateSlider.value);
        const pitch = parseFloat(pitchSlider.value);

        const payload = {
            input: { text: abstrakText },
            voice: voiceData,
            audioConfig: {
                audioEncoding: outputFormat,
                speakingRate: speakingRate,
                pitch: pitch
            }
        };

        try {
            testBtn.disabled = true;
            testText.textContent = 'Loading...';

            const response = await fetch("{{ route('admin.audio.testTTS') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(payload)
            });

            if (!response.ok) throw new Error('Server error: ' + response.statusText);
            const data = await response.json();

            if (data.audioContent) {
                const mime = outputFormat === 'MP3' ? 'audio/mp3' : 'audio/wav';
                const audioBlob = new Blob([Uint8Array.from(atob(data.audioContent), c => c.charCodeAt(0))], { type: mime });
                const audioURL = URL.createObjectURL(audioBlob);

                const container = document.createElement('div');
                container.id = 'audioPreviewContainer';
                container.className = 'mt-4 space-y-2';

                currentAudio = new Audio(audioURL);
                currentAudio.controls = true;
                currentAudio.autoplay = true;

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Hapus Uji Audio';
                deleteButton.className = 'bg-red-600 text-white px-4 py-1 rounded hover:bg-red-800';
                deleteButton.addEventListener('click', () => {
                    currentAudio.pause();
                    currentAudio.src = '';
                    currentAudio = null;
                    container.remove();
                });

                container.appendChild(currentAudio);
                container.appendChild(deleteButton);
                testBtn.insertAdjacentElement('afterend', container);
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Ada Audio',
                    text: 'Tidak ada audio yang diterima dari backend.',
                    confirmButtonText: 'OK'
                });
            }
        } catch (error) {
            console.error('TTS Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Gagal Membuat Uji Audio',
                text: 'Terjadi kesalahan saat menghasilkan audio. Silakan coba lagi.',
                confirmButtonText: 'OK'
            });
        } finally {
            testBtn.disabled = false;
            testText.textContent = 'Uji Audio';
        }
    });
</script>

<script>
function formatDuration(seconds) {
    const mins = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
}

document.getElementById('ttsForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const submitButton = e.target.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    submitButton.textContent = 'Loading...';
    submitButton.disabled = true;

    const abstrakText = document.getElementById('abstrak').value.trim();
    const voiceSelect = document.getElementById('voice');
    const selectedVoiceOption = voiceSelect.options[voiceSelect.selectedIndex];
    const voiceData = JSON.parse(selectedVoiceOption.getAttribute('data-voice'));
    const outputFormat = document.getElementById('output_format').value;
    const speakingRate = parseFloat(document.getElementById('speakingRate').value);
    const pitch = parseFloat(document.getElementById('pitch').value);

    const payload = {
        input: { text: abstrakText },
        voice: voiceData,
        audioConfig: {
            audioEncoding: outputFormat,
            speakingRate: speakingRate,
            pitch: pitch
        }
    };

    try {
        const response = await fetch("{{ route('admin.audio.testTTS') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(payload)
        });

        if (!response.ok) throw new Error('Server error ' + response.status);

        const data = await response.json();

        if (!data.audioContent) throw new Error('No audioContent received');

        const byteCharacters = atob(data.audioContent);
        const byteNumbers = new Array(byteCharacters.length);
        for (let i = 0; i < byteCharacters.length; i++) {
            byteNumbers[i] = byteCharacters.charCodeAt(i);
        }
        const byteArray = new Uint8Array(byteNumbers);

        let mimeType = 'audio/mpeg';
        if (outputFormat === 'LINEAR16') mimeType = 'audio/wav';

        const audioBlob = new Blob([byteArray], { type: mimeType });
        const audioURL = URL.createObjectURL(audioBlob);

        const audio = new Audio();
        audio.addEventListener('loadedmetadata', () => {
            const formattedDuration = formatDuration(audio.duration);

            // Build new form with required data
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = e.target.action;

            const tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            form.appendChild(tokenInput);

            const bahasaInput = document.createElement('input');
            bahasaInput.type = 'hidden';
            bahasaInput.name = 'bahasa';
            bahasaInput.value = voiceData.languageCode;
            form.appendChild(bahasaInput);

            const durasiInput = document.createElement('input');
            durasiInput.type = 'hidden';
            durasiInput.name = 'durasi';
            durasiInput.value = formattedDuration;
            form.appendChild(durasiInput);

            const formatInput = document.createElement('input');
            formatInput.type = 'hidden';
            formatInput.name = 'format';
            formatInput.value = outputFormat;
            form.appendChild(formatInput);

            const collectionInput = document.createElement('input');
            collectionInput.type = 'hidden';
            collectionInput.name = 'collection_id';
            collectionInput.value = {{ $collection->id }};
            form.appendChild(collectionInput);

            const base64Input = document.createElement('input');
            base64Input.type = 'hidden';
            base64Input.name = 'base64';
            base64Input.value = data.audioContent;
            form.appendChild(base64Input);

            // New fields
            const pitchInput = document.createElement('input');
            pitchInput.type = 'hidden';
            pitchInput.name = 'pitch';
            pitchInput.value = pitch;
            form.appendChild(pitchInput);

            const speakingRateInput = document.createElement('input');
            speakingRateInput.type = 'hidden';
            speakingRateInput.name = 'speaking_rate';
            speakingRateInput.value = speakingRate;
            form.appendChild(speakingRateInput);

            const tipeSuaraInput = document.createElement('input');
            tipeSuaraInput.type = 'hidden';
            tipeSuaraInput.name = 'tipe_suara';
            tipeSuaraInput.value = voiceData.name || ''; // assuming voiceData has a 'name' property for voice type
            form.appendChild(tipeSuaraInput);

            document.body.appendChild(form);
            form.submit();

            URL.revokeObjectURL(audioURL);
        });

        audio.src = audioURL;

        setTimeout(() => {
            if (!audio.duration || isNaN(audio.duration)) {
                alert('Audio metadata loading failed, submitting anyway');
                e.target.submit();
            }
        }, 3000);

    } catch (err) {
        console.error('Error:', err);
        Swal.fire({
            icon: 'error',
            title: 'Gagal Proses',
            text: err.message || 'Terjadi kesalahan saat memproses audio.'
        });
        submitButton.textContent = originalText;
        submitButton.disabled = false;
    }
});
</script>


@endsection
