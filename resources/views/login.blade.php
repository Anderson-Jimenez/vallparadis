<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    @vite("resources/css/app.css")

</head>
<body>
    <main class="bg-gradient-login h-screen flex justify-center items-center bg-cover">
        @include('partials.icons')
        
        <div class="flex bg-login bg-cover w-[60vw] h-[70vh] items-center rounded-2xl shadow-black-200 shadow-2xl">
            <section class="h-full w-[40vw] flex flex-col justify-center items-center relative ">
                <img src="{{ asset('img/logo.png') }}" alt="logo_vallparadis" class="absolute top-5 left-5 w-[15vw]">
                <h1 class="text-login text-5xl font-bold text-center">Benvinguts a la fundació VallParadís!</h1>
            </section>

            <section class="w-[30vw] text-center flex items-center justify-around flex-col">
                <img src="{{ asset('img/login/Login_icon.png') }}" alt="icone_login" class="h-[25vh] w-[12vw]">
                <h3 class="text-login w-4/5 font-bold text-3xl mb-2">Login</h3>
                <form action="{{route('login.submit') }}" method="POST" class="flex flex-wrap justify-center">
                    @csrf
                    <label for="username" class="text-login w-full">Nom d'usuari</label>
                    <input type="name" name="username" class="w-4/5 bg-white h-8 rounded-4xl my-1 p-5">
                    <label for="password" class ="text-login w-full my-1">Contrasenya</label>
                    <input type="password" name="password" class="w-4/5 bg-white h-8 rounded-4xl my-1 p-5">
                    <a href="#" class="text-login underline p-2 w-full my-1">Has oblidat la contrasenya?</a>
                    <input type="submit" value="Iniciar sesión" class="bg-[#FF7400] rounded-2xl text-white w-[10vw] h-[5vh] hover:bg-[#f8c49a] cursor-pointer transition duration-500"/>
                </form>
            </section>
    </div>
    </main>
</body>


</html> 