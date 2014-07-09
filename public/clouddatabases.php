<html> 
<head><title>Connecting to Cloud Databases</title></head> 
<body><pre> 
<?php 
    // phpinfo(); 
    $THE_HOST = "ajeesh-db.my.phpcloud.com"; 
    $THE_USER = "ajeesh"; 
    $THE_PWD = "21pt2421"; 
    $THE_DB = "ajeesh"; 

    // 
    // Get "e" 
    // 
    $arg_expr = trim($_POST["e"]); 
    if($arg_expr == "") { 
        $arg_expr = "PI()"; 
    } 
    else { 
        if(get_magic_quotes_gpc()) { 
         $arg_expr = stripslashes($arg_expr); 
        } 
        
        // 
        // Connect to the database 
        // 
        $connection = mysql_connect($THE_HOST, $THE_USER, $THE_PWD); 
        if (!$connection) { 
             die('I could not connect to the database. The error is: ' . mysql_error()); 
        } 
        mysql_select_db($THE_DB, $connection); 
        // 
        // Calculation 
        // 
     $result = mysql_query("SELECT (" . $arg_expr . ");", $connection); 
        $row = mysql_fetch_array($result, MYSQL_NUM); 
        $eValue = $row[0]; 
        printf("The database connection worked, and MySQL says that %s = %s<BR>%s", $arg_expr, $eValue, mysql_error());
        mysql_free_result($result); 
         $res=mysql_query("INSERT INTO `users` SET username='ajeesh', password='md5(123456)' ,status=1 ");
        mysql_close($connection); 
    } 
?> 
    <FORM ACTION='clouddatabases.php' METHOD='POST'> 
        Enter a MySQL expression: 
        <INPUT TYPE="TEXT" NAME="e" VALUE="<? echo $arg_expr; ?>"/> 
        <INPUT TYPE="SUBMIT"> 
    </FORM> 
    </body> 
</html>
