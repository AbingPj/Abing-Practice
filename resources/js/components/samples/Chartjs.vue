<template>
  <div class="container">
    <div class="container bg-info">
      <div class="row">
        <div class="col">
          <canvas id="myChart" width="100" height="100"></canvas>
        </div>
        <div class="col">
          <canvas id="myChart2"></canvas>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    let myChart2 = document.getElementById("myChart2").getContext("2d");
    let massPopChart = new Chart(myChart2, {
      type: "doughnut", // bar, horinzontalBar, pie, line, doughnut, radar, polarArea
      data: {
        labels: ["Quezon City", "Manila", "Caloocan", "Davao City", "Cebu"],
        datasets: [
          {
            label: "Population",
            data: [2936116, 1780148, 1583978, 1632991, 922611],
            // backgroundColor: 'pink',

            backgroundColor: ["pink", "red", "yellow", "red", "skyblue"]
          }
        ]
      },
      options: {
        title: {
          display: true,
          text: "Largest Cities In Philippines",
          fontSize: 25
        }
      }
    });
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [
          {
            label: "# of Votes",
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(255, 206, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(153, 102, 255, 0.2)",
              "rgba(255, 159, 64, 0.2)"
            ],
            borderColor: [
              "rgba(255, 99, 132, 1)",
              "rgba(54, 162, 235, 1)",
              "rgba(255, 206, 86, 1)",
              "rgba(75, 192, 192, 1)",
              "rgba(153, 102, 255, 1)",
              "rgba(255, 159, 64, 1)"
            ],
            borderWidth: 1
          }
        ]
      },
      options: {
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true
              }
            }
          ]
        }
      }
    });
  }
};
</script>

<style>
</style>