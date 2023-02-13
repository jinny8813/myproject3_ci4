<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12 ">
          <h3 class="p-3 m-3 text-center">創建測驗</h3>
            <form action="" method="post" id="createQuizForm">
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="select_book">選擇書本:</label>
                    </div>
                    <div class="col-8">
                        <select name="select_book"id="select_book" class="form-select">
                            <?php foreach($books as $row):?>
                                <option value="<?= $row['book_id']?>"><?= $row['book_title']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="select_old">未複習逾:</label>
                    </div>
                    <div class="col-8">
                        <select name="select_old"id="select_old" class="form-select">
                            <option value="0">不限</option>
                            <option value="3">3天</option>
                            <option value="7">7天</option>
                            <option value="10">10天</option>
                            <option value="15">15天</option>
                            <option value="30">30天</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="select_wrong">近一月逾:</label>
                    </div>
                    <div class="col-8">
                        <select name="select_wrong"id="select_wrong" class="form-select">
                            <option value="0">不限</option>
                            <option value="5">5錯誤</option>
                            <option value="10">10錯誤</option>
                            <option value="15">15錯誤</option>
                            <option value="30">30錯誤</option>
                            <option value="50">50錯誤</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="select_state">字卡狀態:</label>
                    </div>
                    <div class="col-8">
                        <select name="select_state"id="select_state" class="form-select" disabled>
                            <option value="no">不限</option>
                            <option value="未測驗">未測驗</option>
                            <option value="差">差</option>
                            <option value="弱">弱</option>
                            <option value="中">中</option>
                            <option value="可">可</option>
                            <option value="佳">佳</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="select_amount">測驗數量:</label>
                    </div>
                    <div class="col-8">
                        <select name="select_amount"id="select_amount" class="form-select">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="500">500</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="">隨機補足:</label>
                    </div>
                    <div class="col-8">
                        <input class="form-check-input" type="radio" name="add_random" id="add_random1" checked value="no">
                        <label class="form-check-label" for="add_random1">不補足，有多少測驗多少</label>
                        <br>
                        <input class="form-check-input" type="radio" name="add_random" id="add_random2" disabled value="random">
                        <label class="form-check-label" for="add_random2">隨機補足至選擇之測驗數量</label>
                    </div>
                </div>
                <br>
                <br>
                <div class="row mb-3  justify-content-center">
                    <button type="submit" name="submit" id="button" class="btn btn-primary col-2" onclick="doCreateQuiz()">開始測驗</button>
                </div>
            </form>

<script>
    function doCreateQuiz(){
    event.preventDefault();

    let select_book = document.getElementById("select_book").value;
    let select_old = document.getElementById("select_old").value;
    let select_wrong = document.getElementById("select_wrong").value;
    let select_state = document.getElementById("select_state").value;
    let select_amount = document.getElementById("select_amount").value;

    $.ajax({
        url: "<?= base_url("Quiz/doCreateQuiz")?>",
        type: 'POST',
        dataType: 'json',
        data: {
            select_book:select_book,
            select_old:select_old,
            select_wrong:select_wrong,
            select_state:select_state,
            select_amount:select_amount,
        }
    })
    .done(function(e){
        //window.location.reload();
        window.location.href = `<?= base_url('Quiz/startQuiz')?>`;
    })
    .fail(function(e){
        try{
            $('#errorText').append(`status code: ${e.responseJSON.error}
                                    <br>
                                    error messages: ${e.responseJSON.messages.error}`);
        }catch(error){
            console.log(e);
            $('#errorText').html('伺服器連線失敗');
        }
    })
}
</script>
        
                    <div class="text-center row justify-content-center py-5">
                        <p class="text-center col-12">回到我的測驗</p>
                        <a href="<?= base_url('Quiz')?>" class="btn btn-primary col-2">返回</a>
                    </div>
        </div>
      </div>
    </div>
</section>
<?= $this->endSection()?>