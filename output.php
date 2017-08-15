<!-- Name: Deone'Ta Levy	   
    Front End Database Web App
    -->

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database Client</title>
    <meta http-equiv="content-type" content="text/html; charset=iso8859-1" />
</head>
<body style="font-family:Arial, sans-serif; background-color: #0099FF; padding:5%" >
    <h1 align="left">
        Suppliers, Parts, Jobs, Shipments Database<br />
        Client
    </h1>
    <?php
    extract ($_POST);
   
    $mysqli = new mysqli("localhost", $username, $password, "program5");
    
    //Connect to MySQL
    if($mysqli->connect_errno)
    {
        printf("connection failed, most likely your username and password were incorrect. %s\n", $mysqli->connect_error);
        exit();
    }
    ?>
    <hr size="4" color="black"/>
    <div id="colum2" style="float:left; margin:auto; width:20%">
        <strong>Welcome back</strong><br />
        <?php print("$username");?>
        <form action="index.html">
            <input type="submit" value="Logout" />
        </form>
    </div>
    <div id="colum2" style="float:left; margin:auto; width:80%">
        <?php if(isset($updateButton)): ?>
        <strong>Enter Query</strong><br />
        Please enter a valid SQL query or update statement.
        You may also just press "Submit Query" to select
        all parts from the database.<br />
        <form action="output.php" method="post">
            <textarea style="width: 100%" rows="15"></textarea>
            <input type="submit" value="Submit Query" name="queryButton" />
            <input type="submit" value="Submit Update" name="updateButton"/>
            <input type="reset" value="Reset Window" />
            <input type="hidden" value="<?php echo $username?>" name="username" />
            <input type="hidden" value="<?php echo $password?>" name="password"/>
        </form>
        <?php
            if(!($results = $mysqli->query($query)))
                {
                    printf("Could not execute update!<br />");
                    die("<strong>" . $mysqli->error . "</strong>");
                }
                $explodedQuery = explode(" ", $query);
                  
                $orderSize = $explodedQuery[7];
                $orderSize = substr($orderSize, 0, -1);
                $orderSize = intval($orderSize);
                
                if($orderSize >= 100)
                {
                    $supplierNum = substr($explodedQuery[4], 2, -2);
                    $businessLogic = "update suppliers\n
                    set status = status + 5\n
                    where snum = '$supplierNum'";
                    if(!($results = $mysqli->query("$businessLogic")));
                    {
                     print($mysqli->error);   
                    }
                    
                    
                    printf("Supplier status has changed due to buisness logic<br />
                    Click here to view updated supplier table.");
                    print("<form action=\"output.php\" method=\"post\">\n
                    <input type=\"hidden\" value=\"$username\" name=\"username\" />\n
                    <input type=\"hidden\" value=\"$password\" name=\"password\" />\n
                    <input type=\"hidden\" value=\"select * from suppliers\" name=\"query\" />\n
                    <input type=\"submit\" value=\"View Supplier Table\" name=\"queryButton\" />
                    ");
                }
                  
                  
                $mysqli->close();
        ?>


        <?php elseif(isset($queryButton)): ?>
            <table border="1" style="background-color: #edff00">
        <?php

                  if(!($results = $mysqli->query($query)))
                  {
                      printf("Could not execute query!<br />");
                      die("<strong>" . $mysqli->error . "</strong><br />Please use your browser's back button to return to the query input page.");
                  }
                  print("<tr>");
                  for($counter = 0; $columnName = mysqli_fetch_field($results); $counter++)
                  {
                      print("<td>$columnName->name</td>");
                  }
                  print("</tr>");
                  for ($counter = 0; $row = mysqli_fetch_row($results); $counter++)
                  {
                   //Build the table for the results
                      print("<tr>");
                      foreach ($row as $key => $value)
                      {
                          print("<td>$value</td>");
                      }
                      print("</tr>");
                  }
                  $mysqli->close();
        ?>
                </table>
            <form action="index.php" method="post">
                <input type="hidden" value="<?php echo $username?>" name="username" />
                <input type="hidden" value="<?php echo $password?>" name="password" />
                <input type="submit" value="Return" />
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
