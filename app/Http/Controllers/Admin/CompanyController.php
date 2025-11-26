<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index()
    {
        return view('admin.companies.index', ['companies' => collect()]);
    }

    public function create()
    {
        return redirect()->route('admin.companies.index')->with('info', 'Company CRUD coming soon!');
    }

    public function store()
    {
        return redirect()->route('admin.companies.index');
    }

    public function edit($id)
    {
        return redirect()->route('admin.companies.index');
    }

    public function update($id)
    {
        return redirect()->route('admin.companies.index');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.companies.index');
    }
}
