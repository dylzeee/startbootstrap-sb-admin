                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myChart" width="400" height="300"></canvas></div>
                                    
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="diskUsageChart" width="100%" height="60"></canvas></div>
                                </div>
                            </div>
                        </div>

<!-- Uptime Monitor Chart --> 
<script>

    // $(document).ready(function() {
    //     $.ajax( {
    //         url: 'https://api.uptimerobot.com/v2/getMonitors',
    //         type: 'POST',
    //         data: { 
    //             api_key: 'm784022013-504da1dd89ab8ec374a1ab41', 
    //             dataType: 'json', 
    //             custom_uptime_ratios: '7-30-45',
    //             all_time_uptime_ratio: '1',
    //             response_times: '1',
    //             response_times_limit: '30',
    //             response_times_average: '30',
    //             logs: '1',
    //             logs_limit: '100'
    //         } ,
    //         success: function(result) {
    //             var statusLogs = [];
    //             let logs = result.monitors[0].logs;
    //             logs.map(function(log) {
    //                 statusLogs.push(log);
    //             })
    //         }
    //     })
    // })
    var responseTimes = result.monitors[0].response_times;
                var times = [];
            for (var i = 0; i < responseTimes.length; i++) {
                let dateTime = responseTimes[i].datetime;
                date = new Date();
                times.push(date.getHours(dateTime));

    var ctx = document.getElementById('myChart').getContext('2d');
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

<!-- Disk Usage Chart -->
<script>
    var ctx = document.getElementById('diskUsageChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'My First dataset',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [0, 10, 5, 2, 20, 30, 45]
            }]
        },

        // Configuration options go here
        options: {}
    });
</script>