
export let renderShop = () =>{
    let productBoxes = document.querySelectorAll(".product-box");
    let wishes = document.querySelector(".wishes");
    let hearts=document.querySelectorAll(".heart");
    let individualProductDescription = document.querySelector(".individual-product-description");
    let more=document.querySelector(".more");
    let shopCart = document.querySelector(".shop-cart");
    let addToCart = document.querySelector(".add-to-cart");

    if (productBoxes){
        productBoxes.forEach(productBox => {

            productBox.addEventListener("mouseover", () =>{
                let productMore = productBox.querySelectorAll(".product-more");

                productMore.forEach(productMoreElement =>{
                    productMoreElement.classList.add("active");   
                })
    
            })

            productBox.addEventListener("mouseout", () =>{
                let productMore = productBox.querySelectorAll(".product-more");
                productMore.forEach(productMoreElement =>{
                    productMoreElement.classList.remove("active");   
                })
    
            })
        })
    }


    if(more){
        more.addEventListener("click", () =>{
            if (individualProductDescription.classList.contains("active")){
                individualProductDescription.classList.remove("active");
                more.innerHTML = "Leer más..."
            }
        
            else{
                individualProductDescription.classList.add("active");
                more.innerHTML="Cerrar"
            }
        });
    };


    if(shopCart){
        shopCart.addEventListener("click", () =>{
            if(shopCart.classList.contains("active")){
                shopCart.classList.remove("active");
                addToCart.innerHTML = "Añadir al carrito";
            }
        
            else{
                shopCart.classList.add("active");
                addToCart.innerHTML = "Producto añadido";
            }
        })
        
    };


    if (wishes){
        wishes.addEventListener("click", () =>{
            hearts.forEach(heart => {
                
                if (heart.classList.contains("inactive")){
                    heart.classList.remove("inactive")
                }
                else{
                    heart.classList.add("inactive")
                }
                
            });
        });
    };
}

renderShop();





