<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مملكة بانكينغ العقارية</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Slick Slider CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Noto Sans Arabic', sans-serif;
            direction: rtl;
            color: #fff;
            overflow-x: hidden;
        }

        /* Navbar Styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            position: absolute;
            width: 100%;
            z-index: 1000;
        }

        .navbar .logo-nav-container {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .navbar .logo-img {
            width: 150px;
            height: auto;
            max-height: 55px;
        }

        .navbar .nav-links {
            display: flex;
            gap: 20px;
            font-weight: bold;
        }

        .navbar .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            opacity: 0.8;
            transition: opacity 0.3s;
        }

        .navbar .nav-links a:hover {
            opacity: 1;
        }

        .navbar .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar .btn {
            width: 140px;
            height: 38px;
            border: none;
            background: #CAA88E;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
            transition: background 0.3s;
        }

        .navbar .btn:hover {
            background: #b89478;
        }

        .navbar .language {
            color: #fff;
            opacity: 1;
            cursor: pointer;
        }

        .navbar .search-input {
            position: relative;
            color: #fff;
        }

        .navbar .search-input .search-icon {
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .navbar .search-input .search-icon:hover {
            opacity: 0.8;
        }

        .navbar-separator {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            height: 1px;
            background: rgba(255, 255, 255, 0.3);
            z-index: 999;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 4px;
        }

        .mobile-menu-toggle span {
            width: 25px;
            height: 3px;
            background: #fff;
            transition: 0.3s;
        }

        /* Banner Section */
        .banner-section {
            padding-top: 0;
        }

        .banner {
            min-height: 100vh;
            background: url('/assets/images/21.jpg') no-repeat center center/cover;
            position: relative;
            display: flex;
            align-items: center;
        }

        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #422A48;
            opacity: 0.4;
        }

        .banner-content {
            position: absolute;
            top: 70%;
            right: 10%;
            transform: translateY(-50%);
            text-align: right;
            z-index: 2;
            max-width: 400px;
            padding: 20px;
        }

        .banner .title {
            font-size: clamp(1.5rem, 5vw, 3rem);
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
            color: #FFFFFF;
        }

        .banner .jeddha {
            font-size: clamp(0.9rem, 3vw, 1.5rem);
            color: #FFFFFF;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .banner .scroll-down {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: clamp(16px, 2vw, 20px);
            opacity: 0.6;
            color: #fff;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }

        /* Social Icons Section */
        .social-icons {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            z-index: 2;
        }

        .pankingdom-text {
            color: #fff;
            letter-spacing: 4px;
            font-size: clamp(12px, 2vw, 18px);
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-orientation: mixed;
            margin-bottom: 20px;
        }

        .vertical-line {
            width: 2px;
            height: clamp(100px, 15vw, 100px);
            background: #fff;
            opacity: 0.8;
            margin-bottom: 20px;
        }

        .social-icons a {
            color: #fff;
            font-size: clamp(10px, 1.5vw, 14px);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            width: clamp(25px, 3vw, 35px);
            height: clamp(25px, 3vw, 35px);
            border-radius: 8px;
            transition: all 0.3s;
            background-color: rgba(202, 168, 142, 0.8);
        }

        .social-icons a:hover {
            opacity: 1;
            transform: translateY(-2px);
            background-color: #CAA88E;
        }

        /* About Section */
        .about-section {
            margin-top: 10px;
            background: #f8f9fa;
        }

        .about-para {
            background-color: #422A48;
            padding: 40px;
            height: auto;
            min-height: 379px;
            display: flex;
            align-items: center;
        }

        .about-para h5 {
            color: #CAA88E;
            line-height: 1.8;
            text-align: right;
            margin-right: 40px;
            width: 760px;
            height: 61px;
            font-size: 20px;
            line-height: 35px;
        }

        .about-image {
            height: auto;
            min-height: 379px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            position: relative;
        }

        .about-image img {
            width: 100%;
            height: 100%;
            min-height: 379px;
            object-fit: cover;
            border-radius: 0;
        }

        /* Play/Pause Button */
        .play-pause-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            background-color: transparent;
            border: 2px solid #fff;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #fff;
            transition: border-color 0.3s, transform 0.3s;
            z-index: 1;
        }

        .play-pause-btn:hover {
            border-color: #CAA88E;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .play-pause-btn.paused .fa-play {
            display: inline;
        }

        .play-pause-btn.playing .fa-play {
            display: none;
        }

        .play-pause-btn.paused .fa-pause {
            display: none;
        }

        .play-pause-btn.playing .fa-pause {
            display: inline;
        }

        /* Project Details Section */
        .project-details-section {
            padding: 25px;
            padding-top: 10px;
            background: #f8f9fa;
        }

        .project-layout {
            display: flex;
            gap: 40px;
            margin-bottom: 30px;
            margin-top: 20px;
        }

        .project-left-column {
            flex: 1;
            min-width: 0;
        }

        .project-right-column {
            flex: 1;
            min-width: 0;
        }

        .project-card {
            background: #CAA88E;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .project-header {
            text-align: right;
            margin-bottom: 30px;
        }

        .project-title {
            color: #422A48;
            font-size: 35px;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
        }

        .project-title::before {
            content: '>>';
            color: #422A48;
            font-size: 1.5rem;
            margin-left: 10px;
            opacity: 0.7;
        }

        .project-description {
            color: #422A48;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 40px;
            text-align: right;
            margin-right: 40px;
        }

        .project-stats {
            display: flex;
            margin-bottom: 40px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .stat-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 35px;
            color: #422A48;
            margin-bottom: 5px;
            display: block;
            width: 123px;
            height: 45px;
            opacity: 1;
        }

        .stat-label {
            font-size: 14px;
            color: #422A48;
            opacity: 1;
            text-align: center;
            width: 117px;
            height: 18px;
        }

        .project-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: right;
        }

        .action-btn-1, .action-btn-2, .action-btn-3, .action-btn-4 {
            background: #fff;
            color: #422A48;
            border: none;
            padding: 5px;
            border-radius: 5px;
            height: 52px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-weight: 500;
            justify-content: space-around;
        }

        .action-btn-1 { width: 178px; }
        .action-btn-2 { width: 178px; }
        .action-btn-3 { width: 203px; }
        .action-btn-4 { width: 203px; }

        .action-btn-1::after, .action-btn-2::after, .action-btn-3::after, .action-btn-4::after {
            content: '>>';
            color: #422A48;
            font-size: 1.2rem;
            margin-left: 8px;
            opacity: 0.8;
            transform: rotate(270deg);
        }

        /* Carousel Styles */
        .carousel-wrapper {
            position: relative;
            width: 100%;
            margin: 0 auto;
            overflow: hidden;
            direction: ltr; /* Ensure LTR for carousel scrolling */
        }

        .carousel {
            display: flex;
            gap: 0.5rem;
            width: 100%;
            margin-top: 3rem;
            margin-bottom: 1rem;
        }

        .carousel .item {
            flex: 0 0 calc((100% - 1rem) / 3);
            width: calc((100% - 1rem) / 3);
            height: 314px;
            position: relative;
            overflow: hidden;
        }

        .carousel .item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0;
        }

        @media (max-width: 767px) {
            .carousel .item {
                flex: 0 0 calc(100% - 0.5rem);
                width: calc(100% - 0.5rem);
            }
        }

        .carousel-indicators-numbers {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            margin-bottom: 2rem;
            list-style: none;
            padding: 0;
        }

        .carousel-indicators-numbers li {
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background-color: #999;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-indicators-numbers li.active,
        .carousel-indicators-numbers li:hover {
            background-color: #422A48;
            transform: scale(1.2);
        }

        .carousel-indicators-numbers i {
            color: #422A48;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-indicators-numbers i:hover {
            color: #2a1a2e;
            transform: scale(1.2);
        }

        /* Slick Slider Overrides to Match Your Design */
        .slick-slide {
            margin: 0 4px; /* Half of 0.5rem gap */
        }

        .slick-list {
            margin: 0 -4px; /* Counteract slide margin */
        }

        .slick-prev, .slick-next {
            display: none !important; /* Use custom arrows */
        }

        .slick-dots {
            display: none !important; /* Use custom dots */
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .banner .title { font-size: clamp(1.5rem, 4vw, 2.5rem); }
            .banner .jeddha { font-size: clamp(0.9rem, 2.5vw, 1.3rem); }
            .project-title { font-size: 2.2rem; }
            .stat-number { font-size: 2.2rem; }
        }

        @media (max-width: 992px) {
            .navbar { padding: 15px 20px; }
            .navbar .logo-img { width: 120px; }
            .navbar .nav-links { display: none; }
            .navbar .btn { width: 120px; height: 35px; font-size: 12px; }
            .banner-content { right: 5%; max-width: 350px; }
            .social-icons { left: 15px; }
            .pankingdom-text { font-size: clamp(12px, 1.8vw, 16px); }
            .social-icons a { width: clamp(25px, 2.5vw, 30px); height: clamp(25px, 2.5vw, 30px); font-size: clamp(10px, 1.3vw, 12px); }
            .about-image img { min-height: 300px; }
            .play-pause-btn { width: 50px; height: 50px; font-size: 20px; }
            .project-card { padding: 40px 30px; }
            .project-title { font-size: 2rem; }
        }

        @media (max-width: 768px) {
            .navbar { padding: 10px 15px; }
            .navbar .logo-nav-container { gap: 15px; }
            .navbar .logo-img { width: 100px; }
            .navbar .header-actions { gap: 10px; }
            .navbar .btn { width: 100px; height: 32px; font-size: 11px; }
            .navbar .search-input .search-icon { font-size: 14px; }
            .navbar .language { font-size: 12px; }
            .banner-content { top: 60%; right: 5%; max-width: 300px; }
            .social-icons {
                position: relative;
                left: auto;
                top: auto;
                transform: none;
                flex-direction: row;
                justify-content: center;
                margin: 30px 0;
                width: 100%;
            }
            .pankingdom-text {
                writing-mode: horizontal-tb;
                transform: none;
                margin-bottom: 15px;
                text-align: center;
                width: 100%;
            }
            .vertical-line {
                width: 50px;
                height: 2px;
                margin-bottom: 15px;
            }
            .social-icons a {
                width: clamp(25px, 3vw, 35px);
                height: clamp(25px, 3vw, 35px);
                font-size: clamp(10px, 1.5vw, 14px);
            }
            .about-us .row {
                display: flex;
                flex-wrap: wrap;
                gap: 0;
            }
            .about-para, .about-image {
                flex: 0 0 100%;
                min-height: 250px;
                padding: 0;
            }
            .about-image img { min-height: 250px; }
            .play-pause-btn { width: 40px; height: 40px; font-size: 16px; }
            .project-details-section { padding: 60px 0; }
            .project-layout { flex-direction: column; gap: 20px; }
            .project-left-column, .project-right-column { flex: none; width: 100%; }
            .project-card { padding: 30px 20px; border-radius: 15px; }
            .project-title { font-size: 1.8rem; }
            .project-title::before { font-size: 1.2rem; }
            .stat-column { flex: 0 0 100%; gap: 15px; }
            .stat-item {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 10px 0;
                border-bottom: 1px solid rgba(66, 42, 72, 0.1);
            }
            .stat-number { font-size: 2rem; margin-bottom: 0; }
            .stat-label { font-size: 0.85rem; }
        }

        @media (max-width: 576px) {
            .navbar { padding: 8px 10px; }
            .navbar .logo-img { width: 80px; }
            .navbar .btn { width: 80px; height: 28px; font-size: 10px; }
            .banner-content { top: 55%; right: 3%; max-width: 250px; }
            .banner .title { font-size: clamp(1.2rem, 4vw, 1.5rem); }
            .banner .jeddha { font-size: clamp(0.8rem, 2.5vw, 0.9rem); }
            .social-icons { gap: 10px; margin: 20px 0; }
            .pankingdom-text { font-size: clamp(12px, 2vw, 14px); letter-spacing: 2px; }
            .about-para, .about-image { min-height: 200px; padding: 0; }
            .about-para h5 { font-size: clamp(12px, 2vw, 13px); }
            .about-image img { min-height: 200px; }
            .play-pause-btn { width: 35px; height: 35px; font-size: 14px; }
            .project-card { padding: 25px 15px; }
            .project-title { font-size: 1.6rem; }
            .project-title::before { font-size: 1rem; }
            .stat-number { font-size: 1.8rem; }
            .stat-label { font-size: 0.8rem; }
        }

        @media (max-width: 480px) {
            .navbar .logo-img { width: 70px; }
            .navbar .btn { width: 70px; height: 26px; font-size: 9px; }
            .banner-content { right: 2%; max-width: 200px; }
            .banner .title { font-size: clamp(1.1rem, 3.5vw, 1.3rem); }
            .banner .jeddha { font-size: clamp(0.7rem, 2vw, 0.8rem); }
            .social-icons a {
                width: clamp(22px, 2.5vw, 28px);
                height: clamp(22px, 2.5vw, 28px);
                font-size: clamp(9px, 1.2vw, 11px);
            }
            .about-image img { min-height: 180px; }
            .play-pause-btn { width: 30px; height: 30px; font-size: 12px; }
            .project-title { font-size: 1.4rem; }
            .stat-number { font-size: 1.6rem; }
        }

        /* Models section RTL layout */
        .models-grid { flex-direction: row-reverse; }
        @media (max-width: 768px) { .models-grid { flex-direction: column; } }

        /* Dot controls for Swiper page groups */
        .slider__pagination .swiper-pagination-bullet { width:11px; height:11px; border-radius:20px; background:#422A48; opacity:.6; transition: width .3s ease, height .3s ease, opacity .3s ease; }
        .slider__pagination .swiper-pagination-bullet-active { width:34px; height:11px; background:#422A48; opacity:1; }

        /* Register interest section */
        .register-section {
            position: relative;
            width: 100%;
            min-height: 584px;
            background: url('/assets/images/image3.jpg') center center/cover no-repeat;
            overflow: hidden;
        }
        .register-section::after {
            content: '';
            position: absolute;
            inset: 0;
            background: #412A47;
            opacity: .65;
        }
        .register-section .register-container {
            position: relative;
            z-index: 2;
            margin: 0 auto;
            padding: 50px 20px;
            display: flex;
            justify-content: flex-end; /* Move card to the left side visually */
        }
        .register-card {
            width: 450px;
            max-width: 100%;
            height: 548px;
            background: #CAA88E;
            border-radius: 5px;
            padding: 24px 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,.25);
        }
        .register-card .register-title {
            color: #412A47;
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 12px;
            text-align: right;
            width: 134px;
            height: 26px;
        }
        .register-card .register-subtitle {
            color: #412A47;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 16px;
            text-align: right;
            width: 377px;
            height: 54px;
        }
        .register-form .form-row {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            width: 100%;
        }
        .register-form input,
        .register-form textarea,
        .register-form button {
            width: 100%;
            border: 1px solid rgba(66,42,71,.25);
            border-radius: 8px;
            background: #fff;
            height: 42px;
            padding: 8px 12px;
            outline: none;
            font-size: 13px;
            text-align: right;
        }
      /* ====== PHONE INPUT (flag + arrow) ====== */
.input-with-flag {
    position: relative;
    width: 100%;
}

.input-with-flag input {
    width: 100%;
    padding-left: 50px;  /* space for flag + arrow */
    text-align: right;
}

.input-with-flag .phone-flag {
    position: absolute;
    left: 28px;   /* after arrow */
    top: 50%;
    transform: translateY(-50%);
    width: 12px;
    height: 10px;
    pointer-events: none;
}

.input-with-flag .phone-arrow {
    position: absolute;
    left: 18px; /* arrow first */
    top: 44%;
    transform: translateY(-50%);
    font-size: 12px;
    width: 2.82px;
    height: 5.62px;
    color: #1a1120;
    pointer-events: none;
}

/* ====== UNIT INPUT (arrow only) ====== */
.input-with-arrow {
    position: relative;
    width: 100%;
}

.input-with-arrow input {
    width: 100%;
    padding-left: 30px;  /* only arrow, less padding */
    text-align: right;
}

.input-with-arrow .unit-arrow {
    position: absolute;
    left: 18px;
    top: 44%;
    transform: translateY(-50%);
    font-size: 12px;
    width: 2.82px;
    height: 5.62px;
    color: #1a1120;
    pointer-events: none;
}




        .register-form input::placeholder { text-align: right; }
        .register-form textarea { height: 90px; resize: vertical; }
        .register-form button {
            background: #412A47;
            color: #CAA88E;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: opacity .2s ease;
            width: 123px;
            height: 40px;
            margin-top: 22px;
            text-align: center;
        }
        .register-form button:hover { opacity: .9; }
        .register-form .button-row { 
    display: flex;
    justify-content: flex-end;
}
        .iti { width: 100%; }


        /* footer */
        .site-footer {
  background: #f2f2f2;
  font-family: "Tahoma", sans-serif;
  padding-top: 40px;
  color: #1a1120;
  width: 100%; /* Ensure footer takes full width */
  margin: 0; /* Remove any default margins */
}

/* Section above footer bar (footer-top and footer-bottom) */
.footer-top,
.footer-bottom {
  background: #F2F2F2; /* Red background for sections above the footer bar */
}

/* Footer bar (below the border) */
.footer-bar {
  background: white; /* White background for the footer bar */
  border-top: 2px solid #412a47;
  padding: 15px 35px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 13px;
  width: 100%; /* Ensure footer bar spans full width */
}

/* Ensure the container doesn't restrict the width */
body, html {
  margin: 0;
  padding: 0;
  width: 100%;
}

/* Rest of your existing CSS remains unchanged */
.site-footer h3 {
  font-size: 16px;
  color: #caa88e;
  margin-bottom: 12px;
}



.footer-top {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  margin-bottom: 30px;
}

.footer-col {
  flex: 1;
  min-width: 180px;
  margin: 0 75px;
}

.footer-col ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-col ul li {
  margin-bottom: 8px;
}

.footer-col ul li a {
  text-decoration: none;
  color: #412A47;
  font-size: 14px;
}

.footer-col ul li a i {
  margin-left: 6px;
}

.social-links li a {
  display: flex;
  align-items: center;
  gap: 6px;
}

.social-links li i {
  background: #caa88e;
  color: #fff;
  padding: 4px;
  border-radius: 4px;
  font-size: 12px;
}

.app-buttons img {
  display: block;
  margin-bottom: 10px;
  width: 140px;
}

.footer-bottom {
  display: flex;
  gap: 100px;
  padding: 30px 75px;
}



.footer-address p {
  font-size: 14px;
  margin: 8px 0;
}

.footer-address .address-action {
  background: #caa88e; /* Background color for the container */
  width: 149px; /* Container width */
  height: 33px; /* Container height */
  border-radius: 4px; /* Retained from original button style */
  color: #412A47; /* Text color */
  font-size: 14px; /* Text font size */
  display: flex; /* Center text */
  align-items: center; /* Vertically center text */
  justify-content: center; /* Horizontally center text */
  text-align: center; /* Ensure text alignment */
  cursor: pointer; /* Retained to indicate interactivity */
}

.footer-address .address-action span {
  max-width: 129px; /* Text width constraint */
  line-height: 18px; /* Text height constraint */
  overflow: hidden; /* Prevent text overflow */
  white-space: nowrap; /* Keep text on a single line */
}

.footer-links a {
  color: #1a1120;
  text-decoration: none;
  margin: 0 6px;
}

.footer-copy {
  text-align: center;
  flex: 1;
  width: 329px;
  height: 18px;
  font-size: 14px;
  color: #412A47;
}

.footer-logo img {
  height: 40px;
}

    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo-nav-container">
            <img src="/assets/images/logo.png" alt="Logo" class="logo-img">
            <div class="nav-links">
                <a href="#">الرئيسية</a>
                <a href="#">من نحن</a>
                <a href="#">الخدمات</a>
                <a href="#">أخبار وفعاليات</a>
                <a href="#">اتصل بنا</a>
            </div>
            <div class="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="header-actions">
            <div class="search-input">
                <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
            </div>
            <span class="language">EN</span>
            <button class="btn">سجل اهتمامك​</button>
        </div>
    </div>

    <div class="navbar-separator"></div>

    <!-- Banner Section -->
    <div class="banner-section">
        <div class="banner">
            <div class="banner-overlay"></div>
            <div class="banner-content">
                <h5 class="jeddha">جدة</h5>
                <h1 class="title">مشروع المرسي</h1>
                <div class="scroll-down">
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </div>
            <div class="social-icons">
                <div class="pankingdom-text">PANKINGDOM</div>
                <div class="vertical-line"></div>
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="about-section">
        <div class="about-us">
            <div class="row g-0">
                <div class="col-lg-8 col-md-7 col-sm-12">
                    <div class="about-para">
                        <h5>
                            . تسهم مشاريعنا التطويرية في إحداث تأثير تلحظه في المكان عبر مزيجها الفريد<br>
                            . فهي توفر قيمة استثنائية وتشغل مواقع محلية استراتيجية وتحقق عوائد استثمارات جيدة
                        </h5>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-12">
                    <div class="about-image">
                        <img src="/assets/images/9.jpg" alt="About Image" style="width:100%; height:379px; object-fit:cover;">
                        <button class="play-pause-btn paused" onclick="togglePlayPause()">
                            <i class="fa-solid fa-play"></i>
                            <i class="fa-solid fa-pause"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Details Section -->
    <div class="project-details-section">
        <div class="project-container">
            <div class="project-card">
                <div class="project-layout">
                    <div class="project-left-column">
                        <div class="project-header">
                            <h2 class="project-title">مشروع المرسي</h2>
                        </div>
                        <p class="project-description">
                            في ضاحية سدايم ، مجتمع متكامل تم تصميمه لتعيش <br> فيه عمراً سعيداً مع عائلتك ويكون بداية حياة جديدة
                        </p>
                    </div>
                    <div class="project-right-column">
                        <div class="project-stats">
                            <div class="stat-column" style="margin-left: 15rem;">
                                <div class="stat-item" style="margin-left: 40px;">
                                    <span class="stat-number">187.340</span>
                                    <span class="stat-label">مساحة الأرض (م²)</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">5</span>
                                    <span class="stat-label">عدد الوحدات</span>
                                </div>
                            </div>
                            <div class="stat-column">
                                <div class="stat-item">
                                    <span class="stat-number">155.448</span>
                                    <span class="stat-label">مساحة البناء (م²)</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">502</span>
                                    <span class="stat-label">عدد النماذج</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="project-actions" style="margin-right: 40px;">
                    <a href="#" class="action-btn-1">بروشور المشروع</a>
                    <a href="#" class="action-btn-2">تسجيل اهتمامك</a>
                    <a href="#" class="action-btn-3">الحصول علي الاتجاهات</a>
                    <a href="#" class="action-btn-4">احجز وحدتك الان</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Carousel Section -->
    <div class="carousel-wrapper">
        <div class="carousel slider">
            <div class="item">
                <img src="/assets/images/12.jpg" loading="eager" alt="Slide 1">
            </div>
            <div class="item">
                <img src="/assets/images/12.jpg" loading="eager" alt="Slide 2">
            </div>
            <div class="item">
                <img src="/assets/images/12.jpg" loading="eager" alt="Slide 3">
            </div>
            <div class="item">
                <img src="/assets/images/12.jpg" loading="eager" alt="Slide 4">
            </div>
            <div class="item">
                <img src="/assets/images/12.jpg" loading="eager" alt="Slide 5">
            </div>
            <div class="item">
                <img src="/assets/images/12.jpg" loading="eager" alt="Slide 5">
            </div>
            <div class="item">
                <img src="/assets/images/12.jpg" loading="eager" alt="Slide 5">
            </div>
            <div class="item">
                <img src="/assets/images/12.jpg" loading="eager" alt="Slide 5">
            </div>
            <div class="item">
                <img src="/assets/images/12.jpg" loading="eager" alt="Slide 5">
            </div>
            <div class="item">
                <img src="/assets/images/12.jpg" loading="eager" alt="Slide 5">
            </div>

            <div class="item">
                <img src="/assets/images/12.jpg" loading="eager" alt="Slide 5">
            </div>
            <div class="item">
                <img src="/assets/images/12.jpg" loading="eager" alt="Slide 5">
            </div>
        </div>
    </div>

    <!-- Numbered Indicators Below Carousel -->
    <ol class="carousel-indicators-numbers">
        <i class="fa-solid fa-arrow-right slick-prev-btn"></i>
        <!-- Dots will be dynamically generated -->
        <i class="fa-solid fa-arrow-left slick-next-btn"></i>
    </ol>

    <!-- Models Section -->
    <section class="models-section" style=" padding:30px 20px;">
        <div class="models-container" style="max-width:1200px; margin:0 auto;">
            <!-- Models heading placed above images -->
            <div class="models-heading" style="text-align:right; margin-bottom:14px;">
                <div style="color:#422A48; font-weight:700; font-size:20px; display:inline-block;">نماذج المشروع</div>
                <div style="color:#422A48; opacity:.9; font-size:20px;">تعرّف على أنواع مجتمعنا</div>
            </div>
            <div class="models-grid" style="display:flex; gap:30px; align-items:flex-start;">
                <!-- Left: Model selectors and stats -->
                <div class="models-left" style="flex:1;">
                    <div class="models-buttons" style="display:grid; grid-template-columns: repeat(3, 1fr); gap:14px; max-width:420px;">
                        <button class="model-btn" data-model="3-A" style="background:#422A48; color:#fff; witdh: 135px; height: 50px; padding:5px 5px 5px 5px; border-radius:5px; font-weight:700; cursor:pointer; width:135px; height:50px; position:relative; right:128px;">3-A</button>
                        <button class="model-btn" data-model="2-A" style="background:#422A48; color:#fff; border:none; padding:14px 0; border-radius:5px; font-weight:700; cursor:pointer; width:135px; height:50px; position:relative; right:128px;">2-A</button>
                        <button class="model-btn" data-model="1-A" style="background:#CAA88E; color:#422A48; border:none; padding:14px 0; border-radius:5px; font-weight:700; cursor:pointer; width:135px; height:50px; position:relative; right:128px;">1-A</button>
                        <button class="model-btn" data-model="3-B" style="background:#422A48; color:#fff; border:none; padding:14px 0; border-radius:5px; width:135px; height:50px; position:relative; right:128px; cursor:pointer;">3-B</button>
                        <button class="model-btn" data-model="2-B" style="background:#422A48; color:#fff; border:none; padding:14px 0; border-radius:5px; width:135px; height:50px; position:relative; right:128px; cursor:pointer;">2-B</button>
                        <button class="model-btn" data-model="1-B" style="background:#422A48; color:#fff; border:none; padding:14px 0; border-radius:5px; width:135px; height:50px; position:relative; right:128px; cursor:pointer;">1-B</button>
                    </div>

                    <div class="models-stats" style="display:flex; gap:14px; margin-top:47px; flex-wrap:wrap; max-width:520px;">
                        <div class="stat-card" style=" background:#CAA88E; color:#422A48; border-radius:8px; padding:14px; text-align:center; width: 100px; height: 75px; position:relative; right:128px;">
                            <span style="display:inline-flex; width:21px; height:21px; align-items:center; justify-content:center; margin-bottom:6px;"><i class="fa-solid fa-building" style="font-size:21px; color:#422A48;"></i></span>
                            <div style="font-size:10px; width: 64px; height: 13px; opacity:.9;">مساحة البناء</div>
                            <div style="font-weight:700;">200</div>
                        </div>
                        <div class="stat-card" style=" background:#CAA88E; color:#422A48; border-radius:8px; padding:14px; text-align:center; width: 100px; height: 75px; position:relative; right:128px;">
                            <span style="display:inline-flex; width:21px; height:21px; align-items:center; justify-content:center; margin-bottom:6px;"><i class="fa-solid fa-bed" style="font-size:21px; color:#422A48;"></i></span>
                            <div style="font-size:10px; width: 64px; height: 13px; opacity:.9;">عدد غرف النوم</div>
                            <div style="font-weight:700;">200</div>
                        </div>
                        <div class="stat-card" style=" background:#CAA88E; color:#422A48; border-radius:8px; padding:14px; text-align:center; width: 100px; height: 75px; position:relative; right:128px;">
                            <span style="display:inline-flex; width:21px; height:21px; align-items:center; justify-content:center; margin-bottom:6px;"><i class="fa-solid fa-ruler-combined" style="font-size:21px; color:#422A48;"></i></span>
                            <div style="font-size:10px; width: 64px; height: 13px; opacity:.9;">مساحة الأرض</div>
                            <div style="font-weight:700;">200</div>
                        </div>
                        <div class="stat-card" style=" background:#CAA88E; color:#422A48; border-radius:8px; padding:14px; text-align:center; width: 100px; height: 75px; position:relative; right:128px;">
                            <span style="display:inline-flex; width:21px; height:21px; align-items:center; justify-content:center; margin-bottom:6px;"><i class="fa-solid fa-bath" style="font-size:21px; color:#422A48;"></i></span>
                            <div style="font-size:10px; width: 64px; height: 13px; opacity:.9;">عدد الدورات</div>
                            <div style="font-weight:700;">200</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Gallery -->
                <div class="models-right" style="flex:1;">
                    <div class="model-hero" style="width:711px; height:304px;; overflow:hidden; background:#ddd;">
                        <img id="model-hero-image" src="/assets/images/12.jpg" alt="model" style="width:100%; height:100%; object-fit:cover;" loading="eager">
                    </div>
                    <div class="model-thumbs slider" style="margin-top:9px;">
                        <!-- thumbnails injected by JS -->
                    </div>
                </div>
            </div>
        </div>
    </section>




     <!-- Partners Section -->
     <section class="partners-section" style="background:#CAA88E; padding:0; height:400px;">
        <div class="container">
            <div class="row gy-4" style="height:400px;">
                <!-- Text on the left (RTL), vertically centered -->
                <div class="col-12 col-lg-6 order-lg-1" style="text-align:right; color:#422A48; display:flex; height:100%; ">
                    <div>
                        <div style="font-weight:700; margin-bottom:12px; font-size:20px; width: 142px; height: 26px; margin-top: 52px;">شركاء المشروع </div>
                        <div style="line-height:1.9; font-size:20px; width: 465px; height: 64px;">
                        مكنتنا شراكات العلامات التجارية مع الشركات المؤثرة<br>
                        والشخصيات البارزة من تطوير مشروع مذهل.
                        </div>
                    </div>
                </div>
                <!-- Logos on the right (RTL), anchored to bottom -->
                <div class="col-12 col-lg-6 order-lg-2" style="display:flex; height:100%; align-items:flex-end;">
                    <div class="partners-logos" style="width:100%; margin-bottom:16px; display:flex; gap:16px; flex-wrap:nowrap; justify-content:flex-start;">
                        <div class="partner-item" style="padding:8px;">
                            <div style="background:#fff; border-radius:0; width:97px; height:97px; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                            </div>
                        </div>
                        <div class="partner-item" style="padding:8px;">
                            <div style="background:#fff; border-radius:0; width:97px; height:97px; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                            </div>
                        </div>
                        <div class="partner-item" style="padding:8px;">
                            <div style="background:#fff; border-radius:0; width:97px; height:97px; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                            </div>
                        </div>
                        <div class="partner-item" style="padding:8px;">
                            <div style="background:#fff; border-radius:0; width:97px; height:97px; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                                <img src="/assets/images/7.jpg" alt="partner" style="height:100%; width:auto; object-fit:cover;" loading="lazy">
                            </div>
                        </div>
                        <div class="partner-item" style="padding:8px;">
                            <div style="background:#fff; border-radius:0; width:97px; height:97px; display:flex; align-items:center; justify-content:center; overflow:hidden; margin-bottom:66px; margin-left: 85px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Amenities and Guarantees Section -->
    <section class="amenities-section" style="background:#fff; color:#422A48; padding:30px 0;">
        <div class="container">
            <!-- Amenities heading -->
            <h1 style="text-align:right; font-weight:700; width: 201px; height: 32px; font-size: 25px; margin-bottom:58px;">الخدمات والمرافق</h1>
            <div class="swiper slider amenities-swiper">
                <div class="slider__wrap swiper-wrapper">
                <div class="amenity-col swiper-slide">
                    <div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:85px; display:flex; align-items:center;  padding:0 16px;">
                    <span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span>
   
                    <span style="display:inline-block; width:82px; height:21px; margin-right: 17px;">مراكز صحية</span>
                    </div>
                </div>
                <div class="amenity-col swiper-slide">
                    <div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:85px; display:flex; align-items:center;  padding:0 16px;">
                    <span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span>
   
                    <span style="display:inline-block; width:95px; height:21px; margin-right: 17px;">شبكة كهرباء</span>
                    </div>
                </div>
                <div class="amenity-col swiper-slide">
                    <div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:85px; display:flex; align-items:center;  padding:0 16px;">
                    <span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span>
   
                    <span style="display:inline-block; width:113px; height:21px; margin-right: 17px;">مساحات خضراء</span>
                    </div>
                </div>
                <div class="amenity-col swiper-slide">
                    <div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:85px; display:flex; align-items:center;  padding:0 16px;">
                    <span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span>
   
                    <span style="display:inline-block; width:131px; height:21px; margin-right: 17px;">مواقف سيارات</span>
                    </div>
                </div>
                <div class="amenity-col swiper-slide">
                    <div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:85px; display:flex; align-items:center;  padding:0 16px;">
                    <span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span>
                    <span style="display:inline-block; width:92px; height:21px; margin-right: 17px;">مساجد عامة</span>
                    </div>
                </div>
                <!-- three more to make 8 -->
                <div class="amenity-col swiper-slide"><div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:85px; display:flex; align-items:center;  padding:0 16px;"><span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span><span style="display:inline-block; width:92px; height:21px; margin-right: 17px;">مدارس</span></div></div>
                <div class="amenity-col swiper-slide"><div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:85px; display:flex; align-items:center;  padding:0 16px;"><span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span><span style="display:inline-block; width:92px; height:21px; margin-right: 17px;">متنزهات</span></div></div>
                <div class="amenity-col swiper-slide"><div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:85px; display:flex; align-items:center;  padding:0 16px;"><span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span><span style="display:inline-block; width:92px; height:21px; margin-right: 17px;">تسوق</span></div></div>
                </div>
            </div>

            <!-- Amenities pagination (centered where separator dots were) -->
            <div class="slider__controls" style="text-align:center; margin:18px 0 8px;">
                <div class="slider__pagination amenities-pagination"></div>
            </div>

            <!-- Guarantees heading -->
            <div style="text-align:right; font-weight:700; width: 242px; height: 32px; font-size: 25px; margin-bottom:58px;">ضمانات علي المشروع</div>
            <div class="swiper slider guarantees-swiper">
                <div class="slider__wrap swiper-wrapper">
                <div class="guarantee-col swiper-slide">
                    <div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:108px; display:flex; align-items:center; justify-content:flex-start; gap:12px; padding:0 16px;">
                        <span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span>
                        <div style="display:flex; flex-direction:column; align-items:flex-start; gap:2px;">
                            <span style="width:120px; height:21px; color:#CAA88E;">المباني الإنشائي</span>
                            <span style="height:21px; color:#422A48; font-size:16px; font-weight:700; white-space:nowrap;">10 سنوات</span>
                        </div>
                    </div>
                </div>
                <div class="guarantee-col swiper-slide">
                    <div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:108px; display:flex; align-items:center; justify-content:flex-start; gap:12px; padding:0 16px;">
                        <span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span>
                        <div style="display:flex; flex-direction:column; align-items:flex-start; gap:2px;">
                            <span style="width:120px; height:21px; color:#CAA88E;">المباني الإنشائي</span>
                            <span style="height:21px; color:#422A48; font-size:16px; font-weight:700; white-space:nowrap;">10 سنوات</span>
                        </div>
                    </div>
                </div>
                <div class="guarantee-col swiper-slide">
                    <div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:108px; display:flex; align-items:center; justify-content:flex-start; gap:12px; padding:0 16px;">
                        <span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span>
                        <div style="display:flex; flex-direction:column; align-items:flex-start; gap:2px;">
                            <span style="width:120px; height:21px; color:#CAA88E;">المباني الإنشائي</span>
                            <span style="height:21px; color:#422A48; font-size:16px; font-weight:700; white-space:nowrap;">10 سنوات</span>
                        </div>
                    </div>
                </div>
                <div class="guarantee-col swiper-slide">
                    <div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:108px; display:flex; align-items:center; justify-content:flex-start; gap:12px; padding:0 16px;">
                        <span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span>
                        <div style="display:flex; flex-direction:column; align-items:flex-start; gap:2px;">
                            <span style="width:120px; height:21px; color:#CAA88E;">المباني الإنشائي</span>
                            <span style="height:21px; color:#422A48; font-size:16px; font-weight:700; white-space:nowrap;">10 سنوات</span>
                        </div>
                    </div>
                </div>
                <div class="guarantee-col swiper-slide">
                    <div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:108px; display:flex; align-items:center; justify-content:flex-start; gap:12px; padding:0 16px;">
                        <span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span>
                        <div style="display:flex; flex-direction:column; align-items:flex-start; gap:2px;">
                            <span style="width:120px; height:21px; color:#CAA88E;">المباني الإنشائي</span>
                            <span style="height:21px; color:#422A48; font-size:16px; font-weight:700; white-space:nowrap;">10 سنوات</span>
                        </div>
                    </div>
                </div>
                <!-- three more to make 8 -->
                <div class="guarantee-col swiper-slide"><div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:108px; display:flex; align-items:center; justify-content:flex-start; gap:12px; padding:0 16px;"><span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span><div style="display:flex; flex-direction:column; align-items:flex-start; gap:2px;"><span style="width:120px; height:21px; color:#CAA88E;">الأعمال الكهربائية</span><span style="height:21px; color:#422A48; font-size:16px; font-weight:700; white-space:nowrap;">10 سنوات</span></div></div></div>
                <div class="guarantee-col swiper-slide"><div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:108px; display:flex; align-items:center; justify-content:flex-start; gap:12px; padding:0 16px;"><span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span><div style="display:flex; flex-direction:column; align-items:flex-start; gap:2px;"><span style="width:120px; height:21px; color:#CAA88E;">السباكة</span><span style="height:21px; color:#422A48; font-size:16px; font-weight:700; white-space:nowrap;">10 سنوات</span></div></div></div>
                <div class="guarantee-col swiper-slide"><div style="border:1px solid #E6E6E6; border-radius:10px; width:249px; height:108px; display:flex; align-items:center; justify-content:flex-start; gap:12px; padding:0 16px;"><span style="width:38px; height:38px; background:#eee; border-radius:6px; display:inline-block;"></span><div style="display:flex; flex-direction:column; align-items:flex-start; gap:2px;"><span style="width:120px; height:21px; color:#CAA88E;">العزل الحراري</span><span style="height:21px; color:#422A48; font-size:16px; font-weight:700; white-space:nowrap;">10 سنوات</span></div></div></div>
                </div>
                <div class="slider__controls" style="text-align:center; margin:18px 0 8px;"><div class="slider__pagination guarantees-pagination"></div></div>
            </div>
        </div>
    </section>

   

    <!-- Register Interest Section -->
    <section class="register-section">
        <div class="register-container">
            <div class="register-card">
                <div class="register-title">سجل اهتمامك</div>
                <div class="register-subtitle">جميع الاستفسارات المتعلقة بمشاريع مملكة بانكينغ العقارية<br>برجاء التواصل على الرقم المجاني: 800330888</div>
                <form class="register-form" dir="rtl">
                    <div class="form-row">
                        <input type="text" placeholder="الاسم الأول">
                        <input type="text" placeholder="الاسم الأخير">
                    </div>
                    <div class="form-row">
                        <input type="email" placeholder="البريد الإلكتروني">
                    </div>
                    <div class="form-row phone-row">
  <div class="input-with-flag">
      <i class="fa-solid fa-arrow-left phone-arrow"></i>
      <img src="/assets/images/18.jpg" alt="flag" class="phone-flag">
      <input id="phone" type="tel" placeholder="رقم الهاتف">
  </div>
</div>



<div class="form-row">
  <div class="input-with-arrow">
      <i class="fa-solid fa-arrow-left unit-arrow"></i>
      <input type="text" placeholder="حدد وحدتك">
  </div>
</div>

                    <div class="form-row button-row">
                        <button type="submit">إرسال</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <footer class="site-footer" dir="rtl" style="margin-top: 20px; height: 536px;">
  <div class="footer-top">
    <!-- Section 1: Communities -->
    <div class="footer-col">
      <h3 style="font-size: 20px; width: 199px; height: 26px;">مجتمعات عبد المملكة</h3>
      <ul style="font-size: 14px;">
        <li><a href="#">مشروع المرسي</a></li>
        <li><a href="#">مشروع البيت</a></li>
        <li><a href="#">مشروع جدايا</a></li>
        <li><a href="#">مشروع روز فيلا</a></li>
        <li><a href="#">مشروع الجواز</a></li>
        <li><a href="#">عرض الكل <i class="fa-solid fa-arrow-left"></i></a></li>
      </ul>
    </div>

    <!-- Section 2: About -->
    <div class="footer-col">
      <h3 style="font-size: 20px; width: 139px; height: 26px;">عن عبر المملكة</h3>
      <ul>
        <li><a href="#">كلمة رئيس مجلس الإدارة</a></li>
        <li><a href="#">رحلتنا</a></li>
        <li><a href="#">مساحة العميل</a></li>
      </ul>
    </div>

    <!-- Section 3: Contact -->
    <div class="footer-col">
      <h3 style="font-size: 20px; width: 72px; height: 26px;">اتصل بنا</h3>
      <ul>
        <li><a href="#">للاستفسارات والملاحظات</a></li>
        <li><a href="#">المركز الإعلامي</a></li>
        <li><a href="#">الشركاء والشركات التابعة</a></li>
        <li><a href="#">الأسئلة الشائعة</a></li>
      </ul>
    </div>

    <!-- Section 4: Follow us -->
    <div class="footer-col">
      <h3 style="font-size: 20px; width: 48px; height: 26px;">تابعنا</h3>
      <ul class="social-links">
        <li><a href="#"><i class="fa-brands fa-facebook"></i> فيس بوك</a></li>
        <li><a href="#"><i class="fa-brands fa-linkedin"></i> لينكدان</a></li>
        <li><a href="#"><i class="fa-brands fa-youtube"></i> يوتيوب</a></li>
        <li><a href="#"><i class="fa-brands fa-instagram"></i> انستقرام</a></li>
      </ul>
    </div>

    <!-- Section 5: App download -->
    <div class="footer-col">
      <h3 style="font-size: 20px; width: 133px; height: 26px;">تحميل التطبيق</h3>
      <div class="app-buttons">
        <a href="#"><img src="/assets/images/image5.jpg" alt="Google Play"></a>
        <a href="#"><img src="/assets/images/image1.jpg" alt="App Store"></a>
      </div>
    </div>
  </div>

  <!-- Footer Bottom: Addresses -->
  <div class="footer-bottom">
    <div class="footer-address">
      <h4 style="font-size: 20px; color: #CAA88E; margin-bottom: 8px;">الخبر</h4>
      <p>مركز زتال للأعمال، طريق الملك فيصل، حي الروابي، الخبر، 31952</p>
      <div class="address-action">احصل على الاتجاهات</div>
    </div>
    <div class="footer-address">
      <h4 style="font-size: 20px; color: #CAA88E; margin-bottom: 8px;">جدة</h4>
      <p>مركز زتال للأعمال، طريق الملك فيصل، حي الروابي، جدة، 31952</p>
      <div class="address-action">احصل على الاتجاهات</div>
    </div>
</div>

  <!-- Footer Bottom Bar -->
  <div class="footer-bar">
  <div class="footer-logo">
      <img src="/assets/images/logo.png" alt="Logo">
    </div>
    <div class="footer-copy">
      جميع الحقوق محفوظة © عبر المملكة العقارية 2024
    </div>
    
    <div class="footer-links" style="font-size: 14px; color: #412A47; width: 265px; height: 18px;">
      <a href="#">سياسة الخصوصية</a> ♦ 
      <a href="#">تعليمات الاستخدام</a>
    </div>
  </div>
</footer>


    <!-- jQuery and Slick Slider JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            // Generate Dots Dynamically
            const $carousel = $('.carousel.slider');
            const imageCount = $carousel.find('.item').length;
            const $indicators = $('.carousel-indicators-numbers');
            
            // Clear existing dots (if any), keeping arrows
            $indicators.find('li').remove();
            
            // Generate dots based on image count
            for (let i = 0; i < imageCount; i++) {
                const $dot = $('<li>').attr('data-slide-to', i);
                if (i === 0) $dot.addClass('active');
                $indicators.find('.slick-next-btn').before($dot);
            }

            // Initialize Slick Slider
            $carousel.slick({
                slidesToShow: 3,
                slidesToScroll: 1, // Move 1 slide per click
                infinite: true,
                speed: 600, // Match your smooth scroll duration
                cssEase: 'ease',
                arrows: false, // Use custom arrows
                dots: false, // Use custom dots
                responsive: [
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            centerMode: true,
                            centerPadding: '0'
                        }
                    }
                ]
            });

            // Custom Arrow Navigation
            $('.slick-prev-btn').click(function () {
                $carousel.slick('slickPrev');
            });

            $('.slick-next-btn').click(function () {
                $carousel.slick('slickNext');
            });

            // Custom Dot Navigation
            $('.carousel-indicators-numbers li').click(function () {
                var index = $(this).data('slide-to');
                $carousel.slick('slickGoTo', index);
            });

            // Update Active Dot on Slide Change
            $carousel.on('afterChange', function (event, slick, currentSlide) {
                $('.carousel-indicators-numbers li').removeClass('active');
                $('.carousel-indicators-numbers li[data-slide-to="' + currentSlide + '"]').addClass('active');
            });

            // Mobile Menu Toggle
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            const navLinks = document.querySelector('.nav-links');

            mobileMenuToggle.addEventListener('click', () => {
                navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
                mobileMenuToggle.classList.toggle('active');
            });

            // Placeholder for play/pause
            function togglePlayPause() {
                const button = document.querySelector('.play-pause-btn');
                button.classList.toggle('paused');
                button.classList.toggle('playing');
            }

            // Models Section Logic
            const modelImages = {
                '1-A': [
                    '/assets/images/12.jpg',
                    '/assets/images/14.jpg',
                    '/assets/images/15.jpg',
                    '/assets/images/9.jpg'
                ],
                '1-B': [
                    '/assets/images/14.jpg',
                    '/assets/images/12.jpg',
                    '/assets/images/9.jpg',
                    '/assets/images/15.jpg'
                ],
                '2-A': [
                    '/assets/images/15.jpg',
                    '/assets/images/12.jpg',
                    '/assets/images/14.jpg',
                    '/assets/images/9.jpg'
                ],
                '2-B': [
                    '/assets/images/9.jpg',
                    '/assets/images/12.jpg',
                    '/assets/images/15.jpg',
                    '/assets/images/14.jpg'
                ],
                '3-A': [
                    '/assets/images/21.jpg',
                    '/assets/images/12.jpg',
                    '/assets/images/14.jpg',
                    '/assets/images/15.jpg'
                ],
                '3-B': [
                    '/assets/images/12.jpg',
                    '/assets/images/21.jpg',
                    '/assets/images/14.jpg',
                    '/assets/images/15.jpg'
                ]
            };

            function renderThumbs(typeKey) {
                const $thumbs = $('.model-thumbs');
                if ($thumbs.hasClass('slick-initialized')) {
                    $thumbs.slick('unslick');
                }
                $thumbs.empty();
                const imgs = modelImages[typeKey] || [];
                imgs.forEach((src, idx) => {
                    const $item = $('<div class="thumb-item">').css({ padding:'4px' }).append(
                        $('<img>').attr({ src, alt: 'thumb '+(idx+1), loading: 'lazy' }).css({ width:'169px', height:'103px', objectFit:'cover' })
                    );
                    $thumbs.append($item);
                });

                $thumbs.slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: false,
                    arrows: true,
                    prevArrow: '<button type="button" class="slick-prev" style="display:block;">‹</button>',
                    nextArrow: '<button type="button" class="slick-next" style="display:block;">›</button>',
                    responsive: [
                        { breakpoint: 992, settings: { slidesToShow: 3 } },
                        { breakpoint: 576, settings: { slidesToShow: 2 } }
                    ]
                });

                // Click a thumb to swap hero
                $thumbs.find('img').on('click', function(){
                    const src = $(this).attr('src');
                    $('#model-hero-image').attr('src', src);
                });
            }

            function setActiveButton(typeKey) {
                $('.model-btn').each(function(){
                    const isActive = $(this).data('model') === typeKey;
                    $(this).css({ background: isActive ? '#CAA88E' : '#422A48', color: isActive ? '#422A48' : '#fff' });
                });
            }

            function loadModel(typeKey) {
                const imgs = modelImages[typeKey] || [];
                if (imgs.length) {
                    $('#model-hero-image').attr('src', imgs[0]);
                }
                renderThumbs(typeKey);
                setActiveButton(typeKey);
            }

            // Bind buttons
            $(document).on('click', '.model-btn', function(){
                const key = $(this).data('model');
                loadModel(key);
            });

            // Initial
            loadModel('1-A');

            // Partners boxes are static; no slider needed
            // Swiper instances for amenities and guarantees
            const amenitiesSwiper = new Swiper('.amenities-swiper', {
                slidesPerView: 5,
                spaceBetween: 12,
                speed: 500,
                grabCursor: true,
                pagination: {
                    el: '.amenities-pagination',
                    clickable: true,
                    bulletClass: 'swiper-pagination-bullet',
                    bulletActiveClass: 'swiper-pagination-bullet-active',
                },
                breakpoints: {
                    0: { slidesPerView: 1.2 },
                    576: { slidesPerView: 2.2 },
                    768: { slidesPerView: 3.2 },
                    992: { slidesPerView: 4 },
                    1200: { slidesPerView: 5 }
                }
            });

            const guaranteesSwiper = new Swiper('.guarantees-swiper', {
                slidesPerView: 5,
                spaceBetween: 12,
                speed: 500,
                grabCursor: true,
                pagination: {
                    el: '.guarantees-pagination',
                    clickable: true,
                    bulletClass: 'swiper-pagination-bullet',
                    bulletActiveClass: 'swiper-pagination-bullet-active',
                },
                breakpoints: {
                    0: { slidesPerView: 1.2 },
                    576: { slidesPerView: 2.2 },
                    768: { slidesPerView: 3.2 },
                    992: { slidesPerView: 4 },
                    1200: { slidesPerView: 5 }
                }
            });

            // Intl-Tel-Input for phone with Saudi Arabia default
            const phoneInput = document.querySelector('#phone');
            if (phoneInput && window.intlTelInput) {
                const iti = window.intlTelInput(phoneInput, {
                    initialCountry: 'sa',
                    separateDialCode: true,
                    preferredCountries: ['sa', 'ae', 'kw', 'bh', 'qa'],
                    utilsScript: 'https://cdn.jsdelivr.net/npm/intl-tel-input@18.5.2/build/js/utils.js'
                });
            }
        });
    </script>
</body>
</html>