<?php
include "header.php";
include "menu.php";
echo '<div id="site_content">';
include "profilesidebar.php";
include "checksession.php";
checkUser(); //Make sure user logged in
?>

<h1>Your Bookings</h1>

<!-- Get message from any page -->
<?php
if (!empty($_SESSION['message'])) {
  echo '<p class="message"> ' . $_SESSION['message'] . '</p>';
  unset($_SESSION['message']);
}
?>

<table>
  <tr>
  <table><tr><th>Booking (room, dates)</th>
    <th>Customer</th>
    <th>Action</th></tr><tr>

    <?php
    require 'config.php'; //init conn

    $sid = $_SESSION['customerID']; //get customer id

    $sql = "SELECT r.roomname, b.bookingID, b.customerID, b.checkindate, b.checkoutdate, c.firstname, c.lastname 
    FROM room AS r INNER JOIN booking AS b ON(r.roomID = b.roomID) INNER JOIN customer AS c ON(c.customerID = b.customerID)
    WHERE b.customerID LIKE $sid";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    if ($output = $stmt->fetchAll()) { //fetch and output all rows to echo
      foreach ($output as $row) {

        echo "<th>$row[roomname], $row[checkindate], $row[checkoutdate]</th>";
        echo "<th>$row[firstname], $row[lastname]</th>";
        echo "<th><a href='bookingdetails.php?id=$row[bookingID]'>[view]</a> ";
        echo "<a href='editbooking.php?id=$row[bookingID]'>[edit]</a>  ";
        echo "<a href='editreview.php?id=$row[bookingID]'>[manage reviews]</a> ";
        echo "<a href='bookingdelete.php?id=$row[bookingID]'>[delete]</a></th></tr>";
      }
    } else {
      echo "No bookings found!";
    }
    ?>