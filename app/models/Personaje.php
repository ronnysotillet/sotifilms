<?php

use Phalcon\Mvc\Model;

/**
 * Pelicula
 */
class Personaje extends Model
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
	 * @var integer
	 */
	public $id_actor;

	/**
	 * @var integer
	 */
	public $id_pelicula;


	public function initialize()
	{
		$this->belongsTo('id_actor', 'actor', 'id', [
			'reusable' => true
		]);

		$this->belongsTo('id_pelicula', 'pelicula', 'id', [
			'reusable' => true
		]);
	}

}
