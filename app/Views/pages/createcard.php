<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12 ">
          <h3 class="p-3 m-3 text-center">創建卡片</h3>
          <hr>
            <form action="" method="post" id="createCardForm">
                <div class="form-group row mb-3 d-none">
                    <div class="col-4">
                        <label for="book_id">書本ID</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="book_id" id="book_id" class="form-control" disabled value="<?= $book_id['book_id']?>">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="title">卡片標題:</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="title" id="title" class="form-control" placeholder="請輸入標題" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="pronunciation">卡片音標:</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="pronunciation" id="pronunciation" class="form-control" placeholder="請輸入音標">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="content">卡片翻譯:</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="content" id="content" class="form-control" placeholder="請輸入標題" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="e_sentence">範例造句:</label>
                    </div>
                    <div class="col-8">
                        <textarea  name="e_sentence"id="e_sentence" class="form-control" placeholder="請輸入範例造句" rows="4"></textarea>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="c_sentence">造句翻譯:</label>
                    </div>
                    <div class="col-8">
                        <textarea  name="c_sentence"id="c_sentence" class="form-control" placeholder="請輸入造句翻譯" rows="4" required></textarea>
                    </div>
                </div>  
                <br>
                <div class="row mb-3  justify-content-center">
                    <button type="submit" name="submit" id="button" class="btn btn-primary col-2" onclick="doCreateCard()">送出</button>
                </div>
            </form>

<script>
    function doCreateCard(){
    event.preventDefault();

    let book_id = document.getElementById("book_id").value;
    let title = document.getElementById("title").value;
    let pronunciation = document.getElementById("pronunciation").value;
    let content = document.getElementById("content").value;
    let e_sentence = document.getElementById("e_sentence").value;
    let c_sentence = document.getElementById("c_sentence").value;

    $.ajax({
        url: "<?= base_url("Card/doCreateCard")?>",
        type: 'POST',
        dataType: 'json',
        data: {
            book_id:book_id,
            title:title,
            pronunciation:pronunciation,
            content:content,
            e_sentence:e_sentence,
            c_sentence:c_sentence
        }
    })
    .done(function(e){
        //window.location.reload();
        window.location.href = `<?= base_url('Card/singlebook/'.$book_id['book_id'])?>`;
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
                        <p class="text-center col-12">回到書本</p>
                        <a href="<?= base_url('Card/singlebook/'.$book_id['book_id'])?>" class="btn btn-primary col-2">返回</a>
                    </div>
        </div>
      </div>
    </div>
</section>
<?= $this->endSection()?>