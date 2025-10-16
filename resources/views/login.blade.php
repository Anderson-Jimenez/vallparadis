<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    @vite("resources/css/app.css")

</head>
<body class="bg-forms ">
    <main class="bg-geometrical h-screen flex justify-center items-center bg-cover">
        @include('partials.icons')
        
        <div class="flex bg-white-transparent w-[60vw] h-[70vh] items-center rounded-2xl">
            <section class="h-full w-[60vw] flex flex-col justify-center items-center relative ">
                
                <img src="{{ asset('img/logo.png') }}" alt="logo_vallparadis" class="absolute top-5 left-5 w-[15vw]">
                <h1 class="txt-orange text-4xl font-bold text-center">Benvinguts a la fundació VallParadís!</h1>
            </section>

            <section class="w-[40vw] text-center flex justify-center flex-wrap">
                <img src="{{ asset('img/login/Login_icon.png') }}" alt="icone_login" class="h-[25vh]">
                <h3 class="txt-orange w-4/5 font-bold text-2xl">Login</h3>
                <form action="{{route('login.submit') }}" method="POST" class="flex flex-wrap justify-center">
                    @csrf
                    <label for="name" class="txt-orange">Nom d'usuari</label>
                    <input type="name" name="name">
                    <label for="username" class ="txt-orange">Contrasenya</label>
                    <input type="password" name="passwd">
                    <a href="#" class="txt-orange underline p-2">Has oblidat la contrasenya?</a>
                    <input type="submit" value="Iniciar sesión" class="bg-[#FF7400] rounded-2xl w-[10vw] h-[5vh] hover:bg-[#f8c49a] cursor-pointer transition duration-500"/>
                </form>
            </section>
    </div>
    </main>
</body>


</html> 