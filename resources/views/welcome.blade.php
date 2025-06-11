<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SchoolTech Indonesia - Career</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar Start -->
    <div class="container-fluid bg-primary">
        <div class="container">
            <nav class="navbar navbar-dark navbar-expand-lg py-0">
                <a href="index.html" class="navbar-brand">
                    <img src="{{ asset('assets/img/white-color-horizontal.png') }}" alt="logo" height="55px"
                        width="193px">
                </a>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse bg-transparent" id="navbarCollapse">

                </div>
                <div class="d-none d-xl-flex flex-shirink-0">
                    <div id="phone-tada" class="d-flex align-items-center justify-content-center me-4">
                        <a href="https://wa.me/62881082861608" target="_blank"
                            class="position-relative animated tada infinite">
                            <i class="fa fa-phone-alt text-white fa-2x"></i>
                            <div class="position-absolute" style="top: -7px; left: 20px;">
                                <span><i class="fa fa-comment-dots text-secondary"></i></span>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex flex-column pe-4 border-end">
                        <span class="text-white-50">Have any questions?</span>
                        <span class="text-secondary">Call: +62 881 0828 61608</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center ms-4 position-relative"
                        style="z-index: 1000;">
                        <!-- Icon search -->
                        <a href="#" id="searchToggle">
                            <i class="bi bi-search text-white fa-2x"></i>
                        </a>

                        <!-- Floating input -->
                        <form id="searchForm"
                            class="d-none position-absolute start-50 translate-middle-x mt-2 p-2 bg-white rounded shadow"
                            style="top: 100%; width: 250px;">
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari...">
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- About Start -->
    <div class="container-fluid py-5 my-5">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-lg-5 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".3s">
                    <div class="h-100 position-relative">
                        <img src="img/about-1.jpg" class="img-fluid w-75 rounded" alt=""
                            style="margin-bottom: 25%;">
                        <div class="position-absolute w-75" style="top: 25%; left: 25%;">
                            <img src="img/about-2.jpg" class="img-fluid w-100 rounded" alt="">
                        </div>
                    </div>
                </div>
                <div id="about" class="col-lg-7 col-md-6 col-sm-12 wow fadeIn" data-wow-delay=".5s"
                    data-keywords="about schooltech visi misi perusahaan edukasi teknologi">
                    <h5 class="text-primary">About Us</h5>
                    <h1 class="mb-4">About SchoolTech Indonesia And It's Innovative Software as a Service</h1>
                    <p>SchoolTech Indonesia merupakan sebuah perusahaan yang bergerak pada bidang Information and
                        Technology khususnya memberikan inovasi penerapan Teknologi Informasi dan Komunikasi pada bidang
                        Edukasi.</p>
                    <p class="mb-4">Kami berkomitmen untuk membantu sekolah-sekolah dalam melakukan penerapan
                        teknologi untuk mempermudah proses manajemen sekolah.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Services Start -->
    <div class="container-fluid services py-5 mb-5">
        <div class="container">
            <div id="services" class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s"
                data-keywords="services layanan client support produk" style="max-width: 600px;">
                <h5 class="text-primary">Our Services</h5>
                <h1>Services Built Specifically For Our Client</h1>
            </div>
            <div class="row g-5 services-inner">
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".5s">
                    <div class="services-item bg-light">
                        <div class="p-4 text-center services-content">
                            <div class="services-content-icon">
                                <i class="fa fa-envelope-open fa-7x mb-4 text-primary"></i>
                                <h4 class="mb-3">Software as a Service</h4>
                                <p class="mb-4">Optimalkan administrasi sekolah dengan akses data dan kelola proses
                                    secara efisien dengan teknologi berbasis cloud yang mudah digunakan dan terintegrasi
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                    <div class="services-item bg-light">
                        <div class="p-4 text-center services-content">
                            <div class="services-content-icon">
                                <i class="fa fa-code fa-7x mb-4 text-primary"></i>
                                <h4 class="mb-3">Web Design</h4>
                                <p class="mb-4">Ciptakan situs web yang memikat dengan desain yang estetis dan
                                    fungsional, dioptimalkan untuk pengalaman pengguna yang luar biasa</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".5s">
                    <div class="services-item bg-light">
                        <div class="p-4 text-center services-content">
                            <div class="services-content-icon">
                                <i class="fa fa-file-code fa-7x mb-4 text-primary"></i>
                                <h4 class="mb-3">Web Development</h4>
                                <p class="mb-4">Kami memberikan solusi pengembangan website yang akan menciptakan
                                    peluang untuk menghasilkan lebih banyak prospek dan mencapai tujuan Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".7s">
                    <div class="services-item bg-light">
                        <div class="p-4 text-center services-content">
                            <div class="services-content-icon">
                                <i class="fa fa-external-link-alt fa-7x mb-4 text-primary"></i>
                                <h4 class="mb-3">UI/UX Design</h4>
                                <p class="mb-4">Kami menciptakan desain yang memberikan pengalaman yang berarti,
                                    indah, dan relevan bagi pengguna</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                    <div class="services-item bg-light">
                        <div class="p-4 text-center services-content">
                            <div class="services-content-icon">
                                <i class="fas fa-user-secret fa-7x mb-4 text-primary"></i>
                                <h4 class="mb-3">Web Cecurity</h4>
                                <p class="mb-4">Amankan situs web dengan solusi keamanan yang menyeluruh dan
                                    terpercaya untuk melindungi data</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".7s">
                    <div class="services-item bg-light">
                        <div class="p-4 text-center services-content">
                            <div class="services-content-icon">
                                <i class="fas fa-laptop fa-7x mb-4 text-primary"></i>
                                <h4 class="mb-3">Programming</h4>
                                <p class="mb-4">Menghadirkan pemrograman yang berkualitas untuk solusi yang optimal
                                    dan sesuai kebutuhan bisnis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    <!-- Values Start -->
    <div class="container-fluid services py-5 mb-5">
        <div class="container">
            <div id="values" class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s"
                data-keywords="value nilai budaya integritas" style="max-width: 600px;">
                <h5 class="text-primary">Our Value</h5>
                <h1>Our Corporate Value to Implement in Staff</h1>
            </div>
            <div class="row g-5 services-inner">
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".5s">
                    <div class="services-item bg-light">
                        <div class="p-4 text-center services-content">
                            <div class="services-content-icon">
                                <i class="fa fa-star fa-7x mb-4 text-primary"></i>
                                <h4 class="mb-3">Quality</h4>
                                <p class="mb-4">Kami berkomitmen menyediakan layanan terbaik dengan standar tinggi
                                    untuk memastikan kepuasan anda</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                    <div class="services-item bg-light">
                        <div class="p-4 text-center services-content">
                            <div class="services-content-icon">
                                <i class="fa fa-handshake fa-7x mb-4 text-primary"></i>
                                <h4 class="mb-3">Integrity</h4>
                                <p class="mb-4">Kami memastikan kepercayaan anda terjaga, serta memberikan solusi
                                    yang dapat diandalkan dan bertanggung jawab</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".5s">
                    <div class="services-item bg-light">
                        <div class="p-4 text-center services-content">
                            <div class="services-content-icon">
                                <i class="fa fa-heart fa-7x mb-4 text-primary"></i>
                                <h4 class="mb-3">Charity</h4>
                                <p class="mb-4">Melalui aksi nyata dan kemitraan strategis, kami berkoitmen untuk
                                    membangun masa depan yang lebih baik dibidang pendidikan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->


    <!-- Project Start -->
    <div class="container-fluid project py-5 mb-5">
        <div class="container">
            <div id="opportunity" class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s"
                data-keywords="opportunity peluang karir rekrutmen" style="max-width: 600px;">
                <h5 class="text-primary">Our Opportunity</h5>
                <h1>Join to Our Team!</h1>
            </div>
            <div class="row g-5">
                @foreach ($opportunities as $item)
                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay=".3s">
                        <div class="project-item">
                            <div class="project-img">
                                <img src="img/project-{{ $loop->index + (1 % 6) }}.jpg"
                                    class="img-fluid w-100 rounded" alt="">
                                <div class="project-content">
                                    <a href="/opportunities/{{ $item->id }}" class="text-center">
                                        <h4 class="text-secondary">{{ $item->division->name }}</h4>
                                        <p class="m-0 text-white">{{ $item->name }}</p>
                                        <p class="m-0 text-white">{{ $item->category->name }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Project End -->


    <!-- Team Start -->
    <div class="container-fluid py-5 mb-5 team">
        <div class="container">
            <div id="team" class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s"
                data-keywords="team tim kerja kolaborasi" style="max-width: 600px;">
                <h5 class="text-primary">Our Team</h5>
                <h1>Meet our expert Team</h1>
            </div>
            <div class="owl-carousel team-carousel wow fadeIn" data-wow-delay=".5s">
                <div class="rounded team-item">
                    <div class="team-content">
                        <div class="team-img-icon">
                            <div class="team-img rounded-circle">
                                <img src="img/team-1.jpg" class="img-fluid w-100 rounded-circle" alt="">
                            </div>
                            <div class="team-name text-center py-3">
                                <h4 class="">Sendy Johan</h4>
                                <p class="m-0">Executive Officer</p>
                            </div>
                            <div class="team-icon d-flex justify-content-center pb-4">
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded team-item">
                    <div class="team-content">
                        <div class="team-img-icon">
                            <div class="team-img rounded-circle">
                                <img src="img/team-2.jpg" class="img-fluid w-100 rounded-circle" alt="">
                            </div>
                            <div class="team-name text-center py-3">
                                <h4 class="">M. Al Husein</h4>
                                <p class="m-0">Head of Creatice Design</p>
                            </div>
                            <div class="team-icon d-flex justify-content-center pb-4">
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded team-item">
                    <div class="team-content">
                        <div class="team-img-icon">
                            <div class="team-img rounded-circle">
                                <img src="img/team-3.jpg" class="img-fluid w-100 rounded-circle" alt="">
                            </div>
                            <div class="team-name text-center py-3">
                                <h4 class="">Annisa Arisnawati</h4>
                                <p class="m-0">Head of Information Technology</p>
                            </div>
                            <div class="team-icon d-flex justify-content-center pb-4">
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded team-item">
                    <div class="team-content">
                        <div class="team-img-icon">
                            <div class="team-img rounded-circle">
                                <img src="img/team-4.jpg" class="img-fluid w-100 rounded-circle" alt="">
                            </div>
                            <div class="team-name text-center py-3">
                                <h4 class="">Isna Binti K.</h4>
                                <p class="m-0">Head of General Affairs</p>
                            </div>
                            <div class="team-icon d-flex justify-content-center pb-4">
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-square btn-secondary text-white rounded-circle m-1"
                                    href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Footer Start -->
    <div class="container-fluid footer bg-dark wow fadeIn" data-wow-delay=".3s">
        <div class="container pt-5 pb-4">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <a href="index.html">
                        <img src="{{ asset('assets/img/white-color-horizontal.png') }}" alt="logo" height="55px"
                            width="193px">
                    </a>
                    <p class="mt-4 text-light">SchoolTech berkomitmen menjadi solusi IT terpercaya untuk sekolah,
                        mendukung transformasi digital. Dengan layanan unggulan kami, sekolah dapat mempercepat
                        digitalisasi secara efisien dan optimal.</p>
                    <div class="d-flex hightech-link">
                        <a href="" class="btn-light nav-fill btn btn-square rounded-circle me-2"><i
                                class="fab fa-instagram text-primary"></i></a>
                        <a href="" class="btn-light nav-fill btn btn-square rounded-circle me-0"><i
                                class="fab fa-linkedin-in text-primary"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">

                </div>
                <div class="col-lg-3 col-md-6">

                </div>
                <div id="contact" class="col-lg-3 col-md-6" data-keywords="contact hubungi email telepon">
                    <a href="#" class="h3 text-secondary">Contact Us</a>
                    <div class="text-white mt-4 d-flex flex-column contact-link">
                        <a href="#" class="pb-3 text-light border-bottom border-primary"><i
                                class="fas fa-map-marker-alt text-secondary me-2"></i> Jl. Gunung Jati RT. 022 RW. 005
                            Desa Pandan Landung. Kecamatan Wagir. Kabupaten Malang</a>
                        <a href="#" class="py-3 text-light border-bottom border-primary"><i
                                class="fas fa-phone-alt text-secondary me-2"></i> +62 881 0828 61608</a>
                        <a href="#" class="py-3 text-light border-bottom border-primary"><i
                                class="fas fa-envelope text-secondary me-2"></i> admin@schooltechindonesia.com </a>
                    </div>
                </div>
            </div>
            <hr class="text-light mt-5 mb-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <span class="text-light"><a href="#" class="text-secondary"><i
                                class="fas fa-copyright text-secondary me-2"></i>SchoolTech Indonesia</a>, All right
                        reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    <span class="text-light">Designed By<a href="https://htmlcodex.com" class="text-secondary">HTML
                            Codex</a></span>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary btn-square rounded-circle back-to-top"><i
            class="fa fa-arrow-up text-white"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>

    <script>
        const toggle = document.getElementById('searchToggle');
        const form = document.getElementById('searchForm');
        const input = document.getElementById('searchInput');
        const items = document.querySelectorAll('[data-keywords]');

        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            form.classList.toggle('d-none');
            if (!form.classList.contains('d-none')) input.focus();
        });

        document.addEventListener('click', function(e) {
            if (!form.contains(e.target) && !toggle.contains(e.target)) {
                form.classList.add('d-none');
            }
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const query = input.value.toLowerCase().trim();
            let found = false;

            items.forEach(item => {
                const keywords = item.getAttribute('data-keywords') || '';
                if (!found && keywords.includes(query)) {
                    item.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    found = true;
                }
            });

            if (!found) {
                alert('Bagian tidak ditemukan!');
            }
        });
    </script>


    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>
