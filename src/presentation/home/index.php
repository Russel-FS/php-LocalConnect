<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data="{ show: false }">
    <div class="h-screen w-screen bg-gray-100 flex justify-center items-center">
        <div class="bg-gray-50 text-black mx-auto rounded-lg p-4">
            <h2 class="text-2xl font-bold">Hello World</h2>
            <button @click="show = !show" class="bg-blue-500 text-white px-4 py-2 rounded-md">Show</button>
            <div x-show="show">
                <h1>Hello World</h1>
                <button @click="show = !show" class="bg-red-500 text-white px-4 py-2 rounded-md">Hide</button>
            </div>
        </div>
    </div>
</body>

</html>