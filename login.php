
<?php
  if(!(isset($_GET['link']) and (($_GET['link'] == "reb") or ($_GET['link'] == "res")))){
    header("Location: ./mainpage.html");
  }
    ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
    <div class="center">
      <h1>vérifier votre police</h1>
      <?php
        switch ($_GET['link']){
          case 'reb': $link = "./reabonnement.php";
            break;
          case 'res': $link = "./resailiation.php";
            break;
        }
      ?>
      <form action="<?php echo $link ?>" method="post">
        <div class="txt_field">
          <input name="password" type="password" required id="police">
          <span></span>
          <label>Police</label>
        </div>
        <input type="submit" value="vérifie" id="submit">
        <div class="signup_link">
          non abonné? <a href="demande.php">pass un demande</a>
        </div>
      </form>
    </div>
  </body>
</html>
