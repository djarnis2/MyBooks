function btn_maker(bookItem, type, name, method, message) {
    const buttonContainer = bookItem.querySelector('#buttons_span');
    const button = document.createElement('button');
    const bookId = bookItem.querySelector('.body-links').getAttribute('data-id');
    button.innerText = name;
    button.className = 'button';


    if (type === 'edit') {
        // Redirect to the edit page
        button.addEventListener('click', () => {
            window.location.href = `/books/${bookId}/edit`;
        });
    } else if (type === 'delete') {
        button.addEventListener('click', () => {
            console.log('id is ' + `/books/${bookId}`)

            fetch(`/books/${bookId}`, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
                .then((response) => {
                    if (response.ok) {
                        if (method === 'DELETE') {
                            bookItem.remove();
                        } else {
                            console.log(message);
                        }

                    } else {
                        console.error(`Failed to ${type} the book with id ${bookId}`);
                    }
                })
                .catch((error) => console.error("Error", error));
        });

    }


    buttonContainer.appendChild(button);
}

document.querySelectorAll('.book-group').forEach((bookItem) => {
    btn_maker(bookItem, 'edit', 'Edit', 'PUT', 'Book updated');
    btn_maker(bookItem, 'delete', 'Delete', 'DELETE', 'Book deleted');
});



//
// if (type === 'delete') {
//     button.addEventListener('click', () => {
//         console.log('id is ' + `/books/${bookId}`);
//
//         const xhttp = new XMLHttpRequest();
//
//         // Åbn anmodningen
//         xhttp.open('DELETE', `/books/${bookId}`, true);
//
//         // Sæt nødvendige headers
//         xhttp.setRequestHeader('Content-Type', 'application/json');
//         xhttp.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
//
//         // Håndter responsen
//         xhttp.onreadystatechange = function () {
//             if (xhttp.readyState === XMLHttpRequest.DONE) {
//                 if (xhttp.status === 200) {
//                     if (method === 'DELETE') {
//                         bookItem.remove(); // Fjern bogelementet fra DOM'en
//                     } else {
//                         console.log(message);
//                     }
//                 } else {
//                     console.error(`Failed to ${type} the book with id ${bookId}: ${xhttp.status}`);
//                 }
//             }
//         };
//
//         // Send anmodningen
//         xhttp.send();
//     });
// }
//
