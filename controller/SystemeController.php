
<?php
class SystemeController extends Controller
{
    function admin_settings()
    {
        $this->loadModel('Rgpd');
        $this->loadModel('Reseau');
        $this->loadModel('Email');

        /* Si des info son poster On met ajour les info avant de les afficher  */
        if (isset($this->request->data) && !empty($this->request->data)) {

            /* on vérifie si la demande de mise à jour vient du Formulaire  rgpd */
            if (isset($this->request->data->rgpd)) {

                unset($this->request->data->rgpd);

                $this->Rgpd->save($this->request->data);

                $this->Session->setFlash("Les mentions légales ont été mis à jour");

                /* on vérifie si la demande de mise à jour vient du Formulaire  Réseau */
            } elseif (isset($this->request->data->reseau)) {

                unset($this->request->data->reseau);

                $this->Reseau->save($this->request->data);

                $this->Session->setFlash('Les infos des réseau ont été mis à jour');

                /* on vérifie si la demande de mise à jour vient du Formulaire  email */
            } elseif (isset($this->request->data->message)) {

                unset($this->request->data->message);

                $this->Email->save($this->request->data);

                $this->Session->setFlash('Les e-mails automatiques ont été mis à jour');
            }
        }

        if ($this->request->params['value'] == 'rgpd') {

            $d['rgpd'] = $this->Rgpd->find(array());
        } elseif ($this->request->params['value'] == 'reseau') {

            $d['reseau'] = $this->Reseau->find(array());
        } elseif ($this->request->params['value'] == 'email') {

            $d['email'] = $this->Email->find(array());
        }


        $this->set($d);
    }

    /* CHART */
    function admin_index()
    {
        $this->loadModel('Post');
        $this->loadModel('Message');



        $d['numberPost'] = $this->Post->GetNumberArticle('post');
        $d['numberProjet'] = $this->Post->GetNumberArticle('projet');
        $d['numberMessageNoRead'] = $this->Message->countMessages();
        $d['numberMessageRead'] = $this->Message->countMessages(true);



        $this->set($d);
    }
    #region Role

    function admin_roles_list()
    {
        $this->loadModel('User');

        $d['roles'] = $this->User->getListeRoles();
        $this->set($d);
    }
    function admin_add_role($id = null)
    {

        $this->loadModel('User');

        if (!empty($this->request->data->role_name)) {

            $role = $this->request->data;

            $d['role'] = $this->User->saveRole($role->role_name, $role->description_role, $_FILES['thumbnail'], $id);

            if (isset($d['role']->error)) {

                foreach ($d['role']->error as $key => $value) {

                    $this->Session->setFlash($value, 'bg-danger', $role);
                }
            } else {

                $this->Session->setFlash('Le Role est sauvgarder', 'bg-success');

                $this->redirect('systeme/admin_add_role/id:' . $d['role']->id);
            }
        } elseif (!empty($id)) {

            $d['role'] = $this->User->getRoleById($id);

            if (isset($d['role']->error)) {

                foreach ($d['role']->error as $key => $value) {

                    $this->Session->setFlash($value, 'bg-danger');
                }
            }


            $this->set($d);
        }
    }

    function deleteRole($id)
    {

        $this->loadModel('User');

        $d = $this->User->deleteRole($id);

        if (isset($d->error)) {

            foreach ($d->error as $key => $value) {

                $this->Session->setFlash($value, 'bg-danger');
                $this->redirect('systeme/admin_add_role/id:' . $id);
            }
        }

        $this->Session->setFlash('Le rôle a bien été supprimé', 'bg-success');
        $this->redirect('systeme/admin_roles_list');
    }
    #endregion
    #region Tag 
    function admin_tag_list()
    {
        $this->loadModel('Cathegorie');

        $d['tags'] = $this->Cathegorie->getListeTags();
        $this->set($d);
    }

