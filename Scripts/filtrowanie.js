document.addEventListener("DOMContentLoaded", function () {
        // Zmienne do przechowywania elementów DOM

        const filtr = document.getElementById('filtr');
        const lista = document.querySelectorAll('.lista li');
        const nazwa = document.querySelectorAll('.nazwa');
        const marka = document.getElementById('marka');
        const kat = document.getElementById('kat');
        const rodz = document.getElementById('rodz');
        const cena = document.querySelectorAll('.cena');
        var nowacena = new Array();
        const min = document.getElementById('min');
        const max = document.getElementById('max');

        // Nasłuchiwanie na wpisywanie tekstu w filtrze

        filtr.addEventListener('input', function () 
        {
            const filtrujtekst = this.value.trim().toLowerCase();

            nazwa.forEach(item => 
            {
                const text = item.textContent.toLowerCase();
                const li = item.closest('li');  // Znajdź najbliższy element li
                li.classList.toggle('hidden', !text.includes(filtrujtekst));
            });
        });

        // Przetwarzanie cen i przechowywanie ich w atrybucie data-price

        cena.forEach(item =>
        {
            nowacena.push(item.textContent.replace(' zł', ''));
            item.dataset.price = nowacena[nowacena.length - 1];
        });


        // Funkcja do filtrowania

        function filtrowanie()
        {
            const filtrujmarki = document.getElementById('marka').value;
            const filtrujkat = document.getElementById('kat').value;
            const filtrujrodz = document.getElementById('rodz').value;
            lista.forEach(item =>
            {
                const text = item.textContent;
                if(text.includes(filtrujmarki) && text.includes(filtrujkat) && text.includes(filtrujrodz))
                {
                    item.classList.remove('hidden');
                }
                else
                {
                    item.classList.add('hidden');
                }
            });
        }

        // Funkcja do filtrowania po cenie

        function pocenie() {
            const minValue = parseFloat(min.value);
            const maxValue = parseFloat(max.value);
            lista.forEach(item => {
                const price = nowacena[Array.from(lista).indexOf(item)];
                if (!isNaN(minValue) && !isNaN(maxValue)) {
                    if (price >= minValue && price <= maxValue) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                }
                else
                {
                    item.classList.remove('hidden');
                }
            });

        }

        //Wywoływanie funkcji filtrowania

        marka.addEventListener('input', filtrowanie);
        kat.addEventListener('input', filtrowanie);
        rodz.addEventListener('input', filtrowanie);
        min.addEventListener('input', pocenie);
        max.addEventListener('input', pocenie);

});