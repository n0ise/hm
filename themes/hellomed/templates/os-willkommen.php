<?php /* Template Name: OS Willkommen */ ?>

<!-- include_once header.php from template  -->
<?php include_once('os-header.php'); ?>

<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in()) { ?>

  <main>
  <div class="container max-600">
    <div class="hm-content">

    <div class="text-center">
    <img src="wp-content/themes/hellomed/assets/img/icons/onboarding/get_started.svg">
        <div class="h2 my-4">Willkommen bei hellomed!</div>
      </div>
      <p>
        Ihr Account wird zur Zeit von einem unserer Servicepartner eingerichtet und
        wird in Kürze freigeschaltet. Bitte schauen Sie später noch einmal vorbei.
      </p>
      <p>
        In der Zwischenzeit können Sie auf unserer
        <a href="os-berechtigungen">Berechtigungsseite</a> vorbei schauen.
        Sie haben dort die Möglichkeit, sich für unser automatisiertes
        Folgerezeptprogramm anzumelden. Weitere Informationen finden Sie dort
        beschrieben.
      </p>
      <p>Das hellomed-Team</p>

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