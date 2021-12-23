<?php

session_start();

if (isset($_SESSION["user"])) {

$msg = "Session successful" ;


include 'functions.php';

$connect = mysqli_connect("localhost", "root", "", "asset");
$query = "SELECT Assigned, COUNT(*) as number FROM Laptops Group By Assigned";
$result = mysqli_query($connect, $query);

$query2 = "SELECT Faulty, COUNT(*) as number2 FROM Laptops WHERE Faulty = 'Faulty' Group By Faulty";
$result2 = mysqli_query($connect, $query2);

$query3 = "SELECT Decommissioned, COUNT(*) as number3 FROM Laptops WHERE Decommissioned = 'Decommissioned' Group By Decommissioned";
$result3 = mysqli_query($connect, $query3);

$query4 = "SELECT Stage, COUNT(*) as number4 FROM Apps Group By Stage";
$result4 = mysqli_query($connect, $query4);

$query5 = "SELECT Packager, COUNT(*) as number5 FROM apps Group By Packager";
$result5 = mysqli_query($connect, $query5);

$query6 = "SELECT Stage, COUNT(*) as number6 FROM Apps Group By Stage";
$result6 = mysqli_query($connect, $query6);

$query7 = "SELECT CR, COUNT(*) as number7 FROM newstarters WHERE Dated BETWEEN date_sub(now(), interval 7 day) AND date_add(now(), interval 0 day) Group BY CR";
$result7 = mysqli_query($connect, $query7);

$query8 = "SELECT Dated, COUNT(*) as number8 FROM newstarters WHERE Dated BETWEEN date_sub(now(), interval 0 day) AND date_add(now(), interval 7 day) GROUP BY Dated";
$result8 = mysqli_query($connect, $query8);

$query9 = "SELECT NPS, COUNT(*) as number9 FROM newstarters WHERE Dated BETWEEN date_sub(now(), interval 0 day) AND date_add(now(), interval 7 day) Group By NPS";
$result9 = mysqli_query($connect, $query9);

}
else 
	header('Location: login.php'); 
;


?>
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Appollo</title>  
           
           <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="https://fonts.googleapis.com/css2?family=Glory:wght@300&display=swap" rel="stylesheet">
           <link href="style.css" rel="stylesheet" type="text/css">
           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart1);  
           google.charts.setOnLoadCallback(drawChart2); 
           google.charts.setOnLoadCallback(drawChart3); 
           google.charts.setOnLoadCallback(drawChart4);
           google.charts.setOnLoadCallback(drawChart5);
           google.charts.setOnLoadCallback(drawChart6);
           google.charts.setOnLoadCallback(drawChart7);
           google.charts.setOnLoadCallback(drawChart8);
           google.charts.setOnLoadCallback(drawChart9);

           
           
//################           
//################ DRAW CHART 1 ################
//################
           function drawChart1()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Assigned', 'number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["Assigned"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      
                      title: '% of Laptops Assigned', 
                      
                      

                      pieSliceText: 'none',
                      pieHole: 0.8,
                      slices: {0: {color: '#06AEAA'}, 1:{color: '#3277BC'}, 2:{color: '#4cd665'}, 3: {color: '#114e91'}, 4:{color: 'grey'},
                      // #06AEAA = Cyan  , #3277BC = Cyan-Blue Azure
                      chartArea: {
      // leave room for y-axis labels
                      width: '94%'
                      },
                      legend: {
                      position: 'top'
                      },
                      width: '100%'
                      }                 
                     
                     };  
                var chart1 = new google.visualization.PieChart(document.getElementById('donutchart1'));  
                
                chart1.draw(data, options);  
                
                google.visualization.events.addListener(chart1, 'select', function(){
                    
                  console.log(chart1.getSelection());  
                //window.location.href = "software.php?search="+chart4.getSelection();

                var selectedItem = chart1.getSelection();
                    if (selectedItem) {
                        var row = selectedItem[0].row;
                        console.log(data.getFormattedValue(row, 0));
                        window.location.href = "laptops.php?search="+data.getFormattedValue(row, 0);
                    }
                });
           }  

