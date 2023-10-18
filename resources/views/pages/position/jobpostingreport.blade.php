<style>
    .disabled {
        opacity: 0.3;
    }

    .redBorder {
        border: 2px solid #e23c3c;
    }
</style>
<div class="modal-header custom-modal-header">

    <div class="col-sm-12">
        <h3>Job Posting Report</h3>
        <small>All history about Job Posting</small>
    </div>


</div>
<div class="modal-body custom-modal-body p-3" id="modal-body">

    <table class="table">
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Portal</th>
                <th>Status</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody> @php
            $logos = [
                'linkedin' => url('job-posting-assets/linkedin.png'),
                'facebook' => url('job-posting-assets/facebook.png'),
                'shine' => url('job-posting-assets/shine.png'),
                'Click India' => url('job-posting-assets/clickIndia.png'),
                'monster' => url('job-posting-assets/monster.jpg'),
                'careerJet' => url('job-posting-assets/careerjet.png'),
                'post_job_free' => url('job-posting-assets/postjobfree.png'),
                'jora' => url('job-posting-assets/jora.png'),
                'naukri' => url('job-posting-assets/naukri.png'),
                'indeed' => url('job-posting-assets/Indeed.png'),
                'jooble' => url('job-posting-assets/jooble.jpg'),
                'timesjob' => url('job-posting-assets/timesjob.png'),
                'google' => url('job-posting-assets/google.png'),
                'whatsjob india' => url('job-posting-assets/whatJobs.png'),
                'Drjobs india' => url('job-posting-assets/drjob.png'),
                'Adzuna india' => url('job-posting-assets/aduzana.png'),
                'Linkedin Ats' => url('job-posting-assets/ats.png'),
                'job_vertise' => url('job-posting-assets/jobvertise.webp'),
                'my_job_helper' => url('job-posting-assets/myjobhelper.png'),
                'Cv Library' => url('job-posting-assets/cv.png'),
                'adzuna usa' => url('job-posting-assets/adzuna.png'),
                'WhatsJob USA' => url('job-posting-assets/whatJobs.png'),
                'ziprecruiter' => url('job-posting-assets/zip.png'),
                'Times Ascent USA' => url('job-posting-assets/times-ascent.png'),
                'Tanqeeb UAE' => url('job-posting-assets/tanqeeb.png'),
                'jobIsJob' => url('job-posting-assets/jobisjob.jpg'),
            ];
        @endphp <tr>
                <td>1</td>
                <td style="width: 30% !important;"> <img class="" src="{{ url('job-posting-assets/happiest.png') }}"
                        alt="happiest" srcset="" style="height:30px; width:auto;"></td>
                <td> <span class="badge">Posted</span> </td>
                <td>Job Posted Successfully in Happiest Resume</td>
                <td><span class="badge">-</span> </td>
            </tr>
            <tr>
                <td>2</td>
                <td style="width: 30% !important;"> <img class="" src="{{ url('job-posting-assets/wf.png') }}"
                        alt="happiest" srcset="" style="height:30px; width:auto;"></td>
                <td> <span class="badge">Posted</span> </td>
                <td>Job Posted Successfully in White Force</td>
                <td><span class="badge">-</span> </td>
            </tr> @php $count = 2; @endphp @foreach ($portals as $key => $item)
                <tr>
                    <td>{{ ++$count }}</td>
                    <td style="width: 30% !important;"> <img class="{{ $item->is_success == 1 ? '' : 'disabled' }}"
                            src="{{ $logos[$item->portal] ?? '' }}" alt="{{ $item->portal }}" srcset=""
                            style="height:30px; width:auto;"></td>
                    <td> <span
                            class="badge {{ $item->is_success == 1 ? '-' : 'badge-danger' }}">{{ $item->is_success == 1 ? 'Posted' : 'Not Posted' }}</span>
                    </td>
                    @if (strlen($item->response) > 50)
                        <td style="width: 30% !important;">{{ substr($item->response, 0, 50) }} <a
                                style="color:blue; cursor: pointer;" data-toggle="tooltip" data-placement="top"
                                title="{{ $item->response }}"> View more</a></td>
                    @else
                        <td style="width: 30% !important;">{{ $item->response }} </td>
                    @endif
                    <td><span
                            class="badge">{{ \Carbon\carbon::parse($item->created_at)->format('M, d Y h:i A') }}</span>
                    </td>
                </tr>
                @endforeach <tr>
                    <td colspan="5" align="center"><b>Not Seleted Portals</b></td>
                </tr>
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Portal</th>
                        <th>Status</th>
                        <th colspan="2">Message</th>
                    </tr>
                </thead>
                @foreach ($notSelectedPortals as $key => $item)
                    <tr>
                        <td>{{ ++$count }}</td>
                        <td style="width: 30% !important;"> <img src="{{ $logos[$item] ?? '' }}"
                                alt="{{ $item }}" srcset="" style="height:30px; width:auto;"></td>
                        <td> <span class="badge badge-danger">Not Selected</span> </td>
                        <td style="width: 30% !important;" colspan="2">{{ ucfirst($item) }} Portal Not selected.
                        </td>
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>
