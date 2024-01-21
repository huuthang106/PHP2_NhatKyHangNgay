<?php
    namespace App\Core;
    class Field{
        public const TYPE_TEXT = 'text';
        public const TYPE_PASSWORD ='password';
        public const TYPE_NUMBER = 'munber';
        public string $type;
        public string $attribute;
        public function __construct(string $attribute){
            $this -> type = self:: TYPE_TEXT;
            $this -> attribute =$attribute;
        }
        public function __toString(){
            return sprintf('
            <div class ="form-group">
            <lavel>%s</label>
            <input class="form-control"  type ="%s" name ="%s">
            </div>
            ',
            $this->getLabel($this->attribute),
            $this->type,
            $this->attribute);
        }
        public function getLabel($attribute){
            return $this->labels()[$attribute] ?? $attribute;
        }
        public function labels(): array{
            return[
                'firstname'=>'First name',
                'latname'=> 'Last name',
                'email'=> 'Your Email',
                'passsword' => 'Password',
                'confirmPasswprd' => 'Confirm password',
            ];
        }
        public function passwordField(){
            $this -> type = self:: TYPE_PASSWORD;
            return $this;
        }
    }
?>