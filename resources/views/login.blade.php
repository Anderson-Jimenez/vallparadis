<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    @vite("resources/css/app.css")

</head>
<body class="flex justify-center items-center bg-forms h-screen">

    <div class="flex bg-white-transparent w-[60vw] h-[70vh] text-center items-center rounded-2xl">
        <section class="w-[50vw]">
            <img src="{{ asset('img/logo.png') }}" alt="logo_vallparadis">
            <h1>Benvinguts a la fundació VallParadís!</h1>
        </section>
        <section class="w2/5 text-center">
            <img src="{{ asset('img/login/Login_icon.png') }}" alt="icone_login" class="h-[25vh]">
            <h3>Login</h3>
            <form action="{{route('login.submit') }}" method="POST" class="flex flex-wrap justify-center">
                @csrf
                <label for="name" class="w4/5">Nom d'usuari</label>
                <input type="name" name="name">
                <label for="username">Contrasenya</label>
                <input type="password" name="passwd">
                <a href="#">Has oblidat la contrasenya?</a>
                <input type="submit" value="Iniciar sesion">
            </form>
        </section>
    </div>

</body>


</html> 