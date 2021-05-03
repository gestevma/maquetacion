import {swipeRevealItem} from './swipe';
import { showForm } from './bottombarMenu';
import {scrollWindowElement} from './verticalScroll';


const table = document.getElementById("table");
const form = document.getElementById("form");
const alert = document.querySelector(".alert")


export let renderTable = () => {
    let swipeRevealItemElements = document.querySelectorAll('.swipe-element');
    swipeRevealItemElements.forEach(swipeRevealItemElement => {

        new swipeRevealItem(swipeRevealItemElement);

    });

    new scrollWindowElement(table);

    
}



export let editElement = (url) => {
    

    let sendEditRequest = async () => {

        try {
            await axios.get(url).then(response => {
                form.innerHTML = response.data.form;
                showForm();
                renderForm();
            });
            
        } catch (error) {
            console.error(error);
        }
    };

    
    sendEditRequest();
    table.classList.add("inactive");
}

export let removeElement = (url) => {
    
    let sendRemoveElement = async () => { 

        try { 
            await axios.delete(url).then(response => { 
                table.innerHTML = response.data.table;
                renderTable();
            });
                    
        } catch (error) {
            console.error(error);
        }
    };
    
    sendRemoveElement();
}

export let pagination = (url) => {

    console.log("hola")

    let paginateTable = async () =>{
        try { 
            await axios.get(url).then(response => { 
                table.insertAdjacentHTML("beforeend", response.data.table);
                document.querySelector('.table-container').dataset.current=url;
                renderTable();
                //Para poder añadir las siguientes paginaciones hace falta cambiar la url para que sepa en que pagina estamos
                //Sino siempre detectará que estamos en la página 1 (La url es la de la pagina 1), la url por defecto es la de la pagina 1

                //Lo siguiente es pedirle a la BD si hay más "row" (si hay más datos). Si no hubiese quiero que no me deje ir para arriba.
                //Si hay más datos quiero que me los muestre
                //nextPage = currentPage+1
                //Al final le dices con replace que cambie el número de la url por el de current page
            });
                
        } catch (error) {
            console.error(error);
        }
    };
    paginateTable();

    
}



renderTable()

