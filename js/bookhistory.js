document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.status-cancelled').forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const id = button.getAttribute('data-id'); // Retrieve the booking ID
            const slotNo = button.closest('tr').querySelector('td:nth-child(2)').innerText;
            console.log(slotNo); // For debugging purposes, to see the slot number

            if (confirm('Are you sure you want to cancel this booking?')) {
                fetch('../htmlphp/cancelbooking.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: id }) // Send the booking ID to the server
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        button.closest('tr').remove(); // Remove the row from the table
                    } else {
                        alert('Failed to cancel booking. Please try again.');
                        console.error('Error:', data.error); // Log the error for debugging
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });
});
