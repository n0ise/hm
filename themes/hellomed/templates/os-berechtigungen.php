<?php /* Template Name: Os Berechtigungen */ ?>

<!-- include_once header.php from template  -->
<?php include_once('os-header.php'); ?>

<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in()) { 
    
// Get the current user ID
// $user_id = "36";
// Get the current user object
$current_user = wp_get_current_user();

// Get the current value of the ACF field for the user
$current_reminder_value = get_field('reminder_checkbox', 'user_'.$current_user->ID);
$current_newsletter_value = get_field('newsletter_checkbox', 'user_'.$current_user->ID);

// var_dump($_POST);

// Output the checkbox with the current value
 ?>

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
                        <input class="form-check-input" type="checkbox" id="legal-3" checked disabled>
                        <label class="form-check-label text-legal" for="legal-3">
                            Ich habe die <a href>AGB</a> und die <a href>Datenschutzerklärung</a> zur Kenntnis genommen.
                            *
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check m-0">
                        <input class="form-check-input" type="checkbox" id="legal-4" checked disabled>
                        <label class="form-check-label text-legal" for="legal-4">
                            Ich willige ein, dass meine personenbezogenen Daten, inklusive meiner Gesundheitsdaten, zum
                            Zweck der Führung meines Kundenkontos wie aus der <a href>Datenschutzerklärung</a>
                            ersichtlich verarbeitet werden. *
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check m-0">
                        <input class="form-check-input" type="checkbox" id="reminder_checkbox" name="reminder_checkbox"
                            <?php echo $current_reminder_value == 'true' ? 'checked' : ''; ?>>
                        <label class="form-check-label text-legal" for="reminder_checkbox">
                            Ich willige ein, dass meine personenbezogenen Daten, inklusive meiner Gesundheitsdaten zum
                            Zweck der Übersendung personalisierter Erinnerungsmails zur Einreichung eines Folgerezeptes
                            und Produktempfehlungen per E-Mail verarbeitet werden.
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check m-0">
                        <input class="form-check-input" type="checkbox" id="newsletter_checkbox"
                            name="newsletter_checkbox"
                            <?php echo $current_newsletter_value == 'true' ? 'checked' : ''; ?>>
                        <label class="form-check-label text-legal" for="newsletter_checkbox">
                            Ja ich möchte weitere Informationen zu Neuigkeiten und Angeboten von der hellomed Group GmbH
                            per E-Mail oder Telefon erhalten. Ich willige ein, dass die Apotheke zu diesem Zweck meine
                            E-Mail-Adresse, Telefonnummer meinen Namen und meine Adresse an die hellomed Group GmbH
                            übermittelt und diese die Daten zum Zweck der Informationsübermittlung verarbeitet. Soweit
                            dafür erforderlich, entbinde ich den Apotheker und seine Angestellten von der
                            Schweigepflicht.
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-block pt-3 text-legal border-top">
                        Ich kann meine Einwilligungen und die Schweigepflicht&shy;entbindungs&shy;erklärung jederzeit
                        mit Wirkung für die Zukunft in meinem hellomedOs Kundenkonto widerrufen.
                    </div>
                </div>
                <div class="col-12">
                    <!-- the id  -->
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($current_user->ID); ?>">
                    <button id="submit" type="submit" class="btn btn-primary btn-lg">Speichern</button>
                </div>
                <div id="successdown"></div>
            </div>
        </div>
    </div>
</main>
<script>
jQuery(document).ready(function($) {
    $('#submit').click(function() {
        // Get the values of the checkboxes
        var newsletter_checkbox = $('#newsletter_checkbox').is(':checked') ? 'true' : 'false';
        var reminder_checkbox = $('#reminder_checkbox').is(':checked') ? 'true' : 'false';
        var user_id = $('#user_id').val();
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        var data = {
            'action': 'berechtigungen',
            'newsletter_checkbox': newsletter_checkbox,
            'reminder_checkbox': reminder_checkbox,
            'user_id': user_id,

            // add other data here
        };
        console.log(data);
        $.post(ajaxurl, data, function(response) {
            console.log(response);
            if (response.status == 'success') {
                $('#successdown').removeClass('alert alert-danger');
                $('#successdown').addClass('alert alert-success');
                $('#successdown').html(response.message);
                $('#successdown').fadeIn(1000);
                setTimeout(function() {
                    $('#successdown').fadeOut(1000);
                }, 5000);
            } else {
                $('#successdown').addClass('alert alert-danger');
                $('#successdown').html(response.message);
                $('#successdown').fadeIn(1000);
                setTimeout(function() {
                    $('#successdown').fadeOut(1000);
                }, 5000);            }
        }, 'json');
    });
});
</script>

<?php } 
else {  
    header("Refresh:0; url=/anmelden"); 
}

// da footer 
include_once('footer.php');
?>