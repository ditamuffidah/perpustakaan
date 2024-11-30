<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari model Subject
        $subjects = Subject::all();

        // Mengarahkan data ke view 'subjects.index'
        return view('subjects.index', compact('subjects'));
    }
}