//################           
//################ DRAW CHART 2 ################
//################
           function drawChart2()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Faulty', 'number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result2))  
                          {  
                               echo "['".$row["Faulty"]."', ".$row["number2"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      
                      title: 'Faulty Laptops', 
                      
                      pieSliceText: 'none',
                      pieHole: 0.8,
                      slices: {0: {color: '#06AEAA'}, 1:{color: '#3277BC'}, 2:{color: '#4cd665'}, 3: {color: '#114e91'}, 4:{color: 'grey'}}
                      // #06AEAA = Cyan  , #3277BC = Cyan-Blue Azure
                                       

                     };  
                var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));  
                
                chart2.draw(data, options); 
                
                google.visualization.events.addListener(chart2, 'select', function(){
                    
                  console.log(chart2.getSelection());  
                //window.location.href = "software.php?search="+chart4.getSelection();

                var selectedItem = chart2.getSelection();
                    if (selectedItem) {
                        var row = selectedItem[0].row;
                        console.log(data.getFormattedValue(row, 0));
                        window.location.href = "faulty_view.php?search="+data.getFormattedValue(row, 0);
                    }
                });
           }  

//################           
//################ DRAW CHART 3 ################
//################
           function drawChart3()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Decommissioned', 'number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result3))  
                          {  
                               echo "['".$row["Decommissioned"]."', ".$row["number3"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      
                      title: 'Decommissioned Laptops', 
                      
                      pieSliceText: 'none',
                      pieHole: 0.8,
                      slices: {0: {color: '#06AEAA'}, 1:{color: '#3277BC'}, 2:{color: '#4cd665'}, 3: {color: '#114e91'}, 4:{color: 'grey'}}
                      // #06AEAA = Cyan  , #3277BC = Cyan-Blue Azure
                                       

                     };  
                var chart3 = new google.visualization.PieChart(document.getElementById('donutchart3'));  
                
                chart3.draw(data, options);
                
                google.visualization.events.addListener(chart3, 'select', function(){
                    
                  console.log(chart3.getSelection());  
                //window.location.href = "software.php?search="+chart4.getSelection();

                var selectedItem = chart3.getSelection();
                    if (selectedItem) {
                        var row = selectedItem[0].row;
                        console.log(data.getFormattedValue(row, 0));
                        window.location.href = "decommissioned.php?search="+data.getFormattedValue(row, 0);
                    }
                });
           } 

//################           
//################ DRAW CHART 4 ################
//################
           function drawChart4()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Decommissioned', 'number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result4))  
                          {  
                               echo "['".$row["Stage"]."', ".$row["number4"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      
                      title: 'Apps By Stage', 
                      
                      pieSliceText: 'none',
                      pieHole: 0.8,
                      slices: {0: {color: '#06AEAA'}, 1:{color: '#3277BC'}, 2:{color: '#4cd665'}, 3: {color: '#114e91'}, 4:{color: 'grey'}}
                      // #06AEAA = Cyan  , #3277BC = Cyan-Blue Azure
                                       

                     }; 
                     
                var chart4 = new google.visualization.PieChart(document.getElementById('donutchart4'));  
                
                chart4.draw(data, options);  

                
                
                google.visualization.events.addListener(chart4, 'select', function(){
                    
                  console.log(chart4.getSelection());  
                //window.location.href = "software.php?search="+chart4.getSelection();

                var selectedItem = chart4.getSelection();
                    if (selectedItem) {
                        var row = selectedItem[0].row;
                        console.log(data.getFormattedValue(row, 0));
                        window.location.href = "software2.php?search="+data.getFormattedValue(row, 0);
                    }
                });
                   
           }

