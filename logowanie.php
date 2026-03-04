<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie na stronie</title>
    <link rel="stylesheet" href="formularz.css">
</head>
<body>
    <!-- Nagłówek -->
    <header class="naglowek">
        <a class="lewo" href="index.html"><img src="images/logo.png" alt="logo strony"></a>
        <h1 class="tytul">Buty.pl</h1>
        <div class="prawo">
            <a href="logowanie.html">Logowanie</a>
            <a href="rejestracja.html">Rejestracja</a>
            <a href="koszyk.html"><img class="koszyk" src="images/koszyk.png" alt="koszyk"></a>
        </div>
    </header>
    <!-- Formularz logowania -->
    <div class="formularz">
        <form action="logowanie.php" method="post">
            <p>Zaloguj się</p>
            <h1>Podaj nazwę użytkownika:</h1>
            <input type="text" name="nazwa"><br>
            <h1>Podaj hasło:</h1>
            <input type="text" name="pass"><br>
            <?php
                if (TRUE)
                {
                    fopen("index.html","r+");
                }
                else
                    echo"Błędne dane logowania";
            ?>
            <input type="submit" class="guzik" value="Zaloguj się">
        </form>
    </div>
</body>
</html>