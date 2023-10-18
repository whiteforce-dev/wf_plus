@extends('integrations.sushma_master')
@section('title','Sushma Group')
@section('content')
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
                <a href="{{ url('showcase/v2/sushma/sushma_home') }}"><i class="fa-solid fa-house" style="color: #ced4de; margin-right: 10px;"></i> Home</a>
              </li>

              <li class="breadcrumb-item active" style="color: #6366f1; font-size: 1rem; font-weight: 600;"><i
                  class="fa-solid fa-forward" style="color: #c5cdda; margin-right: 10px; margin-top: 4px;"><a
                    href="{{ url('showcase/v2/sushma/sushma_home') }}" style="color: #6366f1;"></i> Sushma Group</a></li>
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




  @include('integrations/sushma_job_card')

  <!-- Benifits End  -->

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
@endsection
