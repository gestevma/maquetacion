export let switchButtonClick = () =>{

    let switchButton = document.querySelector(".switch-button");
    let main = document.querySelector(".main");

    let position=0
    switchButton.addEventListener( 'change', () => {

        if(position==0) {
            console.log(position)
            position=1;

        } else {
            console.log(position)
            position=0;
        }

    });
}

switchButtonClick();
