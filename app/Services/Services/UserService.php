<?php
namespace App\Services\Services;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Constructors\UserConstructor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class UserService implements UserConstructor
{
    /**
     * Get all users
     *
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection {
        return UserResource::collection(
            User::orderBy('created_at', 'desc')->get()
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
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('public');
        } elseif (!isset($validatedData['image'])) {
            $validatedData['image'] = asset("assets/images/default-image-path.jpg");
        }

        return UserResource::make(
            User::create($validatedData)
        );
    }

    /**
     * Update a user
     *
     * @return UserResource
     */
    public function update(UserRequest $request, User $user): UserResource
    {
        $validatedData = $request->validated();

        // Check if a new image is provided
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($user->image) {
                Storage::delete($user->image);
            }

            // Store the new image and update the validated data
            $validatedData['image'] = $request->file('image')->store('public');
        }

        // Update the user with the validated data
        $user->update($validatedData);

        // Return the updated user data
        return UserResource::make($user->refresh());
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
