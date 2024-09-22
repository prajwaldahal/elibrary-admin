function loadIncomeData() {
    var year = $('#year').val();

    $.ajax({
        url: 'controller/incomeController.php',
        type: 'POST',
        data: { year: year },
        dataType: 'json',
        success: function(response) {
            // Update income values
            $('#totalIncomeValue').text('Rs. ' + parseFloat(response.total_income).toFixed(2));
            $('#activeIncomeValue').text('Rs. ' + parseFloat(response.active_income).toFixed(2));
            $('#historyIncomeValue').text('Rs. ' + parseFloat(response.history_income).toFixed(2));
            $('#monthIncomeValue').text('Rs. ' + parseFloat(response.month_income).toFixed(2));
            
            // Load chart data
            loadMonthlyIncomeChart();
        },
        error: function(xhr, status, error) {
            console.error('Error loading chart data:', status, error);
            alert('Error loading data.');
        }
    });
}

function dateChange() {
    $('#year').on('change', function() {
        loadMonthlyIncomeChart();
    });
}

function loadMonthlyIncomeChart() {
    var year = $('#year').val();

    $.ajax({
        url: 'controller/incomeController.php',
        type: 'POST',
        data: { year: year, chart: true },
        dataType: 'json',
        success: function(response) {
            console.log('Data passed to drawChart:', response);            
            drawChart(response,year);
        },
        error: function(xhr, status, error) {
            console.error('Error loading chart data:', status, error);
            alert('Error loading data.');
        }
    });
}

function drawChart(data,year) {
    try {
        if (!data || !Array.isArray(data) || data.length === 0) {
            alert("No data available for the selected year.");
            return;
        }

        var chartData = [['Month', 'Income']];

        data.forEach(function(item) {
            // Ensure month names are handled properly
            chartData.push([item.month, parseFloat(item.total_income)]);
        });

        var dataTable = google.visualization.arrayToDataTable(chartData);

        var options = {
            title: 'Monthly Income-'+year,
            curveType: 'function',
            legend: { position: 'bottom' },
            hAxis: {
                title: 'Month',
                format: 'MMM', 
                gridlines: { count: 12 }
            },
            vAxis: {
                title: 'Income',
                format: 'Rs #,##0.00',
                gridlines: { count: 12 },
                viewWindow: { min: 0 }
            },
            tooltip: { isHtml: true },
            series: {
                0: { color: 'green' }
            },
            height: 500,
            width: '100%'
        };

        var chart = new google.visualization.LineChart(document.getElementById('income_chart'));
        chart.draw(dataTable, options);
    } catch (error) {
        console.error('Error drawing chart:', error.message);
        alert('An error occurred while drawing the chart: ' + error.message);
    }
}



// Function to show all books
function showBooks() {
    $.ajax({
        url: "./adminView/viewAllBooks.php",
        method: "post",
        data: { record: 1 },
        success: function(data) {
            $('.allContent-section').html(data);
        }
    });
}

//function to showRequestedbook
function showRequested() {
    $.ajax({
        url: "./adminView/viewRequestedBook.php",
        method: "post",
        data: { record: 1 },
        success: function(data) {
            $('.allContent-section').html(data);
        }
    });
}

// Function to show income report
function showIncome() {
    $.ajax({
        url: "./adminView/viewIncomeReport.php",
        method: "post",
        data: { record: 1 },
        success: function(data) {
            $('.allContent-section').html(data);
        }
    });
}

// Function to show categories
function showCategory() {
    $.ajax({
        url: "./adminView/viewCategories.php",
        method: "post",
        data: { record: 1 },
        success: function(data) {
            $('.allContent-section').html(data);
        }
    });
}

// Function to show customers
function showCustomers() {
    $.ajax({
        url: "./adminView/viewCustomers.php",
        method: "post",
        data: { record: 1 },
        success: function(data) {
            $('.allContent-section').html(data);
        }
    });
}

// Function to show rented books
function showRental() {
    $.ajax({
        url: "./adminView/viewRentedBooks.php",
        method: "post",
        data: { record: 1 },
        success: function(data) {
            $('.allContent-section').html(data);
        }
    });
}

//fucntion to show history
function showHistory() {
    $.ajax({
        url: "./adminView/viewHistory.php",
        method: "post",
        data: { record: 1 },
        success: function(data) {
            $('.allContent-section').html(data);
        }
    });
}

