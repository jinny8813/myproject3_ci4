<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <?= esc($nickname)?>的個人主頁
      </div>
    </div>
</section>
<?= $this->endSection()?>