//################           
//################ DRAW CHART 5 ################
//################
           function drawChart5()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Packager', 'number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result5))  
                          {  
                               echo "['".$row["Packager"]."', ".$row["number5"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      
                      title: 'Apps By Packager', 
                      
                      pieSliceText: 'none',
                      pieHole: 0.8,
                      slices: {0: {color: '#06AEAA'}, 1:{color: '#3277BC'}, 2:{color: '#4cd665'}, 3: {color: '#114e91'}, 4:{color: 'grey'}}
                      // #06AEAA = Cyan  , #3277BC = Cyan-Blue Azure
                                       

                     }; 
                     
                var chart5 = new google.visualization.PieChart(document.getElementById('donutchart5'));  
                
                chart5.draw(data, options);  

                
                
                google.visualization.events.addListener(chart5, 'select', function(){
                    
                  console.log(chart5.getSelection());  
                //window.location.href = "software.php?search="+chart4.getSelection();

                var selectedItem = chart5.getSelection();
                    if (selectedItem) {
                        var row = selectedItem[0].row;
                        console.log(data.getFormattedValue(row, 0));
                        window.location.href = "software2.php?search="+data.getFormattedValue(row, 0);
                    }
                });
                   
           }

//################           
//################ DRAW CHART 6 ################
//################
           function drawChart6()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Decommissioned', 'number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result6))  
                          {  
                               echo "['".$row["Stage"]."', ".$row["number6"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      
                      title: '% of Live Apps', 
                      
                      pieSliceText: 'none',
                      pieHole: 0.8,
                      slices: {0: {color: '#06AEAA'}, 1:{color: '#3277BC'}, 2:{color: '#4cd665'}, 3: {color: '#114e91'}, 4:{color: 'grey'}}
                      // #06AEAA = Cyan  , #3277BC = Cyan-Blue Azure
                                       

                     }; 
                     
                var chart6 = new google.visualization.PieChart(document.getElementById('donutchart6'));  
                
                chart6.draw(data, options);  

                
                
                google.visualization.events.addListener(chart6, 'select', function(){
                    
                  console.log(chart6.getSelection());  
                //window.location.href = "software.php?search="+chart4.getSelection();

                var selectedItem = chart6.getSelection();
                    if (selectedItem) {
                        var row = selectedItem[0].row;
                        console.log(data.getFormattedValue(row, 0));
                        window.location.href = "software2.php?search="+data.getFormattedValue(row, 0);
                    }
                });
                   
           }

