<?php
class ApiController extends Controller
{


    /* key a passer dans le post 'search' */
    function searchPosts()
    {
        $this->loadModel('Post');

        $d = $this->Post->getPostByName($this->request->data->search);



        retour_json(true, '', $d);
    }

    function getAllPlayer()
    {
        $this->loadModel('Justenumber');

        $d = $this->Justenumber->getAllPlayer();

        retour_json(true, "", $d);
    }

    function registrePlayer()
    {

        $e = $this->request->params;

        $this->loadModel('Justenumber');
        /*  debug($e);
        die(); */
        $d = $this->Justenumber->register(
            $e['name'],
            $e['age'],
            $e['score'],
            $e['error'],
            $e['avatar'],
            $e['dif']
        );

        retour_json(true, "", $d);
    }
}
