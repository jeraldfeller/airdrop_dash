<?php
include 'includes/admin/require.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Treasure Hunt</title>

    <link rel="icon" type="image/x-icon" href="" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
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
        .game-indicator{
            color: #26C281;
        }

    </style>

</head>
<body>
<?php include 'includes/admin/header.php'; ?>


<div class="container-fluid" style="margin-top: 10%;">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2 col-md-offset-5">
                <div class="register-container">
                    <div class="form-group">
                        <label for="generateCount">Amount</label>
                        <label class="pull-right game-status text-success display-none"><small><i class="fa fa-circle"></i> <span class="status">active</span></small></label>
                        <input type="number" class="form-control" id="amount">
                    </div>
                    <div class="form-group">
                        <label for="treasureNumber">Treasure #</label>
                        <input type="number" min="1" max="10" class="form-control" id="treasureNumber">
                    </div>

                </div>
            </div>
            <div class="col-md-2 col-md-offset-5">
                <button class="btn btn-default submit-btn" style="width: 100%;">SUBMIT</button>
            </div>
        </div>
    </div>




</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="assets/ajax/app.js"></script>

<script>
    $(document).ready(function(){

        $.get( "Controller/treasure-hunt.php?action=get-game", function( data ) {
            if(data != 'false'){
                $data = jQuery.parseJSON(data);
                $('#treasureNumber').val($data.treasure_number);
                $('#amount').val($data.amount);
                if($data.active == '1'){
                    $('.game-status').removeClass('display-none').removeClass('text-danger').addClass('text-success').find('.status').text('active');
                }else{
                    $('.game-status').removeClass('display-none').removeClass('text-success').addClass('text-danger').find('.status').text('complete');
                }
            }
        });
        $('.submit-btn').unbind().on('click', function(){
            $(this).html('<i class="fa fa-spinner fa-spin"></i>');
            $treasureNumber = $('#treasureNumber').val();
            $amount = $('#amount').val();
            if($treasureNumber >= 1 && $treasureNumber <= 10){
                $.ajax({
                    url: 'Controller/treasure-hunt.php?action=start-game',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        $('.submit-btn').html('SUBMIT');
                        $('.game-status').removeClass('display-none').removeClass('text-danger').addClass('text-success').find('.status').text('active');
                    },
                    data: {param: JSON.stringify({treasureNumber: $treasureNumber, amount: $amount})}
                });
            }else{
                alert('Treasure number must be 1-10.');
                $(this).html('SUBMIT');
            }

        });

    });
</script>
</body>
</html>
