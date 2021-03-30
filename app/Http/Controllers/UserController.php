<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
        */


    public function index()
    {
        $details = new Users;

        return $details->showAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = new Users($request->all());

        $messages = [
            'name.required' => 'A name is required',
            'email.required' => 'An email is required',
            'password.required' => 'A password is required',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email:filter|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ],$messages);

        $errors = $validator->errors();

        if ($validator->fails()) {
            return [
               'error'=> $errors->all(),
            ];
        }


        unset($user->password_confirmation);
        $user->password = bcrypt($request->password);
        if ($user->save()){
            return [
                'success'=> true,
                'status'=> 'Successfully Saved'
            ];
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $user = Users::find($id);
        $data = $request->all();

        if (!$user) {
            return [
                'status' => 'error',
                'message' => 'User does not exist'
            ];
        }

        $user->fill($data);
        $user->save();
        return [
            'status' => 'success',
            'message' => 'User is updated',
            'data' => $user
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Users::find($id);

        if (!$user) {
            return [
                'status' => 'error',
                'message' => 'User does not exist'
            ];
        }

        $deleted = $user->delete();

        if (!$deleted) {[
                'status' => 'fail',
                'message' => 'failed to delete user'
            ];
        }
        return [
            'status' => 'success',
            'message' => 'user deleted'
        ];

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

}