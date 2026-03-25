document.addEventListener('DOMContentLoaded', function () {
    const filtr = document.getElementById('filtr');
    const marka = document.getElementById('marka');
    const kat = document.getElementById('kat');
    const rodz = document.getElementById('rodz');
    const min = document.getElementById('min');
    const max = document.getElementById('max');
    const lista = document.querySelectorAll('.lista li');
    const liczbaProduktow = document.getElementById('liczba-produktow');

    function applyFilters() {
        const tekst = filtr.value.trim().toLowerCase();
        const wybranaMarka = marka.value.toLowerCase();
        const wybranaKategoria = kat.value.toLowerCase();
        const wybranyRodzaj = rodz.value.toLowerCase();
        const minCena = parseFloat(min.value);
        const maxCena = parseFloat(max.value);

        let widoczne = 0;

        lista.forEach(item => {
            const text = item.textContent.toLowerCase();
            const cenaElement = item.querySelector('.cena');
            let cena = 0;

            if (cenaElement) {
                cena = parseFloat(
                    cenaElement.textContent
                        .replace('zł', '')
                        .replace(',', '.')
                        .replace(/\s/g, '')
                );
            }

            const pasujeTekst = !tekst || text.includes(tekst);
            const pasujeMarka = !wybranaMarka || text.includes(wybranaMarka);
            const pasujeKategoria = !wybranaKategoria || text.includes(wybranaKategoria);
            const pasujeRodzaj = !wybranyRodzaj || text.includes(wybranyRodzaj);
            const pasujeMin = isNaN(minCena) || cena >= minCena;
            const pasujeMax = isNaN(maxCena) || cena <= maxCena;

            const pokaz =
                pasujeTekst &&
                pasujeMarka &&
                pasujeKategoria &&
                pasujeRodzaj &&
                pasujeMin &&
                pasujeMax;

            item.classList.toggle('hidden', !pokaz);

            if (pokaz) {
                widoczne++;
            }
        });

        if (liczbaProduktow) {
            liczbaProduktow.textContent = `Znaleziono: ${widoczne} produktów`;
        }
    }

    filtr.addEventListener('input', applyFilters);
    marka.addEventListener('change', applyFilters);
    kat.addEventListener('change', applyFilters);
    rodz.addEventListener('change', applyFilters);
    min.addEventListener('input', applyFilters);
    max.addEventListener('input', applyFilters);

    applyFilters();
});
