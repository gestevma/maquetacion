export let editSeo = () =>{

    let blockInputs = document.querySelectorAll(".block-input");

    blockInputs.forEach(blockInput => {

        let originalInput = blockInput.value.match(/\{.*?\}/g)
        const originalSetInput = blockInput.value;
        let setInput = ""

        if (originalInput){

            blockInput.addEventListener("keydown", () =>{
                let keyDownInput = blockInput.value.match(/\{.*?\}/g)
                
                setInput = blockInput.value

                if(!keyDownInput){
                    setInput = originalSetInput;
                }

            }); 
            
            blockInput.addEventListener("keyup", () =>{
                let finalInput = blockInput.value.match(/\{.*?\}/g)

                if (finalInput){
                    if(originalInput.toString() != finalInput.toString()){
                        blockInput.value = setInput;
                    }

                }else{
                    blockInput.value = setInput;
                }
                
                setInput = blockInput.value
            })
        }  
    })
    
}