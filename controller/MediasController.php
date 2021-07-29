<?php
class MediasController extends Controller
{


    /**
     * admin_index
     *The gallery page in the administration
     * @return void
     */
    function admin_index()
    {
        $this->theme = 'modal';
        $this->loadModel('Media');
        $d['images'] = $this->Media->get_all_img()->list;
        $this->set($d);
    }


    /**
     * admin_delete
     *This function is called to delete an image
     * @param  int $id
     */
    function admin_delete($id)
    {
        $this->loadModel('Media');

        $d = $this->Media->delete_img($id);
        if (empty($d->error)) {
            $this->Session->setFlash("Votre image est bien Supprimer");
            $this->redirect('admin/medias/galerie/');
        } else {

            $this->Session->setFlash($d->error[100], "bg-danger");
            $this->redirect('admin/medias/galerie/');
        }
    }

    /**
     * admin_save
     *Call to save an image in gallery
     * @param  mixed $id
     * @return void
     */
    function admin_save($id = '')
    {
        $this->loadModel('Media');
        if ($id == '') {


            $this->Media->upload($_FILES['file']);
        }
        if(isset($this->request->data) && !empty($this->request->data)){
            $this->Media->save($this->request->data);
        }
      
        $this->redirect('admin/medias/galerie/');
    }

    /**
     * admin_upload
     *Function called to save an image with tinymce
     * @return void
     */
    function admin_upload()
    {
        $this->loadModel('Media');

        $this->theme = 'clear';

        $d['file'] = $this->Media->uploadTyni($_FILES);



        $this->set($d);
    }

    /**
     * admin_galerie
     * Show gallery page
     */
    function admin_galerie()
    {
        $this->loadModel('Media');
        $d['pic'] = $this->Media->getGaleriePicture();
        $this->set($d);
    }
}
