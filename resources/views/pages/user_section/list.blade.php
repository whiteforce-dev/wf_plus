@extends('master.master')
@section('title', 'Team Section')
@section('content')
<style>
    ul.b {
        list-style-type: square !important;
    }

    .project-info {
        background: #f7f7f7;
        border: 1px dashed #eb8153;
    }


    .treeview .btn-default {
        border-color: #e3e5ef;
    }

    .treeview .btn-default:hover {
        background-color: #f7faea;
        color: #bada55;
    }

    .treeview ul {
        list-style: none;
        padding-left: 32px;
    }

    .treeview ul li {
        padding: 50px 0px 0px 35px;
        position: relative;
    }

    .treeview ul li:before {
        content: "";
        position: absolute;
        top: -26px;
        left: -31px;
        border-left: 2px dashed #a2a5b5;
        width: 1px;
        height: 100%;
    }

    .treeview ul li:after {
        content: "";
        position: absolute;
        border-top: 2px dashed #a2a5b5;
        top: 70px;
        left: -30px;
        width: 65px;
    }

    .treeview ul li:last-child:before {
        top: -22px;
        height: 90px;
    }

    .treeview>ul>li:after,
    .treeview>ul>li:last-child:before {
        content: unset;
    }

    .treeview>ul>li:before {
        top: 90px;
        left: 36px;
    }

    .treeview>ul>li:not(:last-child)>ul>li:before {
        content: unset;
    }

    .treeview>ul>li>.treeview__level:before {
        height: 60px;
        width: 60px;
        top: -9.5px;
        background-color: #54a6d9;
        border: 7.5px solid #d5e9f6;
        font-size: 22px;

    }

    .treeview>ul>li>ul {
        padding-left: 34px;
    }

    .treeview__level {
        padding: 7px;
        padding-left: 42.5px;
        display: inline-block;
        border-radius: 5px;
        font-weight: 700;
        border: 1px solid #e3e5ef;
        position: relative;
        z-index: 1;
    }

    .treeview__level:before {
        content: '';
        position: absolute;
        left: -27.5px;
        top: -6.5px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 55px;
        width: 55px;
        border-radius: 50%;
        border: 7.5px solid #eef6d5;
        /* background-color: #bada55; */
        background: var(--img);
        color: #fff;
        font-size: 20px;
        background-size: cover;
    }

    .treeview__level-btns {
        margin-left: 15px;
        display: inline-block;
        position: relative;
    }

    .treeview__level .level-same,
    .treeview__level .level-sub {
        position: absolute;
        display: none;
        transition: opacity 250ms cubic-bezier(0.7, 0, 0.3, 1);
    }

    .treeview__level .level-same.in,
    .treeview__level .level-sub.in {
        display: block;
    }

    .treeview__level .level-same.in .btn-default,
    .treeview__level .level-sub.in .btn-default {
        background-color: #faeaea;
        color: #da5555;
    }

    .treeview__level .level-same {
        top: 0;
        left: 45px;
    }

    .treeview__level .level-sub {
        top: 42px;
        left: 0px;
    }

    .treeview__level .level-remove {
        display: none;
    }

    .treeview__level.selected {
        background-color: #f9f9fb;
        box-shadow: 0px 3px 15px 0px rgba(0, 0, 0, 0.1);
    }

    .treeview__level.selected .level-remove {
        display: inline-block;
    }

    .treeview__level.selected .level-add {
        display: none;
    }

    .treeview__level.selected .level-same,
    .treeview__level.selected .level-sub {
        display: none;
    }

    .treeview .level-title {
        cursor: pointer;
        user-select: none;
        text-decoration: none !important;
    }

    .treeview .level-title:hover {
        text-decoration: underline;
    }

    .treeview--mapview ul {
        justify-content: center;
        display: flex;
    }

    .treeview--mapview ul li:before {
        content: unset;
    }

    .treeview--mapview ul li:after {
        content: unset;
    }
