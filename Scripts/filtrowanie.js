document.addEventListener("DOMContentLoaded", function () {
        console.log("działa")
        // Get references to input and list
        const filtr = document.getElementById('filtr');
        const lista = document.querySelectorAll('.lista li');
        const marka = document.getElementById('marka');
        const kat = document.getElementById('kat');
        const rodz = document.getElementById('rodz');

        // Listen for input changes
        filtr.addEventListener('input', function () 
        {
            const filtrujtekst = this.value.trim().toLowerCase();

            // Loop through list items and toggle visibility
            lista.forEach(item => 
            {
                const text = item.textContent.toLowerCase();
                item.classList.toggle('hidden', !text.includes(filtrujtekst));
            });
        });
        marka.addEventListener('input', function () 
        {
            const filtrujmarki = this.value;
            lista.forEach(item => 
            {
                const marka = item.textContent;
                item.classList.toggle('hidden', !marka.includes(filtrujmarki));
            });
        });
        kat.addEventListener('input', function() 
        {
            const filtrujkat = this.value;
            lista.forEach(item => 
            {
                const kat = item.textContent;
                item.classList.toggle('hidden', !kat.includes(filtrujkat));
            });
        });
        rodz.addEventListener('input', function() 
        {
            const filtrujrodz = this.value;
            lista.forEach(item => 
            {
                const rodz = item.textContent;
                item.classList.toggle('hidden', !rodz.includes(filtrujrodz));
            });
        });

});