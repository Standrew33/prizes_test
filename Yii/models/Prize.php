<?php
include_once 'dbConnect.php';

    class Prize {

        //Get prize
        function getPrize() {
            srand(make_seed());
            $numPrize = rand(1, 3);

            switch ($numPrize) {
                case 1:
                    $mysqliWork = new dbConnect();
                    $connect = $mysqliWork->openConnection();

                    $result = $connect->query("SELECT * FROM t_money");
                    $row = $result->fetch_assoc();

                    $moneyPrize = rand($row['minInterval'], $row['maxInterval']);

                    if ($row['total'] - $moneyPrize < 0)
                    {
                        $moneyPrize = $row['total'];
                        $row['total'] = 0;
                    }
                    else $row['total'] -= $moneyPrize;

                    $result = $connect->query("UPDATE t_money SET total = '$row[total]'");
                    $mysqliWork->closeConnection();

                    return json_encode((object) ['prize' => $moneyPrize,
                                     'type' => 1]);
                    break;
                case 2:
                    $mysqliWork = new dbConnect();
                    $connect = $mysqliWork->openConnection();

                    $result = $connect->query("SELECT * FROM t_bonus");
                    $row = $result->fetch_assoc();

                    $mysqliWork->closeConnection();
                    return json_encode((object) ['prize' => rand($row['minInterval'], $row['maxInterval']),
                                     'type' => 2]);
                    break;
                case 3:
                    $listObject = null;
                    $mysqliWork = new dbConnect();
                    $connect = $mysqliWork->openConnection();

                    $result = $connect->query("SELECT * FROM t_subject");
                    while($row = $result->fetch_assoc()) {
                        $listObject[] = $row;
                    }

                    if (count($listObject) != 0)
                    {
                        $index = rand(0, count($listObject) - 1);
                        $id = $listObject[$index]['id'];
                        $objectPrize = $listObject[$index]['object'];

                        $result = $connect->query("DELETE FROM t_subject WHERE id = '$id'");
                        $mysqliWork->closeConnection();

                        return json_encode((object) ['prize' => $objectPrize,
                                         'type' => 3, 'index' => $listObject[$index]['id']]);
                    }
                    else return null;

                    break;
                default:
                    return null;
            }
        }

        //Send prize
        function sendPrize($prize) {
            switch ($prize["type"]) {
                //Send prize of Api bank
                case 1:
                    /*$url = 'http://example.com';
                    $data = array('type' => $prize->type, 'sum' => $prize->prize);

                    $options = array(
                        'http' => array(
                            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                            'method'  => 'POST',
                            'content' => http_build_query($data)
                        )
                    );
                    $context  = stream_context_create($options);*/
                    $result = /*file_get_contents($url, false, $context)*/true;

                    if ($result === FALSE)
                        return false;
                    else return true;
                    break;
                case 2:
                    //Earning points in the mobile app
                    return true;
                    break;
                case 3:
                    /*if(mail('test@example.com', 'Are you won!', "You are sent a prize".$prize->prize."."))
                        return true;
                    else return false;*/

                    return true;
                    break;
                default:
                    return null;
            }
        }

        //Refuse the won prize
        function refusePrize($type, $prize) {
            switch ($type) {
                case 1:
                    $mysqliWork = new dbConnect();
                    $connect = $mysqliWork->openConnection();

                    $result = $connect->query("SELECT * FROM t_money");
                    $row = $result->fetch_assoc();

                    $row['total'] += $prize;

                    $result = $connect->query("UPDATE t_money SET total = '$row[total]'");
                    $mysqliWork->closeConnection();

                    return true;
                    break;
                case 3:
                    $mysqliWork = new dbConnect();
                    $connect = $mysqliWork->openConnection();
                    $result = $connect->query("INSERT INTO t_subject (object) VALUES ('$prize')");
                    $mysqliWork->closeConnection();

                    return true;
                    break;
                default:
                    return null;
            }
        }

        //Convert money to bonus
        function convertMoney($money, $coef)
        {
            return $money * $coef;
        }
    }

    //randomize
    function make_seed()
    {
        list($usec, $sec) = explode(' ', microtime());
        return $sec + $usec * 1000000;
    }
?>