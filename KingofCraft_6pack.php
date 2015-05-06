<?php

function KingofCraft_member() {
  global $debug;
  if ($debug) echo "[KingofCraft_member]";
  
  $current_user = wp_get_current_user();
  $username = get_current_user_name($current_user);
  echo "Hello $username, Here are all of the 6-Packs that you have created!"
  
  KingofCraft_addtoPack();
}

add_shortcode('KingofCraft_member', 'KingofCraft_member');

function KingofCraft_addtoPack($current_user) {
  
  KingofCraft_setUpList();
  if (isset($_POST['addtoPack'])) {
    KingofCraft_handle_addtoPack($current_user);
  }
}

function KingofCraft_setUpList() {
  global $wpdb;
  $table_name = $wpdb->prefix . "kc_beer";
  $query = "SELECT * FROM $table_name";
  $allbeers = $wpdb->get_results($query);
  if($allbeers){
    KingofCraft_showOptions($allbeers);
  }
  else {
    return "<h3>No beers yet, add some!</h3>";
  }
}

function KingofCraft_showOptions($allbeers){
  create_beer_table_header();
  foreach($allbeers as $beer) {
    create_6pack_options_row($beer);
  }
  create_beer_table_footer();
}

function create_6pack_options_row($beer) {

  $beerID = $beer->beerID;
  $source=$beer->beer_image;
?>
  <tr class="beertablerow">
  
  	<td><?php echo "<img src='$source'>";?>
  	    <form method="post">
        <input type="submit" name="addtoPack" value="Add to your pack!">
        <input type="hidden" name="ID" value="$beerID">
        </form></td>
        
    <td><?php echo $beer->beername . " <br>" .
                   $beer->beertype . " <br>" .
                   $beer->beerABV . "% <br>" .
                   $beer->brewery   ?></td>

    <td><?php echo $beer->beer_description;?></td>
    
  </tr>

<?php
}

function KingofCraft_handle_addtoPack($current_user) {
  add_user_meta($current_user->ID, 'beer', $_POST['ID']);
}
