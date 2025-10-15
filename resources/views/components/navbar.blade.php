<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <nav class="w-screen flex items-center justify-between p-4 bg-[#ff730060]">
        <img src="{{ asset('img/logo.png') }}" alt="logo_vallparadis" class="w-[15vw]">
        <div>
            <ul class="flex items-center mr-13">
                <li class="m-3"><a href="" class="txt-orange">Projects</a></li>
                <li class="m-3"><a href="" class="txt-orange">Compte</a></li>
                <li class="m-3"><a href="" class="txt-orange">Documents</a></li>
                <li class="m-3"><a href="" class="txt-orange">Professionals</a></li>
                <li class="m-3 txt-orange">Hola <strong>{{ Auth::user()->name }}</strong>👋</li>
            </ul>
        </div>
    </nav>
</body>
</html>