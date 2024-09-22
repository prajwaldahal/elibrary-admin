document.getElementById('bookForm').addEventListener('submit', function(event) {
    let valid = true;

    // Clear previous error messages
    document.querySelectorAll('small').forEach(e => e.innerText = '');

    // ISBN Validation (must be 13 digits)
    const isbn = document.getElementById('isbn').value;
    if (!/^\d{13}$/.test(isbn)) {
        document.getElementById('isbnHelp').innerText = 'ISBN number must be exactly 13 digits.';
        valid = false;
    }

    // Price Validation (must be a positive number)
    const price = document.getElementById('price').value;
    if (price <= 0) {
        document.getElementById('priceHelp').innerText = 'Price must be a positive number.';
        valid = false;
    }

    // Title Validation (max 100 characters, min 3 characters)
    const name = document.getElementById('name').value;
    if (name.length > 100) {
        document.getElementById('nameHelp').innerText = 'Title cannot exceed 100 characters.';
        valid = false;
    } else if (name.length < 3) {
        document.getElementById('nameHelp').innerText = 'Title must be at least 3 characters long.';
        valid = false;
    }

    // Author Validation (max 50 characters, min 3 characters)
    const author = document.getElementById('author').value;
    if (author.length > 20) {
        document.getElementById('authorHelp').innerText = 'Author name cannot exceed 50 characters.';
        valid = false;
    } else if (author.length < 3) {
        document.getElementById('authorHelp').innerText = 'Author name must be at least 3 characters long.';
        valid = false;
    }

    // Description Validation (max 500 characters, min 10 characters)
    const desc = document.getElementById('desc').value;
    if (desc.length > 500) {
        document.getElementById('descHelp').innerText = 'Description cannot exceed 500 characters.';
        valid = false;
    } else if (desc.length < 10) {
        document.getElementById('descHelp').innerText = 'Description must be at least 10 characters long.';
        valid = false;
    }

    // Other required field checks (category and image file)
    const fields = ['category', 'file'];
    fields.forEach(field => {
        if (document.getElementById(field).value.trim() === '') {
            document.getElementById(field + 'Help').innerText = 'This field is required.';
            valid = false;
        }
    });

    if (!valid) {
        event.preventDefault();  // Prevent form submission if validation fails
    }
});