    function admin_add_tag($id = null)
    {
        $this->loadModel('Cathegorie');
        $d['allTag'] = $this->Cathegorie->getListeTags($id);
        if (!empty($this->request->data->name)) {

            $tag = $this->request->data;

            $d['tag'] = $this->Cathegorie->saveTag($tag->name, $tag->description, $_FILES['thumbnail'], $id, $tag->tag_parents);

            if (isset($d['tag']->error)) {

                foreach ($d['tag']->error as $key => $value) {

                    $this->Session->setFlash($value, 'bg-danger', $tag);
                }
            } else {

                $this->Session->setFlash('Le tag est sauvgarder', 'bg-success');

                $this->redirect('systeme/admin_add_tag/id:' . $d['tag']->id);
            }
        } elseif (!empty($id)) {

            $d['tag'] = $this->Cathegorie->getTagById($id);

            if (isset($d['tag']->error)) {

                foreach ($d['tag']->error as $key => $value) {

                    $this->Session->setFlash($value, 'bg-danger');
                }
            }
        }
        $this->set($d);
    }

    function deleteTag($id)
    {

        $this->loadModel('Cathegorie');

        $d = $this->Cathegorie->deleteTag($id);

        if (isset($d->error)) {

            foreach ($d->error as $key => $value) {

                $this->Session->setFlash($value, 'bg-danger');
                $this->redirect('systeme/admin_add_tag/id:' . $id);
            }
        }

        $this->Session->setFlash('Le tag a bien été supprimé', 'bg-success');
        $this->redirect('systeme/admin_tag_list');
    }
    #endregion
    #region Categories
    function admin_categorie_list()
    {
        $this->loadModel('Cathegorie');

        $d['categories'] = $this->Cathegorie->getListeCathegorie();
        $this->set($d);
    }

    function admin_add_categorie($id = null)
    {
        $this->loadModel('Cathegorie');
        $d['allCategorie'] = $this->Cathegorie->getListeCathegorie($id);
        if (!empty($this->request->data->name)) {

            $categorie = $this->request->data;

            $d['categorie'] = $this->Cathegorie->saveCathegorie(
                $categorie->name,
                $categorie->description,
                $_FILES['thumbnail'],
                $id,
                $categorie->categorie_parent
            );

            if (isset($d['categorie']->error)) {

                foreach ($d['categorie']->error as $key => $value) {

                    $this->Session->setFlash($value, 'bg-danger', $categorie);
                }
            } else {

                $this->Session->setFlash('La categorie est sauvgarder', 'bg-success');

                $this->redirect('systeme/admin_add_categorie/id:' . $d['categorie']->id);
            }
        } elseif (!empty($id)) {

            $d['categorie'] = $this->Cathegorie->getCategorieById($id);

            if (isset($d['categorie']->error)) {

                foreach ($d['categorie']->error as $key => $value) {


                    $this->Session->setFlash($value, 'bg-danger');
                }
            }
        }
        $this->set($d);
    }

    function deleteCategorie($id)
    {

        $this->loadModel('Cathegorie');

        $d = $this->Cathegorie->deleteCategorie($id);

        if (isset($d->error)) {

            foreach ($d->error as $key => $value) {

                $this->Session->setFlash($value, 'bg-danger');
                $this->redirect('systeme/admin_add_categorie/id:' . $id);
            }
        }

        $this->Session->setFlash('La categorie a bien été supprimé', 'bg-success');
        $this->redirect('systeme/admin_categorie_list');
    }
    function clearCategorie($id, $idCat)
    {
        $this->loadModel('Cathegorie');
        if ($this->Cathegorie->clearParentCategorie($idCat))
            $this->Session->setFlash('La catégorie a été enlevée en tant que enfant ', 'bg-success');
        $this->redirect('systeme/admin_add_categorie/id:' . $id);
    }
    #endregion
    #region Users 


    /**
     * admin_users_list
     *Pages in the administration which displays the list of users
     * and which allows you to search this list
     *
     */
    function admin_users_list()
    {
        $this->loadModel('User');

        if (isset($this->request->data) && !empty($this->request->data)) {

            $data = $this->request->data;

            $users['Users'] = $this->User->find_users($data->cherche)->info;
        } else {

            $users['Users'] = $this->User->find_users()->info;
        }

        $this->set($users);
    }


