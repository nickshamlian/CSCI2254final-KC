<!DOCTYPE html>
<html>
  <head>
    <title>Place searches</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        height: 99%;
        margin: 0px;
        padding: 0px
      }
    </style>

  </head>
  <body>
  <div id="map-canvas"></div>
  </body>
</html>

  function getBrewery() {
    
  <?php
  
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script type = "text/javascript" src = "KingofCraft_brewery_script.js"></script>
    
  ?>
  
  }
  
  add_shortcode('KingofCraft_getBrewery', 'getBrewery');
