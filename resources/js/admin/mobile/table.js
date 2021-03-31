const editButtons = document.querySelectorAll(".edit-buttons");
const eliminateButtons = document.querySelectorAll(".eliminate-buttons")
const form = document.getElementById("form")

editButtons.forEach(editButton => {

    editButton.addEventListener('click', () => {

        let url = editButton.dataset.url;

        let editTable = async () => { 

            try { 
                await axios.get(url).then(response => { 
                    form.innerHTML=response.data.form; 
                     
                });
                 
            } catch (error) {
                console.error(error);
            }
        };

        editTable();

    });
});

eliminateButtons.forEach(eliminateButton => {

    eliminateButton.addEventListener('click', () => {
        

        let url = eliminateButton.dataset.url;

        let deleteTable = async () => { 

            try { 
                await axios.delete(url).then(response => { 
                    table.innerHTML = response.data.table;
                });
                 
            } catch (error) {
                console.error(error);
            }
        };

        deleteTable();

    });
});
