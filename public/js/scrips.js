document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.card');

    cards.forEach(card => {
        card.addEventListener('click', () => {
            // Cierra todas las tarjetas primero
            cards.forEach(c => c.classList.remove('expanded'));

            // Expande la tarjeta actual
            card.classList.toggle('expanded');
        });
    });
});