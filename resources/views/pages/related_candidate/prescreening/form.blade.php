<!DOCTYPE html>
<html lang="en">
<head>
	<title>Candidate Form</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/prescreening/jquery.convform.css') }}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/prescreening/demo.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/prescreening/style.css') }}">
	<link rel="shortcut icon" href="https://white-force.com/mail_assets/whiteforcelogo.png" type="image/x-icon">
   
</head>
<body>
	<div class="logo_desktop">
        <img src="{{ url('assets/prescreening/white-force-logo29-06.png') }}" alt="">
    </div>

    <header class="forms-container header">
        <div class="chatbot-header">
            <img src="https://white-force.com/mail_assets/whiteforcelogo.png" alt="">
            <h2>Prescreening</h2>
            <i class="bi bi-chat-dots-fill"></i>
        </div>
    </header>
	<section class="forms-container">
		<div class="note">
            <!-- <marquee attribute_name = "attribute_value"....more attributes>
                <span>Note:</span> This link is valid till {{ date('d-m-Y',strtotime($candidate_data->expire_date))}}
            </marquee> -->
        </div>
		<div id="chat" class="conv-form-wrapper">
			<form action="{{ url('prescreening/store-data').'/'.$candidate_data->id }}" method="post" class="hidden" style="top:-58px; bottom: 36px;" id="submit_form">
                <!--introduction-->
                <input type="text" data-conv-question="Hello, I am {{ $candidate_data->sendBy->name }} From White-Force!! Congratulations!! 🎉🎉🎉 {{ !empty($candidate_data->candidate->name) ? ucwords(strtolower($candidate_data->candidate->name)) : ''}},  Your profile has been shortlisted for the position of {{ $candidate_data->position->position_name }}." data-no-answer="true">
                <select data-conv-question="Please answer a few questions to get your interview schedule.<br>So, Are you interested for this position?" name="is_interested" id="is_interested">
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select>

                <!--Is Experienced-->
                <select data-conv-question="Do you have work experience?" name="is_exp" id="is_exp">
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select>

                <div data-conv-fork="is_exp">
                    <div data-conv-case="yes">
                       <!--Experience year--> 
                       <select data-conv-question="How much experience you have?" name="exp_year" id="exp_year">
                            <option value="0-5">0-5 Years</option>
                            <option value="5-10">5-10 Years</option>
                            <option value="10-15">10-15 Years</option>
                            <option value="15-20">15-20 Years</option>
                            <option value="20-25">20-25 Years</option>
                            <option value="25-30">25-30 Years</option>
                            <option value="30-35">30-35 Years</option>
                            <option value="35+">35+ Years</option>
                        </select>

                        <!--Current CTC-->
                        <select data-conv-question="What is your current CTC?" name="current_ctc" id="current_ctc">
                            <option value="0-5">0-5 LPA</option>
                            <option value="5-10">5-10 LPA</option>
                            <option value="10-15">10-15 LPA</option>
                            <option value="15-20">15-20 LPA</option>
                            <option value="20-25">20-25 LPA</option>
                            <option value="25-30">25-30 LPA</option>
                            <option value="30-35">30-35 LPA</option>
                            <option value="35+">35+ LPA</option>
                        </select>

                        <!--Expected CTC-->
                        <select data-conv-question="What is your expected CTC?" name="exp_ctc" id="exp_ctc">
                            <option value="As per company norms">As per company norms</option>
                            <option value="10-20%">10-20% Hike</option>
                            <option value="20-30%">20-30% Hike</option>
                            <option value="30-40%">30-40% Hike</option>
                        </select>

                        <!--Notice period-->
                        <select data-conv-question="What is your notice period?" name="notice_period" id="notice_period">
                            <option value="10">10 Days</option>
                            <option value="15">15 Days</option>
                            <option value="30">30 Days</option>
                            <option value="45">45 Days</option>
                            <option value="60">60 Days</option>
                            <option value="Immidiate Joining">Immidiate Joining</option>
                        </select>
                    </div>
                    <div data-conv-case="no">
                        <!--Expected CTC-->
                        <select data-conv-question="What is your expected CTC?" name="exp_ctc" id="exp_ctc">
                            <option value="0-2">0-2 LPA</option>
                            <option value="2-5">2-5 LPA</option>
                            <option value="5-7">5-7 LPA</option>
                            <option value="7-10">7-10 LPA</option>
                            <option value="10+">10+ LPA</option>
                        </select>
                    </div>
                </div>
                
                <!--Relocate-->
                <select data-conv-question="Are you interested to relocate?" name="relocate" id="relocate">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>

                <!--Confirmation Mobile Number-->
                <select data-conv-question="Please confirm {{ $candidate_data->candidate->mobile  }} is your correct mobile number?" name="mobile_confirm" id="mobile_confirm">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <div data-conv-fork="mobile_confirm">
                    <div data-conv-case="no">
                        <input type="number" data-conv-question="Please add correct mobile number" name="changed_mobile" id="changed_mobile">
                    </div>
                </div>

                <!--Confirmation Email-->
                <select data-conv-question="Please confirm {{ $candidate_data->candidate->email  }} is your correct email?" name="email_confirm" id="email_confirm">
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <div data-conv-fork="email_confirm">
                    <div data-conv-case="no">
                        <input type="email" data-conv-question="Please add correct email" name="changed_email" id="changed_email">
                    </div>
                </div>
                        
                <!--Confirm-->
                <select data-conv-question="Please confirm do you want to submit all the above details or want to reload this conversation" id="">
                    <option data-callback="submitfunction" value="yes">Confirm!</option>
                    <option data-callback="reloadfunction" value="yes">Reload!</option>
                </select>

			</form>
		</div>
    </section>
    <script>
        var user_image =  '<img src="{{ $candidate_data->sendBy->thumb() }}"/>';
        var candidate_image = '<img src="{{ $candidate_image }}"/>';
    </script>
	<script type="text/javascript" src="{{ url('assets/prescreening/jquery-1.12.3.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/prescreening/autosize.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/prescreening/jquery.convform.js') }}"></script>

	<script>
		function submitfunction(){
            $("#submit_form").submit();
		}

        function reloadfunction(){
            location.reload();
        }
		function google(stateWrapper, ready) {
			window.open("https://google.com");
			ready();
		}
		function bing(stateWrapper, ready) {
			window.open("https://bing.com");
			ready();
		}
		var rollbackTo = false;
		var originalState = false;
		function storeState(stateWrapper, ready) {
			rollbackTo = stateWrapper.current;
			console.log("storeState called: ",rollbackTo);
			ready();
		}
		function rollback(stateWrapper, ready) {
			console.log("rollback called: ", rollbackTo, originalState);
			console.log("answers at the time of user input: ", stateWrapper.answers);
			if(rollbackTo!=false) {
				if(originalState==false) {
					originalState = stateWrapper.current.next;
						console.log('stored original state');
				}
				stateWrapper.current.next = rollbackTo;
				console.log('changed current.next to rollbackTo');
			}
			ready();
		}
		function restore(stateWrapper, ready) {
			if(originalState != false) {
				stateWrapper.current.next = originalState;
				console.log('changed current.next to originalState');
			}
			ready();
		}
	</script>
	<script>
		jQuery(function($){
			convForm = $('#chat').convform({selectInputStyle: 'disable'});
			console.log(convForm);
		});
	</script>
</body>
</html>