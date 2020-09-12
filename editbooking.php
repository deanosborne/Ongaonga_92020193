<?php
include "header.php";
include "menu.php";
echo '<div id="site_content">';
include "profilesidebar.php";

include "checksession.php";
checkUser();

require 'config.php';

$id='';
if (isset($_GET['id'])){ //based on url id
$id = strip_tags( trim($_GET['id']));
$roomsql = "SELECT b.roomID, r.roomname, b.customerID, r.roomtype, r.beds, b.checkindate, b.checkoutdate, b.extras, b.bookingreview
FROM room AS r INNER JOIN booking AS b ON(r.roomID = b.roomID) 
WHERE bookingID = $id ";

$stmt = $pdo->prepare($roomsql);

$stmt->execute();

$roomdata = $stmt->fetchAll();

foreach ($roomdata as $row) { //relate vars so they can be put into forms 
  $roomid = $row['roomID'];
  $roomname = $row['roomname'];
  $roomtype = $row['roomtype'];
  $beds = $row['beds'];
  $checkin = $row['checkindate'];
  $checkout = $row['checkoutdate'];
  $extras = $row['extras'];
  $review = $row['bookingreview'];
}

}

if(isset($_POST['edit'])){ //form post edit
  $checkindate = $_POST['checkindate']; //In future, check if date is valid probably
  $checkoutdate = $_POST['checkoutdate'];
  $extras = $_POST['extras'];
  $bookingreview = $_POST['bookingreview'];

  $editbooksql = "UPDATE booking SET checkindate = :cin, checkoutdate = :cout, extras = :e, bookingreview = :br";

  $editbookstmt = $pdo->prepare($editbooksql);
  
  $editbookstmt->bindValue(':cin', $checkindate, PDO::PARAM_STR); //Auto sanitized
  $editbookstmt->bindValue(':cout', $checkoutdate, PDO::PARAM_STR);
  $editbookstmt->bindValue(':e', $extras, PDO::PARAM_STR);
  $editbookstmt->bindValue(':br', $bookingreview, PDO::PARAM_STR);

  if ($editbookstmt->execute()){
    $_SESSION['message'] ='Booking edited!';
    header('Location: booking.php');
  }
  }


?>

<!-- This is not being pulled from a database as of yet as not required! -->
        <h2>Edit booking</h2>
        <form method="post" action="editbooking.php">
      <p>
        <label for="room">Room (name,type,beds): </label>
        <select name="room">
        
        <?php
        foreach ($roomdata as $row) {
          
          echo '<option value="'.$roomid.'">'.$roomname.', '.$roomtype.', '.$beds.' </option>';
        }
        
        ?>
        </select>
       </p>
       <p>
       <!-- simple datepicker, could use jquery but prob unneeded? -->
         <label for="checkindate">Checkin date:</label>
         <input type="date" id="checkindate" name="checkindate" <?php echo 'value="'.$checkin.'"'; ?> >
       </p>
       <p>
         <label for="checkoutdate">Checkout date:</label>
         <input type="date" id="checkoutdate" name="checkoutdate" <?php echo 'value="'.$checkout.'"'; ?>>
       </p>
       <p>
         <label for="extras">Booking extras:</label>
         <textarea name="extras" rows="5" cols="40" maxlength="100" ><?php echo ''.$extras.''; ?></textarea>
       </p>
       <p>
         <label for="bookingreview">Booking review:</label>
         <textarea name="bookingreview" rows="5" cols="40" maxlength="100"><?php echo ''.$review.''; ?></textarea>
       </p>
       <br />
       <button type="submit" value="Edit" name="edit" id="btn_editbooking"> Edit booking </button>  
       <button type="button" onClick="javascript:history.go(-1)"> Cancel </button>
    </form>
  </body>
