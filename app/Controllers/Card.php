<?php

namespace App\Controllers;
use App\Models\CardModel;

class Card extends BaseController
{
    // public function index()
    // {
    //     if($this->isLogin()){
    //         return view('pages/home',$this->memberData);
    //     }else{
    //         return view('pages/login');
    //     }
    // }

    // public function myDesk()
    // {
    //     if($this->isLogin()){
    //         $cardModel = new CardModel();
    //         $data['books'] = $cardModel->orderBy('book_id', 'DESC')->findAll();
    //         return view('pages/mydesk',array_merge($this->memberData,$data));
    //     }else{
    //         return view('pages/login');
    //     }
    // }

    // public function createBook()
    // {
    //     if($this->isLogin()){
    //         return view('pages/createBook',$this->memberData);
    //     }else{
    //         return view('pages/login');
    //     }
    // }

    // public function doCreateBook()
    // {
    //     if($this->isLogin()){
    //         $user_id = $this->request->getPost("user_id");
    //         $title = $this->request->getPost("title");
    //         $description = $this->request->getPost("description");
    //         $cardModel = new CardModel();
    //         $values = [
    //             'user_id'=>$user_id,
    //             'book_title'=>$title,
    //             'book_description'=>$description,
    //         ];
    //         $cardModel->insert($values);
    //         $arr=['success_messages'=>"發文成功!!將跳轉回所有文章頁面",
    //                 'status_code'=>200];
    //         //echo json_encode($arr);
    //         return $this->response->setJSON($arr);
    //         // return view('pages/bloghome');
    //     }else{
    //         return view('pages/login');
    //     }                
    // }

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

