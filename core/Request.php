<?php

class Request
{

    /*Definition of variable */
    public $url; /* URL to call by user */
    public $page = 1;
    public $prefix = false; /* By default we consider that there is no prefix in the URL */
    public $data = false;

    function __construct()
    {
        /* I recover URL type by user */
        $this->url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';

        /* ------------------------------------PAGINATION-------------------------- */
        /* I put this here but it's not sure that it remains */


        if (isset($_GET['page'])) {

            /*by security I check that these numerical values */
            if (is_numeric($_GET['page'])) {


                if ($_GET['page'] > 0) {

                    $this->page = round($_GET['page']);
                }
            }
        }


        if (!empty($_POST)) {
            /* I transform data into class */
            $this->data = new stdClass();

            /*Then I browse my $ _POST variable to inject into my new data object */
            foreach ($_POST as $_key => $_value) {

                $this->data->$_key = $_value;
            }
        }
    }
}
