<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">月週打卡</h3>
          <hr>
          <form action="">
              <div class="form-group row mb-3 justify-content-center">
                    <div class="col-6">
                      <input type="week" class="form-control" id="changeweek" name="week">
                    </div>
                    <div class="col-2">
                      <button type="submit" name="submit" id="button" class="btn btn-primary" onclick="changeWeek()"><i class="fa-solid fa-plane"></i></button>
                    </div>
                </div>
          </form>

          <div class="p-3 border border-secondary rounded row justify-content-center">
            <h5 class="text-center fs-3" id="today"></h5>
            <hr>
            <p class="p_mb">本週打卡狀況: </p>
            <div class="col-12 row justify-content-center">
                <table class="table table-borderless table-sm">
                <tbody>
                    <tr>
                        <th class="text-center">MON</th>
                        <th class="text-center">TUE</th>
                        <th class="text-center">WED</th>
                        <th class="text-center">THU</th>
                        <th class="text-center">FRI</th>
                        <th class="text-center">SAT</th>
                        <th class="text-center">SUN</th>
                    </tr>
                    <tr>
                        <th><div class="d-flex justify-content-center"><div class="circle text-center" id="date1">01</div></div></th>
                        <th><div class="d-flex justify-content-center"><div class="circle text-center" id="date2">01</div></div></th>
                        <th><div class="d-flex justify-content-center"><div class="circle text-center" id="date3">01</div></div></th>
                        <th><div class="d-flex justify-content-center"><div class="circle text-center" id="date4">01</div></div></th>
                        <th><div class="d-flex justify-content-center"><div class="circle text-center" id="date5">01</div></div></th>
                        <th><div class="d-flex justify-content-center"><div class="circle text-center" id="date6">01</div></div></th>
                        <th><div class="d-flex justify-content-center"><div class="circle text-center" id="date7">01</div></div></th>
                    </tr>
                </tbody>
                </table>
            </div>
            <hr>
            <p class="p_mb" id="logs">總測驗數:  個</p>
            <p class="p_mb" id="weeklyLogs">本週測驗數:  個</p>
            <p class="p_mb">本週測驗狀況: </p>
            <div class="col-12">
                <canvas id="line-chart"></canvas>
            </div>
            <hr>
            <p class="p_mb" id="myCards">總字卡數: 個</p>
            <p class="p_mb" id="weeklyCards">本週新字卡數: 個</p>
            <p class="p_mb">本週新字卡狀況: </p>
            <div class="col-12">
                <canvas id="bar-chart"></canvas>
            </div>
          </div>

        </div>
      </div>
    </div>
