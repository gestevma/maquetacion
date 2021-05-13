export let languages = ()=>{

    let languageParts = document.querySelectorAll(".language-part");
    let languageSections = document.querySelectorAll(".language-section");

    languageParts.forEach(languagePart => {

        languagePart.addEventListener("click", () =>{

            let activeLanguages = document.querySelectorAll(".language-active");
            let languages = document.querySelectorAll(".language");

            activeLanguages.forEach(activeLanguage =>{
                activeLanguage.classList.remove("language-active");
            }); 

            languagePart.classList.add("language-active");

            languages.forEach(language =>{
                if (language.dataset.part==languagePart.dataset.part){
                    language.classList.add("language-active")
                }
            })

            languageSections.forEach(languageSection => {

                languageSection.classList.remove("active")

                if (languagePart.dataset.part==languageSection.dataset.part){
                    languageSection.classList.add("active")
                }
               
            });

        }); 

    });   

}