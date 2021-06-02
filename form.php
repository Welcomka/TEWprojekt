<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION['UzivatelID']) && isset($_SESSION['role']))
{
  if($_SESSION['role'] != "admin")
    {
      header('Location: okno_zamitnuti.php');
      exit();
    }
}
else
{
  header('Location: okno_zamitnuti.php');
  exit();
}

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
     if($id != null){
       if($objUser->update($name, $lastname, $id, $heslo, $uzivatelskeJmeno)){
         $objUser->redirect('index.php?updated');
       }
     }else{
       if($objUser->insert($name, $lastname, $heslo, $uzivatelskeJmeno)){
         $objUser->redirect('index.php?inserted');
       }else{
         $objUser->redirect('index.php?error');
       }
     }
  }catch(PDOException $e){
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
                <!-- Sidebar menu -->
                <?php require_once 'includes/sidebar.php'; ?>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                  <h1 style="margin-top: 10px">Přidat / Editovat uživatele</h1>
                  <p>Pole se znakem * musí být vyplněno</p>
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
                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>
    </body>
</html>
