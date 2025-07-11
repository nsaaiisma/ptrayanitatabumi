<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Rayani Tata Bumi</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="{{ asset($header->logo ? '/storage/' . $header->logo : 'images/img-logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .timeline-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 7px;
            top: 24px;
            height: 100%;
            width: 2px;
            background: #3b82f6;
        }

        .property-card {
            transition: all 0.3s ease;
        }

        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        #testimonialCarousel {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="font-sans bg-gray-50">
    <!-- WhatsApp Floating Button -->
    <a href="{{ $social->whatsapp }}" target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center text-2xl shadow-lg hover:bg-green-600 transition-all z-50">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Navigation -->
    <nav class="bg-white shadow-md sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0 flex items-center">
                    <img src="{{ asset($header->logo ? '/storage/' . $header->logo : 'images/img-logo.png') }}" alt="Logo" class="h-10">
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-4">
                        <a href="#home" class="text-gray-900 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                        <a href="#products" class="text-gray-900 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Produk</a>
                        <a href="#portfolio" class="text-gray-900 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Portofolio</a>
                        <a href="#about" class="text-gray-900 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Tentang Kami</a>
                        <a href="#testimonials" class="text-gray-900 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Testimoni</a>
                        <a href="#contact" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition">Hubungi Kami</a>
                        <div>
                            @auth
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-gray-900 hover:text-red-600 px-3 py-2 rounded-md text-sm font-medium">Keluar</button>
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="text-gray-900 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Masuk</a>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-900 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#home" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:text-blue-600">Beranda</a>
                <a href="#products" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:text-blue-600">Produk</a>
                <a href="#portfolio" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:text-blue-600">Portofolio</a>
                <a href="#about" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:text-blue-600">Tentang Kami</a>
                <a href="#testimonials" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:text-blue-600">Testimoni</a>
                <a href="#contact" class="block px-3 py-2 rounded-md text-base font-medium bg-blue-600 text-white hover:bg-blue-700">Hubungi Kami</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative bg-blue-700 text-white">
        <div class="absolute inset-0">
            <img src="{{ asset($header->image ? '/storage/' . $header->image : 'images/img-header.png') }}" alt="Apartemen mewah dengan pemandangan kota modern di malam hari dengan pencahayaan yang dramatis" class="w-full h-full object-cover opacity-50">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10">
            <div class="lg:w-1/2">
                <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl md:text-6xl">
                    <span class="block">{{$header->heading}}</span>
                    <span class="block text-blue-300">{{$header->subheading}}</span>
                </h1>
                <p class="mt-4 text-xl text-blue-100">{{$header->description}}</p>
                <div class="mt-8">
                    <a href="#products" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-blue-700 bg-white hover:bg-gray-100 mr-4">Produk Kami</a>
                    <a href="{{ $social->whatsapp }}" target="_blank" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">Konsultasi Gratis</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Section -->
    <section id="products" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">{{ $title->captionProduct }}</h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">{{ $title->descriptionProduct }}</p>
            </div>

            <div class="relative mt-12">
                <!-- Panah Kiri -->
                <button id="prevBtn" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white border p-2 shadow z-10 rounded-full hover:bg-gray-100">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <!-- Panah Kanan -->
                <button id="nextBtn" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white border p-2 shadow z-10 rounded-full hover:bg-gray-100">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <!-- Wrapper scroll horizontal -->
                <div id="productWrapper" class="overflow-hidden">
                    <div id="productSlider" class="flex transition-transform duration-500 space-x-6">
                        @foreach ($products as $product)
                        <div class="property-card flex-shrink-0 w-full md:w-1/2 lg:w-1/3 rounded-lg overflow-hidden shadow-lg border border-gray-100 flex flex-col">
                            <img src="{{ asset('/storage/' . $product->image) }}" alt="product" class="w-full h-56 object-cover">

                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $product->name }}</h3>
                                <p class="mt-2 text-gray-600 break-words whitespace-normal">{{ $product->description }}</p>

                                <div class="flex-grow"></div>

                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-blue-600 font-bold">
                                        Rp. {{ number_format($product->price, 2, ',', '.') }}
                                    </span>
                                    <button class="text-sm bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition" onclick="detailProduct(this, '{{ $product->name }}', '{{ $product->category }}', '{{ $product->description }}', '{{ $product->price }}', '{{ $product->location }}', '{{ $product->size }}', '{{ $product->theme }}', '{{ $product->imageUrl }}', '{{ $product->status }}')">
                                        Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">{{$title->captionPortofolio}}</h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">{{$title->descriptionPortofolio}}</p>
            </div>

            <div class="mt-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Project 1 -->
                    @foreach ($portofolios as $portofolio)
                    <div class="property-card rounded-lg overflow-hidden bg-white shadow-lg">
                        <img src="{{ asset('/storage/' . $portofolio->image) }}" alt="Proyek pembangunan apartemen tinggi yang sedang berlangsung dengan crane konstruksi" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{$portofolio->name}}</h3>
                                    <p class="text-sm text-gray-500">{{$portofolio->location}}</p>
                                </div>
                                <span class="inline-block {{$portofolio->status == 'finished' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'}} text-xs px-2 py-1 rounded-full">{{$portofolio->status == 'finished' ? "Selesai" : "Dalam Pengerjaan"}}</span>
                            </div>
                            <p class="mt-3 text-gray-600 text-sm">{{$portofolio->description}}</p>
                            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between text-sm text-gray-500">
                                <span>{{$portofolio->timeRange}} Bulan</span>
                                <span>{{$portofolio->years}}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @for ($i = 0; $i < max(0, 3 - count($portofolios)); $i++) <!-- Skeleton Card -->
                        <div class="property-card rounded-lg overflow-hidden bg-white shadow-lg animate-pulse">
                            <div class="bg-gray-300 w-full h-48"></div>
                            <div class="p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="bg-gray-300 h-5 w-32 mb-2 rounded"></div>
                                        <div class="bg-gray-200 h-4 w-20 rounded"></div>
                                    </div>
                                    <div class="bg-gray-300 h-5 w-20 rounded-full"></div>
                                </div>
                                <div class="bg-gray-200 h-4 w-full mt-4 rounded"></div>
                                <div class="bg-gray-200 h-4 w-5/6 mt-2 rounded"></div>
                                <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between text-sm text-gray-500">
                                    <div class="bg-gray-200 h-4 w-16 rounded"></div>
                                    <div class="bg-gray-200 h-4 w-12 rounded"></div>
                                </div>
                            </div>
                        </div>
                        @endfor
                </div>
            </div>
        </div>
    </section>

    <!-- About Section with Timeline -->
    <section id="about" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">{{$title->captionAboutMe}}</h2>
                    <p class="mt-3 text-xl text-gray-500">{{$title->descriptionAboutMe}}</p>
                    @if ($title->owner_image)
                    <!-- Owner Info Section -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-6 items-start">
                        <!-- Image -->
                        <div class="relative w-80">
                            <!-- Kartu belakang -->
                            <div class="absolute top-2 left-2 w-full h-full bg-blue-300 rounded-xl shadow-md transform rotate-[-3deg] z-0"></div>

                            <!-- Kartu tengah -->
                            <div class="absolute top-1 left-1 w-full h-full bg-blue-400 rounded-xl shadow-lg transform rotate-[-1.5deg] z-10"></div>

                            <!-- Kartu depan (gambar owner) -->
                            <div class="relative w-full h-full z-20 rounded-xl overflow-hidden border-4 border-white shadow-xl">
                                <img src="{{ asset(Storage::url($title->owner_image)) }}" alt="Owner Image" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="flex-1">
                            <p class="text-gray-700 text-base leading-relaxed text-left">
                                {{ $title->owner_description }}
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="mt-12 lg:mt-0 lg:col-span-6">
                    <div class="relative">
                        <!-- Timeline -->
                        <div class="space-y-8">
                            @foreach ($abouts as $about)
                            <!-- Timeline Item 1 -->
                            <div class="timeline-item pl-8 relative">
                                <div class="absolute left-0 top-0 w-4 h-4 rounded-full bg-blue-600"></div>
                                <h3 class="text-lg font-semibold text-gray-900">{{$about->years}} - {{$about->title}}</h3>
                                <p class="mt-1 text-gray-600">{{$about->description}}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-16 bg-blue-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold sm:text-4xl">{{$title->captionTestimoni}}</h2>
                <p class="mt-4 max-w-2xl text-xl text-blue-100 mx-auto">{{$title->descriptionTestimoni}}</p>
            </div>

            <div class="mt-14 relative overflow-hidden ">
                <div id="testimonialCarousel" class="flex transition-transform duration-500">
                    @foreach ($testimonials as $testimonial)
                    <!-- Testimonial 1 -->
                    <div class="min-w-full px-4">
                        <div class="bg-blue-800 rounded-lg p-8">
                            <div class="md:flex">
                                <div class="md:flex-shrink-0 md:mr-6 mb-6 md:mb-0">
                                    <img src="{{ asset('/images/profil_default.png') }}" alt="Foto pria paruh baya tersenyum dengan kemeja formal, direktur perusahaan" class="w-24 h-24 rounded-full object-cover mx-auto">
                                </div>
                                <div>
                                    <div class="text-lg font-medium">{{$testimonial->name}}</div>
                                    <div class="text-blue-300 text-sm">{{$testimonial->email}}</div>
                                    <div class="mt-4 text-blue-100">
                                        "{{$testimonial->message}}"
                                    </div>
                                    <div class="mt-4 text-yellow-300">
                                        @for ($i = 1; $i <= 5; $i++) @if ($i <=$testimonial->rating)
                                            <i class="fas fa-star"></i>
                                            @else
                                            <i class="far fa-star"></i> {{-- Star kosong --}}
                                            @endif
                                            @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="flex justify-center mt-8 space-x-2">
                    <button onclick="moveCarousel(-1)" class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button onclick="moveCarousel(1)" class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact & Feedback Section -->
    <section id="contact" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-12">
                <!-- Feedback Form -->
                <div class="mb-12 lg:mb-0">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Berikan Feedback Anda</h2>
                    <form id="feedbackForm" action="{{ route('feedback.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" id="name" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                            <select id="rating" name="rating" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="5">Sangat Baik</option>
                                <option value="4">Baik</option>
                                <option value="3">Cukup</option>
                                <option value="2">Kurang</option>
                                <option value="1">Sangat Kurang</option>
                            </select>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                            <textarea id="message" name="message" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Kirim Feedback
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Contact Info -->
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Hubungi Kami</h2>
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <i class="fas fa-map-marker-alt text-blue-600 mr-3"></i> Alamat Kantor
                            </h3>
                            <p class="mt-2 text-gray-600">{{$contact->location}}</p>
                        </div>
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <i class="fas fa-phone-alt text-blue-600 mr-3"></i> Telepon
                            </h3>
                            <p class="mt-2 text-gray-600">{{$contact->telephone}}</p>
                        </div>
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <i class="fas fa-envelope text-blue-600 mr-3"></i> Email
                            </h3>
                            <p class="mt-2 text-gray-600">{{$contact->email}}</p>
                        </div>
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <i class="fas fa-clock text-blue-600 mr-3"></i> Jam Operasional
                            </h3>
                            <p class="mt-2 text-gray-600">{{$contact->time_operational}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase mb-4">Perusahaan</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Tentang Kami</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Karir</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Berita</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase mb-4">Produk</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Perumahan</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Apartemen</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Komersial</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase mb-4">Dukungan</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">FAQ</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-base text-gray-300 hover:text-white">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-6">
                        @if ($social->whatsapp)
                        <a href="{{ $social->facebook }}" target="_blank" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        @endif
                        @if ($social->instagram)
                        <a href="{{ $social->instagram }}" target="_blank" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        @endif
                        @if ($social->youtube)
                        <a href="{{ $social->youtube }}" target="_blank" class="text-gray-400 hover:text-white">
                            <i class="fab fa-youtube"></i>
                        </a>
                        @endif
                        @if ($social->linkedin)
                        <a href="{{ $social->linkedin }}" target="_blank" class="text-gray-400 hover:text-white">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-800">
                <p class="text-base text-gray-400 text-center">©2025 PT. Rayani Tata Bumi. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- modal -->

    <!-- Product Modal -->
    <div id="modal-productModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-4 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800">Product Details</h3>
                <button onclick="closeModal('modal-productModal')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 overflow-y-auto max-h-[60vh]">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Image -->
                    <div class="bg-gray-100 rounded-lg overflow-hidden" id="productImageContainer">
                    </div>

                    <!-- Product Details -->
                    <div class="space-y-4">
                        <!-- Basic Info -->
                        <div class="space-y-2">
                            <h2 id="productName" class="text-2xl font-bold text-gray-800"></h2>
                            <div class="flex items-center">
                                <span id="productCategory" class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded"></span>
                                <span id="productStatus" class="ml-2 bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded"></span>
                            </div>
                            <p id="productPrice" class="text-xl font-semibold text-blue-600"></p>
                        </div>
                        <!-- Details Grid -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Location</p>
                                <p id="productLocation" class="font-medium text-gray-700"></p>
                            </div>
                            <div class=""></div>
                            <div>
                                <p class="text-sm text-gray-500">Size</p>
                                <p id="productSize" class="font-medium text-gray-700"></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Theme</p>
                                <p id="productTheme" class="font-medium text-gray-700"></p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <p class="text-sm text-gray-500">Description</p>
                            <p id="productDescription" class="text-gray-700 mt-1 break-words whitespace-normal"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeModal('modal-productModal')" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let currentIndex = 0;
        const itemsPerSlide = 3;

        const $slider = $('#productSlider');
        const $wrapper = $('#productWrapper');
        const totalItems = $slider.children().length;
        const totalSlides = Math.ceil(totalItems / itemsPerSlide);

        const $nextBtn = $('#nextBtn');
        const $prevBtn = $('#prevBtn');

        // Event tombol next
        $nextBtn.on('click', function() {
            if (currentIndex < totalSlides - 1) {
                currentIndex++;
                updateSlider();
            }
        });

        // Event tombol prev
        $prevBtn.on('click', function() {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });

        // Update posisi slider dan tombol
        function updateSlider() {
            const slideWidth = $wrapper.width();
            const offset = slideWidth * currentIndex;
            $slider.css('transform', `translateX(-${offset}px)`);

            // Sembunyikan tombol prev jika di slide pertama
            if (currentIndex === 0) {
                $prevBtn.hide();
            } else {
                $prevBtn.show();
            }

            // Sembunyikan tombol next jika di slide terakhir
            if (currentIndex === totalSlides - 1) {
                $nextBtn.hide();
            } else {
                $nextBtn.show();
            }
        }

        // Jalankan sekali di awal untuk kondisi awal tombol
        $(document).ready(function() {
            updateSlider();
        });

        function openModal(modalId) {
            $('#' + modalId).removeClass('hidden');
        }

        function closeModal(modalId) {
            $('#' + modalId).addClass('hidden');
        }

        function detailProduct(button, name, category, description, price, location, size, theme, image, status) {
            const $btn = $(button);
            console.log(image);
            $('#productName').text(name);
            $('#productCategory').text(category);
            $('#productDescription').text(description);
            $('#productPrice').text(price);
            $('#productLocation').text(location);
            $('#productSize').text(size);
            $('#productTheme').text(theme);
            $('#productImage').attr('alt', name);
            $('#productStatus').text(status);
            $('#productImageContainer').html(`
    <img id="productImage" src="${image}" alt="${name}" class="w-full h-full object-cover">
`);

            openModal('modal-productModal');
        }

        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Testimonial carousel
        let currentTestimonial = 0;
        const testimonials = document.querySelectorAll('#testimonialCarousel > div');

        function moveCarousel(step) {
            currentTestimonial += step;

            if (currentTestimonial < 0) {
                currentTestimonial = testimonials.length - 1;
            } else if (currentTestimonial >= testimonials.length) {
                currentTestimonial = 0;
            }

            document.getElementById('testimonialCarousel').style.transform = `translateX(-${currentTestimonial * 100}%)`;
        }
        window.addEventListener('resize', () => {
            document.getElementById('testimonialCarousel').style.transform = `translateX(-${currentTestimonial * 100}%)`;
        });
        setInterval(() => moveCarousel(1), 5000);

        function toastr_success(msg) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
                icon: "success",
                title: msg
            });
        }

        // SweetAlert2 Toast Error
        function toastr_error(msg) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
                icon: "error",
                title: msg
            });
        }
    </script>

    @if (session('success'))
    <script>
        toastr_success("{{ session('success') }}");
    </script>
    @endif
    @if (session('error'))
    <script>
        toastr_error("{{ session('error') }}");
    </script>
    @endif
</body>

</html>