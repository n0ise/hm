/*******************************************************************************
 * this was the original code, working but trying a new approach
 *
 */
 
// var url = '/wp-content/themes/hellomed/assets/php/test_api.php';
// fetch(url, {
//   method: 'GET'
// })
// .then((res) => res.json())
// .then((data) => {
//   console.log(data);
    
// Declaring variables for the loader and the container in os-medikationsplan
const loader = document.querySelector('.loading-logo');
const container = document.querySelector('.hm-medplan-wrapper');
container.style.display = "none";
loader.style.display = "block";


/******* NEW APPROACH *******/

// taking the variable from the php file and using it in the js file
const response = JSON.parse(apiResponse);
console.log(response);

// sample output from json 
//   [
//     {
//         "pzn": "766759",
//         "medication": "Ramipril 1A Pharma Tab 5mg     1 A PHARMA GMBH               TAB",
//         "description": "",
//         "stock": "0",
//         "coverage": "2022-12-08",
//         "agent": "Ramipril",
//         "hint": "Mit 1 Gl..Wasser vor,zum o.nach d.Früh- \n stück Cave:NSAR o.Salicylate durch Pa- \n racetamol ersetzen..Kochsalz >5g/Tag. \n Alkoholtolranz herabgesetzt. Oft Schwin- \n del, Sehstörung. Cave:Desensibilisserg! \n (Soweit nicht anders verordnet)",
//         "image": "timages/900001232.jpg",
//         "doctor": {
//             "salutation": "Herr",
//             "title": "Dr. med.",
//             "firstname": "Matthias /Dirk",
//             "lastname": null,
//             "phone": "",
//             "mobile": "",
//             "fax": "",
//             "email": ""
//         },
//         "dosages": [
//             {
//                 "date": "2022-12-23",
//                 "time": "19:00",
//                 "timeHint": "abends",
//                 "amount": "1",
//                 "hint": ""
//             }, etc........
//]

  // Create an array to store the grouped and sorted data
  
/*******************************************************************************
 * First, we create a new object structure that is easier to merge
 */

  const rewriteResponse = (object) => {
  const apiArray = object
  const newArray = []

  apiArray.forEach((med) => {
    med.dosages.forEach((dosage) => newArray.push({
      newDate: dosage.date,
      newMeds: [{
        newTime: dosage.time,
        newName: [ { name: med.medication, image: med.image, amount: dosage.amount, timeHint: dosage.timeHint } ]
      }]
    }))
  })

  return newArray
}

const newResponse = rewriteResponse(response)

console.log(newResponse)





/*******************************************************************************
* Second, we use lodash to merge all matching dates and times together
* https://stackoverflow.com/questions/42081375/lodash-group-and-populate-arrays
*/

const desiredResponse = _(newResponse).groupBy('newDate').map((items, date) => {
  return {
    day: date,
    med: _(items).flatMap('newMeds').groupBy('newTime').map((items, time) => {
      return {
        time: time,
        names: _.flatMap(items, 'newName')
      }
    }).value().sort((t1, t2) => t1.time.substring(0, 2) - t2.time.substring(0, 2))
  }
}).value().sort((d1, d2) => new Date(d1.day) - new Date(d2.day))

console.log('desiredResponse')
console.log(desiredResponse)





/*******************************************************************************
* Third, we render the new object to the DOM
*/

// declaring the month, formatting it & render
const monthYear = new Intl.DateTimeFormat('de-DE', { month: 'long', year: 'numeric' }).format(new Date());
document.querySelector('.hm-medplan-calendar-weeks > div:nth-child(2)').textContent = monthYear;

let currentStart = 0;
const daysPerPage = 7;

const nextButton = document.querySelector('.hm-medplan-calendar-weeks-next');
nextButton.addEventListener('click', () => {
    currentStart += daysPerPage;
    if(currentStart >= desiredResponse.length){
        currentStart = 0;
    }
    if(currentStart > 0) {
        prevButton.classList.remove('is-inactive');
    }
    if(currentStart === 0) {
        nextButton.classList.add('is-inactive');
    }else{
        nextButton.classList.remove('is-inactive');
    }
    if(currentStart+daysPerPage >= desiredResponse.length){
        nextButton.classList.add('is-inactive');
    }else{
        nextButton.classList.remove('is-inactive');
    }
    const end = currentStart + daysPerPage;
    const desiredResponseSlice = desiredResponse.slice(currentStart, end);
    updateCalendar(desiredResponseSlice);
});

