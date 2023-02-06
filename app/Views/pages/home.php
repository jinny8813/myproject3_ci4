<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12 ">
          <h3 class="p-3 m-3 text-center"><?= esc($nickname)?>的個人主頁</h3>
          <a href="<?= base_url('Book/myDesk')?>" class="btn btn-primary fs-5 p-3 m-3">我的書櫃</a>
          <a href="#" class="btn btn-primary fs-5 p-3 m-3">所有單字</a>
          <a href="<?= base_url('Quiz')?>" class="btn btn-primary fs-5 p-3 m-3">快速測驗</a>
          <a href="#" class="btn btn-primary fs-5 p-3 m-3">統計分析</a>
          <a href="#" class="btn btn-primary fs-5 p-3 m-3">個人設定</a>
          <a href="<?php echo base_url('User/doLogout') ?>" class="btn btn-primary fs-5 p-3 m-3">登出</a>
        </div>
      </div>
    </div>
</section>
<?= $this->endSection()?>