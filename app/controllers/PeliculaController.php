<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

/**
 * PeliculaController
 *
 * Manage CRUD operations for pelicula
 */
class PeliculaController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Peliculas');
        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new PeliculaForm;
    }

    /**
     * Search pelicula based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Pelicula", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $pelicula = Pelicula::find($parameters);
        if (count($pelicula) == 0) {
            $this->flash->notice("No se han encontrado peliculaes");

            return $this->dispatcher->forward(
                [
                    "controller" => "pelicula",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator(array(
            "data"  => $pelicula,
            "limit" => 10,
            "page"  => $numberPage,
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Shows the form to create a new pelicula
     */
    public function newAction()
    {
        $this->view->form = new PeliculaForm(null, array('edit' => true));
    }

    /**
     * Edits a pelicula based on its id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $pelicula = Pelicula::findFirstById($id);
            if (!$pelicula) {
                $this->flash->error("Pelicula no encontrado");

                return $this->dispatcher->forward(
                    [
                        "controller" => "pelicula",
                        "action"     => "index"
                    ]
                );
            }

            $this->view->form = new PeliculaForm($pelicula, array('edit' => true));
        }
    }

        public function showAction($id)
    {

        if (!$this->request->isPost()) {

            $pelicula = Pelicula::findFirstById($id);
            if (!$pelicula) {
                $this->flash->error("Pelicula no encontrada");

                return $this->dispatcher->forward(
                    [
                        "controller" => "pelicula",
                        "action"     => "index"
                    ]
                );
            }
            $this->view->form = new PeliculaForm($pelicula, array('show' => true));

            $numberPage = 1;
            $personaje = Personaje::find('id_pelicula="'.$id.'"');
            if ($this->request->getQuery("page", "int")!==null) {
                $numberPage = $this->request->getQuery("page", "int");
            }

            if (count($personaje) == 0) {
                $this->flash->notice("Esta pelicula no posee personajes registrados");
            }

            $paginator = new Paginator(array(
                "data"  => $personaje,
                "limit" => 10,
                "page"  => $numberPage,
            ));
            $personajeC=new PersonajeController;
            $personajeC->view->page = $paginator->getPaginate();
        }
    }

    /**
     * Creates a new pelicula
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "pelicula",
                    "action"     => "index",
                ]
            );
        }

        $form = new PeliculaForm;
        $pelicula = new Pelicula();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $pelicula)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "pelicula",
                    "action"     => "new",
                ]
            );
        }

        if ($pelicula->save() == false) {
            foreach ($pelicula->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "pelicula",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("La pelicula ha sido registrado exitosamente");

        return $this->dispatcher->forward(
            [
                "controller" => "pelicula",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current pelicula in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "pelicula",
                    "action"     => "index",
                ]
            );
        }

        $id = $this->request->getPost("id", "int");

        $pelicula = Pelicula::findFirstById($id);
        if (!$pelicula) {
            $this->flash->error("La pelicula no existe");

            return $this->dispatcher->forward(
                [
                    "controller" => "pelicula",
                    "action"     => "index",
                ]
            );
        }

        $form = new PeliculaForm;
        $this->view->form = $form;

        $data = $this->request->getPost();

        if (!$form->isValid($data, $pelicula)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "pelicula",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        if ($pelicula->save() == false) {
            foreach ($pelicula->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "pelicula",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        $form->clear();

        $this->flash->success("Los datos de la pelicula han sido actualizados exitosamente");

        return $this->dispatcher->forward(
            [
                "controller" => "pelicula",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a pelicula
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $pelicula = Pelicula::findFirstById($id);
        if (!$pelicula) {
            $this->flash->error("Pelicula no encontrada");

            return $this->dispatcher->forward(
                [
                    "controller" => "pelicula",
                    "action"     => "index",
                ]
            );
        }

        if (!$pelicula->delete()) {
            foreach ($pelicula->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "pelicula",
                    "action"     => "search",
                ]
            );
        }

        $this->flash->success("Pelicula Eliminada del registro");

            return $this->dispatcher->forward(
                [
                    "controller" => "pelicula",
                    "action"     => "index",
                ]
            );
    }
}
