
<!-- Title. -->
<div class="row-fluid top30 pagetitle">
  <div class="container">
    <div class="row">
      <div class="col-md-12"><h1>Događaji</h1></div>
    </div>
  </div>
</div>


<div class="container">
  <div class="row">
<!-- START OF COL-MD-3 - THE LEFT SIDE. -->
    <!-- Search. -->
    <div class="col-md-3"> 
      <h4 class="">Pretraga</h4>
        <form action="events.php" method="POST" id="search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Unesite termin za pretragu" name="srch-term" id="srch-term">
                    <div class="input-group-btn">
                      <button class="btn btn-default" onclick="search(); return false;"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
            </div>
                <small><input type="checkbox" id="upcoming-events-checkbox"> Samo predstojeći događaji<br></small>
        </form>

      
<!-- Categories. -->          
      <div id="demo" class="collapse in">
        <hr>
        <div class="list-group list-group">
          <h4 class="">Kategorija</h4>
        <?php 
            $query = "SELECT categories.ID, categories.category, COUNT(*) AS TOTAL FROM events INNER JOIN categories ON categories.id = events.category_id WHERE events.event_date > NOW() GROUP BY categories.ID ORDER BY categories.ID ASC";
            $row_num = 0;
            $result = mysqli_query($conn, $query); 
            while($row = mysqli_fetch_assoc($result)) { ?>
            <?= ($row_num == 5) ? '<div id="categories" class="collapse">' : '' ?>
            <a href="?cat_id=<?= $row['ID'] ?>" class="list-group-item"><span class="badge"><?= $row['TOTAL'] ?></span> <?= $row['category'] ?></a>
        <?php $row_num++;} ?>
           <?= ($row_num > 4) ? '</div><button class="btn btn-default btn-sm btn-block" data-toggle="collapse" data-target="#categories">Više <span class="caret"></span></button>' : '' ?>
            
          <hr class="">
          <h4 class="">Pregled</h4>
          <a href="?near-future-events" class="list-group-item"><span class="badge" id="near-future-events"></span> Događaji u skorijoj budućnosti</a>
          <a href="?upcoming-events" class="list-group-item"><span class="badge" id="upcoming-events"></span> Predstojeći događaji</a>
          <hr>	
          <a href="?archived-events" class="list-group-item"><span class="badge" id="archived-events"></span>Arhivirani događaji</a>
          <a href="?all-events" class="list-group-item"><span class="badge" id="all-events"></span>Svi događaji</a>    
        </div>
      </div>
      
      
<!-- Premium membership ads. -->      
      <div class="hidden-sm hidden-xs">
        <hr>
        <div class="well">
          <h4>Premium članstvo</h4>
          <p>Obezbedite sebi garantovane karte i popuste na objavljenje događaje.</p>
          <hr>
          <p class="text-center ">Već ste član? <a href="login.php">Prijavite se.</a></p>
        </div>
        <hr>
        <div class="well">
          <h4>Ne vidite Vaš događaj?</h4>
          <p>Kontaktirajte nas ukoliko želite da prijavite Vaš događaj ili reklamu na našem sajtu.</p>
          <a class="btn btn-sm btn-block btn-warning" href='mailto:event-belgrade@gmail.com'>Kontakt</a>
        </div>
        <hr>
        <h4 class="text-center">Mapa događaja</h4>
      </div>
    </div>
      
<!-- END OF COL-MD-3 - THE LEFT SIDE. -->
      
