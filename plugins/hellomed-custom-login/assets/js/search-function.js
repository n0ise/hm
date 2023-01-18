
  let data;
  
  function fetchData() {
      fetch('wp-content/themes/hellomed/assets/json/insurances.json')
          .then(response => response.json())
          .then(responseData => {
              data = responseData;
              //  console.log(data);
          });
  }
  
  window.addEventListener('load', fetchData);

$('#krankenversicherung').keyup(function(){
    var searchField = $(this).val();
    if(searchField === '')  {
        $('#filter-records').html('');
        return;
    }
    
    var regex = new RegExp(searchField, "i");
    var output = ' <ul class="hm-autocomplete">';
    var count = 1;
      $.each(data, function(key, val){
        if ((val.type.search(regex) != -1) || (val.name.search(regex) != -1)) {
        output += '<li class="hm-autocomplete-item li-search">';
        output += '<div class="hm-autocomplete-img">';
          if(val.logo != null){
          output += '<img src="/wp-content/themes/hellomed/assets/img/icons/insurance/'+val.logo+'" alt="'+ val.name +'">';
            }
          output += '</div>';
          output += '<div class="hm-autocomplete-name">';
          output += val.name;
          output += '</div>';
          output += '</li>';
        }
      });
      output += '</ul>';
      $('#filter-records').html(output);
});

$(document).on("click", ".li-search", function () {
    $("#krankenversicherung").val($(this).text());
    $("#filter-records").html("");
    // $(".next").prop("disabled", false);
  });