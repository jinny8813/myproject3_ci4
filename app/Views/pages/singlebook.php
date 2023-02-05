<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">書名:<?= $book_id['book_id']?></h3>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-primary" type="submit">Search</button>
          </form>
          <hr>
          <div class="py-3">
            <a href="<?= base_url('Card/createCard/'.$book_id['book_id'])?>" class="btn btn-primary mx-3">建立字卡</a>
            <a href="#" class="btn btn-primary mx-3 float-end">排序</a>
            <a href="#" class="btn btn-primary mx-3 float-end">排序</a>
          </div>

          <?php foreach($cards as $row):?>
            <div class="card my-3">
              <div class="row g-0">
                <div class="col-3" style="background-color: red;">
                <p class="text-center my-3" style="color:white"><?= $row['card_state']?></p>
                </div>
                <div class="card-body col-9">
                    <div class="card-text d-inline-block float-end">
                      <a href="<?= base_url('Card/editCard/'.$row['card_id'])?>" class="btn btn-primary"><i class="fa-sharp fa-solid fa-pen"></i></a>
                    </div>
                    <h5 class="card-title"><?= $row['card_title']?></h5>
                    <p><?= $row['card_content']?></p>
                </div>
              </div>
            </div>
            <?php endforeach;?>

        </div>
      </div>
    </div>
</section>
<?= $this->endSection()?>