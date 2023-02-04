<?php

namespace App\Controllers;

class Card extends BaseController
{
    public function index()
    {
        if($this->isLogin()){
            return view('pages/home',$this->memberData);
        }else{
            return view('pages/login');
        }
    }
}
