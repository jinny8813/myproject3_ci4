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
            return view('pages/statisticshome',$this->memberData);
        }else{
            return redirect()->to("User/login");
        }
    }

    public function dailyStatistics()
    {
        if($this->isLogin()){
            date_default_timezone_set('Asia/Taipei');
            $date['date'] = date('Y-m-d');

            $user_id = $this->memberData['user_id'];
            $bookModel=new BookModel();
            $data1 = $bookModel->where('user_id', $user_id)->findAll();
            $data_book_id=[];
            foreach($data1 as $i){
                $data_book_id[] = $i['book_id'];
            }
            $cardModel = new CardModel();
            $data2['my_cards'] = $cardModel->whereIn('book_id', $data_book_id)->findAll();
            $data_card_id=[];
            foreach($data2['my_cards'] as $i){
                $data_card_id[] = $i['card_id'];
            }
            $eventlogModel = new EventlogModel();
            $where="DATE(create_at) = '".$date['date']."'";
            $data3['today_logs'] = $eventlogModel->where($where)->whereIn('card_id', $data_card_id)->findAll();



            $tmp=array_merge($data2,$data3);
            $tmp=array_merge($tmp,$date);
            $tmp=array_merge($this->memberData,$tmp);
            return view('pages/statistics',$tmp);
        }else{
            return redirect()->to("User/login");
        }
    }

    public function changeDate()
    {
        if($this->isLogin()){
            $changedate = $this->request->getPost("changedate");
            $date['date'] = $changedate;

            $user_id = $this->memberData['user_id'];
            $bookModel=new BookModel();
            $data1 = $bookModel->where('user_id', $user_id)->findAll();
            $data_book_id=[];
            foreach($data1 as $i){
                $data_book_id[] = $i['book_id'];
            }
            $cardModel = new CardModel();
            $data2['my_cards'] = $cardModel->whereIn('book_id', $data_book_id)->findAll();
            $data_card_id=[];
            foreach($data2['my_cards'] as $i){
                $data_card_id[] = $i['card_id'];
            }
            $eventlogModel = new EventlogModel();
            $where="DATE(create_at) = '".$date['date']."'";
            $data3['today_logs'] = $eventlogModel->where($where)->whereIn('card_id', $data_card_id)->findAll();



            $tmp=array_merge($data2,$data3);
            $tmp=array_merge($tmp,$date);
            $tmp=array_merge($this->memberData,$tmp);
            view('pages/statistics', $tmp);

            $arr=['changedate'=>$changedate,
                    'success_messages'=>"發文成功!!將跳轉回所有文章頁面",
                    'status_code'=>200];
            return $this->response->setJSON($tmp);
        }else{
            return redirect()->to("User/login");
        }
    }
    
}