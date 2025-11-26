<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function index()
    {
        return view('admin.reviews.index', ['reviews' => collect()]);
    }

    public function create()
    {
        return redirect()->route('admin.reviews.index')->with('info', 'Review CRUD coming soon!');
    }

    public function store()
    {
        return redirect()->route('admin.reviews.index');
    }

    public function edit($id)
    {
        return redirect()->route('admin.reviews.index');
    }

    public function update($id)
    {
        return redirect()->route('admin.reviews.index');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.reviews.index');
    }
}
