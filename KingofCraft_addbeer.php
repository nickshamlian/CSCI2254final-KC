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
  $username = get_current_user_name($current_user);

  
  KingofCraft_display_addbeer();
}

add_shortcode('KingofCraft_addbeer', 'KingofCraft_addbeer');

function KingofCraft_display_addbeer(){
?>
  <br>This page is used to add your favorite beers to our database. Simply fill out the form to add a beer!<br><br>
  <div style="font-family:sans-serif; background-color: grey; margin-left: 30px;">
  
  <fieldset>
  <form method="post">
	
      <table>
	<tr>	
		<td><label for="beername">Name:</label></td>
      		<td><input type="text" name="beername" id="beername" class="input"/></td>
	</tr>

	<tr>
		<td><label for="beertype">Type:</label></td>
		<td><?php createmenu("beertype", array("Lager", "Wheat Beer", "Mild Ale", "Stout", "Pale Ale", "Lambic")); ?></td>
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
		<td><label for="beer_description">Description:</label></td>
		<td><textarea rows="4" cols="50" name="beer_description" id="beer_description"></textarea></td>
	</tr>
	
	<tr>
		<td><label for="beer_image">Beer ImageURL:</label></td>
		<td><input type="text" name="beer_image" id="beer_image" class="input"/></td>
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
  $beertype = $_POST['beertype'];
  $beerABV = $_POST['beerABV'];
  $brewery = $_POST['brewery'];
  $beer_description = $_POST['beer_description'];
  $beer_image = $_POST['beer_image'];
  
  $table_name = $wpdb->prefix . "kc_beer";
  $wpdb->query($wpdb->prepare(
    "INSERT INTO $table_name
    (beername, beertype, beerABV, brewery, beer_image, beer_description) values (%s, %s, %f, %s, %s, %s)",
    $beername,
    $beertype,
    $beerABV,
    $brewery,
    $beer_image,
    $beer_description
  ));
}

function createmenu($name, $option) {
 echo "<select name='$name'>";
 foreach($option as $opt) {
    echo "<option value='$opt'>$opt</option>";
 }
 echo "</select>";
}
