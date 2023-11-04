<!DOCTYPE html>
<html lang="en">

    <head><link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
       
    
   
</head>
<body>
    <div class="mydiv col-sm-12" style="background: white">

        <h3>Send Joining Form</h3><hr style="border:1px solid rgb(218, 120, 8) !important;">
        
        <form action={{ url('sendjoiningform') }} method="post">
            @csrf
        
                            <div class="form-group col-md-12">
                           
        
        
        
                                <label><b style="font-size:16px">Email</b><span style="color:red">*</span><small style="font-size:14px">(Add multiple Email Id by pressing enter )</small></label>
                                <select class="form-control js-example-tokenizer"  id="js-example-basic-multiple" type="email"name="email[]" multiple="multiple" > 
                                </select>
                                {{-- <input type='email'class='form-control'name='email[]'multiple> --}}
                 
            
                            </div>
                            <div>
                                @error('email')
                                <span class="alert alert-danger">{{$message}}</span>
                                    @enderror
                            </div>
        
                            <div class="form-group col-md-12">
                           
        
        
        
                                <label><b style="font-size:16px">Company Name</b><span style="color:red">*</span></label>
                                {{-- <select class="form-control"  id="js-example-basic-multiple" type="email"name="email[]" multiple="multiple" > --}}
                                {{-- </select> --}}
                                {{-- <input type='text'class='form-control'name='company'> --}}
                                <select class='form-control'name='company'>
                                    <option>-Select Company-</option>
                                    @foreach($clients as $client)
                                    @if($client->client_name == 'OCTOPOLIS TECHNOLOGIES PRIVATE LIMITED')
                                    <option value="{{$client->client_id  }}">Apna Club</option>
                                    @else
                                    <option value="{{ $client->client_id }}">{{ $client->client_name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                 
            
                            </div>
                            <div>
                                @error('company')
                                <span class="alert alert-danger">{{$message}}</span>
                                    @enderror
                            </div>
                            
                            <div class="form-group col-md-12">
                           
        
        
        
                                <label><b style="font-size:16px">Job Location</b><span style="color:red">*</span></label>
                                
                                <input type='text'class='form-control'name='joblocation' required>
                 
            
                            </div>
                            <div>
                                @error('joblocation')
                                <span class="alert alert-danger">{{$message}}</span>
                                    @enderror
                            </div>
                           
                    <br>
                    
                    
                                    <div class='row' data-aos="zoom-in-up">
                                        <div class="form-group col-md-12 ">
                                            <button class='btn btn-success' style=float:center>Send</button></a>
                                        </div>
                                    </div>
                    
                                </form>
                        </div>
        
                    </div>
        
        
    
</body>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
      $('#js-example-basic-multiple').select2({
          tags:true
      });
  });
</script>

<script>
  $(".js-example-tokenizer").select2({
tags: true,
tokenSeparators: [',', ' ']
})
</script>
</html>