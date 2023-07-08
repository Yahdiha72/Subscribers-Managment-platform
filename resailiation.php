
<?php
$con=mysqli_connect("localhost","root","","onep");
if(!($con)){
    echo "no conncetion!";
    die();
}
$test=0;
if(isset($_POST['password'])){
  $pwd=$_POST['password'];
  $sql="SELECT num_police from abonnement";
  $ressql=mysqli_query($con, $sql);
  while($row = mysqli_fetch_assoc($ressql)){
    if($row['num_police']==$pwd){
      $test=1;
    }
  }
  if($test==0){
    header("Location: ./login.php");
  }
}
$sql_req="SELECT A.cin,num_comp, nom_a, lib_t, prenom_a, adresse, tele, name_s, id_t 
FROM abonne as A,abonnement as ab,statu as S 
WHERE A.cin=ab.cin and A.id_s=S.id_s 
and ab.num_police=$pwd";
$NOMR="";
$PRER="";
$TELER="";
$ADRS="";
$SNOM="";
$NTOUR="";
$CINR="";
$libt="";
$comp="";
 $res = mysqli_query($con, $sql_req);
 while($row = mysqli_fetch_assoc($res))
 {
     $ADRS = $row['adresse'];
     $NOMR=$row['nom_a'];
     $PRER=$row['prenom_a'];
     $TELER=$row['tele'];
     $CINR=$row['cin'];
     $SNOM=$row['name_s'];
     $NTOUR=$row['id_t'];
     $libt=$row['lib_t'];
     $comp=$row['num_comp'];
 }
 if(isset($_POST['send'])){
    $passpolice=$_POST['police'];
    $lib_t=$_POST['options'];
    $cinre=$_POST['cin'];
    $passcomp=$_POST['counter'];

    $req_s="INSERT INTO resiliation
    VALUES('$passpolice',now(),'$cinre',$passcomp,'$lib_t',null)";
    $res_rs=mysqli_query($con,$req_s);
    
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
    <title>Formulaire resiliation</title>

 </head>
 <body>
    <center>
   <fieldset>
    <div class="head">
     <div><img src="images/LogoONEP.gif"></div>
     <div class="textlogo">Office National de l'Eau Potable</div>
    </div>
    <form method="POST">
        <h1>Domande De Résiliation</h1>
        <hr>
        <table>
            <tr>
                <td >Police:</td><td><input type="number" name="police" value="<?php echo $pwd ?>" required><br><br></td>
            </tr>
            <tr>
                <td>Tournée n°:</td><td><input type="number" name="tour" value="<?php echo $NTOUR ?>" required><br><br></td>
            </tr>
            <tr>
                <td>Compteur n°:</td><td><input type="number" name="counter" value="<?php echo $comp ?>" required><br><br></td>
            </tr>
            <tr>
                <td>Nom :</td><td><input type="text" name="Nom" value="<?php echo $NOMR ?>" required><br><br></td>
            </tr>
            <tr>
                <td>Prénom :</td><td><input type="text" name="pre" value="<?php echo $PRER ?>" required><br><br></td>
            </tr>
            <tr>
                <td>Adresse Personnel:</td><td><input type="text" name="adressep" value="<?php echo $ADRS ?>" required><br><br></td>
            </tr>
            <tr>
                <td>Téléphone Abonné:</td><td><input type="tel" name="telephone" value="<?php echo $TELER ?>" required><br><br></td>
            </tr>
            <tr>
                <td>Carte d'identité n°:</td><td><input type="text" name="cin" value="<?php echo $CINR ?>" required><br><br></td>
            </tr>
            <tr>
                <td>Propriétaire-Locataire(1):</td><td>
                    <select name="options" id="options" >
                    <option  class="option" value="<?php echo $SNOM ?>"><?php echo $SNOM ?></option>
                  </select><br><br>
                </td>
            </tr>
            <tr>
                <td>Type de demande:</td><td>
                    <select name="options" id="options">
                    <option  class="option" value="<?php echo $libt ?>"><?php echo $libt ?></option>
                  </select><br><br></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" id="submit" name="send" value="Envoiyer"></td>
            </tr>
        </table>
    </form>
   </fieldset> 
</center>
 </body>
</html>