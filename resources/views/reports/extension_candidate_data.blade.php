

<style>
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .card{
        border: 1px dashed rgba(0, 0, 0, 0.125) !important;
    }


    .myCard {
        padding: 10px !important;
        border-radius: 6px !important;
        color: #ec815e !important;
        /* background: #fff; */
        background: #f2f7fa70 !important;

        height: auto !important;
        box-shadow: none;
        position: relative;
        transition: all 0.2s;

        &:hover {
            border-color: #c4d1e1;
            box-shadow: 0 4px 10px -4px rgba(0, 0, 0, 0.15);
            transform: translate(-4px, -4px);
        }
    }

    .card__image {
        border-radius: 0.25em;
        height: 6em;
        min-width: 6em;
    }

    .card__content {
        flex: auto;
        padding: 0 1em;
    }

    .card h2 {
        font-weight: 700;
        margin: 0;
    }

    .card p {
        color: #546e7a;
        margin: 0;
    }

    /* Checkbox Styles */

    .checkbox {
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
        background: #e2ebf6;
        border-radius: 50%;
        height: 2em;
        margin: 0;
        margin-left: auto;
        flex: none;
        outline: none;
        position: relative;
        transition: all 0.2s;
        width: 2em;

        &:after {
            border: 2px solid #fff;
            border-top: 0;
            border-left: 0;
            content: "";
            display: block;
            height: 1em;
            left: 0.625em;
            position: absolute;
            top: 0.25em;
            transform: rotate(45deg);
            width: 0.5em;
        }

        &:focus {
            box-shadow: 0 0 0 2px rgba(100, 193, 117, 0.6);
        }

        &:checked {
            background: #64c175;
            border-color: #64c175;
        }
    }

    .checkbox-control__target {
        bottom: 0;
        cursor: pointer;
        left: 0;
        opacity: 0;
        position: absolute;
        right: 0;
        top: 0;
    }

    /* SVG Styles */

    .nude {
        fill: #f4f0ed;
    }

    .yellow {
        fill: #ffcb65;
    }

    .red {
        fill: #f96149;
    }

    .sunburn {
        fill: #fe9d7d;
    }

    .eggplant {
        fill: #422b42;
    }

    .blue {
        fill: #4473e9;
    }

    .flamingo {
        fill: #ffb3da;
    }

    .violet {
        fill: #4450c7;
    }

    .poppy {
        fill: #ffa128;
    }

    .orange {
        fill: #ff8e56;
    }

    /* label {
        position: absolute;
        right: 20px;
    } */

    .a14 {
        position: fixed;
        bottom: 15px;
        right: 20px;
        cursor: pointer;
        padding: 5px;
        z-index: 999;
    }

    .font-dark {
        color: #000 !important;
    }
</style>

<div class="col-sm-12 p-4">
        <h3>Candidate From {{ $source }} - <span class="badge badge-primary">{{ $total_count }}</span></h3><br>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,900" rel="stylesheet">
        <div id="can_search_sec">
            <ul class="grid">
                @if (count($candidates))
                    @foreach ($candidates as $key => $candidate)
                        <li class="card myCard">
                            <div class="project-info">

                                <div class="col-xl-8 my-2 col-lg-4 col-sm-6 row">

                                    <div class="col-auto">
                                        <p class="text-primary mb-1">Name </p>
                                        <p class="text-primary mb-1">Email </p>
                                        <p class="text-primary mb-1">Mobile </p>
                                    </div>
                                    <div class="col-sm-1">
                                        <p class="text-primary mb-1">-</p>
                                        <p class="text-primary mb-1">-</p>
                                        <p class="text-primary mb-1">-</p>
                                    </div>
                                    <div class="col-auto">
                                        <p class="text-primary mb-1 font-dark">{{ ucwords($candidate->name) }} </p>
                                        <p class="text-primary mb-1 font-dark">{{ ucwords($candidate->email) }} </p>
                                        <p class="text-primary mb-1 font-dark">{{ ucwords($candidate->mobile) }} </p>
                                    </div>




                                </div>

                                <!-- <div class="col-xl-4 my-2 col-lg-4 col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <div class="project-media">
                                            <img src="{{ !empty($candidate->pco) ? $candidate->pco->thumb() : '' }}"
                                                alt="">
                                        </div>
                                        <div class="ms-2">
                                            <span>Created By</span>
                                            <h5 class="mb-0 pt-1 font-w500 text-black">
                                                {{ !empty($candidate->pco) ? $candidate->pco->name : '' }}
                                            </h5>
                                        </div>

                                    </div>
                                </div> -->
                            </div>

                        </li>
                    @endforeach
                @endif
            </ul>

        </div>


</div>
