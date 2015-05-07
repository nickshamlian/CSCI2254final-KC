<?php
function KingofCraft_member() {
  global $debug;
  if ($debug) echo "[KingofCraft_member]";

  $current_user = wp_get_current_user();
  $username = get_current_user_name($current_user);
  echo "Hello $username, Here are all of the 6-Packs that you have created!";

  KingofCraft_showPacks($current_user);
  KingofCraft_addtoPack($current_user);
}
add_shortcode('KingofCraft_member', 'KingofCraft_member');

function KingofCraft_showPacks($current_user) {

  $beerlist = get_user_meta($current_user->ID, 'beer', false);

  if (empty($beerlist)) {
    echo "<h3>You haven't made any 6-Packs yet. Add some!...<h3>";
    return;
  }
  $beerIDs = implode(",", $beerlist);

  global $wpdb;

  $table_name=$wpdb->prefix . "kc_beer";
  $query = "SELECT * FROM $table_name WHERE beerID in ($beerIDs)";
  $allbeers = $wpdb->get_results($query);
  KingofCraft_display_6Pack($allbeers);
}
function KingofCraft_addtoPack($current_user) {

  KingofCraft_setUpList();
  if (isset($_POST['addtoPack'])) {
    KingofCraft_handle_addtoPack($current_user);
  }
}

function KingofCraft_handle_addtoPack($current_user) {
  add_user_meta($current_user->ID, 'beer', $_POST['ID']);
}
function KingofCraft_display_6Pack($allbeers) {
  foreach($allbeers as $beer) {
    $source=$beer->beer_image;
    echo "<tr>";
    echo "<img src='$source'>";
    echo "</tr>";
  }
}
