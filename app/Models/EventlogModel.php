<?php
namespace App\Models;
use CodeIgniter\Model;

class EventlogModel extends Model
{
    protected $table = 'eventlog';
    protected $primarykey = 'log_id';

    protected $allowedFields = ['log_id','quiz_id','card_id','choose','create_at'];

    public function getWeekInfo($str_card_id,$start,$end){
        $where="t.date_ymd between '".$start."' and '".$end."'";
        $db = \Config\Database::connect();
        $builder = $db->table('dates t');
        $query = $builder->select("t.date_ymd, count(CAST(e.create_at AS DATE)) ccount")
                ->join('eventlog e',"t.date_ymd = CAST(e.create_at AS DATE) AND e.card_id IN (".$str_card_id.")",'left')
                ->where($where)
                ->groupBy('t.date_ymd')
                ->get()->getResult();
        $data['weekly_count']=array();
        foreach($query as $row){
            array_push($data['weekly_count'],(array)$row);
        }
        return $data['weekly_count'];
    }
}
