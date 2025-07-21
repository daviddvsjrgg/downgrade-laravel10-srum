<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TextRequest;
use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Admin - Data Permintaan";

        $query = TextRequest::with(['audio.collection']);

        // Search
        if ($search = $request->input('search')) {
            $query->whereHas('audio.collection', function ($q) use ($search) {
                $q->where('judul_tugas_akhir', 'like', "%$search%")
                ->orWhere('nomer_reg', 'like', "%$search%")
                ->orWhere('nama', 'like', "%$search%")
                ->orWhere('nim', 'like', "%$search%")
                ->orWhere('prodi', 'like', "%$search%")
                ->orWhere('whatsapp', 'like', "%$search%");
            });
        }

        // Sort
        switch ($request->input('sort')) {
            case 'terlama':
                $query->orderBy('created_at', 'asc');
                break;

            case 'status_asc':
                $query->orderBy('status', 'asc');
                break;

            case 'status_desc':
                $query->orderBy('status', 'desc');
                break;

            case 'terbaru':
            default:
                $query->orderBy('status', 'asc')
                    ->orderBy('created_at', 'desc');
                break;
        }

        $audios = $query->paginate(5);

        return view('admin.permintaan.index', compact('title', 'audios'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $textRequest = TextRequest::findOrFail($id);
        $textRequest->status = $request->input('status', 'Belum Dikirim');
        $textRequest->save();

        return response()->json(['message' => 'Status updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
