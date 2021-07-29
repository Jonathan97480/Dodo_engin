<?php
class Home extends Model
{
    public $table = 't_home';

    
    /**
     * getHome
     *  return home info presentation and titre & legend
     * @return void
     */
    public function getHome()
    {

        $d = $this->findFirst([
            'conditions' => ['is_active' => 1]
        ]);

        return $d;
    }    
    /**
     * setPresentation
     *  save texte presentation
     * @param  string $presentation
     * @return array|stdClass
     */
    public function setPresentation($presentation)
    {

        $this->save([
            'id' => 1,
            'presentation' => htmlspecialchars($presentation)
        ]);

        $d = $this->getPresentation();

        return $d;
    }    
    /**
     * getPresentation
     *  return text presentation
     * @return array|stdClass
     */
    public function getPresentation()
    {


        $d = $this->findFirst([
            'conditions' => ['id' => 1],
            'fields' => 'presentation'
        ]);

        return $d;
    }
}
