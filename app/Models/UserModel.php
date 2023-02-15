<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['user_id','email', 'password','nickname','create_at'];

    public function getMember($email,$password)
    {
        $memberData = $this->asArray()
                            ->where(['email' => $email,'password' =>$password])
                            ->first();

        return $memberData ?? false;
    }
}