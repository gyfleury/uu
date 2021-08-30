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
			<div class="w-50"><a href="search.php" class="btn btn-primary">RECHERCHER DOSSIER</a></div>
			<div class="w-50"><a href="index.php" class="btn btn-danger">RETOUR</a></div>
		</div><br><br>
		<?php
		include_once("Database.php");

		if(isset($_POST['Submit'])) {	
			$dateacte = $_POST['dateacte'];
			$natureacte = $_POST['natureacte'];
			$nomprenom = $_POST['nomprenom'];
                        
			// checking empty fields
			if(empty($dateacte) || empty($natureacte) || empty($nomprenom)) {
						
				if(empty($dateacte)) {
					echo "<font color='red'>Date de l'acte est vide.</font><br/>";
				}
				
				if(empty($natureacte)) {
					echo "<font color='red'>Nature de l'acte est vide.</font><br/>";
				}
				
				if(empty($nomprenom)) {
					echo "<font color='red'>Nom & prénom de(s) comparant(s) est vide.</font><br/>";
				}
				
				//link to the previous page
				echo "<br/><a href='javascript:self.history.back();'>Retour sur le formulaire</a>";
			} else { 
                            
                            $d = new Database();
                            $ret = $d->update("INSERT INTO d_2000(date_acte,nature_acte,nom_prenom) VALUES('$dateacte','$natureacte','$nomprenom')");
				
                            if($ret){
				
				//display success message
				echo "<font color='green'>Dossier enregistré avec success!!!";
				echo "<br/><a href='index.php'>Voir Resultat?</a>";
                                }else{
                                    echo "<font color='red'>Dossier non enregistré!!!";
				    echo "<br/><a href='add.html'>Essayé Encore?</a>";
                                }
                                
			}
		}
		?>
	</div>
</body>
</html>
