<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12 ">
          <h3 class="p-3 m-3 text-center">創建書本</h3>
            <form action="" method="post" id="createBookForm">
                <div class="form-group row mb-3 d-none">
                    <div class="col-4">
                        <label for="user_id">作者ID</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="user_id" id="user_id" class="form-control" disabled value="<?= esc($user_id)?>">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="title">書本標題</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="title" id="title" class="form-control" placeholder="請輸入標題" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-4">
                        <label for="description">書本描述</label>
                    </div>
                    <div class="col-8">
                        <textarea  name="description"id="description" class="form-control" placeholder="請輸入描述" rows="10" required></textarea>
                    </div>
                </div>    
                <br>
                <div class="row mb-3  justify-content-center">
                    <button type="submit" name="submit" id="button" class="btn btn-primary col-2" onclick="doCreateBook()">送出</button>
                </div>
            </form>

<script>
    function doCreateBook(){
    event.preventDefault();

    let user_id = document.getElementById("user_id").value;
    let title = document.getElementById("title").value;
    let description = document.getElementById("description").value;

    $.ajax({
        url: "<?= base_url("Book/doCreateBook")?>",
        type: 'POST',
        dataType: 'json',
        data: {
            user_id:user_id,
            title:title,
            description:description
        }
    })
    .done(function(e){
        //window.location.reload();
        window.location.href = `<?= base_url('Book/myDesk')?>`;
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
                        <p class="text-center col-12">回到書櫃</p>
                        <a href="<?php echo base_url('Book') ?>" class="btn btn-primary col-2">返回</a>
                    </div>
        </div>
      </div>
    </div>
</section>
<?= $this->endSection()?>