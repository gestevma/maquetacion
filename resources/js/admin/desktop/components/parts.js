export let parts = () => {

    const parts = document.querySelectorAll(".part");
    const partsSections = document.querySelectorAll(".part-section")


    parts.forEach(part =>{
        part.addEventListener("click", () =>{

            partsSections.forEach(PartSection =>{

                PartSection.classList.remove("active");
                
                if (PartSection.dataset.part==part.dataset.part){
                    PartSection.classList.add("active");
                }
            })        

        })
    })
}