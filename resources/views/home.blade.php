<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Jersey Apparel</title>
    <!-- Include Tailwind CSS -->
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-100">
    <!-- Navigation -->
    <nav class="bg-slate-200 p-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-green-700 text-xl font-semibold">New Jersey Apparel</a>
            <ul class="flex space-x-4">
                <li><a href="#" class="text-green-700">Home</a></li>
                <li><a href="#" class="text-green-700">Products</a></li>
                <li><a href="#" class="text-green-700">About</a></li>
                <li><a href="#" class="text-green-700">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-green-500 text-white py-20 px-6">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to New Jersey Apparel</h1>
            <p class="text-lg">Discover the latest trends in fashion with our exclusive collection.</p>
            <button class="bg-white text-green-700 px-8 py-3 mt-6 rounded-full hover:bg-opacity-75">Shop Now</button>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-20 px-6">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-center text-green-700">Featured Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <!-- Sample Product Card (Replace with actual products) -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <img src="https://via.placeholder.com/300" alt="Product" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">Product Name</h3>
                        <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="mt-4">
                            <span class="text-green-700 font-bold">$99.99</span>
                            <button class="ml-4 bg-green-700 text-white px-4 py-2 rounded-full hover:bg-opacity-75">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <!-- Repeat the above card for other featured products -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-200 text-green-700 py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 New Jersey Apparel. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
