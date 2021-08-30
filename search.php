<?php
//including the database connection file
include_once("Database.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
//$result = mysqli_query($mysqli, "SELECT * FROM d_2006 ORDER BY id DESC"); // using mysqli_query instead
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
		<h1 class="py-4 bg-dark text-light rounded"><i class="fas fa-swatchbook"></i> OFFICE NOTARIAL DE BUJUMBURA</h1>
		<div class="d-flex justify-content-center">
			<div class="w-50"><a href="index.php" class="btn btn-secondary">HOME</a></div>
			<div class="w-50"><a href="index.php" class="btn btn-danger">RETOUR</a></div>
		</div><br><br>
    
        <div class="w-50 container text-center">
            <form action="" method="post">
                <div class="pt-2 input-group mb-2 w-50">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-warning"><i class='fas fa-search'></i>Recherche</div>
                    </div>
                    <input type="text" name="search" class="form-control">
                    <input class="btn btn-info" name="rech" type ="submit" value="SEARCH">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
function isValideId($str){
    list($adr,$go,$fake) = explode('/', $str);
    
    if($fake == null && is_numeric($adr) && is_numeric($go)){
        return true;
    }
    return false;
}

    if (isset($_POST["rech"])) {
        $str = (string)$_POST["search"];
        
        $d = new Database();

        if(isValideId($str)){
            $result = $d->retrieve("SELECT * FROM d_2000 where no_dossier= '" . $str ."'");
        }elseif(is_numeric($str)){
            $result = $d->retrieve("SELECT * FROM d_2000 where no_dossier like '" . $str ."/%'");
        }
        else
        if (validateDate($str, 'Y-m-d')) {
            echo "1";
            $sql = "SELECT * FROM d_2000 where date_acte= '" . $str ."'";
            $result = $d->retrieve($sql);
        }else   
        if  (validateDate($str,'d/m/Y')){
            $raw = date_format(date_create_from_format('d/m/Y', $str), 'Y-m-d');
            $sql = "SELECT * FROM d_2000 where date_acte= '" . $raw ."'";
            $result = $d->retrieve($sql);
        }
        else {
            $sql = "select * from d_2000 where nom_prenom like '%".$str."%'";
            $result = $d->retrieve($sql);
        }
       
    }
?>
    
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
                       
                        while($res = $result->fetch(PDO::FETCH_ASSOC)) {		
                            echo "<tr>";
                            echo "<td style=\"color:red;\" class=\"text-center\">".$res['no_dossier']."</td>";
                            echo "<td style=\"width:100px;\">".$res['date_acte']."</td>";
                            echo "<td>".$res['nature_acte']."</td>";
                            echo "<td>".$res['nom_prenom']."</td>";	
                            echo "<td class=\"text-center\"><a href=\"edit.php?id=$res[id]\"><i class=\"fas fa-edit btnedit\"></i></a> "
                                . "| <a href=\"show.php?id=$res[id]\"><i class=\"fas fa-eye btnedit\"></i></a>"
                                . "| <a href=\"delete.php?id=$res[id]\"><i class=\"fas fa-trash btnedit\"></i></a></td> ";
                        }
                        
                    ?>
                </tbody>
            </table>
        </div>
<?	
    }
?>