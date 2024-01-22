<?php

namespace App\Models;

use App\Interfaces\ModelInterface;

abstract class BaseModel implements ModelInterface
{
    protected $table;
    public function __construct($table)
    {
        $this-> table= $table;
       
    }
    public function  create(array $data){
        // code
     
    }
    public function getOne($id, $condition){
        //code
    }
    public function getAll(){
        //code
        echo "
        <div class='col'>
         <div class='p-3'>I am BaseModel</div>
        </div>
    ";
    }
    public function update($id, array $data){
        //code
    }
    public function delete($id){
        //code
    }

}
