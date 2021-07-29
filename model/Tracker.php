<?php
class Tracker extends Model
{

    public $table = 't_tracker';

    /**
     * getListIP
     * return the list of ip present in the DB
     * @param  mixed $dateCurent
     * @return void
     */
    public function getListIP($dateCurent)
    {

        $listeIp = $this->find([
            'conditions' => ['date_connection' => $dateCurent],
            'fields' => 'ip_user'
        ]);
        return $listeIp;
    }

    /**
     * Addip
     * add  visitor ip in the DB
     * @param  mixed $dateCurent
     * @param  mixed $ipVisitor
     * @return void
     */
    public function Addip($dateCurent, $ipVisitor)
    {

        $info = [
            'date_connection' => $dateCurent,
            'ip_user' => $ipVisitor
        ];

        $this->save($info);
    }
}
