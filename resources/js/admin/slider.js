import {renderForm, renderTable} from './crud.js'

const slidersSections = document.querySelectorAll(".section-slider");
const table = document.getElementById("table");
const form = document.getElementById("form");




slidersSections.forEach(sliderSection => {

    sliderSection.addEventListener("click", ()=>{

        let url = sliderSection.dataset.url;

        let links = async () => { 
    
            try { 
                await axios.get(url).then(response => { 
                    table.innerHTML = response.data.table;
                    form.innerHTML = response.data.form;
                    renderForm();
                    renderTable();
                });
                 
            } catch (error) {
                console.error(error);
            }
        };

        links();
    })

})
