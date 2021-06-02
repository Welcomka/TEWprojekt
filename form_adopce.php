<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION['UzivatelID']) && isset($_SESSION['role']))
{
  if($_SESSION['role'] != "uzivatel")
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

require_once 'classes/adopce.php';

$objUser = new Adopce();
// GET
if(isset($_GET['KockaID'])){
    $id = $_GET['KockaID'];
}else{
  $id = null;
}

// POST
if(isset($_POST['btn_save'])){
  $id   = strip_tags($_POST['KockaID']);
  $uzivatelID  = $_SESSION['UzivatelID'];
  $penezniCastka  = strip_tags($_POST['Penezni_castka']);

  try{
     if($id != null){
       if($objUser->insert($id, $uzivatelID, $penezniCastka)){
         $objUser->redirect('index_cat.php?inserted_castka');
       }
     }else{
         $objUser->redirect('index_cat.php?error_castka');
       }
     
  }catch(PDOException $e){
    echo $e->getMessage();
  }
}

if($id == null)
  {
    header('Location: okno_zamitnuti.php');
    exit();
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
                
                <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
                  <h1 style="margin-top: 10px">Přidat peněžní částku</h1>
                  
                  <form  method="post">
                    <div class="form-group">
                        <label for="KockaID">ID</label>
                        <input class="form-control" type="text" name="KockaID" id="KockaID" value="<?php print($id) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Penezni_castka">Peněžní částka *</label>
                        <input  class="form-control" type="number" name="Penezni_castka" id="Penezni_castka" placeholder="Peněžní částka" value="">
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
