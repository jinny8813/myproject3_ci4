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
            $content = $this->request->getPost("content");
            $cardModel = new CardModel();
            $values = [
                'book_id'=>$book_id,
                'card_title'=>$title,
                'card_content'=>$content,
                'card_state'=>0
            ];
            $cardModel->insert($values);
            $arr=['success_messages'=>"發文成功!!將跳轉回所有文章頁面",
                    'status_code'=>200];
            //echo json_encode($arr);
            return $this->response->setJSON($arr);
            // return view('pages/bloghome');
        }else{
            return redirect()->to("User/login");
        }                
    }

    // public function singlebook($user_id)
    // {
    //     if($this->isLogin()){
    //         $cardModel = new CardModel();
    //         $data['books'] = $cardModel->findAll($user_id);
    //         return view("pages/singlebook",array_merge($this->memberData,$data)); 
    //     }else{
    //         return view('pages/login');
    //     }
    // }

    // public function personal()
    // {
    //     if($this->isLogin()){
    //         $blogModel = new BlogModel();
    //         $data['blogs'] = $blogModel->where('authorId', $this->memberData['userId'])->orderBy('id', 'DESC')->findAll();
    //         if($data){
    //             return view('pages/personal',array_merge($this->memberData,$data));
    //         }else{
    //             $err=['error_messages'=>"尚未發表文章",
    //             'status_code'=>400];
    //             return view('pages/personal',array_merge($this->memberData,$err));
    //         }
    //     }else{
    //         return view('pages/login');
    //     }
    // }

    // public function editBlog($id)
    // {
    //     if($this->isLogin()){
    //         $blogModel = new BlogModel();
    //         $data['blogs'] = $blogModel->find($id);
    //         return view("pages/editblog",array_merge($this->memberData,$data)); 
    //     }else{
    //         return view('pages/login');
    //     }
    // }

    // public function doEdit()
    // {
    //     if($this->isLogin()){
    //         $blogModel = new BlogModel();
    //         $id = $this->request->getPost("blogID");
    //         $blogModel->find($id);
    //         $title = $this->request->getPost("title");
    //         $content = $this->request->getPost("content");
    //         $values = [
    //             'title'=>$title,
    //             'content'=>$content,
    //         ];
    //         $blogModel->update($id,$values);
    //         $arr=['success_messages'=>"發文成功!!將跳轉回所有文章頁面",
    //             'status_code'=>200];
    //         //echo json_encode($arr);
    //         return $this->response->setJSON($arr);
    //         // return view('pages/bloghome');
    //     }else{
    //         return view('pages/login');
    //     }
    // }

    // public function delete($id)
    // {
    //     if($this->isLogin()){
    //         $blogModel = new BlogModel();
    //         $blogModel->delete($id);
    //         return redirect()->to(base_url('Blog'));
    //     }else{
    //         return view('pages/login');
    //     }
    // }
}

