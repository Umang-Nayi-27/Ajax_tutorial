$(document).ready(function () {
    $('#insertForm').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Create a FormData object to send form data including files
        var formData = new FormData(this);

        $.ajax({
            url: 'insert_data.php', // PHP script to insert data
            method: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false, // Don't set content type (will be automatically set)
            processData: false, // Don't process data (FormData does this automatically)
            success: function (data) {
                if (data.success) {
                    $('#response').html('Data inserted successfully.');
                } else {
                    $('#response').html('Error inserting data.');
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                $('#response').html('An error occurred while inserting data.');
            }
        });
    });
});
