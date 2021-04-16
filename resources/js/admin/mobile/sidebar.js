import {renderForm, renderTable} from './crud.js'

const sidebarsSections = document.querySelectorAll(".section-sidebar");
const table = document.getElementById("table");
const form = document.getElementById("form");




sidebarsSections.forEach(sidebarSection => {

    sidebarSection.addEventListener("click", ()=>{

        let url = sidebarSection.dataset.url;

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
