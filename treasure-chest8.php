<?php
include 'includes/regular/require.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Treasure Chest 1</title>

    <link rel="icon" type="image/x-icon" href="" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
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
        .input-sm{
            margin-left: 0 !important;
        }
        .show-info{
            cursor: pointer;
        }
        .delete-key{
            cursor: pointer;
        }
        .message-container{
            color: #fff;
        }

    </style>

</head>
<body>
<?php include 'includes/regular/header.php'; ?>


<div class="container-fluid" style="margin-top: 10%;">
    <div class="row margin-top-24">
        <div class="col-md-12">
            <div class="col-md-4 col-md-offset-4">
                <div class="col-md-12"></div>
                <div><h5 class="warning-box"></h5></div>
                <div class="col-md-12 register-container">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="generateCount">Public ID</label>
                            <input type="text" class="form-control" id="publicId" style="width: 100% !important;">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-default submit-btn" style="width: 100%;">SUBMIT</button>
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

        $('.submit-btn').unbind().on('click', function(){
            $(this).html('<i class="fa fa-spinner fa-spin"></i>');
            $publicId = $('#publicId').val();
            if($publicId != ''){
                $.ajax({
                    url: 'Controller/treasure-hunt.php?action=submit-key',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if(data.success == true){
                            $('.warning-box').text('');
                            $('.register-container').addClass('text-center').html('<h4 class="message-container">'+data.message+'</h4>');
                        }else{
                            $('.warning-box').text(data.message);
                        }

                        $('.submit-btn').html('SUBMIT');
                    },
                    data: {param: JSON.stringify({publicId: $publicId, treasureNumber: 8})}
                });
            }else{
                alert('Please provide public key.');
                $(this).html('SUBMIT');
            }

        });
    });
</script>
</body>
</html>
