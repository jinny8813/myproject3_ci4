<?= $this->extend("layout/template")?>
<?= $this->section('content')?>
<section class="bg_two">
    <div class="container p-5">
      <div class="row justify-content-center">
        <div class="col-12">
          <h3 class="p-3 m-3 text-center">統計分析</h3>
          <hr>
          <div class="py-3 row justify-content-center">
            <nav class="nav nav-pills col-6">
                <a class="flex-sm-fill text-sm-center nav-link" href="#">本日</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="#">統計</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="#">字卡</a>
            </nav>
          </div>

          <div class="p-3 border border-secondary rounded row justify-content-center">
            <h5 class="text-center" id="today"></h5>
            <p>目標測驗數: 個</p>
            <p>目標測驗數: 個</p>
            <p>達成率: %</p>
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
            <p>總字卡數: 個</p>
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
</script>
<script>
new Chart(document.getElementById("doughnut-chart"), {
    type: 'doughnut',
    data: {
      labels: ["熟悉", "模糊", "忘記"],
      datasets: [
        {
            data: [70,10,6],
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
</script>
<script>
    new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: ["未測驗", "差", "弱", "中", "可", "佳"],
      datasets: [
        {
          label: "個",
          backgroundColor: ["#717098", "#4d6a92","#76acc6","#78a681","#a7c796","#e0c993"],
          data: [100,33,80,50,40,50]
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