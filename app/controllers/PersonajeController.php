<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

/**
 * DirectorController
 *
 * Manage CRUD operations for director
 */
class PersonajeController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Personajes');
        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new PersonajeForm;
    }

    /**
     * Search director based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Personaje", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $personaje = Personaje::find($parameters);
        if (count($personaje) == 0) {
            $this->flash->notice("No se han encontrado Personajes");

            return $this->dispatcher->forward(
                [
                    "controller" => "personaje",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator(array(
            "data"  => $personaje,
            "limit" => 10,
            "page"  => $numberPage,
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Shows the form to create a new personaje
     */
    public function newAction()
    {
        $this->view->form = new PersonajeForm(null, array('edit' => true));
    }

    /**
     * Edits a personaje based on its id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $personaje = Personaje::findFirstById($id);
            if (!$personaje) {
                $this->flash->error("Personaje no encontrado");

                return $this->dispatcher->forward(
                    [
                        "controller" => "personaje",
                        "action"     => "index"
                    ]
                );
            }

            $this->view->form = new PersonajeForm($personaje, array('edit' => true));
        }
    }


     public function showAction($id)
    {

        if (!$this->request->isPost()) {

            $personaje = Personaje::findFirstById($id);
            if (!$personaje) {
                $this->flash->error("Personaje no encontrado");

                return $this->dispatcher->forward(
                    [
                        "controller" => "personaje",
                        "action"     => "index"
                    ]
                );
            }

            $this->view->form = new PersonajeForm($personaje, array('show' => true));
        }
    }

    /**
     * Creates a new personaje
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "personaje",
                    "action"     => "index",
                ]
            );
        }

        $form = new PersonajeForm;
        $personaje = new Personaje();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $personaje)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "personaje",
                    "action"     => "new",
                ]
            );
        }

        if ($personaje->save() == false) {
            foreach ($personaje->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "personaje",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("El personaje ha sido registrado exitosamente");

        return $this->dispatcher->forward(
            [
                "controller" => "personaje",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current personaje in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "personaje",
                    "action"     => "index",
                ]
            );
        }

        $id = $this->request->getPost("id", "int");

        $personaje = Perosnaje::findFirstById($id);
        if (!$personaje) {
            $this->flash->error("El personaje no existe");

            return $this->dispatcher->forward(
                [
                    "controller" => "perosnaje",
                    "action"     => "index",
                ]
            );
        }

        $form = new PerosnajeForm;
        $this->view->form = $form;

        $data = $this->request->getPost();

        if (!$form->isValid($data, $personaje)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "personaje",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        if ($personaje->save() == false) {
            foreach ($personaje->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "personaje",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        $form->clear();

        $this->flash->success("Los datos del personaje han sido actualizados exitosamente");

        return $this->dispatcher->forward(
            [
                "controller" => "personaje",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a personaje
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $personaje = Personaje::findFirstById($id);
        if (!$personaje) {
            $this->flash->error("Personaje no encontrado");

            return $this->dispatcher->forward(
                [
                    "controller" => "personaje",
                    "action"     => "index",
                ]
            );
        }

        if (!$personaje->delete()) {
            foreach ($personaje->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "personaje",
                    "action"     => "search",
                ]
            );
        }

        $this->flash->success("Perosnaje Eliminado del registro");

            return $this->dispatcher->forward(
                [
                    "controller" => "personaje",
                    "action"     => "index",
                ]
            );
    }
}
