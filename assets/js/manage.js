$(document).ready(function(){
    // Function to fetch and display records
    function fetchRecords() {
        $.ajax({
            url: 'fetch.php',
            type: 'GET',
            success: function(response) {
                $('#records').html(response);
            }
        });
    }

    // Fetch records on page load
    fetchRecords();

    // Add record
    $('#crud-form').on('submit', function(e){
        e.preventDefault();
        var name = $('#name').val();
        var email = $('#email').val();
        $.ajax({
            url: 'add.php',
            type: 'POST',
            data: {name: name, email: email},
            success: function(response) {
                fetchRecords();
                $('#name').val('');
                $('#email').val('');
            }
        });
    });

    // Delete record
    $(document).on('click', '.delete', function(){
        var id = $(this).data('id');
        $.ajax({
            url: 'delete.php',
            type: 'POST',
            data: {id: id},
            success: function(response) {
                fetchRecords();
            }
        });
    });
});
