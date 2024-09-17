document.addEventListener('DOMContentLoaded', function() {
    deleteCookie('cookies_accepted');

    document.getElementById('cookie-banner').style.display = 'block';

    document.getElementById('accept-cookies').addEventListener('click', function() {
        setCookie('cookies_accepted', 'true', 1); 
        guardarPreferenciaCookies('true'); 
        document.getElementById('cookie-banner').style.display = 'none';
    });

    document.getElementById('reject-cookies').addEventListener('click', function() {
        setCookie('cookies_accepted', 'false', 1); 
        guardarPreferenciaCookies('false'); 
        document.getElementById('cookie-banner').style.display = 'none';
    });

    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    function deleteCookie(name) {
        document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }

    function guardarPreferenciaCookies(preferencia) {
        const nickname = document.getElementById('nickname').value; 
    
        fetch('guardar_preferencia_cookies.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `cookies_accepted=${preferencia}&nickname=${nickname}` 
        })
        .then(response => response.text())
        .then(data => {
            console.log('Respuesta del servidor:', data);
        })
        .catch((error) => {
            console.error('Error al guardar la preferencia de cookies:', error);
        });
    }

    // const nicknameInput = document.getElementById('nickname');
    // const codigoInput = document.getElementById('codigo');
    // const botonIngresar = document.getElementById('boton_ingresar_sala');

    // botonIngresar.disabled = true;
    // botonIngresar.style.backgroundColor = "#ccc"; 

    // function checkInputs() {
    //     const nicknameValue = nicknameInput.value.trim();
    //     const codigoValue = codigoInput.value.trim();

    //     if (nicknameValue !== "" && codigoValue !== "") {
    //         botonIngresar.disabled = false;
    //         botonIngresar.style.backgroundColor = "#007BFF"; 
    //     } else {
    //         botonIngresar.disabled = true;
    //         botonIngresar.style.backgroundColor = "#ccc"; 
    //     }
    // }

    // nicknameInput.addEventListener('input', checkInputs);
    // codigoInput.addEventListener('input', checkInputs);
   
    
});
