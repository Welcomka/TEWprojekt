<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

session_start();

$jePrihlaseny = false;
$jeAdmin = false;

if (isset($_SESSION['UzivatelID']) && isset($_SESSION['role']))
{
  $jePrihlaseny = true;
  if($_SESSION['role'] == "admin")
    {
      $jeAdmin = true;
    }
}

require_once 'classes/cat.php';

$ObjCat = new Cat();

// GET
if(isset($_GET['delete_id']) && $jePrihlaseny == true && $jeAdmin == true){
  $id = $_GET['delete_id'];
  try{
    if($id != null){
      
      if($ObjCat->delete($id)){
        $ObjCat->redirect('index_cat.php?deleted');
      }
    }else{
      var_dump($id);
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
                <?php
                if($jePrihlaseny == true && $jeAdmin == true)
                {
                  require_once 'includes/sidebar.php';
                  ?>
                  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <?php
                }
                
                else{
                ?>

                 <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">

                <?php
                }
                ?>
                
                    



<div class="container-fluid">
  <div class="row">
  <div class="col-sm-10"> <h1 style="margin-top: 10px">Naše kočičky k adopci</h1></div>
  
  <?php
      if (isset($_SESSION['UzivatelID']))
      {
        if($_SESSION['role'] == "admin")
        { ?>

  <div style="padding-top: 23px" class="col-sm"> <a href="form_cat.php" class="float-right" role="button" aria-pressed="true" class="bg-dark text-white"><b>Přidat kočičku</b></a></div>
        <?php
        }
      }
      ?>
  
</div>

<?php
                      if(isset($_GET['updated'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>Kočka byla úspešně změněna.</strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['deleted'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>Kočka byla úspešně smazána.</strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['inserted'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>Kočka byla úspešně přidána.</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['error'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>Chyba! Něco se pokazilo, zkuste to znovu.</strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }
                      else if(isset($_GET['inserted_castka'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>Částka byla úspěšně přidána.</strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }
                      else if(isset($_GET['error_castka'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>Neplatně zadaná částka.</strong> 
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
                                <th>Jméno</th>
                                <th>Rasa</th>
                                <th>Věk</th>

                                <?php
                if($jePrihlaseny == true && $jeAdmin == false)
                {
                  ?>
                    <th>Adoptovat ↓</th>
                <?php
                }
                else{ ?>
                    <th></th>
                <?php
                }?>
               



                                
                              </tr>
                            </thead>
                            <?php
                              $query = "SELECT * FROM kocka";
                              $stmt = $ObjCat->runQuery($query);
                              $stmt->execute();
                            ?>
                            <tbody>
                                <?php if($stmt->rowCount() > 0){
                                  while($rowCat = $stmt->fetch(PDO::FETCH_ASSOC)){
                                 ?>
                                 <tr>
                                    <td><?php print($rowCat['KockaID']); ?></td>

                                    <td>


                <?php
                if($jePrihlaseny == true && $jeAdmin == true)
                {
                  ?>
                    <a href="form_cat.php?edit_id=<?php print($rowCat['KockaID']); ?>">
                    <?php print($rowCat['Jmeno']); ?>
                    </a>
                <?php
                }
                
                else{
                
                print($rowCat['Jmeno']); 

                }
                ?>
                           
                          </td>

                                    <td><?php print($rowCat['Rasa']); ?></td>
                                    <td><?php print($rowCat['Vek']); ?></td>

                          <td>

                <?php
                if($jePrihlaseny == true && $jeAdmin == true)
                {
                  ?>
                    <a class="confirmation" href="index_cat.php?delete_id=<?php print($rowCat['KockaID']); ?>">
                    <span data-feather="trash"></span>
                    </a>
                <?php
                }
                else if($jePrihlaseny == true && $jeAdmin == false){
                  ?>
                    <a class="" href="form_adopce.php?KockaID=<?php print($rowCat['KockaID']); ?>">
                    <span data-feather="dollar-sign"></span>
                    </a>

                <?php
                }
                ?>
                                      
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

        <!-- Custom scripts -->
        <script>
            // JQuery confirmation
            $('.confirmation').on('click', function () {
                return confirm('Chcete opravdu smazat tuhle kočičku?');
            });
        </script>
    </body>
</html>
