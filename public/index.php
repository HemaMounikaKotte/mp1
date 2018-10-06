<?php
/**
 * Created by PhpStorm.
 * User: hema
 * Date: 10/4/18
 * Time: 9:47 PM
 */
main::start("example.csv");
class main  {
    static public function start($filename) {
        $records = csv::getRecords($filename);
        $table = html::generateTable($records);
    }
}

class html {
    public static function generateTable($records) {
        $count = 0;
        foreach ($records as $record) {
            if($count == 0) {
                $array = $record->returnArray();
                $fields = array_keys($array);
                $values = array_values($array);
                print_r($fields);
                print_r($values);
            } else {
                $array = $record->returnArray();
                $values = array_values($array);
                print_r($values);
            }
            $count++;
        }
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

class record
{
    public function _construct(Array $record = null)
    {
        $this->createProperty();
        print_r($this);
    }

    public function createProperty($name = 'first', $value = 'hema') {
    $this->{$name} = $value;
}
}

class recordFactory {
    public static function create(Array $array = null) {
        $record = new record($array);
    }
}

