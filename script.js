document.addEventListener("DOMContentLoaded", function () {
        console.log("działa")
        // Get references to input and list
        const filtr = document.getElementById('filtr');
        const lista = document.querySelectorAll('.lista li');

        // Listen for input changes
        filtr.addEventListener('input', function () {
        const filterText = this.value.trim().toLowerCase();

        // Loop through list items and toggle visibility
        lista.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.classList.toggle('hidden', !text.includes(filterText));
        });
    });
});