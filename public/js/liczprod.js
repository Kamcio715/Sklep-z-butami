document.addEventListener('DOMContentLoaded', function () {

    // Pobierz elementy DOM

    const filtr = document.getElementById('filtr');
    const marka = document.getElementById('marka');
    const kat = document.getElementById('kat');
    const rodz = document.getElementById('rodz');
    const min = document.getElementById('min');
    const max = document.getElementById('max');
    const lista = Array.from(document.querySelectorAll('.lista li'));
    const liczbaProduktow = document.getElementById('liczba-produktow');

    function normalize(value) {
        return (value || '').toString().trim().toLowerCase();
    }

    function getPrice(item) {
        const cenaElement = item.querySelector('.cena');
        if (!cenaElement) return 0;

        return parseFloat(
            cenaElement.textContent
                .replace('zł', '')
                .replace(',', '.')
                .replace(/\s/g, '')
        ) || 0;
    }

    function getFilters() {
        return {
            tekst: normalize(filtr?.value),
            marka: normalize(marka?.value),
            kategoria: normalize(kat?.value),
            rodzaj: normalize(rodz?.value),
            minCena: min && min.value.trim() !== '' ? parseFloat(min.value) : null,
            maxCena: max && max.value.trim() !== '' ? parseFloat(max.value) : null
        };
    }

    function matches(item, filters, skip = null) {
        const text = item.textContent.toLowerCase();
        const cena = getPrice(item);

        const pasujeTekst = skip === 'tekst' || !filters.tekst || text.includes(filters.tekst);
        const pasujeMarka = skip === 'marka' || !filters.marka || text.includes(filters.marka);
        const pasujeKategoria = skip === 'kategoria' || !filters.kategoria || text.includes(filters.kategoria);
        const pasujeRodzaj = skip === 'rodzaj' || !filters.rodzaj || text.includes(filters.rodzaj);
        const pasujeMin = skip === 'cena' || filters.minCena === null || cena >= filters.minCena;
        const pasujeMax = skip === 'cena' || filters.maxCena === null || cena <= filters.maxCena;

        return (
            pasujeTekst &&
            pasujeMarka &&
            pasujeKategoria &&
            pasujeRodzaj &&
            pasujeMin &&
            pasujeMax
        );
    }

    function updateSelectCounts(select, type, filters) {
        if (!select) return;

        Array.from(select.options).forEach(option => {
            const optionValue = normalize(option.value);

            if (!option.dataset.baseLabel) {
                option.dataset.baseLabel = option.textContent.replace(/\s*\(\d+\)\s*$/, '').trim();
            }

            const baseLabel = option.dataset.baseLabel;

            if (optionValue === '') {
                const allCount = lista.filter(item => matches(item, filters, type)).length;
                option.textContent = `${baseLabel} (${allCount})`;
                option.disabled = false;
                return;
            }

            const count = lista.filter(item => {
                const text = item.textContent.toLowerCase();
                return matches(item, filters, type) && text.includes(optionValue);
            }).length;

            option.textContent = `${baseLabel} (${count})`;
            option.disabled = count === 0;
        });

        const selected = select.options[select.selectedIndex];
        if (selected && selected.disabled) {
            select.value = '';
        }
    }

    function applyFilters() {
        const filters = getFilters();
        let widoczne = 0;

        lista.forEach(item => {
            const pokaz = matches(item, filters);
            item.classList.toggle('hidden', !pokaz);

            if (pokaz) {
                widoczne++;
            }
        });

        if (liczbaProduktow) {
            liczbaProduktow.textContent = `Znaleziono: ${widoczne} produktów`;
        }

        updateSelectCounts(marka, 'marka', filters);
        updateSelectCounts(kat, 'kategoria', filters);
        updateSelectCounts(rodz, 'rodzaj', filters);
    }

    if (filtr) filtr.addEventListener('input', applyFilters);
    if (marka) marka.addEventListener('change', applyFilters);
    if (kat) kat.addEventListener('change', applyFilters);
    if (rodz) rodz.addEventListener('change', applyFilters);
    if (min) min.addEventListener('input', applyFilters);
    if (max) max.addEventListener('input', applyFilters);

    applyFilters();
});