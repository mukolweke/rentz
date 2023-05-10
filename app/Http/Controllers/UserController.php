<?php

namespace App\Http\Controllers;

use App\Data\Models\Unit;
use App\Data\Models\User;
use App\Data\Repositories\Unit\UnitRepository;
use App\Data\Transformers\UserTransformer;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserEditRequest;
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
        $users = User::when(request()->get('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        UserTransformer::transformCollection($users);

        return Inertia::render('Users/Index', [
            'users' => $users,
            'filters' => request()->only(['search'])
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
        $attributes = $request->safe()->only(['name', 'email', 'phone', 'role', 'unit', 'occupation']);

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
     * @param  UserEditRequest  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, User $user)
    {
        // valid request
        $attributes = $request->safe()->only(['name', 'email', 'phone', 'role', 'occupation']);

        // update a user record
        $user->update($attributes);

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
