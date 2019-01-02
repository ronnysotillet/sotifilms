<?php

use Phalcon\Mvc\Model;

/**
 * Products
 */
class Director extends Model
{
	/**
	 * @var integer
	 */
	public $id;

	/**
	 * @var string
	 */
	public $nombre;

	/**
	 * @var string
	 */
	public $fecha_nacimiento;

	/**
	 * @var string
	 */
	public $nacionalidad;

	    public function initialize()
    {
        $this->hasMany('id', 'Pelicula', 'id_director', [
        	'foreignKey' => [
        		'message' => 'No se puede eliminar el director ya que sus datos son usados dentro de alguna Pelicula.'
        	]
        ]);
    }

    function CalculaEdad() {
	    list($d,$m,$Y) = explode("-",$this->fecha_nacimiento);
	    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}

}
