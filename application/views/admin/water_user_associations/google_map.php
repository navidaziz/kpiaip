<style>
#map {
    height: 400px;
    /* Set height of the map */
    width: 100%;
    /* Set width of the map */
}
</style>
<!-- Load Google Maps API with the provided API key and callback function -->
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTbYZF_kDxKNopcvej6oh-eVs1z9Xq2J0&amp;callback=sendCordinates"
    async defer></script>
<script>
function sendCordinates() {
    // Coordinates for Khyber Pakhtunkhwa
    var khyberPakhtunkhwa = {
        lat: <?php echo $lat; ?>,
        lng: <?php echo $long; ?>
    };

    // Create a map object and specify the DOM element for display
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12, // Set zoom level to maximum
        center: khyberPakhtunkhwa // Center the map on Khyber Pakhtunkhwa
    });

    // Create a marker and set its position on the map
    var marker = new google.maps.Marker({
        position: khyberPakhtunkhwa,
        map: map,
        title: 'Khyber Pakhtunkhwa' // Tooltip on marker
    });

    // Additional information to display
    var schemeName = "Scheme Name: <?php echo $scheme->scheme_name; ?>";
    var scheme_code = "Scheme: Code:<?php echo $scheme->scheme_code; ?>";
    var address =
        "Address:<?php echo $scheme->district_name; ?>, <?php echo $scheme->tehsil; ?>, <?php echo $scheme->uc; ?>, <?php echo $scheme->villege; ?>";
    var scheme_category = "<?php echo $scheme->category; ?> - <?php echo $scheme->category_detail; ?>";
    var infoContent = "<b>" + schemeName + "</b><br>" + scheme_code + "</b><br><i><small>" + address +
        "</small></i><br/><b>" + scheme_category + "</b>";

    // Create an info window and bind it to the marker
    var infowindow = new google.maps.InfoWindow({
        content: infoContent
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });
    infowindow.open(map, marker);
}
</script>

<div id="map"></div>