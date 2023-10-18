<section class="keep-card" style="background-color:rgba(72,133,237,0.1);">
    <div class="head-developer" style="margin-bottom: 30px">
      <h1>Come, join us! We’re hiring.</h1>
      <p>
        We believe that each one of us should be able to find our dream job,
        and we constantly strive hard to make that possible. Apply now!
      </p>
    </div>
    <div class="new-card">
      @foreach($positions as $position)
      <div class="sub-card" style="margin-top: 3%;">
          <div class="up-card">
              <div class="img">
                  <div class="main-img">
                      <img src="{{ asset('integrations/home-image/sushma-small.png') }}" alt="">
                  </div>
              </div>
              <div class="day-time">
                  <p>1 day Ago</p>
                  <button>Full Time</button>
              </div>
          </div>
          <div class="head">
              <h3>{{ ucwords($position->position_name ?? "") }}</h3>
              <p>{{ ucwords($position->clientname ?? "") }} <span>{{ ucwords($position->city ?? "") }}</span></p>
          </div>
          <div class="month-btn">
              <div class="rupee-m">
                  <span>₹ {{ inc_format($position->max_salary?? "") }}</span>
                  <p>/ Year</p>
              </div>
              <div class="after-apply">
                  <a href="{{ url('showcase/v2/sushma/apply-job') }}">
                      <button><i class="fa-solid fa-chevron-right"></i></button>
                  </a>
              </div>
          </div>
      </div>
      @endforeach
  </div>
</section>