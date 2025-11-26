<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', ['products' => collect()]);
    }

    public function create()
    {
        return redirect()->route('admin.products.index')->with('info', 'Product CRUD coming soon!');
    }

    public function store()
    {
        return redirect()->route('admin.products.index');
    }

    public function edit($id)
    {
        return redirect()->route('admin.products.index');
    }

    public function update($id)
    {
        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.products.index');
    }
}
