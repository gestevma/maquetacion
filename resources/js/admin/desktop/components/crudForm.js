/***************************************************************************************************/
/**Funciones:
    Renderizar formulario
    Enviar contenido del formulario a la base de datos. Al enviar los datos no se van del formulario
    Limpiar el formulario para meter una nueva entrada 
/****************************************************************************************************/
import {renderTable} from './crudTable.js'
import { renderCkeditor } from "./ckeditor.js";
import { spinner } from "./spinner.js";
import {message} from './message.js';
import { languages } from './languajes.js';
import { renderUpload } from './upload.js';
import { parts } from './parts.js';
import { switchButtonClick } from './switch-button.js';
import { editSeo } from "./seo.js"
import {renderNestedSortables} from './sortable';
import {renderMenuItems} from './menuItems';
import {renderSelects} from './selects';

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
    
    if (saveButton){
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

                            if(response.data.id){
                                form.id.value = response.data.id;
                            }
                            
                            table.innerHTML = response.data.table;
                            
                            message("success")
                            renderTable();
                            
                        });
                     
                    } catch (error) {
                        message(error);
                        message("fail")
                    }
                };
    
                sendPostRequest();
            });
        });
    
    }
    renderCkeditor();


    /*******Limpia el formulario*******/
    if (newEntrance){
        newEntrance.addEventListener('click', () =>{

            let url = newEntrance.dataset.url;
    
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
    }
    

    languages();
    renderUpload();
    parts();
    switchButtonClick();
    editSeo();
    renderNestedSortables();
    renderMenuItems();
    renderSelects();

}

renderForm();


