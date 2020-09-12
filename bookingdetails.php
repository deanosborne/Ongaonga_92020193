<?php
include "header.php";
include "menu.php";
echo '<div id="site_content">';
include "profilesidebar.php";
include "checksession.php";
checkUser();
?>


<h2>Current bookings</h2>

<div id='form' style='width:350px;'>
<fieldset><legend>Booking details</legend>

<?php
require 'config.php';

    $sid = $_SESSION['customerID'];

    $sql = "SELECT r.roomname, b.bookingID, b.customerID, b.checkindate, b.checkoutdate, c.firstname, c.lastname, b.extras, b.bookingreview
    FROM room AS r INNER JOIN booking AS b ON(r.roomID = b.roomID) INNER JOIN customer AS c ON(c.customerID = b.customerID)
    WHERE b.customerID LIKE $sid";

    $stmt = $pdo->prepare($sql);
    
    if($stmt->execute()){
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      // print_r($row);
      echo "<div>Room name:</br> $row[roomname]</div>";
      echo "<div>Checkin date:</br> $row[checkindate]</div>";
      echo "<div>Checkout date:</br> $row[checkoutdate]</div>";
      echo "<div>Extras:</br> $row[extras]</div>";
      echo "<div>Room review:</br> $row[bookingreview]</div></fieldset></div>";
    }
    

?>
<br>
<h4><a href="javascript:history.go(-1)">[Return]</a></h4>