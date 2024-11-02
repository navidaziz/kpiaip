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
        center: khyberPakhtunkhwa, // Center the map on Khyber Pakhtunkhwa
        mapTypeId: google.maps.MapTypeId.SATELLITE, // Set initial view to satellite
        mapTypeControl: true, // Enable map type control
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DEFAULT, // Default style of buttons
            position: google.maps.ControlPosition.TOP_RIGHT // Position of the control on the map
        }
    });

    // Create a marker and set its position on the map
    var marker = new google.maps.Marker({
        position: khyberPakhtunkhwa,
        map: map,
        title: 'Khyber Pakhtunkhwa' // Tooltip on marker
    });

    // Additional information to display
    // ... (rest of your code remains the same)

    // ... (rest of your code remains the same)
}

// Initialize the map once the page has loaded
window.onload = sendCordinates;
</script>
<div id="map"></div>