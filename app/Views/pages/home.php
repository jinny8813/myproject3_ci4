<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <a href="<?= base_url('Card')?>" class="btn btn-primary fs-3 p-5 m-3 col-5 ">我的書櫃</a>
        <a href="#" class="btn btn-primary fs-3 p-5 m-3 col-5 ">所有單字</a>
        <a href="#" class="btn btn-primary fs-3 p-5 m-3 col-10 ">快速測驗</a>
        <a href="#" class="btn btn-primary fs-3 p-5 m-3 col-5 ">統計分析</a>
        <a href="#" class="btn btn-primary fs-3 p-5 m-3 col-5 ">個人設定</a>
        <a href="<?php echo base_url('User/doLogout') ?>" class="btn btn-primary fs-3 p-5 m-3 col-10 ">登出</a>
      </div>
    </div>
</section>
<?= $this->endSection()?>