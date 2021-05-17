import {renderForm} from './crudForm.js'

export let renderUpload = () => {
    let inputElements = document.querySelectorAll(".upload-input");

    inputElements.forEach(inputElement => {

        
        let uploadElement = inputElement.closest(".upload");

        uploadElement.removeEventListener("click", (e) => {
            inputElement.click();
        });

        uploadElement.addEventListener("click", (e) => {
            inputElement.click();
        });

        
        inputElement.addEventListener("change", () => {
            if (inputElement.files.length) {

                var files = inputElement.files
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
                updateThumbnail(uploadElement, files); 
                    
            }
        
            uploadElement.classList.remove("upload-over");
        });


    });
      


    function updateThumbnail(uploadElement, files) {
    
        let thumbnailElement = uploadElement.querySelector(".upload-thumb");
        let groupElement = document.querySelector(".group");
        let formInput = uploadElement.closest(".form-input");
      
        if (uploadElement.querySelector(".upload-prompt")) {
            uploadElement.querySelector(".upload-prompt").remove();
        }

        if (thumbnailElement) {
            thumbnailElement.remove();
        }


        for (var i = 0; i < files.length ; i++){
            
            var file = files.item(i);

            if (uploadElement.classList.contains("group")){

                var groupElementClone = groupElement.cloneNode(true);
                groupElementClone.querySelector(".upload-input").removeAttribute("multiple");
                groupElementClone.classList.remove("group");
                formInput.insertBefore(groupElementClone, uploadElement);

                var inputElementCloned = groupElementClone.querySelector(".upload-input");

                //inputElementCloned.setAttribute("name", "images[{{$content}}.{{$alias}}]" );

                console.log(inputElementCloned);

                thumbnailElement = document.createElement("div");
                thumbnailElement.classList.add("upload-thumb");
                groupElementClone.appendChild(thumbnailElement);

                renderUpload();
    
                
            } else{
                thumbnailElement = document.createElement("div");
                thumbnailElement.classList.add("upload-thumb");
                uploadElement.appendChild(thumbnailElement);
                
            }

            if (file.type.startsWith("image/")) {
                let reader = new FileReader();
            
                reader.readAsDataURL(file);
        
                reader.onload = () => {
                    thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
                };
            } 
            else {
                thumbnailElement.style.backgroundImage = null;
            }
    
            
        }

       
    }

   
}
