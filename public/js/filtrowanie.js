document.addEventListener("DOMContentLoaded", function () 
{
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
        const reset = document.getElementById('reset');
        const rozmiar = document.getElementById('rozm');

        // Funkcja do filtrowania

        function filtrowanie() {
            const filtrujmarki = marka.value.trim().toLowerCase();
            const filtrujkat = kat.value.trim().toLowerCase();
            const filtrujrodz = rodz.value.trim().toLowerCase();
            const filtrujtekst = filtr.value.trim().toLowerCase();

            lista.forEach(item => {
                const text = item.textContent.toLowerCase();
                const nazwaTekst = item.querySelector('.nazwa')?.textContent.toLowerCase() || '';

                let visible = true;

                if (filtrujtekst && !nazwaTekst.includes(filtrujtekst)) visible = false;
                if (filtrujmarki && !text.includes(filtrujmarki)) visible = false;
                if (filtrujkat && !text.includes(filtrujkat)) visible = false;
                if (filtrujrodz && !text.includes(filtrujrodz)) visible = false;

                item.classList.toggle('hidden', !visible);
            });
        }

        // Przetwarzanie cen i przechowywanie ich w atrybucie data-price

        cena.forEach(item => {
            nowacena.push(item.textContent.replace(' zł', ''));
            item.dataset.price = nowacena[nowacena.length - 1];
        });

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

        function resetFilters() {
            marka.value = '';
            kat.value = '';
            rodz.value = '';
            min.value = '';
            max.value = '';
            filtr.value = '';
            lista.forEach(item => item.classList.remove('hidden'));
        }

        //Wywoływanie funkcji filtrowania

        marka.addEventListener('input', filtrowanie);
        kat.addEventListener('input', filtrowanie);
        rodz.addEventListener('input', filtrowanie);
        // rozmiar.addEventListener('input', filtrowanie);
        min.addEventListener('input', pocenie);
        max.addEventListener('input', pocenie);
        filtr.addEventListener('input', filtrowanie);
        reset.addEventListener('click', resetFilters);
    });