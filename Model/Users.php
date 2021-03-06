<?php


class Users extends Mail
{
    public $debug = FALSE;
    protected $db_pdo;

    public function userLoginFunction($data)
    {

        // check if credential match

        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `users` WHERE `email` = "' . $data['email'] . '" AND `password` = "' . $data['password'] . '" AND `user_level` = "regular"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result != false){
            if($result['confirmed'] == true){
                    $privateKeys = array($result['private_key_1'],$result['private_key_2'],$result['private_key_3']);
                    $return = array('success' => true,
                        'id' => $result['id'],
                        'firstName' => $result['first_name'],
                        'lastName' => $result['last_name'],
                        'email' => $result['email'],
                        'password' => $result['password'],
                        'hasShared' => $result['has_shared'],
                        'points' => $result['points'],
                        'keys' => array(
                            'public' => $result['public_key'],
                            'private' => $privateKeys
                        ),
                        'userLevel' => $result['user_level']
                    );

                    $_SESSION['isLoggedIn'] = true;
                    $_SESSION['userData'] = $return;

                    $success = true;
                    $response = array($return);

            }else{
                $success = false;
                $response = array(
                    'message' => 'Email address is not yet confirmed, please check your email box.'
                );
            }

        }else{
            $success = false;
            $response = array(
                'message' => 'Incorrect email or password.'
            );
        }


