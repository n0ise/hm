var url = '/wp-content/themes/hellomed/assets/php/test_api.php';
fetch(url, {
  method: 'GET'
})
.then((res) => res.json())
.then((data) => {
  console.log(data);

// sapmle output from json 
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
//             },
//             {
//                 "date": "2022-12-24",
//                 "time": "19:00",
//                 "timeHint": "abends",
//                 "amount": "1",
//                 "hint": ""
//             },
//             {
//                 "date": "2022-12-25",
//                 "time": "19:00",
//                 "timeHint": "abends",
//                 "amount": "1",
//                 "hint": ""
//             }
//]

  // Create an array to store the grouped and sorted data
  const response = data;

  // Loop through all medications and dosages
  // for (let i = 0; i < data.medications.length; i++) {
  //   const medication = data.medications[i];
  //   for (let j = 0; j < medication.dosages.length; j++) {
  //     const dosage = medication.dosages[j];

  //     // Push an object containing the relevant information to the response array
  //     response.push({
  //       newDate: dosage.date,
  //       newMeds: [{
  //         newTime: dosage.time,
  //         newName: [{
  //           name: medication.medication,
  //           amount: dosage.amount
  //         }]
  //       }]
  //     });
  //   }
  // ]

/*******************************************************************************
 * First, we create a new object structure that is easier to merge
 */

const rewriteResponse = (object) => {
  const apiArray = object.medications
  const newArray = []

  apiArray.forEach((med) => {
    med.dosages.forEach((dosage) => newArray.push({
      newDate: dosage.date,
      newMeds: [{
        newTime: dosage.time,
        newName: [ { name: med.medication, amount: dosage.amount } ]
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

console.log(desiredResponse)





/*******************************************************************************
* Third, we render the new object to the DOM
*/

desiredResponse.slice(0, 7).forEach((entry) => {
  const html = `
    <div class="hm-medplan-tab">
      <div class="hm-medplan-tab-day">
        ${new Intl.DateTimeFormat('de-DE', { weekday: 'short' }).format(new Date(entry.day))}
      </div>
      <div class="hm-medplan-tab-date">
        ${new Intl.DateTimeFormat('de-DE', { day: '2-digit', month: '2-digit' }).format(new Date(entry.day))}
      </div>
    </div>
  `

  document.querySelector('.hm-medplan-tabs').insertAdjacentHTML('beforeend', html)
})


desiredResponse.forEach((entry) => {
  let html = `<div class="hm-medplan-day">`

  html += `<h2><i class="bi bi-calendar-event"></i> ${new Intl.DateTimeFormat('de-DE', { day: '2-digit', month: '2-digit' }).format(new Date(entry.day))}</h2>`

  entry.med.forEach((cur, i) => {
    if (i === 0) html += `<div class="hm-medplan-daytime"><i class="bi bi-clock"></i> ${cur.time}</div>`
    if (i === 1) html += `<div class="hm-medplan-daytime"><i class="bi bi-clock"></i> ${cur.time}</div>`
    if (i === 2) html += `<div class="hm-medplan-daytime"><i class="bi bi-clock"></i> ${cur.time}</div>`

    html += `<div class="hm-medplan-pills">`

    cur.names.forEach((cur) => {
      html += `
        <div class="hm-medplan-pills-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <div>
            <i class="bi bi-capsule-pill"></i>
          </div>
          <div>
            ${cur.amount} × ${cur.name}
          </div>
        </div>
      `
    })

    html += `</div>`
  })

  html += `</div>`

  document.querySelector('.hm-content').insertAdjacentHTML('beforeend', html)
})





/*******************************************************************************
* Fourth, we give the tabs some functionallity
*/

const tabs = document.querySelectorAll('.hm-medplan-tab')
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

})
