<?php

function getBars() {
?>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script src="KingofCraft_bar_script.js"></script>

<?php
}

add_shortcode('KingofCraft_getBars', 'getBars');
