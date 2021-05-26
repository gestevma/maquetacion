import {renderForm} from './crudForm.js'
import { message } from './message.js';
import {switchButtonClick} from './switch-button.js'

export let renderTable = () => {

    let editButtons = document.querySelectorAll(".edit-buttons");
    let eliminateButtons = document.querySelectorAll(".eliminate-buttons");
    let importButton = document.querySelector(".import-button");


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

    pagination();

    if (importButton){
        
        importButton.addEventListener("click", () =>{

        let url = importButton.dataset.url;

        let importTable = async () => { 
    
            try { 
                message("succes")
                await axios.get(url).then(response => { 
                    table.innerHTML = response.data.table;
                    renderTable();
                });
                 
            } catch (error) {
                console.error(error);
            }
        };
        importTable();
    });}

    
    
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

renderTable();



