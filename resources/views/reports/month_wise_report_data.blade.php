<tbody>
    @foreach($users as $key => $user)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $user->name }}</td>
        <td>
            <b>Approach</b> <hr> <b>Achieved</b>
        </td>
        @foreach($months as $month => $month_name)
        <td>
            <span class="badge badge-info">{{ (!empty($all_approach_array[$month]) && !empty($all_approach_array[$month][$user->id])) ? $all_approach_array[$month][$user->id] : 0 }}</span>
            <hr>
            <span class="badge badge-success">{{$currency}} {{ (!empty($all_achieved_array[$month]) && !empty($all_achieved_array[$month][$user->id])) ? $all_achieved_array[$month][$user->id] : 0 }}</span>
        </td>
        @endforeach
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr style="background:antiquewhite;">
        <td colspan="3"><strong>Total</strong></td>
        @foreach($months as $month => $month_name)
        <td>
        <span class="badge badge-info">{{ !empty($all_approach_array[$month]) ? array_sum($all_approach_array[$month]) : 0 }}</span>
        <hr>
        <span class="badge badge-success">{{$currency}} {{ !empty($all_achieved_array[$month]) ? array_sum($all_achieved_array[$month]) : 0 }}</span>
        </td>
        @endforeach
    </tr>
</tfoot>