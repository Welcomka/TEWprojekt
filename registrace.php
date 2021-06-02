<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'classes/user.php';

$objUser = new User();
// GET
if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    $stmt = $objUser->runQuery("SELECT * FROM uzivatel WHERE UzivatelID=:id");
    $stmt->execute(array(":id" => $id));
    $rowUser = $stmt->fetch(PDO::FETCH_ASSOC);
}else{
  $id = null;
  $rowUser = null;
}

// POST
if(isset($_POST['btn_save'])){
  $name   = strip_tags($_POST['name']);
  $lastname  = strip_tags($_POST['lastname']);
  $uzivatelskeJmeno  = strip_tags($_POST['uzivatelskeJmeno']);
  $heslo  = strip_tags($_POST['heslo']);

  try{
     if($id == null){
       if($name != null && $name != '' && $lastname != null && $lastname != '' && $uzivatelskeJmeno != null && $uzivatelskeJmeno != '' && $heslo != null && $heslo != '')
       if($objUser->insert($name, $lastname, $heslo, $uzivatelskeJmeno)){
        $objUser->redirect('prihlaseni.php?inserted');
      } 
       }else{
         $objUser->redirect('registrace.php?error');
       }
     }
  catch(PDOException $e){
    echo $e->getMessage();
  }
}

?>


<!doctype html>
<html lang="en">
    <head>
        <!-- Head metas, css, and title -->
        <?php require_once 'includes/head.php'; ?>
    </head>
    <body>
        <!-- Header banner -->
        <?php require_once 'includes/header.php'; ?>
        <div class="container-fluid">
            <div class="row">
                
                <main role="main" class="col-sm-12">


  <div class="container-fluid">
  <div class="row">
  <div class="col-sm-12 text-left"> <h1 style="margin-top: 10px">Registrace</h1></div>

</div>

<article>
        <div id="centrovac">
           
            <section>
                <?php
                    if (isset($zprava))
                        echo('<p>' . $zprava . '</p>');
                ?>

<form  method="post">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input class="form-control" type="text" name="id" id="id" value="<?php if (isset($rowUser['UzivatelID'])) print($rowUser['UzivatelID']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Jméno *</label>
                        <input  class="form-control" type="text" name="name" id="name" placeholder="Jméno" value="<?php if (isset($rowUser['Jmeno'])) print($rowUser['Jmeno']); ?>" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Přijmení *</label>
                        <input  class="form-control" type="text" name="lastname" id="lastname" placeholder="Přijmení" value="<?php if (isset($rowUser['Prijmeni'])) print($rowUser['Prijmeni']); ?>" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="uzivatelskeJmeno">Uživatelské jméno *</label>
                        <input  class="form-control" type="text" name="uzivatelskeJmeno" id="uzivatelskeJmeno" placeholder="uživatelskéJméno" value="<?php if (isset($rowUser['uzivatelske_jmeno'])) print($rowUser['uzivatelske_jmeno']); ?>" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="heslo">Heslo *</label>
                        <input  class="form-control" type="password" name="heslo" id="heslo" placeholder="heslo" value="<?php if (isset($rowUser['heslo'])) print($rowUser['heslo']); ?>" required maxlength="100">
                    </div>
                    <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Uložit">
                  </form>
            </section>
            <div class="cistic"></div>
        </div>
    </article>




                    <?php
                     if(isset($_GET['error'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>Chyba! Něco se pokazilo, zkuste to znovu.</strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }
                    ?>
                      
                    </div>

                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>

       
    </body>
</html>


