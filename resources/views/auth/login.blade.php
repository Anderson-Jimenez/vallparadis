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
        
        <div class="flex w-[55vw] h-[75vh] items-center rounded-3xl shadow-orange-100 shadow-2xl">
            <section class="h-full w-4/6 bg-login  bg-cover flex flex-col justify-center items-center relative rounded-l-3xl">
                <img src="{{ asset('img/logo.png') }}" alt="logo_vallparadis" class="absolute top-5 left-5 w-[13vw]">
                <h1 class="text-login text-5xl font-bold text-center">Benvinguts a la fundació VallParadís!</h1>
            </section>
            <section class="w-2/6 h-full text-center bg-white rounded-r-3xl flex items-center  justify-center flex-col">
                <img src="{{ asset('img/login/Login_icon.png') }}" alt="icone_login" class="h-1/4 w-2/4">
                <h3 class="text-login w-4/5 font-bold text-2xl py-2">Login</h3>
                <form action="{{route('login.submit') }}" method="POST" class="flex flex-wrap justify-center">
                    @csrf
                    <label for="username" class="text-login w-full text-left pl-[2vw]">Nom d'usuari</label>

                    <input type="name" name="username" class="w-4/5 bg-black-transparent h-8 rounded-3xl my-1 p-5">
                    
                    <label for="password" class ="text-login w-full my-1 text-left pl-[2vw]">Contrasenya</label>
                    <input type="password" name="password" class="w-4/5 bg-black-transparent h-8 rounded-3xl my-1 p-5">
                    <input type="submit" value="Iniciar sesión" class="bg-[#FF7400] rounded-2xl text-sm text-white w-[10vw] h-[5vh] hover:bg-[#f8c49a] cursor-pointer transition duration-500"/>
                </form>
            </section>
        </div>
    </main>
</body>


</html> 