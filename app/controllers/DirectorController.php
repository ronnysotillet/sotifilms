<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

/**
 * DirectorController
 *
 * Manage CRUD operations for director
 */
class DirectorController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Directores');
        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->form = new DirectorForm;
    }

    /**
     * Search director based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "director", $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = array();
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $director = Director::find($parameters);
        if (count($director) == 0) {
            $this->flash->notice("No se han encontrado directores");

            return $this->dispatcher->forward(
                [
                    "controller" => "director",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator(array(
            "data"  => $director,
            "limit" => 10,
            "page"  => $numberPage,
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Shows the form to create a new director
     */
    public function newAction()
    {
        $this->view->form = new DirectorForm(null, array('edit' => true));
    }

    /**
     * Edits a director based on its id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $director = Director::findFirstById($id);
            if (!$director) {
                $this->flash->error("Director no encontrado");

                return $this->dispatcher->forward(
                    [
                        "controller" => "director",
                        "action"     => "index"
                    ]
                );
            }

            $this->view->form = new DirectorForm($director, array('edit' => true));
        }
    }


    public function showAction($id)
    {

        if (!$this->request->isPost()) {

            $director = Director::findFirstById($id);
            if (!$director) {
                $this->flash->error("Director no encontrado");

                return $this->dispatcher->forward(
                    [
                        "controller" => "director",
                        "action"     => "index"
                    ]
                );
            }
            
            $this->view->form = new DirectorForm($director, array('show' => true, 'edad' => $director->CalculaEdad()));

            $numberPage = 1;
            if ($this->request->getQuery("page", "int")!==null) {
                $numberPage = $this->request->getQuery("page", "int");
            }
            $pelicula = Pelicula::find('id_director="'.$id.'"');
            if (count($pelicula) == 0) {
                $this->flash->notice("Este director no posee peliculas Registradas");
            }

            $paginator = new Paginator(array(
                "data"  => $pelicula,
                "limit" => 10,
                "page"  => $numberPage,
            ));
            $peliculaC=new PeliculaController;
            $peliculaC->view->page = $paginator->getPaginate();
        }
    }

    /**
     * Creates a new director
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "director",
                    "action"     => "index",
                ]
            );
        }

        $form = new DirectorForm;
        $director = new Director();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $director)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "director",
                    "action"     => "new",
                ]
            );
        }

        if ($director->save() == false) {
            foreach ($director->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "director",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("El director ha sido registrado exitosamente");

        return $this->dispatcher->forward(
            [
                "controller" => "director",
                "action"     => "index",
            ]
        );
    }

    /**
     * Saves current director in screen
     *
     * @param string $id
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "director",
                    "action"     => "index",
                ]
            );
        }

        $id = $this->request->getPost("id", "int");

        $director = Director::findFirstById($id);
        if (!$director) {
            $this->flash->error("El director no existe");

            return $this->dispatcher->forward(
                [
                    "controller" => "director",
                    "action"     => "index",
                ]
            );
        }

        $form = new DirectorForm;
        $this->view->form = $form;

        $data = $this->request->getPost();

        if (!$form->isValid($data, $director)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "director",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        if ($director->save() == false) {
            foreach ($director->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "director",
                    "action"     => "edit",
                    "params"     => [$id]
                ]
            );
        }

        $form->clear();

        $this->flash->success("Los datos del director han sido actualizados exitosamente");

        return $this->dispatcher->forward(
            [
                "controller" => "director",
                "action"     => "index",
            ]
        );
    }

    /**
     * Deletes a director
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $director = Director::findFirstById($id);
        if (!$director) {
            $this->flash->error("Director no encontrado");

            return $this->dispatcher->forward(
                [
                    "controller" => "director",
                    "action"     => "index",
                ]
            );
        }

        if (!$director->delete()) {
            foreach ($director->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "director",
                    "action"     => "search",
                ]
            );
        }

        $this->flash->success("Director Eliminado del registro");

            return $this->dispatcher->forward(
                [
                    "controller" => "director",
                    "action"     => "index",
                ]
            );
    }
}
