export let spinner = () =>{
    let spinner = document.querySelector('.spinner-box');

    spinner.classList.add("active")
    setTimeout(function(){ spinner.classList.remove("active"); }, 500);
}