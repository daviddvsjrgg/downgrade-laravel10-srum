<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $title = "Admin - Data Mahaiswa";
        return view('admin.mahasiswa.index', compact('title')); // Make sure this Blade file exists
    }
}
