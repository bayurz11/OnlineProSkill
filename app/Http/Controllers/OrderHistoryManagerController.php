<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\OrderHistoryManager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderHistoryManagerRequest;
use App\Http\Requests\UpdateOrderHistoryManagerRequest;

class OrderHistoryManagerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categori = Categories::all();
        $count = $categori->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.CourseMaster.orderhistory', compact('user', 'categori', 'count'));
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
    public function store(StoreOrderHistoryManagerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderHistoryManager $orderHistoryManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderHistoryManager $orderHistoryManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderHistoryManagerRequest $request, OrderHistoryManager $orderHistoryManager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderHistoryManager $orderHistoryManager)
    {
        //
    }
}
