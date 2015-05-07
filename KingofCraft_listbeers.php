<?php

function KingofCraft_listBeers() {

  global $debug;
  global $wpdb;
    
  if ($debug) echo "[KingofCraft_listBeers]";
  
  $table_name = $wpdb->prefix . "kc_beer";
  $query = "SELECT * FROM $table_name";
  $allbeers = $wpdb->get_results($query);

  if(! is_user_logged_in() && ($allbeers)) {
    KingofCraft_showBeers_guest($allbeers);
  } elseif(is_user_logged_in() && ($allbeers)) {
    KingofCraft_showBeers_member($allbeers);
  }  else {
    return "<h3>No beers yet, add some!</h3>";
  }
}

add_shortcode('KingofCraft_listBeers', 'KingofCraft_listBeers');

function KingofCraft_showBeers_guest($allbeers){
  create_beer_table_header();
  foreach($allbeers as $beer) {
    create_guest_table_row($beer);
  }
  create_beer_table_footer();
}

function KingofCraft_showBeers_member($allbeers){
  create_beer_table_header();
  foreach($allbeers as $beer) {
    create_member_table_row($beer);
  }
  create_beer_table_footer();
}

function create_beer_table_header() {
?>

  <div id="beererror"></div>
  <table class="beertable">
    <tr class="beertablerow">
      <th>Picture</th>
      <th>Beer Information</th>
      <th>Description</th>
    </tr>

<?php
}

function create_beer_table_footer() {
?>

  </table>

<?php
}

function create_guest_table_row($beer) {
?>

  <tr class="beertablerow">
  	<?php $source=$beer->beer_image; ?>
  	<td><?php echo "<img src='$source'>";?></td>
    <td><?php echo $beer->beername . " <br>" .
                   $beer->beertype . " <br>" .
                   $beer->beerABV . "% <br>" .
                   $beer->brewery
    ?></td>

    <td><?php echo $beer->beer_description;?></td>
  </tr>

<?php
}

function create_member_table_row($beer) {
  $beerID = $beer->beerID;
  $source=$beer->beer_image;
?>
  <tr class="beertablerow">

  	<td><?php echo "<img src='$source'>";?>
  	    <form method="post">
        <input type="submit" name="addtoPack" value="Add to your pack!">
         <input type="hidden" name="ID" value= <?php echo "$beerID"?> >
        </form></td>

    <td><?php echo $beer->beername . " <br>" .
                   $beer->beertype . " <br>" .
                   $beer->beerABV . "% <br>" .
                   $beer->brewery   ?></td>

    <td><?php echo $beer->beer_description;?></td>

  </tr>

<?php
}
