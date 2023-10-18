

    <div class="mb-3 row mb-4 mt-5">
        <div class="col-sm-12">
                <svg title="REED logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 74 37.705"  width="90"><path d="M9.183 10.239a2.442 2.442 0 1 0 0-4.86H5.838v4.86zM0 1.018h9.689c4.32 0 7.978 2.4 7.978 6.791 0 3.429-2.335 5.659-5.37 6.425l5.6 10.087h-6.226L6.534 14.6h-.7v9.721H-.003z"></path><path d="M29.629 13.968a3.445 3.445 0 0 0-6.624 0zm-11.784 2.064a8.473 8.473 0 0 1 16.944-.2c0 .433-.033.932-.067 1.331H22.838a3.549 3.549 0 0 0 3.629 3.163 2.927 2.927 0 0 0 2.862-1.432h5.26c-.965 3.43-4.128 5.627-8.089 5.627a8.377 8.377 0 0 1-8.655-8.489M48.391 13.968a3.445 3.445 0 0 0-6.624 0zm-11.784 2.064a8.473 8.473 0 0 1 16.944-.2c0 .433-.033.932-.066 1.331H41.6a3.549 3.549 0 0 0 3.629 3.163 2.928 2.928 0 0 0 2.863-1.432h5.26c-.966 3.43-4.128 5.627-8.09 5.627a8.377 8.377 0 0 1-8.655-8.489M63.745 19.885a3.877 3.877 0 1 1 3.877-3.877 3.877 3.877 0 0 1-3.877 3.877M68.352.529v8.232a8.584 8.584 0 1 0 0 14.494v1.067h4.86V0zM74 33.705a4 4 0 1 1-4-4 4 4 0 0 1 4 4M61.731 33.705a4 4 0 1 1-4-4 4 4 0 0 1 4 4M49.462 33.705a4 4 0 1 1-4-4 4 4 0 0 1 4 4"></path></svg>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Job Type</label>
        <div class="col-sm-9" id="reed_job_type">
            <select name="reed_job_type" class=" form-control" required>
                <option value="0" disabled selected>Select Job Type</option>
                <option value="1">Permanent</option>
                <option value="2">Contract</option>
                <option value="4">Temporary</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Working Hours</label>
        <div class="col-sm-9">
            <select name="reed_working_hour" class="list-dt form-control"
            id="reed_working_hour" required>
                <option value="0" disabled selected>Select Working Hours</option>
                <option value="1">Full time</option>
                <option value="2">Part time</option>
                <option value="3">Full or Part time</option>
        </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Currency</label>
        <div class="col-sm-9">
            <select name="reed_currency_type"
            class="form-control select-single" id="reed_currency_type"
                required>
            <option value="-1" selected disabled>Select Currency Type</option>
            <option value="1">GBP (Great Britain Pounds)</option>
            <option value="2">EUR (Euro)</option>
            <option value="3">AUD (Australian Dollars)</option>
            <option value="8">USD (United States Dollars)</option>
            <option value="21">CAD (Canadian Dollars)</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Salary Type</label>
        <div class="col-sm-9" id="reed_salary">
            <select name="reed_salary_type" class="form-control select-single"
                id="reed_salary_type" Required>
                <option value="5" selected>Per annum</option>
                <option value="1">Per hour</option>
                <option value="2">Per day</option>
            </select>
        </div>
    </div>
    



