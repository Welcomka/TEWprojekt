<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION['UzivatelID']) && isset($_SESSION['role']))
{
  if($_SESSION['role'] == "admin")
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
require_once 'classes/cat.php';
require_once 'classes/adopce.php';

$objUser = new User();
$objCat = new Cat();
$objAdopce = new Adopce();


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
                
            <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">


  <div class="container-fluid">
  <div class="row">
  <div class="col-sm-10"> <h1 style="margin-top: 10px">Seznam adopcí</h1></div>
  

</div>
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

                     

                      <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Kočka ID</th>
                                <th>Jméno kočky</th>
                                <th>Peněžní částka</th>
                                <th></th>
                              </tr>
                            </thead>
                            <?php
                              $stmt = $objAdopce->select($_SESSION['UzivatelID']);
                            ?>
                            <tbody>
                                <?php if($stmt->rowCount() > 0){
                                  while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){
                                 ?>
                                 <tr>
                                    <td>                             
                                        <?php print($rowUser['id']); ?>
                                    </td>

                                    <td>   
                                      <?php print($rowUser['KockaID']); ?>                                   
                                    </td>

                                    <td>   
                                      <?php print($rowUser['KockaJmeno']); ?>                                   
                                    </td>

                                    <td>   
                                      <?php print($rowUser['Penezni_castka']); ?>                                   
                                    </td>

                                    <td>
                                    
                                    </td>
                                 </tr>


                          <?php } } ?>
                            </tbody>
                        </table>

                      </div>


                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>

    </body>
</html>
