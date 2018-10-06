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
        system::htmlPage($table);
    }
}

class system {
    public static function htmlPage($page)
    {
        $fpage = '<html><head><title>CSV Table</title><link rel="stylesheet" type="text/css"href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/></head>';
        $fpage .= '<body>';
        $fpage .= '<table class = "table table-striped">';
        $fpage .= $page;
        $fpage .= '</table></body></html>';
        print $fpage;
}
}
class html {
    public static function generateTable($records) {
    $htmlOutput = "'";
        $count = 0;
        foreach ($records as $record) {
            if($count == 0) {
                $array = $record->returnArray();
                $fields = array_keys($array);
                $tablehead = self::getHeadings($fields);
                $htmlOutput .= '<thead><tr>'.$tablehead.'</tr></thead><tbody>';
                $values = array_values($array);
                $tablerow = self::getValues($values);
                $htmlOutput .= $tablerow;
            } else {
                $array = $record->returnArray();
                $values = array_values($array);
                $tablerow = self::getValues($values);
                $htmlOutput .= $tablerow;
            }
            $count++;


        }
        $htmlOutput .= '</tbody>';
        return $htmlOutput;
    }

    public static function transform($values,$c)
    {
        $data = "";
        if(!empty($values[$c]))
        {
            $data = $values[$c];
        }
        else
        {
            $data = "&nbsp";
            }
        return $data;
    }
    
public static function getHeadings($fields)
    {
        $num = count($fields);
        $tablehead = "'";
        for($c = 0; $c < $num; $c++)
        {
            $head = self::transform($fields, $c);
            $tablehead .= '<th>'.$head.'</th>';
        }
        return $tablehead;
    }

    /**
     * This function takes an array of values and
     * then the reads the array
     * @param $values
     * @return string
     *
     */
     public static function getValues($values)
    {
        $tablerow = '<tr>';
        $num = count($values);
        for($c = 0; $c < $num; $c++)
        {
            $data = self::transform($values, $c);

            $tablerow .= '<td>'.$data.'</td>';

        }
        $tablerow .= '</tr>';
        return $tablerow;
    }
}

class csv {
    static public function getRecords($filename) {
        $file = fopen($filename,"r");
        $fieldNames = array();
        $count = 0;
        while(! feof($file))
        {
            $record = fgetcsv($file);
            if($count == 0) {
                $fieldNames = $record;
            } else {
                $records[] = recordFactory::create($fieldNames, $record);
            }
            $count++;
        }
        fclose($file);
        return $records;
    }
}

class record {
    public function __construct(Array $fieldNames = null, $values = null )
    {
        $record = array_combine($fieldNames, $values);
        foreach ($record as $property => $value) {
            $this->createProperty($property, $value);
        }
    }
    public function returnArray() {
        $array = (array) $this;
        return $array;
    }
    public function createProperty($name, $value) {
        $this->{$name} = $value;
    }
}
class recordFactory {
    public static function create(Array $fieldNames = null, Array $values = null) {
        $record = new record($fieldNames, $values);
        return $record;
    }
}
