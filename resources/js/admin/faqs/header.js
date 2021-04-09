import {renderForm, renderTable} from './crud.js'

const sectionsTitles = document.querySelectorAll(".section-title");
const sliders = document.querySelectorAll(".slider");
const table = document.getElementById("table");
const form = document.getElementById("form");
const sectionsBox = document.querySelectorAll(".sections-box");
const main = document.getElementById("main");

sectionsBox.forEach(sectionsBox=>{
    sectionsBox.addEventListener("click", ()=>{

        sliders.forEach(slider =>{
            if (slider.classList != "slider active"){
                slider.classList.add("active");
                content.classList.add("transparent");
            }

            else{
                slider.classList.remove("active");
                content.classList.remove("transparent");
            }   
        })  
    });
})

content.addEventListener("click", ()=>{
    if (slider.classList != "slider active"){
                slider.classList.add("active");
                content.classList.add("transparent");
            }

            else{
                slider.classList.remove("active");
                content.classList.remove("transparent");
            }   
})


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


