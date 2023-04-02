<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Data\Models\Tenant;
use App\Data\Models\User;
use App\Data\Repositories\Unit\UnitRepository;
use App\Data\Transformers\TenantTransformer;
use App\Http\Requests\TenantPostRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TenantController extends Controller
{
    /**
     * HouseController constructor.
     *
     * @param CategoryRepository $categoryRepo
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
        $tenants = Tenant::latest()->paginate(5);
        TenantTransformer::transformCollection($tenants);

        return Inertia::render('Tenants/Index', [
            'tenants' => $tenants,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Tenants/Create', [
            'unitsOptions' => $this->unitRepo->getAll(false)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TenantPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TenantPostRequest $request)
    {
        // valid request
        $attributes = $request->safe()->only(['first_name', 'last_name', 'email', 'phone', 'unit_id']);

        // create a user record
        $user = User::create($attributes);

        // create a tenant record
        $tenant = $user->tenants()->create([
            'unit_id' => $attributes['unit_id'],
            'phone' => $attributes['phone'],
        ]);
        // save the details

        // redirect
        return redirect()->route('tenants.show', $tenant->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Data\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        return Inertia::render('Tenants/Show', [
            'tenant' => TenantTransformer::transform($tenant),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Data\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant)
    {
        return Inertia::render('Tenants/Edit', [
            'tenant' => TenantTransformer::transformForEdit($tenant),
            'unitsOptions' => $this->unitRepo->getAll(false)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TenantPostRequest  $request
     * @param  \App\Data\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(TenantPostRequest $request, Tenant $tenant)
    {
        // valid request
        $attributes = $request->safe()->only(['first_name', 'last_name', 'email', 'phone', 'unit_id']);

        // update a user record
        $tenant->user()->update([
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'email' => $attributes['email'],
        ]);

        // update the tenant record
        $tenant->update([
            'phone' => $attributes['phone'],
            'unit_id' => $attributes['unit_id'],
        ]);

        // redirect
        return redirect()->route('tenants.show', $tenant->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        //
    }
}
