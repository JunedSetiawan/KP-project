<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Imports\UsersImport;
use App\Models\User;
use App\Tables\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use ProtoneMedia\Splade\Facades\Toast;

class UserController extends Controller
{
    public function index()
    {
        $this->spladeTitle('User');
        $this->authorize('viewAny', \App\Models\User::class);
        return view('pages.user.index', [
            'users' => Users::class,
        ]);
    }

    public function create()
    {
        $this->spladeTitle('Create User');

        $roles = [
            'sales' => 'Sales',
            'purchase' => 'Purchase',
            'manager' => 'Manager',
        ];

        return view('pages.user.create', [
            'roles' => $roles
        ]);
    }

    public function store(UserRequest $request)
    {
        $this->authorize('create', \App\Models\User::class);

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        Toast::success('User created successfully!')->autoDismiss(5);

        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        $this->spladeTitle('Edit User');

        $roles = [
            'admin' => 'Admin',
            'user' => 'Guru BK',
        ];

        return view('pages.user.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', \App\Models\User::class);

        $validated = $request->validated();

        $user->update($validated);

        Toast::success('User updated successfully!')->autoDismiss(5);

        return redirect()->route('user.index');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', \App\Models\User::class);

        $user->delete();

        Toast::success('User deleted successfully!')->autoDismiss(5);

        return redirect()->route('user.index');
    }

    public function import(Request $request) 
    {
        try{
            // dd($request->import);
// 
            Excel::import(new UsersImport, $request->file('import')->store('files'));
            Toast::success('User import successfully!')->autoDismiss(5);
            return redirect()->route('user.index');
        }catch(\Exception $ex){
            Log::info($ex);
            Toast::danger( $ex)->autoDismiss(5);
            return redirect()->route('user.index');

        }
        
    }
}
