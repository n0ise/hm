const response = {
  "medications": [
    {
      "medication": "Aspirin",
      "dosages": [
        { "date": "2022-10-31", "time": "09:00" },
        { "date": "2022-11-02", "time": "09:00" },
        { "date": "2022-11-04", "time": "09:00" },
        { "date": "2022-11-06", "time": "09:00" }
      ]
    },
    {
      "medication": "Paracetamol",
      "dosages": [
        { "date": "2022-10-31", "time": "13:00" },
        { "date": "2022-11-01", "time": "15:00" },
        { "date": "2022-11-03", "time": "15:00" },
        { "date": "2022-11-04", "time": "13:00" },
        { "date": "2022-11-06", "time": "13:00" }
      ]
    },
    {
      "medication": "Ibuprofen",
      "dosages": [
        { "date": "2022-10-31", "time": "19:00" },
        { "date": "2022-11-01", "time": "20:00" },
        { "date": "2022-11-02", "time": "19:00" },
        { "date": "2022-11-03", "time": "20:00" },
        { "date": "2022-11-04", "time": "19:00" },
        { "date": "2022-11-05", "time": "20:00" },
        { "date": "2022-11-06", "time": "19:00" }
      ]
    },
    {
      "medication": "Vicodin",
      "dosages": [
        { "date": "2022-10-31", "time": "09:00" },
        { "date": "2022-10-31", "time": "13:00" },
        { "date": "2022-10-31", "time": "19:00" },
        { "date": "2022-11-01", "time": "13:00" },
        { "date": "2022-11-01", "time": "19:00" },
        { "date": "2022-11-02", "time": "13:00" },
        { "date": "2022-11-02", "time": "19:00" },
        { "date": "2022-11-03", "time": "09:00" },
        { "date": "2022-11-03", "time": "13:00" },
        { "date": "2022-11-04", "time": "09:00" },
        { "date": "2022-11-04", "time": "13:00" },
        { "date": "2022-11-04", "time": "19:00" },
        { "date": "2022-11-05", "time": "13:00" },
        { "date": "2022-11-05", "time": "19:00" },
        { "date": "2022-11-06", "time": "09:00" },
        { "date": "2022-11-06", "time": "13:00" },
        { "date": "2022-11-06", "time": "19:00" }
      ]
    }
  ]
}





/*******************************************************************************
* This is the data structure we recive from the API
*
* {
*   "medications": [
*     {
*       "medication": "Aspirin",
*       "dosages": [
*         { "date": "2022-10-31", "time": "09:00" },
*         { "date": "2022-10-17", "time": "19:00" },
*         { "date": "2022-11-01", "time": "09:00" },
*         { "date": "2022-11-01", "time": "19:00" }
*       ]
*     },
*     {
*       "medication": "Paracetamol",
*       "dosages": [
*         { "date": "2022-10-31", "time": "09:00" },
*         { "date": "2022-10-31", "time": "19:00" },
*         { "date": "2022-11-01", "time": "09:00" },
*         { "date": "2022-11-01", "time": "19:00" }
*       ]
*     }
*   ]
* }
*/





/*******************************************************************************
* This is the data structure we need for the UI
*
* [
*   {
*     day: '2022-10-31',
*     med: [
*       { time: '9:00', names: ['Aspirin', 'Paracetamol'] },
*       { time: '19:00', names: ['Aspirin', 'Paracetamol'] }
*     ]
*   },
*   {
*     day: '2022-11-01',
*     med: [
*       { time: '9:00', names: ['Aspirin', 'Paracetamol'] },
*       { time: '19:00', names: ['Aspirin', 'Paracetamol'] }
*     ]
*   }
* ]
*/





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
        newName: [med.medication]
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

desiredResponse.forEach((entry) => {
  document.querySelector('.medplan-tabs').insertAdjacentHTML('beforeend', `<div class="medplan-tab"><div class="medplan-tab-day">Mo</div><div class="medplan-tab-date">${new Intl.DateTimeFormat('de-DE', { day: '2-digit', month: '2-digit' }).format(new Date(entry.day))}</div></div>`)
})

desiredResponse.forEach((entry) => {
  let html = `<div class="medplan-day">`

  html += `<h2>${new Intl.DateTimeFormat('de-DE', { day: '2-digit', month: '2-digit' }).format(new Date(entry.day))}</h2>`

  entry.med.forEach((cur) => {
    html += `
      <p><b>${cur.time}</b></p>
      <p>${cur.names.join(', ')}</p>
    `
  })

  html += `</div>`

  document.querySelector('.content').insertAdjacentHTML('beforeend', html)
})





/*******************************************************************************
* Fourth, we give the tabs some functionallity
*/

const tabs = document.querySelectorAll('.medplan-tab')
const days = document.querySelectorAll('.medplan-day')

tabs.forEach((cur, i) => {
  cur.addEventListener('click', () => {
    const prev = [...tabs, ...days]
    const next = [cur, days[i]]

    prev.forEach((el) => el.classList.remove('active'))
    next.forEach((el) => el.classList.add('active'))
  })
})

tabs[0].click()
