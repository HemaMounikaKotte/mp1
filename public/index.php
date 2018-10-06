<?php
/**
 * Created by PhpStorm.
 * User: hema
 * Date: 10/4/18
 * Time: 9:47 PM
 */
main::start(example.csv);

class main  {

    static public function start($filename) {


$records = csv::getrecords(filename);
print_r($records);
    }
}

class csv {
    static public function getrecords($filename) {

        $file = fopen("example.csv","r");

        while(! feof($file))
        {
            $record = fgetcsv($file);
            $records[] = recordFactory::create();
        }

        fclose($file);
        return $records;
    }
}

class record {}
class recordFactory {
    public static function create(Array $array = null) {
        $record = new record();
    }
}

