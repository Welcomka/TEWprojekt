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
  <div class="col-sm-12 text-center"> <h1 style="margin-top: 10px">Kočičí kavárna</h1></div>

</div>

<div class="text-center"><h3>O nás</h3></div>


<p style="text-align: center;"><strong>Kavárna Kočičí Praha</strong> je malým rodinným podnikem a nachází se přímo v samotném&nbsp;<strong>srdci pražského Starého města</strong>. Pro zákazníky jsme poprvé otevřeli dveře v listopadu 2014.&nbsp;</p>
<p style="text-align: center;">Jsme <strong>originální kočičí kavárnou</strong>, která následuje <strong>trendy původních japonských zvířecích kaváren</strong>, které úspěšně baví návštěvníky z celého světa již desítky let.&nbsp;</p>
<p style="text-align: center;">V našich prostorách bydlí <strong>devět kočičích terapeutů</strong>, kteří se starají o všechny příchozí zákazníky. Cílem kočičí kavárny je poskytnout našim zákazníkům <strong>příjemné relaxační místo, kde si můžou vychutnat skvělou kávu a dorty</strong> (s kočkou).</p>

<div class="text-center">
  <img  src="img/cat.jpg" class="rounded" alt="..." width="570" height="" >
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
