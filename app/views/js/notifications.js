document.getElementById("passwordForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    
    fetch('../../controllers/PasswordController.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const notification = document.getElementById("notification");
        notification.classList.remove("error", "success");
        notification.classList.add(data.status);
        notification.textContent = data.message;

        if (data.status === 'success') {
            setTimeout(() => {
                window.location.href = 'dashboard-view.php';
            }, 2000);
        }
    })
    .catch(error => {
        const notification = document.getElementById("notification");
        notification.classList.add("error");
        notification.textContent = "Error de conexión con el servidor.";
    });
});
