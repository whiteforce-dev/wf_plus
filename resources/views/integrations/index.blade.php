<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jobs | Happiest Resume</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('integrations/jobportal.css') }}" />
    <link rel="stylesheet" href="{{ asset('integrations/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('integrations/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('integrations/navbar.css') }}" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <!-- Bootstrap Icon CDN -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
    />
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
      .item-body {
        display: flex !important;
        align-items: end !important;
        margin-top: 10px;
      }
      .items-ul {
        display: flex !important;
        align-items: end !important;
      }
      .list-t {
        margin: 0px 42px;
      }
      .list-t a {
        font-size: 1.1rem !important;
      }
    </style>
  </head>
  <body>
    <nav
      class="header navbar navbar-expand-lg hamburger"
      style="
        background-color: white;
        position: relative;
        z-index: 200;
        position: sticky;
        top: 0;
      "
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
        <li><a href="#work" class="items" onclick="c()">Work</a></li>
        <li><a href="#projects" class="items" onclick="c()">Projects</a></li>
        <li><a href="#contact" class="items" onclick="c()">Contact</a></li>
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

    <!-- 650px to 992px  -->

    <header
      class="temporary-header"
      id="navbar-t"
      style="background-color: white"
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

        <div class="item-body" style="margin: 0 auto; width: 60%">
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
                width: 129px !important;
                height: 40px;
                border: none;
                border-radius: 5px;
                font-size: 1.1rem;
              "
            >
              Career
            </button>
          </a>
        </div>
      </div>
    </header>
    <!-- 650px to 992px  -->

    <header class="full-navbar" id="navbar" style="height: 70px">
      <div class="temp-header free-header" style="margin: 0 auto; width: 90%">
        <div class="temp-log" style="width: 12%">
          <a href="jobportal.html" class="navbar-brand pe-3">
            <img
              src="{{ asset('integrations/home-image/sushma-group.png') }}"
              width=""
              alt="Sushma"
              style="margin-top: 5px; filter: hue-rotate(400deg)"
            />
          </a>
        </div>

        <div class="item-body" style="width: 60%">
          <ul class="items-ul" style="margin-top: 10px">
            <li class="list-t team-i">
              <a href="#" style="font-size: 1.05rem">Home </a>
            </li>
            <li class="list-t team-i">
              <a href="#" style="font-size: 1.05rem">About </a>
            </li>
            <li class="list-t team-i">
              <a href="#" style="font-size: 1.05rem">Office </a>
            </li>

            <li class="list-t team-i">
              <a href="" style="font-size: 1.05rem">Team </a>
            </li>
            <li class="list-t team-i">
              <a href="" style="font-size: 1.05rem">Openings </a>
            </li>
          </ul>
        </div>

        <div
          class="temp-btn back-btn"
          style="margin-top: 10px; display: flex; justify-content: end"
        >
          <a href="./index.html" style="color: white; text-decoration: none">
            <button
              class="career-btn"
              style="
                background-color: #6366f1;
                color: white;
                width: 125px;
                height: 40px;
                border: none;
                border-radius: 5px;
                font-size: 1.15rem;
                padding-bottom: 8px;
              "
            >
              Back
            </button>
          </a>
        </div>
      </div>
    </header>

    <main class="h-80v mainContainer">
      <span class="main-overlay"></span>
      <div class="container maxWidth" style="margin-top: 90px">
        <div class="tagline">
          <h3 style="margin-bottom: 5px">
            Hire Talents in any field, any time
          </h3>
          <p>Thousand of Recruiters use Sushma-Group for hiring.</p>
        </div>
        <div class="search">
          <div class="inputs input-one">
            <label for="loc">Where ?</label>
            <div class="input d-flex">
              <i class="bi bi-geo-alt"></i>
              <input type="text" placeholder="Online Jobs" />
            </div>
          </div>
          <div class="inputs input-two">
            <label for="loc">What do you want ?</label>
            <div class="input d-flex">
              <i class="bi bi-briefcase"></i
              ><input type="text" placeholder="Job Title" />
            </div>
          </div>
          <div class="inputs input-three">
            <label for="loc" style="visibility: hidden">df</label>
            <div class="input">
              <button>Search</button>
            </div>
          </div>
        </div>
      </div>
    </main>

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

    <script>
      burger = document.getElementById(`a`);
      burger.addEventListener(`click`, () => {});
      function c() {
        burger.click();
      }
    </script>

    <script src="{{ asset('integrations/jobportal.js') }}"></script>
    <script src="{{ asset('integrations/index.js') }}"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://kit.fontawesome.com/66f2518709.js"
      crossorigin="anonymous"
    ></script>
    <footer style="width: 100%; margin-top: 20px" class="online-footer">
      <div
        style="
          width: 90%;
          display: flex;
          justify-content: center;
          align-items: center;
        "
      >
        <div
          class="footer-logo"
          style="
            width: 20%;
            display: flex;
            margin-left: 35px !important;
            align-items: start;
            justify-content: end;
            margin-top: 0;
          "
        >
          <img
            class="online-logo"
            src="{{ asset('integrations/home-image/happy-logo.png') }}"
            alt="Sushma"
            alt="Sushma"
            style="width: 125px; filter: hue-rotate(400deg)"
          />
        </div>
        <div
          class="f-para"
          style="
            width: 60%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 32px;
            font-weight: 600;
          "
        >
          <p class="footer-para" style="color: #565973">
            All &copy; reserved 2023 - Powered by HappyHire
          </p>
        </div>
        <div
          class="right-img"
          style="
            width: 20%;
            display: flex;
            align-items: center;
            justify-content: center;
          "
        >
          <img
            src="{{ asset('integrations/home-image/background/shape3.png') }}"
            alt=""
            class="shape-pic"
            style="transform: rotate(200deg) !important"
          />
        </div>
      </div>
    </footer>
  </body>
</html>
