@foreach ($upcoming_interview as $person)
                        <div style="border: 2px dashed #eb815378;border-radius: 10px; padding: 10px 10px; margin-bottom: 10px;">
                            <span class="countInterview"></span>
                            <div class="project-info">
                                <div class="col-sm-8">
                                    <p class="text-primary mb-1"># {{ ucwords($person->position->position_name) }}</p>
                                    <h4 class="title font-w600 mb-1"><a href="{{ url('position/pipeline', $person?->position_id) }}"
                                            class="text-black">{{ ucwords($person?->candidate->name) }}</a></h4>
                                    <p class="text-dark mb-1">Stage -{{ ucwords($person?->stage) }}</p>
                                    <p class="text-dark mb-1">Interview Date - {{ ucwords($person?->interview_date) }} </p>
                                    <p class="text-dark mb-1">Time - {{ ucwords($person?->interview_time_from) }} -
                                        {{ ucwords($person?->interview_time_to) }}</p>
                                    <p class="text-dark mb-1">Venue - {{ ucwords($person?->interview_venue) }}</p>

                                </div>
                                <div class="col-sm-4">
                                    @php
                                    $manager=App\Models\User::find($person['pco']['parent_id']);
                                    @endphp
                                    <span>Manager</span>
                                    <h5 class="mb-2 pt-1 font-w50 text-black">{{ ucwords($manager->name ?? "Admin") }}</h5>
                                    <span>Recruiter</span>
                                    <h5 class="mb-0 pt-1 font-w50 text-black">{{ ucwords($person?->pco->name) }}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
