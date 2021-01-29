<!DOCTYPE html>
<html lang="en">
<head>
    <title>Thank you!</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
        window.jQuery || document.write('<script src ="js/jquery-3.4.1.min.js"><\/script>')
    </script>
    <script type="text/javascript" src='js/main.js'></script>
    <link rel="stylesheet" type="text/css" href="./css/index.css"/>
</head>
<body>
<?php // Include the resuable header on this page
        include "header.php";
?>
<main>
<?php
    include "sidebar.php";
?>
<div class="mainContent">
<?php
    // How I connected to my local database
    $host = "127.0.0.1";
    $database = "pinno_project_db";
    $user = "root";
    $password = "";

    // @ used to supress error. That way warning message is not printed, but still navigate to error branch
    @$connection = mysqli_connect($host, $user, $password, $database); 
    $error = mysqli_connect_error();

    if($error != null) {
        $output = "<p>Unable to connect to database! We cannot store your information</p>";
        exit($output);
    }else{ // We can connect to the database
        echo "<h1>Thank you for submitting!</h1> <h2>We have recived the following information: </h2>";
        // Load our posted variables, clean them to prevent sql injection
        $data = array(
            0 => mysqli_real_escape_string($connection,$_POST['name']),
            1 => mysqli_real_escape_string($connection,$_POST['email']),
            2 => mysqli_real_escape_string($connection,$_POST['phone']),
            3 => mysqli_real_escape_string($connection,$_POST['address']),
            4 => mysqli_real_escape_string($connection,$_POST['postalcode']),
            5 => mysqli_real_escape_string($connection,$_POST['msg'])
        );
        $keys = array(
            0=>'Name',
            1=>'Email',
            2=>'Phone',
            3=>'Address',
            4=>'Postalcode',
            5=>'Message'
        );
        // Printing all the data we actually recived. Omit null values
        for($i = 0; $i < 6; $i++){
            if($data[$i] != ""){
                echo "<p>$keys[$i]: $data[$i]</p>";
            }else{
                $data[$i] = null;
            }
        }
        // Bonus: Post to database
        $sql = "INSERT INTO contact(name,email,phone,address,postalcode,msg) VALUES('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]');";
        $connection->query($sql);
    }
?>
</div>
</main>
    <?php // Include the resuable footer on this page
        include "footer.php";
    ?>
</body>

</html>