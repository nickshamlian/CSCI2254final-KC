<?php 


function KingofCraft_guest() {
  global $debug;
  if ($debug) echo "[KingofCraft_guest]";
  
  if (! is_user_logged_in() ) {
    echo "Sorry you must be logged in to access this page. <br>
      <a href=". wp_login_url() . " title='Login'>Log in</a>";
    return;
  }
  
  $current_user = wp_get_current_user();
  $username = get_current_user_name($current_user);
  echo "Hello $username. Welcome to King of Craft: <br><br>
    Here is a list of all the beers in your collection...";

}
