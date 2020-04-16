<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
     {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <title>My Chart Js
    </title>
</head>

<body>

    <div id="app">
        <div class="container bg-light">
            <div class="row">
                <div class="col">
                    <canvas id="myChart" width="100" height="100"></canvas>
                </div>
                <div class="col">
                    <canvas id="myChart2">
                    </canvas>
                </div>
            </div>
        </div>
    </div>

   
    {{-- <script src="{{ asset('js/Chart.js') }}" defer></script> --}}
    <script>
        let myChart2 = document.getElementById('myChart2').getContext('2d');
        let massPopChart = new Chart(myChart2, {
            type: 'doughnut', // bar, horinzontalBar, pie, line, doughnut, radar, polarArea
            data: {
                labels: ['Quezon City', 'Manila', 'Caloocan', 'Davao City', 'Cebu'],
                datasets: [{
                    label: 'Population',
                    data: [
                        2936116,
                        1780148,
                        1583978,
                        1632991,
                        922611
                    ],
                    // backgroundColor: 'pink',

                    backgroundColor: [
                        'pink',
                        'green',
                        'yellow',
                        'red',
                        'skyblue'
                    ],
                }],

            },
            options: {
                title: {
                    display: true,
                    text: 'Largest Cities In Philippines',
                    fontSize: 25
                }
            }
        })
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>