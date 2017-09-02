<style>body { background: url("img/beograd.jpg") no-repeat center center scroll; }</style>
<div id="wrap">  
    <div class="container">
       <div class="row">
          <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
             <div class="panel panel-success">
                <div class="panel-body">
                   <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h2><b>Dodaj kategoriju</b></h2>
                            </div>
                                <form id="register-form" action="admin/controller.php" method="post" role="form" autocomplete="off">
                                    <div class="form-group">
                                       <label for="category">Naziv</label>
                                       <input type="text" name="category" id="category" tabindex="1" class="form-control" placeholder="Unesite naziv kategorije" required/>
                                    </div>
                                    <div class="form-group">
                                       <div class="row">
                                          <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                                             <input type="submit" id="category-submit" tabindex="2" class="form-control btn btn-success" value="Dodaj kategoriju"/>
                                          </div>
                                       </div>
                                        <a class="pull-right" href="categories.php">Otkaži</a>
                                    </div>
                                    <input type="hidden" name="task" value="add-category"/>
                                </form>
                        </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>
