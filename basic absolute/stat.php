<script>
/*
    Author: Sam Deering 2012
    Copyright: jquery4u.com
    Licence: MIT.
*/
(function($)
{

    $(document).ready(function()
    {

        //loading image for ajax request
        var $loading = $('#galoading');
        $.ajaxSetup(
        {
            start: function()
            {
                $loading.show();
            },
            complete: function()
            {
                $loading.hide();
            }
        });

        $.getJSON('data.php', function(data)
        {
            // console.log(data);
            if (data)
            {
                $('#results').show();

                //raw data
                $('#gadata').html(JSON.stringify(data));

                //mini graph
                var miniGraphData = new Array();
                $.each(data, function(i,v)
                {
                     miniGraphData.push([v["visits"], v["pageviews"]]);
                });
                // console.log(miniGraphData);
                $('#minigraph').sparkline(miniGraphData, { type: 'bar' });

                //get graph data
                var xAxisLabels = new Array(),
                    dPageviews = new Array(),
                    dVisits = new Array();
                $.each(data, function(i,v)
                {
                     xAxisLabels.push(v["date_day"]+'/'+v["date_month"]+'/'+v["date_year"]);
                     dPageviews.push(parseInt(v["pageviews"]));
                     dVisits.push(parseInt(v["visits"]));
                });
                console.log(xAxisLabels);
                console.log(dPageviews);
                console.log(dVisits);

                var chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'graph',
                        type: 'line',
                        marginRight: 130,
                        marginBottom: 25
                    },
                    title: {
                        text: 'jQuery4u Blog Traffic Stats',
                        x: -20 //center
                    },
                    subtitle: {
                        text: 'Source: Google Analytics API',
                        x: -20
                    },
                    xAxis: {
                        categories: xAxisLabels
                    },
                    yAxis: {
                        title: {
                            text: 'Pageviews'
                        },
                        plotLines: [{
                            value: 0,
                            width: 5,
                            color: '#FF4A0B'
                        }]
                    },
                    tooltip: {
                        formatter: function() {
                                return '<b>'+ this.series.name +'</b><br />'+
                                this.x +': '+ this.y.toString().replace(/B(?=(d{3})+(?!d))/g, ",") +' pageviews';
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -10,
                        y: 100,
                        borderWidth: 0
                    },
                    series: [
                    {
                        name: 'pageviews',
                        data: dPageviews
                    },
                    {
                        name: 'visits',
                        data: dVisits
                    }]
                });


            }
            else
            {
                $('#results').html('error?!?!').show();
            }
        });

    });

})(jQuery);
</script>

<?php
@session_start();
require_once 'api_google/src/Google/Client.php';
require_once 'api_google/src/contrib/Google_AnalyticsService.php';

$scriptUri = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];

$client = new Google_Client();
$client->setAccessType('online'); // default: offline
$client->setApplicationName('STATS');
$client->setClientId('692159404240-kovus0qk96ht8j0osln1lrpt34ar9hju.apps.googleusercontent.com');
$client->setClientSecret('jRkuj2RxF0ezQ_H7YqxMEEXd ');
$client->setRedirectUri($scriptUri);
$client->setDeveloperKey('AIzaSyAxT5SqEG3PSFWfm-vbXUjYmAnus6qFWSY'); // API key

// $service implements the client interface, has to be set before auth call
$service = new Google_AnalyticsService($client);

if (isset($_GET['logout'])) { // logout: destroy token
    unset($_SESSION['token']);
    die('Logged out.');
}

if (isset($_GET['code'])) { // we received the positive auth callback, get the token and store it in session
    $client->authenticate();
    $_SESSION['token'] = $client->getAccessToken();
}

if (isset($_SESSION['token'])) { // extract token from session and configure client
    $token = $_SESSION['token'];
    $client->setAccessToken($token);
}

if (!$client->getAccessToken()) { // auth call to google
    $authUrl = $client->createAuthUrl();
    header("Location: ".$authUrl);
    die;
}

try {

    //specific project
    $projectId = '[INSERT PROJECT ID HERE]'; //see here for how to get your project id: http://goo.gl/Tpcgc

    // metrics
    $_params[] = 'date';
    $_params[] = 'date_year';
    $_params[] = 'date_month';
    $_params[] = 'date_day';
    // dimensions
    $_params[] = 'visits';
    $_params[] = 'pageviews';

    //for more metrics see here: http://goo.gl/Tpcgc

    // $from = date('Y-m-d', time()-2*24*60*60); // 2 days ago
    // $to = date('Y-m-d'); // today
    $from = date('Y-m-d', time()-7*24*60*60); // 7 days ago
    $to = date('Y-m-d', time()-24*60*60); // 1 days ago

    $metrics = 'ga:visits,ga:pageviews,ga:bounces,ga:entranceBounceRate,ga:visitBounceRate,ga:avgTimeOnSite';
    $dimensions = 'ga:date,ga:year,ga:month,ga:day';
    $data = $service->data_ga->get('ga:'.$projectId, $from, $to, $metrics, array('dimensions' => $dimensions));

    $retData = array();
    foreach($data['rows'] as $row)
    {
       $dataRow = array();
       foreach($_params as $colNr => $column)
       {
           $dataRow[$column] = $row[$colNr];
       }
       array_push($retData, $dataRow);
    }
    // var_dump($retData);
    echo json_encode($retData);


} catch (Exception $e) {
    die('An error occured: ' . $e->getMessage()."n");
}
?>