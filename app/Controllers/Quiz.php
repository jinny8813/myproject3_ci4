<?php

namespace App\Controllers;
use App\Models\BookModel;
use App\Models\CardModel;
use App\Models\QuizModel;

class Quiz extends BaseController
{
    public function index()
    {
        if($this->isLogin()){
            return view('pages/quizhome',$this->memberData);
        }else{
            return view('pages/login');
        }
    }

    public function createQuiz()
    {
        if($this->isLogin()){
            $bookModel=new BookModel();
            $data['books'] = $bookModel->where('user_id', $this->memberData['user_id'])->findAll();
            return view('pages/createquiz',array_merge($this->memberData,$data));
        }else{
            return view('pages/login');
        }
    }

    public function doCreateQuiz()
    {
        if($this->isLogin()){
            $user_id = $this->memberData['user_id'];
            $select_book = $this->request->getPost("select_book");
            $select_old = $this->request->getPost("select_old");
            $select_wrong = $this->request->getPost("select_wrong");
            $select_state = $this->request->getPost("select_state");
            $select_amount = $this->request->getPost("select_amount");
            $cardModel = new CardModel();
            $data = $cardModel->select('card_id')->where('book_id', $select_book)->orderBy('title', 'RANDOM')->findAll(4);
            $quiz_list="";
            foreach ($data as $i):
                $quiz_list=$quiz_list.$i['card_id']."_";
            endforeach;
            $quizModel = new QuizModel();
            $values = [
                'user_id'=>$user_id,
                'select_book'=>$select_book,
                'quiz_list'=>$quiz_list
            ];
            $quizModel->insert($values);
            $arr=['success_messages'=>"發文成功!!將跳轉回所有文章頁面",
                'status_code'=>200];
            return $this->response->setJSON($arr);
        }else{
            return view('pages/login');
        }                
    }

    public function startQuiz()
    {
        if($this->isLogin()){
            $quizModel = new QuizModel();
            $quizData = $quizModel->orderBy('create_at', 'DESC')->findAll(1);
            $quizArr=explode("_", $quizData[0]['quiz_list']);
            $cardModel = new CardModel();
            $data['cards'] = $cardModel->whereIn('card_id',$quizArr)->findAll();
            $quiz_id['quiz_id'] = ['quiz_id'=>$quizData[0]['quiz_id']];
            $tmp=array_merge($quiz_id,$data);
            $tmp=array_merge($this->memberData,$tmp);
            return view('pages/startquiz',$tmp);
        }else{
            return view('pages/login');
        }                
    }

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

