document.getElementById('adminform').addEventListener('submit', function(event) {
    event.preventDefault();
    // var form = this;
    var formData = new FormData(document.getElementById('adminform'));

    fetch('../htmlphp/adminlogin.php', {
        method: 'POST',
        body: formData
    })
    .then(response =>{
        return response.json();
    })
    .then(data => {
        if (data.success) {
            document.getElementById('errormsg').style.display = 'none';
            window.location.href = 'admindash.php'; // Redirect to welcome page on success
        } else {
            document.getElementById('errormsg').style.display = 'block';
        }
    })
    // .catch(error => console.error('Error:', error));
});
