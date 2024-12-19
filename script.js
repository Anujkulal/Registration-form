
$(document).ready(function () {
    $("#registrationForm").on("submit", function (e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "process.php",
            data: formData,
            success: function (response) {
                // Replace the entire content of the page with the response
                document.open();
                document.write(response);
                document.close();
            },
            error: function () {
                alert("An error occurred. Please try again later.");
            }
        });
    });
});

