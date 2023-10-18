@extends('integrations.sushma_master')
@section('title','Sushma Group | Job Search')
@section('content')
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
  @include('integrations/sushma_job_card')
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
@endsection
