<?php



class postsEntity {

    private $id;

    private $title;

    private $content;

    private $date;

    private $user_id;

    private $relations = array("comments"=>array("id"=>"post_id"), "users"=>array("user_id"=>"id"));

    private $comments;

    private $users;



    /********************** GETTER ***********************/


    public function getId(){
        return $this->id;
    }



    public function getTitle(){
        return $this->title;
    }



    public function getContent(){
        return $this->content;
    }



    public function getDate(){
        return $this->date;
    }



    public function getUser_id(){
        return $this->user_id;
    }


    /********************** SETTER ***********************/

    public function setId($val){
        $this->id =  $val;
    }



    public function setTitle($val){
        $this->title =  $val;
    }



    public function setContent($val){
        $this->content =  $val;
    }



    public function setDate($val){
        $this->date =  $val;
    }



    public function setUser_id($val){
        $this->user_id =  $val;
    }



    /********************** Delete ***********************/

    public function Delete(){

        if(!empty($this->id)){

            $sql = "DELETE FROM posts WHERE id = ".intval($this->id).";";

            $result = TzSQL::getPDO()->prepare($sql);
            $result->execute();

            return $result;
        }
        else{
            DebugTool::$error->catchError(array('Fail delete', __FILE__,__LINE__, true));
            return false;
        }
    }


    /********************** Update ***********************/

    public function Update(){

        $sql = 'UPDATE `posts` SET `id` = "'.$this->id.'", `title` = "'.$this->title.'", `content` = "'.$this->content.'", `date` = "'.$this->date.'", `user_id` = "'.$this->user_id.'" WHERE id = '.intval($this->id);

        $result = TzSQL::getPDO()->prepare($sql);
        $result->execute();

        if(!empty($this->id)){
            if($result)
                return true;
            else{
                DebugTool::$error->catchError(array('Fail update', __FILE__,__LINE__, true));
                return false;
            }
        }
        else{
            DebugTool::$error->catchError(array('Fail update: primkey is null', __FILE__,__LINE__, true));
            return false;
        }
    }

    /********************** Insert ***********************/

    public function Insert(){

        $this->id = '';

        $sql = 'INSERT INTO posts (`id`,`title`,`content`,`date`,`user_id`) VALUES ("'.$this->id.'","'.$this->title.'","'.$this->content.'","'.$this->date.'","'.$this->user_id.'")';

        $result = TzSQL::getPDO()->prepare($sql);
        $result->execute();

        if($result){
            $lastid = TzSQL::getPDO()->lastInsertId();
            $this->id = $lastid;
            return true;
        }
        else{
            DebugTool::$error->catchError(array('Fail insert', __FILE__,__LINE__, true));
            return false;
        }
    }


    /********************** FindAll ***********************/
    public function findAll(){

        $sql = 'SELECT * FROM posts';
        $result = TzSQL::getPDO()->prepare($sql);
        $result->execute();
        $formatResult = $result->fetchAll(PDO::FETCH_ASSOC);
        $entitiesArray = array();

        foreach ($formatResult as $key => $data) {

            $tmpInstance = new postsEntity();

            foreach ($data as $k => $value) {

                $method = 'set'.ucfirst($k);
                $tmpInstance->$method($value);

                foreach($this->relations as $relationId => $relationLinks){
                    if(array_key_exists($k, $relationLinks)){
                        $entity = tzSQL::getEntity($relationId);
                        $content = $entity->findManyBy($relationLinks[$k],$value);
                        $tmpInstance->$relationId = $content;
                    }
                }

            }
            array_push($entitiesArray, $tmpInstance);
        }

        if(!empty($entitiesArray))
            return $entitiesArray;
        else{
            DebugTool::$error->catchError(array('No results', __FILE__,__LINE__, true));
            return false;
        }

    }

    /************* FindOneBy(column, value) ***************/
    public function findOneBy($param,$value){


        switch ($param){

            case $param == 'id':
                $param = 'id';
                break;

            case $param == 'title':
                $param = 'title';
                break;

            case $param == 'content':
                $param = 'content';
                break;

            case $param == 'date':
                $param = 'date';
                break;

            case $param == 'user_id':
                $param = 'user_id';
                break;

            default:
                DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
                return false;
        }

        $sql =  'SELECT * FROM posts WHERE '.$param.' = "'.$value.'"';
        $data = TzSQL::getPDO()->prepare($sql);
        $data->execute();
        $result =  $data->fetch(PDO::FETCH_OBJ);

        if(!empty($result)){
            $this->id = $result->id;
            $this->title = $result->title;
            $this->content = $result->content;
            $this->date = $result->date;
            $this->user_id = $result->user_id;

            return true;
        }
        else{
            DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
            return false;
        }
    }



    /********************** Find(id) ***********************/
    public function find($id){

        $sql = 'SELECT * FROM posts WHERE id = ' . $id;
        $result = TzSQL::getPDO()->prepare($sql);
        $result->execute();
        $formatResult = $result->fetch(PDO::FETCH_OBJ);
        if(!empty($formatResult)){
            $this->id = $formatResult->id;
            $this->title = $formatResult->title;
            $this->content = $formatResult->content;
            $this->date = $formatResult->date;
            $this->user_id = $formatResult->user_id;

            return true;
        }
        else{
            DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
            return false;
        }
    }


    /************* FindManyBy(column, value) ***************/
    public function findManyBy($param,$value){


        switch ($param){

            case $param == 'id':
                $param = 'id';
                break;

            case $param == 'title':
                $param = 'title';
                break;

            case $param == 'content':
                $param = 'content';
                break;

            case $param == 'date':
                $param = 'date';
                break;

            case $param == 'user_id':
                $param = 'user_id';
                break;

            default:
                DebugTool::$error->catchError(array('Colonne introuvable: est-elle presente dans la base de donnée ?', __FILE__,__LINE__, true));
                return false;
        }

        $sql =  'SELECT * FROM posts WHERE '.$param.' = "'.$value.'"';
        $data = TzSQL::getPDO()->prepare($sql);
        $data->execute();
        $formatResult = $data->fetchAll(PDO::FETCH_ASSOC);
        $entitiesArray = array();

        if(!empty($formatResult)){

            foreach ($formatResult as $key => $data) {

                $tmpInstance = new postsEntity();

                foreach ($data as $k => $value) {

                    $method = 'set'.ucfirst($k);
                    $tmpInstance->$method($value);
                }
                array_push($entitiesArray, $tmpInstance);
            }

            if($entitiesArray)
                return $entitiesArray;
            else{
                DebugTool::$error->catchError(array('Result is null', __FILE__,__LINE__, true));
                return false;
            }

        }
    }



}

?>
                        


