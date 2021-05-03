import {renderTable} from './crudTable.js';

const table = document.getElementById("table");
const tableFilter = document.getElementById("table-filter");
const filterForm = document.getElementById("filter-form");


//3. Pegamos la función render FilterTabla
//4. Cuando lo pegues tienes que ir al controlador
export let renderFilterTable = () => {

    let table = document.getElementById("table");
    let tableFilter = document.getElementById("table-filter");
    let filterForm = document.getElementById("filter-form");

    if(filterForm != null){

        let openFilter = document.getElementById("open-filter");
        let applyFilter = document.getElementById("apply-filter");
    
        openFilter.addEventListener( 'click', () => {
            openFilter.classList.remove('button-active');
            tableFilter.classList.add('filter-active')
            applyFilter.classList.add('button-active');
        });
        
        applyFilter.addEventListener( 'click', () => {     
            
            let data = new FormData(filterForm);
            for (var pair of data.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }
            let filters = {}; //Con esto convertiremos los parametros del filtro en un json
            
            data.forEach(function(value, key){
                filters[key] = value; //Aqui le pasamos los parametros para montar el json
            });
            
            let json = JSON.stringify(filters);  //El json pasamos a texto para poderlo pasar a la url

            let url = filterForm.action;  //Pasamos el json a la url
    
            let sendPostRequest = async () => {
    
                try {
                    axios.get(url, {  //Hacemos la llamada cogiendo los parametros del json
                        params: {
                          filters: json
                        }
                    }).then(response => {  //Si funciona aplica el filtro
                        table.classList.add('table-hide');
                        table.innerHTML = response.data.table;
                        renderTable();

                        setTimeout(function(){
                            table.classList.remove('table-hide');
                        }, 500)
                        
                        tableFilter.classList.remove('filter-active')
                        applyFilter.classList.remove('button-active');
                        openFilter.classList.add('button-active');
                    });
                    
                } catch (error) {   //Sino da error
    
                }
            };
    
            sendPostRequest();
            
        });
    }
};


export let hideFilterTable = () => {

    let openFilter = document.getElementById("open-filter");

    openFilter.classList.remove('button-active');
}

export let showFilterTable = () => {

    let openFilter = document.getElementById("open-filter");

    openFilter.classList.add('button-active');
}

renderFilterTable();