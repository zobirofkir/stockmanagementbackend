<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Facades\UserFacade;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection
    {
        return UserFacade::index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return UserResource
     */
    public function store(UserRequest $request) : UserResource
    {
        return UserFacade::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @return UserResource
     */
    public function show(User $user) : UserResource
    {
        return UserFacade::show($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return UserResource
     */
    public function update(UserRequest $request, User $user): UserResource
    {
        return UserFacade::update($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return bool
     */
    public function destroy(User $user) : bool
    {
        return UserFacade::destroy($user);
    }
}
