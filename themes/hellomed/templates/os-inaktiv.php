<?php /* Template Name: Os Inaktiv */ ?>

<!-- include_once header.php from template  -->
<?php include_once('os-header-inaktiv.php'); ?>

<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in()) { ?>

  <main>
  <div class="container max-500">
    <div class="hm-content">

      <div class="waiting">
        <i class="bi bi-clock"></i>
      </div>
      <div class="h3 mb-3">Account inaktiv</div>
      <p>
        Ihr Account wird zur Zeit von einem unserer Servicepartner eingerichtet und
        wird in Kürze freigeschaltet. Bitte schauen Sie später noch einmal vorbei.
      </p>

    </div>
  </div>
</main>


<?php } 
else { ?>
<!-- or show the message and redirect if the user is ooout  -->

<?php header("Refresh:10; url=/anmelden"); 
}

// da footer 
include_once('footer.php');
?>