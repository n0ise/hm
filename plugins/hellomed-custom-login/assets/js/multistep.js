
  var step = 1;
  $(document).ready(function () { stepProgress(step); });
  
  $(".next").on("click", function () {

  
    var nextstep = false;
  
    if (step == 1) {

      nextstep = checkForm("step1");
    } 
    
    else if (step == 2) {
   
      nextstep = checkForm("step2");
    } 
    
    else if (step == 3) {
      nextstep = checkForm("step3");
    } 
    
    else if (step == 4) {
      nextstep = checkForm("step4");
    } 
  
    else {
      nextstep = true;
      }
  
    if (nextstep == true) {
      if (step < $(".step").length) {
        $(".step").show();
        $(".step")
          .not(":eq(" + step++ + ")")
          .hide();
        stepProgress(step);
      }
     //hideButtons(step);
    }
  });

  // ON CLICK BACK BUTTON
$(".back").on("click", function () {
  if (step == 2) {
    step = step - 2;
    $(".next1").trigger("click");
  }
  else if(step == 3) {
    step = step - 2;
    $(".next2").trigger("click");
  }
  else{
    step = step - 2;
    $(".next3").trigger("click");
  }
   //hideButtons(step);
});


 // ON CLICK BACK BUTTON
  // $(".back").on("click", function () {
  //   console.log(step);
  //   if (step > 0) {
  //     console.log("hyri");
  //     step = step - 2;
  //     console.log(step);
  //     $(".next").trigger("click");
  //   }
  //   // hideButtons(step);
  // });
  
  // CALCULATE PROGRESS BAR
  stepProgress = function (currstep) {
    var percent = parseFloat(100 / $(".step").length) * currstep;
    percent = percent.toFixed();
    $(".progress-bar")
      .css("width", percent + "%")
      .html("Schritt " + step + "/" + $(".step").length);
  };
  

  //DISPLAY AND HIDE "NEXT", "BACK" AND "SUMBIT" BUTTONS
  // hideButtons = function (step) {
  
  //   var limit = parseInt($(".step").length);
  //   $(".action").hide();
  //   if (step < limit) {
  //     $(".next").show();
  //   }
  //   if (step > 1) {
  //     $(".back").show();
  //   }
  //   if (step == limit) {
  //     $(".next").hide();
  //     $(".submit").show();
  //   }
  // };

  
  function checkForm(val) {
    // CHECK IF ALL "REQUIRED" FIELD ALL FILLED IN
    var valid = true;
    $("#" + val + " input:required").each(function () {
      if ($(this).val() === "") {
        $(this).addClass("is-invalid");
        valid = false;
      } else {
        $(this).removeClass("is-invalid");
      }
    });

    $("#" + val + " input[type='radio']:required").each(function () {
       if ($("input[name=" + $(this)[0].name + "]").is(':checked')) {
        $("#validbuttongroup").removeClass("is-invalid");
      } else {
        $("#validbuttongroup").addClass("is-invalid");
        valid = false;
      }
    });

  //   $("#" + val + " input[name='first_rezept_uploaded']").each(function () {

  //       console.log(isEmpty(".uploaded-files ol"));

  //     if ($("input#flexRadioDefault2").is(':checked') && $("#uploaded-files ol li").length == 0 ) {
  //       console.log("checked");
  //      $("#rezeptlabel").removeClass("is-invalid");
  //    } else {
  //     console.log("not valid");
  //      $("#rezeptlabel").addClass("is-invalid");
  //      valid = false;
  //    }

  //  });


    return valid;
  }
  

  function isEmpty(tag) {
    return document.querySelector(tag).innerHTML.trim() == ""
  }
  
    // DATE PICKER

  $(function(){
    $('#birthdaypicker').datepicker({
        format: 'dd.mm.yyyy',
        weekStart: 1,
        autoclose: true,
        startDate: '01.01.1900',
        endDate: '0',
        maxViewMode: 'century',
        startView: 'century',
        language: 'de-DE',
        defaultViewDate:'01.01.1900',
        assumeNearbyYear: true,
        toggleActive: true
    });
    });

    $(function(){
      $('#startdatumpicker').datepicker({
          format: 'dd.mm.yyyy',
          weekStart: 1,
          autoclose: true,
          startDate: '+7d',
          defaultViewDate:'+7d',
          endDate: '+1y',
          maxViewMode: 'year',
          language: 'de-DE',
          assumeNearbyYear: true,
          toggleActive: true,

          beforeShowDay: function(d){
            if( d.getDate() === 1 || d.getDate() === 15){
              return true;
            }
            return false;
          },






      });
      });


