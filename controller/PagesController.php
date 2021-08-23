<?php
class PagesController extends Controller
{


    function accueil()
    {
    }



    function contact()
    {


        $data = $this->request->data;

        /* Vérification que des donnée arrive du formulaire  */
        if (isset($data->sendMessage)) {

            $this->loadModel('Message');

            try {

                $d = $this->Message->postMessage($data->email, $data->obj, $data->content, $data->fullName);

                $this->Session->setFlash('votre message a bien été envoyé');

                $this->redirect('pages/contact');
            } catch (Exception $e) {

                $this->Session->setFlash($e->getMessage(), 'bg-danger', $data);
            }
        }
    }
    function portfolio()
    {
    }
}
