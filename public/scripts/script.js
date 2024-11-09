document.addEventListener("DOMContentLoaded", function () {
    const authorSelect = document.querySelector('#author');
    const newAuthorField = document.querySelector('#new-author-fields');

    if (authorSelect && newAuthorField) { // check if they exist

        authorSelect.addEventListener('change', function () {

            if(this.value === 'new') {
                console.log("New Author Selected")
                newAuthorField.style.display = 'block';
            } else {
                console.log("Existing Author Selected", this.value)
                newAuthorField.style.display = 'none';

            }
        });
        authorSelect.dispatchEvent(new Event('change'))
    }


    // Button for adding extra files
    const addNewFile = document.createElement('button');
    addNewFile.innerText = 'Add file';
    addNewFile.className = 'button';

    // Node collection of nodes with class = file-class
    const fileElements = document.getElementsByClassName('file-class');
    const lastFileNode = fileElements[fileElements.length - 1];
    lastFileNode.append(addNewFile);

    // Function for adding new file-input
    const addFileInput = () => {
        // Make new div as container for file-input
        const newFileNode = document.createElement('div');
        newFileNode.className = 'file-class form-group body-group';

        // Make new node of type file
        const newFileInput = document.createElement('input');
        newFileInput.type = 'file';
        newFileInput.className = 'button';
        newFileNode.appendChild(newFileInput);

        // Make a delete-button for removing file-input
        const deleteFile = document.createElement('button');
        deleteFile.innerText = 'Remove';
        deleteFile.className = 'button';
        newFileNode.appendChild(deleteFile);

        // Enters the new node into the document at
        lastFileNode.parentNode.insertBefore(newFileNode, lastFileNode.nextSibling);

        // Event listener to delete file-input
        deleteFile.addEventListener('click', () => {
            newFileNode.remove();
        });
    };
    // addNewFile click handler - adds new file input
    addNewFile.onclick = (e) => {
        e.preventDefault(); // prevents default button actions like "Udfyld dette felt."
        addFileInput();
    };

    // Submit handler
    document.getElementById("submit").onclick = (e) => {
        const form = e.target.closest('form');
        // Finding closest form element, since search-word does not start with # or .
        const inputs = form.querySelectorAll('input, select, textarea');
        // finding node elements in tag element, that matches input, ... etc
        let details = ''; // defines an empty string

        inputs.forEach(input => {
            if (input.id === 'new-author-fields' && !input.checked)
                return;
            if (input.type === 'radio' && !input.checked) {
                return; // Skip unchecked radio buttons
            }
            if (input.name === 'submit' || input.name === '_token') {
                return;
            }
            if (input.type === `file`) {
                if (input.files.length > 0) {
                    details += `${input.name}: ${input.files[0].name}\n`;
                }
                return;
            }
            if (input.type === `checkbox` && input.checked) {
                details += `${input.value}: Yes\n`;
                // } else if (input.type === 'select-one'){ // refers to the first element in the select
                //     details += `${input.name}: ${input.options[input.selectedIndex].text}\n`;
            } else if (input.type !== 'button' && input.value.trim() !== '' && input.name !== 'genre') { // in order not to print new author fields if not added
                if (input.name === 'author_id') {
                    if (`${input.options[input.selectedIndex].text}` === 'Add new author') {
                        return;
                    }
                    details += `Author: ${input.options[input.selectedIndex].text}\n`;
                } else {
                    details += `${input.name}: ${input.value}\n`;
                }

            }
        });
        alert(details); // shows input-details in an alert, filtered from empty fields and CSRF token
    };
})
//
// window.addEventListener("load", () => {
//     //
//     // // GENRE
//     //
//     // const addNewGenre = document.createElement('button');
//     // addNewGenre.innerText = 'Add genre';
//     // addNewGenre.className = 'button';
//     //
//     // // Node collection of nodes with class = genre-class
//     // const genreElements = document.getElementsByClassName('genre-class');
//     // const lastGenreNode = genreElements[genreElements.length - 1];
//     // lastGenreNode.append(addNewGenre);
//     // // Function for adding new genre-input
//     // const addGenreInput = () => {
//     //     // Make new div as container for file-input
//     //     const newGenreNode = document.createElement('div');
//     //     newGenreNode.className = 'file-class form-group body-group';
//     //
//     //     // Make new node of type label
//     //     const newGenreLabel = document.createElement('label');
//     //     newGenreLabel.innerText = 'Genre';
//     //
//     //     // Make new node of type select
//     //     const newGenreInput = document.createElement('select');
//     //     newGenreInput.name = 'Genre';
//     //     newGenreInput.id = 'genre';
//     //     newGenreInput.className = 'button';
//     //
//     //     const opt1 = document.createElement('option');
//     //     opt1.value = 'Not specified';
//     //     opt1.innerText = 'Not Specified'
//     //     newGenreInput.appendChild(opt1);
//     //
//     //     const opt2 = document.createElement('option');
//     //     opt2.value = 'Short-stories';
//     //     opt2.innerText = 'Short-stories';
//     //     newGenreInput.appendChild(opt2);
//     //
//     //     newGenreNode.appendChild(newGenreLabel);
//     //     newGenreNode.appendChild(newGenreInput);
//     //
//     //     // Make a delete-button for removing file-input
//     //     const deleteGenre = document.createElement('button');
//     //     deleteGenre.innerText = 'Remove';
//     //     deleteGenre.className = 'button';
//     //     newGenreNode.appendChild(deleteGenre);
//     //
//     //     // Enters the new node into the document at
//     //     lastGenreNode.parentNode.insertBefore(newGenreNode, lastGenreNode.nextSibling);
//     //
//     //     // Event listener to delete file-input
//     //     deleteGenre.addEventListener('click', () => {
//     //         newGenreNode.remove();
//     //     });
//     // };
//     //
//     //
//     // addNewGenre.onclick = (genreEvent) => {
//     //     genreEvent.preventDefault();
//     //     addGenreInput();
//     // }
//
//
//     // console.log('lastFileNode' +lastFileNode);
//     // console.log('next sibling' + lastFileNode.nextSibling);
//     // console.log('next next sibling' + lastFileNode.nextSibling.nextSibling);
// });
//
