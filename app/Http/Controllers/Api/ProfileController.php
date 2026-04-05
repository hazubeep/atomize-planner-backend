<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(Request $request)
    {

        return response()->json([
            'succes' => true,
            'data' => $request->user()
        ], 200);
    }

    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $request->user()->fresh()
        ]);
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120']
        ]);

        $user = $request->user();


        if ($user->avatar_path) {
            Storage::disk('public')->delete($user->avatar_path);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar_path' => $path]);

        return response()->json([
            'success' => true,
            'data' => ['avatar_url' => Storage::disk('public')->url($path)]
        ]);
    }

    public function removeAvatar(Request $request)
    {
        $user = $request->user();

        if ($user->avatar_path) {
            Storage::disk('public')->delete($user->avatar_path);
            $user->update(['avatar_path' => null]);
        }

        return response()->json([
            'success' => true,
            'data'    => ['avatar_url' => null],
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'current_password']
        ]);

        $user = $request->user();

        if ($user->avatar_path) {
            Storage::disk('public')->delete($user->avatar_path);
        }

        $user->tokens()->delete();
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Account has been permanently deleted.'
        ]);
    }
}
