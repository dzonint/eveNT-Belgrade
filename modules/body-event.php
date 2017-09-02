<?php 
(isset($_REQUEST['id']) && $_REQUEST['id'] != null) ? $ID = mysqli_real_escape_string($conn, $_REQUEST['id']) : header("Location: index.php");
$eventQuery = "SELECT * FROM events 
               INNER JOIN categories on categories.ID = events.category_id 
               INNER JOIN markers on markers.ID = events.ID
               INNER JOIN events_social on events_social.ID = events.social_id
               WHERE events.ID = $ID";
$result = mysqli_query($conn, $eventQuery);
$row = mysqli_fetch_assoc($result);

// Review information
mysqli_query($conn, "SELECT * FROM reviews WHERE event_ID = $ID");
$review_num = mysqli_affected_rows($conn);
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
mysqli_query($conn, "SELECT * FROM reviews WHERE event_ID = $ID AND user_ID = $user_id");
$user_review = mysqli_affected_rows($conn);

$review_average_query = "SELECT Count(rating) AS NumberOfRatings, ROUND(Avg(rating), 2) AS AverageRating FROM reviews WHERE event_ID = $ID";
$review_avg = mysqli_fetch_assoc(mysqli_query($conn, $review_average_query));
?>
<div class="main">
  <div class="container">
    <div class="content">
       <article class="announcement"  data-post-date="April 18"><div class="sticky">
             <h2><?= $row['event_name'] ?></h2>
       </div>
         <div class="art-text">  
           <p><?= $row['event_desc_short'] ?></p>  
         </div>  
       </article>
    
    <article class="info" data-post-date="April 6">
        <h2 class="sticky">Informacije</h2>
        <div class="art-text">
            <?php if(isset($row['event_price']) && $row['event_price'] != ''){if($row['event_price'] == 0){ ?>
            <p>Cena: <strong>Besplatno</strong></p> <?php }else if($row['event_price'] == -1){ ?> <p>Cena: <strong>TBD</strong></p>
            <?php }else{ ?>
            <p>Cena: <strong><?= $row['event_price'] ?> rsd</strong></p>
            <?php }}else{ ?>
            <p>Cena: <strong>Nije definisana</strong></p>
            <?php } ?>
            <p>Lokacija: <strong><?= $row['event_location'] ?></strong></p>
            <p>Početak: <strong><?= substr($row['event_date'], 11, -3) ?></strong></p> 
            <p>Kategorija: <strong><?= $row['category'] ?></strong></p>
            <?php if(!empty($review_avg['NumberOfRatings'])){ ?>
                <small style="padding-left:30px;">Ocena :</small> 
                        <?php for($i = 1; $i <= 5; $i++){ ?>
                            <small><span class="inline glyphicon glyphicon-star<?= ($review_avg['AverageRating'] < $i) ? "-empty" : '' ?>"></span></small>
                        <?php } ?>
                <strong><?= $review_avg['AverageRating'] ?></strong>  <small> (na osnovu <?=$review_avg['NumberOfRatings']?> recenzija)</small> 
            <?php } ?>
        </div>
    </article>    
        
      <article class="info">
        <h2 class="sticky">O događaju</h2>
        <div class="art-text">
            <div style="padding-left:114px;padding-bottom:20px;max-width:600px;max-height:320px;">
                <img style="" src="<?= $row['event_picture'] ?>"/>
            </div>
            <div class="col-sm-12"> <p><?= $row['event_desc'] ?></p> </div>
          </div>
       </article>
      
        <article class="map">
            <div id="map" style="height:400px; width:100%;"></div>
       </article>
    </div>
        <!-- VIDEO
      <article class="video" data-post-date="April 6"><iframe class="embedded-video" height="315" width="100%" src="//www.youtube.com/embed/GLkbcsNJIv0" frameborder="0" allowfullscreen></iframe>
      <h2 class="sticky">This is a Video Article</h2>
        <div class="art-text">
         <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>  </div>
       </article>
    </div>
    -->
    <aside>
       <!-- Event date. -->
        <?php $date = $row['event_date']; ?>
      <div class="calendar">
        <div class="date-block">
                <div class="date-day"><?= date('D', strtotime($date)) ?></div>
                <div class="date-date"><?= date('j', strtotime($date)) ?></div>
                <span class="date-month"><?= date('F', strtotime($date)) ?></span>,
                <span class="date-year"><?= date('Y', strtotime($date)) ?></span>
        </div>
      </div>
      <hr/>
        <!-- Social media. -->
      <span id="debug"></span>
      <div class="social-buttons" style="text-align:center;">
        <?php if(isset($row['facebook']) && $row['facebook'] != ''){ ?>
            <a href="<?= $row['facebook'] ?>" data-color="#53F"><i class="fa fa-facebook"></i></a>
        <?php }if(isset($row['twitter']) && $row['twitter'] != ''){ ?>
            <a href="<?= $row['twitter'] ?>"><i class="fa fa-twitter"></i></a>
        <?php }if(isset($row['googleplus']) && $row['googleplus'] != ''){ ?>
            <a href="<?= $row['googleplus'] ?>"><i class="fa fa-google-plus"></i></a>
        <?php }if(isset($row['instagram']) && $row['instagram'] != ''){ ?>
            <a href="<?= $row['instagram'] ?>"><i class="fa fa-instagram"></i></a>
        <?php }if(isset($row['youtube']) && $row['youtube'] != ''){ ?>
            <a href="<?= $row['youtube'] ?>"><i class="fa fa-youtube"></i></a>
        <?php }if(isset($row['pinterest']) && $row['pinterest'] != ''){ ?>
            <a href="<?= $row['pinterest'] ?>"><i class="fa fa-pinterest"></i></a>
        <?php } ?>
      </div>
      <hr />
    <?php if(isset($row['twitter']) && $row['twitter'] != ''){ ?>    
      <div class="twitter-feed" style="text-align:center;">
          <a class="twitter-timeline" width="300" height="1200" href="<?= $row['twitter'] ?>" data-link-color="#EE3322" data-chrome="transparent"></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>  
      </div>
     <?php } ?>
    </aside>
  </div>
    <article class="comment" style="text-align:center;">
      <h2 class="sticky">Recenzije i komentari</h2>
        <small><?= $review_num ?> recenzija</small>
        <div class="art-text">
         <div class="well">
            <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && empty($_SESSION['administrator'])){
                    if($user_review ==0){?>
                       <form action="admin/controller.php" method="POST">
                        <input type="hidden" name="task" value="add-review">
                        <input type="hidden" name="event_id" value="<?= $ID ?>">
                          <div class="form-group">
                             <label for="review">
                                Vaša recenzija
                             </label>
                             <textarea class="form-control" rows="3" id="review" name="review" placeholder="Vaša recenzija" required="true"></textarea>
                             <div class="text-left">
                                <br/>
                                Ocena : 
                                <select class="custom-select" id="rating" name="rating" required="true">
                                   <option selected value="1">1</option>
                                   <option value="2">2</option>
                                   <option value="3">3</option>
                                   <option value="4">4</option>
                                   <option value="5">5</option>
                                </select>
                             </div>
                             <div class="text-right">
                                <button type="submit" class="btn btn-success">Ostavite recenziju</button>
                             </div>
                          </div>
                       </form>
                    <?php }else{ ?>
                        <p>Već ste ostavili recenziju za ovaj događaj. <a href="#" onclick='removeReview(<?= $ID.",".$user_id ?>); return false;'>Uklonite trenutnu</a> ukoliko želite da ostavite novu.</p>
                    <?php } ?>
             <?php }else if(!empty($_SESSION['administrator'])){ ?>
                <p>Pregled recenzija.</p>
             <?php }else{ ?>
                <p><a href="login.php">Prijavite se</a> kako biste ostavili recenziju.</p>
             <?php } ?>
           <hr> 
          <?php 
             $reviewquery = "SELECT * FROM reviews INNER JOIN users ON users.ID = reviews.user_ID WHERE event_ID = $ID ORDER BY date ASC";
             $reviewresult = mysqli_query($conn, $reviewquery);
             while($reviewrow = mysqli_fetch_assoc($reviewresult)){ $uID = $reviewrow['user_ID'];
          ?>
            <div class="row">
                <div class="col-md-12">
                    <span class="pull-left"><strong><?= $reviewrow['user_name'] ?></strong><?= ($reviewrow['user_banned'] != 0)? '<strong> - <small style="color:red">Banned</small></strong>': ''?> -
                        <?php for($i = 1; $i <= 5; $i++){ ?>
                            <span class="glyphicon glyphicon-star<?= ($reviewrow['rating'] < $i) ? "-empty" : '' ?>"></span>
                        <?php } ?> 
                    </span>    
                    <span class="pull-right"><?= substr($reviewrow['date'], 0, -3) ?></span>
                    <p><?= $reviewrow['comment'] ?></p>
                </div>
                <div class="pull-right" id="adminControl">
                    <?= !empty($_SESSION['administrator']) ? "<a href=\"#\" onclick='removeReview($ID,$uID); return false;' class=\"btn btn-xs btn-danger\">Ukloni recenziju</a>" : ''?>
                    <?= !empty($_SESSION['administrator']) ? ($reviewrow['user_banned'] != 1) ? "<a href=\"#\" onclick='banUser($uID); return false;' class=\"btn btn-xs btn-danger\">Banuj korisnika</a>" : "<a href=\"#\" onclick='unbanUser($uID); return false;' class=\"btn btn-xs btn-success\">Unbanuj korisnika</a>" : ''?>
                </div>
            </div>
            <hr>
          <?php } ?>
         </div>
        </div>
       </article>
</div>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=---YOUR API KEY HERE---&callback=initMap">
   </script>
<script>
function initMap() {
  var marker = {lat: <?= $row['lat'] ?>, lng: <?= $row['lng'] ?>};
       var map = new google.maps.Map(document.getElementById('map'), {
            center: marker,
            zoom: 14,
            mapTypeId: 'roadmap',
            mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
          });
  var marker = new google.maps.Marker({
    position: marker,
    map: map
  });
}
    
<?php if(!empty($_SESSION['logged_in'])){ ?>
    function removeReview(ID,user_id) { 
             if (window.confirm('Potvrdite brisanje recenzije.'))
                   window.location.href = 'admin/controller.php?task=remove-review&event_id='+ID+'&user_id='+user_id;
        }
<?php } if(!empty($_SESSION['administrator'])){ ?>
    function banUser(user_id) { 
             if (window.confirm('Potvrdite ban korisnika.'))
                   window.location.href = 'admin/controller.php?task=ban-user&id='+user_id;
        }
    
    function unbanUser(user_id) { 
                   window.location.href = 'admin/controller.php?task=unban-user&id='+user_id;
        }
<?php } ?>
</script>


  <link rel="stylesheet" type="text/css" href="css/event-body.css">  