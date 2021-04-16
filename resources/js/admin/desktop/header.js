import {renderForm, renderTable} from './crud.js'

const sectionsTitles = document.querySelectorAll(".section-title");
const sidebars = document.querySelectorAll(".sidebar");
const table = document.getElementById("table");
const form = document.getElementById("form");
const sectionsBox = document.querySelectorAll(".sections-box");

sectionsBox.forEach(sectionsBox=>{
    sectionsBox.addEventListener("click", ()=>{

        sidebars.forEach(sidebar =>{
            if (sidebar.classList != "sidebar active"){
                sidebar.classList.add("active");
                content.classList.add("transparent");
            }

            else{
                sidebar.classList.remove("active");
                content.classList.remove("transparent");
            }   
        })  
    });
})

content.addEventListener("click", ()=>{
    if (sidebar.classList == "sidebar active"){
        sidebar.classList.remove("active");
        content.classList.remove("transparent");
        
    }
    
});


sectionsTitles.forEach(sectionTitle => {

    sectionTitle.addEventListener("click", ()=>{
        let url = sectionTitle.dataset.url;

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


