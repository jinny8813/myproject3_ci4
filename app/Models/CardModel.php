<?php
namespace App\Models;
use CodeIgniter\Model;

class CardModel extends Model
{
    protected $table = 'cards';
    protected $primarykey = 'card_id';

    protected $allowedFields = ['card_id','book_id','card_title','card_content','card_state','create_at',
                'card_pronunciation','card_e_sentence','card_c_sentence','card_star','part_of_speech'];

        public function getLCardsInfo($book_id,$date){
        $where30="DATEDIFF('{$date}',e.create_at)<=30";
        $db = \Config\Database::connect();
        $builder = $db->table('cards c');
        $query = $builder->select("c.*,, count(e.log_id) as total, count(IF (e.choose = \"熟悉\",1,null)) as good, 
                (count(IF (e.choose = \"熟悉\",1,null))/count(e.log_id))*100 as score")
                ->join('eventlog e','c.card_id=e.card_id')
                ->where($where30)
                ->where('c.book_id', $book_id)
                ->groupBy('c.card_id')
                ->orderBy('score')
                ->get()->getResult();
        $data['cards']=array();
        foreach($query as $row){
            array_push($data['cards'],(array)$row);
        }
        return $data['cards'];
    }
}