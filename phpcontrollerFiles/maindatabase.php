<?php
class maindatabase{

    protected function connect(){
        try{
            $username = "root";
            $password = "";

            $database = new PDO('mysql:host=localhost;dbname=storeusers_database', $username, $password);
            return $database;
        }
        catch(PDOException $e){
            print "Error!: ". $e->getMessage() . "<br/>";
            die();
        }
    }
}