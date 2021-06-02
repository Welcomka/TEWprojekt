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
if(isset($_GET['delete_id'])){
  $id = $_GET['delete_id'];
  try{
    if($id != null)
    {
      $stmt = $objUser->selectRole($id);
      if($stmt->rowCount() > 0)
      {
        $SelectedRole = null;
        while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC))
        {
         $SelectedRole = $rowUser['role'];
         break;
        }
        if($SelectedRole != null && $SelectedRole != "admin")
        {
            if($objUser->delete($id))
            {
              $objUser->redirect('index.php?deleted');
            }
        }
    
      }
    }
    else
    {
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
                <?php require_once 'includes/sidebar.php'; ?>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">


  <div class="container-fluid">
  <div class="row">
  <div class="col-sm-10"> <h1 style="margin-top: 10px">Naši adopční kočičáci</h1></div>
  
  <div style="padding-top: 23px;" class="col-sm"> <a href="form.php" class="float-right" role="button" aria-pressed="true" class="bg-dark text-white"> <b> Přidat kočičáka</b></a></div>
</div>
                    <?php
                      if(isset($_GET['updated'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>Uživatel byl úspešně změněn.</strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['deleted'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>Uživatel byl úspešně smazán.</strong> 
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['inserted'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>Uživatel byl úspešně přidán.</strong>
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
                    ?>
                      <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Jméno</th>
                                <th>Přijmení</th>
                                <th>Role</th>
                                <th>Uživatelské jméno</th>
                                <th>Heslo</th>
                                <th></th>
                              </tr>
                            </thead>
                            <?php
                              $query = "SELECT * FROM uzivatel";
                              $stmt = $objUser->runQuery($query);
                              $stmt->execute();
                            ?>
                            <tbody>
                                <?php if($stmt->rowCount() > 0){
                                  while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){
                                 ?>
                                 <tr>
                                    <td><?php print($rowUser['UzivatelID']); ?></td>

                                    <td>
                                      <a href="form.php?edit_id=<?php print($rowUser['UzivatelID']); ?>">
                                      <?php print($rowUser['Jmeno']); ?>
                                      </a>
                                    </td>

                                    <td><?php print($rowUser['Prijmeni']); ?></td>

                                    <td><?php print($rowUser['role']); ?></td>

                                    <td><?php print($rowUser['uzivatelske_jmeno']); ?></td>

                                    <td><?php print($rowUser['heslo']); ?></td>

                                    <td>
                                    <?php if($rowUser['role'] != "admin")
                                    { ?>
                                      <a class="confirmation" href="index.php?delete_id=<?php print($rowUser['UzivatelID']); ?>">
                                      <span data-feather="trash"></span>
                                      </a>
                                    <?php
                                    } ?>
                                      
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
                return confirm('Chcete opravdu smazat tohoto kočičáka?');
            });
        </script>
    </body>
</html>
