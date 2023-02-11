<?php
namespace App\Models;
use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'books';
    protected $primarykey = 'book_id';

    protected $allowedFields = ['book_id','user_id','book_title','book_description','create_at'];

    public function getDeskInfo($user_id){
        $db = \Config\Database::connect();
        $builder = $db->table('books b');
        $query = $builder->select("b.book_title,b.book_id,b.create_at,COUNT(c.card_id)AS card_count")
                ->join('cards c','b.book_id=c.book_id','left')
                ->where('b.user_id', $user_id)
                ->groupBy('c.book_id')
                ->orderBy('b.book_id', 'desc')
                ->get()->getResult();
        $data['books']=array();
        foreach($query as $row){
            array_push($data['books'],(array)$row);
        }
        return $data['books'];
    }
}