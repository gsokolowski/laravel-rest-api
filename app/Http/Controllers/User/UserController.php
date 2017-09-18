<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
//        return response()->json([
//            'data' => $users
//        ], 200);

        return $this->showAll($users, 200); // using trait
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationRules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        // validate request with validationRules
        $this->validate($request, $validationRules);

        $data = $request->all();

        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGULAR_USER;

        $user = User::create($data);
        //return response()->json(['data' => $user], 201);
        return $this->showOne($user, 201); // using trait
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
//        return response()->json([
//            'data' => $user
//        ], 200);

        return $this->showOne($user, 200); // using trait
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user == null) {
            return $this->errorResponse('Requested user does not exist', 404);
        }

        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
        ];

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        // user may update his email
        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }

        // user may update his password
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('admin')) {
            if (!$user->isVerified()) {
                //return response()->json(['error' => 'Only verified users can modify the admin field', 'code' => 409], 409);
                return $this->errorResponse('Only verified users can modify the admin field', 409);
            }
            $user->admin = $request->admin;
        }

        // if isDirty method returns that means something has changed on user model if doesn't return then
        // return that nothing has changed
        if (!$user->isDirty()) {
            //return response()->json(['error' => 'No changes passed for the user - specify values you would like to update', 'code' => 422], 422);
            return $this->errorResponse('No changes passed for the user - specify values you would like to update', 422);
        }

        // if is changed so you need to save changes
        $user->save();

        //return response()->json(['data' => $user], 200);
        return $this->showOne($user, 200); // using trait
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user == null) {
            return $this->errorResponse('Requested user does not exist', 404);
        }

        $user->delete();

        //return response()->json(['data' => $user], 200);
        return $this->showOne($user, 200); // using trait
    }
}
