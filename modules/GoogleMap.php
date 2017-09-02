  <style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    .map, #map {
      height: 80%;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body, .map-container {
      height: 80%;
      padding-bottom: 10px;
    }
 </style>

    <script>
      var map;
        
        function initMap() {
          var Belgrade = {lat: 44.8027357, lng: 20.4657129};
          map = new google.maps.Map(document.getElementById('map'), {
            center: Belgrade,
            zoom: 13,
            mapTypeId: 'roadmap',
            mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
          });
        
        var infowindow = new google.maps.InfoWindow();    
            
        <?php 
            $q = "SELECT * FROM markers INNER JOIN events ON events.ID = markers.event_id";
            (isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'] != '') ? $q .= " WHERE events.category_id = " . mysqli_real_escape_string($conn, $_REQUEST['cat_id']) : $a = 1;
            (!empty($_REQUEST['srch-term'])) ? $q .= " WHERE events.event_name LIKE '%".mysqli_real_escape_string($conn, $_REQUEST['srch-term'])."%'" : $a = 1;
            (isset($_REQUEST['near-future-events'])) ? $q.= " WHERE events.event_date BETWEEN NOW() AND (NOW() + INTERVAL 2 WEEK) " : $a = 1;
            (isset($_REQUEST['archived-events'])) ? $q .= " HAVING events.event_date < NOW()" : $a = 1;
            // Either on index.php or upcoming events from event page.
            (isset($_REQUEST['upcoming-events'])) ? $q .= " HAVING events.event_date > NOW()" : $a = 1; 
            (isset($_GET['page']) || isset($_REQUEST['sort'])) ? $q = $_SESSION['q'] : $_SESSION['q'] = $q;
            $res = mysqli_query($conn, $q);
            $i = 0;
            while($row = mysqli_fetch_assoc($res)){ ?>
            
        var contentString<?=$i?> = '<div id="content">'+
            '<div id="siteNotice"><small><?= substr($row['event_date'], 0, -3) ?></small>'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading"><?= $row['event_name'] ?></h1>'+
            '<div id="bodyContent">'+
            '<p><?= $row['event_desc_short'] ?></p>'+
            '<p>Više o događaju <a href="event.php?id=<?= $row['event_id']?>">OVDE</a>. </p>'+
            '</div>'+
            '</div>'; 
        
        var marker<?=$i?> = new google.maps.Marker({
            position: {lat: <?= $row['lat'] ?>, lng: <?= $row['lng'] ?>},
            map: map,
            title: '<?= $row['event_name'] ?>'
            <?php if(isset($row['icon_url']) && $row['icon_url'] != ''){ ?>
                    ,icon: '<?= $row['icon_url']?>' <?php } ?>
          });

        marker<?=$i?>.addListener('click', function() {
          infowindow.setContent(contentString<?=$i?>);
          infowindow.open(map, marker<?=$i?>);
        });
        
        <?php $i++; } ?> 
       
        }
  </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=--- YOUR API KEY HERE ---&callback=initMap">
    </script>
