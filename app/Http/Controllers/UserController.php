<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Only super admin can change roles');
        }
    
        $request->validate([
            'role' => 'required|in:super_admin,admin,user'
        ]);
    
        $user->update(['role' => $request->role]);
    
        return back()->with('success', 'User role updated successfully');
    }
    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account!');
        }

        // Authorization check - only super_admin can delete users
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Only super admin can delete users');
        }

        // Prevent deleting the last super_admin
        if ($user->role === 'super_admin' && 
            User::where('role', 'super_admin')->count() <= 1) {
            return back()->with('error', 'Cannot delete the last super admin');
        }

        try {
            // Log the deletion
            Log::info('User deleted', [
                'deleted_by' => auth()->id(),
                'deleted_user' => $user->id,
                'at' => now()
            ]);

            $user->delete();

            return redirect()
                ->route('users.index')
                ->with('success', 'User deleted successfully');
                
        } catch (\Exception $e) {
            Log::error('User deletion failed: '.$e->getMessage());
            return back()->with('error', 'Failed to delete user');
        }
    }

    public function showResetPasswordForm(User $user)
    {
        if (!in_array(auth()->user()->role, ['super_admin', 'admin'])) {
            abort(403, 'You need admin privileges');
        }

        return view('users.reset-password', compact('user'));
    }

    public function resetPassword(Request $request, User $user)
    {
        if (!in_array(auth()->user()->role, ['super_admin', 'admin'])) {
            abort(403, 'You need admin privileges');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('users.index')->with('success', 'Password reset successfully');
    }
}