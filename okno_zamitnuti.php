<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

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
  <div class="col-sm-12 text-center"> <h1 style="margin-top: 10px">Stránku nelze zobrazit</h1></div>

</div>


<div class="text-center">
  <img  src="img/pagenotfound.png" class="rounded" alt="..." >
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
                      
                    </div>

                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>

       
    </body>
</html>
