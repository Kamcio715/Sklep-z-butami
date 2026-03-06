document.addEventListener("DOMContentLoaded", function () {
    var platnosc = document.getElementsByName("platnosc").value;
    var metoda = document.getElementById("metoda");
    platnosc.onchange = dane();

    function dane() {
        if(platnosc == karta)
        {
            // metoda.innerHTML = "<h1>Podaj numer karty</h1> <input type='text' name='numer'><br><h1>Podaj datę ważności</h1><input type'text' name='data'><br><h1>Podaj numer</h1><input type='text' name='nr'>"
            console.log("Karta")
        }
        else if(platnosc == blik)
        {
            console.log("blik")
        }
        else if(platnosc == pobranie)
        {
            console.log("pobranie")
        }
    }
});