<?php
class ModelDB {
    private string $table;
    private $DBConnection;
    public function __construct($table){
        $this->table = $table;
    }
    public function DBConnection(){
        $host = "localhost";
        $db = "notes_db";
        $username="root";
        $password= "";
        //Database Connection
        $this->DBConnection = new PDO("mysql:host=$host;dbname=$db",$username,$password);
        //PDO Mode set to Exception errors, used for quick exception handling
        $this->DBConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->DBConnection;
    }

    public function All(){
        //First, the PDO connection ($this->DBConnection), then the operation (query) with the SQL statement, and then the operation to handle all values as an associative array (helpful)
        $stmt = $this->DBConnection()->query("SELECT * FROM $this->table");
        //Return the function is an associative array with the SQL statement ready (SELECT *)
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function All_singleUser($key, $value){
        //First, the PDO connection ($this->DBConnection), then the operation (query) with the SQL statement, and then the operation to handle all values as an associative array (helpful)
        $stmt = $this->DBConnection()->query("SELECT * FROM $this->table WHERE $key = $value");
        //Return the function is an associative array with the SQL statement ready (SELECT *)
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function onlyFirst($key, $value){
        //the PDO connection ($this->DBConnection), then the operation (query) with the SQL statement, and then the operation to handle a single value with key(column) and value(value) as an associative array 
        $stmt = $this->DBConnection()->query("SELECT * FROM $this->table WHERE $key = '$value' LIMIT 1");
        //Return the function is an associative array with the SQL statement ready having a single value (SELECT * LIMIT 1)
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function insertValues(array $data)
    {
        //First create the columns and placeholders, so we can fill in the values later on
        $column=''; $placeholdlers= '';
        foreach ($data as $key => $value)
        {
            //fill in with the conditions as "INSERT INTO tablename (columnname, or column) VALUES (:columnname or placeholders, which are sections that holds in the data)"
            $column .= $key .($key == array_key_last($data) ? '':', ');
            $placeholdlers .= ':'. $key .($key == array_key_last($data) ?'':', ');
        }

        //Prepare the query for insertion, notice the columns and the placeholders
        $stmt = $this->DBConnection()->prepare("INSERT INTO $this->table ($column) VALUES ($placeholdlers)");

        foreach ($data as $key => $value)
        {
            //Bind the parameters as in this format (:columnname(or column), placeholder(or value))
            $stmt->bindParam(':'.$key, ${$key});
            ${$key} = $value;
        }
        //Return the function as an execution of the SQL statement (INSERT INTO)
        return $stmt->execute();
    }
    
    public function updateValues(array $data, $param_key, $param_value){
        $update_values = '';
        foreach ($data as $key => $value)
        {
            // Use placeholders for binding later
            $update_values .= $key. ' = :' . $key . ($key == array_key_last($data) ? '' : ', ');
        }
        
        // Prepare the SQL query with placeholders
        $stmt = $this->DBConnection()->prepare("UPDATE $this->table SET $update_values WHERE $param_key = :param_value");
        
        // Bind each value to its placeholder
        foreach ($data as $key => $value)
        {
            $stmt->bindParam(':'.$key, $data[$key]);
        }
    
        // Bind the WHERE clause value
        $stmt->bindParam(':param_value', $param_value);
        // print_r($stmt);
        // Execute the statement
        return $stmt->execute();
    }
    
    // public function deleteValues_singleUser($key,$value){
    //     //Prepare the SQL Statemnet for deletion via ID
    //     $stmt = $this->DBConnection()->prepare("DELETE FROM $this->table WHERE $key = '$value'");
    //     //Return the function as an execution of the SQL statement (DELETE FROM)
    //     return $stmt->execute();
    // }

    public function deleteValues($id){
        //Prepare the SQL Statemnet for deletion via ID
        $stmt = $this->DBConnection()->prepare("DELETE FROM $this->table WHERE id = '$id'");
        //Return the function as an execution of the SQL statement (DELETE FROM)
        return $stmt->execute();
    }

    public function __destruct(){
        $this->DBConnection = null;
    }
}

class Files{
    public function upload($file)
    {
        $imgName = $file['name'];
        $imgTemp = $file['tmp_name'];
        
        $PicName = explode( '.' , $imgName);
    
        $PicExt = end($PicName);
    
        $PicPath = './assets/profiles/' . time() . '.' . $PicExt;
    
        move_uploaded_file($imgTemp, $PicPath);

        return $PicPath;
    }

    public function remove($path)
    {
        unlink($path);
    }
}