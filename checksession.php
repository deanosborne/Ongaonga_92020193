<?php
function checkUser() {
    $_SESSION['URI'] = '';    
    if ($_SESSION['logged_in'] == 1)
       return TRUE;
    else {
       $_SESSION['URI'] = 'http://localhost'.$_SERVER['REQUEST_URI']; //save current url for redirect     
       header('Location: login.php', true, 303);       
    }       
}

function loginStatus() {
    $un = $_SESSION['firstname'];
    if ($_SESSION['logged_in'] == 1)     
        echo "<h2>Logged in as $un</h2>";
    else
        echo "<h2>Logged out</h2>";            
}

function login($id,$firstname) {
    //simple redirect if a user tries to access a page they have not logged in to
    if ($_SESSION['logged_in'] == 0 and !empty($_SESSION['URI']))        
         $uri = $_SESSION['URI'];          
    else { 
      $_SESSION['URI'] =  'index.php';         
      $uri = $_SESSION['URI'];           
    }         
    $_SESSION['customerID'] = $id;   
    $_SESSION['firstname'] = $firstname; 
    $_SESSION['URI'] = ''; 
    header('Location: '.$uri, true, 303);        
 }
?>