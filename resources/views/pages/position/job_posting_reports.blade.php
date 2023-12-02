@extends('master.master')
@section('title', 'Job Posting Reports')
@section('content')

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&display=swap");



        :root {
            --c-white: #fff;
            --c-black: #000;
            --c-ash: #eaeef6;
            --c-charcoal: #a0a0a0;
            --c-void: #141b22;
            --c-fair-pink: #FFEDEC;
            --c-apricot: #FBC8BE;
            --c-coffee: #754D42;
            --c-del-rio: #917072;
            --c-java: #1FCAC5;
            --c-titan-white: #f1eeff;
            --c-cold-purple: #a69fd6;
            --c-indigo: #6558d3;
            --c-governor: #4133B7;
        }



        /* .cards {
                    display: flex;
                    flex-wrap: wrap;
                    align-items: flex-start;
                    flex-wrap: wrap;
                    justify-content: center;
                    gap: 2.5rem;
                    width: 90%;
                    max-width: 1000px;
                    margin: 10vh auto;
                }

                .card {
                    border-radius: 16px;
                    box-shadow: 0 30px 30px -25px rgba(65, 51, 183, 0.25);
                    max-width: 300px;
                } */

        .information {
            background-color: var(--c-white);
            padding: 1.5rem;
        }

        .information .tag {
            display: inline-block;
            background-color: var(--c-titan-white);
            color: var(--c-indigo);
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.5em 0.75em;
            line-height: 1;
            border-radius: 6px;
        }

        .information .tag+* {
            margin-top: 1rem;
        }

        .information .title {
            font-size: 1.5rem;
            color: var(--c-void);
            line-height: 1.25;
        }

        .information .title+* {
            margin-top: 1rem;
        }

        .information .info {
            color: var(--c-charcoal);
        }

        .information .info+* {
            margin-top: 1.25rem;
        }

        .information .button {
            font: inherit;
            line-height: 1;
            background-color: var(--c-white);
            border: 2px solid var(--c-indigo);
            color: var(--c-indigo);
            padding: 0.5em 1em;
            border-radius: 6px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
        }

        .information .button:hover,
        .information .button:focus {
            background-color: var(--c-indigo);
            color: var(--c-white);
        }

        .information .details {
            display: flex;
            gap: 1rem;
        }

        .information .details div {
            padding: 0.75em 1em;
            background-color: var(--c-titan-white);
            border-radius: 8px;
            display: flex;
            flex-direction: column-reverse;
            gap: 0.125em;
            flex-basis: 50%;
        }

        .information .details dt {
            font-size: 0.875rem;
            font-weight: 400;
            color: var(--c-cold-purple);
        }

        .information .details dd {
            color: var(--c-indigo);
            font-weight: 600;
            font-size: 1.25rem;
        }

        .plan {
            padding: 10px;
            background-color: var(--c-white);
            color: var(--c-del-rio);
        }

        .plan strong {
            font-weight: 600;
            color: var(--c-coffee);
        }

        .plan .inner {
            padding: 20px;
            padding-top: 40px;
            background-color: var(--c-fair-pink);
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        .plan .pricing {
            position: absolute;
            top: 0;
            right: 0;
            background-color: var(--c-apricot);
            border-radius: 99em 0 0 99em;
            display: flex;
            align-items: center;
            padding: 0.625em 0.75em;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--c-coffee);
        }

        .plan .pricing small {
            color: var(--c-del-rio);
            font-size: 0.75em;
            margin-left: 0.25em;
        }

        .plan .title {
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--c-coffee);
        }

        .plan .title+* {
            margin-top: 0.75rem;
        }

        .plan .info+* {
            margin-top: 1rem;
        }

        .plan .features {
            display: flex;
            flex-direction: column;
        }

        .plan .features li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .plan .features li+* {
            margin-top: 0.75rem;
        }

        .plan .features .icon {
            background-color: var(--c-java);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--c-white);
            border-radius: 50%;
            width: 20px;
            height: 20px;
        }

        .plan .features .icon svg {
            width: 14px;
            height: 14px;
        }

        .plan .features+* {
            margin-top: 1.25rem;
        }

        .plan button {
            font: inherit;
            background-color: var(--c-indigo);
            border-radius: 6px;
            color: var(--c-white);
            font-weight: 500;
            font-size: 1.125rem;
            width: 100%;
            border: 0;
            padding: 1em;
        }

        .plan button:hover,
        .plan button:focus {
            background-color: var(--c-governor);
        }

        .img-fluid {
            max-width: 50%;
            height: auto;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2.5rem;
            width: 90%;
            max-width: 1000px;
            margin: 10vh auto;
        }

        .custom-card {
            border-radius: 16px;
            box-shadow: 0 30px 30px -25px rgba(65, 51, 183, 0.25);
            max-width: 300px;
        }
        .point{
            cursor: pointer;
        }
    </style>
    <a href="{{ url('https://white-force.com/plus/tutorial/#jobpostdiv') }}" target="_blank">
        <span class="a14 btn btn-primary" style="bottom:50px;">Help</span>
    </a>
    <div class="content-body">
        <div class="container-fluid">
            <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
                <div class="col-xl-12">
                    <div class="card col-12">
                        <form action="{{ url('job-posting-reports') }}" style="display:inline;">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class=" col-3">
                                <label for="">Select Manager</label>
                                <select class="default-select form-control wide" name="manager" id="created_by"
                                    onchange="">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->id == $manager_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="">From Date</label>
                                <div class="input-group ">
                                    <input type="date" class="form-control" name="fromdate" value="{{ $fromDate ?? '' }}">
                                </div>
                            </div>
                            <div class="col-2">
                                <label for="">To Date</label>
                                <div class="input-group ">
                                    <input type="date" class="form-control" name="todate" value="{{ $toDate ?? '' }}">
                                </div>
                            </div>
                            <div class="col-3">
                                <label for=""></label>
                                <button class="btn btn-primary btn-block" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>


                @foreach($jobPortals as $portal)
                <div class="col-sm-3 p-2">
                    <div class="custom-card">
                        <article class="information [ card ]" align="center">
                            <h2 class="title">
                                <div style="width: 225px; height: 75px; overflow: hidden;">
                                    <img
                                        src="{{ $portal['logo'] }}"
                                        alt=""
                                        class="img-fluid rounded-square"
                                    >
                                </div>
                            </h2>
                            <dl class="details">
                                <div>
                                    <dt>Positions</dt>
                                    <dd>{{ $portal['position'] ?? 0 }}</dd>
                                </div>
                                <div class="point" onclick='getName("0","{{ $portal["name"] }}")'>
                                    <dt>Candidates</dt>
                                    <dd>{{ $portal['candidate'] ?? 0 }}</dd>
                                </div>
                            </dl>
                        </article>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
    <script>
        function getName(id, portal) {
            var url = 'all_responses/' + id + '/' + portal +'/'+'response';
            window.open(url, "_self");
        }
    </script>
@endsection
