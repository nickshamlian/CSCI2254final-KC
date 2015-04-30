<script>
var base_path = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=";
var query = "craft%20beer%20in%20boston";
var key = "AIzaSyBgpzdy85uWW4-eHX1a5OkMkpPUdWx7G5M";

var xmlhttp = new XMLHttpRequest();
var url = base_path + query + "&key=" + key;

xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var args = JSON.parse(xmlhttp.responseText);
        myFunction(args);
    }
}
xmlhttp.open("GET", url, true);
xmlhttp.send();
</script>
