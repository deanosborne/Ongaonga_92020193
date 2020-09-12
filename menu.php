    <?php session_start();
    ?>
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php"><span class="logo_colour">Ongaonga Bed & Breakfast</span></a></h1>
          <h2>Make yourself at home is our slogan. We offer some of the best beds on the east coast. Sleep well and rest well.</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li class="selected"><a href="index.php">Home</a></li>
          <li><a href="listrooms.php">Rooms</a></li>
          <li><a href="makebooking.php">Make a booking</a></li>
          <?php
          //if logged in allow for profile and logout to be displayed, else login
          if (!isset($_SESSION['logged_in'])) {
            echo "<li><a href='login.php'>Login</a></li>";
          } else {
            echo "<li><a href='profile.php'>Profile</a></li>";
            echo "<li><a href='logout.php'>Logout</a></li>";
          }

          ?>
        </ul>
      </div>
    </div>