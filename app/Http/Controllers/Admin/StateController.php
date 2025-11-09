<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StateController extends Controller
{
    /**
     * Display a listing of the states.
     */
    public function index()
    {
        $states = State::orderBy('name')->paginate(20);
        return view('admin.states.index', compact('states'));
    }

    /**
     * Show the form for creating a new state.
     */
    public function create()
    {
        return view('admin.states.create');
    }

    /**
     * Store a newly created state in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:states',
            'code' => 'required|string|max:10|unique:states',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        State::create($validated);

        return redirect()->route('admin.states.index')
            ->with('success', 'State created successfully.');
    }

    /**
     * Show the form for editing the specified state.
     */
    public function edit(State $state)
    {
        return view('admin.states.edit', compact('state'));
    }

    /**
     * Update the specified state in storage.
     */
    public function update(Request $request, State $state)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('states')->ignore($state->id)],
            'code' => ['required', 'string', 'max:10', Rule::unique('states')->ignore($state->id)],
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        $state->update($validated);

        return redirect()->route('admin.states.index')
            ->with('success', 'State updated successfully.');
    }

    /**
     * Remove the specified state from storage.
     */
    public function destroy(State $state)
    {
        if ($state->cities()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete state with associated cities.');
        }

        $state->delete();

        return redirect()->route('admin.states.index')
            ->with('success', 'State deleted successfully.');
    }
}
