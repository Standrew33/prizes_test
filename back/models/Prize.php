<?php
    class Prize {

        //Get prize
        function getPrize() {
            srand(make_seed());
            $numPrize = rand(1, 3);

            switch ($numPrize) {
                case 1:
                    $handle = fopen("../../data/moneyPrize.txt", 'r');
                    $interval = explode(" ", fgets($handle));
                    fclose($handle);
                    $moneyPrize = rand($interval[1], $interval[2]);

                    if ($interval[0] - $moneyPrize < 0)
                    {
                        $moneyPrize = $interval[0];
                        $interval[0] = 0;
                    }
                    else $interval[0] = $interval[0] - $moneyPrize;

                    file_put_contents("../../data/moneyPrize.txt", implode(" ", $interval));

                    return json_encode((object) ['prize' => $moneyPrize,
                                     'type' => 1]);
                    break;
                case 2:
                    $interval = file("../../data/bonusPrize.txt", FILE_IGNORE_NEW_LINES);
                    return json_encode((object) ['prize' => rand($interval[0], $interval[1]),
                                     'type' => 2]);
                    break;
                case 3:
                    $handle = fopen("../../data/objectPrize.txt", 'r');
                    $listObject = explode(" ", fgets($handle));
                    fclose($handle);

                    if (count($listObject) != 0)
                    {
                        $index = rand(0, count($listObject) - 1);
                        $objectPrize = $listObject[$index];

                        array_splice($listObject, $index, 1);
                        file_put_contents("../../data/objectPrize.txt", implode(" ", $listObject));

                        return json_encode((object) ['prize' => $objectPrize,
                                         'type' => 3]);
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
                    $handle = fopen("../../data/moneyPrize.txt", 'r');
                    $interval = explode(" ", fgets($handle));
                    fclose($handle);

                    $interval[0] = $interval[0] + $prize;
                    file_put_contents("../../data/moneyPrize.txt", implode(" ", $interval));

                    return true;
                    break;
                case 3:
                    file_put_contents("../../data/objectPrize.txt", " " .$prize, FILE_APPEND);

                    return true;
                    break;
                default:
                    return null;
            }
        }
    }

    //randomize
    function make_seed()
    {
        list($usec, $sec) = explode(' ', microtime());
        return $sec + $usec * 1000000;
    }
?>