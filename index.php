
<?php

    //include_once('easebuzz_lib/easebuzz_PAYMENT_GATEWAY.PHP');
   // if(isset($_POST['submit']))
   //     $name = $_POST['name']; 
   //     $email = $_POST['email'];
   //     $phone = $_POST['phone'];
   //     $amount = $_POST['amount'];   
        
   //     $MERCHANT_KEY = "10PBP71ABZ2";
   //     $SALT = "ABC55E8IBW";
   //     $ENV = "test";    //set environment Name

        // when successfully register done then get MERCHANT_KEY and SALT through email

   //     $easebuzzObj = new Easebuzz($MERCHANT_KEY, $SALT, $ENV)
        
    //    $txnid = 'Test' .rand(1,100);

  //      $con = mysqli_connet('localhost','root','','youtube');

    //    mysqli_query($con, "insert into payment(textId,name,email,phone,amount,status,paymentId) values('$txnid','$name','$email','$phone','$amount','pending','')");

    //    $txnid = 'Test' .rand(1,100);

    //    $postData = array ( 
    //        "txnid" => $txnid, 
    //        "amount" => $amount.'.0', 
    //        "firstname" => $name, 
    //        "email" => $email, 
    //        "phone" => $phone, 
    //        "productinfo" => "For test", 
    //        "surl" => "http://localhost:3000/youtube/easebuzz/success.php", 
    //        "furl" => "http://localhost:3000/youtube/easebuzz/failed.php", 
           
    //    );
    
     //   $data = $easebuzzObj->initiatePaymentAPI($postData);    
    //    print_r($data);

        // now store data
    //}

   ///
  
?>

 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easebuzz</title>
</head>
<body>
    <form action="paymentForm" method="post">
        <label for="Name">Name</label><br/>
        <input type="text" name="name" id="name"><br/>

        <label for="email">Email</label><br/>
        <input type="text" name="email" id="email"><br/>

        <label for="phone">Phone</label><br/>
        <input type="text" name="phone" id="phone"><br/>

        <label for="amount">Amount</label><br/>
        <input type="text" name="amount" id="amount"><br/> <br/>

        <input type="submit" name="submit">
    </form>

    <script src="http://code.jquery.com/jquery-3.6.0.min.js">
    </script>

    <script src="https://ebz-static.s3.ap-south-1.amazonaws.com/
    easecheckout/easebuzz-checkout.js"></script>


    <srcipt>
        
        $('#paymentForm').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url : 'pay.php',
                type : 'post',
                data : $('#paymentForm').serialize(),
                success : function(data){
                    var easebuzzCheckout = new EasebuzzCheckout('2PBP7IABZ2','test');

                    var access_key = JSON.parse(data).data;
                    var options = {
                        access_key: access_key, // access key received via Initiate payment
                        onResponse: (response) => {
                            var pid = response.easepayid;
                            var txnid = response.txnid;
                            var surl = response.surl;
                            $.ajax({
                                url : 'checkoutPay.php',
                                type : 'post',
                                data : {pid:pid,txnid:txnid},
                                success: function(data){
                                    if(data == 1){
                                        window.location.href = surl;
                                    }
                                }
                            })                           
                        },
                        theme: "#123456" // color hex
                        }
                        easebuzzCheckout.initatePayment(options);
                }
            });
        });
       
    </srcipt>


</body>
</html>

