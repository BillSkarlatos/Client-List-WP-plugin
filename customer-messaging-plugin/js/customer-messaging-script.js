jQuery(document).ready(function ($) {
    $('#send-button').on('click', function () {
        var selectedNumbers = $('input[name="selected_numbers[]"]:checked').map(function () {
            return $(this).val();
        }).get();

        if (selectedNumbers.length === 0) {
            alert('Please select at least one customer number.');
            return;
        }

        var message = $('#message').val();

        if (message.length === 0) {
            alert('Please enter a message.');
            return;
        }

        // Show popup messages
        var popupMessages = selectedNumbers.map(function (number) {
            return 'Sending to ' + number + '\n';
        });

        $('#popup-message').text(popupMessages.join('\n')).show().delay(2000).fadeOut();

        // Reset form after sending
        $('#customer-messaging-form')[0].reset();
    });
});
