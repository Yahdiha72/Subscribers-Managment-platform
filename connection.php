<?php
session_start();
$conn = mysqli_connect("localhost", "root","", "onep");
if(!($conn)){
    echo "no conncetion!";
    die();
}
$reqapp="SELECT * from salarie";
$resapp=mysqli_query($conn,$reqapp);
$test=0;
$code=$_POST['adminpass'];
while($row=mysqli_fetch_assoc($resapp)){
    if($row['code_s']==$code){
        $_SESSION['nom']=$row['nom_s'];
        $_SESSION['prenom']=$row['prenom_s'];
        $test=1;
    }
}
if($test){
    header('location:sinet.php');
}else 
 header('location: Applogin.php');
 ?>