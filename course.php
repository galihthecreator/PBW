<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Botany | Course</title>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        />
        <style>
            body {
                background-color: #fffdf5;
            }
            .btn-green {
                background-color: #0f9d58;
                color: white;
            }
            .btn-green-outline {
                border: 1px solid #0f9d58;
                color: #0f9d58;
            }
            .hero-img {
                max-width: 100%;
                border-radius: 50%;
                background: radial-gradient(circle at center, #c6ffc1, #2ecc71);
            }
            .galeri-img-kanan-atas {
                height: 190px;
                object-fit: cover;
                width: 100%;
                border-radius: 12px;
            }
            .galeri-img-kanan-bawah {
                height: 190px;
                object-fit: cover;
                width: 100%;
                border-radius: 12px;
            }
            .galeri-img-kiri {
                height: 400px;
                object-fit: cover;
                width: 100%;
                border-radius: 12px;
            }
            .bg-dark {
                background-color: #374151 !important;
            }
            .btn-success {
                background-color: #2f855a;
                border: none;
            }
        </style>
    </head>
    <body>
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
            <div class="container">
                <a class="navbar-brand" href="index.html"
                    ><img
                        src="./img/LogoTeks.png"
                        alt=""
                        width="70%"
                        class="d-inline-block align-text-top"
                /></a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="collapse navbar-collapse justify-content-between align-items-center"
                    id="navbarNav"
                >
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="course.html"
                                >Course</a
                            >
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Community</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <div>
                        <a href="#" class="btn btn-green-outline me-2"
                            >Log In</a
                        >
                        <a href="#" class="btn btn-green-outline me-2"
                            >Sign Up</a
                        >
                    </div>
                </div>
            </div>
        </nav>

        <section class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6 text-center mb-4 mb-md-0">
                    <img
                        src="./img/cewekcourse1.png"
                        alt="kursus botany"
                        class="img-fluid rounded-circle"
                        style="max-width: 300px"
                    />
                </div>
                <div class="col-md-6">
                    <h2 class="fw-bold mb-3">
                        Course yang Memberi Hasil Fokus Praktik & Perawatan.
                    </h2>
                    <p class="text-muted mb-4">
                        Full Online dan Dipandu oleh Praktisi Senior. Praktikal,
                        lebih dari sekadar Webinar. Fokus Bantu Kembangkan Skill
                    </p>
                    <button class="btn btn-success mb-3">
                        Lihat Program Pilihan
                    </button>
                    <div class="d-flex align-items-center mt-3">
                        <div class="me-3">
                            <img
                                src="./img/oranglulus/Frame 1000003708.png"
                                alt="Alumni"
                                class="img-fluid"
                                style="height: 40px"
                            />
                        </div>
                        <span class="text-muted">10.000 Orang Telah Lulus</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- testimoni -->
        <section class="py-5 bg-white" id="testimoni">
            <div class="container text-center" style="max-width: 800px">
                <h3 class="fw-bold mb-5">Testimoni Alumni Bootcamp Botany</h3>
                <div class="row justify-content-center g-2">
                    <!-- testimoni 1 -->
                    <div
                        class="col-sm-4 col-sm-4 mb-4 d-flex justify-content-center"
                    >
                        <div class="card border-0 shadow-sm p-1 rounded-4">
                            <img
                                src="./img/course/Background+Border+Shadow.png"
                                alt="testimoni"
                                style="max-width: 200px"
                            />
                            <a
                                href="#"
                                class="btn btn-success mx-3 my-2 rounded-pill"
                                >Baca Cerita</a
                            >
                        </div>
                    </div>
                    <div
                        class="col-sm-4 col-sm-4 mb-4 d-flex justify-content-center"
                    >
                        <div class="card border-0 shadow-sm p-1 rounded-4">
                            <img
                                src="./img/course/cw1.png"
                                alt="testimoni"
                                style="max-width: 200px"
                            />
                            <a
                                href="#"
                                class="btn btn-success mx-3 my-2 rounded-pill"
                                >Baca Cerita</a
                            >
                        </div>
                    </div>
                    <div
                        class="col-sm-4 col-sm-4 mb-4 d-flex justify-content-center"
                    >
                        <div class="card border-0 shadow-sm p-1 rounded-4">
                            <img
                                src="./img/course/cw2.png"
                                alt="testimoni"
                                style="max-width: 200px"
                            />
                            <a
                                href="#"
                                class="btn btn-success mx-3 my-2 rounded-pill"
                                >Baca Cerita</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- footer -->
        <footer class="bg-light mt-5 pt-5 border-top">
            <div class="container pb-4">
                <div class="row gy-4">
                    <!-- Kolom 1: Logo dan Alamat -->
                    <div class="col-md-4">
                        <div class="d-flex align-items-center mb-2">
                            <img
                                src="./img/LogoTeks.png"
                                alt="Logo"
                                width="100"
                                class="me-2"
                            />
                        </div>
                        <p class="text-muted small mb-1">
                            PT. Botany Academy Indonesia
                        </p>
                        <p class="text-muted small mb-1">
                            Glagah Kidul, Tammanan, Kec. Banguntapan, <br />
                            Kabupaten Bantul, Daerah Istimewa Yogyakarta 55191
                        </p>
                        <div class="text-muted small">
                            <div class="d-flex align-items-center mb-2">
                                <img
                                    src="./img/telepon.png"
                                    alt="telepon"
                                    width="20"
                                    height="20"
                                />
                                <span class="ms-2">0857-0412-9676</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <img
                                    src="./img/pesan.png"
                                    alt="pesan"
                                    width="20"
                                    height="20"
                                />
                                <span class="ms-2"
                                    >dwikapradnyana123@gmail.com</span
                                >
                            </div>
                        </div>
                    </div>
                    <!-- Kolam 2: Tentang Kami -->
                    <div class="col-md-2">
                        <h6 class="fw-bold">Tentang Kami</h6>
                        <ul class="list-unstyled text-muted small">
                            <li>
                                <a
                                    href="#"
                                    class="text-muted text-decoration-none"
                                    >Program</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-muted text-decoration-none"
                                    >Blog Medium</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-muted text-decoration-none"
                                    >Hubungi Kami</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-muted text-decoration-none"
                                    >FAQ</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-muted text-decoration-none"
                                    >Dukungan</a
                                >
                            </li>
                        </ul>
                    </div>

                    <!-- Kolom 3: Terms -->
                    <div class="col-md-2">
                        <h6 class="fw-bold">Terms</h6>
                        <ul class="list-unstyled text-muted small">
                            <li>
                                <a
                                    href="#"
                                    class="text-muted text-decoration-none"
                                    >Kebijakan Privasi</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="text-muted text-decoration-none"
                                    >Syarat & Ketentuan</a
                                >
                            </li>
                        </ul>
                    </div>

                    <!-- Kolom 4: Ikuti Kami -->
                    <div class="col-md-4">
                        <h6 class="fw-bold">Ikuti Kami</h6>
                        <div class="d-flex gap-3 mt-2">
                            <a href="#" class="text-success fs-5"
                                ><img
                                    src="./img/ri_instagram-fill.png"
                                    alt="instagram"
                            /></a>
                            <a href="#" class="text-success fs-5"
                                ><img src="./img/mdi_youtube.png" alt="youtube"
                            /></a>
                            <a href="#" class="text-success fs-5"
                                ><img
                                    src="./img/ic_baseline-facebook.png"
                                    alt="facebook"
                            /></a>
                            <a href="#" class="text-success fs-5"
                                ><img
                                    src="./img/mdi_linkedin.png"
                                    alt="mdi_linkedin"
                            /></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white text-center py-3 border-top text-muted small">
                &copy; 2025 Botany Academy Indonesia. All Right Reserved
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
