<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'classes/login.php';

session_start();

if (isset($_SESSION['UzivatelID']))
{
    if($_SESSION['role'] == "admin")
    {
        header('Location: index.php');
        exit();
    }
    else
    {
        header('Location: hl_stranka.php');
        exit();
    }
    
}





if ($_POST)
{
    $objLogin = new Login();
    if(isset($_POST['uzivatelskeJmeno']) && isset($_POST['heslo'])){
        $uzivatel = $objLogin->overeniUzivatele($_POST['uzivatelskeJmeno'], $_POST['heslo']);

        if (!$uzivatel)
        {
            $zprava = 'Neplatné uživatelské jméno nebo heslo';
        }
        else
        {
            $_SESSION['UzivatelID'] = $uzivatel['UzivatelID'];
            $_SESSION['uzivatelskeJmeno'] = $uzivatel['uzivatelske_jmeno'];
            $_SESSION['role'] = $uzivatel['role'];

            if($_SESSION['role'] == "admin")
                {
                    header('Location: index.php');
                    exit();
                }   
            else
            {
                    header('Location: hl_stranka.php');
                    exit();
            }
            
            
        }
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
  <div class="col-sm-12 text-left"> <h1 style="margin-top: 10px">Přihlašování</h1></div>

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
                        <label for="uzivatelskeJmeno">Uživatelské jméno</label>
                        <input  class="form-control" type="text" name="uzivatelskeJmeno" id="uzivatelskeJmeno" placeholder="Uživatelské jméno" value="<?php if (isset($rowUser['uzivatelske_jmeno'])) print($rowUser['uzivatelske_jmeno']); ?>" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="heslo">Heslo</label>
                        <input  class="form-control" type="password" name="heslo" id="heslo" placeholder="Heslo" value="<?php if (isset($rowUser['heslo'])) print($rowUser['heslo']); ?>" required maxlength="100">
                    </div>
                    <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Přihlásit">
                  </form>


                <p>Pokud ještě nemáte účet, <a href="registrace.php">zaregistrujte se</a>.</p>
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
