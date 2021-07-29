<?php
class Rgpd extends Model
{
    public $table = 't_rgpd';

    /**
     * saveRgpd
     *  save rgpd popup text
     * @param  string $description
     * @return void
     */
    public function saveRgpd($description)
    {

        $this->primaryKey = 'name';
        $this->save([
            'name' => 'rgpd',
            'description' => $description
        ]);
    }
    /**
     * saveLegalNotive
     *  save legal notive texte
     * @param  string $description
     * @return void
     */
    public function saveLegalNotive($description)
    {

        $this->primaryKey = 'name';
        $this->save([
            'name' => 'legal_notive',
            'description' => $description
        ]);
    }

    /**
     * getTextRgpd
     * return text rgpd
     * @return array|stdClass
     */
    public function getTextRgpd()
    {

        $info = $this->findFirst([
            'conditions' => ['name' => 'rgpd']
        ]);

        return $info;
    }
    /**
     * getTextLegalNotive
     *  return text legal notive
     * @return void
     */
    public function getTextLegalNotive()
    {
        $info = $this->findFirst([
            'conditions' => ['name' => 'legal_notive']
        ]);

        return $info;
    }
    /**
     * loadInfoRgpd
     *  return rgpd and legal notive text
     * @return array|stdClass
     */
    public function loadInfoRgpd()
    {
        $info = [];
        $d = $this->find([]);

        foreach ($d as $key => $value) {
            $info[$value->name] = $value;
        }

        return $info;
    }
}
