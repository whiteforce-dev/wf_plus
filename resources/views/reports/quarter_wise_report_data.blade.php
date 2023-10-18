<thead>
    <tr>
        <th rowspan="2"><strong>S. No.</strong></th>
        <th rowspan="2"><strong>Name</strong></th>
        <th rowspan="2"><strong>Spillover</strong></th>
        @foreach($months as $month)
        <th colspan="4"><strong>{{ $month }}</strong></th>
        @endforeach
        <th rowspan="2"><strong>Total Offered</strong></th>
        <th rowspan="2"><strong>Total Joining</strong></th>
        <th rowspan="2"><strong>Total Pending Joining</br><small style="font-size:10px">(Offered but not joined)</small></strong></th>
        <th rowspan="2"><strong>Total Remaining Target</strong></th>
    </tr>
    <tr>
        <th><strong>Target</strong></th>
        <th><strong>Offered</strong></th>
        <th><strong>Joined</strong></th>
        <th><strong>Remaining</strong></th>
        <th><strong>Target</strong></th>
        <th><strong>Offered</strong></th>
        <th><strong>Joined</strong></th>
        <th><strong>Remaining</strong></th>
        <th><strong>Target</strong></th>
        <th><strong>Offered</strong></th>
        <th><strong>Joined</strong></th>
        <th><strong>Remaining</strong></th>
    </tr>
</thead>
<tbody>
    @foreach($users as $key => $user)
    @php
    $total_offered = $total_joining = $total_remaining = 0;
    @endphp
    <tr>
        <td>{{ $key + 1 }}</td>
        <td><b>{{ $user->name }}</b><br><small style="font-size:10px" >({{ ucwords(strtolower(str_replace("_"," ",$user->role))) }})</small></td>
        <td class="text-warning"><b>{{ !empty($spillover[$user->id]) ? $spillover[$user->id] : 0 }}</b></td>
        @foreach($months as $key => $month)
        @php
        $month_target = (!empty($all_target[$key]) && !empty($all_target[$key][$user->id])) ? $all_target[$key][$user->id] : 0;
        $month_offered = (!empty($all_offered[$key]) && !empty($all_offered[$key][$user->id])) ? $all_offered[$key][$user->id] : 0;
        $month_joining = (!empty($all_joined[$key]) && !empty($all_joined[$key][$user->id])) ? $all_joined[$key][$user->id] : 0;
        $month_remaining = ($month_target - $month_joining);
        @endphp
        <td class="text-info"><b>{{ inc_format($month_target) }}</b></td>
        <td class="text-primary"><b>{{ inc_format($month_offered) }}</b></td>
        <td class="text-success"><b>{{ inc_format($month_joining) }}</b></td>
        <td class="text-danger"><b>{{ inc_format($month_remaining) }}</b></td>
        @php
        $total_offered += $month_offered;
        $total_joining += $month_joining;
        $total_remaining += $month_remaining; 
        @endphp
        @endforeach
        <td><span class="badge badge-primary">{{ inc_format($total_offered) }}</span></td>
        <td><span class="badge badge-success">{{ inc_format($total_joining) }}</span></td>
        <td><span class="badge badge-warning">{{ inc_format($total_offered - $total_joining ) }}</span></td>
        <td><span class="badge badge-danger">{{ inc_format($total_remaining) }}</span></td>
        @php
        $grand_total_offered += $total_offered;
        $grand_total_joined += $total_joining;
        $grand_total_remaining += $total_remaining;
        @endphp
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr style="background:antiquewhite;">
       <td colspan="2"><strong>Total</strong></td>
       <td class="text-warning"><b>{{ !empty($spillover) ? array_sum($spillover) : 0 }}</b></td>
       @foreach($months as $key=> $month)
       @php
       $all_month_target_total = !empty($all_target[$key]) ? array_sum($all_target[$key]) : 0;
       $all_month_offered_total = !empty($all_offered[$key]) ? array_sum($all_offered[$key]) : 0;
       $all_month_joining_total = !empty($all_joined[$key]) ? array_sum($all_joined[$key]) : 0;
       @endphp
       <td class="text-info"><b>{{ inc_format($all_month_target_total) }}</b></td>
       <td class="text-primary"><b>{{ inc_format($all_month_offered_total) }}</b></td>
       <td class="text-success"><b>{{ inc_format($all_month_joining_total) }}</b></td>
       <td class="text-danger"><b>{{ inc_format($all_month_target_total - $all_month_joining_total) }}</b></td>
       @endforeach
       <td><span class="badge badge-primary">{{ inc_format($grand_total_offered) }}</span></td>
       <td><span class="badge badge-success">{{ inc_format($grand_total_joined) }}</span></td>
       <td><span class="badge badge-warning">{{ inc_format($grand_total_offered - $grand_total_joined) }}</span></td>
       <td><span class="badge badge-danger">{{ inc_format($grand_total_remaining) }}</span></td>
    </tr>
</tfoot>