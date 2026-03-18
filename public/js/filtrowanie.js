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
        const logo = document.getElementById('logo');
        const search = document.getElementById('search');
        const rozmiar = document.getElementById('rozm');

        // Nasłuchiwanie na kliknięcie logo i kliknięcie poza polem wyszukiwania

        logo.addEventListener('click', (e) => {
            e.preventDefault();
            search.classList.toggle('active');
        });

        document.addEventListener('click', (e) => {
            if (!search.contains(e.target) && !logo.contains(e.target)) {
                search.classList.remove('active');
            }
        });


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
            const filtrujrozmiar = document.getElementById('rozm').value;
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
            const minValue = min.value.trim() === '' ? null : parseFloat(min.value);
            const maxValue = max.value.trim() === '' ? null : parseFloat(max.value);
            lista.forEach((item, index) => {
                const price = parseFloat(nowacena[index]);
                let show = true;
                if (minValue !== null && price < minValue) show = false;
                if (maxValue !== null && price > maxValue) show = false;
                item.classList.toggle('hidden', !show);
            });
        }

        //Wywoływanie funkcji filtrowania

        marka.addEventListener('input', filtrowanie);
        kat.addEventListener('input', filtrowanie);
        rodz.addEventListener('input', filtrowanie);
        rozmiar.addEventListener('input', filtrowanie);
        min.addEventListener('input', pocenie);
        max.addEventListener('input', pocenie);



});