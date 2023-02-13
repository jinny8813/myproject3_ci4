<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">沒有符合篩選條件的字卡</h3>
          <hr>
          <div class="text-center row justify-content-center py-5">
                <p class="text-center col-12">回到所有測驗</p>
                <a href="<?= base_url('Quiz')?>" class="btn btn-primary col-2">返回</a>
            </div>
        </div>
      </div>
    </div>
</section>
<?= $this->endSection()?>