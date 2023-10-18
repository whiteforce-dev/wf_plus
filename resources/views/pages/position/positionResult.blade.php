@if (count($Positions))
@foreach ($Positions as $key => $position)
@include('pages.position.elements.jobListElement',compact('position'))
@endforeach
<br>
<div class="pagination-gutter" style="background: none;">
    {{ $Positions->links() }}
</div>
@else
<div class="col-sm-11 card mt-2">
    @include('master.404')
</div>
@endif