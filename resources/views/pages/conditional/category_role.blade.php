

<label class="col-sm-3 col-form-label"> Category Roles</label>
<div class="col-sm-9">
    <select name="category_role_id" class="form-control " id="category_role_id">
        <option value="-1">Select Category Role</option>
        @if(count($monster_category_role_mappings))
        @foreach($monster_category_role_mappings as $category_role)
        <option value="{{ $category_role->role_id }}">
            {{ isset($category_role->role_name)?$category_role->role_name:'' }}
        </option>
        @endforeach
        @endif
    </select>
</div>
