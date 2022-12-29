
  let data;
  
  function fetchData() {
      fetch('wp-content/themes/hellomed/assets/json/insurances.json')
          .then(response => response.json())
          .then(responseData => {
              data = responseData;
               console.log(data);
          });
  }
  
//   $('#txt-search').keyup(function(){
//     $('.next').prop('disabled', true);
//     var searchField = $(this).val();
//     if(searchField === '')  {
//       $('#filter-records').html('');
//       return;
//     }
//     var regex = new RegExp(searchField, "i");
//     var output = '';
//     $.each(data, function(key, val){
//       var fullname = val.name;
//       if ((fullname.search(regex) != -1)) {
//         output += '<li class="li-search">'+ val.name +'</li>';
//       }
//     });
//     $('#filter-records').html(output);
// });

// $(document).on("click", ".li-search", function () {
//   $("#txt-search").val($(this).html());
//   setFormFields($(this).attr("id"));
//   $("#filter-records").html("");
//   $(".next").prop("disabled", false);
// });
  

  
//   function search() {
//       console.log('search called');
//       const searchTerm = this.value;
  
//       // Reset the search results if the search term is empty
//       if (searchTerm === '') {
//           document.querySelector('#insurance-options').innerHTML = '';
//           return;
//       }
  
//       // Show all results that include the search term
//       const searchResults = data.filter(company => company.name.toLowerCase().includes(searchTerm.toLowerCase()));
  
//       document.querySelector('#insurance-options').innerHTML = '';
//       searchResults.forEach(result => {
//           const option = document.createElement('option');
//           option.value = result.name;
//           document.querySelector('#insurance-options').appendChild(option);
//       });
//   }
  
  window.addEventListener('load', fetchData);

//   document.querySelector('.insurance_company').addEventListener('input', search); 


$('#krankenversicherung').keyup(function(){
    var searchField = $(this).val();
    if(searchField === '')  {
        $('#filter-records').html('');
        return;
    }
    
    var regex = new RegExp(searchField, "i");
    var output = '<div class="row">';
    var count = 1;
      $.each(data, function(key, val){
        if ((val.type.search(regex) != -1) || (val.name.search(regex) != -1)) {
        
          
        output += '<div class="row">';
          if(val.logo != null){
          output += '<div class="col-md-3"><img class="img-search" src="/wp-content/themes/hellomed/assets/img/icons/insurance/'+val.logo+'" alt="'+ val.name +'"></div>';
            }
          output += '<div class="col-md-9">';
          output += '<h5 class="li-search">' + val.name + '</h5>';
          output += '</div>';
          output += '</div>';
        }
      });
      output += '</div>';
      $('#filter-records').html(output);
});

$(document).on("click", ".li-search", function () {
    $("#krankenversicherung").val($(this).html());
    setFormFields($(this).attr("id"));
    $("#filter-records").html("");
    // $(".next").prop("disabled", false);
  });