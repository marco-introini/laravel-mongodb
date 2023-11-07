<?php

namespace App\Http\Controllers;

use App\Models\UserMongoDB;
use Illuminate\Http\Request;

class UserMongoDBController extends Controller
{
    public function index()
    {
        return response()->json(UserMongoDB::all());
    }

    public function store(Request $request)
    {
        $validated = request()->validate([
            'guid' => ['required','string'],
            'first_name' => ['required','string'],
            'email' => ['required','email'],
            'password' => ['required','string'],
        ]);

        UserMongoDB::firstOrCreate($validated);

        return response(status: 201); // HTTP created
    }

    public function show($guid)
    {
        // guid is NOT unique
        $user = UserMongoDB::where('guid',$guid)->get();

        if ($user->isEmpty())
            return response(status:404);

        return response()->json($user);
    }

    public function update(Request $request, $guid)
    {
        // update only the first one
        $user = UserMongoDB::where('guid',$guid)->first();
        if (is_null($user))
            return response(status:404);

        $validated = request()->validate([
            'guid' => ['required','string'],
            'first_name' => ['required','string'],
            'email' => ['required','email'],
            'password' => ['required','string'],
        ]);

        $user->guid = $validated['guid'];
        $user->first_name = $validated['first_name'];
        $user->email = $validated['email'];
        $user->password = $validated['password'];

        $user->save();

        return response()->json($user);
    }

    public function destroy($guid)
    {
        $user = UserMongoDB::where('guid',$guid)->first();
        if (is_null($user))
            return response(status:404);
        $user->delete();

        return response(status: 204);
    }
}
