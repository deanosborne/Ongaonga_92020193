<?php
include "header.php";
include "menu.php";
echo '<div id="site_content">';
include "profilesidebar.php";
include "checksession.php";
checkUser();
?>

<div>

<h1>Welcome <?php echo $_SESSION['firstname']; ?> </h1>
<?php //grab message if used
if (!empty($_SESSION['message'])) {
  echo '<p class="message"> '.$_SESSION['message'].'</p>';
  unset($_SESSION['message']);
}
?>

</div>

<?php
require 'config.php';

    $fname = $_SESSION['customerID'];

    $sql = "SELECT * FROM customer WHERE customerID LIKE $fname";

    $stmt = $pdo->prepare($sql);
    
    if($stmt->execute()){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // print_r($row);

    echo "<p>Your ID <br>$row[customerID]";
    echo "<p>First name<br> $row[firstname]";
    echo "<p>Last name<br> $row[lastname]";
    echo "<p>Email<br> $row[email]";
    }
    

?>


