<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">統計分析</h3>
          <hr>
          <!-- <div class="py-3 row justify-content-center">
            <nav class="nav nav-pills col-6">
                <a class="flex-sm-fill text-sm-center nav-link" href="#">本日</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="#">統計</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="#">字卡</a>
            </nav>
          </div> -->

          <div class="p-3 border border-secondary rounded row justify-content-center">
            <h5 class="text-center" id="today"></h5>
            <p>目標測驗數: 200 個</p>
            <p id="todayLogs">本日測驗數: 個</p>
            <p id="todayPercent">達成率: %</p>
            <hr>
            <p>今日測驗狀況: </p>
            <div class="col-8">
                <canvas id="doughnut-chart"></canvas>
            </div>
            <p>當前字卡狀態: </p>
            <div class="col-12">
                <canvas id="bar-chart"></canvas>
            </div>
            <hr>
            <p>本日新字卡: 個</p>
            <p id="myCards">總字卡數: 個</p>
            <p>本日測驗數: 個</p>
            <p>累積測驗數: </p>
            <p>持續天數: 天</p>
            <p>累積天數: 天</p>
          </div>

        </div>
      </div>
    </div>
<script>
    let today = document.getElementById('today');
    today.innerText = new Date();

  const todayLogsArr=<?php echo json_encode($today_logs); ?>;
  let todayLogs = document.getElementById('todayLogs');
  todayLogs.innerText = "本日測驗數: "+todayLogsArr.length+" 個" ;
  let todayPercent = document.getElementById('todayPercent');
  todayPercent.innerText = "達成率: "+todayLogsArr.length/200*100+" %" ;

  let cForget=0,cVague=0,cFamiliar=0;
  for(let i=0;i<todayLogsArr.length;i++){
    if(todayLogsArr[i]['choose']=="忘記"){
      cForget++;
    }else if(todayLogsArr[i]['choose']=="模糊"){
      cVague++;
    }else if(todayLogsArr[i]['choose']=="熟悉"){
      cFamiliar++;
    }
  }

  const myCardsArr=<?php echo json_encode($my_cards); ?>;
  let myCards = document.getElementById('myCards');
  myCards.innerText = "總字卡數: "+myCardsArr.length+" 個" ;

  let s0=0,s1=0,s3=0,s5=0,s7=0,s9=0;
  for(let i=0;i<myCardsArr.length;i++){
    if(myCardsArr[i]['card_state']==0){
      s0++;
    }else if(myCardsArr[i]['card_state']==1 || myCardsArr[i]['card_state']==2){
      s1++;
    }else if(myCardsArr[i]['card_state']==3 || myCardsArr[i]['card_state']==4){
      s3++;
    }else if(myCardsArr[i]['card_state']==5 || myCardsArr[i]['card_state']==6){
      s5++;
    }else if(myCardsArr[i]['card_state']==7 || myCardsArr[i]['card_state']==8){
      s7++;
    }else if(myCardsArr[i]['card_state']==9 || myCardsArr[i]['card_state']==10){
      s9++;
    }
  }


  new Chart(document.getElementById("doughnut-chart"), {
    type: 'doughnut',
    data: {
      labels: ["熟悉", "模糊", "忘記"],
      datasets: [
        {
            data: [cFamiliar,cVague,cForget],
            backgroundColor: [
                  "#3cba9f",
                  "#ffa500",
                  "#c45850",
                ],
            borderWidth:0
        }
      ]
    },
    options: {
    }
});

    new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: ["未測驗", "差", "弱", "中", "可", "佳"],
      datasets: [
        {
          label: "個",
          backgroundColor: ["#717098", "#4d6a92","#76acc6","#78a681","#a7c796","#e0c993"],
          data: [s0,s1,s3,s5,s7,s9]
        }
      ]
    },
    options: {
      legend: { display: false },
      scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
    },
});
</script>
</section>
<?= $this->endSection()?>