//################           
//################ DRAW CHART 7 ################
//################
           function drawChart7()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['CR', 'number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result7))  
                          {  
                               echo "['".$row["CR"]."', ".$row["number7"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      
                      title: 'New Starters in Last 7 Days', 
                      
                      pieSliceText: 'none',
                      pieHole: 0.8,
                      slices: {0: {color: '#06AEAA'}, 1:{color: '#3277BC'}, 2:{color: '#4cd665'}, 3: {color: '#114e91'}, 4:{color: 'grey'}}
                      // #06AEAA = Cyan  , #3277BC = Cyan-Blue Azure
                                       

                     }; 
                     
                var chart7 = new google.visualization.PieChart(document.getElementById('donutchart7'));  
                
                chart7.draw(data, options);  

                
                
                google.visualization.events.addListener(chart7, 'select', function(){
                    
                  console.log(chart7.getSelection());  
                //window.location.href = "software.php?search="+chart4.getSelection();

                var selectedItem = chart7.getSelection();
                    if (selectedItem) {
                        var row = selectedItem[0].row;
                        console.log(data.getFormattedValue(row, 0));
                        window.location.href = "newstarter.php?search="+data.getFormattedValue(row, 0);
                    }
                });
                   
           }

//################           
//################ DRAW CHART 8 ################
//################
           function drawChart8()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['CR', 'number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result8))  
                          {  
                               echo "['".$row["Dated"]."', ".$row["number8"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      
                      title: 'Upcoming New Starters By Date + Time ', 
                      
                      pieSliceText: 'none',
                      pieHole: 0.8,
                      slices: {0: {color: '#06AEAA'}, 1:{color: '#3277BC'}, 2:{color: '#4cd665'}, 3: {color: '#114e91'}, 4:{color: 'grey'}}
                      // #06AEAA = Cyan  , #3277BC = Cyan-Blue Azure
                                       

                     }; 
                     
                var chart8 = new google.visualization.PieChart(document.getElementById('donutchart8'));  
                
                chart8.draw(data, options);  

                
                
                google.visualization.events.addListener(chart8, 'select', function(){
                    
                  console.log(chart8.getSelection());  
                //window.location.href = "software.php?search="+chart4.getSelection();

                var selectedItem = chart8.getSelection();
                    if (selectedItem) {
                        var row = selectedItem[0].row;
                        console.log(data.getFormattedValue(row, 0));
                        window.location.href = "newstarter.php?search="+data.getFormattedValue(row, 0);
                    }
                });
                   
           }

//################           
//################ DRAW CHART 9 ################
//################
           function drawChart9()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['NPS', 'number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result9))  
                          {  
                               echo "['".$row["NPS"]."', ".$row["number9"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      
                      title: 'Upcoming NewStarters By Installer', 
                      
                      pieSliceText: 'none',
                      pieHole: 0.8,
                      slices: {0: {color: '#06AEAA'}, 1:{color: '#3277BC'}, 2:{color: '#4cd665'}, 3: {color: '#114e91'}, 4:{color: 'grey'}}
                      // #06AEAA = Cyan  , #3277BC = Cyan-Blue Azure
                                       

                     }; 
                     
                var chart9 = new google.visualization.PieChart(document.getElementById('donutchart9'));  
                
                chart9.draw(data, options);  

                
                
                google.visualization.events.addListener(chart9, 'select', function(){
                    
                  console.log(chart9.getSelection());  
                //window.location.href = "software.php?search="+chart4.getSelection();

                var selectedItem = chart9.getSelection();
                    if (selectedItem) {
                        var row = selectedItem[0].row;
                        console.log(data.getFormattedValue(row, 0));
                        window.location.href = "newstarter.php?search="+data.getFormattedValue(row, 0);
                    }
                });
                   
           }



           </script>  
      </head>  
      <body> 
      <?=template_header('Home')?>
        <div class="content">
        <h2>Hardware Graphs</h2>
        </div>
 
           <div class ="chart" style="width:100%; height:50vh;" > 
                <div class="chartone" id="donutchart1" style="width: 100%; height: 100%;"></div>
                
                <div class="charttwo" id="donutchart2" style="width: 100%; height: 100%;"></div>

                <div class="chartthree" id="donutchart3" style="width: 100%; height: 100%;"></div> 

           </div>
        <div class="content">
        <h2>Software Graphs</h2>
        </div>
            
            <div class ="chart2" style="width:100%; height:50vh;">
                <div class="chartfour" id="donutchart4" style="width: 100%; height: 100%;"></div>
                
                <div class="chartfive" id="donutchart5" style="width: 100%; height: 100%;"></div>

                <div class="chartsix" id="donutchart6" style="width: 100%; height: 100%;"></div> 

            </div>
        <!--<div class="content">
        <h2>User Graphs</h2>
        </div>
            
            <div class ="chart3" style="width:900px;">
                <div class="chartseven" id="donutchart7" style="width: 750px; height: 500px;"></div>
                
                <div class="charteight" id="donutchart8" style="width: 750px; height: 500px;"></div>

                <div class="chartnine" id="donutchart9" style="width: 750px; height: 500px;"></div> 

            </div>

        <div>
            
            <a href="https://www.google.com" target="_blank">Google</a> 

        </div>-->
      </body>  
      
 </html>  