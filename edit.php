<?php
// including the database connection file
include_once("Database.php");

if (isset($_POST['update'])) {

    $id = $_POST['id'];

    $dateacte = $_POST['dateacte'];
    $natureacte = $_POST['natureacte'];
    $nomprenom = $_POST['nomprenom'];

    // checking empty fields
    if (empty($dateacte) || empty($natureacte) || empty($nomprenom)) {

        if (empty($dateacte)) {
            echo "<font color='red'>Date field is empty.</font><br/>";
        }

        if (empty($natureacte)) {
            echo "<font color='red'>Nature Acte field is empty.</font><br/>";
        }

        if (empty($nomprenom)) {
            echo "<font color='red'>Nom & Prénom field is empty.</font><br/>";
        }
    } else {
        $d = new Database();
        $ret = $d->update("UPDATE d_2000 SET date_acte='$dateacte',nature_acte='$natureacte',nom_prenom='$nomprenom' WHERE id=$id");

        if ($ret) {
            header("Location: index.php");
        } else {
            return;
        }
    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];

$d = new Database();
$result = $d->retrieve("SELECT * FROM d_2000 WHERE id= " . $id);


while ($res = $result->fetch(PDO::FETCH_ASSOC)) {
    $dateacte = $res['date_acte'];
    $natureacte = $res['nature_acte'];
    $nomprenom = $res['nom_prenom'];
}
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
                <div class="w-50"><a href="index.php" class="btn btn-secondary">HOME</a></div>
                <div class="w-50"><a href="search.php" class="btn btn-primary">RECHERCHER DOSSIER</a></div>
            </div><br><br>

            <div style="width:85%;margin-left:80px;">
                <form name="form1" method="post" action="edit.php">
                    <div class="pt-2 input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-warning"><i class='fas fa-calendar-alt'></i></div>
                        </div>
                        <input type="date" name="dateacte" value="<?php echo $dateacte; ?>" class="form-control" placeholder="Date de l'acte(mm/jj/aa)" autocomplete="off">
                    </div>
                    <div class="pt-2 input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-warning"><i class='fas fa-book'></i></div>
                        </div>
                        <input type="text" name="natureacte" value="<?php echo $natureacte; ?>" class="form-control" placeholder="Nature de l'acte" autocomplete="off">
                    </div>
                    <div class="pt-2 input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-warning"><i class='fas fa-users'></i></i></div>
                        </div>
                        <input type="text" name="nomprenom" value="<?php echo $nomprenom; ?>" class="form-control" placeholder="Nom & Prenom de(s) comparant(s)" autocomplete="off">
                    </div>
                    <div class="d-flex justify-content-center">
                        <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
                        <div style="margin-right:10px;"><input type="submit" name="update" class="btn btn-warning" value="MODIFIER"></div>
                        <div><a href="index.php"class="btn btn-danger">ANNULER</a></div>
                    </div>

                </form>
            </div>
        </div>	
    </body>
</html>
