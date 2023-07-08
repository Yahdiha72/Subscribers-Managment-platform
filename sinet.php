<?php 
session_start();
$conn = mysqli_connect("localhost", "root","", "onep");
if(!($conn)){
    echo "no conncetion!";
    die();
}
$req1="SELECT cin,adresse from abonne where id_t is null";
$res1=mysqli_query($conn,$req1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profilecss.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>SINET.COM</title>
</head>
<body>
    <header>
        <h3>Bonjour <?php echo $_SESSION['nom'].' '.$_SESSION['prenom']; ?> à SINET</h3>
        <img src="images/LOGO ONEP.jpg">

    </header>
    <div class="cont">
        <form method="GET">
               <div class="sidebar">
                  <ul>
                     <li><a href="#"><i class="fas fa-qrcode"></i><input class="in" type="submit" name="Dashboard" value="Manuel"></a></li>
                     <li><a href="#"><i class="fas fa-link"></i><input class="in" type="submit" name="site" value="Abonnés"></a></li>
                     <li><a href="#"><i class="fa fa-ban"></i><input class="in" type="submit" name="resi" value="Resilier"></a></li>
                     <li><a href="#"><i class="fas fa-stream"></i><input class="in" type="submit" name="Contrats" value="Contrats"></a></li>
                     <li><a href="#"><i class="fas fa-sliders-h"></i><input class="in" type="submit" name="Abonné" value="Data"></a></li>
                 </ul>
                    <p id="e"></p>
              </div>
        </form>
     <section>
        <div class="front" id="cent">
           <img src="images/GESTION.png" alt="logo onep">
        </div>
        <?php 
        if(isset($_GET['Dashboard'])){
            echo'
            <script>
            document.getElementById("cent").style.display = "none";
            </script>
            <form method="post" id="addadmin" action="">
            <p>Veuillez choisir une des opérations suivantes: <button style="background:#41b51bee"  name="AJO" type="submit">Ajouter</button> <button style="background: rgb(250, 45, 45)"  name="Supprimer" type="submit">Supprimer</button> <button style="background:rgb(42 81 223)"  name="Modifier" type="submit">Modifier</button>
            <table id="add">
                <tr>
                    <th>C.I.N</th>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th>TELEPHONE</th>
                    <th>ADRESS</th>
                    <th>PROFESSION</th>
                    <th>STATU</th>
                    <th>TOURNE</th>
                    
                </tr>
                <tr>
                    <td><input class="input" type="text" name="adcin" value="" required></td>
                    <td><input class="input"  type="text" name="adnom" value="" ></td>
                    <td><input class="input"  type="text" name="adpre" value="" ></td>
                    <td><input class="input"  type="text" name="adtele" value="" pattern="^[0-9]{3,45}$" title="You can only enter numbers, with 10 of characters accepted."
                    required></td>
                    <td><input class="input"  type="text" name="adadress" value="" ></td>
                    <td><input class="input"  type="text" name="adprof" value="" ></td>
                    <td>
                     <input type="number" name="adstatu" list="quantities" min="1" step="1" class="options">
                       <datalist id="quantities">
                          <option value="1">
                          <option value="2">
                       </datalist>
                    </td>
                  <td>
                     <input type="text" list="quant" name="adtour" min="1" step="1" class="options">
                       <datalist id="quant">
                          <option value="10">
                          <option value="40">
                          <option value="30">
                          <option value="23">
                       </datalist>
                    </td> 
                </tr>';
            if(isset($_POST['AJO'])){
                $NA= $_POST['adnom'];
            $PREA= $_POST['adpre'];
            $PROFA= $_POST['adprof'];
            $ADRESE= $_POST['adadress'];
            $TELEA= $_POST['adtele'];
            $CINA= $_POST['adcin'];
            $STATUA= $_POST['adstatu'];
            $TOUR=$_POST['adtour'];
            $extest=0;
            $reqextest="SELECT * FROM abonne where cin='$CINA'";
            $resextest=mysqli_query($conn,$reqextest);
            while($row = mysqli_fetch_assoc($resextest)){
                if($row['cin']=="$CINA"){
                  $extest=1;
                }
              }
              if($extest==0){
                $req3="INSERT INTO abonne (cin,nom_a,prenom_a,tele,adresse,profession,id_s,id_t)
            VALUES('$CINA','$NA','$PREA','$TELEA','$ADRESE','$PROFA',$STATUA,$TOUR)";
            $res3=mysqli_query($conn,$req3);
              }else{
                echo'<p style="color:red;">Les informations saisies existent déjà. Veuillez ressaisir les nouvelles informations';
            }
            
               }

             if(isset($_POST['Supprimer'])){
                $decin=$_POST['adcin'];
                $req4="DELETE FROM abonne where cin='$decin'";
                $res4=mysqli_query($conn,$req4);
               }
            if(isset($_POST['Modifier'])){
                $NP= $_POST['adnom'];
            $PREP= $_POST['adpre'];
            $PROFP= $_POST['adprof'];
            $ADRESEP= $_POST['adadress'];
            $TELEP= $_POST['adtele'];
            $CINP= $_POST['adcin'];
            $STATUP= $_POST['adstatu'];
            $TOURP=$_POST['adtour'];
            $req5="UPDATE abonne SET nom_a='$NP',prenom_a='$PREP',
            tele='$TELEP',adresse='$ADRESEP',profession='$PROFP',
            id_s=$STATUP,id_t=$TOURP
            where cin='$CINP'";
            $res5=mysqli_query($conn,$req5);
            }
       }  
    if(isset($_GET['site'])){
        echo '
        <script>
            document.getElementById("cent").style.display = "none";
            </script>
        <form method="post" id="abon">
        <p id="p1">Les demandes d\'Abonnement</p>
        <table id="ta">
                      <tr>
                         <th>Le C.I.N </th>
                         <th>Adress de persson</th>
                         <th>Numéro de la tourné</th>
                         <th>modifier</th>
                         <th>Supprimer</th>
                      </tr>
                     ';
                     $c=0;
                     while($row = mysqli_fetch_assoc($res1)){
                        $c+=1;
                        echo'
                      <tr>
                         <td><input name="C" type="text" value="'.$row['cin'].'"></td>
                         <td><input name="ad" type="text" value="'.$row['adresse'].'"></td>
                         <td>
                     <input type="text" list="quant" name="adtour" min="1" step="1" class="options">
                       <datalist id="quant">
                          <option value="10">
                          <option value="23">
                          <option value="30">
                          <option value="40">
                       </datalist>
                    </td> 
                         <td><button name="R" type="submit">Register</button></td>
                         <td><button name="S" type="submit" style="background:red;">Supprimer</button></td>
                     </tr>
                     ';}
                     if($c==0){
                        echo '<script>
                        document.getElementById("p1").style.display = "none";
                        </script>
                        <p style="color:red;">No demandes d\'Abonnement </p>';
                    }
                    if(isset($_POST['R'])){
                        $num=$_POST['adtour'];
                        $var=$_POST['C'];
                        $req2="UPDATE abonne SET id_t =$num WHERE cin='$var'";
                        $res2=mysqli_query($conn,$req2);
                    }
                    if(isset($_POST['S'])){
                        $var=$_POST['C'];
                        $req19="DELETE FROM abonne WHERE cin='$var'";
                        $res19=mysqli_query($conn,$req19);
                    }
                }
    if(isset($_GET['resi'])){
                echo '
                <script>
                document.getElementById("cent").style.display = "none";
                </script>
                <p id="p2"> Les demandes de Resiliation</p>
                    <form method="post" id="abon">
                                <table id="ta">
                                  <tr>
                                     <th>Police </th>
                                     <th>Telephone </th>
                                     <th>C.I.N</th>
                                     <th>Type</th>
                                     <th>Numéro de quitance</th>
                                     <th>Modifier</th>
                                     <th>Supprimer</th>
                                  </tr>
                                 ';
                                 $t=0;
                                 $req13="SELECT * from  resiliation r,abonne a where a.cin=r.cin and num_quitance is null";
                                 $res13=mysqli_query($conn,$req13);
                                 while($row = mysqli_fetch_assoc($res13)){
                                    $t=1;
                                    echo'
                                  <tr>
                                     <td><input name="nump" type="text" value="'.$row['num_police'].'"></td>
                                     <td><input name="tel" type="text" value="'.$row['tele'].'"></td>
                                     <td><input type="text" name="lecin" value="'.$row['cin'].'" ></td>
                                     <td><input name="type" type="text" value="'.$row['lib_t'].'"></td>
                                     <td><input type="number" name="quitance" ></td>
                                     <td><button name="CC" type="submit">Register</button></td>
                                     <td><button name="Sup" style="background:red;" type="submit" >Supprimer</button></td>
                                 </tr>
                                 ';}
                                 if($t==0){
                                    echo '<script>
                                    document.getElementById("p2").style.display = "none";
                                    </script>
                                    <p style="color:red;">No demandes de Resiliation</p>';
                                }
                                if(isset($_POST['CC'])){
                                    $num=$_POST['quitance'];
                                    $var=$_POST['nump'];
                                    $req12="UPDATE resiliation SET num_quitance =$num WHERE num_police= $var";
                                    $res12=mysqli_query($conn,$req12);
                                    $abb="DELETE FROM abonnement WHERE num_police=$var";
                                    $resabb=mysqli_query($conn,$abb);


                                }  
                                if(isset($_POST['Sup'])){
                                    $var2=$_POST['nump'];
                                     $sup="DELETE from resiliation WHERE num_police= $var2";
                                     $resup=mysqli_query($conn,$sup);
                               }
                            }

    if(isset($_GET['Contrats'])){
        echo'
        <script>
            document.getElementById("cent").style.display = "none";
            </script>
        <form method="post" id="contra" >
            <p>Pour ajouter un contrat, veuillez choisir l\'un des types ci-dessous :
            <table id="add">
                <tr>
                    <th>Numéro de police</th>
                    <th>Type de contrat</th>
                    <th>C.I.N</th>
                    <th>N° compteur</th>
                    <th>Numéro de quitance</th>
                    <th>A</th>
                    <th>R</th>

                </tr>
                <tr>
                    <td><input class="input" type="number" name="npolice" value="" required></td>
                    <td><input class="input"  type="text" name="type" value="" ></td>
                    <td><input class="input"  type="text" name="cinc" value="" ></td>
                    <td><input class="input"  type="number" name="count" value="" ></td>
                    <td><input class="input"  type="number" name="numq" value="" ></td>
                    <td><button name="abonn" style="background:green;" type="submit">Abonnement</button></td>
                    <td><button name="resi" style="background:red;" type="submit">Réseliation</button></td>
                </tr>';
                if(isset($_POST['abonn'])){
                    $police= $_POST['npolice'];
                    $type= $_POST['type'];
                    $cinc= $_POST['cinc'];
                    $counter= $_POST['count'];
                    $test=0;
                    $t2=0;
                    $reqtest="SELECT * from abonnement";
                    $restest=mysqli_query($conn,$reqtest);
                    while($row = mysqli_fetch_assoc($restest)){
                        if($row['num_police']==$police){
                          $test=1;
                        }
                      }
                    if($test==0){
                        $req7="INSERT into abonnement values($police,now(),'$cinc','$counter','$type')";
                        $res7=mysqli_query($conn,$req7);
                    }
                    else{
                        echo'<p style="color:red;">Les informations saisies existent déjà. Veuillez ressaisir les nouvelles informations';
                    }
                        
                    
                }
                if(isset($_POST['resi'])){
                    $police= $_POST['npolice'];
                    $type= $_POST['type'];
                    $cinc= $_POST['cinc'];
                    $datec= $_POST['datec'];
                    $numq= $_POST['numq'];
                    $req8="INSERT into resiliation values($police,'$type','$cinc','$datec',$numq)";
                    $res8=mysqli_query($conn,$req8);
                    $req9="DELETE FROM abonnement where num_police= $police";
                    $res9=mysqli_query($conn,$req9);
                }
    } 
    if(isset($_GET['Abonné'])){
        $test2=0;
        if($_SESSION['nom']!='Takrida' &&$_SESSION['prenom']!='Omar'){
           $test2=1;
        }
        if($test2==0){
            $req11="SELECT a.cin,nom_a,prenom_a,tele,ab.num_police from abonne a,abonnement ab where a.cin=ab.cin";
        $res11=mysqli_query($conn,$req11);

        echo'
        <script>
            document.getElementById("cent").style.display = "none";
            </script>
            <table id="data">
                      <tr>
                         <th>C.I.N</th>
                         <th>Nom</th>
                         <th>Prenom</th>
                         <th>telephone</th>
                         <th>Police</th>
                      </tr>
                     ';
                     while($row = mysqli_fetch_assoc($res11)){
                        echo'
                      <tr>
                         <td><input name="cin" type="text" value="'.$row['cin'].'"></td>
                         <td><input name="lastname" type="text" value="'.$row['nom_a'].'"></td>
                         <td><input name="firstname" type="text" value="'.$row['prenom_a'].'"></td>
                         <td><input name="adress" type="text" value="'.$row['tele'].'"></td>
                         <td><input name="police" class="number" type="text" value="'.$row['num_police'].'"></td>
                     </tr>
                     ';
                    }
        }
        
        
    }
    ?>
     </section>
    </div>
</body>
</html>
