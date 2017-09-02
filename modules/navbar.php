<?php
function active($current_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);  
  if($current_page == $url)
      echo 'active'; //class name in css 
}
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">eveNT - Belgrade</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="<?php active('events.php');?>"><a href="events.php">Događaji</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
     <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
                if(isset($_SESSION['administrator']) && $_SESSION['administrator'] == true){?>
                 <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-tasks"></span> Admin </a>
                    <ul class="dropdown-menu">
                      <li><a href="add-event.php">Dodaj događaj</a></li>
                        <hr>
                      <li><a href="edit-events.php">Događaji</a></li>
                      <li><a href="users.php">Korisnici</a></li>
                      <li><a href="categories.php">Kategorije</a></li>
                    </ul>
                  </li>
                <?php } ?>
              <li><a href="admin/controller.php?task=logout"><span class="glyphicon glyphicon-log-out"></span> Odjava</a></li>
        <?php } else { ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> <b>Prijava</b></a>
			<ul id="login-dp" class="dropdown-menu">
				<li>
					 <div class="row">
							<div class="col-md-12">
								 <form class="form" role="form" method="post" action="admin/controller.php" accept-charset="UTF-8" id="login-nav">
										<div class="form-group">
											 <input type="text" class="form-control" name="username" id="username" placeholder="Korisničko ime" required>
										</div>
										<div class="form-group">
											 <input type="password" class="form-control" name="password" id="password" placeholder="Lozinka" required>
                                             <div class="help-block text-right"><a href="pwrecover.php">Zaboravili ste lozinku ?</a></div>
										</div>
										<div class="form-group">
											 <button type="submit" class="btn btn-primary btn-block">Prijava</button>
										</div>
                                     <input type="hidden" name="task" value="login">
								 </form>
							</div>
							<div class="bottom text-center">
								Novi član? <a href="login.php"><b>Registrujte se.</b></a>
							</div>
					 </div>
				</li>
			</ul>
        </li>
        <?php } ?>
    </ul>
  </div>
</nav>

<style>
</style>