<?php
include 'includes/regular/require.php';

$privateKey = ($userData['hasShared'] == true ? $userData['keys']['private'][array_rand($userData['keys']['private'])] : '????????????');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Affiliate</title>
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <style>
        .margin-top-24{
            margin-top: 24px;
        }
        .margin-top-12{
            margin-top: 12px;
        }
        .margin-bottom-12{
            margin-bottom: 12px;
        }
        .margin-bottom-24{
            margin-bottom: 24px;
        }
        .display-none{
            display: none;
        }

        .fsPage{
            color: #fff;
        }
    </style>

</head>
<body>

<?php include 'includes/regular/header.php'; ?>

<div class="container-fluid" style="margin-top: 10%;">
    <div class="row">
        <div class="col-md-12">

            <form method="post" id="home-stayupdatedform" novalidate enctype="multipart/form-data" action="https://www.formstack.com/forms/index.php" class="fsForm fsSingleColumn fsMaxCol1" id="fsForm2953562">

                <input type="hidden" name="form" value="2953562" />
                <input type="hidden" name="viewkey" value="wQlWYo8luR" />
                <input type="hidden" name="hidden_fields" id="hidden_fields2953562" value="" />
                <input type="hidden" name="_submit" value="1" />
                <input type="hidden" name="incomplete" id="incomplete2953562" value="" />
                <input type="hidden" name="incomplete_password" id="incomplete_password2953562" />
                <input type="hidden" name="style_version" value="3" />
                <input type="hidden" id="viewparam" name="viewparam" value="756411" />
                <div id="requiredFieldsError" style="display:none;">Please fill in a valid value for all required fields</div>
                <div id="invalidFormatError" style="display:none;">Please ensure all values are in a proper format.</div>
                <div id="resumeConfirm" style="display:none;">Are you sure you want to leave this form and resume later?</div>
                <div id="resumeConfirmPassword" style="display: none;">Are you sure you want to leave this form and resume later? If so, please enter a password below to securely save your form.</div>
                <div id="saveAndResume" style="display: none;">Save and Resume Later</div>
                <div id="saveResumeProcess" style="display: none;">Save and get link</div>
                <div id="fileTypeAlert" style="display:none;">You must upload one of the following file types for the selected field:</div>
                <div id="embedError" style="display:none;">There was an error displaying the form. Please copy and paste the embed code again.</div>
                <div id="applyDiscountButton" style="display:none;">Apply Discount</div>
                <div id="dcmYouSaved" style="display:none;">You saved</div>
                <div id="dcmWithCode" style="display:none;">with code</div>
                <div id="submitButtonText" style="display:none;">Submit Form</div>
                <div id="submittingText" style="display:none;">Submitting</div>
                <div id="validatingText" style="display:none;">Validating</div>
                <div id="autocaptureDisabledText" style="display:none;"></div>
                <div id="paymentInitError" style="display:none;">There was an error initializing the payment processor on this form. Please contact the form owner to correct this issue.</div>
                <div id="checkFieldPrompt" style="display:none;">Please check the field: </div>
                <div class="col-md-6 col-md-offset-3">
                    <div class="fsPage" id="fsPage2953562-1">
                        <div class="fsSection fs1Col">
                            <div id="fsRow2953562-1" class="fsRow fsFieldRow fsLastRow">
                                <div class="fsRowBody fsCell fsFieldCell fsFirst fsLast fsLabelHorizontal fsSpan100" id="fsCell60699138" aria-describedby="fsSupporting60699138" lang="en" fs-field-type="text">
                                    <label id="label60699138" class="fsLabel fsRequiredLabel" for="field60699138">http://ternio.me/<span class="fsRequiredMarker">*</span>                    </label>
                                    <div class="fsFieldHorizontal">
                                        <input type="text" id="field60699138" name="field60699138" size="50" required maxlength="25" value="" class="home-stayupdatedaff fsField fsRequired form-control" aria-required="true" placeholder="ENTER YOUR CUSTOM SLUG.."/>
                                        <div id="fsSupporting60699138" class="fsSupporting">Letters and Numbers Only!</div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div id="fsRow2953562-2" class="fsRow fsFieldRow fsLastRow margin-top-24">
                                <div class="fsRowBody fsCell fsFieldCell fsFirst fsLast fsLabelHorizontal fsSpan100" id="fsCell60757936" lang="en" fs-field-type="email">
                                    <label id="label60757936" class="fsLabel" for="field60757936">Enter Your Email Address</label>
                                    <div class="fsFieldHorizontal">
                                        <input type="email" id="field60757936" name="field60757936" size="50" value="<?php echo $userData['email']; ?>" class="home-stayupdatedemailaff form-control fsField fsFormatEmail" placeholder="EMAIL ADDRESS.."/>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <div id="fsSubmit2953562" class="fsSubmit fsPagination margin-top-12">
                        <button type="button" id="fsPreviousButton2953562" class="fsPreviousButton" value="Previous Page" style="display:none;" aria-label="Previous"><span class="fsFull">Previous</span><span class="fsSlim">&larr;</span></button>
                        <button type="button" id="fsNextButton2953562" class="fsNextButton" value="Next Page" style="display:none;" aria-label="Next"><span class="fsFull">Next</span><span class="fsSlim">&rarr;</span></button>
                        <input id="fsSubmitButton2953562" class="home-affstayupdatedsend fsSubmitButton btn btn-primary" style="display: block;" type="submit" value="GENERATE MY AFFILIATE URL!" />
                        <div class="clear"></div>
                    </div>
                </div>

                <script type="text/javascript" src="//static.formstack.com/forms/js/3/jquery.min.js"></script>
                <script type="text/javascript" src="//static.formstack.com/forms/js/3/jquery-ui.min.js"></script>
                <script type="text/javascript" src="//static.formstack.com/forms/js/3/scripts.js"></script>
                <script type="text/javascript" src="//static.formstack.com/forms/js/3/analytics.js"></script>
                <script type="text/javascript" src="//static.formstack.com/forms/js/3/google-phone-lib.js"></script>
                <script type="text/javascript">
                    (function() {
                        if (typeof sessionStorage !== 'undefined' && sessionStorage.fsFonts) {
                            document.documentElement.className = document.documentElement.className += ' wf-active';
                        }
                        var pre = document.createElement('link');
                        pre.rel  = 'preconnect';
                        pre.href = 'https://fonts.googleapis.com/';
                        pre.setAttribute('crossorigin', '');
                        var s = document.getElementsByTagName('head')[0];
                        s.appendChild(pre);
                        var fontConfig = {
                            google: {
                                families: [
                                    'Lato:400,700'
                                ]
                            },
                            timeout: 2000,
                            active: function() {
                                if (typeof sessionStorage === 'undefined') {
                                    return;
                                }
                                sessionStorage.fsFonts = true;
                            }
                        };
                        if (typeof WebFont === 'undefined') {
                            window.WebFontConfig = fontConfig;
                            var wf = document.createElement('script');
                            wf.type  = 'text/javascript';
                            wf.async = 'true';
                            wf.src   = ('https:' == document.location.protocol ? 'https' : 'http') +
                                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
                            s.appendChild(wf);
                        } else {
                            WebFont.load(fontConfig);
                        }
                    })();
                    if(window.addEventListener) {
                        window.addEventListener('load', loadFormstack, false);
                    } else if(window.attachEvent) {
                        window.attachEvent('onload', loadFormstack);
                    } else {
                        loadFormstack();
                    }
                    function loadFormstack() {
                        var form2953562 = new Formstack.Form(2953562, 'https://www.formstack.com/forms/');
                        form2953562.logicFields = [];
                        form2953562.calcFields = [];
                        form2953562.dateCalcFields = [];
                        form2953562.init();
                        form2953562.plugins.analytics = new Formstack.Analytics('https://www.formstack.com', 2953562, form2953562);
                        form2953562.plugins.analytics.trackTouch();
                        form2953562.plugins.analytics.trackBottleneck();
                        window.form2953562 = form2953562;
                    };
                </script>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="assets/ajax/app.js"></script>

<script>
    $(document).ready(function(){

    });
</script>
</body>
</html>
