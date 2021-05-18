import {openImageModal} from './modalImage';

export let renderUpload = () => {
    let inputElements = document.querySelectorAll(".upload-input");
    let previews = document.querySelectorAll(".upload-preview");
   

    inputElements.forEach(inputElement => {

        uploadImage(inputElement)
    });



    function uploadImage(inputElement){

        let uploadElement = inputElement.closest(".upload");
       
        
        
        uploadElement.removeEventListener("click", (e) => {
            inputElement.click();
            
        });

        uploadElement.addEventListener("click", (e) => {
            inputElement.click();
        });

        
        inputElement.addEventListener("change", () => {
            if (inputElement.files.length) {

                var files = inputElement.files[0]
                updateThumbnail(uploadElement, files);  
                
            }
        });
        
        uploadElement.addEventListener("dragover", (e) => {
            e.preventDefault();
            uploadElement.classList.add("upload-over");
        });
        
        ["dragleave", "dragend"].forEach((type) => {
            uploadElement.addEventListener(type, (e) => {
                uploadElement.classList.remove("upload-over");
            });
        });
        
        uploadElement.addEventListener("drop", (e) => {
            e.preventDefault();
        
        
            if (e.dataTransfer.files.length) {
                inputElement.files = e.dataTransfer.files[0];

                var files = e.dataTransfer.files
                updateThumbnail(uploadElement, files); 
                    
            }
        
            uploadElement.classList.remove("upload-over");
        });
    }
    



    function updateThumbnail(uploadElement, file) {

        let thumbnailElement = uploadElement.querySelector(".upload-thumb");

        if(uploadElement.classList.contains('collection')){

            if(thumbnailElement == null){

                let cloneUploadElement = uploadElement.cloneNode(true);
                let cloneInput = cloneUploadElement.querySelector('.upload-input');

                uploadImage(cloneInput);
                uploadElement.parentElement.appendChild(cloneUploadElement);
            }
        }
    
        if (uploadElement.querySelector(".upload-prompt")) {
            uploadElement.querySelector(".upload-prompt").remove();
        }
        
        if (!thumbnailElement) {
            thumbnailElement = document.createElement("div");
            thumbnailElement.classList.add("upload-thumb");
            uploadElement.appendChild(thumbnailElement);
        }
            
        
        if (file.type.startsWith("image/")) {

            //FileReader recoge el valor del input que pongamos
            let reader = new FileReader();
            
            //reader es FileReader (Porque lo hemos dicho antes), un objeto que tiene un atribito reasAsDataURL que transforma el input en una URL 
            reader.readAsDataURL(file);
            
            //onload mete la url donde le pidamos. En este caso en style
            reader.onload = () => {
                thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
            };

            //Comprueba si tiene la clase collection
            if(uploadElement.classList.contains('collection')){

                //Para poder añadir lo del nombre hay que declarar primero estas variables
                let content = uploadElement.dataset.content;
                let alias = uploadElement.dataset.alias;
                let inputElement = uploadElement.getElementsByClassName("upload-input")[0];
                console.log(content)
                //Cambio de nombre. Para hacer esto el input no puede tener nombre
                inputElement.name = "images[" + content + "-" + Math.floor((Math.random() * 99999) + 1) + "." + alias  + "]"; 
            }
            
        } else {
            thumbnailElement.style.backgroundImage = null;
        }
    }

    previews.forEach(preview => {
        
        //Función para enviar fotos a la base de datos
        preview.addEventListener("click", (e) => {
            
            //Al clicar en la imagen va a buscar la url que está en el html
            let url = preview.dataset.url;
    
            let sendImageRequest = async () => {
                
                //Al clicar en la imagen va a la función openImageModal (está en modelImage.js)
                try {
                    axios.get(url).then(response => {

                        openImageModal(response.data);
                      
                    });
                    
                } catch (error) {
    
                }
            };
    
            sendImageRequest();

        });
    });
















    
    //     let thumbnailElement = uploadElement.querySelector(".upload-thumb");
    //     let groupElement = document.querySelector(".group");
    //     let formInput = uploadElement.closest(".form-input");
      
    //     if (uploadElement.querySelector(".upload-prompt")) {
    //         uploadElement.querySelector(".upload-prompt").remove();
    //     }

    //     if (thumbnailElement) {
    //         thumbnailElement.remove();
    //     }


    //     for (var i = 0; i < files.length ; i++){
            
    //         var file = files.item(i);

    //         if (uploadElement.classList.contains("group")){

    //             var groupElementClone = groupElement.cloneNode(true);
    //             groupElementClone.querySelector(".upload-input").removeAttribute("multiple");
    //             groupElementClone.classList.remove("group");
    //             formInput.insertBefore(groupElementClone, uploadElement);

    //             var inputElementCloned = groupElementClone.querySelector(".upload-input");

    //             //inputElementCloned.setAttribute("name", "images[{{$content}}.{{$alias}}]" );

    //             console.log(inputElementCloned);

    //             thumbnailElement = document.createElement("div");
    //             thumbnailElement.classList.add("upload-thumb");
    //             groupElementClone.appendChild(thumbnailElement);

    //             renderUpload();
    
                
    //         } else{
    //             thumbnailElement = document.createElement("div");
    //             thumbnailElement.classList.add("upload-thumb");
    //             uploadElement.appendChild(thumbnailElement);
                
    //         }

    //         if (file.type.startsWith("image/")) {
    //             let reader = new FileReader();
            
    //             reader.readAsDataURL(file);
        
    //             reader.onload = () => {
    //                 thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
    //             };
    //         } 
    //         else {
    //             thumbnailElement.style.backgroundImage = null;
    //         }
    
            
    //     }

       
    // }

   
}