</style>
<a href="{{ url('https://white-force.com/plus/tutorial/#teamdiv') }}" target="_blank">
    <span class="a14 btn btn-primary" style="bottom:50px;">Help</span>
</a>
<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">Show Teams</h4>
                </div> --}}
                <div class="card-header bg-primary">
                    <h4 class="card-title"  style="color:white">Show Teams</h4>
                    <button class="btn btn-light btn-sm"><a href="{{ url('dashboard') }}"><span class="btn-start text-info"><i class="fa fa-angle-double-left color-info"></i>
                    </span>Back</a></button>
                </div>
                <div class="card-body" style="padding-bottom:50px;">
                    <div class="treeview js-treeview">
                        <ul>
                            @include('pages.user_section.show_child', ['node' => $user, 'level' => 1])
                        </ul>
                    </div>
                </div>

                {{-- <template id="levelMarkup">
                    <li>
                        <div class="treeview__level" data-level="A">
                            <span class="level-title">Level A</span>
                            <div class="treeview__level-btns">
                                <div class="btn btn-default btn-sm level-add"><span class="fa fa-plus"></span></div>
                                <div class="btn btn-default btn-sm level-remove"><span
                                        class="fa fa-trash text-danger"></span></div>
                                <div class="btn btn-default btn-sm level-same"><span>Add Same Level</span></div>
                                <div class="btn btn-default btn-sm level-sub"><span>Add Sub Level</span></div>
                            </div>
                        </div>
                        <ul>
                        </ul>
                    </li>
                </template> --}}
                {{-- @include('pages.user_section.show_child', ['node' => $user, 'level' => 0]) --}}
            </div>
        </div>

    </div>
</div>
</div>
</div>

{{-- <script>
    $(function () {
  let treeview = {
    resetBtnToggle: function () {
      $(".js-treeview")
        .find(".level-add")
        .find("span")
        .removeClass()
        .addClass("fa fa-plus");
      $(".js-treeview").find(".level-add").siblings().removeClass("in");
    },
    addSameLevel: function (target) {
      let ulElm = target.closest("ul");
      let sameLevelCodeASCII = target
        .closest("[data-level]")
        .attr("data-level")
        .charCodeAt(0);
      ulElm.append($("#levelMarkup").html());
      ulElm
        .children("li:last-child")
        .find("[data-level]")
        .attr("data-level", String.fromCharCode(sameLevelCodeASCII));
    },
    addSubLevel: function (target) {
      let liElm = target.closest("li");
      let nextLevelCodeASCII =
        liElm.find("[data-level]").attr("data-level").charCodeAt(0) + 1;
      liElm.children("ul").append($("#levelMarkup").html());
      liElm
        .children("ul")
        .find("[data-level]")
        .attr("data-level", String.fromCharCode(nextLevelCodeASCII));
    },
    removeLevel: function (target) {
      target.closest("li").remove();
    }
  };

  // Treeview Functions
  $(".js-treeview").on("click", ".level-add", function () {
    $(this)
      .find("span")
      .toggleClass("fa-plus")
      .toggleClass("fa-times text-danger");
    $(this).siblings().toggleClass("in");
  });

  // Add same level
  $(".js-treeview").on("click", ".level-same", function () {
    treeview.addSameLevel($(this));
    treeview.resetBtnToggle();
  });

  // Add sub level
  $(".js-treeview").on("click", ".level-sub", function () {
    treeview.addSubLevel($(this));
    treeview.resetBtnToggle();
  });
  // Remove Level
  $(".js-treeview").on("click", ".level-remove", function () {
    treeview.removeLevel($(this));
  });

  // Selected Level
  $(".js-treeview").on("click", ".level-title", function () {
    let isSelected = $(this).closest("[data-level]").hasClass("selected");
    !isSelected &&
      $(this)
        .closest(".js-treeview")
        .find("[data-level]")
        .removeClass("selected");
    $(this).closest("[data-level]").toggleClass("selected");
  });
});

</script> --}}
@endsection
