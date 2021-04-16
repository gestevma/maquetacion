const parts = document.querySelectorAll(".part");
const formParts = document.querySelectorAll(".form-part-section")

parts.forEach(part =>{
    part.addEventListener("click", () =>{

        formParts.forEach(formPart =>{
            formPart.classList.remove("active")
            
            if (formPart.dataset.part==part.dataset.part){
                formPart.classList.add("active")
            }
        })        

    })
})