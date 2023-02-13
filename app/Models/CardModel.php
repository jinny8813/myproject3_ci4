<?php
namespace App\Models;
use CodeIgniter\Model;

class CardModel extends Model
{
    protected $table = 'cards';
    protected $primarykey = 'card_id';

    protected $allowedFields = ['card_id','book_id','card_title','card_content','card_state','create_at',
                'card_pronunciation','card_e_sentence','card_c_sentence','card_star','part_of_speech'];

}