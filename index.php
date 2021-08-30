<?php
//including the database connection file
include_once("Database.php");

$d = new Database();
$result = $d->retrieve("SELECT * FROM d_2000 ORDER BY id DESC limit 10");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">	
        <title>OFFICE NOTARIAL DE BUJUMBURA</title>

        <!-- Fonts -->
        <link rel="stylesheet" type="text/css" href="fontawesome-free-5.15.3-web/css/all.css">

        <!-- Bootsrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <!-- Custom stylesheet -->
        <link rel="stylesheet" href="style.css">

        <!-- Javascript -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container text-center">
            <h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-swatchbook"></i>OFFICE NOTARIAL DE BUJUMBURA</h1>
            <div class="d-flex justify-content-center">
                <div class="w-50"><a href="add.html" class="btn btn-success">ENREGISTRER DOSSIER</a></div>
                <div class="w-50"><a href="search.php" class="btn btn-primary">RECHERCHER DOSSIER</a></div>
            </div><br><br>
        </div>
        <div class="d-flex table-data">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">NUM_ORDRE</th>
                        <th>DATE ACTE</th>
                        <th>NATURE ACTE</th>
                        <th>NOM & PRENOM COMPARANT(S)</th>
                        <th>MOFIFIER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
                    while ($res = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td style=\"color:red;\" class=\"text-center\">" . $res['no_dossier'] ."</td>";
                        echo "<td style=\"width:100px;\">" . $res['date_acte'] . "</td>";
                        echo "<td>" . $res['nature_acte'] . "</td>";
                        echo "<td>" . $res['nom_prenom'] . "</td>";
                        echo "<td class=\"text-center\"><a href=\"edit.php?id=$res[id]\"><i class=\"fas fa-edit btnedit\"></i></a> "
                                . "| <a href=\"show.php?id=$res[id]\"><i class=\"fas fa-eye btnedit\"></i></a>"
                                . "| <a href=\"delete.php?id=$res[id]\"><i class=\"fas fa-trash btnedit\"></i></a></td> ";
                            
                        echo "</tr>";
                    }
               
                    ?>  
                </tbody> 
            </table>
        </div>

    </body>
</html>
