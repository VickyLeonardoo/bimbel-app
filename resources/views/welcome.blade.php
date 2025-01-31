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
        <!-- Hero Section dengan Glassmorphism -->
        <section x-data="backgroundSlider()" x-init="startSlider()" class="min-h-screen relative overflow-hidden">
            <!-- Background dengan natural gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/70 to-gray-800/70"></div>

            <!-- Dynamic Background Image -->
            <div x-ref="backgroundImage"
                class="absolute inset-0 bg-cover bg-center mix-blend-overlay opacity-90 transition-opacity duration-1000"
                :style="`background-image: url('${backgrounds[currentIndex]}');`"></div>

            <!-- Content -->
            <div class="relative h-full min-h-screen flex items-center mt-28">
                <div class="container mx-auto px-4">
                    <div class="max-w-2xl backdrop-blur-sm bg-black/10 p-8 rounded-2xl" data-aos="fade-up">
                        <h1 class="text-5xl font-bold mb-6 text-white leading-tight">Bimbingan Belajar <span
                                class="text-yellow-400">Pintar</span></h1>
                        <p class="text-xl mb-8 text-gray-100">Tingkatkan prestasi akademik Anda dengan bimbingan belajar
                            yang berkualitas dan terpercaya.</p>
                        <div class="flex gap-4">
                            <a href=""
                                class="bg-yellow-400 text-gray-900 px-8 py-3 rounded-xl text-lg font-semibold hover:bg-yellow-300 transition-all duration-300 inline-block shadow-lg hover:shadow-xl">
                                Daftar Sekarang
                            </a>
                            <a href="{{ route('about') }}"
                                class="bg-white/10 backdrop-blur-sm border-2 border-white text-white px-8 py-3 rounded-xl text-lg font-semibold hover:bg-white/20 transition-all duration-300 inline-block">
                                Tentang kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Natural gradient fade -->
            <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-white to-transparent"></div>

            <script>
                function backgroundSlider() {
                    return {
                        backgrounds: [
                            'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&q=80',
                            'https://images.unsplash.com/photo-1581078426770-6d336e5de7bf?auto=format&fit=crop&q=80',
                            'https://images.unsplash.com/photo-1529390079861-591de354faf5?auto=format&fit=crop&q=80'
                        ],
                        currentIndex: 0,

                        startSlider() {
                            // Preload images
                            this.backgrounds.forEach(url => {
                                const img = new Image();
                                img.src = url;
                            });

                            setInterval(() => {
                                this.currentIndex = (this.currentIndex + 1) % this.backgrounds.length;
                            }, 5000); // Ganti gambar setiap 5 detik
                        }
                    }
                }
            </script>
        </section>

        <!-- Layanan Section dengan Card Modern -->
        <section id="layanan" class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Layanan Kami</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Kami menyediakan berbagai layanan untuk membantu
                        Anda mencapai prestasi terbaik.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 group"
                        data-aos="fade-up" data-aos-delay="100">
                        <div
                            class="bg-blue-500 text-white p-3 rounded-xl inline-block mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i data-feather="book-open" class="h-8 w-8"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Kelas Reguler</h3>
                        <p class="text-gray-600">Kelas reguler dengan materi lengkap dan terstruktur untuk semua jenjang
                            pendidikan.</p>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 group"
                        data-aos="fade-up" data-aos-delay="200">
                        <div
                            class="bg-blue-500 text-white p-3 rounded-xl inline-block mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i data-feather="users" class="h-8 w-8"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Kelas Privat</h3>
                        <p class="text-gray-600">Kelas privat dengan pengajar profesional untuk fokus pada kebutuhan
                            individual.</p>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 group"
                        data-aos="fade-up" data-aos-delay="300">
                        <div
                            class="bg-blue-500 text-white p-3 rounded-xl inline-block mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i data-feather="clipboard" class="h-8 w-8"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Try Out</h3>
                        <p class="text-gray-600">Try out berkala untuk mengukur kemampuan dan persiapan ujian.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Visi & Misi Section -->
        <section id="visi-misi" class="py-24 bg-gradient-to-br from-blue-50 to-indigo-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Visi & Misi</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Visi dan misi kami dalam membimbing siswa menuju
                        kesuksesan akademik.</p>
                </div>

                <div class="grid md:grid-cols-2 gap-12">
                    <!-- Visi -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="100">
                        <div class="text-center">
                            <div class="bg-blue-500 text-white p-4 rounded-xl inline-block mb-6">
                                <i data-feather="target" class="h-8 w-8"></i>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Visi</h3>
                            <p class="text-gray-600">Menjadi bimbingan belajar terdepan dalam mencetak generasi muda
                                yang cerdas, berkarakter, dan siap menghadapi tantangan masa depan.</p>
                        </div>
                    </div>

                    <!-- Misi -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="200">
                        <div class="text-center">
                            <div class="bg-blue-500 text-white p-4 rounded-xl inline-block mb-6">
                                <i data-feather="compass" class="h-8 w-8"></i>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Misi</h3>
                            <ul class="text-gray-600 text-left list-disc list-inside space-y-2">
                                <li>Menyediakan metode pembelajaran yang efektif dan menyenangkan.</li>
                                <li>Mengembangkan potensi akademik dan karakter siswa.</li>
                                <li>Memberikan layanan pendidikan yang terjangkau dan berkualitas.</li>
                                <li>Membantu siswa mencapai prestasi terbaik di sekolah dan ujian nasional.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Keuntungan Section dengan Stats -->
        <section id="keuntungan" class="py-24 bg-gradient-to-br from-cyan-400 to-blue-500 text-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl font-bold mb-4">Keunggulan Kami</h2>
                    <p class="text-xl text-blue-100 max-w-2xl mx-auto">Mengapa memilih bimbingan belajar kami?</p>
                </div>

                <div class="grid md:grid-cols-4 gap-8">
                    <div class="text-center p-6 backdrop-blur-lg bg-white/10 rounded-2xl" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="bg-white/20 p-4 rounded-xl inline-block mb-4">
                            <i data-feather="award" class="h-8 w-8"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-2">Pengajar Berpengalaman</h3>
                        <p class="text-blue-100">Pengajar profesional dan berpengalaman di bidangnya.</p>
                    </div>

                    <div class="text-center p-6 backdrop-blur-lg bg-white/10 rounded-2xl" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="bg-white/20 p-4 rounded-xl inline-block mb-4">
                            <i data-feather="book" class="h-8 w-8"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-2">Materi Lengkap</h3>
                        <p class="text-blue-100">Materi pembelajaran lengkap dan terupdate.</p>
                    </div>

                    <div class="text-center p-6 backdrop-blur-lg bg-white/10 rounded-2xl" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="bg-white/20 p-4 rounded-xl inline-block mb-4">
                            <i data-feather="clock" class="h-8 w-8"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-2">Fleksibel</h3>
                        <p class="text-blue-100">Jadwal belajar yang fleksibel sesuai kebutuhan Anda.</p>
                    </div>

                    <div class="text-center p-6 backdrop-blur-lg bg-white/10 rounded-2xl" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="bg-white/20 p-4 rounded-xl inline-block mb-4">
                            <i data-feather="thumbs-up" class="h-8 w-8"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-2">Terjangkau</h3>
                        <p class="text-blue-100">Biaya bimbingan belajar yang terjangkau.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section Mata Pelajaran -->
        <section id="mata-pelajaran" class="py-24 bg-gradient-to-br from-blue-50 to-indigo-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Mata Pelajaran yang Tersedia</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Kami menyediakan berbagai mata pelajaran untuk semua jenjang pendidikan.</p>
                </div>

                <div class="grid md:grid-cols-4 gap-8">
                    <!-- Matematika -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                        <div class="text-center">
                            <div class="bg-blue-500 text-white p-4 rounded-xl inline-block mb-6">
                                <i data-feather="divide-circle" class="h-8 w-8"></i>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Matematika</h3>
                            <p class="text-gray-600">Belajar matematika dengan metode yang mudah dipahami.</p>
                        </div>
                    </div>

                    <!-- Fisika -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                        <div class="text-center">
                            <div class="bg-blue-500 text-white p-4 rounded-xl inline-block mb-6">
                                <i data-feather="atom" class="h-8 w-8"></i>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Fisika</h3>
                            <p class="text-gray-600">Pahami konsep fisika dengan cara yang menyenangkan.</p>
                        </div>
                    </div>

                    <!-- Kimia -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                        <div class="text-center">
                            <div class="bg-blue-500 text-white p-4 rounded-xl inline-block mb-6">
                                <i data-feather="flask" class="h-8 w-8"></i>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Kimia</h3>
                            <p class="text-gray-600">Pelajari kimia dengan pendekatan praktis dan teoritis.</p>
                        </div>
                    </div>

                    <!-- Bahasa Inggris -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="400">
                        <div class="text-center">
                            <div class="bg-blue-500 text-white p-4 rounded-xl inline-block mb-6">
                                <i data-feather="book-open" class="h-8 w-8"></i>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Bahasa Inggris</h3>
                            <p class="text-gray-600">Tingkatkan kemampuan bahasa Inggris Anda dengan cepat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section Pengajar -->
        <section id="pengajar" class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16" data-aos="fade-up">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Pengajar Profesional Kami</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Tim pengajar kami siap membimbing Anda meraih
                        prestasi terbaik.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Pengajar 1 -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 group"
                        data-aos="fade-up" data-aos-delay="100">
                        <div class="text-center">
                            <img src="{{ asset('asset/img/pengajar1.jpg') }}" alt="Pengajar 1"
                                class="w-32 h-32 rounded-full mx-auto mb-6 object-cover">
                            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Budi Santoso</h3>
                            <p class="text-gray-600">Matematika & Fisika</p>
                            <div class="mt-4 flex justify-center space-x-4">
                                <a href="#" class="text-blue-500 hover:text-blue-600">
                                    <i data-feather="linkedin" class="h-5 w-5"></i>
                                </a>
                                <a href="#" class="text-blue-500 hover:text-blue-600">
                                    <i data-feather="mail" class="h-5 w-5"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Pengajar 2 -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 group"
                        data-aos="fade-up" data-aos-delay="200">
                        <div class="text-center">
                            <img src="{{ asset('asset/img/pengajar2.jpg') }}" alt="Pengajar 2"
                                class="w-32 h-32 rounded-full mx-auto mb-6 object-cover">
                            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Ani Wijaya</h3>
                            <p class="text-gray-600">Bahasa Inggris & Sastra</p>
                            <div class="mt-4 flex justify-center space-x-4">
                                <a href="#" class="text-blue-500 hover:text-blue-600">
                                    <i data-feather="linkedin" class="h-5 w-5"></i>
                                </a>
                                <a href="#" class="text-blue-500 hover:text-blue-600">
                                    <i data-feather="mail" class="h-5 w-5"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Pengajar 3 -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 group"
                        data-aos="fade-up" data-aos-delay="300">
                        <div class="text-center">
                            <img src="{{ asset('asset/img/pengajar3.jpg') }}" alt="Pengajar 3"
                                class="w-32 h-32 rounded-full mx-auto mb-6 object-cover">
                            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Cahyo Pratama</h3>
                            <p class="text-gray-600">Kimia & Biologi</p>
                            <div class="mt-4 flex justify-center space-x-4">
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
            </div>
        </section>

        <!-- Contact Section dengan Modern Cards -->
        <section id="kontak" class="py-24 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto bg-gradient-to-br from-cyan-400 to-blue-500 rounded-2xl shadow-xl overflow-hidden"
                    data-aos="fade-up">
                    <div class="grid md:grid-cols-2 gap-8 p-12">
                        <div class="text-white">
                            <h2 class="text-3xl font-bold mb-6">Butuh Bantuan?</h2>
                            <p class="text-blue-100 mb-8">Tim support kami siap membantu Anda 24/7. Jangan ragu untuk
                                menghubungi kami.</p>
                            <div class="space-y-4">
                                <a href="tel:+6281234567890"
                                    class="flex items-center text-white hover:text-blue-200 transition-colors duration-300">
                                    <i data-feather="phone" class="mr-3 h-5 w-5"></i>
                                    0895629511226
                                </a>
                                <a href="mailto:support@bimbelpintar.com"
                                    class="flex items-center text-white hover:text-blue-200 transition-colors duration-300">
                                    <i data-feather="mail" class="mr-3 h-5 w-5"></i>
                                    support@bimbelpintar.com
                                </a>
                            </div>
                        </div>
                        <div class="bg-white p-8 rounded-xl shadow-lg">
                            <form class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text"
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email"
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                                    <textarea
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        rows="4"></textarea>
                                </div>
                                <button type="submit"
                                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors duration-300">
                                    Kirim Pesan
                                </button>
                            </form>
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
                        <img src="{{ asset('asset/logo-color.png') }}" alt="Bimbel Logo" class="h-10 w-10 mr-3">
                        <span class="text-2xl font-bold">Bimbingan Belajar Pintar</span>
                    </div>
                    <p class="text-gray-400">Membantu siswa mencapai prestasi akademik terbaik dengan metode
                        pembelajaran yang efektif.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-6">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('about') }}"
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
