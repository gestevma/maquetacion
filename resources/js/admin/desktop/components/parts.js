import { partial } from "lodash";

export let parts = () => {

    const parts = document.querySelectorAll(".part");
    const partsSections = document.querySelectorAll(".part-section")

    parts.forEach(part =>{
        
        part.addEventListener("click", () =>{
            
            part.classList.add("active");
            partsSections.forEach(PartSection =>{

                PartSection.classList.remove("active");
                
                if (PartSection.dataset.part==part.dataset.part){
                    PartSection.classList.add("active");
                }
            })        

        })
    })

}