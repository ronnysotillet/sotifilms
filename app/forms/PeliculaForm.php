<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;

class PeliculaForm extends Form
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


        $duracion = new Text('duracion', [$flag=>'','placeholder'=>'hh:mm:ss','autocomplete'=>'off']);
        $duracion->setLabel("Duracion");
        $duracion->setFilters(['striptags', 'string']);
        $duracion->addValidators([
            new PresenceOf([
                'message' => 'La Duracion es obligatoria'
            ])
        ]);
        $this->add($duracion);


        $genero = new Text("genero", [$flag=>'','autocomplete'=>'off']);
        $genero->setLabel("Genero de la pelicula");
        $genero->setFilters(['striptags', 'string']);
        $genero->addValidators([
            new PresenceOf([
                'message' => 'El genero es obligatorio'
            ])
        ]);
        $this->add($genero);
        
        $director = new Select('id_director', Director::find(), [
            'using'      => ['id', 'nombre'],
            'useEmpty'   => true,
            'emptyText'  => '--SELECCIONAR--',
            'emptyValue' => '',
            $flag        =>''
        ]);
        $director->setLabel('Director');
        $this->add($director);

        
    }
}