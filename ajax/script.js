$(document).ready(function () {
    // Send an AJAX request to your server-side script
    $.ajax({
        url: 'your_server_script.php', // Replace with your server-side script URL
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            // Process the data received from the server
            if (data && data.length > 0) {
                let outputHTML = '<ul>';
                data.forEach(function (item) {
                    outputHTML += '<li>' + item.fname + '</li>';
                });
                outputHTML += '</ul>';
                $('#output').html(outputHTML);
            } else {
                $('#output').html('No data available.');
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
            $('#output').html('An error occurred while fetching data.');
        }
    });
});
