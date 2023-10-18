<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('integrations/style.css') }}">
    <link rel="stylesheet" href="{{ asset('integrations/portal.css') }}" />
    <link rel="stylesheet" href="{{ asset('integrations/theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('integrations/jobportal.css') }}" />
    <link rel="stylesheet" href="{{ asset('integrations/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('integrations/navbar.css') }}" />
    <link
      rel="stylesheet"
      media="screen"
      href="{{ asset('home-image/assets/vendor/boxicons/css/boxicons.min.css') }}"
    />
    <!-- <link rel="stylesheet" href="tailwind.css"> -->
    <link
      href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500&family=Heebo:wght@400;500&family=Inter:wght@400;500&family=Mukta:wght@400;500&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Roboto+Condensed:ital@1&display=swap"
      rel="stylesheet"
    />

    <style>
      body {
        padding: 0;
        margin: 0;
      }

      .navbar-expand-lg {
        position: relative;
        z-index: 300;
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
        transition: all 0.5s ease-in-out;
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
        transition: all 0.5s ease-in-out;
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
          transition: all 0.5s ease-in-out;
        }

        nav .links a {
          font-size: 20px;
        }

        nav :checked ~ .links {
          bottom: 0;
        }

        nav .icon-burger {
          display: block;
        }

        nav :checked ~ .icon-burger .line:nth-child(1) {
          transform: translateX(0px) rotate(360deg);
        }

        nav :checked ~ .icon-burger .line:nth-child(3) {
          transform: translateX(0px) rotate(360deg);
        }

        nav :checked ~ .icon-burger .line:nth-child(2) {
          /* opacity: 0; */
          transform: translateX(0px) rotate(360deg);
        }
      }
      .new-card{
    width: 92%;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    margin: 15px auto;
}
.sub-card{
    width: 30.33%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 28px 15px ;
    background-color: white;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    padding: 20px;
    background: #fff;
    transition: 0.5s;
}
.sub-card:hover {
    transform: translateY(-10px);
}
.up-card{
    width: 98%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: -10px;
}
.img{
    width: 40%;
    display: flex;
    justify-content: start;
}
.main-img{
    width: 82px;
    margin-top: -30px;
    border-radius: 10px;
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0px 15px 50px rgba(0, 0, 0, 0.1);
}
.main-img img{
    width: 50px;
    margin: 8px auto;
}
.day-time{
width: 60%;
display: flex;
justify-content: end;
align-items: center;
margin-top: 10px;
}
.day-time button{
    background: rgba(72,133,237,0.2);
    border-radius: 4px;
    padding: 4px 10px;
color: #4885ED;
font-size: 12px;
    font-weight: 600;
    border: none;
    font-family: Poppins, sans-serif;
}
.day-time p{
   margin: 10px 10px;
color: #4885ED;
font-size: 12px;
    font-weight: 600;
    font-family: Poppins, sans-serif;
}
.head{
    width: 98%;
    margin-top: 28px;
}
.head h3{
    width: 100%;
    color: #142238;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 5px;
    font-family: Poppins, sans-serif;
}
.head p{
    width: 100%;
    font-size: 13px;
    color:#142238;
    font-family: Poppins, sans-serif;
}
.month-btn{
    width: 98%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 6px;
}
.rupee-m{
    width: 60%;
    display: flex;
    /* align-items: center; */
    justify-content: start;
}
.rupee-m span{
    margin: auto 0;
    font-size: 18px;
    margin-bottom: 0;
    color: #4885ED;
    font-weight: 600;
    font-family: Poppins, sans-serif;
}
.rupee-m p{
    margin: auto 0;
    font-family: Poppins, sans-serif;
    font-weight: 400;
    font-size: 15px;
    color: #142238;
    margin-left: 2px;
}
.after-apply{
    width: 40%;
    display: flex;
    align-items: center;
    justify-content: end;
    font-family: Poppins, sans-serif;
}
.after-apply a button{
    padding: 0;
    width: 38px;
    height: 38px;
    line-height: 38px;
    color: #ffffff;
    background-color: #4885ED;
    border: 1px solid #4885ED;
    font-size: 16px;
    font-weight: 500;
    border-radius: 10px;
}
    </style>
  </head>
  <body>
    <!-- Responsive Header Start  -->
    <nav
      class="header navbar navbar-expand-lg hamburger"
      style="background-color: white; position: sticky; top: 0"
    >
      <input type="checkbox" id="nav-toggle" />
      <a href="jobportal.html" class="navbar-brand pe-3 logo">
        <img
        src="{{ asset('integrations/home-image/sushma-group.png') }}"
          width="120"
          alt="Sushma"
          style="filter: hue-rotate(400deg)"
        />
      </a>
      <ul class="links">
        <li><a href="#home" class="items" onclick="c()">Home</a></li>
        <li><a href="#data-para" class="items" onclick="c()">About</a></li>
        <li><a href="#my-team" class="items" onclick="c()">Team</a></li>
        <li>
          <a href="#sushma-cards" class="items" onclick="c()">Openings</a>
        </li>
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
    <header
      class="header navbar navbar-expand-lg navbar-sticky full-navbar"
      style="
        background-color: white;
        box-shadow: 2px 2px 3px 1px rgb(208, 200, 200);
      "
    >
      <div class="container px-3">
        <a href="{{ url('showcase/v2/sushma/sushma_job_portal') }}" class="navbar-brand pe-3">
          <img
          src="{{ asset('integrations/home-image/sushma-group.png') }}"
            width="150"
            alt="Sushma"
            style="filter: hue-rotate(400deg)"
          />
        </a>
        <div
          id="navbarNav"
          class="offcanvas offcanvas-end"
          style="padding-top: 10px"
        >
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">Menu</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
            ></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle active"
                  data-bs-toggle="dropdown"
                  style="font-size: 1.1rem"
                  >Home
                  <i
                    class="fa-solid fa-chevron-down"
                    style="color: #0f0f10; margin-left: 5px; font-size: 12px"
                  ></i>
                </a>
                <div class="dropdown-menu p-0">
                  <div class="d-lg-flex">
                    <div class="mega-dropdown-column pt-lg-3 pb-lg-4">
                      <ul class="list-unstyled mb-0">
                        <li>
                          <a href="" class="dropdown-item"
                            >Template Intro Page</a
                          >
                        </li>
                        <li>
                          <a
                            href="landing-mobile-app-showcase-v1.html"
                            class="dropdown-item"
                            >Sushma 1</a
                          >
                        </li>
                        <li>
                          <a
                            href="landing-mobile-app-showcase-v2.html"
                            class="dropdown-item"
                            >Sushma 2</a
                          >
                        </li>
                        <li>
                          <a
                            href="landing-product.html"
                            class="dropdown-item d-flex align-items-center"
                            >Sushma 3<span class="badge bg-success ms-2"
                              >New</span
                            ></a
                          >
                        </li>
                        <li>
                          <a
                            href="landing-startup.html"
                            class="dropdown-item d-flex align-items-center"
                            >Sushma 4</a
                          >
                        </li>
                        <li>
                          <a href="landing-saas-v1.html" class="dropdown-item"
                            >Sushma 5</a
                          >
                        </li>
                        <li>
                          <a href="landing-saas-v2.html" class="dropdown-item"
                            >Sushma 6</a
                          >
                        </li>
                        <li>
                          <a href="landing-saas-v3.html" class="dropdown-item"
                            >Sushma 7</a
                          >
                        </li>
                      </ul>
                    </div>
                    <!-- <div class="mega-dropdown-column pt-lg-3 pb-lg-4">
                        <ul class="list-unstyled mb-0">
                          <li><a href="landing-financial.html" class="dropdown-item">Financial Consulting</a></li>
                          <li><a href="landing-online-courses.html" class="dropdown-item">Online Courses</a></li>
                          <li><a href="landing-medical.html" class="dropdown-item">Medical</a></li>
                          <li><a href="landing-software-company.html" class="dropdown-item">IT (Software) Company</a></li>
                          <li><a href="landing-conference.html" class="dropdown-item">Conference</a></li>
                          <li><a href="landing-digital-agency.html" class="dropdown-item">Digital Agency</a></li>
                          <li><a href="landing-blog.html" class="dropdown-item">Blog Homepage</a></li>
                        </ul>
                      </div> -->
                  </div>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  style="font-size: 1.1rem"
                  >About
                  <i
                    class="fa-solid fa-chevron-down"
                    style="color: #0f0f10; margin-left: 5px; font-size: 12px"
                  ></i
                ></a>
                <div class="dropdown-menu">
                  <div class="d-lg-flex pt-lg-3">
                    <div class="mega-dropdown-column">
                      <h6 class="px-3 mb-2">About</h6>
                      <ul class="list-unstyled mb-3">
                        <li>
                          <a href="about-v1.html" class="dropdown-item py-1"
                            >Sushma 1</a
                          >
                        </li>
                        <li>
                          <a href="about-v2.html" class="dropdown-item py-1"
                            >Sushma 2</a
                          >
                        </li>
                      </ul>
                      <h6 class="px-3 mb-2">Blog</h6>
                      <ul class="list-unstyled mb-3">
                        <li>
                          <a
                            href="blog-list-with-sidebar.html"
                            class="dropdown-item py-1"
                            >List View with Sidebar</a
                          >
                        </li>
                        <li>
                          <a
                            href="blog-grid-with-sidebar.html"
                            class="dropdown-item py-1"
                            >Grid View with Sidebar</a
                          >
                        </li>
                      </ul>
                    </div>
                    <div class="mega-dropdown-column">
                      <h6 class="px-3 mb-2">Portfolio</h6>
                      <ul class="list-unstyled mb-3">
                        <li>
                          <a
                            href="portfolio-grid.html"
                            class="dropdown-item py-1"
                            >Grid View</a
                          >
                        </li>
                        <li>
                          <a
                            href="portfolio-list.html"
                            class="dropdown-item py-1"
                            >List View</a
                          >
                        </li>
                      </ul>
                      <h6 class="px-3 mb-2">Services</h6>
                      <ul class="list-unstyled mb-3">
                        <li>
                          <a href="services-v1.html" class="dropdown-item py-1"
                            >Services v.1</a
                          >
                        </li>
                        <li>
                          <a href="services-v2.html" class="dropdown-item py-1"
                            >Services v.2</a
                          >
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  style="font-size: 1.1rem"
                  >Office
                  <i
                    class="fa-solid fa-chevron-down"
                    style="color: #0f0f10; margin-left: 5px; font-size: 12px"
                  ></i
                ></a>
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
                <a href="" class="nav-link" style="font-size: 1.1rem">Team </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link" style="font-size: 1.1rem"
                  >Openings
                </a>
              </li>
            </ul>
          </div>
        </div>

        <a href="{{ url('showcase/v2/sushma/sushma_job_search') }}" style="color: white; text-decoration: none">
          <button
            class="career-btn"
            style="
              background-color: #6366f1;
              color: white;
              width: 120px;
              height: 42px;
              padding-bottom: 3px;
              border: none;
              border-radius: 8px;
              font-size: 1.1rem;
              margin-top: 10px;
            "
          >
            Career
          </button>
        </a>
      </div>
    </header>
    <!-- 650px to 992px  -->
    <header
      class="temporary-header"
      id=""
      style="
        background-color: white;
        box-shadow: 2px 2px 3px 1px rgb(208, 200, 200);
      "
    >
      <div class="temp-header">
        <div class="temp-log">
          <a href="jobportal.html" class="navbar-brand pe-3">
            <img
            src="{{ asset('integrations/home-image/sushma-group.png') }}"
              width="135"
              alt="Sushma"
              style="filter: hue-rotate(400deg)"
            />
          </a>
        </div>

        <div class="item-body">
          <ul class="items-ul">
            <li class="list-t">
              <a href="#" style="font-size: 1.1rem">Home </a>
            </li>
            <li class="list-t">
              <a href="#" style="font-size: 1.1rem">About </a>
            </li>
            <li class="list-t">
              <a href="#" style="font-size: 1.1rem">Office </a>
            </li>

            <li class="list-t">
              <a href="" style="font-size: 1.1rem">Team </a>
            </li>
            <li class="list-t">
              <a href="" style="font-size: 1.1rem">Openings </a>
            </li>
          </ul>
        </div>

        <div class="temp-btn">
          <a href="./index.html" style="color: white; text-decoration: none">
            <button
              class="career-btn"
              style="
                background-color: #6366f1;
                color: white;
                width: 100px;
                height: 37px;
                border: none;
                border-radius: 5px;
                font-size: 0.9rem;
              "
            >
              Career
            </button>
          </a>
        </div>
      </div>
    </header>
    <!-- 650px to 992px  -->
    @yield('content')
    @include('integrations.sushma_footer')
  </body>
</html>
