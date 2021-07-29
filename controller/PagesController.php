<?php
class PagesController extends Controller
{


    function accueil()
    {
    }


    function services()
    {
    }
    function contact()
    {
        $this->loadModel('Message');

        $data = $this->request->data;

        if (isset($data->sendMessage)) {

            $d = $this->Message->postMessage($data->email, $data->obj, $data->content, $data->fullName);

            if (isset($d->error)) {

                foreach ($d->error as $key => $value) {

                    $this->Session->setFlash($value, 'bg-danger', $data);
                    $this->redirect('pages/contact');
                }
            }/* end test error */
            $this->Session->setFlash('votre message a bien été envoyé');
            $this->redirect('pages/contact');
        }/* end check message is send */
    }
    function portfolio()
    {
    }

    function site_static(){

    }

    public function site_dynamique(){

    }
    public function application_mobile(){
    
    }
}
