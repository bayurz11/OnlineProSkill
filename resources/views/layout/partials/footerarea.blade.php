 <!-- footer-area -->
 <footer class="footer__area">
     <div class="footer__top">
         <div class="container">
             <div class="row">
                 <div class="col-xl-3 col-lg-4 col-md-6">
                     <div class="footer__widget">
                         <div class="logo mb-35">
                             <a href="{{ route('/') }}"><img src="{{ asset('public/assets/img/logo/logo.svg') }}"
                                     alt="img"></a>
                         </div>
                         <div class="footer__content">
                             <p>Proskill Akademia adalah lembaga kursus yang dikelola oleh:<br> <b>PT Bahagia Sukses
                                     Digimedia</b></p>
                             <ul class="list-wrap">
                                 <li>Jl. H. Ungar No.2C, Kota Tanjung Pinang, Kepulauan Riau </li>
                                 <li>+62 8126 6187 125</li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                     <div class="footer__widget">
                         <h4 class="footer__widget-title">PROSKILL</h4>
                         <div class="footer__link">
                             <ul class="list-wrap">
                                 <li><a href="{{ route('tentangkami') }}">Tentang Kami</a></li>
                                 <li><a href="{{ route('hubungikami') }}">Hubungi Kami</a></li>
                                 <li><a href="https://drive.google.com/file/d/1m0-XrXIJyAIMYHWLa7u8isGLIzX0CD0D/view?usp=sharing"
                                         target="_blank">Brosur</a>
                                 </li>
                                 <li><a href="https://drive.google.com/file/d/1A6Ll5hiO6NfKZlhcckAtAGCx5H0kj1TL/view?usp=sharing"
                                         target="_blank">Contoh
                                         Sertifikat</a></li>
                                 <li><a href="{{ route('blog') }}">Artikel</a></li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                     <div class="footer__widget">
                         <h4 class="footer__widget-title">PROGRAM</h4>
                         <div class="footer__link">
                             <ul class="list-wrap">
                                 <li><a href="{{ route('pbi') }}">Bootcamp</a></li>
                                 <li><a href="{{ route('classroom') }}">Kelas Tatap Muka</a></li>
                                 <li><a href="{{ route('course') }}">Kelas Online</a></li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-3 col-lg-4 col-md-6">
                     <div class="footer__widget">
                         <h4 class="footer__widget-title">LAINNYA</h4>
                         <div class="footer__contact-content">
                             <p>Terhubung dengan <br> Sosial Media Kami</p>
                             <ul class="list-wrap footer__social">
                                 <li>
                                     <a href="https://wa.me/6281266187125?text=Halo," target="_blank">
                                         <img src="{{ asset('public/assets/img/icons/whatsapp.svg') }}" alt="img"
                                             class="injectable">
                                     </a>
                                 </li>
                                 <li>
                                     <a href="https://www.instagram.com/proskillakademia?igsh=MTJzdjNteGNrMGVpOA== "
                                         target="_blank">
                                         <img src="{{ asset('public/assets/img/icons/instagram.svg') }}" alt="img"
                                             class="injectable">
                                     </a>
                                 </li>
                                 <li>
                                     <a href="https://www.youtube.com/channel/UCNw50VFi4Rdmv1WpKlWGHUQ" target="_blank">
                                         <img src="{{ asset('public/assets/img/icons/youtube.svg') }}" alt="img"
                                             class="injectable">
                                     </a>
                                 </li>
                             </ul>
                         </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="footer__bottom">
         <div class="container">
             <div class="row align-items-center">
                 <div class="col-md-7">
                     <div class="copy-right-text">
                         <p>©2024 ProSkill Akademia</p>
                     </div>
                 </div>
                 {{-- <div class="col-md-5">
                     <div class="footer__bottom-menu">
                         <ul class="list-wrap">
                             <li><a href="mailto:admin@proskill.sch.id">admin@proskill.sch.id</a></li>
                         </ul>
                     </div>
                 </div> --}}
             </div>
         </div>
     </div>
 </footer>
 <!-- footer-area-end -->
