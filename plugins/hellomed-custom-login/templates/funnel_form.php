<?php if(!is_user_logged_in()) { ?>
<link rel="stylesheet" href="https://ui.hellomed.com/src/v1.0/css/uppy.3.3.1.min.css" >
<div class="hm-auth-wrap">
   <!-- <div class="hm-logo">
      <a href="index.php">
          <img src="/wp-content/uploads/2022/05/hel_logo-01.svg" />
      </a>
      </div> -->
   <form id="onboardingForm" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" enctype="multipart/form-data">
      <div id="step1" class="step">
                <section>
            <div class="btn-funnel-wrapper">
                <input id="btn1" type="radio" name="row1" checked="">
                <label for="btn1" class="btn-funnel">
                <img src="../src/v1.0/img/icons/minifunnel/every_week.svg">
                Jede Woche
                </label>
                <input id="btn2" type="radio" name="row1">
                <label for="btn2" class="btn-funnel">
                <img src="../src/v1.0/img/icons/minifunnel/once_or_twice.svg">
                Jede Woche
                </label>
                <input id="btn3" type="radio" name="row1">
                <label for="btn3" class="btn-funnel">
                <img src="../src/v1.0/img/icons/minifunnel/sometimes.svg">
                Jede Woche
                </label>
            </div>
            </section>
      </div>
      <div id="step2" class="hm-auth-form step" style="display: none;">
         <div class="row gy-3">
            <div class="col-12">
               <div class="h3 mb-3">
                  <img src="/wp-content/themes/hellomed/assets/img/icons/onboarding/shipping_adress.svg">
                  Anschrift & Lieferadresse
                  <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Für eine Belieferung mit unseren hellomed Blistern, geben
                     Sie bitte die Lieferadresse des Patienten ein sowie eine
                     Telefonnummer unter der Sie stets für möglicherweise
                     wichtige Rückfragen erreichbar sind."> </i>
               </div>
            </div>
            <div class="col-12">
               <div class="progress">
                  <div class="progress-bar" style="width: 50%;">Schritt 2/4</div>
               </div>
            </div>
            <div class="col-8">
               <div class="form-floating">
                  <input required id="strase" name="strasse" type="text" class="form-control" placeholder=" " />
                  <label for="strase">Straße</label>
                  <div class="invalid-feedback">Pflichtfeld</div>
               </div>
            </div>
            <div class="col-4 ps-0">
               <div class="form-floating">
                  <input required id="strasenr" name="nrno" type="text" class="form-control" placeholder=" " />
                  <label for="strasenr">Nr</label>
                  <div class="invalid-feedback">Pflichtfeld</div>
               </div>
            </div>
            <div class="col-4 pe-0">
               <div class="form-floating">
                  <input required id="plz" name="postcode" maxlength="5" type="text" class="form-control" placeholder=" " />
                  <label for="plz">Postleitzahl</label>
                  <div class="invalid-feedback">Pflichtfeld</div>
               </div>
            </div>
            <div class="col-8">
               <div class="form-floating">
                  <input required id="Ort" name="stadt" type="text" class="form-control" placeholder=" " />
                  <label for="Ort">Wohnort</label>
                  <div class="invalid-feedback">Pflichtfeld</div>
               </div>
            </div>
            <div class="col-12">
               <div class="form-floating">
                  <input id="zusatzinformationen" name="zusatzinformationen" type="text" class="form-control" placeholder=" " />
                  <label for="zusatzinformationen">Haben Sie zusätzliche Lieferhinweise?</label>
               </div>
            </div>
            <div class="col-12">
               <div class="form-floating">
                  <input required id="telefon" name="telephone" type="text" class="form-control" placeholder=" " />
                  <label for="telefon">Was ist Ihre Telefonnummer?</label>
                  <div class="invalid-feedback">Pflichtfeld</div>
               </div>
            </div>
            <div class="col-12">
               <button type="button" class="action next btn btn-primary btn-lg next2">Weiter</button>
            </div>
            <div class="col-12">
               <button type="button" class="action back btn btn-sm">Zurück</button>
            </div>
         </div>
      </div>
      <div id="step3" class="hm-auth-form step" style="display: none;">
         <div class="row gy-3">
            <div class="col-12">
               <div class="h3 mb-3">
                  <img src="/wp-content/themes/hellomed/assets/img/icons/onboarding/prescription2.svg">
                  Rezeptinformationen
                  <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Schluss mit Rezeptechaos, um mit hellomed zu starten
                     benötigen wir einmalig alle Ihre Rezepte. Mögliche Folgerezepte
                     können dann bequem in Ihrem hellomed Kundenkonto an uns
                     verschickt oder hochgeladen werden."> </i>
               </div>
            </div>
            <div class="col-12">
               <div class="progress">
                  <div class="progress-bar" style="width: 75%;">Schritt 3/4</div>
               </div>
            </div>
            <div class="col-12">
               <div class="form-floating">
                  <input required id="startdatumpicker" readonly="readonly" name="startdatumpick" type="text" class="form-control" placeholder=" " onblur="startdatumSelectedBlur();" onfocus="startdatumSelected();" />
                  <label id="startdatumlabel" for="startdatumpicker">Was ist Ihr Wunsch-Startdatum?</label>
                  <div class="invalid-feedback">Pflichtfeld</div>
               </div>
            </div>
            <div class="col-12">
               <label class="form-label">Liegen Ihre Rezepte bereits vor?</label>
               <div class="btn-group d-flex">
                  <input type="radio" class="btn-check" name="first_rezept_uploaded" value="1" id="flexRadioDefault1" autocomplete="off" onclick="ihaverezept();" />
                  <label class="btn btn-outline-primary" for="flexRadioDefault1">Ja, ich habe sie vor mir</label>
                  <input type="radio" class="btn-check" name="first_rezept_uploaded" value="0" id="flexRadioDefault2" autocomplete="off" checked onclick="idonthaverezept();" />
                  <label class="btn btn-outline-primary" for="flexRadioDefault2">Nein, noch nicht</label>
               </div>
            </div>
            <div class="col-12" id="haveFile" style="display: none;">
               <label class="form-label">Welche Art von Rezept liegt Ihnen vor?</label>
               <div class="btn-group d-flex">
                  <input type="radio" class="btn-check" name="rezept_type" value="rezeptfoto" id="rezeptfoto" autocomplete="off" checked onclick="ihaveRezeptfoto();"/>
                  <label class="btn btn-outline-primary" for="rezeptfoto">Rezeptfoto</label>
                  <input type="radio" class="btn-check" name="rezept_type" value="eRezept" id="eRezept" autocomplete="off" onclick="ihaveeRezept();" />
                  <label class="btn btn-outline-primary" for="eRezept">E-Rezept</label>
                  <!-- <input type="radio" class="btn-check" name="rezept_type" value="medplan" id="medplan" autocomplete="off" onclick="ihaveMedplan();" />
                     <label class="btn btn-outline-primary" for="medplan">Medikationsplan</label> -->
               </div>
            </div>
            <div class="col-12" id="rezepthochladen"  style="display: none;">
               <label id="rezeptlabel" class="form-label">Rezept hochladen</label>
               <div id="drag-drop-area"></div>
            </div>
            <div class="col-12" id="medplanhochlade" style="display: none;">
               <label class="form-label">Liegt Ihnen ein Medikationsplan vor?</label>
               <div class="btn-group d-flex">
                  <input type="radio" class="btn-check" name="medplan_uploaded" value="1" id="medplanRadioDefault1" autocomplete="off" onclick="ihavemedplan();" />
                  <label class="btn btn-outline-primary" for="medplanRadioDefault1">Ja, liegt vor</label>
                  <input type="radio" class="btn-check" name="medplan_uploaded" value="0" id="medplanRadioDefault2" autocomplete="off" checked onclick="idonthavemedplan();" />
                  <label class="btn btn-outline-primary" for="medplanRadioDefault2">Nein, noch nicht</label>
               </div>
            </div>
            <div class="col-12" id="medplanhochladen"  style="display: none;">
               <label id="medplanlabel" class="form-label">Medikationsplan hochladen</label>
               <div id="drag-drop-area2"></div>
            </div>
            <!-- Uploaded files list -->
            <div class="uploaded-files" style="display:none;">
               <ol></ol>
            </div>
            <div class="col-12">
               <button type="button" id="submit-dropzone" class="next btn btn-primary btn-lg next3">Weiter</button>
            </div>
            <div class="col-12">
               <button type="button" class="action back btn btn-sm ">Zurück</button>
            </div>
         </div>
      </div>
      <div id="step4" class="hm-auth-form step" style="display: none;">
         <div class="row gy-3">
            <div class="col-12">
               <div class="h3 mb-3">
                  <img src="/wp-content/themes/hellomed/assets/img/icons/onboarding/prescription1.svg">
                  Versicherungsinformation
                  <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Auf Basis Ihrer Rezepte & Medikationspläne versorgen wir Sie
                     bestmöglich. Ihre Krankenkassen Information hilft dabei, denn
                     eine Medikationsplanung hängt auch von möglichen
                     Herstellerverträgen mit Ihrer Krankenkasse ab."> </i>
               </div>
            </div>
            <div class="col-12">
               <div class="progress">
                  <div class="progress-bar" style="width: 100%;">Schritt 4/4</div>
               </div>
            </div>
            <div class="col-12">
               <label class="form-label">Wie sind sie versichert?</label>
               <div id="validbuttongroup" class="btn-group d-flex">
                  <input type="radio" class="btn-check" name="privat_or_gesetzlich" value="Privat" id="flexRadioDefault11" autocomplete="off" />
                  <label class="btn btn-outline-primary" for="flexRadioDefault11">Privat</label>
                  <input type="radio" class="btn-check" name="privat_or_gesetzlich" value="Gesetzlich" checked id="flexRadioDefault22" autocomplete="off" />
                  <label class="btn btn-outline-primary" for="flexRadioDefault22">Gesetzlich</label>
               </div>
               <div class="invalid-feedback">Pflichtfeld</div>
            </div>
            <div class="col-12">
               <div class="form-floating">
                  <input required id="krankenversicherung" name="insurance_company" type="text" class="form-control insurance_company" placeholder=" " />
                  <label for="krankenversicherung">Wie heißt Ihre Krankenversicherung?</label>
                  <div class="invalid-feedback">Pflichtfeld</div>
               </div>
               <div id="filter-records"></div>
            </div>
            <!-- <div class="col-12">
               <div class="form-floating">
                   <input id="versicherungsnummer" name="insurance_number" type="text" class="form-control" placeholder=" " />
                   <label for="versicherungsnummer">Versicherungsnummer (optional)</label>
               </div>
               </div> -->
            <div class="col-12">
               <div id="progressbarcustom" class="for-ProgressBar" style="display: none;">
               </div>
               <input id="hideInputLog" type="submit" name="submit" class="register-button" value="<?php _e( 'Anmeldung abschließen', 'hellomed-custom-login' ); ?>" />
               <label for="hideInputLog" id="labelsubmit" class="btn btn-primary btn-lg">Anmeldung abschließen</label>
            </div>
            <div class="col-12">
               <button type="button" class="action back btn btn-sm ">Zurück</button>
            </div>
         </div>
      </div>
   </form>
</div>
<script type="text/javascript" src="https://ui.hellomed.com/src/v1.0/js/jquery-3.6.3.min.js"></script>
<script type="text/javascript" src="https://ui.hellomed.com/src/v1.0/js/bootstrap.5.3.0.bundle.min.js"></script>
<script type="text/javascript" src="/wp-content/plugins/hellomed-custom-login/assets/js/multistep.js"></script>
<script type="text/javascript" src="/wp-content/plugins/hellomed-custom-login/assets/js/search-function.js"></script>
<script src="https://ui.hellomed.com/src/v1.0/js/bootstrap-datepicker.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ui.hellomed.com/src/v1.0/js/bootstrap-datepicker.de.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   (function($) {
     $.fn.inputFilter = function(callback, errMsg) {
       return this.on("input keydown keyup mousedown mouseup select contextmenu drop focusout", function(e) {
         if (callback(this.value)) {
           // Accepted value
           if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
             $(this).removeClass("is-invalid");
             this.setCustomValidity("");
           }
           this.oldValue = this.value;
           this.oldSelectionStart = this.selectionStart;
           this.oldSelectionEnd = this.selectionEnd;
         } else if (this.hasOwnProperty("oldValue")) {
           // Rejected value - restore the previous one
           $(this).addClass("is-invalid");
           this.setCustomValidity(errMsg);
           this.reportValidity();
           this.value = this.oldValue;
           this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
         } else {
           // Rejected value - nothing to restore
           this.value = "";
         }
       });
     };
   }(jQuery));
   
   
   $("#plz").inputFilter(function(value) {
     return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 100000); }, "Must be a postcode");
   
   $("#telefon").inputFilter(function(value) {
       return /^-?\d*[+]?\d*$/.test(value); }, "Must be a phone number");
   
   
   //   [0-9]*\/*(\+49)*[ ]*(\([0-9]+\))*([ ]*(-|–)*[ ]*[0-9]+)*
   
   //     \+?[0-9]+([0-9]|\/|\(|\)|\-| ){10,}
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
</script>
<script type="module">
   if (screen && screen.width / screen.height > 1) {
       var heightview = 425;
   }
   else {
   var heightview = 650;
   }
   
   import {
   Uppy,
   Dashboard,
   XHRUpload,
   Compressor,
   Webcam,
   ProgressBar
   } from "https://ui.hellomed.com/src/v1.0/js/uppy.min.mjs"
   
   var uppy = new Uppy({
   
       restrictions: {
           allowedFileTypes: ['image/*', '.pdf'],
       },
   
       onBeforeFileAdded: (file) => {
           const name = Date.now() + '_' + file.name
           Object.defineProperty(file.data, 'name', {
               writable: true,
               value: name
           });
           return {
               ...file,
               name,
               meta: {
                   ...file.meta,
                   name
               }
           }
       },
       locale: {
   
           strings: {
               addBulkFilesFailed: {
                   '0': 'Das Hinzufügen einer Datei ist aufgrund eines internen Fehlers fehlgeschlagen',
                   '1': 'Das Hinzufügen von %{smart_count} Dateien ist aufgrund eines internen Fehlers fehlgeschlagen',
               },
               addingMoreFiles: 'Dateien hinzufügen',
               addMore: 'Mehr hinzufügen',
               addMoreFiles: 'Dateien hinzufügen',
               allFilesFromFolderNamed: 'Alle Dateien vom Ordner %{name}',
               allowAccessDescription: 'Um Bilder oder Videos mit Ihrer Kamera aufzunehmen, erlauben Sie dieser Website bitte den Zugriff auf Ihre Kamera.',
               allowAccessTitle: 'Bitte erlauben Sie Zugriff auf Ihre Kamera',
               aspectRatioLandscape: 'Zuschneiden auf Querformat (16:9)',
               aspectRatioPortrait: 'Zuschneiden auf Hochformat (9:16)',
               aspectRatioSquare: 'Zuschneiden auf Quadrat',
               authenticateWith: 'Mit %{pluginName} verbinden',
               authenticateWithTitle: 'Bitte authentifizieren Sie sich mit %{pluginName}, um Dateien auszuwählen',
               back: 'Zurück',
               backToSearch: 'Zurück zur Suche',
               browse: 'durchsuchen',
               browseFiles: 'Dateien durchsuchen',
               browseFolders: 'Ordner durchsuchen',
               cancel: 'Abbrechen',
               cancelUpload: 'Hochladen abbrechen',
               chooseFiles: 'Dateien auswählen',
               closeModal: 'Fenster schließen',
               companionError: 'Verbindung zu Companion fehlgeschlagen',
               companionUnauthorizeHint: 'Um die Autorisierung für Ihr %{provider} Konto aufzuheben, gehen Sie bitte zu %{url}',
               complete: 'Fertig',
               connectedToInternet: 'Mit dem Internet verbunden',
               copyLink: 'Link kopieren',
               copyLinkToClipboardFallback: 'Untenstehende URL kopieren',
               copyLinkToClipboardSuccess: 'Link in die Zwischenablage kopiert',
               creatingAssembly: 'Das Hochladen wird vorbereiten...',
               creatingAssemblyFailed: 'Transloadit: Assembly konnte nicht erstellt werden',
               dashboardTitle: 'Hochladen von Dateien',
               dashboardWindowTitle: 'Hochladen von Dateien (ESC drücken zum Schließen)',
               dataUploadedOfTotal: '%{complete} von %{total}',
               discardRecordedFile: 'Aufgenommene Datei verwerfen',
               done: 'Abgeschlossen',
               dropHereOr: 'Dateien hier ablegen oder %{browse}',
               dropHint: 'Dateien hier ablegen',
               dropPasteBoth: 'Dateien hier ablegen/einfügen, %{browseFiles} oder %{browseFolders}',
               dropPasteFiles: 'Dateien hier ablegen/einfügen oder %{browseFiles}',
               dropPasteFolders: 'Dateien hier ablegen/einfügen oder %{browseFolders}',
               dropPasteImportBoth: 'Dateien hier ablegen/einfügen, %{browse} oder von folgenden Quellen importieren:',
               dropPasteImportFiles: 'Dateien hier ablegen, %{browseFiles} oder importieren von:',
               dropPasteImportFolders: 'Dateien hier ablegen/einfügen, %{browseFolders} oder von folgenden Quellen importieren:',
               editFile: 'Datei bearbeiten',
               editFileWithFilename: 'Datei %{file} bearbeiten',
               editing: '%{file} bearbeiten',
               emptyFolderAdded: 'Keine Dateien hinzugefügt, da der Ordner leer war',
               encoding: 'Kodieren...',
               enterCorrectUrl: 'Falsche URL: Bitte stellen Sie sicher, dass Sie einen direkten Link zu einer Datei eingeben',
               enterTextToSearch: 'Text zum Suchen von Bildern eingeben',
               enterUrlToImport: 'URL zum Importieren einer Datei eingeben',
               exceedsSize: 'Datei %{file} ist größer als die maximal erlaubte Dateigröße von %{size}',
               failedToFetch: 'Companion konnte diese URL nicht verarbeiten - stellen Sie bitte sicher, dass sie korrekt ist',
               failedToUpload: 'Fehler beim Hochladen der Datei %{file}',
               filesUploadedOfTotal: {
                   '0': '%{complete} von %{smart_count} Datei hochgeladen',
                   '1': '%{complete} von %{smart_count} Dateien hochgeladen',
               },
               filter: 'Filter',
               finishEditingFile: 'Bearbeitung beenden',
               flipHorizontal: 'Horizontal spiegeln',
               folderAdded: {
                   '0': 'Eine Datei von %{folder} hinzugefügt',
                   '1': '%{smart_count} Dateien von %{folder} hinzugefügt',
               },
               folderAlreadyAdded: 'Der Ordner "%{folder}" wurde bereits hinzugefügt',
               generatingThumbnails: 'Erstellen von Miniaturansichten...',
               import: 'Importieren',
               importFiles: 'Importiere Dateien von:',
               importFrom: 'Importieren von %{name}',
               inferiorSize: 'Diese Datei ist kleiner als die minimal erlaubte Dateigröße von %{size}',
               loading: 'Laden...',
               logOut: 'Abmelden',
               micDisabled: 'Zugriff auf Mikrofon von Benutzer abgelehnt',
               missingRequiredMetaField: 'Fehlende erforderliche Meta-Felder',
               missingRequiredMetaFieldOnFile: 'Fehlende erforderliche Meta-Felder in %{fileName}',
               myDevice: 'Mein Gerät',
               noCameraDescription: 'Bitte Kamera anschließen, um Bilder oder Videos aufzunehmen',
               noCameraTitle: 'Kamera nicht verfügbar',
               noDuplicates: 'Datei \'%{fileName}\' existiert bereits und kann nicht erneut hinzugefügt werden',
               noFilesFound: 'Sie haben hier keine Dateien oder Ordner',
               noInternetConnection: 'Keine Internetverbindung',
               noMoreFilesAllowed: 'Während der Upload läuft, können keine weiteren Dateien hinzugefügt werden',
               openFolderNamed: 'Ordner %{name} öffnen',
               pause: 'Pausieren',
               paused: 'Pausiert',
               pauseUpload: 'Hochladen pausieren',
               pluginNameBox: 'Box',
               pluginNameCamera: 'Kamera',
               pluginNameDropbox: 'Dropbox',
               pluginNameFacebook: 'Facebook',
               pluginNameGoogleDrive: 'Google Drive',
               pluginNameInstagram: 'Instagram',
               pluginNameOneDrive: 'OneDrive',
               pluginNameZoom: 'Zoom',
               poweredBy: 'Powered by %{uppy}',
               processingXFiles: {
                   '0': 'Eine Datei verarbeiten',
                   '1': '%{smart_count} Dateien verarbeiten',
               },
               recording: 'Aufnahme',
               recordingLength: 'Aufnahmedauer %{recording_length}',
               recordingStoppedMaxSize: 'Die Aufnahme wurde gestoppt, weil die Dateigröße das Limit überschritten hat',
               recoveredAllFiles: 'Wir haben alle Dateien wiederhergestellt. Sie können mit dem Hochladen fortfahren.',
               recoveredXFiles: {
                   '0': 'Wir konnten eine Datei nicht vollständig wiederherstellen. Bitte wählen Sie sie erneut aus und fahren Sie dann mit dem Hochladen fort.',
                   '1': 'Wir konnten %{smart_count} Dateien nicht vollständig wiederherstellen. Bitte wählen Sie sie erneut aus und fahren Sie dann mit dem Hochladen fort.',
               },
               removeFile: 'Datei entfernen',
               reSelect: 'Erneut auswählen',
               resetFilter: 'Filter zurücksetzen',
               resume: 'Fortsetzen',
               resumeUpload: 'Hochladen fortsetzen',
               retry: 'Erneut versuchen',
               retryUpload: 'Hochladen erneut versuchen',
               revert: 'Rückgängig machen',
               rotate: 'Drehen',
               save: 'Speichern',
               saveChanges: 'Änderungen speichern',
               searchImages: 'Suche nach Bildern',
               selectX: {
                   '0': 'Wählen Sie %{smart_count}',
                   '1': 'Wählen Sie %{smart_count}',
               },
               sessionRestored: '',
               smile: 'Bitte lächeln!',
               startCapturing: 'Bildschirmaufnahme starten',
               startRecording: 'Videoaufnahme starten',
               stopCapturing: 'Bildschirmaufnahme stoppen',
               stopRecording: 'Videoaufnahme stoppen',
               streamActive: 'Stream aktiv',
               streamPassive: 'Stream passiv',
               submitRecordedFile: 'Aufgezeichnete Datei verwenden',
               takePicture: 'Ein Foto machen',
               timedOut: 'Upload für %{seconds} Sekunden stehen geblieben, breche ab.',
               upload: 'Hochladen',
               uploadComplete: 'Hochladen abgeschlossen',
               uploadFailed: 'Hochladen fehlgeschlagen',
               uploading: 'Wird hochgeladen',
               uploadingXFiles: {
                   '0': 'Eine Datei wird hochgeladen',
                   '1': '%{smart_count} Dateien werden hochgeladen',
               },
               uploadPaused: 'Hochladen pausiert',
               uploadXFiles: {
                   '0': 'Eine Datei hochladen',
                   '1': '%{smart_count} Dateien hochladen',
               },
               uploadXNewFiles: {
                   '0': '+%{smart_count} Datei hochladen',
                   '1': '+%{smart_count} Dateien hochladen',
               },
               xFilesSelected: {
                   '0': 'Eine Datei ausgewählt',
                   '1': '%{smart_count} Dateien ausgewählt',
               },
               xMoreFilesAdded: {
                   '0': 'Eine weitere Datei hinzugefügt',
                   '1': '%{smart_count} weitere Dateien hinzugefügt',
               },
               xTimeLeft: '%{time} verbleibend',
               youCanOnlyUploadFileTypes: 'Sie können nur folgende Dateitypen hochladen: %{types}',
               youCanOnlyUploadX: {
                   '0': 'Sie können nur eine Datei hochladen',
                   '1': 'Sie können nur %{smart_count} Dateien hochladen',
               },
               youHaveToAtLeastSelectX: {
                   '0': 'Sie müssen mindestens eine Datei auswählen',
                   '1': 'Sie müssen mindestens %{smart_count} Dateien auswählen',
               },
               zoomIn: 'Vergrößern',
               zoomOut: 'Verkleinern',
           }
   
       }
   
   })
   
   
   
   .use(Dashboard, {
       inline: true,
       height: heightview,
       proudlyDisplayPoweredByUppy: false,
       target: '#drag-drop-area',
       doneButtonHandler: null,
       showRemoveButtonAfterComplete: true,
       hideUploadButton: true,
   })
   
   .use(Webcam, {
       target: Dashboard,
       onBeforeSnapshot: () => Promise.resolve(),
       countdown: false,
       modes: [
           'picture',
       ],
       mirror: false,
       showVideoSourceDropdown: false,
       /** @deprecated Use `videoConstraints.facingMode` instead. */
       facingMode: 'environment',
       videoConstraints: {
           facingMode: 'environment',
       },
       preferredImageMimeType: null,
       preferredVideoMimeType: null,
       showRecordingLength: false,
       mobileNativeCamera: false,
       locale: {},
   })
   
   .use(XHRUpload, {
       endpoint: '/wp-content/themes/hellomed/uploads/upload.php',
       fieldName: 'my_file',
   })
   
   .use(ProgressBar, {
       target: '.for-ProgressBar',
       hideAfterFinish: true,
   });
   
   
   
   
   
   
   var uppy2 = new Uppy({
   
           restrictions: {
               allowedFileTypes: ['image/*', '.pdf'],
           },
   
           onBeforeFileAdded: (file) => {
               const name = Date.now() + '_' + file.name
               Object.defineProperty(file.data, 'name', {
                   writable: true,
                   value: name
               });
               return {
                   ...file,
                   name,
                   meta: {
                       ...file.meta,
                       name
                   }
               }
           },
           locale: {
   
               strings: {
                   addBulkFilesFailed: {
                       '0': 'Das Hinzufügen einer Datei ist aufgrund eines internen Fehlers fehlgeschlagen',
                       '1': 'Das Hinzufügen von %{smart_count} Dateien ist aufgrund eines internen Fehlers fehlgeschlagen',
                   },
                   addingMoreFiles: 'Dateien hinzufügen',
                   addMore: 'Mehr hinzufügen',
                   addMoreFiles: 'Dateien hinzufügen',
                   allFilesFromFolderNamed: 'Alle Dateien vom Ordner %{name}',
                   allowAccessDescription: 'Um Bilder oder Videos mit Ihrer Kamera aufzunehmen, erlauben Sie dieser Website bitte den Zugriff auf Ihre Kamera.',
                   allowAccessTitle: 'Bitte erlauben Sie Zugriff auf Ihre Kamera',
                   aspectRatioLandscape: 'Zuschneiden auf Querformat (16:9)',
                   aspectRatioPortrait: 'Zuschneiden auf Hochformat (9:16)',
                   aspectRatioSquare: 'Zuschneiden auf Quadrat',
                   authenticateWith: 'Mit %{pluginName} verbinden',
                   authenticateWithTitle: 'Bitte authentifizieren Sie sich mit %{pluginName}, um Dateien auszuwählen',
                   back: 'Zurück',
                   backToSearch: 'Zurück zur Suche',
                   browse: 'durchsuchen',
                   browseFiles: 'Dateien durchsuchen',
                   browseFolders: 'Ordner durchsuchen',
                   cancel: 'Abbrechen',
                   cancelUpload: 'Hochladen abbrechen',
                   chooseFiles: 'Dateien auswählen',
                   closeModal: 'Fenster schließen',
                   companionError: 'Verbindung zu Companion fehlgeschlagen',
                   companionUnauthorizeHint: 'Um die Autorisierung für Ihr %{provider} Konto aufzuheben, gehen Sie bitte zu %{url}',
                   complete: 'Fertig',
                   connectedToInternet: 'Mit dem Internet verbunden',
                   copyLink: 'Link kopieren',
                   copyLinkToClipboardFallback: 'Untenstehende URL kopieren',
                   copyLinkToClipboardSuccess: 'Link in die Zwischenablage kopiert',
                   creatingAssembly: 'Das Hochladen wird vorbereiten...',
                   creatingAssemblyFailed: 'Transloadit: Assembly konnte nicht erstellt werden',
                   dashboardTitle: 'Hochladen von Dateien',
                   dashboardWindowTitle: 'Hochladen von Dateien (ESC drücken zum Schließen)',
                   dataUploadedOfTotal: '%{complete} von %{total}',
                   discardRecordedFile: 'Aufgenommene Datei verwerfen',
                   done: 'Abgeschlossen',
                   dropHereOr: 'Dateien hier ablegen oder %{browse}',
                   dropHint: 'Dateien hier ablegen',
                   dropPasteBoth: 'Dateien hier ablegen/einfügen, %{browseFiles} oder %{browseFolders}',
                   dropPasteFiles: 'Dateien hier ablegen/einfügen oder %{browseFiles}',
                   dropPasteFolders: 'Dateien hier ablegen/einfügen oder %{browseFolders}',
                   dropPasteImportBoth: 'Dateien hier ablegen/einfügen, %{browse} oder von folgenden Quellen importieren:',
                   dropPasteImportFiles: 'Dateien hier ablegen, %{browseFiles} oder importieren von:',
                   dropPasteImportFolders: 'Dateien hier ablegen/einfügen, %{browseFolders} oder von folgenden Quellen importieren:',
                   editFile: 'Datei bearbeiten',
                   editFileWithFilename: 'Datei %{file} bearbeiten',
                   editing: '%{file} bearbeiten',
                   emptyFolderAdded: 'Keine Dateien hinzugefügt, da der Ordner leer war',
                   encoding: 'Kodieren...',
                   enterCorrectUrl: 'Falsche URL: Bitte stellen Sie sicher, dass Sie einen direkten Link zu einer Datei eingeben',
                   enterTextToSearch: 'Text zum Suchen von Bildern eingeben',
                   enterUrlToImport: 'URL zum Importieren einer Datei eingeben',
                   exceedsSize: 'Datei %{file} ist größer als die maximal erlaubte Dateigröße von %{size}',
                   failedToFetch: 'Companion konnte diese URL nicht verarbeiten - stellen Sie bitte sicher, dass sie korrekt ist',
                   failedToUpload: 'Fehler beim Hochladen der Datei %{file}',
                   filesUploadedOfTotal: {
                       '0': '%{complete} von %{smart_count} Datei hochgeladen',
                       '1': '%{complete} von %{smart_count} Dateien hochgeladen',
                   },
                   filter: 'Filter',
                   finishEditingFile: 'Bearbeitung beenden',
                   flipHorizontal: 'Horizontal spiegeln',
                   folderAdded: {
                       '0': 'Eine Datei von %{folder} hinzugefügt',
                       '1': '%{smart_count} Dateien von %{folder} hinzugefügt',
                   },
                   folderAlreadyAdded: 'Der Ordner "%{folder}" wurde bereits hinzugefügt',
                   generatingThumbnails: 'Erstellen von Miniaturansichten...',
                   import: 'Importieren',
                   importFiles: 'Importiere Dateien von:',
                   importFrom: 'Importieren von %{name}',
                   inferiorSize: 'Diese Datei ist kleiner als die minimal erlaubte Dateigröße von %{size}',
                   loading: 'Laden...',
                   logOut: 'Abmelden',
                   micDisabled: 'Zugriff auf Mikrofon von Benutzer abgelehnt',
                   missingRequiredMetaField: 'Fehlende erforderliche Meta-Felder',
                   missingRequiredMetaFieldOnFile: 'Fehlende erforderliche Meta-Felder in %{fileName}',
                   myDevice: 'Mein Gerät',
                   noCameraDescription: 'Bitte Kamera anschließen, um Bilder oder Videos aufzunehmen',
                   noCameraTitle: 'Kamera nicht verfügbar',
                   noDuplicates: 'Datei \'%{fileName}\' existiert bereits und kann nicht erneut hinzugefügt werden',
                   noFilesFound: 'Sie haben hier keine Dateien oder Ordner',
                   noInternetConnection: 'Keine Internetverbindung',
                   noMoreFilesAllowed: 'Während der Upload läuft, können keine weiteren Dateien hinzugefügt werden',
                   openFolderNamed: 'Ordner %{name} öffnen',
                   pause: 'Pausieren',
                   paused: 'Pausiert',
                   pauseUpload: 'Hochladen pausieren',
                   pluginNameBox: 'Box',
                   pluginNameCamera: 'Kamera',
                   pluginNameDropbox: 'Dropbox',
                   pluginNameFacebook: 'Facebook',
                   pluginNameGoogleDrive: 'Google Drive',
                   pluginNameInstagram: 'Instagram',
                   pluginNameOneDrive: 'OneDrive',
                   pluginNameZoom: 'Zoom',
                   poweredBy: 'Powered by %{uppy}',
                   processingXFiles: {
                       '0': 'Eine Datei verarbeiten',
                       '1': '%{smart_count} Dateien verarbeiten',
                   },
                   recording: 'Aufnahme',
                   recordingLength: 'Aufnahmedauer %{recording_length}',
                   recordingStoppedMaxSize: 'Die Aufnahme wurde gestoppt, weil die Dateigröße das Limit überschritten hat',
                   recoveredAllFiles: 'Wir haben alle Dateien wiederhergestellt. Sie können mit dem Hochladen fortfahren.',
                   recoveredXFiles: {
                       '0': 'Wir konnten eine Datei nicht vollständig wiederherstellen. Bitte wählen Sie sie erneut aus und fahren Sie dann mit dem Hochladen fort.',
                       '1': 'Wir konnten %{smart_count} Dateien nicht vollständig wiederherstellen. Bitte wählen Sie sie erneut aus und fahren Sie dann mit dem Hochladen fort.',
                   },
                   removeFile: 'Datei entfernen',
                   reSelect: 'Erneut auswählen',
                   resetFilter: 'Filter zurücksetzen',
                   resume: 'Fortsetzen',
                   resumeUpload: 'Hochladen fortsetzen',
                   retry: 'Erneut versuchen',
                   retryUpload: 'Hochladen erneut versuchen',
                   revert: 'Rückgängig machen',
                   rotate: 'Drehen',
                   save: 'Speichern',
                   saveChanges: 'Änderungen speichern',
                   searchImages: 'Suche nach Bildern',
                   selectX: {
                       '0': 'Wählen Sie %{smart_count}',
                       '1': 'Wählen Sie %{smart_count}',
                   },
                   sessionRestored: '',
                   smile: 'Bitte lächeln!',
                   startCapturing: 'Bildschirmaufnahme starten',
                   startRecording: 'Videoaufnahme starten',
                   stopCapturing: 'Bildschirmaufnahme stoppen',
                   stopRecording: 'Videoaufnahme stoppen',
                   streamActive: 'Stream aktiv',
                   streamPassive: 'Stream passiv',
                   submitRecordedFile: 'Aufgezeichnete Datei verwenden',
                   takePicture: 'Ein Foto machen',
                   timedOut: 'Upload für %{seconds} Sekunden stehen geblieben, breche ab.',
                   upload: 'Hochladen',
                   uploadComplete: 'Hochladen abgeschlossen',
                   uploadFailed: 'Hochladen fehlgeschlagen',
                   uploading: 'Wird hochgeladen',
                   uploadingXFiles: {
                       '0': 'Eine Datei wird hochgeladen',
                       '1': '%{smart_count} Dateien werden hochgeladen',
                   },
                   uploadPaused: 'Hochladen pausiert',
                   uploadXFiles: {
                       '0': 'Eine Datei hochladen',
                       '1': '%{smart_count} Dateien hochladen',
                   },
                   uploadXNewFiles: {
                       '0': '+%{smart_count} Datei hochladen',
                       '1': '+%{smart_count} Dateien hochladen',
                   },
                   xFilesSelected: {
                       '0': 'Eine Datei ausgewählt',
                       '1': '%{smart_count} Dateien ausgewählt',
                   },
                   xMoreFilesAdded: {
                       '0': 'Eine weitere Datei hinzugefügt',
                       '1': '%{smart_count} weitere Dateien hinzugefügt',
                   },
                   xTimeLeft: '%{time} verbleibend',
                   youCanOnlyUploadFileTypes: 'Sie können nur folgende Dateitypen hochladen: %{types}',
                   youCanOnlyUploadX: {
                       '0': 'Sie können nur eine Datei hochladen',
                       '1': 'Sie können nur %{smart_count} Dateien hochladen',
                   },
                   youHaveToAtLeastSelectX: {
                       '0': 'Sie müssen mindestens eine Datei auswählen',
                       '1': 'Sie müssen mindestens %{smart_count} Dateien auswählen',
                   },
                   zoomIn: 'Vergrößern',
                   zoomOut: 'Verkleinern',
               }
   
           }
   
           })
   
   
   
           .use(Dashboard, {
           inline: true,
           height: heightview,
           proudlyDisplayPoweredByUppy: false,
           target: '#drag-drop-area2',
           doneButtonHandler: null,
           showRemoveButtonAfterComplete: true,
           hideUploadButton: true,
           })
   
           .use(Webcam, {
           target: Dashboard,
           onBeforeSnapshot: () => Promise.resolve(),
           countdown: false,
           modes: [
               'picture',
           ],
           mirror: false,
           showVideoSourceDropdown: false,
           /** @deprecated Use `videoConstraints.facingMode` instead. */
           facingMode: 'environment',
           videoConstraints: {
               facingMode: 'environment',
           },
           preferredImageMimeType: null,
           preferredVideoMimeType: null,
           showRecordingLength: false,
           mobileNativeCamera: false,
           locale: {},
           })
   
           .use(XHRUpload, {
           endpoint: '/wp-content/themes/hellomed/uploads/upload.php',
           fieldName: 'my_file',
           })
   
           .use(ProgressBar, {
           target: '.for-ProgressBar',
           hideAfterFinish: true,
           });
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   uppy.on('upload-success', (file, response) => {
   const url = response.uploadURL
   const fileName = file.name
   const li = document.createElement('li')
   const input = document.createElement('input')
   input.type = 'hidden'
   input.value = fileName
   input.name = 'listfilenames[]'
   input.appendChild(document.createTextNode(fileName))
   li.appendChild(input)
   document.querySelector('.uploaded-files ol').appendChild(li)
   });
   
   uppy.on('complete', (result) => {
       $('#hideInputLog').prop('disabled', false);
       $('#labelsubmit').text('Anmeldung abschließen');
       document.getElementById('progressbarcustom').style.display = 'none';
       //  console.log('Upload complete! We’ve uploaded these files:', result.successful)
   });
   
   
   
   
   uppy2.on('upload-success', (file, response) => {
   const url = response.uploadURL
   const fileName = file.name
   const li = document.createElement('li')
   const input = document.createElement('input')
   input.type = 'hidden'
   input.value = fileName
   input.name = 'listfilenames2[]'
   input.appendChild(document.createTextNode(fileName))
   li.appendChild(input)
   document.querySelector('.uploaded-files ol').appendChild(li)
   });
   
   
   uppy2.on('complete', (result) => {
       $('#hideInputLog').prop('disabled', false);
       $('#labelsubmit').text('Anmeldung abschließen');
       document.getElementById('progressbarcustom').style.display = 'none';
       //  console.log('Upload complete! We’ve uploaded these files:', result.successful)
   });
   
   
   $('#submit-dropzone').click(() => {
   uppy.upload();
   uppy2.upload();
   });
   
