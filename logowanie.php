<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie na stronie</title>
    <link rel="stylesheet" href="Styles/formularz.css">
    <link rel="stylesheet" href="Styles/naglowek.css">
</head>
<body>
    <!-- Nagłówek -->
    <header class="naglowek">
        <a class="lewo" href="index.html"><img src="Images/logo.png" alt="logo strony"></a>
        <h1 class="tytul">Buty.pl</h1>
        <div class="prawo">
            <a href="logowanie.html">Logowanie</a>
            <a href="rejestracja.html">Rejestracja</a>
            <a href="koszyk.html"><img class="koszyk" src="Images/koszyk.png" alt="koszyk"></a>
            <a href="uzytkownik.html"><img src="Images/user.png" alt="ikona użytkownika"></a>
        </div>
    </header>
    <!-- Formularz logowania -->
    <div class="formularz">
        <form action="logowanie.php" method="post" style="margin-top: 7%;">
            <p>Zaloguj się</p>
            <input type="text" name="nazwa" placeholder="Podaj nazwę użytkownika"><br>
            <input type="password" name="pass" placeholder="Podaj hasło"><br>
            <!-- php -->
            <?php
                $user['nazwa'] = $_POST['nazwa'];
                $user['pass'] = $_POST['pass'];
                if ($user['nazwa'] == TRUE)
                {
                    $url = "index.html";
                    header("Location: $url");
                    exit();
                }
                else
                {
                    echo"Błędne dane logowania";
                }
            ?>
            <input type="submit" class="guzik" value="Zaloguj się">
        </form>
    </div>
</body>
</html>