const save = document.getElementById("save");
const forms = document.querySelectorAll(".admin-form");
const labels = document.getElementsByTagName('label');
const inputs = document.querySelectorAll('.input')
const saveButton = document.getElementById("save-button");

/*save.addEventListener("click", (event)=>{

    event.preventDefault();

    forms.forEach(form=>{
        const formId=document.getElementById(form.id);
        const data = new FormData(formId);

        for (var pair of data.entries()){
           console.log(pair[0]+": "+pair[1]); 
 
        
        }
    });
    
      
});*/

/*inputs.forEach(input => {

    input.addEventListener('focusin', () => {

        for( var i = 0; i < labels.length; i++ ) {
            if (labels[i].htmlFor == input.name){
                labels[i].classList.add("active");
            }
        }
    });

    input.addEventListener('blur', () => {

        for( var i = 0; i < labels.length; i++ ) {
            labels[i].classList.remove("active");
        }
    });
});*/

saveButton.addEventListener("click", (event) => {

    event.preventDefault();

    forms.forEach(form => { 
        
        let data = new FormData(document.getElementById(form.id));
        let url = form.action;

        let sendPostRequest = async () => {

            try {
                let response = await axios.post(url, data).then(response => {
                    form.innerHTML = response.data.form;
                    console.log('2');
                });
                 
            } catch (error) {
                console.error(error);
            }
        };

        sendPostRequest();

        console.log('1');
    });
});

