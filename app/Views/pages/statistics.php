<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">每日統計</h3>
          <hr>
          <form action="">
              <div class="form-group row mb-3 justify-content-center">
                    <div class="col-6">
                      <input type="date" class="form-control" id="changedate" name="date">
                    </div>
                    <div class="col-2">
                      <button type="submit" name="submit" id="button" class="btn btn-primary" onclick="changeDate()"><i class="fa-solid fa-plane"></i></button>
                    </div>
                </div>
          </form>

          <div class="p-3 border border-secondary rounded row justify-content-center">
            <h5 class="text-center fs-3" id="today"></h5>
            <hr>
            <p class="p_mb">目標測驗數: 200 個</p>
            <p class="p_mb" id="todayLogs">本日測驗數: 個</p>
            <p class="p_mb" id="todayPercent">達成率: %</p>
            <p class="p_mb">本日測驗狀況: </p>
            <div class="col-3">
                <br>
            </div>
            <div class="col-6">
                <canvas id="doughnut-chart"></canvas>
            </div>
            <div class="col-3">
              <br>
              <p class="p_mb small text-center"><i class="fa-solid fa-square" style="color: #5c5246;"></i> 熟悉</p>
              <p class="p_mb small text-center"><i class="fa-solid fa-square" style="color: #a99a85;"></i> 模糊</p>
              <p class="p_mb small text-center"><i class="fa-solid fa-square" style="color: #e3ddd1;"></i> 忘記</p>
            </div>
            <hr>
            <p class="p_mb">本日新字卡數: 個</p>
            <p class="p_mb" id="myCards">總字卡數: 個</p>
            <p class="p_mb">當前字卡狀態: </p>
            <div class="col-12">
                <canvas id="bar-chart"></canvas>
            </div>
          </div>

        </div>
      </div>
    </div>
<script>
    function changeDate(){
    event.preventDefault();

    let changedate = document.getElementById("changedate").value;

    $.ajax({
        url: "<?= base_url("Statistics/changeDate")?>",
        type: 'POST',
        dataType: 'json',
        data: {
          changedate:changedate
        }
    })
    .done(function(e){
        //window.location.reload();
        console.log(e);
  const dateArr=e.date;
  let today = document.getElementById('today');
  today.innerText = dateArr;

  const todayLogsArr=e.today_logs;
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

  const myCardsArr=e.my_cards;
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
                  "#5c5246",
                  "#a99a85",
                  "#e3ddd1",
                ],
            borderWidth:0
        }
      ]
    },
    options: {
      legend:{
        display:false
      }
    }
});

    new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: ["未測驗", "差", "弱", "中", "可", "佳"],
      datasets: [
        {
          label: "個",
          backgroundColor: ["#717098", "#4d6a92","#76acc6","#6fae7b","#9ecd84","#e0d96e"],
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

  const dateArr=<?php echo json_encode($date); ?>;
  let today = document.getElementById('today');
  today.innerText = dateArr;

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
                  "#5c5246",
                  "#a99a85",
                  "#e3ddd1",
                ],
            borderWidth:0
        }
      ]
    },
    options: {
      legend:{
        display:false
      }
    }
});

    new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: ["未測驗", "差", "弱", "中", "可", "佳"],
      datasets: [
        {
          label: "個",
          backgroundColor: ["#717098", "#4d6a92","#76acc6","#6fae7b","#9ecd84","#e0d96e"],
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