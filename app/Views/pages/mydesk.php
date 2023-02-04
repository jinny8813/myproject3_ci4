<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">我的書櫃</h3>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-primary" type="submit">Search</button>
          </form>
          <hr>
          <div class="py-3">
            <a href="<?= base_url('Card/createBook')?>" class="btn btn-primary mx-3">建立書本</a>
            <a href="#" class="btn btn-primary mx-3 float-end">排序</a>
            <a href="#" class="btn btn-primary mx-3 float-end">排序</a>
          </div>

          <?php foreach($books as $row):?>
            <div class="card my-3">
                  <div class="card-body">
                    <h5 class="card-title d-inline-block"><?= $row['book_title']?></h5>
                    <p class="card-text d-inline-block float-end"><?= $row['create_at']?></p>
                    <br>
                    <br>
                    <div class="card-text d-inline-block float-end">
                      <a href="<?= base_url('Card/singlebook/'.$row['book_id'])?>" class="btn btn-primary">查看更多</a>
                    </div>
                  </div>
            </div>
            <?php endforeach;?>

        </div>
      </div>
    </div>
</section>
<?= $this->endSection()?>