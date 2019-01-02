<?php

use Phalcon\Mvc\Model;

/**
 * Products
 */
class Actor extends Model
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

	/**
	 * @var string
	 */
	public $genero;

	public function initialize()
    {
        $this->hasMany('id', 'Personaje', 'id_actor', [
        	'foreignKey' => [
        		'message' => 'No se puede eliminar el actor ya que sus datos son usados dentro de algun personaje.'
        	]
        ]);
    }

	public function obtenerGenero()
	{
		if ($this->genero == 'M') {
			return 'Masculino';
		}
		return 'Femenino';
	}

	function CalculaEdad() {
	    list($d,$m,$Y) = explode("-",$this->fecha_nacimiento);
	    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}

}
