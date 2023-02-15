<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        if($this->isLogin()){
            return view('pages/home',$this->memberData);
        }else{
            return redirect()->to("User/login");
        }
    }

    public function login()
    {
        if($this->isLogin()){
            return redirect()->to("User");
        }else{
            return view('pages/login');
        }
    }

    public function register()
    {
        if($this->isLogin()){
            return redirect()->to("User");
        }else{
            return view('pages/register');
        }
    }

    public function doLogin()
    {
        if($this->isLogin()){
            $err=['error_messages'=>"已登入",
            'status_code'=>403];
            return view('pages/home',$this->memberData);
        }

        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        if($email == null || $password == null){
            $err=['error_messages'=>"需帳號密碼進行登入",
            'status_code'=>400];
            return view('pages/login',$err);
        }

        $userModel = new UserModel();
        $memberData = $userModel->getMember($email,$password);
        
        if($memberData){
            $this->session->set("memberData",$memberData);
            $this->response->setStatusCode(200);
            return redirect()->to("User");
            return $this->response->setJSON([
                "msg" => "OK"
            ]);
        }else{
            $err=['error_messages'=>"帳號或密碼錯誤",
            'status_code'=>400];
            return view('pages/login',$err);
            //return $this->fail("帳號或密碼錯誤",400);
        }
    }
    public function doRegister(){
        date_default_timezone_set('Asia/Taipei');
        $date = date('Y-m-d H:i:s');
        print_r($date);
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        $cpassword = $this->request->getPost("cpassword");
        $nickname = $this->request->getPost("nickname");
        if($password == null || $cpassword == null || $email == null || $nickname == null){
            $err=['error_messages'=>"需帳號密碼等資料進行註冊",
            'status_code'=>400];
            return view('pages/register',$err);
            //return $this->fail("需帳號密碼等資料進行註冊",400);
        }
        if($password != $cpassword){
            $err=['error_messages'=>"密碼驗證錯誤",
            'status_code'=>400];
            return view('pages/register',$err);
            //return $this->fail("密碼驗證錯誤",400);
        }
        $userModel = new UserModel();
        $temp = $userModel->where('email', $email)->first();
        if($temp != null){
            $err=['error_messages'=>"帳號已被註冊",
            'status_code'=>400];
            return view('pages/register',$err);
            //return $this->fail("帳號已被註冊",400);
        }
        $values = [
            'email'=>$email,
            'password'=>$password,
            'nickname'=>$nickname,
            'create_at'=>$date,
        ];
        $query = $userModel->insert($values);
        if( !$query ){
            $err=['error_messages'=>"未知錯誤",
            'status_code'=>400];
            return view('pages/register',$err);
            //return  $this->fail("未知錯誤",400);
        }else{
            $go=['go_messages'=>"註冊成功，前往登入頁面",
            'status_code'=>200];
            return view('pages/login',$go);
        }
    }
    public function doLogout()
    {
        $this->session->destroy();
        return redirect()->to("/User");
    }

}
