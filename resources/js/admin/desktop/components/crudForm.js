
/***************************************************************************************************/
/**Funciones:
    Renderizar formulario
    Enviar contenido del formulario a la base de datos. Al enviar los datos no se van del formulario
    Limpiar el formulario para meter una nueva entrada 
/****************************************************************************************************/
import {renderTable} from './crudTable.js'
import { renderCkeditor } from "./ckeditor";
import { spinner } from "./spinner";
import {message} from './message.js'
import { switchButtonClick } from "./switch-button";

const table = document.getElementById("table");
const form = document.getElementById("form");

/*******Renderiza el formulario*******/
export let renderForm = () =>{

    let forms = document.querySelectorAll(".admin-form");
    let labels = document.getElementsByTagName('label');
    let inputs = document.querySelectorAll('.input')
    let saveButton = document.getElementById("save-button");
    let newEntrance = document.querySelector('.new-entrance-button');

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

    /*******Envia los datos a la base de datos*******/
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

                spinner();
                try { 
                    await axios.post(url, data).then(response => {  
                        form.id.value = response.data.id;
                        table.innerHTML = response.data.table;
                        
                        //message("success", response.data.message)

                        renderTable();
                        
                    });
                 
                } catch (error) {
                    message(error);
                }
            };

            sendPostRequest();
        });
    });

    renderCkeditor();


    /*******Limpia el formulario*******/
    newEntrance.addEventListener('click', () =>{

        let url = newEntrance.dataset.url;
        console.log(url)

        let cleanForm = async () =>{
            try { 
                await axios.get(url).then(response => { 
                    form.innerHTML = response.data.form;
                    renderForm();
                });
                    
            } catch (error) {
                console.error(error);
            }
        };
        cleanForm();
    });

    switchButtonClick();
    
}

renderForm();


