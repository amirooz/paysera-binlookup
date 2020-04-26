<?php

namespace App;

class Task 
{

    public $bin;

    public function index($argv)
    {
        foreach (explode("\n", file_get_contents($argv)) as $row) {
            
            if (empty($row)) break;
            $p = explode(",",$row);
            $p2 = explode(':', $p[0]);
            $value[0] = trim($p2[1], '"');
            $p2 = explode(':', $p[1]);
            $value[1] = trim($p2[1], '"');
            $p2 = explode(':', $p[2]);
            $value[2] = trim($p2[1], '"}');
        
            $this->binLookup($value[0]);

            $isEu = $this->isEu($this->bin->country->alpha2);

            $rate = @json_decode(file_get_contents('https://api.exchangeratesapi.io/latest'), true)['rates'][$value[2]];
            
            if ($value[2] == 'EUR' or $rate == 0) {
                $amntFixed = $value[1];
            }
            if ($value[2] != 'EUR' or $rate > 0) {
                @$amntFixed = $value[1] / $rate;
            }
        
            echo round($amntFixed * ($isEu == 'yes' ? 0.01 : 0.02),2);
            echo '<br />';
            print "\n";
        }
    }

    public function binLookup($val)
    {
        $results = file_get_contents('https://lookup.binlist.net/' .$val);
        if (!$results)
            die('error!');
        $this->bin = json_decode($results);
        return ;
        
    }

    public function isEu($c) 
    {
        $result = false;
        switch($c) {
            case 'AT':
            case 'BE':
            case 'BG':
            case 'CY':
            case 'CZ':
            case 'DE':
            case 'DK':
            case 'EE':
            case 'ES':
            case 'FI':
            case 'FR':
            case 'GR':
            case 'HR':
            case 'HU':
            case 'IE':
            case 'IT':
            case 'LT':
            case 'LU':
            case 'LV':
            case 'MT':
            case 'NL':
            case 'PO':
            case 'PT':
            case 'RO':
            case 'SE':
            case 'SI':
            case 'SK':
                $result = 'yes';
                return $result;
            default:
                $result = 'no';
        }
        return $result;
    }

}
