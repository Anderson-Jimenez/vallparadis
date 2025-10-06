<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
</head>
<body class="row">
    <div class="login w60 row">
        <section class="w50">
            <h1>Benvinguts a la fundació VallParadís!</h1>
        </section>
        <section class="w50">
            <form>
                <!-- Username -->
                <label for="name">Usuari:</label>
                <input type="name">
                <!-- Password -->
                <label for="username">Contrasenya:</label>
                <p><a href="#">Has oblidat la contrasenya?</a>
                <input type="password">
                <input type="submit" value="Login">
        </form>
        </section>
    </div>
</body>
</html> 