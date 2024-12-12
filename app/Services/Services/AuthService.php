<?php
namespace App\Services\Services;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\PutAutUserRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\PutAutUserResource;
use App\Models\User;
use App\Services\Constructors\AuthConstructor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthConstructor
{
    /**
     * Login A User
     *
     * @param AuthRequest $request
     * @return AuthResource
     */
    public function login(AuthRequest $request): AuthResource
    {
        $user = User::where('email', $request->email)->first();
        $validatedData = $request->validated();
        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            abort(401);
        }
        return AuthResource::make($user);
    }

    /**
     * Logout A User
     *
     * @return boolean
     */
    public function logout(): bool
    {
        $this->currentAuthenticatedUser(Auth::id())->tokens()->delete();
        return true;
    }

    /**
     * Update Current Authenticated User
     *
     * @param PutAutUserRequest $request
     * @return PutAutUserResource
     */
    public function update(PutAutUserRequest $request): PutAutUserResource
    {
        $user = $this->currentAuthenticatedUser(Auth::id());

        if (!$user) {
            abort(401);
        }

        $validatedData = $request->validated();

        if (isset($validatedData['image'])) {
            $validatedData['image'] = $request->file('image')->store('public');
        }

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return PutAutUserResource::make($user);
    }

    /**
     * Current Authenticated User
     *
     * @param integer $id
     * @return User
     */
    private function currentAuthenticatedUser(int $id): User
    {
        return User::findOrFail($id);
    }
}
