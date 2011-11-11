<?php
class Persistence {
    //Singleton
    private static $_instance = null;
    public static function getInstance(){
        try {
            if(self::$_instance == null){
                self::$_instance = new Persistence();
            }
        } catch (Exception $e) {
            throw $e;
        }
        return self::$_instance;
        }
    //fin singleton
   private $_cn;
   public function __construct() {
       try {
           $this->_cn=mysql_connect("localhost", "root");
           if(!$this->_cn){
               $this->_cn = null;
               throw new Exception("Error en la conexión del servidor");
           }
           $db = mysql_select_db("chompaalpaca",$this->_cn);
           if(!$db){
               mysql_close($this->_cn);
               $this->_cn = null;
               throw new Exception("Base de datos no existe");
           }

       } catch (Exception $e) {
           error_log($e->getMessage()."\n\n",3,"../log/Error.log");
           throw $e;
       }
    }

    public function executeQuery($sql,$tipo){
        try {
            
            $rs = mysql_query($sql, $this->_cn);
            if(mysql_errno ($this->_cn) != 0){
                throw new Exception(mysql_error($this->_cn));
            }
            else{
                if($tipo==1){
                    $lista = array();
                    while($row = mysql_fetch_assoc($rs)){
                        $lista[] = $row;
                    }
                    mysql_free_result($rs);
                    return $lista;
                }
                else{
                    $status = true;
                    return $status;
                }
            }
        } catch (Exception $e) {
            error_log($e->getMessage()."\n",3,"../log/Error.log");
            error_log("Query:$sql\n\n",3,"../log/Error.log");
            throw $e;
        }
           }



}
$miInstance = Persistence::getInstance();


