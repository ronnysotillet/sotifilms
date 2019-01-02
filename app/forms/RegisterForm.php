<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class RegisterForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        // Name
        $name = new Text('name',['autocomplete'=>'off']);
        $name->setLabel('Tu Nombre Completo');
        $name->setFilters(['striptags', 'string']);
        $name->addValidators([
            new PresenceOf([
                'message' => 'El nombre es requerido'
            ])
        ]);
        $this->add($name);

        // Name
        $username = new Text('username',['autocomplete'=>'off']);
        $username->setLabel('Username');
        $username->setFilters(['alpha']);
        $username->addValidators([
            new PresenceOf([
                'message' => 'El nombre de usuario es requerido'
            ])
        ]);
        $this->add($username);

        // Email
        $email = new Text('email',['autocomplete'=>'off']);
        $email->setLabel('E-Mail');
        $email->setFilters('email');
        $email->addValidators([
            new PresenceOf([
                'message' => 'El e-mail es requerido'
            ]),
            new Email([
                'message' => 'No es valido el e-mail'
            ])
        ]);
        $this->add($email);

        // Password
        $password = new Password('password');
        $password->setLabel('Contraseña');
        $password->addValidators([
            new PresenceOf([
                'message' => 'La contraseña es requerida'
            ])
        ]);
        $this->add($password);

        // Confirm Password
        $repeatPassword = new Password('repeatPassword');
        $repeatPassword->setLabel('Repite Contraseña');
        $repeatPassword->addValidators([
            new PresenceOf([
                'message' => 'Confirmacion de la contraseña es requerida'
            ])
        ]);
        $this->add($repeatPassword);
    }
}
