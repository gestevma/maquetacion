export let renderUpload = () => {

    let inputElements = document.querySelectorAll(".upload-input");

    inputElements.forEach(inputElement => {

        let uploadElement = inputElement.closest(".upload");
        
        uploadElement.addEventListener("click", () => {
            inputElement.click();

        });
        
        inputElement.addEventListener("change", () => {
            if (inputElement.files.length) {
                updateThumbnail(uploadElement, inputElement.files[0]);
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
                    updateThumbnail(uploadElement, e.dataTransfer.files[0]);
            }
        
            uploadElement.classList.remove("upload-over");
        });


    });
      
    function updateThumbnail(uploadElement, file) {
    
        let thumbnailElement = uploadElement.querySelector(".upload-thumb");
        let groupElement = document.querySelector(".group");
        let formInput = uploadElement.closest(".form-input");


        // Crea nuevos "cuadrados" de subida cuando subo un elemento para poder subir varios

        if (uploadElement.classList.contains("group")){
            var uploadElementClone = groupElement.cloneNode(true);
            formInput.appendChild(uploadElementClone);
        }  
        
        // if (uploadElement.classList.contains("group")){
        //     var uploadElementClone = document.createElement("div");
        //     uploadElementClone.classList.add("upload", "group");
        //     formInput.appendChild(uploadElementClone);
        // } 
      
        if (uploadElement.querySelector(".upload-prompt")) {
            uploadElement.querySelector(".upload-prompt").remove();
        }
      
        if (!thumbnailElement) {
            thumbnailElement = document.createElement("div");
            thumbnailElement.classList.add("upload-thumb");
            uploadElement.appendChild(thumbnailElement);
        }
      
        thumbnailElement.dataset.label = file.name;
      
        if (file.type.startsWith("image/")) {
            let reader = new FileReader();
        
            reader.readAsDataURL(file);
    
            reader.onload = () => {
                thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
            };
        } else {
            thumbnailElement.style.backgroundImage = null;
        }

       
    }

    // function multipleUpload (uploadElement) {
        
    //     let multipleImages = uploadElement.querySelector(".upload-thumb");

    //     if (uploadElement.querySelector(".upload-prompt")) {
    //         uploadElement.querySelector(".upload-prompt").remove();
    //     }
      
    //     if (!miltileImages) {
    //         multipleImages = document.createElement("div");
    //         multipleImages.classList.add("upload-thumb");
    //         uploadElement.appendChild(multipleImages);
    //     }

    // }

    // multipleUpload();
}
