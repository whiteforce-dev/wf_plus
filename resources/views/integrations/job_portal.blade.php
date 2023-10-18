<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sushma Group</title>
  <link rel="stylesheet" href="{{ asset('integrations/style.css') }}">
  <link rel="stylesheet" href="{{ asset('integrations/portal.css') }}">
  <link rel="stylesheet" href="{{ asset('integrations/theme.min.css') }}">
  <link rel="stylesheet" href="{{ asset('integrations/jobportal.css') }}">
  <link rel="stylesheet" href="{{ asset('integrations/responsive.css') }}">
  <link rel="stylesheet" href="{{ asset('integrations/navbar.css') }}">
  <link rel="stylesheet" media="screen" href="./home-image/assets/vendor/boxicons/css/boxicons.min.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500&family=Inter:wght@400;500&family=Mukta:wght@400;500&family=Roboto+Condensed:ital@1&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500&family=Heebo:wght@400;500&family=Inter:wght@400;500&family=Mukta:wght@400;500&family=Roboto+Condensed:ital@1&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500&family=Heebo:wght@400;500&family=Inter:wght@400;500&family=Mukta:wght@400;500&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Roboto+Condensed:ital@1&display=swap"
    rel="stylesheet">

  <style>
    body {
      padding: 0;
      margin: 0;
    }

    .navbar-expand-lg {
      /* background-color: #ffffff; */
    }

    nav .logo {
      float: left;
      width: 40%;
      height: 100%;
      display: flex;
      align-items: center;
      font-size: 24px;
      color: #fff;
    }

    nav .links {
      float: right;
      padding: 0;
      margin: 0;
      width: 60%;
      height: 100%;
      max-height: 500px;
      display: flex;
      justify-content: space-around;
      align-items: center;
      transition: all .5s ease-in-out;
    }

    nav .links li {
      list-style: none;
    }

    nav .links a {
      display: block;
      padding: 1em;
      font-size: 15px !important;
      font-weight: bold;
      color: #000000;
      text-decoration: none;
      position: relative;
    }

    nav .links a:hover {
      color: rgb(10, 46, 176);
    }

    nav .links a::before {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background-color: rgb(0, 0, 0);
      visibility: hidden;
      transform: scaleX(0);
      transition: all 0.3s ease-in-out 0s;
    }

    nav .links a:hover::before {
      visibility: visible;
      transform: scaleX(1);
      color: rgb(1, 1, 3);
    }

    #nav-toggle {
      position: absolute;
      top: -100px;
    }

    nav .icon-burger {
      display: none;
      position: absolute;
      right: 5%;
      top: 50%;
      transform: translateY(-50%);
    }

    nav .icon-burger .line {
      width: 25px;
      height: 3px;
      background-color: #000000;
      margin: 3px;
      border-radius: 3px;
      transition: all .5s ease-in-out;
    }

    @media screen and (max-width: 768px) {
      nav .logo {
        float: none;
        width: auto;
        justify-content: center;
      }

      nav .links {
        float: none;
        position: fixed;
        z-index: 9;
        left: 0;
        right: 0;
        top: 63px;
        bottom: 100%;
        width: auto;
        height: auto;
        max-height: 500px;
        flex-direction: column;
        justify-content: space-evenly;
        background: url("{{ asset('home-image/Solid_white.svg.webp') }}");
        background-size: cover;
        /* background-color: rgba(255, 255, 255, 0.8); */
        overflow: hidden;
        transition: all .5s ease-in-out;
      }

      nav .links a {
        font-size: 20px;
      }

      nav :checked~.links {
        bottom: 0;
      }

      nav .icon-burger {
        display: block;
      }

      nav :checked~.icon-burger .line:nth-child(1) {
        transform: translateX(0px) rotate(360deg);
      }

      nav :checked~.icon-burger .line:nth-child(3) {
        transform: translateX(0px) rotate(360deg);
      }

      nav :checked~.icon-burger .line:nth-child(2) {
        /* opacity: 0; */
        transform: translateX(0px) rotate(360deg);
      }
    }
  </style>



  <!--                                                                                                                                                <link rel="stylesheet" href="tailwind.css"> -->

</head>

