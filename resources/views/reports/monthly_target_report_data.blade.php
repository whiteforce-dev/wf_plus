<tbody>
@foreach($users as $key => $user)
<tr>
    <td>{{ $key + 1 }}</td>
    <td><div class="client_logoDiv" id="client_logoDiv">
        <img class="" id="client_logo_img" src="{{ $user->thumb() }}" alt="" />
    </div></td>
    <td>{{ $user->name }}</td>
    <td class="font-info">{{ !empty($approach[$user->id]) ? $approach[$user->id] : '0' }}</td>
    <td class="font-success">{{ $currency }} {{ !empty($joined[$user->id]) ? $joined[$user->id] : '0' }}</td>
    <td class="font-warning">{{ $currency }} {{ !empty($backout[$user->id]) ? $backout[$user->id] : '0' }}</td>
    <td class="font-primary">{{ $currency }} {{ !empty($quarter_joined[$user->id]) ? $quarter_joined[$user->id] : '0 ' }}</td>
</tr>
@endforeach
</tbody>
<tfoot>
    <tr style="background:antiquewhite">
        <td colspan="3"><strong>Total</strong></td>
        <td><span class="badge badge-info">{{ $total_approach }}</span></td>
        <td><span class="badge badge-success">{{ $currency }} {{ $total_joined }}</span></td>
        <td><span class="badge badge-warning">{{ $currency }} {{ $total_backout }}</span></td>
        <td><span class="badge badge-primary">{{ $currency }} {{ $total_quarter_joined }}</span></td>
    </tr>
</tfoot>

