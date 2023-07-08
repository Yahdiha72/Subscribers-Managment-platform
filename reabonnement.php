<?php
$conn = mysqli_connect("localhost", "root","", "onep");
if(!($conn)){
    echo "no conncetion!";
    die();
}
$test=0;
if(isset($_POST['password'])){
  $pwd=$_POST['password'];
  $sql="SELECT num_police from abonnement";
  $ressql=mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($ressql)){
    if($row['num_police']==$pwd){
      $test=1;
    }
  }
  if($test==0){
    header("Location: ./login.php");
  }
}
    $sql_get = "SELECT a.adresse,a.id_t from abonne as a,abonnement as ab
     where a.cin=ab.cin and ab.num_police=$pwd ";
    $conn = mysqli_connect("localhost", "root","", "onep");
    if(!($conn)){
        echo "no conncetion!";
        die();
    }
    $ADR = "";
    $TOUR="";
    $result = mysqli_query($conn, $sql_get);
    while($row = mysqli_fetch_assoc($result))
    {
        $ADR = $row['adresse'];
    }
if(isset($_POST['envoye'])){
        $NA= $_POST['nom'];
        $PREA= $_POST['pre'];
        $PROFA= $_POST['prof'];
        $ADRESE= $_POST['adressep'];
        $TELEA= $_POST['tele'];
        $CINA= $_POST['cin'];
        $STATUA= $_POST['options'];
        if($STATUA==='Propriétaire'){
            $idA=1;
        }
        if($STATUA==='Locataire'){
            $idA=2;
        }
    $requet="INSERT INTO abonne(cin,nom_a,prenom_a,tele,adresse,profession,id_s) 
    VALUES('$CINA','$NA','$PREA','$TELEA','$ADRESE','$PROFA',$idA)";
    $resulta_s=mysqli_query($conn,$requet);
    header("location: success.php");
}

?>



<!DOCTYPE html>
<html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="demande.css">
    <title>Formulaire</title>
 </head>
 <body>
    <center>
   <fieldset>
    <div class="head">
     <div ><img src="images/LogoONEP.gif"></div>
     <div class="textlogo">Office National de l'Eau Potable</div>
    </div>
    <form method="post" action="" >
        <h1>DOMANDE D'ABONNEMENT</h1>
        <hr>
        <table>
            <tr>
                <td>Nom :</td><td><input type="text" name="nom" value=""><br><br></td>
            </tr>
            <tr>
                <td>Prénom :</td><td><input type="text" name="pre" value=""><br><br></td>
            </tr>
            <tr>
                <td>Profession:</td><td><input type="text" name="prof" value=""><br><br></td>
            </tr>
            <tr>
                <td>Adresse Personnel:</td><td><input type="text" name="adressep" value="<?php echo $ADR ?>"><br><br></td>
            </tr>
            <tr>
                <td>Téléphone</td><td><input type="tel" name="tele" value="" pattern="^[0-9]{3,45}$" title="You can only enter numbers, with 10 of characters accepted."
      required><br><br></td>
            </tr>
            <tr>
                <td>C.I.N ou permis de conduire n°:</td><td><input type="text" name="cin" value=""><br><br></td>
            </tr>
            <tr>
                <td>Propriétaire-Locataire(1):</td><td>
                    <select name="options" id="options">
                    <option  class="option" value="Propriétaire">Propriétaire</option>
                    <option  class="option" value="Locataire">Locataire</option>
                  </select><br><br></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" id="submit" name="envoye" value="Envoyer"></td>
            </tr>
        </table>
    </form>
   </fieldset> 
</center>
 </body>
</html>