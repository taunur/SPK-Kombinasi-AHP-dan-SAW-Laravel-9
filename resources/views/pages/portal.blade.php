@extends('layouts.portal')

@section('title')
    Portal
@endsection

@section('content')
    <!-- Jumbotron -->
    <section id="hero-animated" class="hero-animated d-flex align-items-center">
        <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative"
            data-aos="zoom-out">
            <img src="{{ url('frontend/images/Sekolah.jpg') }}" class="img-fluid animated" />
            <h2>Selamat datang di</h2>
            <p>Sistem Pendukung Keputusan Pemilihan Siswa Berprestasi</p>
            <div class="d-flex">
                @auth
                    <a href="{{ route('dashboard.index') }}" class="btn btn-dark">My Dashboard</a>
                @else
                    <a href="{{ route('login.index') }}" class="btn-get-started scrollto">Get Started</a>
                @endauth
            </div>
        </div>
    </section>
    <!-- End Jumbotron -->
    <main id="">
        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services">
            <div class="container ">
                <div class="row d-flex justify-content-betwen text-center">
                    <div class="col-xl-3 col-md-6" data-aos="zoom-out">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-people icon"></i></div>
                            <h4>
                                <a class="stretched-link"><span>{{ $students }}</span> Siswa</a>
                            </h4>
                        </div>
                    </div>
                    <!-- End Service Item -->
                    <div class="col-xl-3 col-md-6 " data-aos="zoom-out" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-layout-text-sidebar icon"></i>
                            </div>
                            <h4>
                                <a class="stretched-link"><span>{{ $criterias }}</span> Kriteria</a>
                            </h4>
                        </div>
                    </div>
                    <!-- End Service Item -->
                    <div class="col-xl-3 col-md-6 " data-aos="zoom-out" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-building icon"></i>
                            </div>
                            <h4>
                                <a class="stretched-link"><span>{{ $kelases }}</span> Kelas</a>
                            </h4>
                        </div>
                    </div>
                    <!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 " data-aos="zoom-out" data-aos-delay="600">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-person-gear icon"></i></div>
                            <h4>
                                <a class="stretched-link"><span>{{ $users }}</span> Pengguna</a>
                            </h4>
                        </div>
                    </div>
                    <!-- End Service Item -->
                </div>
            </div>
        </section>
        <!-- End Featured Services Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>About Us</h2>
                    <p>
                        Selamat datang di platform online yang bertujuan untuk memberikan
                        solusi inovatif dalam pemilihan siswa berprestasi menggunakan
                        Sistem Pendukung Keputusan (SPK). Kami berkomitmen untuk membantu
                        sekolah, lembaga pendidikan, dan pihak terkait dalam proses
                        seleksi siswa berprestasi yang adil, obyektif, dan efisien.
                    </p>
                </div>

                <div class="row g-4 g-lg-5 align-items-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-lg-5">
                        <div class="about-img">
                            <img src="{{ url('frontend/images/about.png') }}" class="img-fluid" alt="" />
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active">
                                <div class="d-flex align-items-center mt-4">
                                    <i class="bi bi-check2"></i>
                                    <h4>Objektivitas dalam Seleksi</h4>
                                </div>
                                <p>
                                    Dengan menggunakan SPK, kriteria dan bobot yang telah
                                    ditentukan secara jelas dapat diterapkan pada semua calon
                                    siswa.
                                </p>

                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check2"></i>
                                    <h4>Efisiensi dan Waktu</h4>
                                </div>
                                <p>
                                    Penggunaan website untuk pemilihan siswa berprestasi dengan
                                    menggunakan SPK dapat meningkatkan efisiensi dan menghemat
                                    waktu.
                                </p>

                                <div class="d-flex align-items-center mt-4">
                                    <i class="bi bi-check2"></i>
                                    <h4>Analisis yang Lebih Mendalam</h4>
                                </div>
                                <p>
                                    Melalui website ini, pengguna dapat mengakses dan
                                    menganalisis data calon siswa secara lebih mendalam.
                                </p>
                            </div>
                            <!-- End Tab 1 Content -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Section -->

        <!-- ======= F.A.Q Section ======= -->
        <section id="faq" class="faq">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4">
                    <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch order-2 order-lg-1">
                        <div class="content px-xl-5">
                            <h3>Frequently Asked <strong>Questions</strong></h3>
                        </div>

                        <div class="accordion accordion-flush px-xl-5" id="faqlist">
                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-1">
                                        <i class="bi bi-question-circle question-icon"></i>
                                        Apa itu Sistem Pendukung Keputusan (SPK)?
                                    </button>
                                </h3>
                                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        SPK adalah sistem komputer atau perangkat lunak yang
                                        dirancang untuk membantu pengambilan keputusan dengan
                                        menganalisis data, memodelkan masalah, dan memberikan
                                        rekomendasi atau solusi.
                                    </div>
                                </div>
                            </div>
                            <!-- # Faq item-->

                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-2">
                                        <i class="bi bi-question-circle question-icon"></i>
                                        Bagaimana SPK bekerja?
                                    </button>
                                </h3>
                                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        SPK bekerja dengan mengumpulkan data yang relevan,
                                        menganalisisnya menggunakan metode-metode atau model yang
                                        telah ditentukan, dan menghasilkan rekomendasi berdasarkan
                                        hasil analisis.
                                    </div>
                                </div>
                            </div>
                            <!-- # Faq item-->

                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-3">
                                        <i class="bi bi-question-circle question-icon"></i>
                                        Apa manfaat menggunakan SPK dalam pengambilan keputusan?
                                    </button>
                                </h3>
                                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        Penggunaan SPK dapat membantu mengurangi ketidakpastian,
                                        meningkatkan efisiensi, meningkatkan akurasi, mendukung
                                        pengambilan keputusan berbasis data, dan memberikan
                                        panduan dalam situasi yang kompleks.
                                    </div>
                                </div>
                            </div>
                            <!-- # Faq item-->

                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="500">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-4">
                                        <i class="bi bi-question-circle question-icon"></i>
                                        Apakah dibutuhkan keahlian khusus untuk menggunakan SPK?
                                    </button>
                                </h3>
                                <div id="faq-content-4" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        <i class="bi bi-question-circle question-icon"></i>
                                        Penggunaan SPK biasanya membutuhkan pemahaman tentang
                                        konsep dasar SPK, pemodelan masalah, analisis data, dan
                                        penggunaan perangkat lunak atau alat yang spesifik. Namun,
                                        banyak perangkat lunak SPK yang telah dirancang untuk
                                        digunakan oleh pengguna tanpa keahlian khusus.
                                    </div>
                                </div>
                            </div>
                            <!-- # Faq item-->

                            <div class="accordion-item" data-aos="fade-up" data-aos-delay="600">
                                <h3 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-content-5">
                                        <i class="bi bi-question-circle question-icon"></i>
                                        Bagaimana mengukur keberhasilan penggunaan SPK?
                                    </button>
                                </h3>
                                <div id="faq-content-5" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                                    <div class="accordion-body">
                                        Keberhasilan penggunaan SPK dapat diukur berdasarkan
                                        akurasi atau kebenaran rekomendasi yang diberikan,
                                        kecepatan atau efisiensi dalam pengambilan keputusan,
                                        adopsi atau penerimaan oleh pengguna, dan
                                    </div>
                                </div>
                            </div>
                            <!-- # Faq item-->
                        </div>
                    </div>

                    <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img"
                        style="background-image: url('{{ url('frontend/images/faq.png') }}')">
                        &nbsp;
                    </div>
                </div>
            </div>
        </section>
        <!-- End F.A.Q Section -->
    </main>
@endsection
