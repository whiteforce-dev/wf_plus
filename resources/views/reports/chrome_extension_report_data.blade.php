<thead>
    <tr>
        <th><strong>S.No.</strong></th>
        <th><strong>Name</strong></th>
        @foreach($sources as $source)
            <th><strong>{{ $source->source_name }}</strong></th>
        @endforeach
        <th><strong>Total</strong></th>
    </tr>
</thead>
<tbody>
    @foreach($users as $key => $user)
    @php($total = 0)
    <tr>
        <td>{{$key + 1}}</td>
        <td>{{$user->name}}<br><small style="font-size:10px" >({{ ucwords(strtolower(str_replace("_"," ",$user->role))) }})</small></td>
        @foreach($sources as $source)
            @php($count =  (!empty($source_wise_candidate) && !empty($source_wise_candidate[$user->id]) && !empty($source_wise_candidate[$user->id][$source->source_name])) ? $source_wise_candidate[$user->id][$source->source_name] : 0)
            @if(!empty($count))
            <td onclick="showData('{{ $source->source_name }}','{{ $user->id }}')"><b>{{ $count }}</b></td>
            @else
            <td><b>{{ $count }}</b></td>
            @endif
            @php($total += $count)
            @php($all_src_totals[$source->source_name] = empty($all_src_totals[$source->source_name]) ? $count : $all_src_totals[$source->source_name] + $count)
        @endforeach
        <td><span class="badge badge-primary">{{ $total }}</span></td>
    </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <td colspan="2">Total</td>
        @foreach($sources as $source)
        <td><span class="badge badge-primary">{{ $all_count = (!empty($all_src_totals) && !empty($all_src_totals[$source->source_name])) ? $all_src_totals[$source->source_name] : 0 }}</span></td>
        @php($all_total += $all_count)
        @endforeach
        <td><span class="badge badge-primary">{{ $all_total }}</span></td>
    </tr>
</tfoot>
