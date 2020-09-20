$(function () {

  'use strict'

  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  //-----------------------
  //- MONTHLY SALES CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  //var salesChartCanvas = $('#salesChart').get(0).getContext('2d');

  //var ctx = document.getElementById('salesChart').getContext('2d');
  /*
  var ctx = $('#salesChart').get(0).getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3,3,66,88,3,55,12],
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
*/
/*
var salesChartCanvas = $('#salesChart').get(0).getContext('2d');

  var salesChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
    datasets: [
    {
      label               : 'Sales',
      backgroundColor     : '#c2b280',
      borderColor         : '#000',
      pointRadius          : true,
      pointColor          : '#3b8bba',
      pointStrokeColor    : 'rgba(60,141,188,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      borderWidth: 1.5,
        data                : [28, 48, 40, 19, 86, 27, 90,28, 48, 40, 19, 86]//intervallo valori
      },
      {
      label               : 'Last Year',
      backgroundColor     : '#cfd0d2',
      borderColor         : '#000',
      pointRadius          : true,
      pointColor          : '#3b8bba',
      pointStrokeColor    : 'rgba(60,141,188,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      borderWidth: 1.5,
        data                : [44, 22, 11, 55, 44, 22, 11,11, 11, 11, 22, 11]//intervallo valori
      }
      ]
    }

    var salesChartOptions = {

      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,

          }

        }]
      }
    }

  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas, { 
    type: 'bar', 
    data: salesChartData, 
    options: salesChartOptions
  }
  )


*/

  //---------------------------
  //- END MONTHLY SALES CHART -
  //---------------------------

  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
  var pieData        = {
    labels: [
    'Chrome', 
    'IE',
    'FireFox', 
    'Safari', 
    'Opera', 
    'Navigator', 
    ],
    datasets: [
    {
      data: [700,500,400,600,300,100],
      backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
    }
    ]
  }
  var pieOptions     = {
    legend: {
      display: false
    }
  }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions      
    })

  //-----------------
  //- END PIE CHART -
  //-----------------

  /* jVector Maps
   * ------------
   * Create a world map with markers
   */
   $('#world-map-markers').mapael({
    map: {
      name : "usa_states",
      zoom: {
        enabled: true,
        maxLevel: 10
      },
    },
  }
  );


 })
