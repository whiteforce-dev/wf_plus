<tbody>
    @foreach($interviews as $key => $interview)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td><strong>{{ !empty($interview->position) ? $interview->position->position_name : '' }}</strong><br><small>{{ (!empty($interview->position) && !empty($interview->position->findClientGet)) ? $interview->position->findClientGet->name : '' }}</small></td>
        <td>{{ !empty($interview->candidate) ? $interview->candidate->name : '' }}</td>
        <td>{{ $interview->interview_date }}</td>
        <td>{{ strtoupper($interview->stage) }}</td>
        <!-- <td>0</td> -->
        <td>{{ !empty($interview->position_owner) ? $interview->position_owner->name : '' }}</td>
        <td>{{ !empty($interview->pco) ? $interview->pco->name : '' }}</td>
    </tr>
    @endforeach
</tbody>
