<style>body { background: url("img/beograd.jpg") no-repeat center center scroll; }</style>
<div id="wrap">  
    <div class="container">
       <div class="row">
          <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
             <div class="panel panel-success">
                <div class="panel-body">
                   <div class="row">
                    <?php // We use the same page for password recover and password reset.
                       if(isset($_REQUEST['task']) && $_REQUEST['task'] == 'passwordReset'){ 
                            $confirmnum = $_GET['confirmnum'];
                            $email = $_GET['email'];
                            $sql = "SELECT * FROM users WHERE user_email = '$email'";
                            $result = $conn->query($sql);

                            if (!$row = $result->fetch_assoc()){
                                echo "Nalog sa tom email adresom nije pronađen." . "<br>";
                            } else {
                                $dbcode = $row['user_confirmnum'];
                                if($confirmnum != $dbcode){
                                    echo "GREŠKA : Kod za potvrdu iz linka se ne podudara sa kodom iz baze.";
                                } else {
                       ?>
                        <div class="col-lg-12">
                                 <div class="text-center">
                                    <h2><b>Resetovanje lozinke za <?= $email ?></b></h2>
                                 </div>
                                 <form id="register-form" action="admin/controller.php" method="post" role="form" autocomplete="off">
                                    <div class="form-group">
                                       <label for="password">Unesite novu lozinku</label>
                                       <input type="password" name="password" id="password" tabindex="1" class="form-control" placeholder="Nova lozinka"/>
                                    </div>
                                    <div class="form-group">
                                       <div class="row">
                                          <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                                             <input type="submit" name="reset-submit" id="reset-submit" tabindex="2" class="form-control btn btn-success" value="Podesi lozinku"/>
                                          </div>
                                       </div>
                                    </div>
                                     <input type="hidden" name="email" id="email" value="<?= $email ?>" />
                                    <input type="hidden" name="task" value="passwordReset"/>
                                 </form>
                              </div>
                        <?php }}} else { ?>
                              <div class="col-lg-12">
                                 <div class="text-center">
                                    <h2><b>Oporavak lozinke</b></h2>
                                 </div>
                                 <form id="register-form" action="admin/controller.php" method="post" role="form" autocomplete="off">
                                    <div class="form-group">
                                       <label for="email">Email adresa</label>
                                       <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email adresa" value autocomplete="off" required/>
                                    </div>
                                    <div class="form-group">
                                       <div class="row">
                                          <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                                             <input type="submit" name="recover-submit" id="recover-submit" tabindex="2" class="form-control btn btn-success" value="Pošalji poruku"/>
                                          </div>
                                       </div>
                                    </div>
                                    <input type="hidden" name="task" value="passwordRecover"/>
                                 </form>
                              </div>
                       <?php } ?>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>