document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Gracias por tu mensaje, nos pondremos en contacto contigo pronto.');
    this.reset();
});

function agregarAlCarrito(producto) {
    alert(producto + ' ha sido agregado al carrito.');
}

const menuToggle = document.getElementById('menu-toggle');
const navbar = document.getElementById('navbar');

menuToggle.addEventListener('click', () => {
  navbar.classList.toggle('show');
});

