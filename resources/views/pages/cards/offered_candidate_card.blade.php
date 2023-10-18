@foreach ($offered_candidate as $person)
                        <div style="border: 2px dashed #eb815378;border-radius: 10px; padding: 10px 10px; margin-bottom: 10px;">
                            <span class="countOffered"></span>
                            <div class="project-info">
                                <div class="col-sm-8">
                                    <span class=" mb-1 text-primary"> #{{ ucwords($person->position->position_name) }}</span>
                                    <h4 class="title font-w600 mb-1"><a href="{{ url('position/pipeline', $person?->position_id) }}"
                                            class="text-black">{{ ucwords($person?->candidate->name) }} </a></h4>
                                    <p class="text-dark mb-1">Stage - {{ ucwords($person?->stage) }}</p>
                                    <p class="text-dark mb-1">Joining Date - {{ ucwords($person?->joining_date)}} </p>
                                    <p class="text-dark mb-1">Time - 10:30 AM - 12:00 PM</p>
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
