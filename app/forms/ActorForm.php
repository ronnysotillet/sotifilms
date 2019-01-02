<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\Date as DateValidator;

class ActorForm extends Form
{

    public function initialize($entity = null, $options = array())
    {
        $flag = (isset($options['show']))?'readonly':'';
        if (!isset($options['edit'])) {
            $element = new Text("id", [$flag=>'','autocomplete'=>'off']);
            $this->add($element->setLabel("Id"));
        } else {
            $this->add(new Hidden("id"));
        }

        $nombre = new Text("nombre", [$flag=>'','autocomplete'=>'off']);
        $nombre->setLabel("Nombre");
        $nombre->setFilters(['striptags', 'string']);
        $nombre->addValidators([
            new PresenceOf([
                'message' => 'El nombre es obligatorio'
            ])
        ]);
        $this->add($nombre);

        

        $fecha = new Text('fecha_nacimiento',[$flag=>'','placeholder'=>'dia-mes-año','autocomplete'=>'off']);
        $fecha->setLabel("Fecha de nacimiento");
        $fecha->addValidators([
            new PresenceOf([
                'message' => 'La fecha es obligatoria'
            ]),
            new DateValidator([
                "format"  => "d-m-Y",
                "message" => "Formato de fecha invalido debe ser dia-mes-año, notese que debe ser separado por 'guion'",
            ])
        ]);
        $this->add($fecha);


        $nacionalidad = new Text("nacionalidad", [$flag=>'','autocomplete'=>'off']);
        $nacionalidad->setLabel("Nacionalidad");
        $nacionalidad->setFilters(['striptags', 'string']);
        $nacionalidad->addValidators([
            new PresenceOf([
                'message' => 'La nacionalidad es obligatoria'
            ])
        ]);
        $this->add($nacionalidad);

        $genero = new Select(
            'genero',
            [
                ''=>'--SELECCIONAR--',
                'M'=>'Masculino',
                'F'=>'Femenino'
            ], [$flag=>'']
        );
        $genero->setLabel("Genero");
        $this->add($genero);

        if ($flag=='readonly') {
            $edad = new Text("edad", [
                $flag=>'', 
                'value'=> $options['edad']
            ]);
            $edad->setLabel("Edad");
            $this->add($edad);
        }

    }
}
