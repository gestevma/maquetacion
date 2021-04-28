export let switchButtonClick = () =>{

    let switchButton = document.querySelector(".switch-button");
    let main = document.querySelector(".main");

    let position=0
    switchButton.addEventListener( 'change', () => {

    if(position==0) {
        console.log("hola")
        position=1;

    } else {
        console.log("adios")
        position=0;
    }


    });
}
