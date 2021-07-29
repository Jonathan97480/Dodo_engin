<?php
class Model
{

    // Will contain the connection to the database 
    static $connections = array();


    /*Will contain the name of the variable that I want to access in my conf 
     file to retrieve the connection info to connect to the database */
    public $conf = 'default';

    public $table = false;

    public $db;


    //Will contain the primary key which is an id most of the time 
    public $primaryKey = 'id';


    public $errors = array();/* A table where you can store errors */
    /* --------------------------------------------CONNECTION-------------------------------------------------------------------- */
    public function __construct()
    {

        // We initialize some variables 


        /*If the table is empty I get the name of the calsse of my object and I pass it in 
       lowercase by adding an s at the end */
        if ($this->table === false) {
            $this->table = strtolower(get_class($this)) . 's';
        }


        /* I get the connection info to access my database */
        $conf = conf::$databasses[$this->conf];


        /*I check if I am already connected to database if yes I stop reading my construct here */
        if (isset(Model::$connections[$this->conf])) {
            $this->db = Model::$connections[$this->conf];
            return true;
        }

        try {/*If I am not connected I try to start a connection */


            /*We start the connection to the database */
            $pdo = new PDO('mysql:host =' . $conf['host'] . ';dbname=' . $conf['database'] .
                ';', $conf['login'], $conf['password'], array((PDO::MYSQL_ATTR_INIT_COMMAND) => 'SET NAMES utf8'));

            /* I configure my database an attribute so that it returns errors and warnings */
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

            /* Accessible from anywhere */

            /* I store my connection in the connection variable */
            Model::$connections[$this->conf] = $pdo;

            /* Accessible only in this file */

            /* I do the same with my variable db */
            $this->db = $pdo;

            /* We will capture errors and warnings */
        } catch (PDOException $e) {

            /*If debug is enabled */
            if (conf::$debug >= 1) {

                /* We display the errors */
                die($e->getMessage());
            } else {
                /*If debug is disabled we just display a message */
                die('impossible de se Connecter a la base de donnée');
            }
        }
    }

    /* ------------------------------------------------------------------SHEARCH IN DATABASE------------------------------------------------ */
    /*Allows search and retrieve entries in the given database */
    public function find($req, $table = null)
    {
        if ($table == null) {
            $table = $this->table;
        }
        /*If specific fields are sought, they are included with a select */

        $sql = 'SELECT ';

        /* I check if my fields variable contains info */
        if (isset($req['fields'])) {

            /* If it contains info I check if it is an array */
            if (is_array($req['fields'])) {

                /*If it is an array I get its content and I store it in a character 
                string that I separate with a comma */
                $sql .= implode(', ', $$req['fields']);
            } else {

                /*If it is not an array I directly store the content in the variable */
                $sql .= $req['fields'];
            }
        } else { /*If there is no specific fields to search I replace with a star to say that I will recover everything */

            $sql .= '*';
        }
        /* Finally I complete the database request */
        $sql .= ' FROM ' . $table . ' as ' . get_class($this) . ' ';


        /* We build our research conditions */

        /* We check that our conditions variable is declared and that it is not null */
        if (isset($req['conditions'])) {

            /* I add 'WHERE' to my SQL query for add my conditions */
            $sql .= 'WHERE ';

            /*If my conditions variable is not an array */
            if (!is_array($req['conditions'])) {

                /* I add the condition directly */
                $sql .= $req['conditions'];
            } else {/* If it's an array */

                $cond = array();

                foreach ($req['conditions'] as $_key => $_value) {

                    /*Let's do some security*/

                    /*allows to protect from certain html injection  */

                    /*I check that these are not a number */
                    if (!is_numeric($_value)) {

                        /*If it is not a number I add quotes on each side of the field */
                        $_value = $this->db->quote($_value);
                    }

                    /*If it is a number I add it directly to my table */
                    if ($_value == "'null'") {
                        $cond[] = "$_key is null";
                    } else {
                        $cond[] = "$_key=$_value";
                    }
                   
                }
                /* I'm going to add an AND between each element of my array before adding it to my character string */
                $sql .= implode(' AND ', $cond);
            }
        }
        if (isset($req['ORDER BY'])) {
            $sql .= ' ORDER BY  ' . $req['ORDER BY'];
        }
        /*If in my $ req table I have a key called 'limit I add' LIMIT 'to my SQL
          request to define the number of results I want in the database */
        if (isset($req['LIMIT'])) {
            $sql .= ' LIMIT ' . $req['LIMIT'];
        }


        /* I use PDO's prepare () function to prepare my SQL request and it
         will return an object that contains my prepare request  */
        $sql_pre = $this->db->prepare($sql);

        /* I execute my prepared SQL request */
        $sql_pre->execute();

        /*I use the function fetchAll () to return me an array in OBJECT which will contain
          all the results of the request requested from the database */
        return $sql_pre->fetchAll(PDO::FETCH_OBJ);
    }




