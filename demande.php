<?php 

    $server="localhost";
    $username="root";
    $password="";
    $dbname="onep";
    try{
        $con= new PDO("mysql:host=$server;dbname=$dbname",$username,$password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "la connexion a echoué:". $e->getMessage();
    }
    if(isset($_POST['envoyer']))
    {
        $NOM= $_POST['nom'];
        $PRE= $_POST['pre'];
        $PROF= $_POST['prof'];
        $ADRESSE= $_POST['adressep'];
        $TELE= $_POST['tele'];
        $CIN= $_POST['cin'];
        $STATU= $_POST['options'];
        if($STATU==='Propriétaire'){
            $id=1;
        }
        if($STATU==='Locataire'){
            $id=2;
        }
        try{
            $req= ("INSERT INTO abonne (cin,nom_a,prenom_a,adresse,tele,profession,id_s)
                VALUES( :cin, :nom_a, :prenom_a, :adresse, :tele, :profession, :id_s)");
                $res=$con->prepare($req);
                $res->bindValue(':cin', $CIN);
                $res->bindValue(':nom_a', $NOM);
                $res->bindValue(':prenom_a', $PRE);
                $res->bindValue(':profession', $PROF);
                $res->bindValue(':adresse', $ADRESSE);
                $res->bindValue(':tele', $TELE);
                $res->bindValue(':id_s', $id);
                $res->execute();
        } catch (PDOException $e) {
            echo "The user could not be added.<br>".$e->getMessage();
          }
          try{
            $req= ("INSERT INTO person (cin,nom_a,prenom_a,adresse,tele,profession,id_s)
                VALUES( :cin, :nom_a, :prenom_a, :adresse, :tele, :profession, :id_s)");
                $res=$con->prepare($req);
                $res->bindValue(':cin', $CIN);
                $res->bindValue(':nom_a', $NOM);
                $res->bindValue(':prenom_a', $PRE);
                $res->bindValue(':profession', $PROF);
                $res->bindValue(':adresse', $ADRESSE);
                $res->bindValue(':tele', $TELE);
                $res->bindValue(':id_s', $id);
                $res->execute();
        } catch (PDOException $e) {
            echo "The user could not be added.<br>".$e->getMessage();
          }
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
                <td>Nom :</td><td><input type="text" name="nom" value="" required><br><br></td>
            </tr>
            <tr>
                <td>Prénom :</td><td><input type="text" name="pre" value="" required><br><br></td>
            </tr>
            <tr>
                <td>Profession:</td><td><input type="text" name="prof" value="" required><br><br></td>
            </tr>
            <tr>
                <td>Adresse Personnel:</td><td><input type="text" name="adressep" value="" required><br><br></td>
            </tr>
            <tr>
                <td>Téléphone</td><td><input type="tel" name="tele" value="" pattern="^[0-9]{3,45}$" title="You can only enter numbers, with 10 of characters accepted."
      required><br><br></td>
            </tr>
            <tr>
                <td>C.I.N ou permis de conduire n°:</td><td><input type="text" name="cin" value="" required><br><br></td>
            </tr>
            <tr>
                <td>Propriétaire-Locataire(1):</td><td>
                    <select name="options" id="options">
                    <option  class="option" value="Propriétaire">Propriétaire</option>
                    <option  class="option" value="Locataire">Locataire</option>
                  </select><br><br></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" id="submit" name="envoyer" value="Envoyer"></td>
            </tr>
        </table>
    </form>
   </fieldset> 
</center>
 </body>
</html>