<?php
include_once("Database.php");
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
			<div class="w-50"><a href="add.html" class="btn btn-success">ENREGISTRER DOSSIER</a></div>
			<div class="w-50"><a href="search.php" class="btn btn-primary">RECHERCHER DOSSIER</a></div>
		</div><br><br>
    </div>
    <div class="container">
        <div class="card">
        <?php
        $id = $_GET['id'];
        
        $d = new Database();
        
        $sql = "SELECT * FROM d_2000 WHERE id = " . $id; 
        $result = $d->retrieve($sql);
        
        while($res = $result->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <div class="card-header">
                <h2>Dossier numéro: <?php echo $res['no_dossier']; ?></h2>
            </div>
            <div class="card-body">
                <h4 class="card-title">Comparant(s): <?php echo $res['nom_prenom'] ?></h4>
                <h5 class="card-text">Date Acte: <?php echo $res['date_acte'] ?></h5><br>
                <p class="card-text">Nature Acte: <?php echo $res['nature_acte'] ?></p>
                <a href="index.php" class="btn btn-warning">QUITTER</a>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
