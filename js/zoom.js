const artwork = document.getElementById('artwork');
const zoom = document.getElementById('zoom');

artwork.addEventListener('mousemove', (e) => {
    const rect = artwork.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    zoom.style.left = `${e.clientX - 50}px`;
    zoom.style.top = `${e.clientY - 50}px`;
    zoom.style.backgroundImage = `url(${artwork.src})`;
    zoom.style.backgroundSize = `${artwork.width * 2}px ${artwork.height * 2}px`;
    zoom.style.backgroundPosition = `-${x * 2}px -${y * 2}px`;
    zoom.style.display = 'block';
});

artwork.addEventListener('mouseleave', () => {
    zoom.style.display = 'none';
});