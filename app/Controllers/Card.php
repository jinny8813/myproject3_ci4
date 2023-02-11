<?php

namespace App\Controllers;
use App\Models\CardModel;

class Card extends BaseController
{
    public function index()
    {
        if($this->isLogin()){
            
        }else{
            return redirect()->to("User/login");
        }
    }

    public function singlebook($book_id)
    {
        if($this->isLogin()){
            $cardModel = new CardModel();
            $data['cards'] = $cardModel->where('book_id', $book_id)->orderBy('card_id', 'DESC')->findAll();
            $addbook_id['book_id']=['book_id'=>$book_id];
            $arr=array_merge($this->memberData,$addbook_id);
            return view("pages/singlebook",array_merge($arr,$data)); 
        }else{
            return redirect()->to("User/login");
        }
    }

    public function createCard($book_id)
    {
        if($this->isLogin()){
            $addbook_id['book_id']=['book_id'=>$book_id];
            $arr=array_merge($this->memberData,$addbook_id);
            return view('pages/createcard',$arr);
        }else{
            return redirect()->to("User/login");
        }
    }

    public function doCreateCard()
    {
        if($this->isLogin()){
            $book_id = $this->request->getPost("book_id");
            $title = $this->request->getPost("title");
            $pronunciation = $this->request->getPost("pronunciation");
            $content = $this->request->getPost("content");
            $e_sentence = $this->request->getPost("e_sentence");
            $c_sentence = $this->request->getPost("c_sentence");
            $cardModel = new CardModel();
            $values = [
                'book_id'=>$book_id,
                'card_title'=>$title,
                'card_pronunciation'=>$pronunciation,
                'card_content'=>$content,
                'card_e_sentence'=>$e_sentence,
                'card_c_sentence'=>$c_sentence,
                'card_state'=>0,
                'card_star'=>0
            ];
            $cardModel->insert($values);
            $arr=['success_messages'=>"發文成功!!將跳轉回所有文章頁面",
                    'status_code'=>200];
            return $this->response->setJSON($arr);
        }else{
            return redirect()->to("User/login");
        }                
    }

}

