<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- make the website responsive-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Noto+Sans:wght@700&family=Poppins&display=swap" rel="stylesheet">
	<link rel= "stylesheet" type="text/css" href="style.css">  <!--  connect with .css file-->
    <link rel= "stylesheet"  href ="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Finance Management</title>

    <!-- ------------------------------------------------------------------------------------------------------>
   <?php
           $host = 'localhost';//localhost
           $user = 'root';//root
           $pw = '1234';
           $dbName = 'ppmDB';//testdb
           $mysqli = mysqli_connect($host, $user, $pw, $dbName);

           $table_expense = "table_expense";
           $table_income  = "table_income";

           // Search and Select Data 
           $select_expense = "SELECT exp_value, exp_date FROM table_expense GROUP BY exp_date ORDER BY exp_date";
           $select_income  = "SELECT inc_value, inc_date FROM table_income  GROUP BY inc_date ORDER BY inc_date";       

           $query_expense          = mysqli_query($mysqli, $select_expense);
           $query_income           = mysqli_query($mysqli, $select_income);

           //expense chart
           echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>'; //php 코드에서의 html은 echo 안에 타이핑 하면 정상 실행된다.
           echo '<script type="text/javascript">';
           echo 'google.load("visualization", "1", {packages:["corechart"]});';
           echo 'google.setOnLoadCallback(drawChart);';
           echo 'function drawChart() {';
           echo 'var data = google.visualization.arrayToDataTable([';
           echo "['Date', 'Value'    ],";

           while($info=mysqli_fetch_array($query_expense)){
               echo "['$info[exp_date]'       ,  $info[exp_value]      ],";
           }
           echo ']);';
           echo 'var options = {';
           echo "title: 'Expense values Graph',";
           echo "hAxis: {title: 'Date of Expense',  titleTextStyle: {color: 'black'}}};";
           echo "var chart = new google.visualization.AreaChart(document.getElementById('expense_chart'));";
           echo 'chart.draw(data, options);}';
           echo '</script>';

           //income chart
           echo '<script type="text/javascript">'; //php 코드에서의 html은 echo 안에 타이핑 하면 정상 실행된다.
           echo 'google.load("visualization", "1", {packages:["corechart"]});';
           echo 'google.setOnLoadCallback(drawChart);';
           echo 'function drawChart() {';
           echo 'var data = google.visualization.arrayToDataTable([';
           echo "['Date', 'Value'    ],";

           while($info=mysqli_fetch_array($query_income)){
               echo "['$info[inc_date]'       ,  $info[inc_value]      ],";
           }
           echo ']);';
           echo 'var options = {';
           echo "title: 'Income values Graph',";
           echo "hAxis: {title: 'Date of Income',  titleTextStyle: {color: 'black'}}};";
           echo "var chart = new google.visualization.AreaChart(document.getElementById('income_chart'));";
           echo 'chart.draw(data, options);}';
           echo '</script>';

         

          // Pie Chart Code

        $select_expense_TotValue = "SELECT SUM(exp_value) AS Tot_exp_value FROM table_expense";
        $select_income_TotValue  = "SELECT SUM(inc_value) AS Tot_inc_value FROM table_income";
        $query_expense_TotValue = mysqli_query($mysqli, $select_expense_TotValue);
        $query_income_TotValue  = mysqli_query($mysqli, $select_income_TotValue);

        $Tot_expense_TotValue = mysqli_fetch_array($query_expense_TotValue);
        $Tot_income_TotValue  = mysqli_fetch_array($query_income_TotValue);

            
         echo '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
         echo '<script type="text/javascript">';
         echo 'google.charts.load("current", {packages:["corechart"]});';
         echo 'google.charts.setOnLoadCallback(drawChart);';
         echo 'function drawChart() {'  ;
         echo ' var data = google.visualization.arrayToDataTable([';

         
         echo "['Language', 'Speakers (in millions)'],";
         echo "['Total Income', $Tot_income_TotValue[Tot_inc_value]], ";
         echo "['Total Expense', $Tot_expense_TotValue[Tot_exp_value]], ";
         echo ']);'   ;

        
         echo 'var options = {';
         echo "legend: 'none',";
         echo "pieSliceText: 'label',";
         echo "title: 'Total values of Income & Expense',";
         echo "pieStartAngle: 100,";
         echo "};";
        
         echo "var chart = new google.visualization.PieChart(document.getElementById('piechart'));";
         echo "chart.draw(data, options);";
         echo "}";
         echo "</script>";

         mysqli_close($mysqli);
   ?> 


<!-- ------------------------------------------------------------------------------------------------------>
</head>
<body>
    <section class="sub-header">
        <nav>
            <a href="homepage.html"><img src="images/logo.png" ></a>
            <div class="nav-links" id="navLinks"> 
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="homepage.html"> Home </a></li>
					<li><a href="register.html">Register</a></li>
                    <li><a href="http://localhost/PPM_website_1/manage2.php"> Manage </a></li>
                    <li><a href="http://localhost/PPM_website_1/graph.php"> Graph </a></li>
                    <li><a href="aboutus.html"> About us </a></li>
                    <li><a href="contact.html"> Contact us </a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
    <h1>Graph for your finance</h1>
    </section>
<!-- Stats -->
<section class="graph">
    <h2>Graphs for expense & income </h2>
</section>

<section>
    <div id="expense_chart" style="width: 1000px; height: 600px; margin: auto;" ></div> <!-- 그래프 출력 -->
</section>
<section>
    <div id="income_chart" style="width: 1000px; height: 600px; margin: auto;"></div> <!-- 그래프 출력 -->
</section>
<section>
    <div id="piechart" style="width: 1000px; height: 600px; margin: auto;"></div>
</section>

<!-- Footer -->
<<section class="footer">
    <h4>About us</h4>
    <p>Our finance manage webiste helps people their finance well. <br>
    This website can help to manage their finance by type income and spending, <br>
    also our website is showing the stats of your finance graphs.</p>

    <h4>Socialize with us!</h4>
    <section class="socials">
    <ul class="socials">
                <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/"><i class="fa fa-twitter"></i> </a>
                <a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
              </ul>
    </section>
</section>
<!-- JavaScript for Toggle Menu -->
    <script>

        var navLinks = document.getElementById("navLinks");
        function showMenu(){
            navLinks.style.right = "0";
        }
        function hideMenu(){
            navLinks.style.right = "-200px";
        }
    </script>
</body>
</html>