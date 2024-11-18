// script.js

// Event listener para el botón de búsqueda
document.getElementById('searchButton').addEventListener('click', () => {
    const query = document.getElementById('searchInput').value;

    fetch(`http://localhost:3000/search?q=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(videos => {
            const videoResults = document.getElementById('videoResults');
            videoResults.innerHTML = '';

            if (videos.length > 0) {
                const video = videos[0]; // Tomamos el primer video de los resultados
            }
        })
        .catch(error => console.error('Error:', error));
});
