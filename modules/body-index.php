<?php $evn_num = mysqli_num_rows(mysqli_query($conn, "SELECT events.ID FROM events")); ?>
    <!-- Header -->
    <header class="header" id="top" style="font-family: 'Source Sans Pro';">
      <div class="text-vertical-center">
        <h1>eveNT Belgrade</h1>
        <h3>Besplatni lokator kulturnih dešavanja u gradu</h3>
        <br>
        <a href="" class="btn btn-dark btn-lg about-scroll" data-target="about">Saznaj više</a>
      </div>
    </header>
    <!-- About -->
    <section id="about" class="about" style="font-family: 'Source Sans Pro';">
      <div class="container text-center">
        <h2>eveNT Belgrade je portal namenjen stanovnicima i posetiocima Beograda kojima omogućava pregled aktuelnih događanja iz svih oblasti!</h2>
        <p class="lead">Od kulture, preko obrazovanja i zabave do rekreacije za koje je ulaz
          <a>slobodan</a>.</p>
      </div>
      <!-- /.container -->
    </section>

    <!-- Call to Action -->
    <aside class="call-to-action bg-primary text-white" style="font-family: 'Source Sans Pro';">
      <div class="container text-center">
        <h3>Za sada ovaj portal pokriva više od <?= $evn_num-1 ?> događaja u gradu.</h3>
        <a href="events.php?upcoming-events" class="btn btn-lg btn-light">Vidi događaje</a>
        <a href="login.php" class="btn btn-lg btn-dark">Registruj se</a>
      </div>
    </aside>
    <!-- Map -->
    <section id="map" onload="initMap()">
    </section>
<script>
    $("head").append('<link rel="stylesheet" type="text/css" href="css/stylish-portfolio.css">');
    
    $(function(){
        $(document).on('click','.about-scroll', function(event) {
            event.preventDefault();
            var target = "#" + this.getAttribute('data-target');
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 2000);
        });        
    });
</script>