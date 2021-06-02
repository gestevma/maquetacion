productBoxes = document.querySelectorAll(".product-box");



wishes = document.querySelector(".wishes");
hearts=document.querySelectorAll(".heart");
individualProductDescription = document.querySelector(".individual-product-description");
more=document.querySelector(".more");
shopCart = document.querySelector(".shop-cart");
addToCart = document.querySelector(".add-to-cart");

if (productBoxes){
    productBoxes.forEach(productBox => {

        productBox.addEventListener("mouseover", () =>{
            productMore = productBox.querySelectorAll(".product-more");

            productMore.forEach(productMoreElement =>{
                productMoreElement.classList.add("active");   
            })
 
        })

        productBox.addEventListener("mouseout", () =>{
            productMore = productBox.querySelectorAll(".product-more");
            productMore.forEach(productMoreElement =>{
                productMoreElement.classList.remove("active");   
            })
 
        })
    })
}

// moreProducts.forEach(moreProduct =>{

// })

if(more){
    more.addEventListener("click", () =>{
        if (individualProductDescription.classList.contains("active")){
            individualProductDescription.classList.remove("active");
            more.innerHTML = "leer más..."
        }
    
        else{
            individualProductDescription.classList.add("active");
            more.innerHTML="cerrar"
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



