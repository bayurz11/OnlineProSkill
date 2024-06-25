<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CourseMaster;
use App\Models\KelasTatapMuka;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKelasTatapMukaRequest;
use App\Http\Requests\UpdateKelasTatapMukaRequest;

class KelasTatapMukaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categori = Categories::all();
        $course = CourseMaster::with('user')->get();
        $count = $course->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.KelasTatapMuka.classroom', compact('user', 'categori', 'count', 'course'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelasTatapMukaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KelasTatapMuka $kelasTatapMuka)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KelasTatapMuka $kelasTatapMuka)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelasTatapMukaRequest $request, KelasTatapMuka $kelasTatapMuka)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KelasTatapMuka $kelasTatapMuka)
    {
        //
    }
}
