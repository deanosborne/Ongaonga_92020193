<?php
include "header.php";
include "menu.php";
echo '<div id="site_content">';
include "profilesidebar.php";
include "checksession.php";
checkUser(); //check user logged in
?>

<h2>Are you sure you want to delete this booking?</h2>

<div id='form' style='width:350px;'>
<fieldset><legend>Booking details</legend>

<?php
require 'config.php';

    $sid = $_SESSION['customerID']; //get user id
    

    $sql = "SELECT r.roomname, b.bookingID, b.customerID, b.checkindate, b.checkoutdate, c.firstname, c.lastname, b.extras, b.bookingreview
    FROM room AS r INNER JOIN booking AS b ON(r.roomID = b.roomID) INNER JOIN customer AS c ON(c.customerID = b.customerID)
    WHERE b.customerID LIKE $sid";
  
    $stmt = $pdo->prepare($sql);
    
    if($stmt->execute()){
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      //print_r($row);

      echo "<div>Room name:</br> $row[roomname]</div>";
      echo "<div>Checkin date:</br> $row[checkindate]</div>";
      echo "<div>Checkout date:</br> $row[checkoutdate]</div>";
      echo "<div>Extras:</br> $row[extras]</div>";
      echo "<div>Room review:</br> $row[bookingreview]</div></fieldset></div>";
    }
    if(isset($_POST['delete'])){ 
    $delete = "DELETE from booking WHERE bookingID LIKE $row[bookingID]";
    $delstmt = $pdo->prepare($delete);

    if ($delstmt->execute()){
      $_SESSION['message'] ='Booking deleted!';
      header ('Location: booking.php');
    }
  }
    
    

?>

<form method="post" action="bookingdelete.php">
        <div id="delete">
            <div>
                <button type="submit" value="delete" name="delete" id="btn_delete"> Delete </button> 
                <button type="button" onClick="javascript:history.go(-1)"> Cancel </button>
            </div>
        </div>
<br>