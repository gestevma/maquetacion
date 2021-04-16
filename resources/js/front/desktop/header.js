const sectionsTitles = document.querySelectorAll(".section-title");
const sidebars = document.querySelectorAll(".sidebar");
const table = document.getElementById("table");
const form = document.getElementById("form");
const sectionsBox = document.querySelectorAll(".sections-box");
const main = document.getElementById("main");

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




