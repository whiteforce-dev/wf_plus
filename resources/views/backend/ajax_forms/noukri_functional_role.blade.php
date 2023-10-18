<div class="form-group">
<label class="pay">  Functional role <small>(Noukri)</small> </label>
      <br>
    <select name="Functional_role" class="list-dt form-control role-single" id="PG_Specializations" style="width: 470px;">
        <option value="-1">-Select -</option>
        @if(count($noukri_functional_roles))
        @foreach($noukri_functional_roles as $noukri_functional_role)
        <option value="{{ $noukri_functional_role->role_id }}">
            {{ isset($noukri_functional_role->role_name)?$noukri_functional_role->role_name:'' }}
        </option>
        @endforeach
        @endif
    </select>
</div>
<script>
        $('.role-single').select2();
</script>