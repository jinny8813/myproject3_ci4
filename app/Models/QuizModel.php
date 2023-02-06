<?php
namespace App\Models;
use CodeIgniter\Model;

class QuizModel extends Model
{
    protected $table = 'Quizzes';
    protected $primarykey = 'quiz_id';

    protected $allowedFields = ['quiz_id','user_id','select_book','select_old','select_wrong','select_state','select_amount','add_random','quiz_list','create_at'];

}
