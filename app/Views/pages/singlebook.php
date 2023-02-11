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
                <div class="col-3 cardBgColor">
                  <p class="text-center my-3 d-none stateDNone"><?= $row['card_state']?></p>
                    <h5 class="text-center my-5 cardState" style="color: white;"></h5>
                </div>
                <div class="card-body col-9">
                    <div class="card-text d-inline-block float-end">
                      <a href="<?= base_url('Card/editCard/'.$row['card_id'])?>" class="btn btn-primary"><i class="fa-sharp fa-solid fa-pen"></i></a>
                    </div>
                    <h3 class="card-title"><?= $row['card_title']?></h3>
                    <p><?= $row['card_content']?></p>
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
      cardBgColor[i].style.backgroundColor = "#78a681";
      cardState[i].innerText = "中";
      break;
    case 6:
      cardBgColor[i].style.backgroundColor = "#78a681";
      cardState[i].innerText = "中";
      break;
    case 7:
      cardBgColor[i].style.backgroundColor = "#a7c796";
      cardState[i].innerText = "可";
      break;
    case 8:
      cardBgColor[i].style.backgroundColor = "#a7c796";
      cardState[i].innerText = "可";
      break;
    case 9:
      cardBgColor[i].style.backgroundColor = "#e0c993";
      cardState[i].innerText = "佳";
      break;
    case 10:
      cardBgColor[i].style.backgroundColor = "#e0c993";
      cardState[i].innerText = "佳";
      break;
  }
}

</script>
</section>
<?= $this->endSection()?>