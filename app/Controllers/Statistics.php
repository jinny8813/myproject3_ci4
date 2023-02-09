<?php

namespace App\Controllers;
use App\Models\BookModel;
use App\Models\CardModel;
use App\Models\QuizModel;
use App\Models\EventlogModel;

class Statistics extends BaseController
{
    public function index()
    {
        if($this->isLogin()){
            return view('pages/statistics',$this->memberData);
        }else{
            return view('pages/login');
        }
    }

    public function showToday()
    {
        if($this->isLogin()){
            $user_id = $this->memberData['user_id'];
            $bookModel=new BookModel();
            $data['books'] = $bookModel->where('user_id', $user_id)->findAll();
            $cardModel = new CardModel();
            $data['cards'] = $cardModel->whereIn('book_id', $data['books'])->findAll();

            $tmp=array_merge($data['books'],$data['cards']);
            $tmp=array_merge($this->memberData,$tmp);
        }else{
            return view('pages/login');
        }
    }
}