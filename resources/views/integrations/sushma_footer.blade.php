<!-- Our Social networks Start  -->
<section class="container text-center py-5 my-2 my-md-4 my-lg-5">
    <h2 class="h1 mb-4">
      We Have <span class="color-fill">Social</span> Networks
    </h2>
    <p class="fs-lg text-muted pb-2 mb-5">
      Follow us and keep up to date with the freshest news!
    </p>
    <div
      class="swiper"
      data-swiper-options='{
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
  }'
    >
      <div
        class="swiper-wrapper"
        style="display: flex; justify-content: center; align-items: center"
      >
        <!-- Item -->
        <div class="swiper-slide">
          <div class="position-relative text-center border-end mx-n1">
            <a
              href="#"
              class="btn btn-icon btn-secondary btn-facebook btn-lg stretched-link"
            >
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
            <a
              href="#"
              class="btn btn-icon btn-secondary btn-instagram btn-lg stretched-link"
            >
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
            <a
              href="#"
              class="btn btn-icon btn-secondary btn-twitter btn-lg stretched-link"
            >
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
            <a
              href="#"
              class="btn btn-icon btn-secondary btn-linkedin btn-lg stretched-link"
            >
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
            <a
              href="#"
              class="btn btn-icon btn-secondary btn-youtube btn-lg stretched-link"
            >
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
          <div
            class="position-relative text-center border-end mx-n1"
            style="border: none !important"
          >
            <a
              href="#"
              class="btn btn-icon btn-secondary btn-dribbble btn-lg stretched-link"
            >
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

  <footer style="width: 100%; margin-top: -90px">
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