    function admin_add_user($id = null)
    {

        $this->loadModel('User');

        $d['roles'] = $this->User->getListeRoles();

        $data = $this->request->data;

        if (isset($data->saveUser)) {

            if (!isset($data->role)) {
                $data->role = null;
            }
            if (!isset($data->isActive)) {
                $data->isActive = null;
            }
            $result = $this->User->register(

                $data->name,
                $data->first_name,
                $data->login,
                $data->email,
                $data->password,
                $data->address,
                $data->address_2,
                $data->zip_code,
                $data->phone,
                $data->city,
                $data->role,
                $data->count_active,
                $_FILES,
                $id
            );
            if (!empty($result->error)) {
                /* Return error */
                foreach ($result->error as $key => $value) {

                    $this->Session->setFlash($value, 'bg-danger', $data);
                    return;
                }
            } else {

                $this->Session->setFlash('les infos de l\'utilisateur a été sauvegardé');

                /* check if the modified user id matches the login user id */
                if ($id == $this->Session->user('id')) {

                    /* retrieval of user information from the database */
                    $d['user'] = $this->User->loadInfoUser($id);

                    /* Session update*/
                    $this->Session->write('User', $d['user']);
                }
                /*redirection to the add user form by passing the id in the url*/
                $this->redirect('systeme/admin_add_user/id:' . $result->info->id);
            }
        }

        if (!empty($id)) {
            $d['user'] = $this->User->loadInfoUser($id);
        }
        $this->set($d);
    }


    function admin_deleteUser($id)
    {

        $this->loadModel('User');

        $d =  $this->User->deleteUser($id);

        if (isset($d->error)) {

            foreach ($d->error as $key => $value) {
                $this->Session->setFlash($value, 'bg-danger');
            }

            $this->redirect('systeme/admin_users_list');
        }
        $this->redirect('systeme/admin_users_list');
    }
    #endregion
    #region Post
    function admin_post_edit($id = null)
    {

        $this->loadModel('Post');
        $this->loadModel('Cathegorie');

        $idreturn = "";

        $d['allCategorie'] = $this->Cathegorie->getListeCathegorie($id);

        if (isset($this->request->data->saveArticle)) {

            $data = $this->request->data;

            if (!isset($data->categorieListe))
                $data->categorieListe = null;

            if (!isset($data->online)) {
                $data->online = null;
            }

            try {

                $idreturn = $this->Post->setPost(
                    $data->name,
                    $data->description,
                    $data->content,
                    $data->type,
                    $data->online,
                    $data->categorieListe,
                    $_FILES['img'],
                    $id
                );

                if (is_numeric($idreturn)) {

                    $id = $idreturn;
                    $this->Session->setFlash('votre Post a été sauvegardé de succès', 'bg-succes', $idreturn);
                }

                if ($id != null) {

                    $d['post'] = $this->Post->getPostById($id);
                }
            } catch (Exception $e) {

                $this->Session->setFlash($e->getMessage(), 'bg-danger', $idreturn);

                if ($id != null) {

                    $this->redirect('systeme/admin_post_edit/id:' . $id, $data);
                } else {

                    $this->redirect('systeme/admin_post_edit', $data);
                }
            }
        }



        $this->set($d);
    }


    function admin_post_index()
    {

        $this->loadModel('Post');


        $d = $this->Post->GetlisteArticle(null, $this->request->page);

        $this->set($d);
    }

    function admin_deletePost($id)
    {

        $this->loadModel('Post');
        $this->Post->deletePost($id);
        $this->Session->setFlash('Le contenu a bien été supprimé');
        $this->redirect('systeme/admin_post_index', 302);
    }

    #endregion
    #region info site
    function admin_infoGenerale()
    {

        if (isset($this->request->data) && !empty($this->request->data)) {

            $this->loadModel('SiteInfo');

            $this->SiteInfo->save($this->request->data);

            /* Mise ajour de la variable session site_info */
            $_SESSION['site_info'] = $this->SiteInfo->findFirst(array(

                'conditions' => array('id' => 1)

            ));

            $this->Session->setFlash('Les infos du site ont été mis à jour', 'bg-gradient-success text-center');
        }
    }

