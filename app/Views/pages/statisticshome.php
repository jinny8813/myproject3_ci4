<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">我的測驗</h3>
          <hr>
          <div class="row justify-content-center">
            <a href="<?= base_url('Statistics/dailyStatistics')?>" class="btn btn-primary fs-5 p-3 m-3 col-5">每日統計</a>
            <a href="<?= base_url('Statistics/tracker')?>" class="btn btn-primary fs-5 p-3 m-3 col-5">月週打卡</a>
            <a href="#" class="btn btn-primary fs-5 p-3 m-3 col-5">開始測驗</a>
            <a href="#" class="btn btn-primary fs-5 p-3 m-3 col-5">開始測驗</a>
          </div>
        </div>
      </div>
    </div>
</section>
<?= $this->endSection()?>