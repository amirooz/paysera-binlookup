<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PhpBIN;

class AppTest extends TestCase
{
    
    public function testBinLookup()
    {
        $bin = PhpBIN::getInstance('BinList');

        $info = $bin->getInfo("45417360");

        $this->assertEquals($info['CC_ISO3166_1'], 'JP');

    }


}