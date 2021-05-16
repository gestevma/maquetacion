import {renderForm} from './crudForm.js'

export let renderUpload = () => {
    
    

    let inputElements = document.querySelectorAll(".upload-input");

    inputElements.forEach(inputElement => {

        
        let uploadElement = inputElement.closest(".upload");
        
        uploadElement.addEventListener("click", (e) => {
            inputElement.click();
        });
        
        inputElement.addEventListener("change", () => {
            if (inputElement.files.length) {

                var files = inputElement.files

        
                // for (var i = 0; i < files.length; i++) {
                //     var file =  inputElement.files.item(i);
                //     updateThumbnail(uploadElement, file);
                // }


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
                inputElement.files = e.dataTransfer.files;

                var files = e.dataTransfer.files



                // for (var i = 0; i < files.length; i++) {
                //     var file = e.dataTransfer.files.item(i);
                //     updateThumbnail(uploadElement, file);
                // }
                /*************************************************/

                updateThumbnail(uploadElement, files); 
                    
            }
        
            uploadElement.classList.remove("upload-over");
        });


    });
      


    function updateThumbnail(uploadElement, files) {
    
        let thumbnailElement = uploadElement.querySelector(".upload-thumb");
        let groupElements = document.querySelectorAll(".group");
        let formInput = uploadElement.closest(".form-input");

        //multipleUpload(uploadElement);
      
        if (uploadElement.querySelector(".upload-prompt")) {
            uploadElement.querySelector(".upload-prompt").remove();
        }
      

        if (!thumbnailElement) {
            for (var i = 0; i < files.length ; i++){
                var file =  files.item(i);

                // Crea nuevos "cuadrados" de subida cuando subo un elemento para poder subir varios

                if (uploadElement.classList.contains("group")){
                    var groupElementClone = groupElements.cloneNode(true);
                    formInput.appendChild(groupElementClone);
                    
                    renderForm();
                }  

                console.log(file);
                // thumbnailElement = document.createElement("div");
                // thumbnailElement.classList.add("upload-thumb");
                // uploadElement.appendChild(thumbnailElement);
            }


            
        }
        /*************************************************/
      
        if (files[0].type.startsWith("image/")) {
            let reader = new FileReader();
        
            reader.readAsDataURL(files[0]);
    
            reader.onload = () => {
                thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
            };
        } else {
            thumbnailElement.style.backgroundImage = null;
        }

       
    }

    function multipleUpload (uploadElement) {
        
        let groupElement = document.querySelector(".group");
        let formInput = uploadElement.closest(".form-input");


        // Crea nuevos "cuadrados" de subida cuando subo un elemento para poder subir varios

        // if (uploadElement.classList.contains("group")){
        //     var groupElementClone = groupElement.cloneNode(true);
        //     uploadElement.classList.remove("group");
        //     formInput.appendChild(groupElementClone);
        //     renderForm();
        // }  

    }

   
}