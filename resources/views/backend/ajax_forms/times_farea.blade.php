{{-- <div class="col-sm-6 mt-4">
    <div class="form-group">
        <label class="pay">Area of Specialisation</label>
        <br>

        <select name="times_areaOfSpec[]" class="list-dt form-control select-multiple-area" id="" required>
            <option value="">Select Functional area of Specialisation </option>
            @if (count($times_fareas))
                @foreach ($times_fareas as $times_farea)
                    <option value="{{ $times_farea->id }}">
                        {{ isset($times_farea->value) ? $times_farea->value : '' }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>
</div>
<div class="col-sm-6 mt-4">
    <div class="form-group">
        <label class="pay">Role</label>
        <br>

        <select name="times_FaRoles[]" class="list-dt form-control select-multiple-role" id="">
            <option value="">Select Functional Role</option>
            @if (count($times_roles))

                @foreach ($times_roles as $times_role)
                    <option value="{{ $times_role->id }}">
                        {{ isset($times_role->value) ? $times_role->value : '' }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>
</div> --}}



<div class="mb-3 row">
    <label class="col-sm-3 col-form-label">Area of Specialisation</label>
    <div class="col-sm-9">
        <select name="times_areaOfSpec[]" class="form-control times_areaOfSpec"  required>
            @if (count($times_fareas))
                @foreach ($times_fareas as $times_farea)
                    <option value="{{ $times_farea->id }}">
                        {{ isset($times_farea->value) ? $times_farea->value : '' }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>
</div>

<div class="mb-3 row">
    <label class="col-sm-3 col-form-label">Role</label>
    <div class="col-sm-9">
        <select name="times_FaRoles[]" class="form-control times_FaRoles">
            @if (count($times_roles))
                @foreach ($times_roles as $times_role)
                    <option value="{{ $times_role->id }}">
                        {{ isset($times_role->value) ? $times_role->value : '' }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>
</div>

<script>
//    $(document).ready(function() {
        
//          $(".times_areaOfSpec").select2({
//             // maximumSelectionLength: 1,
//             placeholder: "Select Area Of Spec",
//         });

//          $(".times_FaRoles").select2({
//             // maximumSelectionLength: 1,
//             placeholder: "Select Fuctional Area Roles",
//         });
//     });
</script>
