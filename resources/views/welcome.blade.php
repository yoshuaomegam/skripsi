
@extends('layouts.home')

@section('content')
<!-- Masthead -->
<header class="masthead text-white text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">Selamat Datang di Website APBDesa Kabupaten Ngawi</h1>
      </div>
      <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
        <form>
          <div class="form-row">
            <div class="col-12 col-md-9 mb-2 mb-md-0">
              <input type="email" class="form-control form-control-lg" placeholder="Masukkan Kosakata">
            </div>
            <div class="col-12 col-md-3">
              <button type="submit" class="btn btn-block btn-lg btn-primary">Search</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</header>
        
<section class="testimonials text-center bg-light">
        <div class="container">
          <h2 class="mb-5">Pelaporan Terbaik</h2>
          <div class="row">
            <div class="col-lg-4">
              <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                <img class="img-fluid rounded-circle mb-3" src="img/testimonials-1.jpg" alt="">
                <h5>Kelurahan Ketanggi</h5>
                <p class="font-weight-light mb-0">Kecamatan Ngawi</p>
                <button type="submit" class="btn btn-lg btn-primary">Detail</button>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                <img class="img-fluid rounded-circle mb-3" src="img/testimonials-2.jpg" alt="">
                <h5>Desa Dumplengan</h5>
                <p class="font-weight-light mb-0">Kecamatan Pitu</p>
                <a href="apbdesa"class="btn btn-lg btn-primary">Detail</a>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                <img class="img-fluid rounded-circle mb-3" src="img/testimonials-3.jpg" alt="">
                <h5>Desa Soco</h5>
                <p class="font-weight-light mb-0">Kecamatan Jogorogo</p>
                <button type="submit" class="btn btn-lg btn-primary">Detail</button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Portfolio -->
    <section class="masthead text-white text-center" id="portfolio">
      <div class="container">
        <div class="content-section-heading text-center">
          <h2 class="mb-5">Kunjungi Website Lain di Kab. Ngawi</h2>
        </div>
        <div class="row no-gutters">
          <div class="col-lg-6">
            <a class="portfolio-item" href="#">
              <span class="caption">
                <span class="caption-content">
                  <h2>Website Kab. Ngawi</h2>
                  <p class="mb-0">Informasi Mengenai Ngawi</p>
                </span>
              </span>
              <img class="img-fluid" src="img/portfolio-1.jpg" alt="">
            </a>
          </div>
          <div class="col-lg-6">
            <a class="portfolio-item" href="#">
              <span class="caption">
                <span class="caption-content">
                  <h2>LPSE Ngawi</h2>
                  <p class="mb-0">LPSE Ngawi</p>
                </span>
              </span>
              <img class="img-fluid" src="img/portfolio-2.jpg" alt="">
            </a>
          </div>
          <div class="col-lg-6">
            <a class="portfolio-item" href="#">
              <span class="caption">
                <span class="caption-content">
                  <h2>Pengaduan</h2>
                  <p class="mb-0">Website Masyarakat melakukan pengaduan</p>
                </span>
              </span>
              <img class="img-fluid" src="img/portfolio-3.jpg" alt="">
            </a>
          </div>
          <div class="col-lg-6">
            <a class="portfolio-item" href="#">
              <span class="caption">
                <span class="caption-content">
                  <h2>Portal Data</h2>
                  <p class="mb-0">Berisi Data di Seluruh Kab. Ngawi</p>
                </span>
              </span>
              <img class="img-fluid" src="img/portfolio-4.jpg" alt="">
            </a>
          </div>
        </div>
      </div>
    </section>
  
@stop