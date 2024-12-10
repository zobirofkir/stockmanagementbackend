<?php
namespace App\Services\Services;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Constructors\UserConstructor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserService implements UserConstructor
{
    /**
     * Get all users
     *
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection {
        return UserResource::collection(
            User::paginate(10)
        );
    }

    /**
     * Show a user
     *
     *  @return  UserResource
     */
    public function show(User $user) : UserResource {
        return new UserResource($user);
    }

    /**
     * Create a user
     *
     * @return UserResource
     */
    public function store(UserRequest $request) : UserResource {
        return UserResource::make(
            User::create($request->all())
        );
    }

    /**
     * Update a user
     *
     * @return UserResource
     */
    public function update(UserRequest $request , User $user) : UserResource {
        $user->update($request->validated());

        return UserResource::make(
            $user->refresh()
        );
    }

    /**
     * Delete a user
     *
     * @return bool
     */
    public function destroy(User $user) : bool {
        return $user->delete();
    }
}
