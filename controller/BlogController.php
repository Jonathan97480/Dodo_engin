<?php

class BlogController extends Controller
{


    public function index()
    {

        $this->loadModel('Post');


        $d['blog'] = $this->Post->GetArticleByType('post', $this->request->page);

        $this->set($d);
    }

    public function view($id)
    {

        $this->loadModel('Post');


        $d['blog'] = $this->Post->getPost($id);

        $this->set($d);
    }
}
