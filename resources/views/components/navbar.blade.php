<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <nav class="w-screen flex items-center justify-between p-4 bg-white border-b-15 border-[#ff7300]">
        <img src="{{ asset('img/logo.png') }}" alt="logo_vallparadis" class="w-[15vw]">
        <div>
            <ul class="flex items-center mr-13">
                <li class="m-3 txt-orange">
                    si
                </li>
                <li class="m-3 txt-orange">Hola <strong>{{ Auth::user()->name }}</strong>👋</li>
            </ul>
        </div>
    </nav>
</body>
</html>