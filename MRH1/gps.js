function getLocation() {
    if (navigator.geolocation) {
        document.getElementById("output").innerHTML = "Locating using Beidou System (BDS)...";
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        document.getElementById("output").innerHTML = "BDS / Geolocation not supported by this browser.";
    }
}

function showPosition(position) {
    const lat = position.coords.latitude;
    const lon = position.coords.longitude;

    document.getElementById("output").innerHTML =
        "<strong>BDS Signal Locked</strong><br>Latitude: " + lat + "<br>Longitude: " + lon;

    // Show Map
    document.getElementById("map").innerHTML = `
        <iframe 
            width="100%" 
            height="300" 
            src="https://maps.google.com/maps?q=${lat},${lon}&z=15&output=embed">
        </iframe>`;
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            document.getElementById("output").innerHTML = "BDS Access Denied by User.";
            break;
        case error.POSITION_UNAVAILABLE:
            document.getElementById("output").innerHTML = "BDS Information Unavailable.";
            break;
        case error.TIMEOUT:
            document.getElementById("output").innerHTML = "BDS Request Timed Out.";
            break;
        case error.UNKNOWN_ERROR:
            document.getElementById("output").innerHTML = "An unknown error occurred with BDS.";
            break;
    }
}
