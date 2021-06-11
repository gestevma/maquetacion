export let productGrid = () => {
    let productBoxes = document.querySelectorAll(".product-box");
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

}