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
            date_default_timezone_set('Asia/Taipei');
            $date = date('Y-m-d H:i:s');
            $cardModel = new CardModel();
            $data['newcards'] = $cardModel->where('book_id', $book_id)->whereIn('card_state', [0])->orderBy('card_id', 'DESC')->findAll();
            $data['cards']=$cardModel->getLCardsInfo($book_id,$date);
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
            date_default_timezone_set('Asia/Taipei');
            $date = date('Y-m-d H:i:s');
            $book_id = $this->request->getPost("book_id");
            $title = $this->request->getPost("title");
            $part_of_speech = $this->request->getPost("part_of_speech");
            $pronunciation = $this->request->getPost("pronunciation");
            $content = $this->request->getPost("content");
            $e_sentence = $this->request->getPost("e_sentence");
            $c_sentence = $this->request->getPost("c_sentence");
            $cardModel = new CardModel();
            $values = [
                'book_id'=>$book_id,
                'card_title'=>trim((string)$title),
                'part_of_speech'=>$part_of_speech,
                'card_pronunciation'=>trim((string)$pronunciation),
                'card_content'=>trim((string)$content),
                'card_e_sentence'=>trim((string)$e_sentence),
                'card_c_sentence'=>trim((string)$c_sentence),
                'card_state'=>0,
                'card_star'=>0,
                'create_at'=>$date,
            ];
            $cardModel->insert($values);
            $arr=['success_messages'=>"發文成功!!將跳轉回所有文章頁面",
                    'status_code'=>200];
            return $this->response->setJSON($arr);
        }else{
            return redirect()->to("User/login");
        }                
    }

    public function showCard($card_id)
    {
        if($this->isLogin()){
            $cardModel = new CardModel();
            $data['cards'] = $cardModel->where('card_id', $card_id)->findAll(1);
            return view("pages/singlecard",array_merge($this->memberData,$data)); 
        }else{
            return view('pages/login');
        }
    }

    public function editCard($card_id)
    {
        if($this->isLogin()){
            $cardModel = new CardModel();
            $data['cards'] = $cardModel->where('card_id', $card_id)->findAll(1);
            return view("pages/editcard",array_merge($this->memberData,$data)); 
        }else{
            return view('pages/login');
        }
    }

    public function doEditCard()
    {
        if($this->isLogin()){
            $cardModel = new CardModel();
            $card_id = $this->request->getPost("card_id");
            $title = $this->request->getPost("title");
            $part_of_speech = $this->request->getPost("part_of_speech");
            $pronunciation = $this->request->getPost("pronunciation");
            $content = $this->request->getPost("content");
            $e_sentence = $this->request->getPost("e_sentence");
            $c_sentence = $this->request->getPost("c_sentence");
            $cardModel->where('card_id', $card_id)->set('card_title', trim((string)$title))->set('part_of_speech', $part_of_speech)
                                                ->set('card_pronunciation', trim((string)$pronunciation))->set('card_content', trim((string)$content))
                                                ->set('card_e_sentence', trim((string)$e_sentence))->set('card_c_sentence', trim((string)$c_sentence))
                                                ->update();
            $arr=['success_messages'=>"發文成功!!將跳轉回所有文章頁面",
                'status_code'=>200];
            //echo json_encode($arr);
            return $this->response->setJSON($arr);
            // return view('pages/bloghome');
        }else{
            return view('pages/login');
        }
    }

    public function delete($card_id)
    {
        if($this->isLogin()){
            $cardModel = new CardModel();
            $cardModel->where('card_id', $card_id)->delete();
            return redirect()->to(base_url('Card/singlebook'));
        }else{
            return view('pages/login');
        }
    }
}

