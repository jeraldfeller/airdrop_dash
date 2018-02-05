<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Password Reset</title>

    <link href="assets/css/style.css?v=1.0" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="" />
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
    <style>
        .margin-top-24{
            margin-top: 24px;
        }
        .margin-top-12{
            margin-top: 12px;
        }
        .margin-left-12{
            margin-left: 12px;
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

        .help-info{
            color: #ffffff;
            display: block;
        }
        .success-message{
            color: #fff;
        }
        .success-message a{
            color: #fff;
        }

    </style>

</head>
<body>

<div class="container-fluid formfield-wrap">
    <div class="row align-items-center formfield-margin">
        <div class="col-md-12 ">
            <div class="col-md-6 col-md-offset-3 panel panel-default">
                <div class="formlogo"></div>
                <div><h5 class="warning-box"></h5></div>

                    <h4 class="text-center formtitletag">Password Reset</h4>
                    <div class="reset-form-container">
                        <div class="login-container">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="col-md-12 text-center margin-bottom-12">
                                <button class="btn btn-default submit-btn send-btn">Send Confirmation Code</button>
                            </div>
                        </div>
                    </div>
                    <div class="reset-form-input-container display-none">
                        <div class="login-container">
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" id="code">
                                <small class="help-info">*please see confirmation code sent in your email.</small>
                            </div>
                            <div class="form-group  margin-top-24">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="password">
                            </div>
                            <div class="col-md-12 text-center margin-bottom-12">
                                <button class="btn btn-default submit-btn change-btn">Change Password</button>
                            </div>
                        </div>
                    </div>


            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="assets/ajax/app.js"></script>

<script>
    $(document).ready(function(){
        $('.send-btn').on('click', function(){
            $email = $('#email').val();
            if($email != ''){
                $data = {
                    email: $email,
                };
                $.ajax({
                    url: 'Controller/user.php?action=request-password-reset',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if(data.success == true){
                            $('.warning-box').html('');
                            $('.reset-form-container').addClass('display-none');
                            $('.reset-form-input-container').removeClass('display-none');
                        }else{
                            $('.warning-box').html(data.message);
                        }
                    },
                    data: {param: JSON.stringify($data)}
                });
            }else{
                alert('Please input email address');
            }
        });

        $('.change-btn').on('click', function(){
            $email = $('#email').val();
            $password = $('#password').val();
            $code = $('#code').val();
            if($email != ''){
                $data = {
                    email: $email,
                    password: $password,
                    code: $code
                };
                $.ajax({
                    url: 'Controller/user.php?action=password-reset',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if(data.success == true){
                            $('.warning-box').html('');
                            $('.reset-form-input-container').find('.login-container').html('<h4 class="success-message">'+data.message+'</h4>');
                        }else{
                            $('.warning-box').html(data.message);
                        }
                    },
                    data: {param: JSON.stringify($data)}
                });
            }else{
                alert('Please input email address');
            }
        });
    });
</script>
</body>
</html>
