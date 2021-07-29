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
}
