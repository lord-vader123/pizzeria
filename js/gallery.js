const imagePath = '/pizzeria/assets/pizza/';
const images = [
    'pizza.webp',
    'pizza1.webp',
    'pizza2.webp',
    'pizza3.webp',
    'pizza4.webp',
    'pizza5.webp',
];

let currentIndex = 0;

function renderGallery() {
    const gallery = document.getElementById('gallery-images');
    gallery.innerHTML = '';
    const img = document.createElement('img');
    img.src = imagePath + images[currentIndex];
    img.alt = "Pizza obrazek";
    gallery.appendChild(img);
}

function showNextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    renderGallery();
}

function showPrevImage() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    renderGallery();
}

document.getElementById('next').addEventListener('click', showNextImage);
document.getElementById('prev').addEventListener('click', showPrevImage);

renderGallery();  
