<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use App\Models\Categories;
use App\Models\KelasTatapMuka;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKurikulumRequest;
use App\Http\Requests\UpdateKurikulumRequest;
use App\Models\Section;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{

    public function index($id)
    {
        $user = Auth::user();
        $categori = Categories::all();
        $kurikulum = Kurikulum::with('user')->get();
        $cours = KelasTatapMuka::all();
        $count = $kurikulum->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.KelasTatapMuka.kurikulum', compact('user', 'categori', 'count', 'kurikulum', 'cours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'course_id' => 'required|integer',
            'title' => 'required|string|max:255',
        ]);

        // Buat entitas Kurikulum baru
        $kurikulum = new Kurikulum;
        $kurikulum->course_id = $validatedData['course_id'];
        $kurikulum->title = $validatedData['title'];
        $kurikulum->save();

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Kurikulum berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Kurikulum $kurikulum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kurikulum $kurikulum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurikulumRequest $request, Kurikulum $kurikulum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kurikulum $kurikulum)
    {
        //
    }
}
