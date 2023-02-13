<?php
namespace App\Models;
use CodeIgniter\Model;

class QuizModel extends Model
{
    protected $table = 'quizzes';
    protected $primarykey = 'quiz_id';

    protected $allowedFields = ['quiz_id','user_id','select_book','select_old','select_wrong','select_state','select_amount','add_random','quiz_list','create_at'];

    public function getNewQuiz($book_id,$select_old,$select_wrong,$select_amount){
        $db = \Config\Database::connect();
        $builder = $db->table('cards c');
        if($select_wrong==0){
            $query = $builder->select("c.card_id")
                ->join('eventlog e','c.card_id = e.card_id')
                ->where('DATEDIFF(CURDATE(),DATE(e.create_at))>', $select_old)
                ->where('c.book_id', $book_id)
                ->groupBy('c.card_id')
                ->limit($select_amount)
                ->get()->getResult();
        }else{
            $query = $builder->select("c.card_id")
                ->join('eventlog e','c.card_id = e.card_id')
                ->where('DATEDIFF(CURDATE(),DATE(e.create_at))>', $select_old)
                ->where('c.book_id', $book_id)
                ->whereIn('e.choose', ["模糊","忘記"])
                ->where('DATEDIFF(CURDATE(),DATE(e.create_at))<', 30)
                ->groupBy('c.card_id')
                ->having('c_count>='+$select_wrong)
                ->limit($select_amount)
                ->get()->getResult();
        }
        
        $data=array();
        foreach($query as $row){
            array_push($data,(array)$row);
        }
        return $data;
    }
}
