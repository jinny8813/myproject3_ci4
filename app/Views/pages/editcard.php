<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12 ">
          <h3 class="p-3 m-3 text-center">編輯字卡</h3>
          <hr>
            <form action="" method="post" id="createBookForm">
                <div class="form-group row mb-3 d-none">
                    <div class="col-4">
                        <label for="card_id">字卡ID</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="card_id" id="card_id" class="form-control" disabled value="<?= esc($cards[0]['card_id'])?>">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="title">書本標題</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="title" id="title" class="form-control"  value="<?= esc($cards[0]['card_title'])?>" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="part_of_speech">選擇詞性:</label>
                    </div>
                    <div class="col-8">
                        <select name="part_of_speech" id="part_of_speech" class="form-select">
                            <option value="<?= esc($cards[0]['part_of_speech'])?>"><?= esc($cards[0]['part_of_speech'])?></option>
                            <option value="others">其他</option>
                            <option value="noun">noun</option>
                            <option value="pronoun">pronoun</option>
                            <option value="verb">verb</option>
                            <option value="adjective">adjective</option>
                            <option value="adverb">adverb</option>
                            <option value="preposition">preposition</option>
                            <option value="conjunction">conjunction</option>
                            <option value="phrase">phrase</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="pronunciation">卡片音標:</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="pronunciation" id="pronunciation" class="form-control" value="<?= esc($cards[0]['card_pronunciation'])?>">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="content">卡片翻譯:</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="content" id="content" class="form-control" value="<?= esc($cards[0]['card_content'])?>" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="e_sentence">範例造句:</label>
                    </div>
                    <div class="col-8">
                        <textarea  name="e_sentence"id="e_sentence" class="form-control" value="<?= esc($cards[0]['card_e_sentence'])?>" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="c_sentence">造句翻譯:</label>
                    </div>
                    <div class="col-8">
                        <textarea  name="c_sentence"id="c_sentence" class="form-control" value="<?= esc($cards[0]['card_c_sentence'])?>" rows="3" required></textarea>
                    </div>
                </div>    
                <br>
                <div class="row mb-3  justify-content-center">
                    <button type="submit" name="submit" id="button" class="btn btn-primary col-2" onclick="doEditCard()">更新</button>
                </div>
            </form>

<script>
    function doEditCard(){
    event.preventDefault();

    let card_id = document.getElementById("card_id").value;
    let title = document.getElementById("title").value;
    let part_of_speech = document.getElementById("part_of_speech").value;
    let pronunciation = document.getElementById("pronunciation").value;
    let content = document.getElementById("content").value;
    let e_sentence = document.getElementById("e_sentence").value;
    let c_sentence = document.getElementById("c_sentence").value;

    $.ajax({
        url: "<?= base_url("Card/doEditCard")?>",
        type: 'POST',
        dataType: 'json',
        data: {
            card_id:card_id,
            title:title,
            part_of_speech:part_of_speech,
            pronunciation:pronunciation,
            content:content,
            e_sentence:e_sentence,
            c_sentence:c_sentence
        }
    })
    .done(function(e){
        //window.location.reload();
        window.location.href = `<?= base_url('Card/showCard/'.$cards[0]['card_id'])?>`;
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
                        <a href="<?php echo base_url('Card/showCard/'.$cards[0]['card_id']) ?>" class="btn btn-primary col-2">返回</a>
                    </div>
        </div>
      </div>
    </div>
</section>
<?= $this->endSection()?>