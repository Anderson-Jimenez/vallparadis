<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite("resources/css/app.css")
    <!--
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    -->
</head>
<body class="flex justify-center items-center bg-forms h-screen">
    <div class="flex bg-white-transparent w60 h-35vw text-center items-center rounded-2xl">
        <section class="w50">
            <img src="{{ asset('img/logo.png') }}" alt="logo_vallparadis">
            <h1>Benvinguts a la fundació VallParadís!</h1>
        </section>
        <section class="w40 text-center">
            <img src="{{ asset('img/login/Login_icon.png') }}" alt="icone_login" class="h-10vw">
            <h3>Login</h3>
            <form action={{route("equip_directiu.principal")}} method="POST" class="flex flex-wrap justify-center">
                <label for="name" class="w80">Nom d'usuari</label>
                <input type="name">
                <label for="username">Contrasenya</label>
                <input type="password" name="passwd">
                <a href="#">Has oblidat la contrasenya?</a>
                <input type="submit" value="Iniciar sesion">
            </form>
        </section>
    </div>

</body>


</html> 