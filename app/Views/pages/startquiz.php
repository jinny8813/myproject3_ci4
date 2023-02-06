<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">測驗<?= $quiz_id['quiz_id']?>進行中</h3>
          <hr>
          
          <?php foreach($cards as $row):?>
            <div class="card my-3">
                <div class="card-body py-5 my-5">
                    <h5 class="card-title text-center fs-3"><?= $row['card_title']?></h5>
                    <p class="text-center fs-3"><?= $row['card_content']?></p>
                </div>
            </div>
          <?php endforeach;?>



        </div>
      </div>
    </div>
</section>
<?= $this->endSection()?>