<?php
include "header.php";
include "menu.php";
echo '<div id="site_content">';

include "sidebar.php";

include "checksession.php";

include "config.php";

$query = 'SELECT roomname,roomtype, beds, description FROM room ORDER BY roomtype';
$stmt = $pdo->prepare($query);
$stmt->execute();
?>
<h1>Room list</h1>
<!-- <h2><a href='addroom.php'>[Add a room]</a><a href="index.php">[Return to main page]</a></h2> -->
<table>
    <?php

    //makes sure we have rooms

    if ($output = $stmt->fetchAll()) {

        foreach ($output as $row) {
            echo '<table><tr><th>Roomname</th><th>Roomtype</th><th>Beds</th><th>Description</th></tr>';
            echo '<tr><th>' . $row["roomname"] . '</th>';
            echo '<th>' . $row["roomtype"] . '</th>';
            echo '<th>' . $row["beds"] . '</th>';
            echo '<th>' . $row["description"] . '</th></tr>';
        }
    }
    ?>