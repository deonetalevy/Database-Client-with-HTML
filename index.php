<!--Deone'Ta Levy	
    Front End Web App
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
        <strong>Enter Query</strong><br />
        Please enter a valid SQL query or update statement.
        You may also just press "Submit Query" to select
        all parts from the database.<br />
        <form action="output.php" method="post">
            <textarea style="width: 100%" rows="15" name="query"></textarea>
            <input type="submit" value="Submit Query" name="queryButton" />
            <input type="submit" value="Submit Update" name="updateButton"/>
            <input type="reset" value="Reset Window" />
            <input type="hidden" value="<?php echo $username?>" name="username" />
            <input type="hidden" value="<?php echo $password?>" name="password"/>
    </div>
</body>
</html>