</script>
<style>
   .back{    
   margin: 0 auto;
   display: block;
   background: none!important;
   border: none;
   padding: 0!important;
   color: var(--color-hellomed);
   cursor: pointer;
   line-height: 1;
   font-size: 16px;
   font-weight: 200; 
   }
   .back:hover {
   color: #5c76c7;
   }
   .for-ProgressBar {
   padding-bottom: 5px;
   }
   .uppy-ProgressBar {
   height: 10px;
   }
   .uppy-ProgressBar-inner {
   box-shadow: 0 0 0px;
   border-radius: 1000px;
   }
   .for-ProgressBar .uppy-Root {
   border:0;
   }
   .for-ProgressBar .uppy-Root:hover {
   border:0;
   }
   .for-ProgressBar .uppy-Root:focus  {
   border:0;
   }
   #Webcam-overlay{
   position: absolute;
   /* top: 2px; 
   right: 2px; */
   z-index: 100;
   max-width: 95%;
   max-height: 95%;
   /* padding: 5px; */
   object-fit: contain;
   opacity: 0.6;
   left: 0;
   right: 0;
   top: 0;
   bottom: 0;
   margin: auto;
   }
   /* .uppy-Dashboard-Item-fileInfoAndButtons{
   display: none;
   } */
   .uppy-Dashboard-Item-fileName{
   display: none;
   }
   .uppy-Dashboard-Item-status{
   display: none;
   }
   .uppy-size--height-md .uppy-Dashboard-Item {
   height: auto; 
   }
   [data-uppy-drag-drop-supported="true"] .uppy-Dashboard-AddFiles {
   border: 0px; 
   border-radius: 0px; 
   height: 100%; 
   margin: 0px;
   }
   .uppy-DashboardContent-bar {
   z-index: 4;
   }
