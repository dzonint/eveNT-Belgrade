<div id="wrap">
    <div class="container"><h2><strong>Korisnici</strong></h2><hr>
        <table id="users" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Korisničko ime</th>
                    <th>E-mail adresa</th>
                    <th>Datum registrovanja</th>
                    <th style="text-align:center;">Akcija</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $result = mysqli_query($conn, "SELECT * FROM users");
                while($row = mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <td><a href="#"><?= $row['user_name'] ?></a><?= ($row['user_banned'] != 0) ? "<br><small style=\"color:red\"><strong>Banned</strong></small>" : ""?></td>
                    <td><?= $row['user_email'] ?></td>
                    <td><?= substr($row['user_date'], 0, -3) ?></td>
                    <td class="col-lg-4" align="center">
                    <?php if($row['user_banned'] != 1){ ?>
                    <a onclick="banUser(<?=$row['ID']?>); return false;" class="btn btn-danger" role="button">Ban</a> 
                    <?php } else { ?>
                    <a onclick="unbanUser(<?=$row['ID']?>); return false;" class="btn btn-success" role="button">Unban</a>  
                    <?php } ?>    
                    <a onclick="removeUser(<?=$row['ID']?>); return false;" class="btn btn-default" role="button">Obriši nalog</a> 
                    </td> 
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
    
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script> 
        $(document).ready(function(){
            $('#users').DataTable({
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
        
        function banUser(ID) { 
            window.location.href = 'admin/controller.php?task=ban-user&id='+ID;
        }
        
        function unbanUser(ID) { 
            window.location.href = 'admin/controller.php?task=unban-user&id='+ID;
        }
        
        function removeUser(ID) { 
             if (window.confirm('Potvrdite brisanje naloga.'))
                   window.location.href = 'admin/controller.php?task=remove-user&id='+ID;
        }
    </script>