<style>body { background: url("img/beograd.jpg") no-repeat center center scroll; }</style>
<div id="wrap">  
    <div class="container">            
        <div id="signupbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Dodaj događaj</div>
                </div>  
                <div class="panel-body" >
                    <form method="post" action="admin/controller.php" enctype="multipart/form-data">
                        <input type='hidden' name='task' value='add-event' />

                        <!-- Table 'events' (and 'categories') -->
                        <button type="button" class="btn btn-info btn-block" style="text-align:left;" data-toggle="collapse" data-target="#events">
                         <h2 style="margin-bottom:20px;margin-top:0"><strong>Osnovni podaci</strong></h2></button>
                          <div id="events" class="collapse panel panel-default" style="padding:20px;">
                                <div class="form-group">
                                  <label for="event_name" class="col-md-4">Naziv *</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="event_name" name="event_name" maxlength="50" placeholder="Unesite naziv događaja" style="margin-bottom: 10px" required>
                                    </div>    
                                </div>

                                <div class="form-group">
                                  <label for="event_price" class="col-md-4">Cena *</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" id="event_price" name="event_price" maxlength="11" placeholder="Unesite cenu (rsd), 0 ako je besplatno, -1 TBD" style="margin-bottom: 10px" required>
                                    </div>    
                                </div>

                                <div class="form-group">
                                  <label for="event_name" class="col-md-4">Lokacija *</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="event_location" name="event_location" maxlength="50" placeholder="Unesite lokaciju događaja" style="margin-bottom: 10px" required>
                                    </div>    
                                </div>


                                <div class="form-group">
                                  <label for="event_date" class="col-md-4">Datum *</label>
                                    <div class="col-md-8">
                                        <input type="datetime-local" class="form-control" id="event_date" name="event_date" style="margin-bottom: 10px" required>
                                    </div>    
                                </div>

                                <div class="form-group">
                                    <label for="event_picture" class="col-md-4">Slika *</label>
                                    <div class="col-md-8">
                                        <input type="file" class="custom-file-input" id="event_picture" name="event_picture" accept="image/*" required="true" style="margin-bottom: 15px"/><span class="custom-file-control"></span>
                                    </div>
                                </div> 

                                <div class="form-group">  
                                    <label for="category_id" class="col-md-4">Kategorija *</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="category_id" name="category_id" required="true" style="margin-bottom: 15px;">
                                            <option disabled selected>Odaberite kategoriju...</option>
                                            <?php 
                                                $result = mysqli_query($conn,"SELECT * FROM categories");
                                                while($catrow = mysqli_fetch_assoc($result)) { ?> 
                                              <option value="<?php echo $catrow['ID']; ?>"><?php echo $catrow['category']; ?></option>
                                           <?php } ?>
                                        </select>
                                    </div>
                                 </div>

                                <div class="form-group">
                                  <label for="event_desc_short">Kratak opis *</label>
                                        <textarea rows="2" class="form-control" id="event_desc_short" name="event_desc_short" placeholder="Unesite kratak opis događaja" style="margin-bottom: 10px" required></textarea>
                                </div>

                                <div class="form-group">
                                  <label for="event_desc">Detaljan opis *</label>
                                        <textarea rows="5" class="form-control" id="event_desc" name="event_desc" placeholder="Unesite opis događaja" style="margin-bottom: 10px" required></textarea>
                                </div>
                        </div>

                        <!-- Table 'social' -->
                        <br>
                        <button type="button" class="btn btn-info btn-block" style="text-align:left" data-toggle="collapse" data-target="#events_social">
                         <h2 style="margin-bottom:20px;margin-top:0"><strong>Online prisustvo</strong></h2></button>
                          <div id="events_social" class="collapse panel panel-default" style="padding:20px;">
                                <div class="form-group">
                                  <label for="facebook" class="col-md-4">Facebook</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="facebook" name="facebook" placeholder="e.g. https://www.facebook.com/facebook" style="margin-bottom: 10px">
                                    </div>    
                                </div>

                                <div class="form-group">
                                  <label for="twitter" class="col-md-4">Twitter</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="twitter" name="twitter" placeholder="e.g. https://twitter.com/twitter" style="margin-bottom: 10px">
                                    </div>    
                                </div>

                                <div class="form-group">
                                  <label for="googleplus" class="col-md-4">Google+</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="googleplus" name="googleplus" placeholder="e.g. https://plus.google.com/communities/115758385206378551362" style="margin-bottom: 10px">
                                    </div>    
                                </div>

                                <div class="form-group">
                                  <label for="instagram" class="col-md-4">Instagram</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="e.g. https://www.instagram.com/instagram" style="margin-bottom: 10px">
                                    </div>    
                                </div>

                                <div class="form-group">
                                  <label for="youtube" class="col-md-4">Youtube</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="youtube" name="youtube" placeholder="e.g. https://www.youtube.com/user/YouTube" style="margin-bottom: 10px">
                                    </div>    
                                </div>

                                <div class="form-group">
                                  <label for="pinterest" class="col-md-4">Pinterest</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="pinterest" name="pinterest" placeholder="e.g. https://www.pinterest.com/pinterest" style="margin-bottom: 10px">
                                    </div>    
                                </div>
                              <small style="color:grey;font-size:8pt;">* Linkovi moraju počinjati sa https://</small>
                          </div>
                        
                        <!-- Table 'markers' -->
                        <br>
                        <button type="button" class="btn btn-info btn-block" style="text-align:left" data-toggle="collapse" data-target="#markers">
                         <h2 style="margin-bottom:20px;margin-top:0"><strong>Google maps</strong></h2></button>
                          <div id="markers" class="collapse panel panel-default" style="padding:20px;">
                                <div class="form-group">
                                  <label for="lat" class="col-md-4">Latitude *</label>
                                    <div class="col-md-8">
                                        <input type="number" step="any" class="form-control" id="lat" name="lat" placeholder="e.g. 43.235431" style="margin-bottom: 10px" required>
                                    </div>  
                                </div>
                              
                                <div class="form-group">
                                  <label for="lng" class="col-md-4">Longitude *</label>
                                    <div class="col-md-8">
                                        <input type="number" step="any" class="form-control" id="lng" name="lng" placeholder="e.g. -23.165442" style="margin-bottom: 10px" required>
                                    </div>  
                                </div>
                              
                              <small> Ove mere možete naći na stranici <a href="https://goo.gl/NtYkAE">Google Maps</a>. <span style="font-size:8.5pt;">(desni klik na lokaciju > What's here?)</span> </small>
                                
                                <div class="form-group" style="padding-top:20px;">
                                  <label for="icon_url" class="col-md-4">Icon URL</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="icon_url" name="icon_url" placeholder="e.g. http://maps.google[...]/red-dot.png" style="margin-bottom: 10px">
                                    </div>  
                                  <small>Spisak ikonica možete naći <a href="https://goo.gl/73Vc8Z">ovde</a>.</small>
                                </div>
                          </div>
                        
                          <hr>
                          <div style="text-align:right;">
                              <button type="submit" class="btn btn-success">Dodaj događaj</button>
                              <a href="edit-events.php" class="btn btn-danger" role="button">Otkaži dodavanje</a>
                          </div>
                        </form>

                </div>
            </div>
        </div> 
    </div>
</div>