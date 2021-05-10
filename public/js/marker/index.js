

  var map = L.map('map').setView([0.913240, 104.488691], 15);
 L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
     attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
 }).addTo(map);

 var markers = L.markerClusterGroup({ disableClusteringAtZoom: 17 });

  for (var i = 0; i < locations.length; i++) {
   var marker = new L.marker([locations[i][1],locations[i][2]])
    .bindPopup(locations[i][0])
    ;
    markers.addLayer(marker);
  }

  map.addLayer(markers);
