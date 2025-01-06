// document.addEventListener("DOMContentLoaded", function () {
const authorSelect = document.querySelector('#author');
const newAuthorField = document.querySelector('#new-author-fields');
// remember # is id
if (authorSelect && newAuthorField) { // check if they exist

    authorSelect.addEventListener('change', function () {
        newAuthorField.style.display = this.value === 'new' ? 'block' : 'none';
        // new ? If no authors in db or if New Author option is selected, value is set to new in create blade
        // if yes: style.display = block  -New Author Field is shown
        // if no: style.display = none  -New Author Field is hidden
    });
    authorSelect.dispatchEvent(new Event('change'))
    // secures that change on authorSelect on load is triggered
}

//
// // Button for adding extra files
// const addNewFile = document.createElement('button');
// addNewFile.innerText = 'Add file';
// addNewFile.className = 'button';
//
// // Node collection of nodes with class = file-class
// const fileElements = document.getElementsByClassName('file-class');
// const lastFileNode = fileElements[fileElements.length - 1];
//
// // Inserting button
// lastFileNode.appendChild(addNewFile);
// console.log("lastF"+lastFileNode);

// Button for adding extra files
const addNewFile = document.createElement('button');
addNewFile.innerText = 'Add file';
addNewFile.className = 'button';

// Node collection of nodes with class = file-class
const fileElements = document.getElementsByClassName('file-class');
const lastFileNode = fileElements[fileElements.length - 1];

// Inserting button
lastFileNode.appendChild(addNewFile);
console.log("lastF" + lastFileNode);


// Function for adding new file-input
const addFileInput = () => {
    // Make new div as container for file-input
    const newFileNode = document.createElement('div');
    newFileNode.className = 'file-class form-group body-group';

    // Make new node of type file
    const newFileInput = document.createElement('input');
    newFileInput.type = 'file';
    newFileInput.className = 'button';
    newFileInput.name = 'file';
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
    // Check if the form contains the newFileNode
    const form = document.querySelector('form');
    console.log(form.contains(newFileNode)); // Should log `true`
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

    const checkboxes = document.querySelectorAll('input[name="genre[]"]');

    // Alert for not submitting at least one genre
    form.addEventListener('submit', function (e) {
        const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        if (!isChecked) {
            e.preventDefault(); // Prevent form submission
            alert('Please select at least one genre.');
        }
    });

    // getting the right input for the alert
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
                details += `File: ${input.name}: ${input.files[0].name}\n`;
            }
            return;
        }
        if (input.type === `checkbox` && input.checked) {
            const genreName = input.dataset.genreName;  // Retrieve the genre name from the data attribute
            details += `Genre: ${genreName}\n`;
            // } else if (input.type === 'select-one'){ // refers to the first element in the select
            //     details += `${input.name}: ${input.options[input.selectedIndex].text}\n`;
        } else if (input.type !== 'button' && input.value.trim() !== '' && input.name !== 'genre[]') { // in order not to print new author fields if not added
            if (input.name === 'author_id') {
                if (`${input.options[input.selectedIndex].text}` === 'Add new author') {
                    return;
                }
                details += `Author: ${input.options[input.selectedIndex].text}\n`;
            } else {
                details += `${input.name.charAt(0).toUpperCase() + input.name.slice(1)}: ${input.value}\n`;
            }

        }
    });

    alert(details); // shows input-details in an alert, filtered from empty fields and CSRF token

};

// })

document.querySelector('form').addEventListener('submit', function (event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'PUT', // or PATCH if your route uses PATCH
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert(data.success);
                window.location.href = data.redirect_url; // Redirect based on the response
            }
        })
        .catch((error) => console.error('Error:', error));
});
