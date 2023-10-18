<tbody style="overflow: auto;">
    <tr>
        <td><h6>Managers</h6></td>
        @foreach($dates as $date)
        <td><h6>{{ $date }}</h6></td>
        @endforeach
    </tr>
        @foreach($counts as $key=>$count)
        <tr>
            <td><h6>{{ App\Models\User::find($key)->name }}</h6></td>
            @foreach($count as $number)
            <td><h6>{{  $number }}</h6></td>
            @endforeach
        </tr>
        @endforeach
</tbody>
