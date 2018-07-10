@extends('layouts.app')

@section('content')
<!--==========================
    Hero Section
============================-->
<section id="hero">
    <div class="hero-container">
        <h1>Welcome to IT-ESEGA</h1>
        <h2>Daftarkan timmu dan jadilah juara</h2>
        @guest
            <a href="/register" class="btn-get-started">Daftar sekarang</a>
        @else
            <a href="/team" class="btn-get-started">Kelola Tim</a>
        @endguest
    </div>
</section><!-- #hero -->

<main id="main">
    <!--==========================
    About Us Section
    ============================-->
    <section id="about">
        <div class="container">
            <div class="row about-container">

            <div class="col-lg-6 content order-lg-1 order-2">
                <h2 class="title">Tentang IT-ESEGA</h2>
                <p>
                    <i>Information Technology Electronical Sport Based The Excellence Games</i> (IT-ESEGA) merupakan kegiatan perlombaan dengan tujuan utama meningkatkan komunitas dan pengembangan industri pada bidang e-Sports serta mewadahi masyarakat yang memiliki potensi atau prestasi pada bidang e-Sports.
                </p>
                <p>
                    Acara ini melibatkan kalangan umum masyarakat dari mahasiswa, siswa SMA/SMK/sederajat dan para <i>gamers</i> se-Bali.
                </p>
            </div>

            <div class="col-lg-6 background order-lg-2 order-1 wow fadeInRight"></div>
            </div>

        </div>
    </section><!-- #about -->

    <!--==========================
    Cara pendaftaran Section
    ============================-->
    <section id="cara-pendaftaran">
        <div class="container wow fadeIn">
            <div class="section-header">
            <h3 class="section-title">Rangkaian Acara</h3>
            <p class="section-description"><b>IT-ESEGA</b> dilakukan dengan rangkaian acara sebagai berikut</p>
            </div>
            <div class="row">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="box">
                <div class="icon"><a class="icon-color" href="#cara-pendaftaran"><i class="fas fa-desktop"></i></a></div>
                <h4 class="title"><a href="#cara-pendaftaran">Pendaftaran</a></h4>
                <p class="description">Pendaftaran dilaksanakan secara <i style="color:#212529">online</i> pada <i style="color:#212529">website</i> <b>IT-ESEGA</b><br><i class="fas fa-calendar-check mr-2"></i>22 Juli-30 Agustus</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                <div class="box">
                <div class="icon"><a class="icon-color" href="#cara-pendaftaran"><i class="far fa-comments"></i></a></div>
                <h4 class="title"><a href="">Technical Meeting</a></h4>
                <p class="description"><i style="color:#212529">Technical Meeting</i> dilakukan pada Aula Wicwakrama, Fakultas Teknik Jl. PB. Sudirman<br><i class="fas fa-calendar-check mr-2"></i>2 September</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                <div class="box">
                <div class="icon"><a class="icon-color" href="#cara-pendaftaran"><i class="fas fa-chess-board"></i></a></div>
                <h4 class="title"><a href="">Penyisihan</a></h4>
                <p class="description">Penyisihan dilaksanakan di <br><b>Acyuta Gubuk Gaming</b><br><i class="fas fa-calendar-check mr-2"></i>23-24 September</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="box">
                <div class="icon"><a class="icon-color" href="#cara-pendaftaran"><i class="fas fa-chess-board"></i></a></div>
                <h4 class="title"><a href="">Per 8 Final</a></h4>
                <p class="description">Per 8 Final dilaksanakan di <br><b>Acyuta Gubuk Gaming</b><br><i class="fas fa-calendar-check mr-2"></i>1 Oktober</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                <div class="box">
                <div class="icon"><a class="icon-color" href="#cara-pendaftaran"><i class="fas fa-chess"></i></a></div>
                <h4 class="title"><a href="">Semi Final</a></h4>
                <p class="description">Semi Final dilaksanakan di <br><b>Acyuta Gubuk Gaming</b><br><i class="fas fa-calendar-check mr-2"></i>1 Oktober</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                <div class="box">
                <div class="icon"><a class="icon-color" href="#cara-pendaftaran"><i class="fas fa-trophy"></i></a></div>
                <h4 class="title"><a href="">Final</a></h4>
                <p class="description">Final dilaksanakan di <br><b>Acyuta Gubuk Gaming</b><br><i class="fas fa-calendar-check mr-2"></i>1 Oktober</p>
                </div>
            </div>
            </div>
        </div>
    </section><!-- #cara-pendaftaran -->
    <!--==========================
    Call To Action Section
    ============================-->
    <section id="call-to-action">
        <div class="container wow fadeIn">
            <div class="row">
            <div class="col-lg-9 text-center text-lg-left">
                <h3 class="cta-title">Sudah memiliki tim?</h3>
                <p class="cta-text">sudah memiliki tim dan mendaftarkan tim kamu di website IT-ESEGA? Tinggal sedikit lagi untuk melengkapi biodata tim kalian dan kirim bukti pembyaran dengan menekan tombol berikut.</p>
            </div>
            <div class="col-lg-3 cta-btn-container text-center">
                <a class="cta-btn align-middle" href="/team">Lengkapi</a>
            </div>
            </div>
        </div>
    </section><!-- #call-to-action -->
    <!--==========================
    Team Section
    ============================-->
    <section id="team">
        <div class="container wow fadeInUp">
            <div class="section-header">
                <h3 class="section-title">Juara</h3>
                <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
            </div>
            <div class="row">
                @if(count($champion))
                    @foreach($champion as $c)
                        <div class="col-lg-3 col-md-6">
                            <div class="member">
                                <div class="pic"><img src="/avatars/{{$c->user->avatar}}" alt=""></div>
                                <a class="text-dark" href="/champion/{{$c->id}}"><h4>{{$c->user->teamname}}</h4></a>
                                <span>{{$c->year}}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-3 col-md-6">
                        <div class="member">
                            <div class="pic"><img src="/avatars/noavatar.png" alt=""></div>
                            <h4>Belum ada juara</h4>
                            <span>yyyy</span>
                        </div>
                    </div>
                @endif
                <div class="col-lg-3 col-md-6">
                    <div class="member">
                        <div class="pic"><img src="/avatars/noavatar.png" alt=""></div>
                        <h4>?</h4>
                        <span>2018</span>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- #team -->
    <!--==========================
    Contact Section
    ============================-->
    <section id="contact">
        <div class="container wow fadeInUp">
            <div class="section-header">
            <h3 class="section-title">Hubungi Kami</h3>
            <p class="section-description">Untuk informasi lebih lanjut, kamu bisa menghubungi kami atau langsung ke tempat kami di alamat berikut.</p>
            </div>
        </div>

        <div id="google-map" data-latitude="-8.7995162" data-longitude="115.172256"></div>

        <div class="container wow fadeInUp">
            @if ($errors->any())
				<center><div class="alert alert-danger alert-dismissible fade show col-md-4 col-sm-4" role="alert">
					@if(Session::has('error'))
						<h4><i class="text-danger fas fa-times mr-1"></i>{{Session::get('error')}}</h4>
					@endif

					<ul class="m-0">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div></center>
			@endif

			@if(Session::has('success'))
				<center><div class="alert alert-success alert-dismissible fade show col-md-4 col-sm-4" role="alert">
					<i class="text-success fas fa-check mr-1"></i> {{Session::get('success')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div></center>
			@endif
            <div class="row justify-content-center">

                <div class="col-lg-3 col-md-4">

                    <div class="info">
                        <div>
                            <i class="fas fa-map-marker contact-icon"></i>
                            <p>Gedung Teknologi Informasi-Fakultas Teknik, <br>Jalan Raya Kampus UNUD, Jimbaran, Badung, Bali</p>
                        </div>

                        <div>
                            <i class="fas fa-envelope contact-icon"></i>
                            <p>it@unud.ac.id</p>
                        </div>

                        <div>
                            <i class="fas fa-phone contact-icon"></i>
                            <p>0361-701806</p>
                        </div>
                    </div>

                    <div class="social-links">
                    <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="fab fa-google-plus"></i></a>
                    <a href="#" class="linkedin"><i class="fab fa-linkedin"></i></a>
                    </div>

                </div>

                <div class="col-lg-5 col-md-8">
                    <div class="form">
                        <form action="/guest/message" method="post">
                            @csrf
                            <div class="form-group row">
                                <input id="sender" type="text" class="form-control{{ $errors->has('sender') ? ' is-invalid' : '' }}" name="sender" placeholder="Nama" required>

                                @if ($errors->has('sender'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sender') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <input id="subject" type="text" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" name="subject" placeholder="Subjek" required>

                                @if ($errors->has('subject'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <textarea name="message" id="message" rows="5" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }} mb-2" placeholder="message" required></textarea>

                                @if ($errors->has('message'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row justify-content-center">
                                    <button type="submit" name="submit" value="Simpan" class="btn-submit"><i class="fas fa-location-arrow"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- #contact -->
    <!--==========================
    Footer
    ============================-->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">

            </div>
        </div>

        <div class="container">
            <div class="copyright">
            &copy; Copyright <strong>IT-ESEGA</strong>. All Rights Reserved
            </div>
            <div class="credits">
            <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Regna
            -->
            {{-- Bootstrap Templates by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
            </div>
        </div>
    </footer><!-- #footer -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
</main>
@endsection
