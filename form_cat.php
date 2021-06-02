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

require_once 'classes/cat.php';

$ObjCat = new Cat();
// GET
if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    $stmt = $ObjCat->runQuery("SELECT * FROM kocka WHERE KockaID=:id");
    $stmt->execute(array(":id" => $id));
    $rowCat = $stmt->fetch(PDO::FETCH_ASSOC);
}else{
  $id = null;
  $rowCat = null;
}

// POST
if(isset($_POST['btn_save'])){
  $name   = strip_tags($_POST['name']);
  $rasa  = strip_tags($_POST['rasa']);
  $vek  = strip_tags($_POST['vek']);

  try{
     if($id != null){
       if($ObjCat->update($name, $rasa, $vek, $id)){
         $ObjCat->redirect('index_cat.php?updated');
       }
     }else{
       if($ObjCat->insert($name, $rasa, $vek)){
         $ObjCat->redirect('index_cat.php?inserted');
       }else{
         $ObjCat->redirect('index_cat.php?error');
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
                  <h1 style="margin-top: 10px">Přidat / Editovat Kočičku</h1>
                  <p>Pole se znakem * musí být vyplněno</p>
                  <form  method="post">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input class="form-control" type="text" name="id" id="id" value="<?php if (isset($rowCat['UzivatelID'])) print($rowCat['UzivatelID']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Jméno kočičky *</label>
                        <input  class="form-control" type="text" name="name" id="name" placeholder="Jméno" value="<?php if (isset($rowCat['Jmeno'])) print($rowCat['Jmeno']); ?>" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Rasa kočičky</label>
                        <input  class="form-control" type="text" name="rasa" id="rasa" placeholder="Rasa" value="<?php if (isset($rowCat['Rasa'])) print($rowCat['Rasa']); ?>" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Věk kočičky</label>
                        <input  class="form-control" type="number" name="vek" id="vek" placeholder="Věk" value="<?php if (isset($rowCat['Vek'])) print($rowCat['Vek']); ?>">
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
