<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">書名:<?= $book_id['book_id']?></h3>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="搜尋書本" aria-label="Search">
            <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
          <hr>

          <div class="py-3">
            <a href="<?= base_url('Book')?>" class="btn btn-primary float-start mx-1"><i class="fa-solid fa-arrow-left"></i></a>
            <a href="<?= base_url('Card/createCard/'.$book_id['book_id'])?>" class="btn btn-primary float-start mx-1"><i class="fa-solid fa-plus"></i> 新增</a>
            <a href="<?= base_url('Book/delete/'.$book_id['book_id'])?>" class="btn btn-primary float-end mx-1"><i class="fa-solid fa-trash-can"></i> 刪除</a>
            <a href="<?= base_url('Book/editbook/'.$book_id['book_id'])?>" class="btn btn-primary float-end mx-1"><i class="fa-solid fa-file-pen"></i> 編輯</a>
            <br>
          </div>

          <?php foreach($newcards as $row):?>
            <div class="card my-3">
              <div class="row g-0">
                <div class="col-3 cardBgColor">
                  <p class="text-center my-3 d-none stateDNone"><?= $row['card_state']?></p>
                    <h5 class="text-center my-5 cardState" style="color: white;"></h5>
                </div>
                <div class="card-body col-9">
                    <h3 class="card-title"><?= $row['card_title']?></h3>
                    <p class="card-text d-inline-block">最近30天正確率: - </p>
                    <div class="card-text d-inline-block float-end">
                      <a href="<?= base_url('Card/showCard/'.$row['card_id'])?>" class="btn btn-primary"><i class="fa-solid fa-angles-right"></i></a>
                    </div>
                </div>
              </div>
            </div>
            <?php endforeach;?>

          <?php foreach($cards as $row):?>
            <div class="card my-3">
              <div class="row g-0">
                <div class="col-3 cardBgColor">
                  <p class="text-center my-3 d-none stateDNone"><?= $row['card_state']?></p>
                    <h5 class="text-center my-5 cardState" style="color: white;"></h5>
                </div>
                <div class="card-body col-9">
                    <h3 class="card-title"><?= $row['card_title']?></h3>
                    <p class="card-text d-inline-block">最近30天正確率: <?= $row['score']?>%</p>
                    <div class="card-text d-inline-block float-end">
                      <a href="<?= base_url('Card/showCard/'.$row['card_id'])?>" class="btn btn-primary"><i class="fa-solid fa-angles-right"></i></a>
                    </div>
                </div>
              </div>
            </div>
            <?php endforeach;?>

        </div>
      </div>
    </div>
<script>
  let cardBgColor = document.querySelectorAll(".cardBgColor");
let cardState = document.querySelectorAll(".cardState");
let stateDNone = document.querySelectorAll(".stateDNone");
console.log(stateDNone.length);
for (let i = 0; i < stateDNone.length; i++) {
  let num = parseInt(stateDNone[i].textContent);
  switch (num) {
    case 0:
      cardBgColor[i].style.backgroundColor = "#717098";
      cardState[i].innerText = "未測驗";
      break;
    case 1:
      cardBgColor[i].style.backgroundColor = "#4d6a92";
      cardState[i].innerText = "差";
      break;
    case 2:
      cardBgColor[i].style.backgroundColor = "#4d6a92";
      cardState[i].innerText = "差";
      break;
    case 3:
      cardBgColor[i].style.backgroundColor = "#76acc6";
      cardState[i].innerText = "弱";
      break;
    case 4:
      cardBgColor[i].style.backgroundColor = "#76acc6";
      cardState[i].innerText = "弱";
      break;
    case 5:
      cardBgColor[i].style.backgroundColor = "#6fae7b";
      cardState[i].innerText = "中";
      break;
    case 6:
      cardBgColor[i].style.backgroundColor = "#6fae7b";
      cardState[i].innerText = "中";
      break;
    case 7:
      cardBgColor[i].style.backgroundColor = "#9ecd84";
      cardState[i].innerText = "可";
      break;
    case 8:
      cardBgColor[i].style.backgroundColor = "#9ecd84";
      cardState[i].innerText = "可";
      break;
    case 9:
      cardBgColor[i].style.backgroundColor = "#e0d96e";
      cardState[i].innerText = "佳";
      break;
    case 10:
      cardBgColor[i].style.backgroundColor = "#e0d96e";
      cardState[i].innerText = "佳";
      break;
  }
}

</script>
</section>
<?= $this->endSection()?>