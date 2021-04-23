import { renderCkeditor } from "./ckeditor";

const table = document.getElementById("table");
const form = document.getElementById("form");


/************************** Form ********************************************/
export let renderForm = () =>{

    let forms = document.querySelectorAll(".admin-form");
    let labels = document.getElementsByTagName('label');
    let inputs = document.querySelectorAll('.input')
    let saveButton = document.getElementById("save-button");

    inputs.forEach(input => {

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
    });


    saveButton.addEventListener("click", (event) => {

        event.preventDefault();

        forms.forEach(form => { 

            let data = new FormData(form);

            if( ckeditors != 'null'){

                Object.entries(ckeditors).forEach(([key, value]) => {
                    data.append(key, value.getData());
                });
            }

            let url = form.action;

            let sendPostRequest = async () => { 

                try { 
                    await axios.post(url, data).then(response => {  
                        form.id.value = response.data.id;
                        table.innerHTML = response.data.table;
                        renderTable();
                    });
                 
                } catch (error) {
                    console.error(error);

                }
            };

            sendPostRequest();
        });
    });

    renderCkeditor();
}

/************************** Table ********************************************/
export let renderTable = () => {
    let editButtons = document.querySelectorAll(".edit-buttons");
    let eliminateButtons = document.querySelectorAll(".eliminate-buttons");
    

    editButtons.forEach(editButton => {

        editButton.addEventListener('click', () => {
    
            let url = editButton.dataset.url;
    
            let editTable = async () => { 
    
                try { 
                    await axios.get(url).then(response => { 
                        form.innerHTML=response.data.form;
                        renderForm(); 
                         
                    });
                     
                } catch (error) {
                    console.error(error);
                }
            };
    
            editTable();
    
        });
    });
    
    eliminateButtons.forEach(eliminateButton => {
    
        eliminateButton.addEventListener('click', () => {
            
    
            let url = eliminateButton.dataset.url;
    
            let deleteTable = async () => { 
    
                try { 
                    await axios.delete(url).then(response => { 
                        table.innerHTML = response.data.table;
                        renderTable();
                    });
                     
                } catch (error) {
                    console.error(error);
                }
            };
            deleteTable();
        });
    });
    
}

export let pagination = () => {

    let paginationButtons = document.querySelectorAll(".table-pagination-button")

    paginationButtons.forEach(paginationButton => {

        paginationButton.addEventListener('click', () =>{

            let url = paginationButton.dataset.page;

            let paginateTable = async () =>{
                try { 
                    await axios.get(url).then(response => { 
                        table.innerHTML = response.data.table;
                        renderTable();
                    });
                     
                } catch (error) {
                    console.error(error);
                }
            };
            paginateTable();
        })
    })
}


renderForm()
renderTable()
pagination()