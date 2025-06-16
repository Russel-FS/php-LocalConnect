<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="module" src="../js/app.js"></script>
</head>

<body>
    <div class="h-screen w-screen bg-gray-100 flex justify-center items-center">
        <div x-data="toggleComponent" class="bg-gray-50 text-black mx-auto rounded-lg p-4 w-1/2 flex justify-center flex-col items-center gap-5">
            <h2 class="text-2xl font-bold">Texto de test</h2>
            <button @click="toggle()" class="bg-blue-500 text-white px-4 py-2 rounded-md transition-all duration-300">Mostrar</button>
            <div x-show="show" class="transition-all duration-300 animate-bounce">
                <h1>Hello World</h1>
            </div>
        </div>
    </div>
</body>

</html>