<!-- START OF COL-MD-9 - THE CONTENT. -->
    <div class="col-md-9">
      
      <!-- Grey area with sorting and number of results per page. -->
      <div class="well hidden-xs"> 
        <div class="row">
            <div class="col-xs-8">
                <?= (!empty($_REQUEST['srch-term'])) ? "<p> Rezultati pretrage za termin '<strong>".$_REQUEST['srch-term'] . "</strong>'</p>" : '' ?>
            </div>
            <div class="col-xs-4">
                <select class="form-control" onchange="sort(this.value)">
                  <option value="" disabled selected>Sortiraj po</option>
                  <option value="event_price ASC" <?= (!empty($_REQUEST['sort']) && $_REQUEST['sort'] == 'event_price ASC') ? "selected" : '' ?>>Ceni rastuće</option>
                  <option value="event_price DESC" <?= (!empty($_REQUEST['sort']) && $_REQUEST['sort'] == 'event_price DESC') ? "selected" : '' ?>>Ceni opadajuće</option>
                  <option value="event_date ASC" <?= (!empty($_REQUEST['sort']) && $_REQUEST['sort'] == 'event_date ASC') ? "selected" : '' ?>>Datumu početka rastuće</option>
                  <option value="event_date DESC" <?= (!empty($_REQUEST['sort']) && $_REQUEST['sort'] == 'event_date DESC') ? "selected" : '' ?>>Datumu početka opadajuće</option>    
                </select>
            </div>
        </div>
      </div>
      <hr>
       <div class="col-xs-6">
            <small style="margin: auto;text-align:left;" id="prikaz"></small>    
       </div>
        <br>
     
      <?php
        // NOTABLE BUG : When sorting on any other than the first page, the query sets itself to base query, so only do sorting commands on the first pages.
        // Base query with category.
        $query = "SELECT events.*, categories.id AS cat_id, categories.category  
                  FROM events INNER JOIN categories ON categories.id = events.category_id";
        // We shall use $qcheck for comparing the query for > NOW() section, the $query is the one that gets modified based on requests.    
        $qcheck = $query;    
        // Query if we used sort() function. Making sure there is no SQL injection with any commands other than SELECT.    
        (!empty($_REQUEST['query']) && strpos(strtolower($_REQUEST['query']), 'delete') !== true && strpos(strtolower($_REQUEST['query']), 'update') !== true && strpos(strtolower($_REQUEST['query']), 'insert') !== true) ? $query = $_REQUEST['query'] : $a = 1;
        // If we entered some search term.                  
        (!empty($_REQUEST['srch-term'])) ? $query .= " WHERE events.event_name LIKE '%".mysqli_real_escape_string($conn, $_REQUEST['srch-term'])."%'" : $a = 1;    
        // If we selected category from sidebar.                  
        (!empty($_REQUEST['cat_id'])) ? $query .= " WHERE events.category_id = " . mysqli_real_escape_string($conn, $_REQUEST['cat_id']) : $a = 1;
        $qcheckcat = $query; // Query after category usage - also used for comparsion for > NOW() section.    
        // If we selected events in the near future from sidebar.
        (isset($_REQUEST['near-future-events'])) ? $query .= " WHERE events.event_date BETWEEN NOW() AND (NOW() + INTERVAL 2 WEEK) " : $a = 1;
        // If we selected upcoming events from sidebar (or we checked 'Upcoming events only' on search form).
        (isset($_REQUEST['upcoming-events'])) ? $query .= " HAVING events.event_date > NOW()" : $a = 1;    
        // If we selected archived events from sidebar.
        (isset($_REQUEST['archived-events'])) ? $query .= " HAVING events.event_date < NOW()" : $a = 1;
        // We use $query_base for sort function; we insert query up until now into a hidden form which will be submitted if sort() function gets used. This way we carry over query to other pages.    
        $query_base = $query; 
        // If we selected some sorting option from dropdown menu.    
        (isset($_REQUEST['sort'])) ? $query.= " ORDER BY $_REQUEST[sort]" : $query.= " ORDER BY events.event_date DESC";
        // Saving query all up until pagination in $_SESSION. This is due to next pages completely losing query data.    
        (isset($_GET['page']) || isset($_GET['sort']) || isset($_GET['srch-term'])) ? $query = $_SESSION['query'] :  $_SESSION['query'] = $query; 
        // * * * Pagination * * *        
        $resultrowcount = mysqli_num_rows(mysqli_query($conn, $query)); 
        $page = (isset($_GET['page'])) ? $_GET['page'] : 1; // Uzimanje vrednosti $page da bismo znali na kojoj smo strani.
        $itemsperpage = 4;                                  // Ovde definišemo koliko proizvoda želimo po strani da vidimo.
        if(!isset($page) || empty($page) || $page == "1")
            $page1 = 0;
        else 
            $page1 = ($page*$itemsperpage)-$itemsperpage;   // Primer : $page = 2 => 20-10 => Počinje od 10. n-torke.
        $query .= " LIMIT $page1,$itemsperpage";            // Prvi broj odakle počinje iz baze (n-torka), drugi broj koliko mesta od prvog broja na dalje.
        $result = mysqli_query($conn, $query);              // * * * Execution of query * * *
        $pagination = ceil($resultrowcount/$itemsperpage); // Ceil zaokružuje na gore. Svaki deo rezultata sadrži $itemsperpage n-torki.
        // * * * End of pagination * * *
        while($row = mysqli_fetch_assoc($result)){ 
            $review_average_query = "SELECT Count(rating) AS NumberOfRatings, ROUND(Avg(rating), 2) AS AverageRating FROM reviews WHERE event_ID = $row[ID]";
            $review_avg = mysqli_fetch_assoc(mysqli_query($conn, $review_average_query));
      ?>
      <div class="row">
        <div class="col-sm-4"><a href="#" class=""><img src="<?= $row['event_picture'] ?>" class="img-responsive" style="padding-top:22px;"></a>
        </div>
        <div class="col-sm-8">
          <h3 class="title"><a href="event.php?id=<?= $row['ID'] ?>"><?= $row['event_name'] ?></a></h3>
            <?php $price = (!empty($row['event_price'])) ? $row['event_price'].' rsd' : " Besplatno!";  ?>
            <?php $price = ($price >= 0) ? $price : " TBD" ?>
          <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> <?= substr($row['event_date'], 0, -3) .' - <strong>'. $price .'</strong>'?> 
            <?php if(!empty($review_avg['NumberOfRatings'])){ ?>
                <small style="padding-left:30px;">Ocena :</small> 
                        <?php for($i = 1; $i <= 5; $i++){ ?>
                            <small><span class="inline glyphicon glyphicon-star<?= ($review_avg['AverageRating'] < $i) ? "-empty" : '' ?>"></span></small>
                        <?php } ?>
                <strong><?= $review_avg['AverageRating'] ?></strong>  <small> (na osnovu <?=$review_avg['NumberOfRatings']?> recenzija)</small> 
            <?php } ?>  
          </p>
            
          <p><?= $row['event_desc_short'] ?></p>
          
          <p class="text-muted">Kategorija : <a href="?cat_id=<?= $row['category_id'] ?>"><?= $row['category'] ?></a></p>
          
        </div>
      </div>
      <hr>
    <?php } ?>
          
      <ul class="pagination pagination-lg pull-right">
        <?php for($i=1;$i<=$pagination;$i++){ ?>
            <li><a href="events.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>

<form class="hidden" action="events.php" method="POST" id="form-sort">
    <input type="hidden" id="query" name="query" value="<?= $query_base ?>">
    <input type="hidden" id="sort" name="sort">
</form>

<script>
    $(function(){ 
        <?php if(!empty($resultrowcount) && $resultrowcount >3){ ?>
            $("#prikaz").html('Prikaz <?= $page1+1 ?> - <?= $page1+$itemsperpage ?> od <?= $resultrowcount ?>');
        <?php } ?>
        <?php 
            $near_future_evn_num = mysqli_num_rows(mysqli_query($conn, "SELECT events.ID FROM events WHERE events.event_date BETWEEN NOW() AND (NOW() + INTERVAL 2 WEEK)"));
            $upcoming_evn_num = mysqli_num_rows(mysqli_query($conn, "SELECT events.ID FROM events WHERE events.event_date > NOW()"));
            $archived_evn_num = mysqli_num_rows(mysqli_query($conn, "SELECT events.ID FROM events WHERE events.event_date < NOW()"));
            $all_evn_num = mysqli_num_rows(mysqli_query($conn, "SELECT events.ID FROM events"));
            $review_average_query = "SELECT Count(rating) AS NumberOfRatings, ROUND(Avg(rating), 2) AS AverageRating FROM reviews WHERE event_ID = $row[ID]";
        ?>
            $("#near-future-events").html('<?= $near_future_evn_num ?>');
            $("#upcoming-events").html('<?= $upcoming_evn_num ?>');
            $("#archived-events").html('<?= $archived_evn_num ?>');
            $("#all-events").html('<?= $all_evn_num ?>');
    });
    
    function sort(val){
        $("#sort").attr('value', val);
        $("#form-sort").submit();
    }
    
    function search(val){
        if ($("#upcoming-events-checkbox").prop('checked'))
            $("#search").attr('action', 'events.php?upcoming-events');
        $("#search").submit();
    }
</script>

     <!-- Google map div. -->
<div class="map-container" >
    <div class="container" id="map" onload="initMap()"></div>
</div>  