// Function to add books data
function addItems() {
    var upload='upload';
    var isbn = $('#isbn').val().trim();
    var name = $('#name').val().trim();
    var desc = $('#desc').val().trim();
    var price = $('#price').val().trim();
    var category = $('#category').val();
    var author = $('#author').val().trim();
    var file = $('#file')[0].files[0];
    
    var isValid = true;

    
    $('#isbnHelp, #nameHelp, #priceHelp, #descHelp, #authorHelp, #categoryHelp, #fileHelp').text('');

   
    if (isbn === '' || !/^\d{13}$/.test(isbn)) {
        $('#isbnHelp').text('ISBN must be exactly 13 digits.');
        isValid = false;
    }

    
    if (name.length < 3 || name.length > 100) {
        $('#nameHelp').text('Title must be between 3 and 100 characters.');
        isValid = false;
    }

    
    if (price === '' || price <= 0 || isNaN(price)) {
        $('#priceHelp').text('Price must be a positive number.');
        isValid = false;
    }

 
    if (desc.length < 10 || desc.length > 500) {
        $('#descHelp').text('Description must be between 10 and 500 characters.');
        isValid = false;
    }

    
    if (author.length < 3 || author.length > 50) {
        $('#authorHelp').text('Author name must be between 3 and 50 characters.');
        isValid = false;
    }

   
    if (category === null || category === '') {
        $('#categoryHelp').text('Please select a category.');
        isValid = false;
    }

    
    if (!file) {
        $('#fileHelp').text('Book cover image is required.');
        isValid = false;
    }

    
    if (!isValid) {
        return false;
    }

    var fd = new FormData();
    fd.append('isbn_no', isbn);
    fd.append('name', name);
    fd.append('desc', desc);
    fd.append('price', price);
    fd.append('category', category);
    fd.append('author', author);
    fd.append('file', file);
    fd.append('upload', upload);

    $.ajax({
        url: "./controller/addItemController.php",
        method: "POST",
        data: fd,
        processData: false,
        contentType: false,
        success: function(response) {
            var data = JSON.parse(response);
            if (data.status === 'success') {
                $('#bookForm').trigger('reset');
                $('#myModal').modal('hide'); // Close modal
                $('.modal-backdrop').remove(); 
                alert(data.message);
                showBooks(); // Refresh book list
            }
        },
        error: function(xhr) {
            var data = JSON.parse(xhr.responseText);
            alert("Error: " + data.message);
            $('#bookForm').trigger('reset');
            $('#myModal').modal('hide');
            $('.modal-backdrop').remove(); 
            showBooks();
        }
    });

    return false; 
}

function addCategory(){
    var upload='upload';
    var c_name = $('#c_name').val().trim();
    var fd = new FormData();
    fd.append('c_name', c_name);
    fd.append('upload', upload);
    $.ajax({
        url: "./controller/addCatController.php",
        method: "POST",
        data: fd,
        processData: false,
        contentType: false,
        success: function(response) {
            var data = JSON.parse(response);
            if (data.status === 'success') {
                $('#catForm').trigger('reset');
                $('#myModal').modal('hide'); // Close modal
                $('.modal-backdrop').remove(); 
                alert(data.message);
                showCategory();
            }
        },
        error: function(xhr) {
            var data = JSON.parse(xhr.responseText);
            alert("Error: " + data.message);
            $('#carForm').trigger('reset');
            $('#myModal').modal('hide');
            $('.modal-backdrop').remove(); 
            showCategory();
        }
    });
    
    return false;
}


// Function to show edit form for an item
function itemEditForm(id) {
    if (confirm("Are you sure you want to edit this Book?")) {
        $.ajax({
            url: "./adminView/editItemForm.php",
            method: "post",
            data: { record: id },
            success: function(data) {
                $('.allContent-section').html(data);
            }
        });
    }
}

// Function to update books data
function updateItems() {
    var isbn_no = $('#isbn_no').val();
    var name = $('#name').val();
    var desc = $('#desc').val();
    var price = $('#price').val();
    var category = $('#category').val();
    var existingImage = $('#existingImage').val();
    var newImage = $('#newImage')[0].files[0];
    var fd = new FormData();
    fd.append('isbn_no', isbn_no);
    fd.append('name', name);
    fd.append('desc', desc);
    fd.append('price', price);
    fd.append('category', category);
    fd.append('existingImage', existingImage);
    fd.append('newImage', newImage);

    $.ajax({
        url: './controller/updateItemController.php',
        method: 'post',
        data: fd,
        processData: false,
        contentType: false,
        success: function(data) {
            alert('Data updated successfully.');
            $('form').trigger('reset');
            showBooks();
        }
    });
}

// Function to delete an item
function itemDelete(id) {
    if (confirm("Are you sure you want to delete this Book?")) {
        $.ajax({
            url: "./controller/deleteItemController.php",
            method: "post",
            data: { record: id },
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    alert(response.message);
                    $('form').trigger('reset');
                    showBooks();
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function(xhr) {
                var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : "An error occurred while deleting the book.";
                alert("Error: " + errorMessage);
            }
        });
    }
}



function categoryDelete(id) {
    if (confirm("Are you sure you want to delete this category?")) {
        $.ajax({
            url: "./controller/catDeleteController.php",
            method: "post",
            data: { record: id },
            dataType: "json", // Expect a JSON response
            success: function(response) {
                if (response.status === "success") {
                    alert(response.message);
                    $('form').trigger('reset');
                    showCategory();
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function(xhr) {
                var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : "An error occurred while deleting the category.";
                alert("Error: " + errorMessage);
            }
        });
    }
}

// Function to search for books in a category
function search(id) {
    $.ajax({
        url: "./controller/searchController.php",
        method: "post",
        data: { record: id },
        success: function(data) {
            $('.eachCategorybookss').html(data);
        }
    });
}

