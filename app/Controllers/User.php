<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        if($this->isLogin()){
            return view('pages/home',$this->memberData);
        }else{
            return view('pages/home');
            //return view('pages/login');
        }
    }
}
