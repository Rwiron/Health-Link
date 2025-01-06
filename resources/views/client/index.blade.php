<!DOCTYPE html>
<html lang="en">

<head>

    <title>Health - Medical Website Template</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Tooplate">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ ('asseting/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ ('asseting/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('asseting/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('asseting/css/owl.carousel.css') }}">

    <link rel="stylesheet" href="{{ asset('asseting/css/owl.theme.default.min.css') }}">


    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('asseting/css/tooplate-style.css')}}">


</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

    <!-- PRE LOADER -->
    <section class="preloader">
        <div class="spinner">

            <span class="spinner-rotate"></span>

        </div>
    </section>


    <!-- HEADER -->
    <header>
        <div class="container">
            <div class="row">

                <div class="col-md-4 col-sm-5">
                    <p>Welcome to a Professional Health Care</p>
                </div>

                <div class="col-md-8 col-sm-7 text-align-right">
                    <span class="phone-icon"><i class="fa fa-phone"></i> 0780961542</span>
                    <span class="date-icon"><i class="fa fa-calendar-plus-o"></i> 6:00 AM - 10:00 PM
                        (Mon-Fri)</span>
                    <span class="email-icon"><i class="fa fa-envelope-o"></i> <a href="#">healthlink@company.com</a></span>
                </div>

            </div>
        </div>
    </header>


    <!-- MENU -->
    <section class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>

                <!-- lOGO TEXT HERE -->
                <a href="index.html" class="navbar-brand"><i class="fa fa-h-square"></i>ealth Link</a>
            </div>

            <!-- MENU LINKS -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#top" class="smoothScroll">Home</a></li>
                    <li><a href="#about" class="smoothScroll">About Us</a></li>
                    <li><a href="#team" class="smoothScroll">Doctors</a></li>
                    <li><a href="#news" class="smoothScroll">News</a></li>
                    <li><a href="#google-map" class="smoothScroll">Contact</a></li>
                    <li class="appointment-btn"><a href="{{ route('login') }}">Make an appointment</a></li>
                </ul>
            </div>

        </div>
    </section>


    <!-- HOME -->
    <section id="home" class="slider" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">

                <div class="owl-carousel owl-theme">
                    <div class="item item-first">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">
                                <h3>Connecting You to Quality Healthcare Services</h3>
                                <h1>Your Health, Our Mission</h1>
                                <a href="#team" class="section-btn btn btn-default smoothScroll">Discover Our
                                    Services</a>
                            </div>
                        </div>
                    </div>

                    <div class="item item-second">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">
                                <h3>Access Healthcare Anytime, Anywhere</h3>
                                <h1>Empowering Health Choices</h1>
                                <a href="#about" class="section-btn btn btn-default btn-gray smoothScroll">Learn
                                    More About Us</a>
                            </div>
                        </div>
                    </div>

                    <div class="item item-third">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">
                                <h3>Reliable Health Information at Your Fingertips</h3>
                                <h1>Stay Informed, Stay Healthy</h1>
                                <a href="#news" class="section-btn btn btn-default btn-blue smoothScroll">Get
                                    Health Updates</a>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>


    <!-- ABOUT -->
    <section id="about">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-6">
                    <div class="about-info">
                        <h2 class="wow fadeInUp" data-wow-delay="0.6s">Welcome to Health Link</h2>
                        <div class="wow fadeInUp" data-wow-delay="0.8s">
                            <p>Health Link is dedicated to connecting individuals to quality healthcare services
                                in Rwanda. Our mission is to ensure accessible, reliable, and affordable health
                                solutions for everyone.</p>
                            <p>We work with trusted healthcare providers to bring you the best care possible,
                                empowering healthier communities across the nation.</p>
                        </div>
                        <figure class="profile wow fadeInUp" data-wow-delay="1s">
                            <img src="images/author-image.jpg" class="img-responsive" alt="Health Link Team">
                            <figcaption>
                                <h3>Health Link Team</h3>
                                <p>Your Trusted Healthcare Partner</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- TEAM -->
    <section id="team" data-stellar-background-ratio="1">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-6">
                    <div class="about-info">
                        <h2 class="wow fadeInUp" data-wow-delay="0.1s">Our Doctors</h2>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-md-4 col-sm-6">
                    <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                        <img src="images/team-image1.jpg" class="img-responsive" alt="">

                        <div class="team-info">
                            <h3>Nate Baston</h3>
                            <p>General Principal</p>
                            <div class="team-contact-info">
                                <p><i class="fa fa-phone"></i> 010-020-0120</p>
                                <p><i class="fa fa-envelope-o"></i> <a href="#">general@company.com</a></p>
                            </div>
                            <ul class="social-icon">
                                <li><a href="#" class="fa fa-linkedin-square"></a></li>
                                <li><a href="#" class="fa fa-envelope-o"></a></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="team-thumb wow fadeInUp" data-wow-delay="0.4s">
                        <img src="images/team-image2.jpg" class="img-responsive" alt="">

                        <div class="team-info">
                            <h3>Jason Stewart</h3>
                            <p>Pregnancy</p>
                            <div class="team-contact-info">
                                <p><i class="fa fa-phone"></i> 010-070-0170</p>
                                <p><i class="fa fa-envelope-o"></i> <a href="#">pregnancy@company.com</a></p>
                            </div>
                            <ul class="social-icon">
                                <li><a href="#" class="fa fa-facebook-square"></a></li>
                                <li><a href="#" class="fa fa-envelope-o"></a></li>
                                <li><a href="#" class="fa fa-flickr"></a></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="team-thumb wow fadeInUp" data-wow-delay="0.6s">
                        <img src="images/team-image3.jpg" class="img-responsive" alt="">

                        <div class="team-info">
                            <h3>Miasha Nakahara</h3>
                            <p>Cardiology</p>
                            <div class="team-contact-info">
                                <p><i class="fa fa-phone"></i> 010-040-0140</p>
                                <p><i class="fa fa-envelope-o"></i> <a href="#">cardio@company.com</a></p>
                            </div>
                            <ul class="social-icon">
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-envelope-o"></a></li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- NEWS -->
    <section id="news" data-stellar-background-ratio="2.5">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-12">
                    <!-- SECTION TITLE -->
                    <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                        <h2>Health Updates</h2>
                        <p>Stay informed with the latest updates and health tips from Health Link.</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <!-- NEWS THUMB -->
                    <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                        <a href="news-detail.html">
                            <img src="{{ asset('asseting/images/news-image1.jpg') }}" class="img-responsive" alt="Health Awareness">

                        </a>
                        <div class="news-info">
                            <span>January 10, 2025</span>
                            <h3><a href="news-detail.html">Health Awareness Campaigns</a></h3>
                            <p>Join our community campaigns to learn more about preventive healthcare and
                                wellness.</p>
                            <div class="author">
                                <img src="{{ asset('asseting/images/author-image.jpg') }}" class="img-responsive" alt="Author">

                                <div class="author-info">
                                    <h5>Health Link Team</h5>
                                    <p>Healthcare Experts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <!-- NEWS THUMB -->
                    <div class="news-thumb wow fadeInUp" data-wow-delay="0.6s">
                        <a href="news-detail.html">
                            <img src="{{ asset('asseting/images/news-image2.jpg') }}" class="img-responsive" alt="Vaccination Drive">

                        </a>
                        <div class="news-info">
                            <span>February 5, 2025</span>
                            <h3><a href="news-detail.html">Upcoming Vaccination Drives</a></h3>
                            <p>Find the nearest vaccination center and schedule appointments for your family.</p>
                            <div class="author">
                                <img src="{{ asset('asseting/images/author-image.jpg') }}" class="img-responsive" alt="Author">

                                <div class="author-info">
                                    <h5>Health Link Team</h5>
                                    <p>Healthcare Experts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <!-- NEWS THUMB -->
                    <div class="news-thumb wow fadeInUp" data-wow-delay="0.8s">
                        <a href="news-detail.html">
                            <img src="{{ asset('asseting/images/news-image3.jpg') }}" class="img-responsive" alt="Mental Health Awareness">


                        </a>
                        <div class="news-info">
                            <span>March 15, 2025</span>
                            <h3><a href="news-detail.html">Mental Health Matters</a></h3>
                            <p>Learn tips to improve mental well-being and find resources for support.</p>
                            <div class="author">
                                <img src="{{ asset('asseting/images/author-image.jpg') }}" class="img-responsive" alt="Author">

                                <div class="author-info">
                                    <h5>Health Link Team</h5>
                                    <p>Healthcare Experts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>




    <!-- GOOGLE MAP -->
    <section id="google-map">
        <!-- How to change your own map point
            1. Go to Google Maps
            2. Click on your location point
            3. Click "Share" and choose "Embed map" tab
            4. Copy only URL and paste it within the src="" field below
	-->
        <iframe src="
               https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5571.132336000296!2d30.055539126267774!3d-1.9366847866855565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca41bca4f5493%3A0xaa150e02f97b4aad!2sMuhima%20Hospital%2C%20KN%2013%20St%2C%20Kigali!5e1!3m2!1sen!2srw!4v1736173783650!5m2!1sen!2srw" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>


    <!-- FOOTER -->
    <footer data-stellar-background-ratio="5">
        <div class="container">
            <div class="row">

                <div class="col-md-4 col-sm-4">
                    <div class="footer-thumb">
                        <h4 class="wow fadeInUp" data-wow-delay="0.4s">Contact Info</h4>
                        <p>Health Link is here to provide you with quality healthcare services and support.</p>

                        <div class="contact-info">
                            <p><i class="fa fa-phone"></i> +250-788-123456</p>
                            <p><i class="fa fa-envelope-o"></i> <a href="mailto:info@healthlink.rw">info@healthlink.rw</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="footer-thumb">
                        <h4 class="wow fadeInUp" data-wow-delay="0.4s">Latest Updates</h4>
                        <div class="latest-stories">
                            <div class="stories-image">
                                <a href="#"><img src="{{ asset('asseting/images/news-image1.jpg') }}" class="img-responsive" alt="Health Awareness"></a>

                            </div>
                            <div class="stories-info">
                                <a href="#">
                                    <h5>Health Awareness Campaigns</h5>
                                </a>
                                <span>January 10, 2025</span>
                            </div>
                        </div>

                        <div class="latest-stories">
                            <div class="stories-image">
                                <a href="#"><img src="{{ asset('asseting/images/news-image2.jpg') }}" class="img-responsive" alt="Vaccination Drive"></a>

                            </div>
                            <div class="stories-info">
                                <a href="#">
                                    <h5>Upcoming Vaccination Drives</h5>
                                </a>
                                <span>February 5, 2025</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="footer-thumb">
                        <div class="opening-hours">
                            <h4 class="wow fadeInUp" data-wow-delay="0.4s">Opening Hours</h4>
                            <p>Monday - Friday <span>08:00 AM - 06:00 PM</span></p>
                            <p>Saturday <span>09:00 AM - 02:00 PM</span></p>
                            <p>Sunday <span>Closed</span></p>
                        </div>

                        <ul class="social-icon">
                            <li><a href="#" class="fa fa-facebook-square"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-instagram"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 border-top">
                    <div class="col-md-4 col-sm-6">
                        <div class="copyright-text">
                            <p>Copyright &copy; 2025 Health Link | All Rights Reserved</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="footer-link">
                            <a href="#">Services</a>
                            <a href="#">Our Team</a>
                            <a href="#">FAQs</a>
                            <a href="#">Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 text-align-center">
                        <div class="angle-up-btn">
                            <a href="#top" class="smoothScroll wow fadeInUp" data-wow-delay="1.2s"><i class="fa fa-angle-up"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="{{ asset('asseting/js/jquery.js') }}"></script>

    <script src="{{ asset('asseting/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('asseting/js/jquery.sticky.js') }}"></script>

    <script src="{{ asset('asseting/js/jquery.stellar.min.js') }}"></script>

    <script src="{{ asset('asseting/js/wow.min.js') }}"></script>

    <script src="{{ asset('asseting/js/smoothscroll.js') }}"></script>

    <script src="{{ asset('asseting/js/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('asseting/js/custom.js') }}"></script>


</body>

</html>
