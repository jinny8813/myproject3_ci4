<?php
namespace App\Models;
use CodeIgniter\Model;

class QuizModel extends Model
{
    protected $table = 'quizzes';
    protected $primarykey = 'quiz_id';

    protected $allowedFields = ['quiz_id','user_id','select_book','select_old','select_wrong','select_state','select_amount','add_random','quiz_list','create_at'];

    public function getNewQuiz($book_id,$select_old,$select_wrong,$select_state,$select_amount){
        switch ($select_state){
            case "差":
                $state=[1,2];
                break;
            case "弱":
                $state=[3,4];
                break;
            case "中":
                $state=[5,6];
                break;
            case "可":
                $state=[7,8];
                break;
            case "佳":
                $state=[9,10];
                break;
        }
        $db = \Config\Database::connect();
        $builder = $db->table('cards c');
        if($select_state=="未測驗"){
            if($select_wrong==0){
                $query = $builder->select("c.card_id")
                    ->where('c.book_id', $book_id)
                    ->where('DATEDIFF(CURDATE(),DATE(c.create_at))>=', $select_old)
                    ->whereIn('c.card_state', [0])
                    ->groupBy('c.card_id')
                    ->orderBy('title', 'RANDOM')
                    ->limit($select_amount)
                    ->get()->getResult();
            }else{
                $query = $builder->select("c.card_id")
                    ->join('eventlog e','c.card_id = e.card_id')
                    ->where('DATEDIFF(CURDATE(),DATE(c.create_at))>=', $select_old)
                    ->where('c.book_id', $book_id)
                    ->whereIn('c.card_state', [0])
                    ->whereIn('e.choose', ["模糊","忘記"])
                    ->where('DATEDIFF(CURDATE(),DATE(e.create_at))<=', 30)
                    ->groupBy('c.card_id')
                    ->having('c_count>='+$select_wrong)
                    ->orderBy('title', 'RANDOM')
                    ->limit($select_amount)
                    ->get()->getResult();
            }
        }else{
            if($select_wrong==0){
                $query = $builder->select("c.card_id")
                    ->join('eventlog e','c.card_id = e.card_id')
                    ->where('c.book_id', $book_id)
                    ->whereIn('c.card_state', $state)
                    ->where('DATEDIFF(CURDATE(),DATE(e.create_at))>=', $select_old)
                    ->groupBy('c.card_id')
                    ->orderBy('title', 'RANDOM')
                    ->limit($select_amount)
                    ->get()->getResult();
            }else{
                $query = $builder->select("c.card_id")
                    ->join('eventlog e','c.card_id = e.card_id')
                    ->where('DATEDIFF(CURDATE(),DATE(e.create_at))>=', $select_old)
                    ->where('c.book_id', $book_id)
                    ->whereIn('c.card_state', $state)
                    ->whereIn('e.choose', ["模糊","忘記"])
                    ->where('DATEDIFF(CURDATE(),DATE(e.create_at))<=', 30)
                    ->groupBy('c.card_id')
                    ->having('c_count>='+$select_wrong)
                    ->orderBy('title', 'RANDOM')
                    ->limit($select_amount)
                    ->get()->getResult();
            }
        }
        
        $data=array();
        foreach($query as $row){
            array_push($data,(array)$row);
        }
        return $data;
    }
}
