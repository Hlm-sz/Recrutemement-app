<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
//     public function index()
//     {
//         $users = User::all();
//         return response()->json([
//             'users' => $users 
//         ], 200);
//     }

//     // Show a specific user
//     public function show($id)
//     {
//         $user = User::find($id);
//         if (!$user) {
//             return response()->json([
//                 'message' => 'User not found'
//             ], 404);
//         }
//         return response()->json([
//             'user' => $user
//         ], 200);
//     }

//     // Create a new user
//     public function store(Request $request)
// {
//     $validated = $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|string|email|max:255|unique:users',
//         'password' => 'required|string|min:6', // You might omit this if not needed
//         'usertype' => 'required|string',
//         'email_verified_at' => 'nullable|date', // Optional field
//         'created_at' => 'nullable|date',
//         'updated_at' => 'nullable|date',
//     ]);

//     $user = User::create([
//         'name' => $validated['name'],
//         'email' => $validated['email'],
//         'password' => bcrypt($validated['password']), // Hash the password
//         'usertype' => $validated['usertype'],
//         'email_verified_at' => $validated['email_verified_at'] ?? now(),
//         'created_at' => $validated['created_at'] ?? now(),
//         'updated_at' => $validated['updated_at'] ?? now(),
//     ]);

//     return response()->json([
//         'message' => 'User created successfully',
//         'user' => $user
//     ], 201);
// }


//     // Update an existing user
//     public function update(Request $request, $id)
//     {
//         $user = User::find($id);
//         if (!$user) {
//             return response()->json([
//                 'message' => 'User not found'
//             ], 404);
//         }

//         $validated = $request->validate([
//             'name' => 'sometimes|required|string|max:255',
//             'email' => 'sometimes|required|string|email|max:255|unique:users,email,'.$user->id,
//             'password' => 'sometimes|required|string|min:6',
//         ]);

//         $user->update([
//             'name' => $validated['name'] ?? $user->name,
//             'email' => $validated['email'] ?? $user->email,
//             'password' => isset($validated['password']) ? bcrypt($validated['password']) : $user->password,
//         ]);

//         return response()->json([
//             'message' => 'User updated successfully',
//             'user' => $user
//         ], 200);
//     }

//     // Delete a user
//     public function destroy($id)
//     {
//         $user = User::find($id);
//         if (!$user) {
//             return response()->json([
//                 'message' => 'User not found'
//             ], 404);
//         }

//         $user->delete();
//         return response()->json([
//             'message' => 'User deleted successfully'
//         ], 200);
//     }

    public function index()
    {
        $users = User::all();
        return view('users.index');
    }
    public function create()
    {
        return view('users.create');
    }

  

    /**
     * Store a newly created user in storage.
     */
     public function storeByAdmin(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'usertype' => ['required', 'string'],
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $request->usertype,
        ]);
    
        return redirect()->route('admin.dashboard')->with('success', 'User created successfully.');
    }
    
    

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            // 'password' => 'nullable|string|min:8|confirmed',
            'usertype' => 'required|string',
        ]);
    
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->usertype = $request->usertype;
        $user->save();
    
        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
    }
    

    /**
     * Remove the specified user from storage.
     */
    public function destroyByAdmin($id)
    {
        $currentUser = Auth::user();
    $user = User::findOrFail($id);
    dd();

    // Check authorization
    if (!$currentUser->can('delete', $user)) {
        abort(403, 'Unauthorized action.');
    }

    // Proceed with deletion
    $user->delete();


        // Redirect back with a success message
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
     }
    

}
