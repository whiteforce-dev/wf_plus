@php
$target = \App\Models\Target::where('user_id', $node->id)->whereMonth('created_at', date('m'))->latest()->first();



if($target){

    $left=(@$target->target ) - (@$target->complete );
    $target_month= Carbon\Carbon::parse($target->created_at)->format('F');
}
else{
    $left= 0;
    $target_month= date('F');
}
@endphp
<tr>
    <td><img class="img-round" height="50" src="{{ $node->thumb() }}" alt=""></td>
    <td class="text-dark">{{ $node->name }} <br> <small class="csmall">({{ getRoleDisplay($node->role) }})</small></td>
    <td>{{ $target_month }}</td>
    <td class="monthlyTarget">{{ inc_format($target->month_target ?? 0) }}</td>
    <td class="totalTarget">{{  inc_format($target->target ?? 0) }}</td>
    <td class="complateTarget">{{  inc_format($target->complete ?? 0) }}</td>

    <td class="leftTarget">{{  inc_format($left ?? 0) }}</td>
    <td>
        @if(in_array(Auth::user()->software_category, ONROLE_CATEGORY()))
        <input name="target_{{ $node->id }}" min="0" max="10000000" step="50000" type="range" value="{{ $target->month_target ?? 0 }}" class="form-control-range" id="formControlRange_{{ $node->id }}" onInput='$("#rangeval_{{ $node->id }}").html(inc_format($(this).val()))'>
        <br>
        <p>₹ <b id="rangeval_{{ $node->id }}">{{ inc_format($target->month_target ?? 0) }}</b></p>
        @else

        <input name="target_{{ $node->id }}" min="0" max="500" step="1" type="range" value="{{ $target->month_target ?? 0 }}" class="form-control-range" id="formControlRange_{{ $node->id }}" onInput='$("#rangeval_{{ $node->id }}").html(inc_format($(this).val()))'>
        <br>
        <p><b id="rangeval_{{ $node->id }}">{{ inc_format($target->month_target ?? 0) }}</b></p>
        @endif
        
       
    </td>

    {{-- <td><input type="text" class="form-control" name="target_{{ $node->id }}" placeholder="Enter Target" value="{{ $target->month_target ?? 0 }}" required></td> --}}
</tr>
@if ($node->descendants->isNotEmpty())
@php
$level++;
@endphp

@foreach ($node->descendants as $descendant)
@include('pages.target.childrow', ['node' => $descendant, 'level' => $level])
@endforeach

@endif