<?php
namespace App\Models;
use CodeIgniter\Model;

class EventlogModel extends Model
{
    protected $table = 'eventLog';
    protected $primarykey = 'log_id';

    protected $allowedFields = ['log_id','quiz_id','card_id','choose','create_at'];

}
