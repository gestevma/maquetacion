/*Función->Cambia la vista de grupo productos a producto individual*/
import { renderComponents} from './components';


export let renderProducts = () =>{
    let productBoxes = document.querySelectorAll(".product-box");
    let grid = document.querySelector(".grid");

    productBoxes.forEach(productBox => {

        productBox.addEventListener("click", () =>{
        
            let url = productBox.dataset.url;

            let showProduct = async () => {

                try {
                    await axios.get(url).then(response => { 
                        console.log(response.data.product);
                        grid.innerHTML = response.data.product;
                        window.history.pushState('','',url);
                        renderComponents();
                    });

                } catch (error) {  
    
                }
            }
            showProduct();
        }); 
    });
}



