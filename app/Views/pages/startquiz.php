<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">測驗<?= $quiz_id['quiz_id']?>進行中</h3>
          <hr>

            <h5 class="fs-3" id="currentNum"></h5>
            <div class="card my-3">
                <div class="card-body py-5 my-5">
                    <h5 class="card-title text-center fs-1" id="frountTitle"></h5>
                    <p class="text-center p_mb" id="partOfSpeech"></p>
                    <p class="text-center p_mb" id="pronunciation"></p>
                    <h5 class="text-center fs-1 d-none"  id="backContent"></h5>
                    <p class="text-center p_mb d-none small" id="e_sentence"></p>
                    <p class="text-center p_mb d-none small" id="c_sentence"></p>
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
let len =Object.keys(bigArr).length;

const currentNum = document.getElementById('currentNum');
const frountTitle = document.getElementById('frountTitle');
const partOfSpeech = document.getElementById('partOfSpeech');
const pronunciation = document.getElementById('pronunciation');

const backContent = document.getElementById('backContent');
const e_sentence = document.getElementById('e_sentence');
const c_sentence = document.getElementById('c_sentence');

const flipCard = document.getElementById('flipCard');
const theChoice = document.getElementById('theChoice');
const theChoice1 = document.getElementById('theChoice1');
const theChoice2 = document.getElementById('theChoice2');
const theChoice3 = document.getElementById('theChoice3');
let selections = [], currentIndex=0;

console.log(len);

flipCard.addEventListener('click', () => {
  frountTitle.classList.add('d-none');
  partOfSpeech.classList.add('d-none');
  pronunciation.classList.add('d-none');
  backContent.classList.remove('d-none');
  e_sentence.classList.remove('d-none');
  c_sentence.classList.remove('d-none');
  flipCard.classList.add('d-none');
  theChoice.classList.remove('d-none');
})

theChoice1.addEventListener('click', () => {
  selections.push(document.getElementById("theChoice1").textContent);
    if(currentIndex>=len){
    console.log(selections);
    storeQuiz();
    }else{
      setNext();
    }
  })
theChoice2.addEventListener('click', () => {
  selections.push(document.getElementById("theChoice2").textContent);
    if(currentIndex>=len){
    console.log(selections);
    storeQuiz();
    }else{
      setNext();
    }
  })
theChoice3.addEventListener('click', () => {
  selections.push(document.getElementById("theChoice3").textContent);
    if(currentIndex>=len){
    console.log(selections);
    storeQuiz();
    }else{
      setNext();
    }
  })

function setNext(){
  frountTitle.classList.remove('d-none');
  partOfSpeech.classList.remove('d-none');
  pronunciation.classList.remove('d-none');
  backContent.classList.add('d-none');
  e_sentence.classList.add('d-none');
  c_sentence.classList.add('d-none');
  flipCard.classList.remove('d-none');
  theChoice.classList.add('d-none');
  currentNum.innerText = currentIndex+1;
  frountTitle.innerText = bigArr[currentIndex]['card_title'];
  partOfSpeech.innerText = bigArr[currentIndex]['part_of_speech'];
  pronunciation.innerText = bigArr[currentIndex]['card_pronunciation'];
  backContent.innerText = bigArr[currentIndex]['card_content'];
  e_sentence.innerText = bigArr[currentIndex]['card_e_sentence'];
  c_sentence.innerText = bigArr[currentIndex]['card_c_sentence'];
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