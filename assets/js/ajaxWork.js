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
        error: function() {
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
            drawChart(response);
        },
        error: function() {
            alert('Error loading chart data.');
        }
    });
}

function drawChart(data) {
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
            title: 'Yearly Income',
            curveType: 'function',
            legend: { position: 'bottom' },
            hAxis: {
                title: 'Month',
                format: 'MMM', // Use abbreviated month names
                gridlines: { count: 12 }
            },
            vAxis: {
                title: 'Income',
                format: 'currency',
                gridlines: { count: 12},
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

// Function to add books data
function addItems() {
    var p_name = $('#p_name').val();
    var p_desc = $('#p_desc').val();
    var p_price = $('#p_price').val();
    var category = $('#category').val();
    var upload = $('#upload').val();
    var file = $('#file')[0].files[0];

    var fd = new FormData();
    fd.append('p_name', p_name);
    fd.append('p_desc', p_desc);
    fd.append('p_price', p_price);
    fd.append('category', category);
    fd.append('file', file);
    fd.append('upload', upload);

    $.ajax({
        url: "./controller/addItemController.php",
        method: "post",
        data: fd,
        processData: false,
        contentType: false,
        success: function(data) {
            alert('Books added successfully.');
            $('form').trigger('reset');
            showBooks();
        }
    });
}

// Function to show edit form for an item
function itemEditForm(id) {
    $.ajax({
        url: "./adminView/editItemForm.php",
        method: "post",
        data: { record: id },
        success: function(data) {
            $('.allContent-section').html(data);
        }
    });
}

// Function to update books data
function updateItems() {
    var isbn_no = $('#isbn_no').val();
    var p_name = $('#p_name').val();
    var p_desc = $('#p_desc').val();
    var p_price = $('#p_price').val();
    var category = $('#category').val();
    var existingImage = $('#existingImage').val();
    var newImage = $('#newImage')[0].files[0];
    var fd = new FormData();
    fd.append('isbn_no', isbn_no);
    fd.append('p_name', p_name);
    fd.append('p_desc', p_desc);
    fd.append('p_price', p_price);
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
    $.ajax({
        url: "./controller/deleteItemController.php",
        method: "post",
        data: { record: id },
        success: function(data) {
            alert('Item successfully deleted.');
            $('form').trigger('reset');
            showBooks();
        }
    });
}

// Function to show details of an item
function eachDetailsForm(id) {
    $.ajax({
        url: "./view/viewEachDetails.php",
        method: "post",
        data: { record: id },
        success: function(data) {
            $('.allContent-section').html(data);
        }
    });
}

// Function to delete a category
function categoryDelete(id) {
    $.ajax({
        url: "./controller/catDeleteController.php",
        method: "post",
        data: { record: id },
        success: function(data) {
            alert('Category successfully deleted.');
            $('form').trigger('reset');
            showCategory();
        }
    });
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

// Function to increase quantity of an item
function quantityPlus(id) {
    $.ajax({
        url: "./controller/addQuantityController.php",
        method: "post",
        data: { record: id },
        success: function(data) {
            $('form').trigger('reset');
            showMyCart();
        }
    });
}

// Function to decrease quantity of an item
function quantityMinus(id) {
    $.ajax({
        url: "./controller/subQuantityController.php",
        method: "post",
        data: { record: id },
        success: function(data) {
            $('form').trigger('reset');
            showMyCart();
        }
    });
}

// Function to remove an item from wishlist
function removeFromWish(id) {
    $.ajax({
        url: "./controller/removeFromWishlist.php",
        method: "post",
        data: { record: id },
        success: function(data) {
            alert('Removed from wishlist.');
        }
    });
}

// Function to add an item to wishlist
function addToWish(id) {
    $.ajax({
        url: "./controller/addToWishlist.php",
        method: "post",
        data: { record: id },
        success: function(data) {
            alert('Added to wishlist.');
        }
    });
}