<body>

  <!-- Responsive Header Start  -->
  <nav class="header navbar navbar-expand-lg hamburger" style="background-color: white; position: sticky; top: 0; z-index: 200;">
    <input type="checkbox" id="nav-toggle">
    <a href="{{ url('/job-portal') }}" class="navbar-brand pe-3 logo">
      <img src="{{ asset('integrations/home-image/sushma-group.png') }}" width="120 !important" alt="Sushma" style=" filter: hue-rotate(400deg)">
    </a>
    <ul class="links">
      <li><a href="#v-home" class="items" onclick="c()">Home</a></li>
      <li><a href="#data-para" class="items" onclick="c()">About</a></li>
      <li><a href="#teamwork" class="items" onclick="c()">Team</a></li>
      <li><a href="#sushma-cards" class="items" onclick="c()">Openings</a></li>
      <li><a href="./index.html" class="items" onclick="c()">Career</a></li>
    </ul>
    <label for="nav-toggle" class="icon-burger" id="a">
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
    </label>
  </nav>


  <label for="nav-toggle" class="icon-burger">
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
  </label>

  <!-- Responsive Header End  -->







  <!-- main header start  -->

  <header class="header navbar navbar-expand-lg  navbar-sticky full-navbar" id="navbar">
    <div class="container px-3">
      <a href="{{ url('/job-portal') }}" class="navbar-brand pe-3">
        <img src="{{ asset('integrations/home-image/sushma-group.png') }}" width="150" alt="Sushma" style=" filter: hue-rotate(400deg)">
      </a>
      <div id="navbarNav" class="offcanvas offcanvas-end" style="padding-top: 10px;">
        <div class="offcanvas-header border-bottom">
          <h5 class="offcanvas-title">Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"
                style="font-size: 1.1rem;">Home <i class="fa-solid fa-chevron-down"
                  style="color: #0f0f10; margin-left: 5px; font-size: 12px;"></i> </a>
              <div class="dropdown-menu p-0">
                <div class="d-lg-flex">

                  <div class="mega-dropdown-column pt-lg-3 pb-lg-4">
                    <ul class="list-unstyled mb-0">
                      <li><a href="" class="dropdown-item">Template Intro Page</a></li>
                      <li><a href="landing-mobile-app-showcase-v1.html" class="dropdown-item">Sushma 1</a></li>
                      <li><a href="landing-mobile-app-showcase-v2.html" class="dropdown-item">Sushma 2</a></li>
                      <li><a href="landing-product.html" class="dropdown-item d-flex align-items-center">Sushma 3<span
                            class="badge bg-success ms-2">New</span></a></li>
                      <li><a href="landing-startup.html" class="dropdown-item d-flex align-items-center">Sushma 4</a>
                      </li>
                      <li><a href="landing-saas-v1.html" class="dropdown-item">Sushma 5</a></li>
                      <li><a href="landing-saas-v2.html" class="dropdown-item">Sushma 6</a></li>
                      <li><a href="landing-saas-v3.html" class="dropdown-item">Sushma 7</a></li>
                    </ul>
                  </div>

                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="font-size: 1.1rem;">About <i
                  class="fa-solid fa-chevron-down" style="color: #0f0f10; margin-left: 5px; font-size: 12px;"></i></a>
              <div class="dropdown-menu">
                <div class="d-lg-flex pt-lg-3">
                  <div class="mega-dropdown-column">
                    <h6 class="px-3 mb-2">About</h6>
                    <ul class="list-unstyled mb-3">
                      <li><a href="about-v1.html" class="dropdown-item py-1">Sushma 1</a></li>
                      <li><a href="about-v2.html" class="dropdown-item py-1">Sushma 2</a></li>
                    </ul>
                    <h6 class="px-3 mb-2">Blog</h6>
                    <ul class="list-unstyled mb-3">
                      <li><a href="blog-list-with-sidebar.html" class="dropdown-item py-1">List View with Sidebar</a>
                      </li>
                      <li><a href="blog-grid-with-sidebar.html" class="dropdown-item py-1">Grid View with Sidebar</a>
                      </li>

                    </ul>
                  </div>
                  <div class="mega-dropdown-column">
                    <h6 class="px-3 mb-2">Portfolio</h6>
                    <ul class="list-unstyled mb-3">
                      <li><a href="portfolio-grid.html" class="dropdown-item py-1">Grid View</a></li>
                      <li><a href="portfolio-list.html" class="dropdown-item py-1">List View</a></li>

                    </ul>
                    <h6 class="px-3 mb-2">Services</h6>
                    <ul class="list-unstyled mb-3">
                      <li><a href="services-v1.html" class="dropdown-item py-1">Services v.1</a></li>
                      <li><a href="services-v2.html" class="dropdown-item py-1">Services v.2</a></li>

                    </ul>
                  </div>

                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="font-size: 1.1rem;">Office
                <i class="fa-solid fa-chevron-down" style="color: #0f0f10; margin-left: 5px; font-size: 12px;"></i></a>
              <ul class="dropdown-menu">
                <li><a href="" class="dropdown-item">Account Details</a></li>
                <li><a href="" class="dropdown-item">Security</a></li>
                <li><a href="" class="dropdown-item">Notifications</a></li>
                <li><a href="" class="dropdown-item">Messages</a></li>
                <li><a href="" class="dropdown-item">Saved Items</a></li>
                <li><a href="" class="dropdown-item">My Collections</a></li>
                <li><a href="" class="dropdown-item">Payment Details</a></li>
                <li><a href="" class="dropdown-item">Sign In</a></li>
                <li><a href="" class="dropdown-item">Sign Up</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link" style="font-size: 1.1rem;">Team </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link" style="font-size: 1.1rem;">Openings </a>
            </li>
          </ul>
        </div>

      </div>
      <a href="./index.html" style="color: white; text-decoration: none;">
        <button class="career-btn"
          style="background-color: #6366f1; color: white; width: 120px; height: 42px; padding-bottom: 3px; border: none; border-radius: 8px; font-size: 1.1rem; margin-top: 10px;">
          Career
        </button>
      </a>
    </div>

  </header>

  <!-- main header end  -->

  <!-- 650px to 992px  -->

  <header class="temporary-header" id="navbar-t">
    <div class="temp-header">
      <div class="temp-log">
        <a href="jobportal.html" class="navbar-brand pe-3">
          <img src="{{ asset('integrations/home-image/sushma-group.png') }}" width="135" alt="Sushma" style=" filter: hue-rotate(400deg)">
        </a>
      </div>

      <div class="item-body">
        <ul class="items-ul">
          <li class="list-t">
            <a href="#" style="font-size: 1.1rem;">Home </a>
          </li>
          <li class="list-t">
            <a href="#" style="font-size: 1.1rem;">About </a>
          </li>
          <li class="list-t">
            <a href="#" style="font-size: 1.1rem;">Office
            </a>
          </li>

          <li class="list-t">
            <a href="" style="font-size: 1.1rem;">Team </a>
          </li>
          <li class="list-t">
            <a href="" style="font-size: 1.1rem;">Openings </a>
          </li>
        </ul>
      </div>

      <div class="temp-btn">
        <a href="./index.html" style="color: white; text-decoration: none;">
          <button class="career-btn"
            style="background-color: #6366f1; color: white; width: 100px; height: 37px; border: none; border-radius: 5px; font-size: 0.9rem;">
            Career
          </button>
        </a>
      </div>

    </div>

  </header>
  <!-- 650px to 992px  -->



  <!-- Hero -->
  <section class="position-relative pt-5 start-box" id="v-home">

    <!-- Background -->
    <div class="position-absolute top-0 start-0 w-100 bg-position-bottom-center bg-size-cover bg-repeat-0"
      style="background-image: url({{ asset('integrations/home-image/team-image/hero-bg.svg') }});">
      <div class="d-lg-none" style="height: 960px;"></div>
      <div class="d-none d-lg-block" style="height: 768px;"></div>
    </div>

    <!-- Content -->
    <div class="container position-relative zindex-5 pt-5 background-img">
      <div class="row">
        <div class="col-lg-6">

          <!-- Breadcrumb -->
          <nav class="pt-md-2 pt-lg-3 pb-4 pb-md-5 mb-xl-4" aria-label="breadcrumb"
            style="margin-top: 170px !important;">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item" style="font-size: 1rem; font-weight: 500;">
                <a href=""><i class="fa-solid fa-house" style="color: #ced4de; margin-right: 10px;"></i> Home</a>
              </li>

              <li class="breadcrumb-item active" style="color: #6366f1; font-size: 1rem; font-weight: 600;"><i
                  class="fa-solid fa-forward" style="color: #c5cdda; margin-right: 10px; margin-top: 4px;"><a
                    href="{{ url('/sushma') }}" style="color: #6366f1;"></i> Sushma Group</a></li>
            </ol>
          </nav>

          <!-- Text -->
          <h1 class="pb-2 pb-md-3">Your dream <span class="color-fill">Job</span> is waiting</h1>
          <p class="fs-xl pb-4 mb-1 mb-md-2 mb-lg-3" style="max-width: 526px;">We innovate to find a better way—for the
            clients who depend on us, the customers who rely on them and
            the communities who count on us all.</p>

          <div class="row row-cols-3 pt-4 pt-md-5 mt-2 mt-xl-4">
            <div class="col">
              <h3 class="h2 mb-2">2,480</h3>
              <p class="mb-0"><strong>Remote</strong> Sales Experts</p>
            </div>
            <div class="col">
              <h3 class="h2 mb-2">760</h3>
              <p class="mb-0"><strong>New Clients</strong> per Month</p>
            </div>
            <div class="col">
              <h3 class="h2 mb-2">1,200</h3>
              <p class="mb-0"><strong>Requests</strong> per Week</p>
            </div>
          </div>
        </div>

        <!-- Images -->
        <div class="col-lg-6 mt-xl-3 pt-5 pt-lg-4" style="margin-top: 120px !important;">
          <div class="row row-cols-2 gx-3 gx-lg-4">
            <div class="col pt-lg-5 mt-lg-1">
              <img src="{{ asset('integrations/home-image/team-image/1653637284.png') }}" style = " width: 325px !important;" class="d-block rounded-3" alt="Image">
              <img src="{{ asset('integrations/home-image/team-image/1654323074.png') }}" style = " width: 325px !important; margin-top: 30px;" class="d-block rounded-3 mb-3 mb-lg-4" alt="Image">
            </div>
            <div class="col">
              <img src="{{ asset('integrations/home-image/team-image/1654323138.png') }}" style = " width: 325px !important;" class="d-block rounded-3 mb-3 mb-lg-4 right-first-img"
                alt="Image">
              <img  style="margin-top: -20px !important; width: 325px !important;" src="{{ asset('integrations/home-image/team-image/1653637516.png') }}" class="d-block rounded-3" alt="Image"
               >
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About Start  -->

  <section class="about" id="data-para">
    <div class="real">
      <div class="heading">
        <h1>Why <span class="color-fill">Sushma <br> Group</span> Real EState Developers?</h1>
      </div>
      <div class="paragraph">
        <p>Sushma Group is a dynamic and rapidly growing Real Estate development Organization.
          Established to offer credibility, transparency and quality to discerning customers, the company
          has grown to become one of the leading developers in Punjab.
          Sushma has deliberately focused on delivering the highest standards of quality and transparency in
          all its activities.
          <br>
          Following a meticulously planned approach supported by stringent quality
          practices
          benchmarked to International standards, Sushma has earned the respect of its customers by delivering
          on time with innovative offerings. Sushma is synonymous with value, assurance, reliability, brilliance in
          architecture & ethics that keep the worth of your investment high by building tomorrow, today.
        </p>
      </div>
    </div>
  </section>
  <!-- About End  -->

  <!-- Benifits Start  -->

  <!-- meet our team start -->

  <section class="container pb-5 mb-2 mb-md-4 mb-lg-5 mt-n2" >
    <div class="d-flex align-items-center justify-content-between pb-4 mb-2">
      <h2 class="h1 mb-0">Our <span class="color-fill">Memories</span> </h2>
      <a href="#" class="btn btn-outline-primary btn-lg">
        <i class="bx bx-images fs-4 lh-1 me-2"></i>
        See all photos
      </a>
    </div>
    <div class="gallery row g-4" data-video="true" data-thumbnails="true">
      <div class="col-md-5">
        <a href="https://www.youtube.com/watch?v=zPo5ZaH6sW8" class="gallery-item video-item is-hovered rounded-3"
          data-sub-html='' target="_blank">
          <img src="{{ asset('integrations/home-image/assets/img/about/gallery/01.jpg') }}" alt="Gallery thumbnail">
          <div class="gallery-item-caption p-4">
            <h4 class="text-light mb-1">sushma-group.in</h4>
            <p class="mb-0">Video by HappyHire</p>
          </div>

        </a>
      </div>
      <div class="col-md-3 col-sm-5">
        <a href="{{ asset('integrations/home-image/assets/img/about/gallery/02.jpg') }}" class="gallery-item rounded-3 mb-4"
          data-sub-html='<h6 class="fs-sm text-light">Program for apprentices</h6>' target="_blank">
          <img src="{{ asset('integrations/home-image/assets/img/about/gallery/02.jpg') }}" alt="Gallery thumbnail">
          <div class="gallery-item-caption fs-sm fw-medium">Program for apprentices</div>
        </a>
        <a href="{{ asset('integrations/home-image/assets/img/about/gallery/03.jpg') }}" class="gallery-item rounded-3"
          data-sub-html='<h6 class="fs-sm text-light">Modern bright offices</h6>' target="_blank">
          <img src="{{ asset('integrations/home-image/assets/img/about/gallery/03.jpg') }}" alt="Gallery thumbnail">
          <div class="gallery-item-caption fs-sm fw-medium">Modern bright offices</div>
        </a>
      </div>
      <div class="col-md-4 col-sm-7">
        <a href="{{ asset('integrations/home-image/assets/img/about/gallery/04.jpg') }}" class="gallery-item rounded-3 mb-4"
          data-sub-html='<h6 class="fs-sm text-light">Friendly professional team</h6>' target="_blank">
          <img src="{{ asset('integrations/home-image/assets/img/about/gallery/04.jpg') }}" alt="Gallery thumbnail">
          <div class="gallery-item-caption fs-sm fw-medium">Friendly professional team</div>
        </a>
        <a href="{{ asset('integrations/home-image/assets/img/about/gallery/05.jpg') }}" class="gallery-item rounded-3"
          data-sub-html='<h6 class="fs-sm text-light">Efficient project management</h6>' target="_blank">
          <img src="{{ asset('integrations/home-image/assets/img/about/gallery/05.jpg') }}" alt="Gallery thumbnail">
          <div class="gallery-item-caption fs-sm fw-medium">Efficient project management</div>
        </a>
      </div>
    </div>
  </section>

  <!-- meet our team end  -->

  <!-- Benifits Start  -->


  <section class="container pt-4 pb-5 py-lg-5">
    <h2 class="h1 text-center pt-1 pt-md-3 pt-lg-4 pb-3 pb-md-4 mb-0 mb-lg-3"
      style="width: 90% !important; margin: 20px auto !important;">What Makes Us
      <span class="color-fill">Unique?</span>

    </h2>
    <!-- <p>Choose any of these and take advantage of them.</p> -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-2 g-lg-3 g-xl-4 pb-md-3 pb-lg-5"
      style=" margin: 10px auto; padding-left: 25px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
      <div class="cols-container-one font-card" style=" width: 100%;">


        <!-- Item -->
        <div class="col area-b" style="margin: 10px 20px;">
          <div class="card h-100 bg-transparent border-0">
            <div class="bg-secondary easy-font rounded-3 w-auto lh-1 p-2 mt-4 ms-4 me-auto"
              style=" text-align: center;">
              <i class="fa-solid fa-kit-medical" style="color: #8B5CF6;font-size: 2.5rem;"></i>
            </div>
            <div class="card-body">
              <h3 class="h6">Health Insurance</h3>
              <p class="fs-sm mb-0" style="font-weight: 500; width: 90%;">Choose from a
                variety of medical, vision and dental plans for you and your loved ones.
              </p>
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="col area-b" style="margin: 10px 20px;">
          <div class="card h-100 bg-transparent border-0">
            <div class="bg-secondary easy-font rounded-3 w-auto lh-1 p-2 mt-4 ms-4 me-auto"
              style=" text-align: center;">
              <i class="fa-solid fa-clock" style="color: #8B5CF6;font-size: 2.5rem;"></i>
            </div>
            <div class="card-body">

              <h3 class="h6">Flexible Working Hours</h3>
              <p class="fs-sm mb-0" style="font-weight: 500; width: 95%;">We're strictly
                lenient about your working hours. We trust you to know how to maximize
                your productivity.</p>
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="col area-b" style="margin: 10px 20px;">
          <div class="card h-100 bg-transparent border-0">
            <div class="bg-secondary easy-font rounded-3 w-auto lh-1 p-2 mt-4 ms-4 me-auto"
              style=" text-align: center;">
              <i class="fa-solid fa-sack-dollar" style="color: #8B5CF6;font-size: 2.5rem;"></i>
            </div>
            <div class="card-body">

              <h3 class="h6">ESOPs or Equity</h3>
              <p class="fs-sm mb-0" style="font-weight: 500; width: 90%;">We believe in
                making our employees a part of our company,Meaningful stocks and equity for
                you share.</p>
            </div>
          </div>
        </div>

        <!-- Item -->
      </div>

      <div class="cols-container-one font-card" style="width: 100%;">
        <!-- Item -->
        <div class="col area-b" style="margin: 10px 20px;">
          <div class="card h-100 bg-transparent border-0">
            <div class="bg-secondary easy-font rounded-3 w-auto lh-1 p-2 mt-4 ms-4 me-auto"
              style=" text-align: center;">
              <i class="fa-solid fa-money-bill-trend-up" style="color: #8B5CF6;font-size: 2.5rem;"></i>
            </div>
            <div class="card-body">

              <h3 class="h6">Performance Bonus</h3>
              <p class="fs-sm mb-0" style="font-weight: 500; width: 90%;">We acknowledge
                your hard work. We make sure our team is well compensated and shares
                success.</p>
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="col area-b" style="margin: 10px 20px;">
          <div class="card h-100 bg-transparent border-0">
            <div class="bg-secondary easy-font rounded-3 w-auto lh-1 p-2 mt-4 ms-4 me-auto"
              style=" text-align: center;">
              <i class="fa-solid fa-location-dot" style="color: #8B5CF6;font-size: 2.5rem;"></i>
            </div>
            <div class="card-body">
              <h3 class="h6">Recreational Area</h3>
              <p class="fs-sm mb-0" style="font-weight: 500; width: 90%;">Recharge
                yourself, think creatively and give their best with our fun-filled recreational
                area.</p>
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="col area-b" style="margin: 10px 20px;">
          <div class="card h-100 bg-transparent border-0">
            <div class="bg-secondary easy-font rounded-3 w-auto lh-1 p-2 mt-4 ms-4 me-auto"
              style=" text-align: center;">
              <i class="fa-solid fa-dumbbell" style="color: #8B5CF6;font-size: 2.5rem;"></i>
            </div>
            <div class="card-body">
              <h3 class="h6">On site Gym</h3>
              <p class="fs-sm mb-0" style="font-weight: 500; width: 90%;">We believe in
                the importance of staying active. Stay fit with our fully equipped on-site
                gym facility!</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Item -->

    </div>
  </section>

  <!-- our team start  -->

  <section class="team" id="my-team">
    <div class="our-team">
      <div class="our-box-one">
        <h1>
          Meet Our Exclusive <span class="color-fill">Leadership</span> Team
        </h1>
      </div>
      <div class="our-box-two">
        <div class="team-member">
          <div class="profile-one">
            <img
              src= "{{ asset('integrations/home-image/team-image/Team Leader/1653636729.png') }}"
              alt=""
            />
            <img
              src= "{{ asset('integrations/home-image/team-image/Team Leader/play icon/play.svg') }}"
              alt=""
              class="play-btn mittal"
            />
          </div>
          <div class="profile-two">
            <h2>Mr. Binder Pal Mittal</h2>
            <p>Chairman - Great Leadership Ability</p>
          </div>
        </div>
        <div class="team-member">
          <div class="profile-one">
            <img
              src= "{{ asset('integrations/home-image/team-image/Team Leader/1653636880.png') }}"
              alt=""
            />
            <img
              src= "{{ asset('integrations/home-image/team-image/Team Leader/play icon/play.svg') }}"
              alt=""
              class="play-btn"
            />
          </div>
          <div class="profile-two">
            <h2>Mr. Prateek Bhatiya</h2>
            <p>AVP - Great Leadership Ability</p>
          </div>
        </div>
        <div class="team-member">
          <div class="profile-one">
            <img
              src= "{{ asset('integrations/home-image/team-image/Team Leader/1685020994.png') }}"
              alt=""
            />
            <img
              src= "{{ asset('integrations/home-image/team-image/Team Leader/play icon/play.svg') }}"
              alt=""
              class="play-btn"
            />
          </div>
          <div class="profile-two">
            <h2>Sujith Balan</h2>
            <p>Vice President – Lifesciences</p>
          </div>
        </div>
      </div>
      <div class="our-box-three">
        <button><i class="bx bx-images fs-4 lh-1 me-2"></i> See more</button>
      </div>
    </div>
  </section>

  <!-- Our team end  -->




   <section class="keep-card">
      <div class="head-developer" style="margin-bottom: 30px">
        <h1>Come, join us! We’re hiring.</h1>
        <p>
          We believe that each one of us should be able to find our dream job,
          and we constantly strive hard to make that possible. Apply now!
        </p>
      </div>

      <div class="container-card">
        @foreach($positions as $position)
        <div class="box-card">
          <div class="top-box">
            <div class="left-top">
              <img src=" {{ asset('integrations/home-image/sushma-small.png') }}" alt="" />
              <div class="card-name-first">
                <p>Sushma</p>
                <span>
                  <i class="fa-solid fa-location-dot"></i> {{ ucwords($position->city ?? "") }}
                </span>
              </div>
            </div>
          </div>
          <div class="mid-box">
            <h2>{{ ucwords($position->position_name ?? "") }}</h2>

            <div class="right-top">
              <span><i class="fa-solid fa-briefcase"></i>Full-Time</span>
              <p>
                <i class="fa-solid fa-location-dot"></i> {{ $position->created_at->format('M  y,d') ?? "" }}
              </p>
            </div>
          </div>
          <div class="w-full">
            <p>
                A Java developer’s general duties and responsibilities include producing Java code for applications, comprehending what users want from the finished product.
            </p>
          </div>
          <div class="apps">
            @php
            $array=explode(",",$position->skill_set);
            @endphp
            @if(!empty($array))
            @if(count($array)>3)
            @for($i=0;$i<=2;$i++) <span class="grey-small ">
                {{ ucwords($array[$i]) }},</span>
                @endfor
                @else
                @for($i=0;$i<count($array);$i++) <span
                    class="grey-small ">
                    {{ ucwords($array[$i]) }},</span>
                    @endfor
                    @endif
                    @endif

          </div>

          <div class="applied">
            <div class="amount">
              <span class="price">₹{{ inc_format($position->max_salary?? "") }}</span><span class="muted">/Year</span>
            </div>
            <div class="app-bttn">
              <a>
                <button>Apply Now</button>
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </section>









  <!-- Benifits End  -->
  <!-- Our Social networks Start  -->
  <section class="container text-center py-5 my-2 my-md-4 my-lg-5">
    <h2 class="h1 mb-4">We Have <span class="color-fill">Social</span> Networks</h2>
    <p class="fs-lg text-muted pb-2 mb-5">Follow us and keep up to date with the freshest news!</p>
    <div class="swiper" data-swiper-options='{
      "slidesPerView": 2,
      "pagination": {
        "el": ".swiper-pagination",
        "clickable": true
      },
      "breakpoints": {
        "500": {
          "slidesPerView": 3
        },
        "650": {
          "slidesPerView": 4
        },
        "900": {
          "slidesPerView": 5
        },
        "1100": {
          "slidesPerView": 6
        }
      }
    }'>
      <div class="swiper-wrapper" style=" display: flex; justify-content: center; align-items: center;">

        <!-- Item -->
        <div class="swiper-slide">
          <div class="position-relative text-center border-end mx-n1">
            <a href="#" class="btn btn-icon btn-secondary btn-facebook btn-lg stretched-link">
              <i class="fa-brands fa-facebook-f"></i>
            </a>
            <div class="pt-4">
              <h6 class="mb-1">Facebook</h6>
              <!-- <p class="fs-sm text-muted mb-0">Sushma</p> -->
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="swiper-slide">
          <div class="position-relative text-center border-end mx-n1">
            <a href="#" class="btn btn-icon btn-secondary btn-instagram btn-lg stretched-link">
              <i class="fa-brands fa-instagram"></i>
            </a>
            <div class="pt-4">
              <h6 class="mb-1">Instagram</h6>
              <!-- <p class="fs-sm text-muted mb-0">@ Sushma</p> -->
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="swiper-slide">
          <div class="position-relative text-center border-end mx-n1">
            <a href="#" class="btn btn-icon btn-secondary btn-twitter btn-lg stretched-link">
              <i class="fa-brands fa-twitter"></i>
            </a>
            <div class="pt-4">
              <h6 class="mb-1">Twitter</h6>
              <!-- <p class="fs-sm text-muted mb-0">Sushma</p> -->
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="swiper-slide">
          <div class="position-relative text-center border-end mx-n1">
            <a href="#" class="btn btn-icon btn-secondary btn-linkedin btn-lg stretched-link">
              <i class="fa-brands fa-linkedin-in"></i>
            </a>
            <div class="pt-4">
              <h6 class="mb-1">LinkedIn</h6>
              <!-- <p class="fs-sm text-muted mb-0">Sushma</p> -->
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="swiper-slide">
          <div class="position-relative text-center border-end mx-n1">
            <a href="#" class="btn btn-icon btn-secondary btn-youtube btn-lg stretched-link">
              <i class="fa-brands fa-youtube"></i>
            </a>
            <div class="pt-4">
              <h6 class="mb-1">YouTube</h6>
              <!-- <p class="fs-sm text-muted mb-0">Sushma</p> -->
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="swiper-slide">
          <div class="position-relative text-center border-end mx-n1" style="border: none !important;">
            <a href="#" class="btn btn-icon btn-secondary btn-dribbble btn-lg stretched-link">
              <i class="fa-brands fa-dribbble"></i>
            </a>
            <div class="pt-4">
              <h6 class="mb-1">Dribbble</h6>
              <!-- <p class="fs-sm text-muted mb-0">Sushma</p> -->
            </div>
          </div>
        </div>
      </div>

      <!-- Pagination (bullets) -->
      <!-- <div class="swiper-pagination position-relative bottom-0 pt-3 mt-4"></div> -->
    </div>
  </section>

  <!-- Our Social networks End  -->

  <footer style="width: 100%;margin-top: -90px;">
    <div style="width: 90%;  display:flex; justify-content: center; align-items: center;">
      <div class="footer-logo"
        style="width: 20%; display: flex;  margin-left: 35px !important; align-items: start; justify-content: end; margin-top:0 ;">
        <img src="{{ asset('integrations/home-image/happy-logo.png') }}" alt="Sushma" alt="Sushma"
          style=" width:125px; filter: hue-rotate(400deg);">
      </div>
      <div class="f-para"
        style="width: 60%; display: flex; align-items: center; justify-content: center; margin-top: 32px; font-weight: 600;">
        <p class="footer-para" style=" color: #565973;">All &copy; reserved 2023 - Powered by HappyHire</p>
      </div>
      <div class="right-img" style="width: 20%; display: flex; align-items: center; justify-content: center;">
        <img src="{{ asset('integrations/home-image/background/shape3.png') }}" alt="" class="shape-pic"
          style="transform: rotate(200deg) !important;">
      </div>
    </div>
  </footer>

  <script>

    burger = document.getElementById(`a`)
    burger.addEventListener(`click`, () => {


    })
    function c() {
      burger.click();
    }

  </script>

  <script src="https://kit.fontawesome.com/95a02bd20d.js"></script>

  <script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>
  <script src="{{ asset('integrations/jobportal.js') }}"></script>
</body>

</html>