<script>
    function changeWeek(){
    event.preventDefault();

    let changeweek = document.getElementById("changeweek").value;
    function getFirst(w, y) {
        let d = (1 + (w - 1) * 7)+2;
        return new Date(y, 0, d);
    }
    function getLast(w, y) {
        let d = (1 + (w - 1) * 7)+2+6;
        return new Date(y, 0, d);
    }
    let y=changeweek.slice(0,4);
    let w=changeweek.slice(-2);

    let first=getFirst(w,y).toISOString().split('T')[0];
    let last=getLast(w,y).toISOString().split('T')[0];
    

    $.ajax({
        url: "<?= base_url("Statistics/changeWeek")?>",
        type: 'POST',
        dataType: 'json',
        data: {
            first:first,
            last:last
        }
    })
    .done(function(e){
        //window.location.reload();
        console.log(e);
        const rangeArr=e.weekrange;
document.getElementById('today').innerText = rangeArr['weekrange'];
        const weekArr=e.weekly_count;
document.getElementById('date1').innerText = weekArr[0]['date_ymd'].slice(-2);
document.getElementById('date2').innerText = weekArr[1]['date_ymd'].slice(-2);
document.getElementById('date3').innerText = weekArr[2]['date_ymd'].slice(-2);
document.getElementById('date4').innerText = weekArr[3]['date_ymd'].slice(-2);
document.getElementById('date5').innerText = weekArr[4]['date_ymd'].slice(-2);
document.getElementById('date6').innerText = weekArr[5]['date_ymd'].slice(-2);
document.getElementById('date7').innerText = weekArr[6]['date_ymd'].slice(-2);

let all=0;
for(let i=0;i<7;i++){
    if(weekArr[i]['ccount']>0){
        document.getElementById("date"+(i+1)).classList.add('checked');    
    }
    all=all+parseInt(weekArr[i]['ccount']);
}
document.getElementById('weeklyLogs').innerText = "本週測驗數: "+all+" 個" ;

new Chart(document.getElementById("line-chart"), {
    type: 'line',
    data: {
      labels: [weekArr[0]['date_ymd'].slice(-5),
                weekArr[1]['date_ymd'].slice(-5),
                weekArr[2]['date_ymd'].slice(-5),
                weekArr[3]['date_ymd'].slice(-5),
                weekArr[4]['date_ymd'].slice(-5),
                weekArr[5]['date_ymd'].slice(-5),
                weekArr[6]['date_ymd'].slice(-5)],
      datasets: [
        {
          label: "本週測驗數",
          backgroundColor: "#6a8824",
          borderColor: "#6a8824",
          data: [weekArr[0]['ccount'],
                weekArr[1]['ccount'],
                weekArr[2]['ccount'],
                weekArr[3]['ccount'],
                weekArr[4]['ccount'],
                weekArr[5]['ccount'],
                weekArr[6]['ccount']],
            fill:false
        }
      ]
    },
    options: {
        legend: { display: false },
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

const rangeArr=<?php echo json_encode($weekrange); ?>;
document.getElementById('today').innerText = rangeArr['weekrange'];
const weekArr=<?php echo json_encode($weekly_count); ?>;
document.getElementById('date1').innerText = weekArr[0]['date_ymd'].slice(-2);
document.getElementById('date2').innerText = weekArr[1]['date_ymd'].slice(-2);
document.getElementById('date3').innerText = weekArr[2]['date_ymd'].slice(-2);
document.getElementById('date4').innerText = weekArr[3]['date_ymd'].slice(-2);
document.getElementById('date5').innerText = weekArr[4]['date_ymd'].slice(-2);
document.getElementById('date6').innerText = weekArr[5]['date_ymd'].slice(-2);
document.getElementById('date7').innerText = weekArr[6]['date_ymd'].slice(-2);

let all=0;
for(let i=0;i<7;i++){
    if(weekArr[i]['ccount']>0){
        document.getElementById("date"+(i+1)).classList.add('checked');    
    }
    all=all+parseInt(weekArr[i]['ccount']);
}
document.getElementById('weeklyLogs').innerText = "本週測驗數: "+all+" 個" ;

new Chart(document.getElementById("line-chart"), {
    type: 'line',
    data: {
      labels: [weekArr[0]['date_ymd'].slice(-5),
                weekArr[1]['date_ymd'].slice(-5),
                weekArr[2]['date_ymd'].slice(-5),
                weekArr[3]['date_ymd'].slice(-5),
                weekArr[4]['date_ymd'].slice(-5),
                weekArr[5]['date_ymd'].slice(-5),
                weekArr[6]['date_ymd'].slice(-5)],
      datasets: [
        {
          label: "本週測驗數",
          backgroundColor: "#6a8824",
          borderColor: "#6a8824",
          data: [weekArr[0]['ccount'],
                weekArr[1]['ccount'],
                weekArr[2]['ccount'],
                weekArr[3]['ccount'],
                weekArr[4]['ccount'],
                weekArr[5]['ccount'],
                weekArr[6]['ccount']],
            fill:false
        }
      ]
    },
    options: {
        legend: { display: false },
    },
});

</script>
</section>
<?= $this->endSection()?>