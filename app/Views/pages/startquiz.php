<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">測驗<?= $quiz_id['quiz_id']?>進行中</h3>
          <hr>

          <!-- <div id='aQuiz'></div>
          <div class='btn' id='next'><a href='#'>Next</a></div> -->

            <h5 class="fs-3" id="currentNum"></h5>
            <div class="card my-3">
                <div class="card-body py-5 my-5">
                    <h5 class="card-title text-center fs-3" id="frountTitle"></h5>
                    <h5 class="text-center fs-3 d-none"  id="backContent"></h5>
                </div>
            </div>
            <div class="row justify-content-center mb-3" id="flipCard">
                <a href="#" class="btn btn-primary mx-3 col">翻卡</a>
            </div>
            <div class="row justify-content-center mb-3 d-none" id="theChoice">
                <button class="btn btn-primary mx-3 col" id="theChoice1">忘記</button>
                <button class="btn btn-primary mx-3 col" id="theChoice2">模糊</button>
                <button class="btn btn-primary mx-3 col" id="theChoice3">熟悉</button>
            </div>

<script>
const bigArr=<?php echo json_encode($cards); ?>;
const currentNum = document.getElementById('currentNum');
const frountTitle = document.getElementById('frountTitle');
const backContent = document.getElementById('backContent');
const flipCard = document.getElementById('flipCard');
const theChoice = document.getElementById('theChoice');
const theChoice1 = document.getElementById('theChoice1');
const theChoice2 = document.getElementById('theChoice2');
const theChoice3 = document.getElementById('theChoice3');
let selections = [], currentIndex=0;

flipCard.addEventListener('click', () => {
  frountTitle.classList.add('d-none');
  backContent.classList.remove('d-none');
  flipCard.classList.add('d-none');
  theChoice.classList.remove('d-none');
})

theChoice1.addEventListener('click', () => {
  selections.push(document.getElementById("theChoice1").textContent);
    if(currentIndex>=5){
    console.log(selections);
    storeQuiz();
    }else{
      setNext();
    }
  })
theChoice2.addEventListener('click', () => {
  selections.push(document.getElementById("theChoice2").textContent);
    if(currentIndex>=5){
    console.log(selections);
    storeQuiz();
    }else{
      setNext();
    }
  })
theChoice3.addEventListener('click', () => {
  selections.push(document.getElementById("theChoice3").textContent);
    if(currentIndex>=5){
    console.log(selections);
    storeQuiz();
    }else{
      setNext();
    }
  })

function setNext(){
  frountTitle.classList.remove('d-none');
  backContent.classList.add('d-none');
  flipCard.classList.remove('d-none');
  theChoice.classList.add('d-none');
  currentNum.innerText = currentIndex+1;
  frountTitle.innerText = bigArr[currentIndex]['card_title'];
  backContent.innerText = bigArr[currentIndex]['card_content'];
  currentIndex++;
}

setNext()

function storeQuiz(){
    event.preventDefault();

    $.ajax({
        url: "<?= base_url("Quiz/storeQuiz")?>",
        type: 'POST',
        dataType: 'json',
        data: {
          selections:selections,
          bigArr:bigArr,
          quiz_id:<?= $quiz_id['quiz_id']?>
        }
    })
    .done(function(e){
        window.location.href = `<?= base_url('Quiz')?>`;
    })
    .fail(function(e){
        try{
            $('#errorText').append(`status code: ${e.responseJSON.error}
                                    <br>
                                    error messages: ${e.responseJSON.messages.error}`);
        }catch(error){
            console.log(e);
            $('#errorText').html('伺服器連線失敗');
        }
    })
}

</script>

        </div>
      </div>
    </div>
</section>
<?= $this->endSection()?>