<!DOCTYPE html>
<html lang="en">
<head>
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
        <h2>Searches pop up here</h2>
        </div>
    </main>
    <?php // Include the resuable footer on this page
        include "footer.php";
    ?>
</body>
</html>