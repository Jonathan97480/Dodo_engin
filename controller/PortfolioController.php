<?php

class PortfolioController extends Controller
{


    public function index()
    {

        $this->loadModel('Post');


        $d['projet'] = $this->Post->GetArticleByType('projet', $this->request->page);

        $this->set($d);
    }

    public function view($id)
    {

        $this->loadModel('Post');


        $d['projet'] = $this->Post->getProjet($id);

        $this->set($d);
    }
}