    /**
     * findFirst
     *Returns the first result of an SQL search 
     * @param  array $req The conditions to generate the query (ex:array('conditions'=>array('id'=>1),fields=>''id','non','))
     *In the example above the conditions will be the values ​​to look for in the database and the fields will be the fields you want to
     * retrieve if you do not prescribe any fields you will return all the fields
     * @return stdclass Returns the result of the query
     */
    public function findFirst(array $req, $table = null)
    {
        return current($this->find($req, $table));
    }

    /*  */


    /**
     * findCount
     *This function returns the number of results that match our search
     * @param  mixed $conditions
     * @return void
     */
    public function findCount($conditions)
    {
        $res = $this->findFirst(array(
            'fields' => 'COUNT(' . $this->primaryKey . ') as count',
            'conditions' => $conditions
        ));
        return $res->count;
    }

    /**
     * @author gauvin Jonathan <jonathanfrt97480@gmail.com>
     * @param int $id entry id delete
     * @param string $table
     * Delete entries in the database
     */
    public function delete($id,$table=null)
    {
        if($table==null){
            $table = $this->table;
        }

        $sql = "DELETE FROM {$table} WHERE {$this->primaryKey} =$id";
        $this->db->query($sql);
    }
    /**
     *@author gauvin Jonathan <jonathanfrt97480@gmail.com>
     * @param stdClass or array $data The data to be backed up
     * @param string $table_name=null
     * @return int $id If a new line has been inserted, return the id of that line
     *Allows you to insert or save database entries 
     */
    public function save($data, string $table_name = null)
    {
        $table = $this->table;

        /* si cest un tableau je le convertie en obj  */
        if (is_array($data)) {

            $t = new  stdClass();
            foreach ($data as $key => $value) {

              $t->$key = $value;
            }

            $data = $t;
            unset($t);
        }

        if ($table_name != null) {
            $table = $table_name;
        }

        $key = $this->primaryKey;
        $fields = array();
        $d = array();
        if (isset($data->$key) &&  $data->$key == '') {

            unset($data->$key);
        }
        foreach ($data as $_key => $_value) {
            $fields[] = "$_key=:$_key";
            $d[":$_key"] = $_value;
        }
      
        if (isset($data->$key) && !empty($data->$key) && $data->$key != '') {
            $sql = 'UPDATE ' . $table . ' SET ' . implode(',', $fields) . ' WHERE ' . $key . '=:' . $key;


            $action = 'update';
        } else {


            $sql = 'INSERT INTO ' . $table . ' SET ' . implode(',', $fields);
            $action = 'insert';
        }

        $pre = $this->db->prepare($sql);

        $pre->execute($d);

        if ($action == 'insert') {

            return  $this->db->lastInsertId();
        }
    }
    /**
     * @param $req The prepared request
     * @param $data The data associated with the request
     * @return array the results of your query as an array (FETCH_OBJ)
     */
    public function prepared_request($req, $data): array
    {
        $pre = $this->db->prepare($req);
        $pre->execute($data);
        return  $pre->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @author gauvin Jonathan <jonathanfrt97480@gmail.com>
     * @param $req The SQL query you want to run
     * @return array  
     * Returns the results of your query as an array (FETCH_OBJ)
     */
    public function query($req): array
    {
        $d = $this->db->query($req);

        if (strpos($req, 'DELETE') == false) {

            return $d->fetchAll(PDO::FETCH_OBJ);
        }
    }

    /**
     * @author gauvin Jonathan <jonathanfrt97480@gmail.com>
     * @param string $userKey The user key who wants to connect to the API
     * @return bool  
     * If the user returns false with an incorrect key if returns true he has his key recognized as valid
     */
    public function CheckUserKey($userKey = null): bool
    {

        $sql = "SELECT * FROM app_key WHERE key_app=" . $userKey;
        $d = $this->query($sql);

        if (!empty($d)) {
            return true;
        }

        return false;
    }
}
