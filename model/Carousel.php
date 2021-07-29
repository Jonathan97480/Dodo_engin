<?php
class Carousel extends Model
{
    public $table = 't_carousel';


    /**
     * getCarousel
     *  return list url img for carousel by tafCarousel 
     * @param  string $tagCarousel
     * @return array|stdClass
     */
    public function getCarousel($tagCarousel)
    {

        $sql = "SELECT * FROM " . $this->table . " 
        LEFT JOIN carousel_has_medias_ ON carousel_has_medias_.id_carousel=" . $this->table . ".id 
        LEFT JOIN t_medias ON t_medias.id = carousel_has_medias_.id_medias 
        WHERE tag='$tagCarousel'";

        $d = $this->query($sql);
        if (empty($d)) {
            return null;
        }

        return $d;
    }
}
