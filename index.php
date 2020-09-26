<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 *
 * @package  WordPress
 * @subpackage  AdminPress Bootsrap Theme by AuWebMasters
 * @since   AdminPress 0.1
 */

$context          = Timber::context();
$context['posts'] = new Timber\PostQuery();
$context['foo']   = 'bar';
$templates        = array( 'base.twig' );


/****************************************
 * Cards functions
 ****************************************/

 // Get the total number of Awesome Support tickets

 $id = get_current_user_id();
 $open_array = wpas_get_tickets( 'open', array( 'posts_per_page' => -1, 'author' => $id ) );

 if ( is_array ( $open_array ) ) {
     $number_of_open_tickets = count( $open_array );
        if ( empty( $number_of_open_tickets ) ) {
            $context['ticket_count'] = "0";
        } else {
            $context['ticket_count'] = $number_of_open_tickets;
 }}

 $context['ticket'] = $open_array;

$ticket_dates = $open_array;
$dates = array(); //create and empty array for storying post modified dates.
 
// Get the post dates and format to time ago format
foreach ($open_array as $key => $data) {
     $date = $data->post_modified; // Store the post modified data into a variable. 
     $new_date = time_elapsed_string($date); // Convert the data time format. 
     $dates[] = $new_date; // put the new formatted entry into the dates array.
}

$context['post_modified'] = $dates; 

array(3) {
     [0]=> string(14) "11 minutes ago" 
     [1]=> string(9) "1 day ago" 
     [2]=> string(9) "1 day ago" }

 // Get the total number of subscribe sites

//  if ( have_rows( 'websites', "user_{$id}" ) ) {
//      while( have_rows( 'websites', "user_{id}" ) ) {
//          $row = the_row();
//          $total_sites = 1; // Set this to one because acf field handle starts at 1 not 0 
//          for ( $i=0; $i < count($row); $i++ ) {
//             $site_[$i] = get_sub_field( "site_{$i}", "user_{$id}" );
//                 if (! empty($site_[$i])) {
//                     $total++;
//                 }
//          }
//      }
//         $context['total_sites'] = $total_sites;
//  }


/**** Charts ***** */
?>
<script>

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

<!-- Disk Usage Chart -->
<script>
 $(document).ready(function() {
        $.ajax( {
            url: 'https://api.uptimerobot.com/v2/getMonitors',
            type: 'POST',
            data: { 
                api_key: 'm784022013-504da1dd89ab8ec374a1ab41', 
                dataType: 'json', 
                custom_uptime_ratios: '7-30-45',
                all_time_uptime_ratio: '1',
                response_times: '1',
                response_times_average: '120',
                logs: '1',
                logs_limit: '100'
            } ,
            success: function(result) {
                console.log(result);
                var responseTimes = result.monitors[0].response_times;
                var times = [];
                var values = [];
                let avgResponseTime = result.monitors[0].average_response_time;
                for (var i = 0; i < responseTimes.length; i++) {
                    let dateTime = responseTimes[i].datetime;
                    let value = responseTimes[i].value; 
                    date = new Date(dateTime * 1000);
                    //let hours = date.getHours();;
                    //console.log(hours)
                    times.push(date.getHours(dateTime) + ':00');
                    //times = times.reverse();
                    values.push(value);
                    var ctx = document.getElementById('diskUsageChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: times.reverse(),
                            datasets: [{
                                label: 'Response Times. Average = ' + avgResponseTime + '(ms)',
                            backgroundColor: 'rgb(245,183,114)',
                            borderColor: 'rgb(240,147,43)',
                            data: values,
                        }]
                    },

                    // Configuration options go here
                    options: {}
                });
                
            }

                
                }
            })
        })
    
</script>

<?php


Timber::render( $templates, $context );

?>


