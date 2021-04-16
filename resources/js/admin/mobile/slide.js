let table = document.querySelector(".table")
let tableLines = document.querySelectorAll(".table-line");
let form = document.querySelector(".form");

tableLines.forEach(tableLine =>{
    tableLine.addEventListener('pointerdown', () =>{
        tableLine.classList.add("colored");
    })

    tableLine.addEventListener('pointerup', () =>{
        tableLine.classList.remove("colored");
    })
})


function detectswipe(tableLines) {

    tableLines.forEach(tableLine =>{

        tableLine.addEventListener('touchstart', (positionTouch) =>{
            let x_axis_0 = positionTouch.touches[0];
            x_axis_0 = x_axis_0.screenX;
        });
          
        tableLine.addEventListener('touchmove',(direction) =>{
            direction.preventDefault();
            let x_axis_f = direction.touches[0];
            x_axis_f = x_axis_f.screenX; 
        });

        tableLine.addEventListener('touchend',() =>{
            movement=x_axis_f - x_axis_0
            console.log(movement);
            if (movement >= 175){
                form.classList.add("active")
                table.classList.add("inactive")
            }
            else if(movement <= -175){

                x_axis_f=0;
                x_axis_0=0;
                tableLine.classList.add("inactive")

                tableLine.addEventListener('click', () => {
            
    
                    let url = tableLine.dataset.url;
            
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
                
            }
        });
    })

      
}


detectswipe(tableLines);
