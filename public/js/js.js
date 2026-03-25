document.addEventListener('DOMContentLoaded', function () {
    const filtr = document.getElementById('filtr');
    const lista = document.querySelectorAll('.lista li');
    const marka = document.getElementById('marka');
    const kat = document.getElementById('kat');
    const rodz = document.getElementById('rodz');
    const min = document.getElementById('min');
    const max = document.getElementById('max');

    const originalBrandOptions = Array.from(marka.options).map(option => ({
        value: option.value,
        label: option.textContent.split(' (')[0]
    }));

    const originalCategoryOptions = Array.from(kat.options).map(option => ({
        value: option.value,
        label: option.textContent.split(' (')[0]
    }));

    const originalTypeOptions = Array.from(rodz.options).map(option => ({
        value: option.value,
        label: option.textContent.split(' (')[0]
    }));

    function matchesFilters(item, ignoreFilter = null) {
        const text = (item.dataset.name + ' ' + item.dataset.brand + ' ' + item.dataset.category + ' ' + item.dataset.type).toLowerCase();
        const brand = item.dataset.brand;
        const category = item.dataset.category;
        const type = item.dataset.type;
        const price = parseFloat(item.dataset.price);

        const textValue = filtr.value.trim().toLowerCase();
        const brandValue = marka.value.toLowerCase();
        const categoryValue = kat.value.toLowerCase();
        const typeValue = rodz.value.toLowerCase();
        const minValue = parseFloat(min.value);
        const maxValue = parseFloat(max.value);

        if (textValue && !text.includes(textValue)) return false;
        if (ignoreFilter !== 'brand' && brandValue && brand !== brandValue) return false;
        if (ignoreFilter !== 'category' && categoryValue && category !== categoryValue) return false;
        if (ignoreFilter !== 'type' && typeValue && type !== typeValue) return false;
        if (!isNaN(minValue) && price < minValue) return false;
        if (!isNaN(maxValue) && price > maxValue) return false;

        return true;
    }

    function updateVisibility() {
        lista.forEach(item => {
            item.classList.toggle('hidden', !matchesFilters(item));
        });
    }

    function updateOptionCounts(select, originalOptions, key, ignoreFilter) {
        Array.from(select.options).forEach((option, index) => {
            const original = originalOptions[index];
            if (!original) return;

            if (option.value === '') {
                const count = Array.from(lista).filter(item => matchesFilters(item, ignoreFilter)).length;
                option.textContent = `${original.label} (${count})`;
            } else {
                const count = Array.from(lista).filter(item => {
                    if (!matchesFilters(item, ignoreFilter)) return false;
                    return item.dataset[key] === option.value.toLowerCase();
                }).length;

                option.textContent = `${original.label} (${count})`;
            }
        });
    }

    function applyAll() {
        updateVisibility();
        updateOptionCounts(marka, originalBrandOptions, 'brand', 'brand');
        updateOptionCounts(kat, originalCategoryOptions, 'category', 'category');
        updateOptionCounts(rodz, originalTypeOptions, 'type', 'type');
    }

    filtr.addEventListener('input', applyAll);
    marka.addEventListener('input', applyAll);
    kat.addEventListener('input', applyAll);
    rodz.addEventListener('input', applyAll);
    min.addEventListener('input', applyAll);
    max.addEventListener('input', applyAll);

    applyAll();
});
