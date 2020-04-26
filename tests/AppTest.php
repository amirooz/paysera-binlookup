<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PhpBIN;

class AppTest extends TestCase
{
    
    public function testBinLookup()
    {
        $app = new \App\Task();

        $app->binLookup(41417360);

        $this->assertEquals($app->bin->country->alpha2, 'US');

    }

    //check the result in two different way
    public function testCheckResult()
    {
        $binKey = 45417360;

        $app = new \App\Task();
        $app->binLookup($binKey);

        $bin = PhpBIN::getInstance('BinList');
        $info = $bin->getInfo($binKey);

        $this->assertEquals($app->bin->country->alpha2, $info['CC_ISO3166_1']);
    }


}