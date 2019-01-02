<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

/**
 * DirectorController
 *
 * Manage CRUD operations for director
 */
class ActorController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Actores');
        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new ActorForm;
    }

    /**
     * Search director based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Actor", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $actor = Actor::find($parameters);
        if (count($actor) == 0) {
            $this->flash->notice("No se han encontrado Actores");

            return $this->dispatcher->forward(
                [
                    "controller" => "actor", 
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator(array(
            "data"  => $actor,
            "limit" => 10,
            "page"  => $numberPage,
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Shows the form to create a new actor
     */
    public function newAction()
    {
        $this->view->form = new ActorForm(null, array('edit' => true));
    }

    /**
     * Edits a actor based on its id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $actor = Actor::findFirstById($id);
            if (!$actor) {
                $this->flash->error("Actor no encontrado");

                return $this->dispatcher->forward(
                    [
                        "controller" => "actor",
                        "action"     => "index"
                    ]
                );
            }

            $this->view->form = new ActorForm($actor, array('edit' => true));
        }
    }

    public function showAction($id)
    {

        if (!$this->request->isPost()) {

            $actor = Actor::findFirstById($id);
            if (!$actor) {
                $this->flash->error("Actor no encontrado");

                return $this->dispatcher->forward(
                    [
                        "controller" => "actor",
                        "action"     => "index"
                    ]
                );
            }

            $this->view->form = new ActorForm($actor, array('show' => true, 'edad'=> $actor->CalculaEdad()));

            $numberPage = 1;
            $personaje = Personaje::find('id_actor="'.$id.'"');
            if ($this->request->getQuery("page", "int")!==null) {
                $numberPage = $this->request->getQuery("page", "int");
            }

            if (count($personaje) == 0) {
                $this->flash->notice("Este actor no posee personajes registrados");
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
     * Creates a new actor
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "actor",
                    "action"     => "index",
                ]
            );
        }

        $form = new ActorForm;
        $actor = new Actor();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $actor)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "actor",
                    "action"     => "new",
                ]
            );
        }

        if ($actor->save() == false) {
            foreach ($actor->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "actor",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("El actor ha sido registrado exitosamente");

        return $this->dispatcher->forward(
            [
                "controller" => "actor",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current actor in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "actor",
                    "action"     => "index",
                ]
            );
        }

        $id = $this->request->getPost("id", "int");

        $actor = Actor::findFirstById($id);
        if (!$actor) {
            $this->flash->error("El actor no existe");

            return $this->dispatcher->forward(
                [
                    "controller" => "actor",
                    "action"     => "index",
                ]
            );
        }

        $form = new ActorForm;
        $this->view->form = $form;

        $data = $this->request->getPost();

        if (!$form->isValid($data, $actor)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "actor",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        if ($actor->save() == false) {
            foreach ($actor->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "actor",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        $form->clear();

        $this->flash->success("Los datos del actor han sido actualizados exitosamente");

        return $this->dispatcher->forward(
            [
                "controller" => "actor",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a actor
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $actor = Actor::findFirstById($id);
        if (!$actor) {
            $this->flash->error("Actor no encontrado");

            return $this->dispatcher->forward(
                [
                    "controller" => "actor",
                    "action"     => "index",
                ]
            );
        }

        if (!$actor->delete()) {
            foreach ($actor->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "actor",
                    "action"     => "search",
                ]
            );
        }

        $this->flash->success("Actor Eliminado del registro");

            return $this->dispatcher->forward(
                [
                    "controller" => "actor",
                    "action"     => "index",
                ]
            );
    }
}
