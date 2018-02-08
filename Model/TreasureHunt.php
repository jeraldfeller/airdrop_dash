<?php

class TreasureHunt extends Users
{
    public $debug = TRUE;
    protected $db_pdo;

    public function startGame($data){
        $pdo = $this->getPdo();
        $sql = 'SELECT `id` FROM `treasure_hunt` WHERE `id` = 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            $sql = 'UPDATE `treasure_hunt` SET `treasure_number` = ' . $data['treasureNumber'] . ', `amount` = ' . $data['amount'] . ', `active` = true WHERE `id` = 1';
        }else{
            $sql = 'INSERT INTO `treasure_hunt` (`id`, `treasure_number`, `amount`, `active`) VALUES (1, '.$data['treasureNumber'].','.$data['amount'].', true)';
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return json_encode(
            true
        );
    }

    public function getTreasureHuntGameById(){
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `treasure_hunt` WHERE `id` = 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return json_encode($result);
    }

    public function getTreasureHuntGame($treasureNumber){
        $pdo = $this->getPdo();
        $sql = 'SELECT * FROM `treasure_hunt` WHERE `id` = 1 AND `treasure_number` = '.$treasureNumber.'';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function submitPublicKey($data){
        $pdo = $this->getPdo();
        $result = $this->getTreasureHuntGame($data['treasureNumber']);
        $userId = $_SESSION['userData']['id'];

        $userPublicKey = $_SESSION['userData']['keys']['public'];
        $winner = '';
        if($userPublicKey == $data['publicId']){
            if($result){
                if($result['active'] == true){
                    $amount = $result['amount'];
                    $_SESSION['userData']['points'] = $_SESSION['userData']['points'] + $amount;
                    $sql = 'UPDATE `treasure_hunt` SET `active` = false WHERE `id` = 1 AND `treasure_number` = '.$data['treasureNumber'].'';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();

                    $query = array(
                        'points' => "(`points` + $amount)"
                    );
                    $where = array(
                        'column' => '`id`',
                        'operator' => '=',
                        'value' => $userId
                    );
                    // update user, add funds
                    $this->updateUser($query, $where);

                    $sql = 'INSERT INTO `treasure_hunt_winners` (`user_id`, `amount`) VALUES ('.$userId.', '.$result['amount'].')';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $success = true;
                    $winner = true;
                    $message = 'Congratulations you won the treasure, ' . $result['amount'] . ' points added to your account.';
                }else{
                    $success = true;
                    $winner = false;
                    $message = 'Sorry, someone already got the treasure.';
                }
            }else{
                $success = true;
                $message = 'Sorry you got the wrong treasure number.';
            }
        }else{
            $success = false;
            $message = 'Public Id doesn\'t match in your account.';
        }

        return json_encode(
            array(
                'success' => $success,
                'winner' => $winner,
                'message' => $message
            )
        );


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