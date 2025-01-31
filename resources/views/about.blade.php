<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Bimbingan Belajar Pintar') }}</title>
    <link rel="icon" href="{{ asset('asset/img/favico.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script defer src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-50 text-gray-800 font-sans">
    @include('layouts.front-navigation')

    <main>
        <!-- Sejarah Bimbel -->
        <section id="sejarah" class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Sejarah Bimbingan Belajar Pintar</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Perjalanan kami dalam membangun bimbingan belajar yang berkualitas.</p>
                </div>

                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="rounded-2xl overflow-hidden shadow-lg" data-aos="fade-right">
                        <img src="{{ asset('asset/img/sejarah-bimbel.jpg') }}" alt="Sejarah Bimbel" class="w-full h-auto">
                    </div>
                    <div class="space-y-6" data-aos="fade-left">
                        <h3 class="text-3xl font-bold text-gray-800">Awal Mula Berdiri</h3>
                        <p class="text-gray-600">Bimbingan Belajar Pintar didirikan pada tahun 2010 oleh seorang pendidik yang memiliki passion besar dalam dunia pendidikan. Awalnya, bimbel ini hanya memiliki satu ruang kelas kecil dengan beberapa siswa.</p>
                        <p class="text-gray-600">Seiring berjalannya waktu, berkat dedikasi dan komitmen untuk memberikan pendidikan terbaik, Bimbingan Belajar Pintar berkembang pesat. Kini, kami memiliki puluhan cabang di seluruh Indonesia dan telah membantu ribuan siswa meraih prestasi akademik.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Profil Pendiri -->
        <section id="pendiri" class="py-24 bg-gradient-to-br from-blue-50 to-indigo-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Profil Pendiri</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Sosok di balik kesuksesan Bimbingan Belajar Pintar.</p>
                </div>

                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="rounded-2xl overflow-hidden shadow-lg" data-aos="fade-right">
                        <img src="{{ asset('asset/img/pendiri.jpg') }}" alt="Pendiri Bimbel" class="w-full h-auto">
                    </div>
                    <div class="space-y-6" data-aos="fade-left">
                        <h3 class="text-3xl font-bold text-gray-800">Nama Pendiri</h3>
                        <p class="text-gray-600">Nama Pendiri adalah seorang pendidik yang telah berkecimpung di dunia pendidikan selama lebih dari 15 tahun. Beliau memiliki visi untuk menciptakan sistem pembelajaran yang efektif dan menyenangkan bagi siswa.</p>
                        <p class="text-gray-600">Dengan latar belakang pendidikan di bidang Matematika dan Fisika, beliau percaya bahwa setiap siswa memiliki potensi untuk meraih prestasi terbaik jika diberikan metode pembelajaran yang tepat.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-blue-500 hover:text-blue-600">
                                <i data-feather="linkedin" class="h-5 w-5"></i>
                            </a>
                            <a href="#" class="text-blue-500 hover:text-blue-600">
                                <i data-feather="mail" class="h-5 w-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer dengan Design Modern -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-12 mb-8">
                <div>
                    <div class="flex items-center mb-6">
                        <img src="{{ asset('asset/img/favico.png') }}" alt="Bimbel Logo" class="h-10 w-10 mr-3">
                        <span class="text-2xl font-bold">Bimbingan Belajar Pintar</span>
                    </div>
                    <p class="text-gray-400">Membantu siswa mencapai prestasi akademik terbaik dengan metode
                        pembelajaran yang efektif.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-6">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Tentang Kami</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Program</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Galeri</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-6">Sosial Media</h3>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="bg-gray-800 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-300">
                            <i data-feather="facebook" class="h-5 w-5"></i>
                        </a>
                        <a href="#"
                            class="bg-gray-800 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-300">
                            <i data-feather="instagram" class="h-5 w-5"></i>
                        </a>
                        <a href="#"
                            class="bg-gray-800 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-300">
                            <i data-feather="twitter" class="h-5 w-5"></i>
                        </a>
                        <a href="#"
                            class="bg-gray-800 p-3 rounded-lg hover:bg-gray-700 transition-colors duration-300">
                            <i data-feather="youtube" class="h-5 w-5"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 mt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400">&copy; 2024 Bimbingan Belajar Pintar. All Rights Reserved.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#"
                            class="text-gray-400 hover:text-white transition-colors duration-300">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">Terms
                            of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Initialize Feather Icons
        feather.replace();

        // Initialize AOS (Animate On Scroll)
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navigation menu toggle for mobile
        const userMenu = document.getElementById('userMenu');
        const userDropdown = document.getElementById('userDropdown');
        if (userMenu && userDropdown) {
            userMenu.addEventListener('click', () => {
                userDropdown.classList.toggle('hidden');
            });

            window.addEventListener('click', (e) => {
                if (!userMenu.contains(e.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        }

        // Intersection Observer for navbar background
        const header = document.querySelector('nav');
        const observer = new IntersectionObserver(
            ([e]) => {
                if (e.intersectionRatio < 1) {
                    header.classList.add('bg-white', 'shadow-md');
                    header.classList.remove('bg-transparent');
                } else {
                    header.classList.remove('bg-white', 'shadow-md');
                    header.classList.add('bg-transparent');
                }
            }, {
                threshold: [1]
            }
        );

        if (header) {
            observer.observe(header);
        }
    </script>
</body>

</html>
