console.log("działa")
const filtr = document.getElementById("filtr");
const items = document.querySelectorAll(".lista li");

filtr.addEventListener('input', function() {
    const filtrujtekst = this.value.trim().toLowerCase();

    items.forEach(item => {
        const text = item.textContent.toLowerCase();
        item.classList.toggle('hidden', !text.includes(filtrujtekst))
    });
});