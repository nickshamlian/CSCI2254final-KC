<?php

function KingofCraft_addbeer(){
  global $debug;
  if ($debug) echo "[KingofCraft_addbeer]";
  
  if(! is_user_logged_in()) {
    echo "Sorry you must be logged in to add a beer.<br>
      <a href=" . wp_login_url() . "title="Login>Log in</a>";
    return;
  }
  
  if (isset($_POST['addbeer'])){
    KingofCraft_handle_addbeer();
  }
  
  $current_user = wp_get_current_user();
  $username = get_username($current_user);
  
  KingofCraft_display_addbeer();
}

add_shortcode('KingofCraft_addstamp', 'KingofCraft_addstamp');

function KingofCraft_display_addbeer(){
?>
  <br><br>Add a beer<br><br>
  <div style="font-family:sans-serif; background-color: grey; margin-left: 30px;">
  
  <fieldset>
  <form method="post">
    
      <label for="beername">Name:</label>
      <input type="text" name="beername" id="beername" class="input"/>
      
      <label for="beerABV">ABV (%):</label>
      <input type="text" name="beerABV" id="beerABV" class="input/>
    
      <label for="beerComment">Description:</label>
      <textarea rows="4" cols="50" name="beerComment" id="beerComment"></textarea>
      
      <input type="submit" name="addbeer" value="Add Beer!"/>
  </form>
  </fieldset>
  </div>
<?php
}

function KingofCraft_handle_addstamp(){
  global $wpdb;
  
  $beername = $_POST['beername'];
  $beerABV = $_POST['beerABV'];
  $beerComment = $_POST['beerComment'];
  
  $table_name = $wpdb->prefix . "KC_beers";
  $wpdb->query($wpdb->prepare(
    "INSERT INTO $table_name
    (beername, beerABV, beerComment) values (%s, %f, %s)",
    $beername,
    $beerABV,
    $beerComment
  ));
}
