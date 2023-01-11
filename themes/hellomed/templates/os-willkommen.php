<?php /* Template Name: OS Willkommen */ ?>

<!-- include_once header.php from template  -->
<?php include_once('os-header-inaktiv.php'); ?>

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
        So geht es jetzt weiter:
      </p>
      <ol>
        <li>Bitte senden Sie uns Ihre Originalrezepte so nicht bereits ein<br>E-Rezept hochgeladen wurde.</li>
        <li>Unser Apotheker:innen Team meldet sich bei Ihnen innerhalb von 24 Stunden mit Rückfragen zur Medikationsplanung.</li>
        <li>Nach erfolgreicher Planung, Produktion und Versand Ihrer Blister-Box aktivieren wir Ihren Nutzeraccount.</li>
      </ol>
      <p>
        Bei Fragen rund um Ihre Account-Aktivierung melden Sie sich per<br>E-Mail an
        patient@hellomed.com oder telefonisch unter 030&nbsp;6941&nbsp;132.
      </p>
      <p>
        In der Zwischenzeit können Sie auf Ihrer
        <a href="os-berechtigungen">Berechtigungsseite</a> vorbei schauen.
        Sie haben dort die Möglichkeit sich für unseren automatisierten
        Folgerezept-Service anzumelden. Weitere Informationen finden Sie dort
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