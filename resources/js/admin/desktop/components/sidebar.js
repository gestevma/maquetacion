import { renderForm } from "./crudForm";
import { renderTable } from "./crudTable";

const sidebarSections = document.querySelectorAll(".section-sidebar");
const table = document.getElementById("table");
const form = document.getElementById("form");



export let sidebar = ()=>{ 
    sidebarSections.forEach(sidebarSection => {

        sidebarSection.addEventListener("click", ()=>{

            let url = sidebarSection.dataset.url;

            let links = async () => { 
        
                try { 
                    await axios.get(url).then(response => { 
                        table.innerHTML = response.data.table;
                        form.innerHTML = response.data.form;
                        window.history.pushState('','',url);
                        renderTable();
                        renderForm();

                    });
                    
                } catch (error) {
                    console.error(error);
                }
            };

            links();
        })

    })
    

}

sidebar()