<?php /* Template Name: Os Hilfe */ ?>

<!-- include_once header.php from template  -->
<?php include_once('os-header.php'); ?>

<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in()) { ?>

    <main>
  <div class="container">
    <div class="hm-content">

      <div class="h2 mb-5">FAQ & Hilfe</div>
      <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              Accordion Item #1
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores amet numquam, dicta sit quod cum ipsa, dolor, cumque doloremque iste maxime. Earum voluptate, esse quasi laboriosam quae sit numquam eveniet!
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
              Accordion Item #2
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores amet numquam, dicta sit quod cum ipsa, dolor, cumque doloremque iste maxime. Earum voluptate, esse quasi laboriosam quae sit numquam eveniet!
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="flush-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
              Accordion Item #3
            </button>
          </h2>
          <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores amet numquam, dicta sit quod cum ipsa, dolor, cumque doloremque iste maxime. Earum voluptate, esse quasi laboriosam quae sit numquam eveniet!
            </div>
          </div>
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