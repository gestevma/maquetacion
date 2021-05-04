export let languages = ()=>{

    let languageParts = document.querySelectorAll(".language-part");
    let languageSections = document.querySelectorAll(".language-section");

    languageParts.forEach(languagePart => {
        languagePart.addEventListener("click", () =>{

            languageSections.forEach(languageSection => {

                languageSection.classList.remove("active")

                if (languagePart.dataset.part==languageSection.dataset.part){
                    languageSection.classList.add("active")
                }
               
            });
        });
    });   

}