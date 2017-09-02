<div id="wrap">
    <div class="container"><h2><strong>Kategorije</strong></h2><hr>
        <table id="categories" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th style="text-align:center;">Akcija</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $result = mysqli_query($conn, "SELECT * FROM categories");
                while($row = mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <td><a href="#"><?= $row['category'] ?></a></td>
                    <td class="col-lg-4" align="center">
                    <a onclick="removeCategory(<?=$row['ID']?>); return false;" class="btn btn-danger" role="button">Ukloni</a> 
                    </td> 
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <hr>
        <a href="add-category.php" class="btn btn-primary pull-right" role="button">Dodaj novu kategoriju</a>
    </div>
</div>
    
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script> 
        $(document).ready(function(){
            $('#categories').DataTable({
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
        
        function removeCategory(ID) { 
             if (window.confirm('Potvrdite brisanje kategorije.'))
                   window.location.href = 'admin/controller.php?task=remove-category&id='+ID;
        }
    </script>