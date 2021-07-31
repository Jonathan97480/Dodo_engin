<?php

class PortfolioController extends Controller
{


    public function index()
    {

        $this->loadModel('Post');


        $d = $this->Post->GetListProjet();



        $this->set($d);
    }

    public function view_all($cat = null)
    {

        if (!empty($cat)) {

            $this->loadModel('Post');

            $d['content'] = $this->Post->getProjetByTag($cat);


            $this->set($d);
        } else {

            $this->redirect('portfolio/index');
        }
    }


    public function view($id)
    {

        $this->loadModel('Post');


        $d['projet'] = $this->Post->getProjet($id);

        $this->set($d);
    }
}
