<?php

function getBrewery() {
?>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script src="KingofCraft_brewery_script.js"></script>

<?php
}

add_shortcode('KingofCraft_getBrewery', 'getBrewery');