const prevButton = document.querySelector('.hm-medplan-calendar-weeks-prev');
prevButton.addEventListener('click', () => {
    currentStart -= daysPerPage;
    if(currentStart < 0) {
        currentStart = 0;
    }
    if(currentStart === 0){
        prevButton.classList.add('is-inactive');
        nextButton.classList.remove('is-inactive');
    }else{
        prevButton.classList.remove('is-inactive');
    }
    if(currentStart+daysPerPage >= desiredResponse.length){
        nextButton.classList.add('is-inactive');
    }else{
        nextButton.classList.remove('is-inactive');
    }
    const end = currentStart + daysPerPage;
    const desiredResponseSlice = desiredResponse.slice(currentStart, end);
    updateCalendar(desiredResponseSlice);
});



function updateCalendar(desiredResponseSlice){
    const daysContainer = document.querySelector('.hm-medplan-calendar-days');
    daysContainer.innerHTML = ""; // Clear any existing days
    desiredResponseSlice.forEach((entry) => {
  const html = `
    <div class="hm-medplan-calendar-days-day">
      <div class="hm-medplan-calendar-days-day-name">
        ${new Intl.DateTimeFormat('de-DE', { weekday: 'short' }).format(new Date(entry.day))}
      </div>
      <div class="hm-medplan-calendar-days-day-number">
        ${new Intl.DateTimeFormat('de-DE', { day: '2-digit' }).format(new Date(entry.day))}
      </div>
    </div>
  `

  document.querySelector('.hm-medplan-calendar-days').insertAdjacentHTML('beforeend', html)
})
desiredResponse.forEach((entry) => {

  let html = `<div class="hm-medplan-day">`

  entry.med.forEach((cur) => {
    html += `<div class="hm-medplan-time">`
    html += `<div class="hm-medplan-daytime"><i class="bi bi-alarm"></i> ${cur.time}</div>`
    cur.names.forEach((cur) => {
      const arr = cur.name.split(/(\s+\s+)/) // Split string after two spaces into three parts
      html += `
        <div class="hm-medplan-pill" data-bs-toggle="modal" data-bs-target="#exampleModal" data-time-hint="${cur.timeHint}" data-image="${cur.image}" data-amount="${cur.amount}" data-name="${arr[0]}">
          <div>
            <span>${arr[2]}</span>
            ${arr[0]}
          </div>
          <div>
            <span>Menge</span>
            ${cur.amount}

          </div>
          <i class="bi bi-question text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="${cur.timeHint}"></i>

          <i class="bi bi-arrow-right"></i>
        </div>
      `
    })

    html += `</div>`
  })
  // hiding loader after rendering, and showing the container
  loader.style.display = "none";
  container.style.display = "block";
  //
  html += `</div>`

  document.querySelector('.hm-medplan-wrapper').insertAdjacentHTML('beforeend', html)

  // initiate tooltip 
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
 

  const pills = document.querySelectorAll('.hm-medplan-pill');
    pills.forEach(pill => {
      pill.addEventListener('click', event => {
        const timeHint = event.target.closest('.hm-medplan-pill').dataset.timeHint;
        const name = event.target.closest('.hm-medplan-pill').dataset.name;
        const amount = event.target.closest('.hm-medplan-pill').dataset.amount;
        const image = event.target.closest('.hm-medplan-pill').dataset.image;
        const img = document.querySelector('.modal-img img');
          if(!image || image === "" || image === "timages/") {
          // placeholder in case there is no image, empty or it is just the prefix timages/ with no filename 
            img.src = `https://images.unsplash.com/photo-1628771065518-0d82f1938462?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=400&q=80`;
          }
          else{
            // complete url to image https://deutsche-blister.de/intern/timages/900005618.jpg
            // image from api is timages/900005618.jpg
            img.src = `https://deutsche-blister.de/intern/` + image;
          }
    
        document.querySelector('.modal-time-hint').textContent = timeHint;
        document.querySelector('.modal-title').textContent = name;
        document.querySelector('.modal-amount').textContent = amount;
      });
    });

});



/*******************************************************************************
* Fourth, we give the tabs some functionallity
*/

const tabs = document.querySelectorAll('.hm-medplan-calendar-days-day')
const days = document.querySelectorAll('.hm-medplan-day')

tabs.forEach((cur, i) => {
  cur.addEventListener('click', () => {
    const prev = [...tabs, ...days]
    const next = [cur, days[i]]

    prev.forEach((el) => el.classList.remove('active'))
    next.forEach((el) => el.classList.add('active'))
  })
})
tabs[0].click()
}
updateCalendar(desiredResponse.slice(0,daysPerPage));

