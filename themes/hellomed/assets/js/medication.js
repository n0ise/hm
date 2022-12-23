var url = '/wp-content/themes/hellomed/assets/php/test_api.php';

fetch(url, {
    method: 'GET'
  })
  .then((res) => res.json())
  .then((data) => {
    console.log(data);


//  loop an show PZN and medication name 


    // loop through the data and add it to the table
    for (var i = 0; i < data.medications.length; i++) {
      // and for each medication loop through the dosages

      
    // for (var i = 0; i < data.medications.dosages.length; i++) {

console.log(data.medications[i].dosages[i].date);



  const response = []

    data.medications.forEach((medication) => {
      medication.dosages.forEach((dosage) => response.push({
        newDate: dosage.date,
        newMeds: [{
          newTime: dosage.time,
          newName: [{
            name: medication.medication,
            amount: dosage.amount
          }]
        }]
      }))
      console.log('response')

      console.log(response)

    })


        const rewriteResponse = (object) => {
        const apiArray = data.medications
        const newArray = []
    
          apiArray.forEach((med) => {
            med.dosages.forEach((dosage) => newArray.push({
              newDate: dosage.date,
              newMeds: [{
                newTime: dosage.time,
                newName: [{
                  name: med.medication,
                  amount: dosage.amount
                }]
              }]
            }))
            console.log('new array')

            console.log(newArray)

          })
    
          // return newArray
        }
    
        const newResponse = rewriteResponse(response)
        console.log('new response')

        console.log(newResponse)
      
        const desiredResponse = _(response).groupBy('newDate').map((items, date) => {
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
        console.log('desiredResponse;');

        console.log(desiredResponse);
    
    
    
    
    
        /*******************************************************************************
         * Third, we render the new object to the DOM, but just the first 3 days and the rest when clicking chevron right or left
         * We also add the active class to the first tab
         * 
         * 
         */

        // render the first 3 days
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

        // add the active class to the first tab and when clicking on a new tab, remove the active class from the old tab and add it to the new tab
        document.querySelector('.hm-medplan-tab').classList.add('active')


        // render the rest of the days when clicking  class "bi-chevron-right"  
        document.querySelector('.hm-medplan-tabs-right').addEventListener('click', () => {
// make first tab active when clicking chevron right and remove active class from the last tab 
         
         


          document.querySelector('.hm-medplan-tabs').innerHTML = ''
          desiredResponse.slice(7, 14).forEach((entry) => {
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
            // make first tab active when clicking chevron right and remove active class from the last tab
            document.querySelector('.hm-medplan-tab').classList.add('active')
            // when clicking a new tab, remove the active class from the old tab and add it to the new tab
            document.querySelectorAll('.hm-medplan-tab').forEach((tab) => {
              tab.addEventListener('click', () => {
                document.querySelector('.hm-medplan-tab.active').classList.remove('active')
                tab.classList.add('active')
              })
            }
            )

          })
        })

      //  tab chevron left inactive at the beginning, but active and showing preivous days when clicking chevron left
        document.querySelector('.hm-medplan-tabs-left').addEventListener('click', () => {
          document.querySelector('.hm-medplan-tabs').innerHTML = ''
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
            document.querySelectorAll('.hm-medplan-tab').forEach((tab) => {
              tab.addEventListener('click', () => {
                document.querySelector('.hm-medplan-tab.active').classList.remove('active')
                tab.classList.add('active')
              })
            }
            )
          })
        })
        

        /*******************************************************************************
         * Fourth, we render the first day of the new object to the DOM
         * 
         * 
         * 
         * 
         * 
         */ 
         
        // render the first day
        desiredResponse[0].med.forEach((entry) => {
          const html = `
        <div class="hm-medplan-time">
          <div class="hhm-medplan-daytime bi bi-clock">
            ${entry.time}
          </div>
          <div class="hm-medplan-pills-pill ">
            ${entry.names.map((name) => name.name).join(', ')}
          </div>
          <div class="hm-medplan-time-amounts">

            ${entry.names.map((name) => name.amount).join(', ')}
          </div>
        </div>
      `
          document.querySelector('.hm-content').insertAdjacentHTML('beforeend', html)
        })

        /*******************************************************************************
         * 
         * Fifth, we render the rest of the days when clicking on the tabs
         * 
         */
      





    
    // mae the tab active when clicked 
    document.querySelectorAll('.hm-medplan-tab').forEach((tab) => {
      tab.addEventListener('click', () => {
        document.querySelectorAll('.hm-medplan-tab').forEach((tab) => {
          tab.classList.remove('active')
        })
        tab.classList.add('active')
      })
    })


      }
    }
  

);