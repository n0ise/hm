<?php /* Template Name: Os Berechtigungen */ ?>

<!-- include_once header.php from template  -->
<?php include_once('os-header.php'); ?>

<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in()) { ?>

<main>
    <div class="container max-600">
        <div class="hm-content">

            <div class="h2 mb-4">Berechtigungen
                <img src="wp-content/themes/hellomed/assets/img/icons/onboarding/about_me.svg">
            </div>
            <div class="row gy-4">
                <div class="col-12">
                    Um die Nutzung von hellomed so einfach wie möglich zu machen, sagen wir dem Papierkramk Ade.
                    Für unseren bequemen Folgerezept-Service und die fortwährende Belieferung mit hellomed Blistern
                    sowie Kontaktmöglichkeiten, stimmen Sie bitte den folgeden Themen zu:
                </div>
                <div class="col-12">
                    <div class="form-check m-0">
                        <input class="form-check-input" type="checkbox" id="test1">
                        <label class="form-check-label" for="test1">
                            Einbindung Schweigepflicht
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check m-0">
                        <input class="form-check-input" type="checkbox" id="test2">
                        <label class="form-check-label" for="test2">
                            Zustimmung hellomed Group GmbH Datenschutz und AGB
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-lg">Speichern</button>
                </div>
            </div>

        </div>
    </div>
</main>


<?php } 
else { ?>
<!-- or show the message and redirect if the user is ooout  -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Du bist nicht eingeloggt!</h4>
                <p>Bitte logge dich ein, um diese Seite zu sehen.</p>
                <hr>
                <p class="mb-0">Du wirst in 10 Sekunden weitergeleitet.</p>
            </div>
        </div>
    </div>
    <?php header("Refresh:10; url=/anmelden"); 
}

// da footer 
include_once('footer.php');
?>