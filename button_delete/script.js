$(document).ready(function () {
    // Function to retrieve and render the list of names
    function fetchAndRenderNames() {
        $.ajax({
            url: 'get_names.php', // PHP script to retrieve names
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                let outputHTML = '<ul>';
                if (data.length > 0) {
                    data.forEach(function (item) {
                        outputHTML += `
                            <li>
                                ${item.fname}
                                <button class="deleteBtn" data-fname="${item.fname}">Delete</button>
                            </li>
                        `;
                    });
                } else {
                    outputHTML += '<li>No data available.</li>';
                }
                outputHTML += '</ul>';
                $('#output').html(outputHTML);
            },
            error: function (xhr, status, error) {
                console.error(error);
                $('#output').html('An error occurred while fetching data.');
            }
        });
    }

    // Initial rendering of names
    fetchAndRenderNames();

    // Handle delete button click
    $('#output').on('click', '.deleteBtn', function () {
        let fnameToDelete = $(this).data('fname');

        $.ajax({
            url: 'delete_name.php', // PHP script to delete a name
            method: 'POST',
            data: { fname: fnameToDelete },
            dataType: 'json',
            success: function (data) {
                fetchAndRenderNames(); // Refresh the list after deletion
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});
