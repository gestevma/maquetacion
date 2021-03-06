export let message = (type)=>{

    let message = document.querySelector(".message");
    let messageContent = document.querySelector(".message-content");

    let successMessage = "Solicitud enviada correctamente"
    let failMessage = "Fallo al enviar la solicitud"

    /*messageContent.innerHTML=text;
    setTimeout(function(){ message.classList.add(type); }, 550);
    setTimeout(function(){ message.classList.remove(type); }, 2500);*/

    if (type=="success"){
        messageContent.innerHTML = successMessage;
        message.classList.add("success");
        setTimeout(function(){ message.classList.remove("success"); }, 2500);
    }

    else if (type=="fail"){
        messageContent.innerHTML = failMessage;
        message.classList.add("fail");
        setTimeout(function(){ message.classList.remove("fail"); }, 2500);
    }
}