<?php  


include "config.php"; //load in any variables

 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
    $checkin = $_POST["from_date"];
    $checkout = $_POST["to_date"];

      $query = "SELECT * FROM `room` WHERE roomID NOT IN (SELECT roomID FROM booking WHERE checkindate >= :cin AND checkoutdate <= :cout )";
      $stmt = $pdo->prepare($query);
      $stmt->bindValue(':cin', $checkin, PDO::PARAM_STR); //auto sanitized
      $stmt->bindValue(':cout', $checkout, PDO::PARAM_STR);
      $stmt->execute();

      if($output = $stmt->fetchAll()){

      foreach ($output as $row) {
          echo '<table><tr><th>Roomname</th><th>Roomtype</th><th>Beds</th><th>Description</th></tr>';
          echo '<tr><th>'.$row["roomname"].'</th>'; 
          echo '<th>'.$row["roomtype"].'</th>'; 
          echo '<th>'.$row["beds"].'</th>'; 
          echo '<th>'.$row["description"].'</th></tr>'; 
      }
     } else {
         echo "No rooms found!";
     }
    }
 ?>