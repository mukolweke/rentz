<?php

namespace App\Http\Controllers;

use App\Data\Constants;
use App\Data\Models\NextOfKin;
use App\Data\Models\Unit;
use App\Data\Models\User;
use App\Data\Repositories\Unit\UnitRepository;
use App\Data\Transformers\NextOfKinTransformer;
use App\Data\Transformers\UnitTransformer;
use App\Data\Transformers\UserTransformer;
use App\Http\Requests\NextOfKinPostRequest;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Str;
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
        $attributes = $request->safe()->only(
            ['name', 'email', 'phone', 'role', 'unit', 'occupation', 'house', 'staffRole']
        );

        // save the details
        $user = User::create($attributes);

        if ($request->hasFile('avatar')) {
            $user->addMediaFromRequest('avatar')
                ->usingName(Str::slug($user->name, '-'))
                ->toMediaCollection(Constants::USER_AVATAR_COLLECTION);
        }

        if (isset($attributes['unit'])) {
            $user->tenant()->create(['unit_id' => $attributes['unit'], 'is_active' => true]);

            // Mark unit as assigned
            \DB::table('units')->where('id', $attributes['unit'])->update(['status' => true]);
        }

        if (isset($attributes['house'])) {
            $user->staff()->create(['house_id' => $attributes['house'], 'role' => $attributes['staffRole']]);
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
            'unit' => $user->tenant ? UnitTransformer::assignedUnitTransformer($user->tenant->unit) : null,
            'nextOfKins' => NextOfKinTransformer::transformCollection($user->nextOfKins)
        ]);
    }

    /**
     * Updates the current saved avatar of a user
     *
     * @param \Illuminate\Http\Request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request, User $user)
    {
        $request->validate([
            'avatar' => 'required|file'
        ]);

        if ($request->hasFile('avatar')) {
            $user->addMediaFromRequest('avatar')
                ->usingName(Str::slug($user->name, '-'))
                ->toMediaCollection(Constants::USER_AVATAR_COLLECTION);
        }

        // redirect
        return redirect()->back();
    }

    /**
     * Updates the current saved header of a user
     *
     * @param \Illuminate\Http\Request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateHeader(Request $request, User $user)
    {
        $request->validate([
            'header' => 'required|file'
        ]);

        if ($request->hasFile('header')) {
            $user->addMediaFromRequest('header')
                ->usingName(Str::slug($user->name, '-'))
                ->toMediaCollection(Constants::USER_HEADER_COLLECTION);
        }

        // redirect
        return redirect()->back();
    }

    /**
     * Remove the current saved avatar from a user
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function removeAvatar(User $user)
    {
        $user->clearMediaCollection(Constants::USER_AVATAR_COLLECTION);

        // redirect
        return redirect()->back();
    }

    /**
     * Remove the current saved header from a user
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function removeHeader(User $user)
    {
        $user->clearMediaCollection(Constants::USER_HEADER_COLLECTION);

        // redirect
        return redirect()->back();
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
        $attributes = $request->safe()->only(['name', 'email', 'phone', 'role', 'occupation', 'house', 'staffRole']);

        // update a user record
        $user->update($attributes);

        if ($request->hasFile('avatar')) {
            $user->addMediaFromRequest('avatar')
                ->usingName(Str::slug($user->name, '-'))
                ->toMediaCollection(Constants::USER_AVATAR_COLLECTION);
        } else {
            // when user removes avatar and sets default
            $user->clearMediaCollection(Constants::USER_AVATAR_COLLECTION);
        }

        if (isset($attributes['house'])) {
            $user->staff()->update(['house_id' => $attributes['house'], 'role' => $attributes['staffRole']]);
        }

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

    public function nextOfKin(NextOfKinPostRequest $request, User $user)
    {
        // valid request
        $attributes = $request->safe()->only(['kins']);

        NextOfKin::where('user_id', $user->id)->forceDelete();

        foreach ($attributes['kins'] as $value) {
            NextOfKin::create(array_merge($value, ['user_id' => $user->id]));
        }

        // redirect
        return Auth::user()->isTenant() ? redirect()->back() : redirect()->route('users.show', $user->id);
    }
}
