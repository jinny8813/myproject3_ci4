<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">字卡細節</h3>
          <hr>

          <div class="py-3">
            <a href="<?= base_url('Card/singlebook/'.$cards[0]['book_id'])?>" class="btn btn-primary float-start mx-1"><i class="fa-solid fa-arrow-left"></i></a>
            <a href="<?= base_url('Card/delete/'.$cards[0]['card_id'])?>" class="btn btn-primary float-end mx-1"><i class="fa-solid fa-trash-can"></i> 刪除</a>
            <a href="<?= base_url('Card/editcard/'.$cards[0]['card_id'])?>" class="btn btn-primary float-end mx-1"><i class="fa-solid fa-file-pen"></i> 編輯</a>
            <br>
          </div>

          <?php foreach($cards as $row):?>
            <div class="card my-3">
                <div class="cardBgColor">
                    <p class="text-center my-3 d-none stateDNone"><?= $row['card_state']?></p>
                    <h5 class="text-center my-5 cardState" style="color: white;"></h5>
                </div>
                <div class="card-body">
                    <h5 class="card-title fs-1"><?= $row['card_title']?></h5>
                    <p class="p_mb"><?= $row['part_of_speech']?></p>
                    <p class="p_mb"><?= $row['card_pronunciation']?></p>
                    <h5 class="fs-1"><?= $row['card_content']?></h5>
                    <p class="p_mb small"><?= $row['card_e_sentence']?></p>
                    <p class="p_mb small"><?= $row['card_c_sentence']?></p>
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