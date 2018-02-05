<?php
include 'includes/regular/require.php';

$privateKey = ($userData['hasShared'] == true ? $userData['keys']['private'][array_rand($userData['keys']['private'])] : '????????????');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Main</title>
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

        .showafflink-url{
            display: block;
            width: 100%;
            height: 44px;
            padding: 5px 24px;
            font-size: 18px;
            line-height: 2;
            color: #fff;
            background-color: #222222;
            background-image: none;
            border: 1px solid #0f0f0f;
            border-radius: 4px;
        }
        .url-link-container{
            color: #fff;
        }
    </style>

</head>
<body>

<?php include 'includes/regular/header.php'; ?>

<div class="container-fluid" style="margin-top: 10%;">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6 col-md-offset-3">
                <div class="url-link-container">
                    <label for="urlLink" class="text-bold">YOUR AFFILIATE LINK</label>
                    <div class="showafflink-url text-center" id="urlLink">

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
        $urlParam = function(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            return results[1];
        }
        var ternioMe = $urlParam('terniome');

        $affiliateUrl = 'http://ternio.me/' + ternioMe;
        $('.showafflink-url').html($affiliateUrl);
        $.ajax({
            url: 'Controller/user.php?action=update-affiliate-url',
            type: 'post',
            dataType: 'json',
            success: function (data) {
            },
            data: {param: JSON.stringify({
                    userId: <?php echo $userData['id']; ?>,
                    affiliateUrl: encodeURIComponent($affiliateUrl)
                }
            )}
        });
    });
</script>
</body>
</html>
