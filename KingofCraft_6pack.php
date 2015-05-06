<?php
function KingofCraft_6pack_options() {
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

add_shortcode('KingofCraft_6pack_options', 'KingofCraft_6pack_options');

function KingofCraft_showOptions($allbeers){
  create_beer_table_header();
  foreach($allbeers as $beer) {
    create_6pack_options_row($beer);
  }
  create_beer_table_footer();
}

function create_6pack_options_row($beer) {
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
  <tr>
    <form method="post">
    <input type="submit" name="submit" value="Add to your pack!">
  </tr>

<?php
}
