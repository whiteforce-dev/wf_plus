<thead>
    <tr>
        <td><h6>Managers</h6></td>
        @foreach($dates as $date)
        <td><h6>{{ $date }}</h6></td>
        @endforeach
    </tr>
</thead>
<tbody style="overflow: auto;">
    @foreach ($counts as  $count)
    <tr>
        @if($count["number"]->count() != 0)
        <td><h6 class="text-danger" style="cursor:pointer;" onclick ="showDetail({{ $count['data'] }})" >{{ $count['user'] }}</h6></td>
        @else
        <td><h6 >{{ $count['user'] }}</h6></td>
        @endif
        @foreach($count as $k => $value)
         @if(is_numeric($k))
            <td><span class="badge badge-primary">{{ $value }}</span></td>
        @endif
        @endforeach
    </tr>
    @endforeach

</tbody>
<script>
    function showDetail(e){
      
        let data = "";
        for (a of e) {
            data += `<div class="alert alert-danger alert-dismissible alert-alt fade show" >
                <div class="text-danger" style="font-size:0.8rem; font-weight:500;><span class="text-black">Date</span> : `+ a.created_at.substring(0,10)+`</div>
                <div style="display: flex;justify-content:space-evenly; margin-top:10px;">
                    <div style="color: #43474b; font-size:0.8rem; font-weight:500; ">Mobile Number: <br> <span style="color: rgb(255,76,65);font-size:15px;">` + a.mobile + `</span></div>
                    <div style="color: #43474b; font-size:0.8rem; font-weight:500; ">Candidate : <br> <span style="color: rgb(255,76,65);font-size:15px;">` + a.candidate_name + `</span></div>
                    <div style="color: #404249; font-size:0.8rem; font-weight:500; "> Position : <br> <span style="color: rgb(255,76,65);">` + a.position + `</span></div>
                    <div style="color: #404249; font-size:0.8rem; font-weight:500; "> Company : <br> <span style="color: rgb(255,76,65);">` + a.company_name + `</span></div>
                </div>
            </div>`;
        }
        console.log(data);
    $('#candidates').modal('show');
    $('#percentage').empty();
    $('#percentage').html(data);
    }
</script>