    #endregion
    #region Galerie

    function admin_getInfoGalerie($id)
    {

        $this->loadModel('Media');
        $this->loadModel('Cathegorie');

        $d['info'] = $this->Media->getInfoPicture($id);
        $d['tagList'] = $this->Cathegorie->getListeTags();

        retour_json(true, 'tous marche bien', $d);
    }
    function setInfoPicture()
    {
        $this->loadModel('Media');

        $tags = null;
        $isGalerie = null;

        if (isset($this->request->data->tags))
            $tags = $this->request->data->tags;

        if (isset($this->request->data->isgalerie))
            $isGalerie =  $this->request->data->isgalerie;

        $info = $this->Media->saveInfoPicture(
            $this->request->data->name,
            $this->request->data->info,
            $tags,
            $this->request->data->id,
            $isGalerie
        );

        retour_json(true, 'info Update', $info);
    }

    function uploadImg()
    {
        /*  die(debug($_FILES)); */
        $this->loadModel('Media');

        $d = $this->Media->upload($_FILES['add-picture']);


        retour_json(true, 'ok ma poll', $d);
    }
    function deleteImg($id)
    {

        $this->loadModel('Media');

        $d['delete'] = $this->Media->delete_img($id);

        retour_json('true', 'delete picture', $d);
    }
    #endregion
    #region Rgpd & LegalNotive
    function setRgpdUser($valid)
    {

        if ($valid == 'valide') {
        } else {
        }

        $validate = new stdClass();
        $validate->responce = true;
        $this->Session->write('rgpd', $validate);
    }

    function getRgpdTexte()
    {
        $this->loadModel('Rgpd');
        $d = $this->Rgpd->getTextRgpd();

        retour_json('true', 'get Text rgpd', $d);
    }
    function getLegalNotiveTexte()
    {
        $this->loadModel('Rgpd');
        $d = $this->Rgpd->getTextLegalNotive();

        retour_json('true', 'get Text rgpd', $d);
    }

    function admin_rgpd()
    {
        $this->loadModel('Rgpd');
        $data = $this->request->data;

        if (isset($data->save)) {

            if (isset($data->rgpd)) {

                /* save Rgpd Text Popup */
                $this->Rgpd->saveRgpd($data->info);
                $this->Session->setFlash('Les infos de rgpd ont bien été mis à jour', 'bg-success');
            } else {

                /* save Text Legal Notice */
                $this->Rgpd->saveLegalNotive($data->info);
                $this->Session->setFlash('Les infos de mention légal ont bien été mis à jour', 'bg-success');
            }
        }

        /* Load Info Rgpd is Legal Notice */
        $d = $this->Rgpd->loadInfoRgpd();

        /* send data  the view  */
        $this->set($d);
    }

    #endregion
    #region message
    public function admin_message($id = null)
    {

        $this->loadModel('Message');

        if ($id == null) {

            $d['meesages'] = $this->Message->getAllmessage();
        } else {

            try {
                $d['MessageRead'] = $this->Message->readMessage($id);
            } catch (Exception $e) {


                $this->Session->setFlash($e->getMessage(), 'bg-danger');
                $this->redirect('systeme/admin_message');
            }
        }

        $this->set($d);
    }

    public function deleteMessage($id)
    {

        try {

            /* Vérification que l'id n'est pas vide  */
            if (empty($id)) {

                $this->Session->setFlash('Vous devez préciser un message à supprimer', 'bg-danger');
                $this->redirect('systeme/admin_message');
            }

            /* Traitement de la demande de suppression  */
            $this->loadModel('Message');

            $d = $this->Message->deleteMessage($id);

            $this->Session->setFlash('Le message a bien été supprimé',);

            $this->redirect('systeme/admin_message');
        } catch (Exception $e) {

            $this->Session->setFlash($e->getMessage(), 'bg-danger');
        }
    }

    public function getNewMessage()
    {

        $this->loadModel('Message');

        $d = $this->Message->getNewMessages();

        retour_json('true', 'new message', $d);
    }


    #endregion

}
