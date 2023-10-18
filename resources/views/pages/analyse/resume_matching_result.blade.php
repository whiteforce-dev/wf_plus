<style>
    .spaceInWords {
        word-spacing: 2px !important;
        color: #000000ce !important;
        font-weight: 500;
        text-transform: capitalize;
    }

    .missing {
        color: red !important;
        font-weight: 500 !important;
    }

    .matching {
        color: #578f01 !important;
        font-weight: 500 !important;
    }
</style>
<section class="slice">
    <div class="container position-relative zindex-100">
        <div class="row row-grid align-items-center justify-content-between">
            <div class="col-sm-12 col-sm-12 mx-md-auto order-lg-2">
                <div class="card rounded-bottom-right">
                    <div class="card-body">

                        <div class="card card-money border-0"
                            style="background: linear-gradient(58deg, rgb(255 255 255) 0%, rgb(255 255 255 / 86%) 0%, rgb(235 129 83) 100%);
                            box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px">

                            <div class="card-body position-relative zindex-100">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-4"><img
                                            src="https://white-force.com/offrole/whiteforcelogo_portrait_color.png"
                                            alt="Image placeholder" class="rounded-sm" style="height:50px"></div>
                                    <div class="col-4" align="center">
                                        <h3 style="color: white">Resume Matching Result</h3>
                                        
                                        <h6 class="progress-text mt-2 mb-0 d-block spaceInWords" style="color: white">
                                            This result
                                            given by AI Bot
                                        </h6>
                                    </div>
                                    <div class="col-4" align="right"><span class="badge badge-warning"
                                            style="font-size: 30px;"> {{ $score }}%</span>
                                        <h6 class="progress-text mt-2 mb-0 d-block" style="color: white">AI Matching
                                            Score
                                        </h6>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="list-group list-group-flush" style="padding: 15px 20px;">
                            <div class="row">
                                <div class="col-sm-4 mb-5">
                                    <h6 class="progress-text mb-0 d-block" style="font-size: 20px;">Categories
                                    </h6>
                                </div>
                                <div class="col-sm-4 mb-5">
                                    <h6 class="progress-text mb-0 d-block" style="font-size: 20px; margin-left: 30px;">
                                        <span
                                            style="margin: -6px -34px !important; font-size: 28px; color: #8ccf24; position: absolute;"
                                            class="mdi mdi-checkbox-marked-circle"></span> <span>Matching
                                            Keywords</span>
                                    </h6>
                                </div>
                                <div class="col-sm-4 mb-5">
                                    <h6 class="progress-text mb-0 d-block" style="font-size: 20px; margin-left: 30px;">
                                        <span
                                            style="margin: -6px -34px !important; font-size: 28px; position: absolute;color:#d11313"
                                            class="mdi mdi-close-circle"></span>
                                        Missing Keywords
                                    </h6>
                                </div>
                            </div>

                            <div class="row line">
                                <div class="col-sm-4 mb-5">
                                    <h6 class="progress-text mb-0 d-block"> {{ strtoupper('Tools and technologies') }}
                                    </h6>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="progress-text mb-0  spaceInWords matching">
                                        {{ count($matching_tools_and_technologies) ? implode(', ',
                                        $matching_tools_and_technologies) : '-' }}
                                    </h6>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="progress-text mb-0  spaceInWords missing">
                                        {{ count($missing_tools_and_technologies) ? implode(', ',
                                        $missing_tools_and_technologies) : '-' }}

                                    </h6>
                                </div>
                            </div>
                            <div class="row line">
                                <div class="col-sm-4 mb-5" align="left">
                                    <h6 class="progress-text mb-0 d-block "> {{ strtoupper('Roles') }}
                                    </h6>
                                </div>
                                <div class="col-sm-4 mb-5">
                                    <h6 class="progress-text mb-0  spaceInWords matching">
                                        {{ count($matching_role) ? implode(', ', $matching_role) : '-' }}
                                    </h6>
                                </div>
                                <div class="col-sm-4 mb-5">
                                    <h6 class="progress-text mb-0  spaceInWords missing">
                                        {{ count($missing_role) ? implode(', ', $missing_role) : '-' }}
                                    </h6>
                                </div>
                            </div>
                            <div class="row line">
                                <div class="col-sm-4 mb-5" align="left">
                                    <h6 class="progress-text mb-0  d-block "> {{ strtoupper('Skills') }}
                                    </h6>
                                </div>
                                <div class="col-sm-4 mb-5">
                                    <h6 class="progress-text mb-0  spaceInWords matching">
                                        {{ count($matching_concepts) ? implode(', ', $matching_concepts) : '-' }}
                                    </h6>
                                </div>
                                <div class="col-sm-4 mb-5">
                                    <h6 class="progress-text mb-0  spaceInWords missing">
                                        {{ count($missing_concepts) ? implode(', ', $missing_concepts) : '-' }}
                                    </h6>
                                </div>
                            </div>
                            <div class="row line">
                                <div class="col-sm-4 mb-5" align="left">
                                    <h6 class="progress-text mb-0  d-block ">
                                        {{ strtoupper('Educations') }}
                                    </h6>
                                </div>
                                <div class="col-sm-4 mb-5">
                                    <h6 class="progress-text mb-0  spaceInWords matching">
                                        {{ count($matching_education) ? implode(', ', $matching_education) : '-' }}
                                    </h6>
                                </div>
                                <div class="col-sm-4 mb-5">
                                    <h6 class="progress-text mb-0  spaceInWords missing">
                                        {{ count($missing_education) ? implode(', ', $missing_education) : '-' }}
                                    </h6>
                                </div>
                            </div>
                            <div class="row line">
                                <div class="col-sm-4 mb-5" align="left">
                                    <h6 class="progress-text mb-0  d-block ">
                                        {{ strtoupper('Years Of Experience') }}
                                    </h6>
                                </div>
                                <div class="col-sm-4 mb-5">
                                    <h6 class="progress-text mb-0  spaceInWords matching">
                                        {{ count($matching_yrs_of_exp) ? implode(', ', $matching_yrs_of_exp) : '-' }}
                                    </h6>
                                </div>
                                <div class="col-sm-4 mb-5">

                                    <h6 class="progress-text mb-0  spaceInWords missing">
                                        {{ count($missing_yrs_of_exp) ? implode(', ', $missing_yrs_of_exp) : '-' }}
                                    </h6>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>