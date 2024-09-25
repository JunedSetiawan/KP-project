<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolYear\SchoolYearRequest;
use App\Http\Requests\SchoolYear\UpdateSchoolYearRequest;
use App\Models\SchoolYear;
use App\Tables\SchoolYears;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class SchoolYearController extends Controller
{
    public function index()
    {
        $this->spladeTitle('School Year');
        // $this->authorize('viewAny', \App\Models\User::class);
        return view('pages.schoolyear.index', [
            'schoolyears' => SchoolYears::class,
        ]);
    }

    public function create()
    {
        $this->spladeTitle('Create School Year');

        // $roles = [
        //     'sales' => 'Sales',
        //     'purchase' => 'Purchase',
        //     'manager' => 'Manager',
        // ];


        return view('pages.schoolyear.create', [
           
        ]);
    }

    public function store(SchoolYearRequest $request)
    {
        // $this->authorize('create', \App\Models\User::class);

        $validated = $request->validated();

        // $validated['password'] = Hash::make($validated['password']);
        
        $schoolyear = SchoolYear::create($validated);

        Toast::success('School Year created successfully!')->autoDismiss(5);

        return redirect()->route('schoolyear.index');
    }

    public function edit(SchoolYear $schoolyear)
    {
        $this->spladeTitle('Edit School Year');

        // $roles = [
        //     'sales' => 'Sales',
        //     'purchase' => 'Purchase',
        //     'manager' => 'Manager',
        // ];



        return view('pages.schoolyear.edit', [
            'schoolyear' => $schoolyear,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolYearRequest $request, SchoolYear $schoolyear)
    {
        // $this->authorize('update', \App\Models\User::class);

        $validated = $request->validated();

        $schoolyear->update($validated);

        Toast::success('School Year updated successfully!')->autoDismiss(5);

        return redirect()->route('schoolyear.index');
    }

    public function destroy( SchoolYear $schoolyear)
    {
        // $this->authorize('delete', \App\Models\User::class);

        $schoolyear->delete();

        Toast::success('School Year deleted successfully!')->autoDismiss(5);

        return redirect()->route('schoolyear.index');
    }
}
