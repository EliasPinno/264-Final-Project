<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us</title>
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
    window.jQuery || document.write('<script src ="js/jquery-3.4.1.min.js"><\/script>')
    </script>
    <script type="text/javascript" src="js/contact.js"></script>
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
    <form method="POST" action = "processContact.php" name="fields">
    <h1>Contact Us</h1>
    <h3>(*) Fields are requried</h3>
        <h2>Name*</h2>
        <input type="text" name="name" placeholder="First Last" maxlength="50" required/>
        <h2>Email*</h2>
        <input type="email" name="email" placeholder="abc@def.ghi" maxlength="50" required/>
        <h2>Phone number</h2>
        <input type="tel" name="phone" placeholder="123-456-7890" maxlength="12" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"/>
        <h2>Address</h2>
        <input type="text" name="address" placeholder="address" maxlength="100"/>
        <h2>Postal Code</h2>
        <input type="text" name="postalcode" placeholder="A1B-2C3" maxlength="7" pattern="[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]"/>
        <h2>Write a message (<span id="charNumber">200</span> characters left)</h2>
        <textarea name="msg" placeholder="Your Message" id="msg" maxlength="200"></textarea><br>
        <input type="submit" name="submit" id="contactSubmit"/>
    </form>
</div>
</main>
<?php // Include the resuable footer on this page
    include "footer.php";
?>
</body>
</html>