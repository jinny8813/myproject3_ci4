<?php
namespace App\Models;
use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'books';
    protected $primarykey = 'book_id';

    protected $allowedFields = ['book_id','user_id','book_title','book_description','create_at'];


}