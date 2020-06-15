<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EndUser;
use App\Models\RoleUser;
use App\Models\Region;
use App\Http\Controllers\Controller;
use DB;

class EndUserController extends Controller
{
    
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $affect = DB::table('end_user')
                    ->whereEmailAndPassword($email, $password)
                    ->get()->first();
        if (isset($affect)) {
            session(['isLogin' => $affect]);
            $response = "success";
        } else {
            $response = "user tidak ditemukan";
        }
        return response($response);
    }

    public function logout(){
        $request->session()->forget('isLogin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //
        $password = $request->input('password');
        $rePassword = $request->input('confirmPassword');
        $email = $request->input('email');
        $username = $request->input('username');
        $telepon = $request->input('telephone');

        $role = RoleUser::find($request->role);
        $region = Region::find($request->region);

        $affect = DB::table('end_user')->where('email', $email)->get()->count();
        if ($affect != 0) {
            if (strcmp($password, $rePassword) !== 0) {
                $response = "password didn't match";
            } else {
                $endUser = new EndUser();
                $endUser->username = $username;
                $endUser->email = $email;
                $endUser->telephone = $telepon;
                $endUser->password =  $password;
                $endUser->region()->associate($region);
                $endUser->role_user()->associate($role);
                $endUser->save();

                $response = "registered";
            }
        } else {
            $response = "account already exist";
        }
        return response($response);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EndUser  $endUser
     * @return \Illuminate\Http\Response
     */
    public function show(Request $endUser)
    {
        $id = $endUser->id_user;
        if (isset($id)) {
            $user = EndUser::find($id); 
            return response($user);
        } else {
            return 'id pengguna tidak ditemukan';
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EndUser  $endUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id_user');
        $username = $request->input('username');
        $telepon = $request->input('telephone');
        $email = $request->input('email');
        $region = $request->input('region');

        $endUser = EndUser::find($id);
        $affect = DB::table('end_user')->where('email', $email)->get()->count();
        if (isset($email)) {
            if ($affect != 0) {
                $response = "user already exist, use another email";
            } else {
                if ($endUser != null) {
                    $endUser->username = $username;
                    $endUser->email = $email;
                    $endUser->telephone = $telepon;
                    $endUser->password =  $password;
                    $endUser->region()->associate($region);
                    $endUser->role_user()->associate($role);
                    $endUser->save();
        
                    $response = "account updated";
                } else {
                    $response = "user id cant be found";
                }
            }
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EndUser  $endUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $endUser)
    {
        //
        $choosedEndUser = EndUser::find($endUser->id);
        $choosedEndUser->delete();

        return "data berhasil dihapus";
    }
}
