<?php

namespace App\Controllers;
use App\Models\BookModel;

class Book extends BaseController
{
    public function index()
    {
        if($this->isLogin()){
            $user_id=$this->memberData['user_id'];
            $bookModel = new BookModel();
            $data['books']=$bookModel->getDeskInfo($user_id);
            return view('pages/mydesk',array_merge($this->memberData,$data));
        }else{
            return redirect()->to("User/login");
        }
    }

    public function createBook()
    {
        if($this->isLogin()){
            return view('pages/createbook',$this->memberData);
        }else{
            return redirect()->to("User/login");
        }
    }

    public function doCreateBook()
    {
        if($this->isLogin()){
            date_default_timezone_set('Asia/Taipei');
            $date = date('Y-m-d H:i:s');
            $user_id = $this->request->getPost("user_id");
            $title = $this->request->getPost("title");
            $description = $this->request->getPost("description");
            $bookModel = new BookModel();
            $values = [
                'user_id'=>$user_id,
                'book_title'=>$title,
                'book_description'=>$description,
                'create_at'=>$date,
            ];
            $bookModel->insert($values);
            $arr=['success_messages'=>"發文成功!!將跳轉回所有文章頁面",
                    'status_code'=>200];
            //echo json_encode($arr);
            return $this->response->setJSON($arr);
            // return view('pages/bloghome');
        }else{
            return redirect()->to("User/login");
        }                
    }

    public function editBook($book_id)
    {
        if($this->isLogin()){
            $bookModel = new BookModel();
            $data['books'] = $bookModel->where('book_id', $book_id)->findAll(1);
            return view("pages/editbook",array_merge($this->memberData,$data)); 
        }else{
            return view('pages/login');
        }
    }

    public function doEditBook()
    {
        if($this->isLogin()){
            $bookModel = new BookModel();
            $book_id = $this->request->getPost("book_id");
            $title = $this->request->getPost("title");
            $description = $this->request->getPost("description");
            $bookModel->where('book_id', $book_id)->set('book_title', $title)->set('book_description', $description)->update();
            $arr=['success_messages'=>"發文成功!!將跳轉回所有文章頁面",
                'status_code'=>200];
            //echo json_encode($arr);
            return $this->response->setJSON($arr);
            // return view('pages/bloghome');
        }else{
            return view('pages/login');
        }
    }

    public function delete($book_id)
    {
        if($this->isLogin()){
            $bookModel = new BookModel();
            $bookModel->where('book_id', $book_id)->delete();
            return redirect()->to(base_url('Book'));
        }else{
            return view('pages/login');
        }
    }
}

