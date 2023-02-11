<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">我的書櫃</h3>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="搜尋書本" aria-label="Search">
            <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
          <hr>
          <div class="py-3">
            <a href="<?= base_url('User')?>" class="btn btn-primary float-start mx-1"><i class="fa-solid fa-arrow-left"></i></a>
            <a href="<?= base_url('Book/createBook')?>" class="btn btn-primary float-start mx-1"><i class="fa-solid fa-plus"></i> 創建</a>
            <a href="#" class="btn btn-primary float-end mx-1">...</a>
            <a href="#" class="btn btn-primary float-end mx-1">...</a>
            <br>
          </div>

          <?php foreach($books as $row):?>
            <div class="card my-3">
                  <div class="card-body">
                    <h3 class="card-title d-inline-block"><?= $row['book_title']?></h3>
                    <p class="card-text d-inline-block float-end"><?= $row['create_at']?></p>
                    <p class="card-text"><i class="fa-solid fa-swatchbook"></i></i> <?= $row['card_count']?></p>
                    <div class="card-text d-inline-block float-end">
                      <a href="<?= base_url('Card/singlebook/'.$row['book_id'])?>" class="btn btn-primary"><i class="fa-solid fa-angles-right"></i></a>
                    </div>
                  </div>
            </div>
            <?php endforeach;?>

        </div>
      </div>
    </div>
</section>
<?= $this->endSection()?>