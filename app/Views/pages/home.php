<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
          <h3 class="p-3 m-3 text-center col-12"><?= esc($nickname)?>的個人主頁</h3>
          <a href="<?= base_url('Book')?>" class="btn btn-primary fs-5 p-3 m-3 col-5">我的書櫃</a>
          <a href="<?= base_url('Card')?>" class="btn btn-primary fs-5 p-3 m-3 col-5">所有單字</a>
          <a href="<?= base_url('Quiz')?>" class="btn btn-primary fs-5 p-3 m-3 col-5">開始測驗</a>
          <a href="<?= base_url('Statistics')?>" class="btn btn-primary fs-5 p-3 m-3 col-5">統計分析</a>
          <a href="#" class="btn btn-primary fs-5 p-3 m-3 col-5">個人設定</a>
          <a href="<?php echo base_url('User/doLogout') ?>" class="btn btn-primary fs-5 p-3 m-3 col-5">登出</a>
      </div>
    </div>
</section>
<?= $this->endSection()?>