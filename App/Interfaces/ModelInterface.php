<?php
    namespace App\Interfaces;
    interface ModelInterface{
        public function create(array $data);
        public function getOne($id, $condition);
        public function getAll();
        public function update($id, array $data);
        public function delete($id);
    }
?>