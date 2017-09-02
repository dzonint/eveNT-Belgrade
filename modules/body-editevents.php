<div id="wrap">
    <div class="container"><h2><strong>Događaji</strong></h2><hr>
        <table id="events" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Lokacija</th>
                    <th>Datum</th>
                    <th>Cena</th>
                    <th style="text-align:center;">Akcija</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $result = mysqli_query($conn, "SELECT * FROM events");
                while($row = mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <!--
                    <td < ?php if($row['istaknut'] == 1) echo "style=\"color:green;\"";?>>
                        <a href="proizvod.php?id=< ?php echo $row['id']; ?>">< ?php echo $row['name']; ?></a>
                        < ?php if($row['istaknut'] == 1) echo "<h6><strong>Istaknut!</strong></h6>"; ?>
                    </td>
                    -->
                    <td><a href="event.php?id=<?= $row['ID'] ?>"><?= $row['event_name'] ?></a></td>
                    <td><?= $row['event_location'] ?></td>
                    <td><?= substr($row['event_date'], 0, -3) ?></td>
                    <td><?= $row['event_price'] ?> rsd</td>
                    <td class="col-lg-4" align="center">
                    <!-- < ?php if($row['istaknut'] == 0){ ?>
                    <a href="admin/highlightproduct.php?id=< ?php echo $row['id']; ?>" class="btn btn-success" role="button">Istakni</a>
                    < ?php }else{ ?>
                    <a href="admin/unhighlightproduct.php?id=< ?php echo $row['id']; ?>" class="btn btn-warning" role="button">Skini</a>  
                    < ?php } ?> -->
                        <a href="edit-event.php?id=<?= $row['ID'] ?>" class="btn btn-primary" role="button">Izmeni</a>
                    <a onclick="removeEvent(<?=$row['ID']?>); return false;" class="btn btn-danger" role="button">Ukloni</a>    
                    </td> 
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <hr>
        <a href="add-event.php" class="btn btn-primary pull-right" role="button">Dodaj novi događaj</a>
    </div>
</div>
    
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script> 
        $(document).ready(function(){
            $('#events').DataTable({
                "oLanguage": {
                    "sLengthMenu": "Prikaz _MENU_ redova",
                    "sSearch": "Pretraga: ",
                    "sInfo": "Prikaz _START_ - _END_ od _TOTAL_ rezultata",
                    "sInfoEmpty": "Nema rezultata.",
                    "sInfoFiltered": " (filtrirano iz _MAX_ redova)",
                    "sZeroRecords": "Nema rezultata.",
                }
            });
        });
        
        function removeEvent(ID) { 
             if (window.confirm('Potvrdite brisanje događaja.'))
                   window.location.href = 'admin/controller.php?task=remove-event&id='+ID;
        }
    </script>