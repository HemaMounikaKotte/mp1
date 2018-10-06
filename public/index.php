<?php
/**
 * Created by PhpStorm.
 * User: hema
 * Date: 10/4/18
 * Time: 9:47 PM
 */
main::start();

class main  {

    static public function start() {

        $file = fopen("example.csv","r");
        print_r(fgetcsv($file));
        fclose($file);
        
    }
}



