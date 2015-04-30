<?php

function KingofCraft_addbeer(){
  global $debug;
  if ($debug) echo "[KingofCraft_addbeer]";
  
  if(! is_user_logged_in()) {
    echo "Sorry you must be logged in to add a beer.<br>
      <a href=". wp_login_url() . " title='Login'>Log in</a>";
    return;
  }
  
  if (isset($_POST['addbeer'])){
    KingofCraft_handle_addbeer();
  }
  
  $current_user = wp_get_current_user();
  $username = get_username($current_user);
  
  KingofCraft_display_addbeer();
}

add_shortcode('KingofCraft_addbeer', 'KingofCraft_addbeer');

function KingofCraft_display_addbeer(){
?>
  <br><br>Add a beer<br><br>
  <div style="font-family:sans-serif; background-color: grey; margin-left: 30px;">
  
  <fieldset>
  <form method="post">
	
      <table>
	<tr>	
		<td><label for="beername">Name:</label></td>
      		<td><input type="text" name="beername" id="beername" class="input"/></td>
	</tr>

	<tr>
		<td><label for="beerType">Type:</label></td>
		<td><?php createmenu("beerType", array("Lager", "Wheat Beer", "Mild Ale", "Stout", "Pale Ale", "Lambic")); ?></td>
	</tr>
      
	<tr>
		<td><label for="beerABV">ABV (%):</label></td>
		<td><input type="text" name="beerABV" id="beerABV" class="input"/></td>
	</tr>

	<tr>
		<td><label for="brewery">Brewed by:</label></td>
		<td><input type="text" name="brewery" id="brewery" class="input"/></td>
	</tr>

	<tr>
 		<td><label for="breweryLoc">Brewery Location:</label></td>
	        <td><input type="text" name="breweryLoc" id="breweryLoc" class="input"/></td>
	</tr>

	<tr>
		<td><label for="beerComment">Description:</label></td>
		<td><textarea rows="4" cols="50" name="beerComment" id="beerComment"></textarea></td>
	</tr>

      </table>	      
      <input type="submit" name="addbeer" value="Add Beer!"/>
  </form>
  </fieldset>
  </div>
<?php
}

function KingofCraft_handle_addbeer(){
  global $wpdb;
  
  $beername = $_POST['beername'];
  $beerType = $_POST['beerType'];
  $beerABV = $_POST['beerABV'];
  $brewery = $_POST['brewery'];
  $breweryLoc = $_POST['breweryLoc'];
  $beerComment = $_POST['beerComment'];
  
  $table_name = $wpdb->prefix . "KC_beers";
  $wpdb->query($wpdb->prepare(
    "INSERT INTO $table_name
    (beername, beerType, beerABV, brewery, breweryLoc, beerComment) values (%s, %s, %f, %s, %s, %s)",
    $beername,
    $beerType,
    $beerABV,
    $brewery,
    $breweryLoc,
    $beerComment
  ));
}

function createmenu($name, $option) {
 echo "<select name='$name'>";
 foreach($option as $opt) {
    echo "<option value='$opt'>$opt</option>";
 }
 echo "</select>";
}
