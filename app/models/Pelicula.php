<?php

use Phalcon\Mvc\Model;

/**
 * Pelicula
 */
class Pelicula extends Model
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
	public $duracion;

	/**
	 * @var string
	 */
	public $genero;

    /**
	 * @var integer
	 */
	public $id_director;


	public function initialize()
	{
		$this->belongsTo('id_director', 'director', 'id', [
			'reusable' => true
		]);
		$this->hasMany('id', 'personaje', 'id_pelicula', [
        	'foreignKey' => [
        		'message' => 'No se puede eliminar la pelicula ya que posee personajes registrados.'
        	]
        ]);
	}

}
