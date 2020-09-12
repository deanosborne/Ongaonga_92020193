<?php
include "header.php";
include "menu.php";
echo '<div id="site_content">';
include "sidebar.php";

include "checksession.php";
checkUser();

require 'config.php';

    $roomsql = "SELECT roomID, roomname, roomtype, beds from room";

    $stmt = $pdo->prepare($roomsql);
    
    $stmt->execute();

    $roomdata = $stmt->fetchAll();
    

    if(isset($_POST['book'])){

      $cid = $_SESSION['customerID'];
      $roomID = $_POST['room'];
      $checkindate = $_POST['checkindate'];
      $checkoutdate = $_POST['checkoutdate'];
      $extras = $_POST['extras'];

      $bookingsql = "INSERT INTO `booking` (`customerID`, `roomID`, `checkindate`, `checkoutdate`, `extras`) VALUES (:cid, :r, :cin, :cout, :e)";

      $bookstmt = $pdo->prepare($bookingsql);
      
      $bookstmt->bindValue(':cid', $cid);
      $bookstmt->bindValue(':r', $roomID);
      $bookstmt->bindValue(':cin', $checkindate);
      $bookstmt->bindValue(':cout', $checkoutdate);
      $bookstmt->bindValue(':e', $extras);

      $result = $bookstmt->execute();

    }
    
    

?>
    <h2>Make booking</h2>
    <h2><a href='makebooking-JQUERY.php'>[JQUERY]</a><a href="makebooking-AJAX.php">[AJAX]</a></h2>
    <form method="post" action="makebooking.php">
      <p>
        <label for="room">Room (name,type,beds): </label>
        <select name="room">
        
        <?php
        echo '<option value="">Select a room</option>';
        foreach ($roomdata as $row) {
          
          echo '<option value="'.$row["roomID"].'">'.$row["roomID"].', '.$row["roomname"].', '.$row["roomtype"].', '.$row["beds"].' </option>';
        }
        
        ?>
        </select>
       </p>
       <p>
         <label for="checkindate">Checkin date:</label>
         <input type="date" id="checkindate" name="checkindate" >
       </p>
       <p>
         <label for="checkoutdate">Checkout date:</label>
         <input type="date" id="checkoutdate" name="checkoutdate" >
       </p>
       <p>
         <label for="extras">Booking extras:</label>
         <textarea name="extras" rows="5" cols="40" maxlength="200"></textarea>
       </p>
       <br />
       <button type="submit" value="Book" name="book" id="btn_makebooking"> Make booking </button>  
      <button>Cancel</button>
    </form>