</style>
<script>
   function ihaverezept(){
   document.getElementById('haveFile').style.display ='block';
   document.getElementById('rezepthochladen').style.display ='block';
   document.getElementById('medplanhochlade').style.display ='block';
    document.getElementById('rezeptlabel').innerHTML = 'Rezeptfoto hochladen';
     $("#Webcam-overlay").css("content","url(wp-content/themes/hellomed/assets/img/icons/onboarding/Overlay1.png)");
     $('#rezeptfoto').prop('checked', true);
   
     $('#hideInputLog').prop('disabled', true);
     $('#labelsubmit').text('Datei-Upload-Verarbeitung');
     document.getElementById('progressbarcustom').style.display = 'block';
   
   }
   
   function idonthaverezept(){
   
    $('#hideInputLog').prop('disabled', false);
     $('#labelsubmit').text('Anmeldung abschließen');
     document.getElementById('progressbarcustom').style.display = 'none';
   
   document.getElementById('haveFile').style.display = 'none';
   document.getElementById('rezepthochladen').style.display = 'none';
   document.getElementById('medplanhochlade').style.display ='none';
      $('#rezeptfoto').prop('checked', false);
      $('#eRezept').prop('checked', false);
      $('#medplan').prop('checked', false);
   }
   
   
   
   function ihavemedplan(){
   
   document.getElementById('medplanhochladen').style.display ='block';
   
    document.getElementById('medplanlabel').innerHTML = 'Medikationsplan hochladen';
   //  $("#Webcam-overlay").css("content","url(wp-content/themes/hellomed/assets/img/icons/onboarding/Overlay3.png)");
    
   
     $('#hideInputLog').prop('disabled', true);
     $('#labelsubmit').text('Datei-Upload-Verarbeitung');
   
   //  document.getElementById('progressbarcustommedplan').style.display = 'block';
   
   }
   
   function idonthavemedplan(){
   
   // console.log("idonthavemedplan");
   
   document.getElementById('medplanhochladen').style.display = 'none';
   
   
    $('#hideInputLog').prop('disabled', false);
     $('#labelsubmit').text('Anmeldung abschließen');
   
   // document.getElementById('progressbarcustommedplan').style.display = 'none';
   
   }
   
   
   
                    $(document).ready(function() {
                    $(document.body).on('click', 'button[data-cy="Webcam"]' ,function(){
                    // $('button[data-cy="Webcam"]').on("click", function () {
                    runAfterElementExists(".uppy-Webcam-videoContainer", function() {
                        $('.uppy-Webcam-videoContainer').append('<div id="Webcam-overlay"></div>');
   
   
                        runAfterElementExists(".uppy-Webcam-video", function() {
                                    var video = $(".uppy-Webcam-video" ); //JQuery selector 
        
                                    $("#Webcam-overlay").css("aspect-ratio", video[0].videoWidth+ '/' +video[0].videoHeight);
                                    // $("#Webcam-overlay").css("height",video[0].videoHeight+'px');
                                    // $("#Webcam-overlay").css("width",video[0].videoWidth+'px');
                        })
   
                        if($('#rezeptfoto').is(':checked'))
                            {
                               // console.log("rezept foto");
                                ihaveRezeptfoto();
                            }
                            else  {
                              //  console.log("erezept");
                            ihaveeRezept();
                            }
   
                            if($('#medplanRadioDefault1').is(':checked')){
                                ihaveMedplan();
                            }
                          
                        });
                    });
                    })
   
   
   
   function runAfterElementExists(jquery_selector,callback){
    var checker = window.setInterval(function() {
     if ($(jquery_selector).length) {
        clearInterval(checker);
        callback();
        }}, 200); 
   }
   
   function ihaveRezeptfoto(){
   document.getElementById('rezepthochladen').style.display ='block';
    document.getElementById('rezeptlabel').innerHTML = 'Rezeptfoto hochladen';
     $("#Webcam-overlay").css("content","url(wp-content/themes/hellomed/assets/img/icons/onboarding/Overlay1.png)");
   }
   function ihaveeRezept(){
   document.getElementById('rezepthochladen').style.display ='block';
   document.getElementById('rezeptlabel').innerHTML = 'e-Rezept hochladen';
    $("#Webcam-overlay").css("content","url(wp-content/themes/hellomed/assets/img/icons/onboarding/Overlay2.png)");
   
   }
   function ihaveMedplan(){
   //   document.getElementById('rezepthochladen').style.display ='block';
   //   document.getElementById('rezeptlabel').innerHTML = 'Medplan hochladen';
    $("#Webcam-overlay").css("content","url(wp-content/themes/hellomed/assets/img/icons/onboarding/Overlay3.png)");
   }
                     
   
   
   
   // function idonthaverezept(){
   // }
   
   function birthdaySelected(){
   document.getElementById('birthdaylabel').innerHTML = 'tt.mm.jjjj';
   }
   function birthdaySelectedBlur(){
   document.getElementById('birthdaylabel').innerHTML = 'Was ist Ihr Geburtsdatum?';
   }
   function startdatumSelected(){
   document.getElementById('startdatumlabel').innerHTML = 'tt.mm.jjjj';
   }
   function startdatumSelectedBlur(){
   document.getElementById('startdatumlabel').innerHTML = 'Was ist Ihr Wunsch-Startdatum?';
   }
   
   
   
   
   
   
   
   
   // Example starter JavaScript for disabling form submissions if there are invalid fields
   (function () {
   'use strict'
   
   // Fetch all the forms we want to apply custom Bootstrap validation styles to
   var forms = document.querySelectorAll('.needs-validation')
   
   // Loop over them and prevent submission
   Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
   
        form.classList.add('was-validated')
      }, false)
    })
   })()
   
   
   
   
   
</script>
<script>
   var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
   var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
   return new bootstrap.Tooltip(tooltipTriggerEl)
   })
</script>
<style>
   .uppy-Root {
   /* border: none; */
   /* background-color: transparent;
   display: flex;
   flex-wrap: wrap;
   justify-content: center;
   align-content: center; */
   border: 2px dashed #40404652;
   border-radius: 0.375rem;
   }
   .uppy-Root:hover, .uppy-Root:focus {
   border: 2px dashed var(--color-hellomed);
   }
</style>
<?php } 
   else { ?>
<?php header("Refresh:0; url=/anmelden"); 
   }
   
   ?>