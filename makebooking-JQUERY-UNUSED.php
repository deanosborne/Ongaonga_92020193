<?php
include "header.php";
include "menu.php";
echo '<div id="site_content">';
include "profilesidebar.php";


?>
<!-- This is not being pulled from a database as of yet as not required! -->
    <link rel="stylesheet" href=
    "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js">
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">
    </script>
    <script>
      $( function() {
        var dateFormat = "mm/dd/yy",
          from = $( "#from" )
            .datepicker({
              defaultDate: "-1w",
              changeMonth: true,
              numberOfMonths: 1
            })
            .on( "change", function() {
              to.datepicker( "option", "minDate", getDate( this ) );
            }),
          to = $( "#to" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1
          })
          .on( "change", function() {
            from.datepicker( "option", "maxDate", getDate( this ) );
          });

        function getDate( element ) {
          var date;
          try {
            date = $.datepicker.parseDate( dateFormat, element.value );
          } catch( error ) {
            date = null;
          }

          return date;
        }
      } );
    </script>
  <body>
  <div id="main1">
    <h2>
      Make booking
    </h2>
    <form>
      <p>
        <label for="room">Room (name,type,beds):</label>
        <select id="room" name="room" required="">
          <option value="room1">
            Kellie, S, 5
          </option>
          <option value="room2">
            NotKellie, R, 1
          </option>
        </select>
      </p>
      <p>
        <label for="from">Checkin date:</label> <input type="text"
        id="from" name="from" required="">
      </p>
      <p>
        <label for="to">Checkout date:</label> <input type="text"
        id="to" name="to" required="">
      </p>
      <p>
        <label for="contactnumber">Contact number:</label>
        <input type="tel" id="contactnumber" name="contactnumber"
        placeholder="##########" pattern="[0-9]{3}[0-9]{3}[0-9]{4}"
        minlength="10" maxlength="12" required="">
      </p>
      <p>
        <label for="extras">Booking extras:</label>
        <textarea name="extras" rows="5" cols="40" maxlength=
        "200"></textarea>
      </p><br>
      <button>Add</button> <button>Cancel</button>
    </form>
    </div>
  </body>

