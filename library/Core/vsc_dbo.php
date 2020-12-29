<?php
/*
 * Dbo Library
 * Support some function to handle for database
 * Creator: LucTV 23/06/2018
 */
class vsc_dbo{
    
    private $pdo;
    
    function __construct(){
        global $core_pdo;
        $this->pdo = $core_pdo;
        
    }
    
}