@php
    $monthlyTarget = \App\Models\MonthlyTarget::where(['user_id'=> $node->id, 'month' => $month])->first();
@endphp
<tr>
    <td><img class="img-round" height="50" src="{{ $node->thumb() }}" alt=""></td>
    <td class="text-dark">{{ $node->name }} <br> <small class="csmall">({{ getRoleDisplay($node->role) }})</small></td>
   
    <td class="monthlyTarget">{{ $monthlyTarget->month ?? '-' }}</td>
    <td class="totalTarget">{{ $monthlyTarget->quarter ?? '-' }}</td>
    <td class="complateTarget">{{ $monthlyTarget->year ?? '-' }}</td>

    <td class="leftTarget">{{ inc_format($monthlyTarget->target ?? 0) }}</td>
    <td>
        @if(in_array(Auth::user()->software_category, ONROLE_CATEGORY()))
        <input name="target_{{ $node->id }}" value="{{ $monthlyTarget->target ?? 0 }}" min="0" max="10000000" step="100000" type="range" value="" class="form-control-range" id="formControlRange_{{ $node->id }}" onInput='$("#rangeval_{{ $node->id }}").html(inc_format($(this).val()))' style="width: 250px;">
        <br>
        <p>₹ <b id="rangeval_{{ $node->id }}">{{ inc_format($monthlyTarget->target ?? 0) }}</b></p>
        @else

        <input name="target_{{ $node->id }}" min="0" max="500" step="1" type="range" value="{{ $monthlyTarget->target ?? 0 }}" class="form-control-range" id="formControlRange_{{ $node->id }}" onInput='$("#rangeval_{{ $node->id }}").html(inc_format($(this).val()))' style="width: 250px;">
        <br>
        <p><b id="rangeval_{{ $node->id }}">{{ $monthlyTarget->target ?? 0 }}</b></p>
        @endif
        
       
    </td>

    {{-- <td><input type="text" class="form-control" name="target_{{ $node->id }}" placeholder="Enter Target" value="{{ $target->month_target ?? 0 }}" required></td> --}}
</tr>
@if ($node->descendants->isNotEmpty())
@php
$level++;
@endphp

@foreach ($node->descendants as $descendant)
@include('pages.monthly_target.childrow', ['node' => $descendant, 'level' => $level])
@endforeach

@endif