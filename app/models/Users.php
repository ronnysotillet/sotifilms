<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Users extends Model
{
    public function validation()
    {
        $validator = new Validation();
        
        $validator->add(
            'email',
            new EmailValidator([
            'message' => 'E-mail invalido'
        ]));
        $validator->add(
            'email',
            new UniquenessValidator([
            'message' => 'Lo sentimos, este e-mail esta siendo usado por otro usuario'
        ]));
        $validator->add(
            'username',
            new UniquenessValidator([
            'message' => 'Lo sentimos, este nombre de usuario ya esta siendo usado'
        ]));
        
        return $this->validate($validator);
    }
}
