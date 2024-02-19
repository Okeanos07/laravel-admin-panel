<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class MemberController extends Controller
{
    public function login(Request $request) {
        $credentionals = $request->only('email','password');
        if (auth()->attempt($credentionals)) {
            return redirect(route('admin.index'));
       }

       return redirect()->back()->WithErrors(
           ['login'=>'Giriş bilgileri hatalı']
       );
    } 

    public function logout(){
        auth()->logout();

       return redirect(route('admin.login')); 
    }

    public function register(Request $request) {
        $data = $request->only('name', 'surname', 'email', 'password', 'repassword');
        //dd($data);

       if($data['password'] !== $data['repassword']){
            $message = ['type' => 'danger', 'description' => 'Parolala eşleşmedi'];
            return redirect()->back()->WithInput()->with(['message'=>$message]);
       }

        User::create(
            [
                'name' => $data['name'] .' '. $data['surname'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]
        );

        $message = ['type' => 'success', 'description' => 'Kayıt işlemi başarılı. Giriş yapabilirsiniz.'];
        return redirect(route('admin.login'))->with(['message'=>$message]);
    }
} 