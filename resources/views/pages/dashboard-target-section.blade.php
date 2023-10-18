<div class="col-12">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="row">
                <div class="col-sm-3 ">
                    <h4 class="text-15 mb-1 text-dark">Type
                    </h4>
                    <div class="mt-2">
                        <strong class="" style="color:#32325D">Quarter Target</strong>
                    </div>
                    <div class="mt-2">
                        <strong class="" style="color:#32325D">Quarter Achieved</strong>
                    </div>
                    <div class="mt-2">
                        <strong class="" style="color:#32325D">Quarter Pending</strong>
                    </div>
                </div>
                <div class="col-sm-2 border-right" align="center">
                    <h4 class="text-15 mb-1 text-dark">Quarter 1
                    </h4>
                    <div class="mt-2">
                        <strong class="h4 font-weight-bold mb-0  text-secondary"> {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                            {{ inc_format($quarterTarget[1] ?? 0) }}</strong>
                    </div>
                    <div class="mt-2">
                        <strong class="h4 font-weight-bold mb-0  text-secondary"> {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                            {{ inc_format($quarterComplate[1] ?? 0) }}</strong>
                    </div>
                    <div class="mt-2">
                        @if ($quarterPendings[1] < 0)
                            <strong class="h4 font-weight-bold mb-0  text-secondary"> -  {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                                {{ inc_format($quarterPendings[1] ?? 0) }} </strong>
                            <br> <small class="blink_me">Over Achived</small>
                        @else
                            <strong class="h4 font-weight-bold mb-0  text-secondary">  {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                                {{ inc_format($quarterPendings[1] ?? 0) }}</strong>
                        @endif

                    </div>

                </div>
                <div class="col-sm-2 border-right" align="center">
                    <h4 class="text-15 mb-1 text-dark">Quarter 2
                    </h4>
                    <div class="mt-2">
                        <strong class="h4 font-weight-bold mb-0  text-primary"> {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                            {{ inc_format($quarterTarget[2] ?? 0) }}</strong>

                    </div>
                    <div class="mt-2">
                        <strong class="h4 font-weight-bold mb-0  text-primary"> {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                            {{ inc_format($quarterComplate[2] ?? 0) }}</strong>
                    </div>
                    <div class="mt-2">
                        @if ($quarterPendings[2] < 0)
                            <strong class="h4 font-weight-bold mb-0  text-primary">
                                -  {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }} {{ inc_format($quarterPendings[2] ?? 0) }}</strong>
                            <br> <small class="blink_me">Over Achived</small>
                        @else
                            <strong class="h4 font-weight-bold mb-0  text-primary">  {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                                {{ inc_format($quarterPendings[2] ?? 0) }}</strong>
                        @endif
                    </div>
                </div>
                <div class="col-sm-2 border-right" align="center">
                    <h4 class="text-15 mb-1 text-dark">Quarter 3
                    </h4>
                    <div class="mt-2">
                        <strong class="h4 font-weight-bold mb-0  text-success"> {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                            {{ inc_format($quarterTarget[3] ?? 0) }}</strong>
                    </div>
                    <div class="mt-2">
                        <strong class="h4 font-weight-bold mb-0  text-success"> {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                            {{ inc_format($quarterComplate[3] ?? 0) }}</strong>
                    </div>
                    <div class="mt-2">
                       
                        @if ($quarterPendings[3] < 0)
                            <strong class="h4 font-weight-bold mb-0  text-primary">
                                -  {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }} {{ inc_format($quarterPendings[3] ?? 0) }}</strong>
                            <br> <small class="blink_me">Over Achived</small>
                        @else
                            <strong class="h4 font-weight-bold mb-0  text-success">  {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                                {{ inc_format($quarterPendings[3] ?? 0) }}</strong>
                        @endif
                    </div>
                </div>
                <div class="col-sm-2" align="center">
                    <h4 class="text-15 mb-1 text-dark">Quarter 4
                    </h4>
                    <div class="mt-2">
                        <strong class="h4 font-weight-bold mb-0  text-info"> {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                            {{ inc_format($quarterTarget[4] ?? 0) }}</strong>
                    </div>
                    <div class="mt-2">
                        <strong class="h4 font-weight-bold mb-0  text-info">  {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                            {{ inc_format($quarterComplate[4] ?? 0) }}</strong>
                    </div>
                    <div class="mt-2">
                        @if ($quarterPendings[4] < 0)
                            <strong class="h4 font-weight-bold mb-0  text-info">-  {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                                {{ inc_format($quarterPendings[4]  ?? 0) }}</strong>
                            <br> <small class="blink_me">Over Achived</small>
                        @else
                            <strong class="h4 font-weight-bold mb-0  text-info"> {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                                {{ inc_format($quarterPendings[4]  ?? 0) }}</strong>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>