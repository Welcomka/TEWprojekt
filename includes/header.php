<nav class="navbar navbar-expand-lg navbar-dark bg-light fixed-top bg-dark flex-md-nowrap p-0 shadow">
<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="hl_stranka.php">Kočičí kavárna ♥</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

    
        
       <?php
      if (!isset($_SESSION))
      session_start();

      if (isset($_SESSION['UzivatelID']))
      {
        if($_SESSION['role'] == "admin")
        { ?>

          <li class="nav-item ">
          <a class="nav-link" href="index.php">Správa</a>
          </li>

      <?php  
        }
        else{
      ?>

        <li class="nav-item ">
        <a class="nav-link" href="index_cat.php">Adoptovat kočičku</a>
        </li>

        <li class="nav-item ">
        <a class="nav-link" href="moje_adopce.php">Moje adopce</a>
        </li>

      <?php
        }
      ?>
                  
      <?php 
      }
      ?>
 

    


<?php
if (!isset($_SESSION))
session_start();

if (!isset($_SESSION['UzivatelID']))
{
?>
       <li class="nav-item ">
        <a class="nav-link" href="registrace.php">Registrace <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item ">
        <a class="nav-link" href="prihlaseni.php">Přihlášení</a>
      </li>       
<?php 
}

else{
  

?>
      <li class="nav-item ">
        <a class="nav-link" href="odhlaseni.php">Odhlášení</a>
      </li>  

      <li class="nav-item">
        <span class="nav-link"> 
          <?php
             print("přihlášen uživatel: ");
             print($_SESSION['uzivatelskeJmeno']);
          ?>
        </span>

      </li> 

<?php 
} 
?>

    </ul>
  </div>
</nav>


 <!-- <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">Kočičí kavárna ♥</a>
</nav> -->




