<?php
include "header.php";
include "menu.php";
echo '<div id="site_content">';
include "profilesidebar.php";

include "checksession.php";
checkUser();

require 'config.php';

//needs to insert on bookingID line taht has been redirected to
$id = '';
if (isset($_GET['id'])) {
  $id = strip_tags(trim($_GET['id']));
  $rsql = "SELECT `bookingreview` FROM `booking` WHERE bookingID = $id ";

  $stmt = $pdo->prepare($rsql);

  $stmt->execute();

  $roomdata = $stmt->fetchAll();

  foreach ($roomdata as $row) {
    $review = $row['bookingreview'];
  }
}

if (isset($_POST['edit'])) {
  $bookingreview = $_POST['bookingreview'];

  $editreviewsql = "UPDATE booking SET bookingreview = :br";

  $editreviewstmt = $pdo->prepare($editreviewsql);

  $editreviewstmt->bindValue(':br', $bookingreview, PDO::PARAM_STR); //Auto sanitized

  if ($editreviewstmt->execute()) {
    $_SESSION['message'] = 'Review edited!';
    header('Location: booking.php');
  }
}


?>
<h2>Edit booking</h2>
<form method="post" action="editreview.php">
  <p>
    <label for="bookingreview">Booking review:</label>
    <textarea name="bookingreview" rows="5" cols="40" maxlength="100"><?php echo '' . $review . ''; ?></textarea>
  </p>
  <br />
  <button type="submit" value="Edit" name="edit" id="btn_editreview"> Edit review </button>
  <button type="button" onClick="javascript:history.go(-1)"> Cancel </button>
</form>
</body>