<?php

namespace App\Http\Controllers;

use App\Data\Models\Unit;
use App\Data\Models\User;
use App\Data\Repositories\Unit\UnitRepository;
use App\Data\Transformers\UserTransformer;
use App\Http\Requests\UserPostRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * UserController constructor.
     *
     * @param UnitRepository $unitRepo
     */
    public function __construct(
        protected UnitRepository $unitRepo
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        UserTransformer::transformCollection($users);

        return Inertia::render('Users/Index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Users/Create', [
            'unitsOptions' => $this->unitRepo->getAll(false),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostRequest $request)
    {
        // valid request
        $attributes = $request->safe()->only(['name', 'email', 'phone', 'role', 'unit']);

        //TODO: generate a random first time password EMAIL THE PASSWORD

        // save the details
        $user = User::create($attributes);

        if (isset($attributes['unit'])) {
            $user->tenant()->create(['unit_id' => $attributes['unit'], 'is_active' => true]);
        }

        // redirect
        return redirect()->route('users.show', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return Inertia::render('Users/Show', [
            'user' => UserTransformer::transform($user),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => UserTransformer::transformForEdit($user),
            'unitsOptions' => Unit::select(['id', 'name'])->get()->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserPostRequest  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserPostRequest $request, User $user)
    {
        // valid request
        $attributes = $request->safe()->only(['name', 'email', 'phone', 'role', 'unit']);

        // update a user record
        $user->update($attributes);

        // update the tenant record
        $user->tenant()->update([
            'unit_id' => $attributes['unit'],
        ]);

        // redirect
        return redirect()->route('users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
