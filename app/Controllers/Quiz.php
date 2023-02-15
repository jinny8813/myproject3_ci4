<?php

namespace App\Controllers;
use App\Models\BookModel;
use App\Models\CardModel;
use App\Models\QuizModel;
use App\Models\EventlogModel;

class Quiz extends BaseController
{
    public function index()
    {
        if($this->isLogin()){
            return view('pages/quizhome',$this->memberData);
        }else{
            return redirect()->to("User/login");
        }
    }

    public function createQuiz()
    {
        if($this->isLogin()){
            $bookModel=new BookModel();
            $data['books'] = $bookModel->where('user_id', $this->memberData['user_id'])->findAll();
            return view('pages/createquiz',array_merge($this->memberData,$data));
        }else{
            return redirect()->to("User/login");
        }
    }

    public function doCreateQuiz()
    {
        if($this->isLogin()){
            date_default_timezone_set('Asia/Taipei');
            $date = date('Y-m-d H:i:s', strtotime('+5 hours'));
            $user_id = $this->memberData['user_id'];
            $select_book = $this->request->getPost("select_book");
            $select_old = $this->request->getPost("select_old");
            $select_wrong = $this->request->getPost("select_wrong");
            $select_state = $this->request->getPost("select_state");
            $select_amount = $this->request->getPost("select_amount");
            $quizModel = new QuizModel();
            $data = $quizModel->getNewQuiz($select_book,$select_old,$select_wrong,$select_state,$select_amount);
            $quiz_list="";
            foreach ($data as $i):
                $quiz_list=$quiz_list.$i['card_id']."_";
            endforeach;
            $quizModel = new QuizModel();
            $values = [
                'user_id'=>$user_id,
                'select_book'=>$select_book,
                'select_old'=>$select_old,
                'select_wrong'=>$select_wrong,
                'select_state'=>$select_state,
                'select_amount'=>$select_amount,
                'quiz_list'=>$quiz_list,
                'create_at'=>$date,
            ];
            $quizModel->insert($values);
            $arr=['success_messages'=>"發文成功!!將跳轉回所有文章頁面",
                'status_code'=>200];
            return $this->response->setJSON($arr);
        }else{
            return redirect()->to("User/login");
        }                
    }

    public function startQuiz()
    {
        if($this->isLogin()){
            $quizModel = new QuizModel();
            $quizData = $quizModel->orderBy('create_at', 'DESC')->findAll(1);
            $quizArr=explode("_", $quizData[0]['quiz_list']);
            $cardModel = new CardModel();
            $data['cards'] = $cardModel->whereIn('card_id',$quizArr)->orderBy('title', 'RANDOM')->findAll();
            $quiz_id['quiz_id'] = ['quiz_id'=>$quizData[0]['quiz_id']];
            $tmp=array_merge($quiz_id,$data);
            $tmp=array_merge($this->memberData,$tmp);
            if (count($data['cards'])==0){
                return view('pages/noconformquiz');
            }else{
                return view('pages/startquiz',$tmp);
            }
        }else{
            return redirect()->to("User/login");
        }                
    }

    public function storeQuiz()
    {
        if($this->isLogin()){
            date_default_timezone_set('Asia/Taipei');
            $date = date('Y-m-d H:i:s', strtotime('+5 hours'));
            $quiz_id = $this->request->getPost("quiz_id");
            $selections = $this->request->getPost("selections");
            $bigArr = $this->request->getPost("bigArr");
            $eventlogModel = new EventlogModel();
            for($i=0;$i<count($selections);$i++){
                $values = [
                    'quiz_id'=>$quiz_id,
                    'card_id'=>$bigArr[$i]['card_id'],
                    'choose'=>$selections[$i],
                    'create_at'=>$date,
                ];
                $eventlogModel->insert($values);
            }
            for($i=0;$i<count($selections);$i++){
                $cardModel = new CardModel();
                $state = $cardModel->where('card_id', $bigArr[$i]['card_id'])->findAll();
                $update_state=-1;
                if($state[0]['card_state']==0){
                    $update_state=5;
                    switch($selections[$i]){
                        case "忘記":
                            $update_state=$update_state-4;
                            break;
                        case "模糊":
                            $update_state=$update_state-2;
                            break;
                        case "熟悉":
                            $update_state=$update_state+3;
                            break;
                    }
                }else{
                    $update_state=$state[0]['card_state'];
                    switch($selections[$i]){
                        case "忘記":
                            $update_state=$update_state-2;
                            break;
                        case "模糊":
                            $update_state=$update_state-1;
                            break;
                        case "熟悉":
                            $update_state=$update_state+1;
                            break;
                    }
                    if($update_state>=10){
                        $update_state=10;
                    }else if($update_state<=1){
                        $update_state=1;
                    }
                }
                $cardModel->where('card_id', $state[0]['card_id'])->set('card_state', $update_state)->update();
            }
            $arr=['success_messages'=>"發文成功!!將跳轉回所有文章頁面",
                'status_code'=>200];
            return $this->response->setJSON($arr);
        }else{
            return redirect()->to("User/login");
        }
    }

}

