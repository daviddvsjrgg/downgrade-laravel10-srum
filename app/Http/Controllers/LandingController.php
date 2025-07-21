<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Models\TextRequest;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $title = 'Beranda';
        return view('landing', compact('title'));
    }

    public function about()
    {
        $title = 'Tentang Kami';
        return view('user.about', compact('title'));
    }

    public function guide()
    {
        $title = 'Panduan';
        return view('user.guide', compact('title'));
    }

    public function selectLanguage()
    {
        $title = 'Pilih Bahasa';
        return view('user.select-language', compact('title'));
    }

    public function cariAudio(Request $request)
    {
        $title = 'Cari Audio';
        $language = $request->query('language', 'id'); // default ke 'id'
        return view('user.cari-audio', compact('language', 'title'));
    }

   public function hasilAudio(Request $request)
    {
        $title = 'Hasil Pencarian Audio';
        $keyword = $request->input('keyword');
        $language = $request->input('language');

        $query = Audio::with('collection');

        // Filter language by prefix (id-ID, en-US, etc)
        if ($language && in_array($language, ['id', 'en'])) {
            $query->where('bahasa', 'like', $language . '%');
        }

        if ($keyword) {
            $keyword = trim($keyword);

            $query->whereHas('collection', function ($q) use ($keyword, $language) {
                if ($language === 'id') {
                    $q->where(function ($subQ) use ($keyword) {
                        $subQ->where('judul_tugas_akhir', 'like', "%$keyword%")
                            ->orWhere('nama_penulis', 'like', "%$keyword%")
                            ->orWhere('abstrak_indo', 'like', "%$keyword%")
                            ->orWhere('nama_pembimbing', 'like', "%$keyword%")
                            ->orWhere('program_studi', 'like', "%$keyword%")
                            ->orWhere('fakultas', 'like', "%$keyword%")
                            ->orWhere('tahun_terbit', 'like', "%$keyword%")
                            ->orWhere('kata_kunci', 'like', "%$keyword%");
                    });
                } elseif ($language === 'en') {
                    $q->where(function ($subQ) use ($keyword) {
                        $subQ->where('judul_tugas_akhir', 'like', "%$keyword%")
                            ->orWhere('abstrak_eng', 'like', "%$keyword%")
                            ->orWhere('nama_penulis', 'like', "%$keyword%")
                            ->orWhere('nama_pembimbing', 'like', "%$keyword%")
                            ->orWhere('program_studi', 'like', "%$keyword%")
                            ->orWhere('fakultas', 'like', "%$keyword%")
                            ->orWhere('tahun_terbit', 'like', "%$keyword%")
                            ->orWhere('kata_kunci', 'like', "%$keyword%");
                    });
                } else {
                    $q->where(function ($subQ) use ($keyword) {
                        $subQ->where('judul_tugas_akhir', 'like', "%$keyword%")
                            ->orWhere('abstrak_indo', 'like', "%$keyword%")
                            ->orWhere('abstrak_eng', 'like', "%$keyword%")
                            ->orWhere('nama_penulis', 'like', "%$keyword%")
                            ->orWhere('nama_pembimbing', 'like', "%$keyword%")
                            ->orWhere('program_studi', 'like', "%$keyword%")
                            ->orWhere('fakultas', 'like', "%$keyword%")
                            ->orWhere('tahun_terbit', 'like', "%$keyword%")
                            ->orWhere('kata_kunci', 'like', "%$keyword%");
                    });
                }
            });
        }

        $results = $query->paginate(10)->withQueryString();

        return view('user.hasil-audio', compact('title', 'language', 'keyword', 'results'));
    }
    
    public function mintaPermintaanTeksLengkap($audioId)
    {
        $title = 'Minta Teks Lengkap';
        $audio = Audio::findOrFail($audioId); // Get the audio by ID or fail

        // Simpan URL sebelumnya (hasil-audio, dsb) di session
        session(['redirect_url' => url()->previous()]);

        return view('user.permintaan-teks-lengkap', compact('audio', 'title'));
    }
    public function kirimPermintaanTeksLengkap(Request $request, $audioId)
    {
        // Custom messages in Indonesian
        $messages = [
            'nama.required'     => 'Nama wajib diisi.',
            'nama.string'       => 'Nama harus berupa teks.',
            'nama.max'          => 'Nama maksimal :max karakter.',

            'nim.required'      => 'NIM wajib diisi.',
            'nim.string'        => 'NIM harus berupa teks.',
            'nim.max'           => 'NIM maksimal :max karakter.',

            'prodi.required'    => 'Program Studi/Fakultas wajib diisi.',
            'prodi.string'      => 'Program Studi/Fakultas harus berupa teks.',
            'prodi.max'         => 'Program Studi/Fakultas maksimal :max karakter.',

            'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'whatsapp.string'   => 'Nomor WhatsApp harus berupa teks.',
            'whatsapp.max'      => 'Nomor WhatsApp maksimal :max karakter.',
        ];

        // Validate with custom messages
        $validatedData = $request->validate([
            'nama'     => ['required', 'string', 'max:255'],
            'nim'      => ['required', 'string', 'max:50'],
            'prodi'    => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:20'],
        ], $messages);

        $validatedData['whatsapp'] = preg_replace('/^0|^62/', '', $validatedData['whatsapp']);
        $validatedData['whatsapp'] = '62' . $validatedData['whatsapp'];
         
        try {
            TextRequest::create([
                'audio_id' => $audioId,
                'nama'     => $validatedData['nama'],
                'nim'      => $validatedData['nim'],
                'prodi'    => $validatedData['prodi'],
                'whatsapp' => $validatedData['whatsapp'],
                'status'   => 'Belum Dikirim',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengirim permintaan. Silakan coba lagi.');
        }

        $redirect = session('redirect_url', route('hasil.audio'));
        session()->forget('redirect_url');

        return redirect($redirect)
            ->with('success', 'Permintaan teks lengkap berhasil dikirim!');
    }


}
