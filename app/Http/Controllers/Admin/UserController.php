<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        // Test 1: Get all users without any relationships
        $usersWithoutRelation = User::latest()->get();
        \Log::info('Users without relation count: ' . $usersWithoutRelation->count());
        
        // Test 2: Get users with company relationship
        $usersWithRelation = User::with('company')->latest()->get();
        \Log::info('Users with relation count: ' . $usersWithRelation->count());
        
        $users = $usersWithRelation;
        $availableCompanies = Company::whereNull('owner_id')->get();
        
        return view('admin.users.index', compact('users', 'availableCompanies'));
    }

    /**
     * Assign a company to a user.
     */
    public function assignCompany(Request $request, User $user)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id'
        ]);

        $company = Company::find($request->company_id);
        
        // Update user's company_id
        $user->update(['company_id' => $request->company_id]);
        
        // Update company's owner_id
        $company->update(['owner_id' => $user->id]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Company assigned to user successfully.');
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['is_admin'] = $request->has('is_admin');

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_admin'] = $request->has('is_admin');
        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully');
    }
}
