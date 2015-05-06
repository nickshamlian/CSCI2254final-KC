<?php

function KingofCraft_listBeers() {
  
  global $wpdb;
  $table_name = $wpdb->prefix . "kc_beer";
  $query = "SELECT * FROM $table_name";
  $allbeers = $wpdb->get_results($query);
  
  if($allbeers){
    KingofCraft_showBeers($allbeers);
  }
  else {
    return "<h3>No beers yet, add some!</h3>";
  }
}

add_shortcode('KingofCraft_listBeers', 'KingofCraft_listBeers');

function KingofCraft_showBeers($allbeers){
  create_beer_table_header();
  foreach($allbeers as $beer) {
    //echo "<pre>" . print_r($beer) . "</pre";
    create_beer_table_row($beer);
  }
  create_beer_table_footer();
}

function create_beer_table_header() {
?>

  <div id="beererror"></div>
  <table class="beertable">
    <tr class="beertablerow">
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

function create_beer_table_row($beer) {
?>

  <tr class="beertablerow">
    <td><?php echo $beer->beername . " <br>" .
                   $beer->beerType . " <br>" .
                   $beer->beerABV . " <br>" .
                   $beer->brewery . " <br>" . 
                   $beer->breweryLoc;
    ?></td>
    
    <td><?php echo $beer->beerComment;?></td>
  </tr>
  
<?php
}
  
