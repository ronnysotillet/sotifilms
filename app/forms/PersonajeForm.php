<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;

class PersonajeForm extends Form
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
        $nombre->setLabel("Nombre del Personaje");
        $nombre->setFilters(['striptags', 'string']);
        $nombre->addValidators([
            new PresenceOf([
                'message' => 'El nombre es obligatorio'
            ])
        ]);
        $this->add($nombre);
            $actor = new Select('id_actor', Actor::find(), [
                'using'      => ['id', 'nombre'],
                'useEmpty'   => true,
                'emptyText'  => '--SELECCIONAR--',
                'emptyValue' => '',
                $flag        => ''
            ]);
            $actor->setLabel('Actor que lo interpreta');
            $this->add($actor);

            $pelicula = new Select('id_pelicula', Pelicula::find(), [
                'using'      => ['id', 'nombre'],
                'useEmpty'   => true,
                'emptyText'  => '--SELECCIONAR--',
                'emptyValue' => '',
                $flag        => ''
            ]);
            $pelicula->setLabel('Pelicula donde sale');
            $this->add($pelicula);
    }
}