        return
            json_encode(
                array(
                    'success' => $success,
                    'response' => $response
                )
        );
    }

    public function adminLoginFunction($data)
    {

        // check if credential match

        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `users` WHERE `email` = "' . $data['email'] . '" AND `password` = "' . $data['password'] . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result != false){
            if($result['user_level'] == 'admin'){
                $return = array('success' => true,
                    'id' => $result['id'],
                    'firstName' => $result['first_name'],
                    'lastName' => $result['last_name'],
                    'email' => $result['email'],
                    'password' => $result['password'],
                    'userLevel' => $result['user_level']
                );

                $_SESSION['isLoggedIn'] = true;
                $_SESSION['userData'] = $return;

                $success = true;
                $response = array($return);

            }else{
                $success = false;
                $response = array(
                    'message' => 'Account is not admin.'
                );
            }

        }else{
            $success = false;
            $response = array(
                'message' => 'Incorrect email or password.'
            );
        }


        return
            json_encode(
                array(
                    'success' => $success,
                    'response' => $response
                )
            );
    }

    public function registerAccountFunction($data)
    {
        // check duplicate email
        $userLevel = 'regular';
        $pdo = $this->getPdo();
        $sql = 'SELECT count(id) as totalCount FROM `users` WHERE `email` = "' . $data['email'] . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $mailerResponse = array();
        if($result['totalCount'] == 0){

            $confirmationToken = $this->generateRandomString();
            // generate Private/Public keys
            // check if key exists
            $publicKeyExists = true;
            while($publicKeyExists == true){
                $publicKey = $this->generateRandomString(8);
                $sql = 'SELECT  count(id) as totalCount FROM `users` WHERE `public_key` = "' . $publicKey . '"';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result['totalCount'] == 0){
                    $publicKeyExists = false;
                }
            }


            $privateKeyCount = 1;
            $privateKeys = array();
            while($privateKeyCount <= 3){
                $privateKey = $this->generateRandomString(8);

                $sql = 'SELECT count(id) as totalCount FROM `users` WHERE `private_key_1` = "' . $privateKey . '" OR `private_key_2` = "' . $privateKey . '" OR `private_key_3` = "' . $privateKey . '"';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result['totalCount'] == 0){
                    $privateKeys[] = $privateKey;
                    $privateKeyCount++;
                }
            }


            $sql = 'INSERT INTO `users` (`first_name`, 
                    `last_name`, 
                    `email`, 
                    `password`, 
                    `has_shared`, 
                    `confirmed`,
                    `points`,
                    `confirmation_token`,
                    `public_key`,
                    `private_key_1`,
                    `private_key_2`,
                    `private_key_3`,
                    `user_level`
                    ) VALUES ("' . $data['firstName'] . '", "' . $data['lastName'] . '", "' . $data['email'] . '", "' . $data['password'] . '", false, false, 0, "'.$confirmationToken.'", "' . $publicKey . '" , "' . $privateKeys[0] . '", "' . $privateKeys[1] . '", "' . $privateKeys[2] . '", "' . $userLevel . '")';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $userId = $pdo->lastInsertId();

            /*
            $privateKeyCount = 1;
            while($privateKeyCount <= 3){
                $privateKey = $this->generateRandomString(8);

                $sql = 'SELECT count(id) as totalCount FROM `user_keys` WHERE `user_key` = "' . $privateKey . '"';
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result['totalCount'] == 0){
                    $sql = 'INSERT INTO `user_keys` (`user_id`, 
                    `type`, 
                    `user_key`
                    ) VALUES ("' . $userId . '", "private", "' . $privateKey . '")';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();

                    $privateKeyCount++;
                }
            }
            */

            $domain = "https://airdrop.ternio.io";
            $subject = 'Email Confirmation';
            $message = 'Please click the link to complete the registration. <a href="'. $domain . '/dashboard/confirm-registration.php?userId='.$userId.'&token='.$confirmationToken.'">CLICK HERE</a>';

            $mailerResponse = $this->sendMail($subject, $message, $data['email']);


            /*
            // Send email confirmation
            $mgClient = new Mailgun('YOUR_API_KEY');
            $domain = "https://airdrop.ternio.io/";
            $subject = 'Email Confirmation';
            $message = 'Please click the link to complete the registration. <a href="'.$_SERVER['DOCUMENT_ROOT'] . '/dashboard/confirm-registration.php?userId='.$userId.'&token='.$confirmationToken.'">CLICK HERE</a>';

            # Make the call to the client.
            $result = $mgClient->sendMessage($domain, array(
                'from'    => 'postmaster@email.ternio.io',
                'to'      => $data['email'],
                'subject' => $subject,
                'text'    => $message
            ));

            $from = 'john.doe.s7edge@gmail.com';
            $subject = 'Email Confirmation';
            $message = 'Please click the link to complete the registration. <a href="'.DOMAIN.'/user/confirm-registration?userId='.$userId.'&token='.$token.'">CLICK HERE</a>';
            $this->sendEmail($from, $data['email'], $subject, $message);
            */
            $success = true;
            $response = array(
                'message' => 'THANK YOU FOR REGISTERING. <br> WE JUST SENT YOU AN EMAIL TO CONFIRM YOUR ACCOUNT. <br><br> PLEASE CHECK YOUR EMAIL BOX NOW'
            );
        }else{
            $success = false;
            $response = array(
                'message' => 'Email address already exists.'
            );
        }

        return
            json_encode(
                array(
                    'success' => $success,
                    'response' => $response,
                    'mailerResponse' => $mailerResponse
                )
        );

    }


    public function hasSharedAction($data)
    {
        $pdo = $this->getPdo();
        $sql = 'UPDATE `users` SET `has_shared` = true, `shared_on` = "' . $data['socialMedia']. '" WHERE `id` = '.$data['userId'].'';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $success = true;

        $userData = $_SESSION['userData'];
        $userData['hasShared'] = true;
        $_SESSION['userData'] = $userData;
        return
            json_encode(
                array(
                    'success' => $success,
                    'privateKey' => $userData['keys']['private'][0]
                )
        );
    }

    public function updateAffiliateUrlAction($data)
    {
        $pdo = $this->getPdo();
        $sql = 'UPDATE `users` SET `affiliate_link` = "' . urldecode($data['affiliateUrl']) . '" WHERE `id` = '.$data['userId'].'';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $success = true;
        return
            json_encode(
                $success
            );
    }


    public function getInfoAction($data)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `users` WHERE `id` = '.$data['id'].'';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $info = array();
        if($result){
            $firstName = $result['first_name'];
            $lastName = $result['last_name'];
            $email = $result['email'];
            $points = $result['points'];
            $publicKey = $result['public_key'];
            $privateKeys = array(
                array('column' => 'private_key_1', 'key' => $result['private_key_1']),
                array('column' => 'private_key_2', 'key' => $result['private_key_2']),
                array('column' => 'private_key_3', 'key' => $result['private_key_3']),
            );

            $info = array(
                'userId' => $data['id'],
                'points' => $points,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'keys' => array(
                    'public' => $publicKey,
                    'private' => $privateKeys
                )
            );
            $success = true;
        }else{
            $success = false;
        }

        return
            json_encode(
                array(
                    'success' => $success,
                    'info' => $info
                )
        );
    }

    public function updateUser($data, $where){
        $pdo = $this->getPdo();
        $query = '';
        $i = 1;
        $length = count($data);
        foreach($data as $key => $value){
            if($i == $length){
                $query .= '`'.$key.'` = '.$value.'';
            }else{
                $query .= '`'.$key.'` = '.$value.', ';
            }
        }
        if(count($where) > 0){
            $where = 'WHERE '.$where['column'] . $where['operator'] . $where['value'];
        }else{
            $where ='';
        }

        $sql = 'UPDATE `users` SET '. $query . ' ' . $where .'';
        $stmt = $pdo->prepare($sql);


        $stmt->execute();
    }


    public function deleteKeyAction($data)
    {
        $pdo = $this->getPdo();
       // $sql = 'DELETE FROM `user_keys` WHERE `id` = '.$data['id'].'';
        $sql = 'UPDATE `users` SET `'.$data['column'].'` = "" WHERE `id` = '.$data['id'] . '';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return json_encode(true);
    }

    public function editPointsAction($data)
    {
        $info = array();

        $pdo = $this->getPdo();
        if($data['action'] == 'add'){
            $sql = 'UPDATE `users` SET `points` = (`points` + '.$data['points'].') WHERE `id` = '.$data['id'] . '';
        }else{
            $sql = 'UPDATE `users` SET `points` = (`points` - '.$data['points'].') WHERE `id` = '.$data['id'] . '';
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $sql = 'SELECT * FROM `users` WHERE `id` = "' . $data['id'] . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $info = array(
            'points' => $result['points']
        );


        return
            json_encode(
                array(
                    'success' => true,
                    'info' => $info
                )
        );
    }


    public function confirmRegistrationFunction($data)
    {
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `users` WHERE `id` = "' . $data['userId'] . '" AND `confirmation_token` = "' . $data['token'].'"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            $sql = 'UPDATE `users` SET `confirmed` = true WHERE `id` = '.$result['id'].'';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $success = true;
        }else{
            $success = false;
        }

        return $success;
    }

    public function requestPasswordResetAction($data){
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `users` WHERE `email` = "' . $data['email'] . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $mailerResponse = array();
        if($result){
            $code = $this->generateRandomString(6);
            $sql = 'UPDATE `users` SET `password_reset_code` = "' . $code . '" WHERE `id` = ' . $result['id'] . '';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $mailerResponse = $this->sendMail('Password Confirmation Code', 'Code: ' . $code, $result['email']);
            $success = true;
            $message = '';

        }else{
            $success = false;
            $message = 'Invalid email, please try again.';
        }

        return json_encode(
            array(
                'success' => $success,
                'message' => $message,
                'mailerResponse' => $mailerResponse
            )
        );
    }

    public function changePasswordAction($data){
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `users` WHERE `email` = "' . $data['email'] . '" AND `password_reset_code` = "' . $data['code'] . '"';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            $sql = 'UPDATE `users` SET `password` = "' . $data['password'] . '", `password_reset_code` = "" WHERE `id` = ' . $result['id'] . '';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $message = 'Password Successfully Changed. <a href="login.php">Login</a>';
            $success = true;
        }else{
            $success = false;
            $message = 'Invalid code.';
        }

        return json_encode(
            array(
                'success' => $success,
                'message' => $message
            )
        );
    }




    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function pdoQuoteValue($value)
    {
        $pdo = $this->getPdo();
        return $pdo->quote($value);
    }

    public function getPdo()
    {
        if (!$this->db_pdo)
        {
            if ($this->debug)
            {
                $this->db_pdo = new PDO(DB_DSN_MAIN, DB_USER_MAIN, DB_PWD_MAIN, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            }
            else
            {
                $this->db_pdo = new PDO(DB_DSN_MAIN, DB_USER_MAIN, DB_PWD_MAIN);
            }
        }
        return $this->db_pdo;
    }
}