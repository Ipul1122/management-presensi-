@extends('components.user.navbar')

@section('navbar-user')
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-4 text-emerald-700">Galeri TPA Nurul Haq</h2>
        <p class="text-center text-gray-500 mb-8">Berbagai macam aktivitas TPA Nurul Haq</p>

        <div class="gallery-container">
            <div class="gallery-wrapper">
                <div class="flex gap-4 animate-scroll-gallery w-max" id="galeri-track">
                    {{-- Gambar diulang 2x untuk efek looping --}}
                    @for ($i = 1; $i <= 2; $i++)
                        @foreach (['foto_tpa2.jpg', 'foto_tpa3.jpg', 'foto_tpa4.jpg', 
                        'foto_tpa5.jpg', 'benefit_murid_terbaik.jpg', 'foto_tpa10.jpg',
                        'foto_tpa11.jpg', 'foto_tpa12.jpg', 'foto_tpa13.jpg', 'foto_tpa14.jpg', 'foto_tpa15.jpg'] as $gambar)
                            <div class="gallery-item">
                                <img src="{{ asset('images/galeri_tpa/' . $gambar) }}" alt="Galeri TPA" class="gallery-image">
                            </div>
                        @endforeach
                    @endfor
                </div>
            </div>
            
            {{-- Gradient overlay untuk efek fade di sisi kanan dan kiri --}}
            <div class="gallery-fade-left"></div>
            <div class="gallery-fade-right"></div>
        </div>
    </div>
</section>

<style>
    .gallery-container {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        perspective: 1000px;
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        padding: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .gallery-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        transform-style: preserve-3d;
        /* Efek melengkung/skew pada container */
        transform: perspective(800px) rotateX(2deg);
        background: linear-gradient(90deg, 
            rgba(16, 185, 129, 0.1) 0%, 
            transparent 15%, 
            transparent 85%, 
            rgba(16, 185, 129, 0.1) 100%);
    }

    .gallery-item {
        flex-shrink: 0;
        width: 280px;
        height: 200px;
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
        position: relative;
        background: white;
        /* Efek skew subtle pada setiap item */
        transform: perspective(600px) rotateY(0deg) skewY(0.5deg);
    }

    .gallery-item:hover {
        transform: perspective(600px) rotateY(5deg) skewY(0deg) translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        z-index: 10;
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
        border-radius: 8px;
    }

    .gallery-item:hover .gallery-image {
        transform: scale(1.05);
    }

    /* Gradient fade effects untuk sisi kanan dan kiri */
    .gallery-fade-left {
        position: absolute;
        top: 0;
        left: 0;
        width: 80px;
        height: 100%;
        background: linear-gradient(to right, 
            rgba(255, 255, 255, 0.9) 0%, 
            rgba(255, 255, 255, 0.6) 30%,
            transparent 100%);
        z-index: 10;
        pointer-events: none;
        border-radius: 20px 0 0 20px;
    }

    .gallery-fade-right {
        position: absolute;
        top: 0;
        right: 0;
        width: 80px;
        height: 100%;
        background: linear-gradient(to left, 
            rgba(255, 255, 255, 0.9) 0%, 
            rgba(255, 255, 255, 0.6) 30%,
            transparent 100%);
        z-index: 10;
        pointer-events: none;
        border-radius: 0 20px 20px 0;
    }

    @keyframes scroll-gallery {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    .animate-scroll-gallery {
        animation: scroll-gallery 35s linear infinite;
        display: flex;
        align-items: center;
        padding: 10px 0;
    }

    /* Efek cahaya yang bergerak */
    .gallery-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, 
            transparent 30%, 
            rgba(16, 185, 129, 0.1) 50%, 
            transparent 70%);
        animation: light-sweep 8s ease-in-out infinite;
        pointer-events: none;
        z-index: 1;
    }

    @keyframes light-sweep {
        0%, 100% {
            transform: translateX(-100%) translateY(-100%) rotate(45deg);
            opacity: 0;
        }
        50% {
            transform: translateX(100%) translateY(100%) rotate(45deg);
            opacity: 0.3;
        }
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .gallery-container {
            padding: 15px;
            border-radius: 15px;
        }
        
        .gallery-wrapper {
            transform: perspective(600px) rotateX(1deg);
        }
        
        .gallery-item {
            width: 220px;
            height: 160px;
            transform: perspective(400px) rotateY(0deg) skewY(0.3deg);
        }
        
        .gallery-fade-left,
        .gallery-fade-right {
            width: 60px;
        }
    }

    @media (max-width: 480px) {
        .gallery-item {
            width: 180px;
            height: 130px;
        }
        
        .gallery-fade-left,
        .gallery-fade-right {
            width: 40px;
        }
    }
</style>
@endsection