<?php

namespace tests\models;

require '../../../models/Prize.php';

class PrizeTest extends \Codeception\Test\Unit
{
    private $prize;

    protected function setUp()
    {
        $this->prize = new Prize();
    }

    protected function tearDown()
    {
        $this->prize = NULL;
    }

    public function testAdd()
    {
        $result = $this->prize->convertMoney(1, 2);
        $this->assertEquals(3, $result);
    }
}
