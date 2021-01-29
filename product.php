<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    // Perform all the connection and data related things not specific to a field... you need to fill this in
        $host = "";
        $database = "";
        $user = "";
        $password = "";
        // @ used to supress error. That way warning message is not printed, but still navigate to error branch
        @$connection = mysqli_connect($host, $user, $password, $database); 
        $error = mysqli_connect_error();

        if($error != null) {
            $output = "<p>Unable to connect to database! Cannot get more info</p>";
            exit($output);
        }else{ // Perform the search
            $ISBN = $_GET['ISBN']; // Primary Key, all we need for all other info
            $sql = "SELECT bd.ISBN,title,publisher,pubdate,edition,pages,CategoryName,nameF,nameL,description,price
                    FROM bookdescriptions AS bd 
                    INNER JOIN bookauthorsbooks AS bab ON bd.ISBN = bab.ISBN 
                    INNER JOIN bookauthors AS ba ON bab.AuthorID = ba.AuthorID
                    INNER JOIN bookcategoriesbooks AS bcb ON bd.ISBN = bcb.ISBN 
                    INNER JOIN bookcategories AS bc ON bcb.CategoryID = bc.CategoryID 
                    WHERE bd.ISBN = '$ISBN'";
            $resultsSQL = mysqli_query($connection, $sql);
            $data = mysqli_fetch_assoc($resultsSQL); // Generate search result
        }
    // html begins. output all data in relevant locations
    ?>
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
    <h1><?php echo $data['title']; ?></h1>

    <div class="rowElements">
    <div class="imageContainer col">
        <img src='img/<?php echo $data['ISBN']?>.MED.jpg' class='productImage'/>
    </div>
    <div class = "mainInfo col">
        <h2>Author: <?php 
        // Special code needed for multiple authors
        echo "<a href ='#' class='searchLink'>".$data['nameF']. " ".$data['nameL']."</a>";
        while($row = mysqli_fetch_assoc($resultsSQL)){
            if($row['nameF'] != $data['nameF'] && $row['nameL'] != $data['nameL'])
                echo ", <a href ='#' class='searchLink'>".$row['nameF']." ".$row['nameL']."</a>";
        }
        ?></h2>
        <h2>ISBN: <?php echo $data['ISBN'];?></h2>
        <h2>Price: $<?php echo $data['price'];?></h2>
        <h2>Published:<?php echo $data['pubdate']?></h2>
    </div>
    <div class='extraInfo col'>
        <h3>Edition: <?php echo $data['edition']?></h3>
        <h3>Pages: <?php echo $data['pages']?></h3>
        <h3>Publisher: <?php echo $data['publisher']?></h3>
        <h3>Category: <?php echo $data['CategoryName']?></h3>
    </div>
    </div>
    <div class="productDesc">
        <?php echo $data['description']?>
    </div>

</div>
</main>
<?php // Include the resuable footer on this page
   include "footer.php";
?>

</body>
</html>