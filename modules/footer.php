<footer class="footer-distributed">
    <div class="footer-right">
        <a href="#" onclick="alert('Kontaktirajte me preko GitHub-a.');"><i class="fa fa-facebook"></i></a>
        <a href="#" onclick="alert('Kontaktirajte me preko GitHub-a.');"><i class="fa fa-twitter"></i></a>
        <a href="#" onclick="alert('Kontaktirajte me preko GitHub-a.');"><i class="fa fa-linkedin"></i></a>
        <a href="https://github.com/dzonint"><i class="fa fa-github"></i></a>
    </div>

    <div class="footer-left">
        <p>Dzonint &copy; 2017</p>
    </div>
		</footer>
</body>
<link rel="stylesheet" type="text/css" href="css/login.css">
<script>
  <?php  
       $URLsThatNeedMargin = array(
        '0' => 'add-category.php', 
        '1' => 'add-event.php',
        '2' => 'categories.php',
        '3' => 'edit-event.php',
        '4' => 'edit-events.php',
        '5' => 'login.php',
        '6' => 'pwrecover.php',
        '7' => 'users.php',   
        );
    
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);
  foreach($URLsThatNeedMargin as $key => $val){
      if(strpos($url, $val) !== false){ ?>
          $(function(){
            $(".footer-distributed").css('margin-top', '155px');
          });
  <?php }
  } ?>  
</script>
</html>