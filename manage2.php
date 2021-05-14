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
     <!------------------PHP------------------------------------->
        <?php
        $host = 'localhost';
        $user = 'root';
        $pw = '1234';
        $dbName = 'ppmDB';
        $mysqli = new mysqli($host, $user, $pw, $dbName);

        $select_check == 9; //값 초기화

        // Type the Data
        if( empty($_POST['expense_date']) <> 1 && empty($_POST['expense']) <> 1 && empty($_POST['expense_val']) <> 1 ) //데이터가 하나라도 입력이 안되어 있을 경우 insert 불가
        { 
            $insert_query1 = "INSERT INTO table_expense (exp_date, exp_description, exp_value) 
            VALUES ('$_POST[expense_date]', '$_POST[expense]', '$_POST[expense_val]')";
        
            mysqli_query($mysqli, $insert_query1); 
        }
        else 
        {
            if(empty($_POST['income_date']) <> 1 && empty($_POST['income']) <> 1 && empty($_POST['income_val']) <> 1 )  
            {
 
            }
            else
            {
                 //echo("<script>alert('Expense 또는 Income 데이터가 모두 입력되지 않았습니다.')</script>");
            }    
        }

        if( empty($_POST['income_date']) <> 1 && empty($_POST['income']) <> 1 && empty($_POST['income_val']) <> 1 ) //데이터가 하나라도 입력이 안되어 있을 경우 insert 불가
        {
            $insert_query2 = "INSERT INTO table_income (inc_date, inc_description, inc_value) 
            VALUES ('$_POST[income_date]', '$_POST[income]', '$_POST[income_val]')";
        
            mysqli_query($mysqli, $insert_query2);            
        }
        else 
        {
            if(empty($_POST['expense_date']) <> 1 && empty($_POST['expense']) <> 1 && empty($_POST['expense_val']) <> 1 )  
            {
 
            }
            else
            {
                 //echo("<script>alert('Expense 또는 Income 데이터가 모두 입력되지 않았습니다.')</script>");
            }   
        }

        
        //데이터 삭제 코드
        $select_exp_check == 9; //값 초기화

        if( $_POST['delete_Type'] == 'expense' ||  $_POST['delete_Type'] == 'Expense' || $_POST['delete_Type'] == 'Expense')
        {
            $select_exp_check = "SELECT EXISTS(
                SELECT *
                FROM table_expense 
                WHERE exp_date = '$_POST[delete_Date]' AND exp_description = '$_POST[delete_description]' AND exp_value = '$_POST[delete_val]') AS ExsistCheck";

            $select_exp_check_1  = mysqli_query($mysqli, $select_exp_check);
            $select_exp_check_2  = mysqli_fetch_array($select_exp_check_1);

            if( $select_exp_check_2['ExsistCheck'] == 1 )
            {
                $select_exp_delete = "DELETE FROM table_expense WHERE exp_date = CONVERT('$_POST[delete_Date]', CHAR(50)) AND exp_description = '$_POST[delete_description]' AND exp_value = '$_POST[delete_val]'";
                mysqli_query($mysqli, $select_exp_delete); 
            }
            else if ( $select_exp_check_2['ExsistCheck'] == 0 )
            {
                echo("<script>alert('삭제할 수 있는 데이터가 없습니다.')</script>");
            }

        }
        else if ( $_POST['delete_Type'] == 'income' ||  $_POST['delete_Type'] == 'Income' || $_POST['delete_Type'] == 'INCOME')
        {
            $select_Inc_check = "SELECT EXISTS(
                SELECT *
                FROM table_income 
                WHERE inc_date = '$_POST[delete_Date]' AND inc_description = '$_POST[delete_description]' AND inc_value = '$_POST[delete_val]') AS ExsistCheck";

            $select_Inc_check_1  = mysqli_query($mysqli, $select_Inc_check);
            $select_Inc_check_2  = mysqli_fetch_array($select_Inc_check_1);

            if( $select_Inc_check_2['ExsistCheck'] == 1 )
            {
                $select_Inc_delete = "DELETE FROM table_income WHERE inc_date = CONVERT('$_POST[delete_Date]', CHAR(50)) AND inc_description = '$_POST[delete_description]' AND inc_value = '$_POST[delete_val]'";
                mysqli_query($mysqli, $select_Inc_delete); 
            }
            else if ( $select_Inc_check_2['ExsistCheck'] == 0 )
            {
                echo("<script>alert('삭제할 수 있는 데이터가 없습니다.')</script>");
            }
        }

        ?>
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
    <h1>Manage your finance</h1>
    </section>
        <td>&nbsp;</td>
     <form action = "http://localhost/PPM_website_1/manage2.php" method="POST"> <!-- Transmit to DB -->

        <td>&nbsp;</td>
        <h3 align="center">Type your Expense & Income Description and Values </h3>
        <td>&nbsp;</td>
    <table class = "expense_content">
    <td>&nbsp;</td>
    <tr>
        <td>Date</td>
        <td><input type="date" id="date" name="expense_date" placeholder="Choose your date .." style="width: 200px"></td>
        <td>Expense</td>
        <td><input type="text" id="expense" name="expense" placeholder="Type your description .." style="width: 350px"></td>
        <td>Expense Values</td>
        <td><input type="text" id="expense_val" name="expense_val" placeholder="Type your values .." style="width: 200px"></td>
    </tr>
    <td>&nbsp;</td>
    <table class = "income_content">
    <td>&nbsp;</td>
    <tr>
    <br />
        <td>Date</td>
        <td><input type="date" id="date" name="income_date" placeholder="Choose your date .." style="width: 200px"></td>
        <td>Income</td>
        <td><input type="text" id="income" name="income" placeholder="Type your description .." style="width: 350px"></td>
        <td>Income Values</td>
        <td><input type="text" id="income_val" name="income_val" placeholder="Type your values .." style="width: 200px"></td>
    </tr>
    <td>&nbsp;</td>
   </table>
     <table submit_reset_btn>
     <br />
        <td>
            <td>&nbsp;</td><td align ="left" style="width: 400 px;">
             <input type ="reset" value="Reset" name="reset" class='reset_btn'  onclick="reset();"></td>
       </td>
       <td>
           <td>&nbsp;</td><td align ="left" style="width: 400 px;">
            <input type ="submit" value="Submit" name="add" class='submit_btn' ></td>
        </td>

    <br />
    </form>

    <form action = "http://localhost/PPM_website_1/manage2.php" method="POST"> <!-- Transmit to DB -->
    <table class = "expense_content">
    <td>&nbsp;</td>
    <br />
    <tr>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delete Data
    </tr>
    <tr>
    <br />
        <td>Type</td>
        <td><input type="Type" id="Type" name="delete_Type" placeholder="Choose your date .." style="width: 200px"></td>
        <td>Date</td>
        <td><input type="date" id="date" name="delete_Date" placeholder="Choose your date .." style="width: 200px"></td>
        <td>description</td>
        <td><input type="text" id="expense" name="delete_description" placeholder="Type your description .." style="width: 350px"></td>
        <td>Expense Values</td>
        <td><input type="text" id="expense_val" name="delete_val" placeholder="Type your values .." style="width: 200px"></td>
    </tr>

    <table submit_reset_btn>
    <tr>
        <td>
            <td>&nbsp;</td><td align ="left" style="width: 400 px;">
             <input type ="submit" value="Delete" name="delete" class='reset_btn' ></td>
       </td>
    </tr>    
   </table>
   </form>


        <br />
        <div class="container_data" style = width: 700 px; align = "center">
        <h3 align="center">Expense Details : Description & Values </h3>
        <td>&nbsp;</td>
        <?php
                $table_expense = "table_expense";
                
                // Search Data
                $select_expense = "SELECT * FROM ".$table_expense;
               
                $select_expense_TotValue = "SELECT SUM(exp_value) AS Tot_exp_value FROM ".$table_expense;
               

                $query_expense          = mysqli_query($mysqli, $select_expense);
                
                $query_expense_TotValue = mysqli_query($mysqli, $select_expense_TotValue);
               

               //Print table_expense Data
               while ($row1 = mysqli_fetch_array($query_expense)){
                   $exp_date = $row1['exp_date'];
                   $exp_description = $row1['exp_description'];
                   $exp_value = $row1['exp_value'];
               
                   echo $exp_description . ': ' . $exp_value . '<br />';
               }
               echo '<br />';
               echo '<br />';
            ?>
            
         <h3 align="center">Income Details : Description & Values </h3>
            <?php
             
             $table_income  = "table_income";

             // Search Data
            
             $select_income  = "SELECT * FROM ".$table_income;
            
             $select_income_TotValue  = "SELECT SUM(inc_value) AS Tot_inc_value FROM ".$table_income;

            
             $query_income           = mysqli_query($mysqli, $select_income);
            
             $query_income_TotValue  = mysqli_query($mysqli, $select_income_TotValue);
               

               // Print table_income Data
               while ($row2 = mysqli_fetch_array($query_income)){
                   $inc_date = $row2['inc_date'];
                   $inc_description = $row2['inc_description'];
                   $inc_value = $row2['inc_value'];
               
                   echo $inc_description . ': ' . $inc_value . '<br />';
               }
               
               //Get result from mysqli_query and using mysqli_fetch_array and make the array and contain in variable array 
               $Tot_expense_TotValue = mysqli_fetch_array($query_expense_TotValue);
               $Tot_income_TotValue  = mysqli_fetch_array($query_income_TotValue);
               echo '<br />';
               echo '<br />';
               ?>

               <h3 align="center">Expense Total Value </h3>
               <?php
               echo $Tot_expense_TotValue["Tot_exp_value"];
               echo '<br />'; 
               echo '<br />'; 
               ?>

               <h3 align="center">Income Total Value </h3>
               <?php
               echo $Tot_income_TotValue["Tot_inc_value"];
               echo '<br />';  
               echo '<br />';
               ?>

               <h3 align="center">Total Balance </h3>
               <?php
               echo $Tot_income_TotValue["Tot_inc_value"] - $Tot_expense_TotValue["Tot_exp_value"];
               echo '<br />';
               echo '<br />';
        ?>
        </div>

<!-- Footer -->
<section class="footer">
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

<script src="main.js"></script>
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

    