<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">我的測驗</h3>
          <hr>
          <div class="py-3">
            <a href="<?= base_url('Quiz/createQuiz')?>" class="btn btn-primary mx-3">建立測驗</a>
          </div>



        </div>
      </div>
    </div>
</section>
<?= $this->endSection()?>