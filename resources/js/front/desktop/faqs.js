const faqs = document.querySelectorAll(".individual-faq")
const descriptions = document.querySelectorAll(".faq-description")
const active = document.querySelectorAll(".active")

faqs.forEach(faq =>{
    
    faq.addEventListener('click', () =>{
        
        descriptions.forEach(description =>{
            description.classList.remove("active")
            if (faq.id==description.id){
                description.classList.add("active")
            }
        })
    })
});

