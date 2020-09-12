    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js">
    </script>
    <script src="https://code.jquery.com/jquery-1.12.4.js">
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">
    </script>
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


    if (isset($_POST['book'])) {

      $cid = $_SESSION['customerID'];
      $roomID = $_POST['room'];
      $checkindate = $_POST['checkindate'];
      $checkoutdate = $_POST['checkoutdate'];
      $extras = $_POST['extras'];

      $bookingsql = "INSERT INTO `booking` (`customerID`, `roomID`, `checkindate`, `checkoutdate`, `extras`) VALUES (:cid, :r, :cin, :cout, :e)";

      $bookstmt = $pdo->prepare($bookingsql);

      $bookstmt->bindValue(':cid', $cid, PDO::PARAM_INT); //Auto sanitized
      $bookstmt->bindValue(':r', $roomID, PDO::PARAM_INT);
      $bookstmt->bindValue(':cin', $checkindate, PDO::PARAM_STR);
      $bookstmt->bindValue(':cout', $checkoutdate, PDO::PARAM_STR);
      $bookstmt->bindValue(':e', $extras, PDO::PARAM_STR);

      $result = $bookstmt->execute();

      if ($result)
      {
        
        $_SESSION['message'] = 'Booking made!';

        header('Location: booking.php');
      }
      else {
        echo 'Try again';
      }
    }
    ?>
    <h2>Make booking</h2>

    <form method="post" action="makebooking.php">
      <p>
        <label for="room">Room (name,type,beds): </label>
        <select name="room">

          <?php
          //set value to roomid so we can input to db, then display details
          echo '<option value="">Select a room</option>';
          foreach ($roomdata as $row) {

            echo '<option value="' . $row["roomID"] . '">' . $row["roomname"] . ', ' . $row["roomtype"] . ', ' . $row["beds"] . ' </option>';
          }

          ?>
        </select>
      </p>
      <p>
        <label for="checkindate">Checkin date:</label>
        <input type="date" id="checkindate" name="checkindate">
      </p>
      <p>
        <label for="checkoutdate">Checkout date:</label>
        <input type="date" id="checkoutdate" name="checkoutdate">
      </p>
      <p>
        <label for="extras">Booking extras:</label>
        <textarea name="extras" rows="5" cols="40" maxlength="200"></textarea>
      </p>
      <br />
      <button type="submit" value="Book" name="book" id="btn_makebooking"> Make booking </button>
      <button>Cancel</button>
    </form>
    <hr style="margin-top: 20px;" />
    <h2>
      Search for room availability
    </h2>
    <form method="POST">
      <input type="text" name="from_date" id="from_date" placeholder="From Date"> <input type="text" name="to_date" id="to_date" placeholder="To Date"> <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info">
    </form>
    <div id="member_table">
      </table>
    </div>
    <script>
      $('.datepicker').datepicker();
      $(document).ready(function() {
        $.datepicker.setDefaults({
          dateFormat: 'yy-mm-dd',
          minDate: 0,
          maxDate: "+1M"
        });
        $(function() {
          $("#from_date").datepicker();
          $("#to_date").datepicker();
        });
        $('#filter').click(function() {
          var from_date = $('#from_date').val();
          var to_date = $('#to_date').val();
          if (from_date != '' && to_date != '') {
            $.ajax({
              url: "roomsearch.php", //external php to allow for roomsearch
              method: "POST",
              data: {
                from_date: from_date,
                to_date: to_date
              },
              success: function(data) {
                $('#member_table').html(data); //send data to div
              }
            });
          } else {
            alert("Please Select Date");
          }
        });
      });
    </script>
    </body>