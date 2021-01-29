<?php
            // use @ to supress error warning: if no value was provided, $search = null
            @$search = $_GET['search']; 
            if($search == null){ // No search values
                echo "<h2>Search something</h2>";
            }else{
                // Hidden for security: you need to fill this in
                $host = "";
                $database = "";
                $user = "";
                $password = "";
                // @ used to supress error. That way warning message is not printed, but still navigate to error branch
                @$connection = mysqli_connect($host, $user, $password, $database); 
                $error = mysqli_connect_error();
                if($error != null) {
                    $output = "<p>Unable to connect to database! Cannot search</p>";
                    exit($output);
                }else{ // Perform the search
                    // From lab 11
                    $search = mysqli_real_escape_string($connection,$search);
                    $sql = "SELECT bd.ISBN,title,publisher,pubdate,edition,pages,CategoryName,nameF,nameL,description,price
                    FROM bookdescriptions AS bd 
                    INNER JOIN bookauthorsbooks AS bab ON bd.ISBN = bab.ISBN 
                    INNER JOIN bookauthors AS ba ON bab.AuthorID = ba.AuthorID
                    INNER JOIN bookcategoriesbooks AS bcb ON bd.ISBN = bcb.ISBN 
                    INNER JOIN bookcategories AS bc ON bcb.CategoryID = bc.CategoryID 
                    WHERE title LIKE '%$search%' || CONCAT(nameF,' ', nameL) LIKE '%$search%' || bc.CategoryName Like '%$search%'
                    GROUP BY ISBN";
                    $resultsSQL = mysqli_query($connection, $sql);
                    while($row = mysqli_fetch_assoc($resultsSQL)){ // Generate each search result
                        echo "<div class='searchResult'>";
                        echo "<a href='product.php?" 
                        ."&ISBN=".$row['ISBN']
                        ."'>" . $row['title'] ."</a> ";
                        echo "<br>By: <a href='#' ".$row['nameL']." class='searchLink' >".$row['nameF']." ".$row['nameL']."</a>";
                        echo "<div class='description'>"."<img class='thumbImg'src='img/".$row['ISBN'].".THUMB.jpg'/>".$row['description']."</div>";
                        echo "<a href='product.php?" 
                        ."&ISBN=".$row['ISBN']
                        ."'>more...</a> ";
                        echo "</div><br>";
                    }
                }
            }
?>