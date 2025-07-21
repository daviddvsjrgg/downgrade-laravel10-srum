<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Log;
use Str;

class KoleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Admin - Data Koleksi";
        $query = Collection::query();
        session(['redirect_url' => url()->full()]);
        // Handle pencarian jika ada
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('judul_tugas_akhir', 'like', "%$search%")
                ->orWhere('nama_penulis', 'like', "%$search%")
                ->orWhere('nama_pembimbing', 'like', "%$search%")
                ->orWhere('program_studi', 'like', "%$search%")
                ->orWhere('fakultas', 'like', "%$search%")
                ->orWhere('tahun_terbit', 'like', "%$search%")
                ->orWhere('tanggal_unggah', 'like', "%$search%");
            });
        }

        // Sorting
        switch ($request->input('sort')) {
            case 'terlama':
                $query->orderBy('tanggal_unggah', 'asc');
                break;
            case 'judul_asc':
                $query->orderBy('judul_tugas_akhir', 'asc');
                break;
            case 'judul_desc':
                $query->orderBy('judul_tugas_akhir', 'desc');
                break;
            case 'penulis_asc':
                $query->orderBy('nama_penulis', 'asc');
                break;
            case 'penulis_desc':
                $query->orderBy('nama_penulis', 'desc');
                break;
            case 'tahun_terbit_asc':
                $query->orderBy('tahun_terbit', 'asc');
                break;
            case 'tahun_terbit_desc':
                $query->orderBy('tahun_terbit', 'desc');
                break;
            case 'status_asc':
                $query->orderBy('status', 'asc');
                break;
            case 'status_desc':
                $query->orderBy('status', 'desc');
                break;
            case 'terbaru':
            default:
                $query->orderBy('tanggal_unggah', 'desc');
                break;
        }

        $collections = $query->paginate(5)->withQueryString();

        return view('admin.koleksi.index', compact('title', 'collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Admin - Tambah Koleksi";
        return view('admin.koleksi.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $request->validate([
            'judul_tugas_akhir' => 'required',
            'nama_penulis' => 'required',
            'nama_pembimbing' => 'required',
            'program_studi' => 'required',
            'fakultas' => 'required',
            'tahun_terbit' => 'required|digits:4',
            'abstrak_indo' => 'required',
            'abstrak_eng' => 'required',
            'nomer_reg' => 'required',
            'kata_kunci' => 'required',
            'status' => 'required',
        ],
        [
            'required' => ':attribute wajib diisi.',
            'digits' => ':attribute harus berupa :digits digit angka.',
        ],
        [
            'judul_tugas_akhir' => 'Judul Tugas Akhir',
            'nama_penulis' => 'Nama Penulis',
            'nama_pembimbing' => 'Nama Pembimbing',
            'program_studi' => 'Program Studi',
            'fakultas' => 'Fakultas',
            'tahun_terbit' => 'Tahun Terbit',
            'abstrak_indo' => 'Abstrak (Indonesia)',
            'abstrak_eng' => 'Abstrak (English)',
            'nomer_reg' => 'Nomor Registrasi',
            'kata_kunci' => 'Kata Kunci',
            'status' => 'Status',
        ]);

        $data = $request->all();
        // Set tanggal_unggah to current date/time (same as created_at)
        $data['tanggal_unggah'] = now();

        Collection::create($data);

        return redirect()->route('admin.koleksi.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Admin - Detail Koleksi";
        $collection = Collection::findOrFail($id);

        return view('admin.koleksi.detail', compact('title', 'collection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Admin - Edit Koleksi";
        $collection = Collection::findOrFail($id);

        session(['redirect_url' => url()->previous()]);
        return view('admin.koleksi.edit', compact('title', 'collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_tugas_akhir' => 'required',
            'nama_penulis' => 'required',
            'nama_pembimbing' => 'required',
            'program_studi' => 'required',
            'fakultas' => 'required',
            'tahun_terbit' => 'required|digits:4',
            'abstrak_indo' => 'required',
            'abstrak_eng' => 'required',
            'nomer_reg' => 'required',
            'kata_kunci' => 'required',
            'tanggal_unggah' => 'required|date',
            'status' => 'required',
        ], 
        [
            // Custom messages
            'required' => ':attribute wajib diisi.',
            'digits' => ':attribute harus berupa :digits digit angka.',
            'date' => ':attribute harus berupa tanggal yang valid.',
        ], 
        [
            // Custom attribute names
            'judul_tugas_akhir' => 'Judul Tugas Akhir',
            'nama_penulis' => 'Nama Penulis',
            'nama_pembimbing' => 'Nama Pembimbing',
            'program_studi' => 'Program Studi',
            'fakultas' => 'Fakultas',
            'tahun_terbit' => 'Tahun Terbit',
            'abstrak_indo' => 'Abstrak (Indonesia)',
            'abstrak_eng' => 'Abstrak (English)',
            'nomer_reg' => 'Nomor Registrasi',
            'kata_kunci' => 'Kata Kunci',
            'tanggal_unggah' => 'Tanggal Unggah',
            'status' => 'Status',
        ]);

        $collection = Collection::findOrFail($id);
        $collection->update($request->all());

        $redirect = session('redirect_url', route('admin.koleksi.index'));

        session()->forget('redirect_url');
        return redirect($redirect)->with('success', 'Koleksi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $koleksi = Collection::findOrFail($id);

        try {
            $koleksi->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus koleksi.');
        }

        // Get redirect URL from session
        $redirect = session()->pull('redirect_url', route('admin.koleksi.index'));

        return redirect($redirect)->with('success', 'Koleksi berhasil dihapus.');
    }

    public function showImport()
    {
        $title = "Admin - Import Koleksi";

        return view('admin.koleksi.import', compact('title'));
    }

    public function storeImport(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:5120',
        ], [
            'csv_file.required' => 'File CSV wajib diunggah.',
            'csv_file.file' => 'File yang diunggah tidak valid.',
            'csv_file.mimes' => 'Format file harus berupa .csv atau .txt.',
            'csv_file.max' => 'Ukuran file tidak boleh lebih dari 5MB.',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');

        $header = fgetcsv($handle);
        if (!$header) {
            return back()->withErrors(['File CSV kosong atau tidak valid.']);
        }

        // Normalize headers (e.g., "Judul Tugas Akhir" -> "judul_tugas_akhir")
        $normalizedHeader = array_map(function ($head) {
            return Str::snake(trim($head));
        }, $header);

        $rows = [];
        $rowNumber = 1;

        while (($data = fgetcsv($handle)) !== false) {
            $rowNumber++;

            // Skip rows with wrong column count
            if (count($data) != count($normalizedHeader)) {
                Log::warning("Row $rowNumber skipped: column count mismatch.", [
                    'expected' => count($normalizedHeader),
                    'actual' => count($data),
                    'data' => $data,
                ]);
                continue;
            }

            $assoc = array_combine($normalizedHeader, $data);
            if (!$assoc) {
                Log::warning("Row $rowNumber skipped: failed to combine header and data.", [
                    'data' => $data,
                ]);
                continue;
            }

            try {
                if (isset($assoc['tanggal_unggah']) && !empty(trim($assoc['tanggal_unggah']))) {
                    $tanggalUnggah = Carbon::parse($assoc['tanggal_unggah']);
                } else {
                    $tanggalUnggah = Carbon::now();
                }
            } catch (\Exception $e) {
                Log::warning("Row $rowNumber: Invalid tanggal_unggah format. Using current date.", [
                    'value' => $assoc['tanggal_unggah'] ?? null,
                ]);
                $tanggalUnggah = Carbon::now();
            }

            $rows[] = [
                'judul_tugas_akhir' => $assoc['judul_tugas_akhir'] ?? null,
                'nama_penulis' => $assoc['nama_penulis'] ?? null,
                'nama_pembimbing' => $assoc['nama_pembimbing'] ?? null,
                'program_studi' => $assoc['program_studi'] ?? null,
                'fakultas' => $assoc['fakultas'] ?? null,
                'tahun_terbit' => $assoc['tahun_terbit'] ?? null,
                'abstrak_indo' => $assoc['abstrak_indo'] ?? null,
                'abstrak_eng' => $assoc['abstrak_eng'] ?? null,
                'nomer_reg' => $assoc['nomer_reg'] ?? null,
                'kata_kunci' => $assoc['kata_kunci'] ?? null,
                'tanggal_unggah' => $tanggalUnggah,
                'status' => $assoc['status'] ?? 'draft',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        fclose($handle);

        if (empty($rows)) {
            return back()->withErrors(['Tidak ada data valid yang dapat diimpor dari file CSV.']);
        }

        try {
            DB::beginTransaction();
            Collection::insert($rows);
            DB::commit();

            return redirect()->route('admin.koleksi.index')->with('success', 'Data berhasil diimpor.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('CSV import error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors(['Impor gagal. Silakan periksa file CSV dan coba lagi.']);
        }
    }

}
