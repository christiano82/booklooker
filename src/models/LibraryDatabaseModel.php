<?php

namespace App\lf8\models;

use App\lf8\db\BaseDatabase;

class LibraryDatabaseModel extends BaseDatabase 
{
    private $_config;

    function __construct($config)
    {
        $this->_config = $config;
        parent::__construct($config['db']);
    }

    /**
     * get all tablenames
     *
     * @return array
     */
    function getTableNames() : array 
    {
        return parent::getTableNames();
    }

    /**
     * loads everything
     *
     * @param array $tblNames
     * @return array
     */
    function readTables(array $tblNames) : array 
    {
        return $this->readAllTables($tblNames);
    }

    function readBookSelect() 
    {
        $stmt = "select buecher_id,titel from buecher order by titel";
        $this->query($stmt);
        return $this->fetchAssoc();
    }
    /**
     * read one book entry with everything that this entry is made of
     * * table buecher
     * * sparten
     * * autoren
     * * verlage with orte
     * @param [type] $bookId
     * @return array
     */
    function getBookEntry($bookId) : array 
    {
        $stmt = "select * from buecher where buecher_id = $bookId;";
        // es kann 1 buch mehrere autoren haben und mehrere sparten
        $this->query($stmt);
        // var_dump($this->fetchAssoc());
        $book = $this->fetchAssoc()[0];
        $result = array(
            'book'=>$book,
            'autoren'=>$this->getAutoren($bookId),
            'verlag'=>$this->getVerlag($book['verlage_verlage_id'])[0],
            'sparten'=>$this->getSparten($bookId),
            'lieferanten'=>$this->getLieferanten($bookId)
        );
        return $result;
    }
    function getAutoren($bookId) 
    {
        $autoren = "select * from autoren a join autoren_has_buecher ahb on a.autoren_id = ahb.autoren_autoren_id where ahb.buecher_buecher_id = $bookId";
        $this->query($autoren);
        return $this->fetchAssoc();
    }
    function getVerlag($verlagId) 
    {
        $verlag = "select v.name,v.verlage_id,o.orte_id,o.name as ort,o.postleitzahl from verlage v,orte o where v.verlage_id=$verlagId and o.orte_id = v.orte_orte_id";
        $this->query($verlag);
        return $this->fetchAssoc();
    }
    function getSparten($bookId) 
    {
        $sparten = "select s.bezeichnung,s.sparten_id from sparten s join buecher_has_sparten bhs on bhs.sparten_sparten_id = s.sparten_id where bhs.buecher_buecher_id = $bookId";
        $this->query($sparten);
        return $this->fetchAssoc();
    }
    function getLieferanten($bookId) 
    {
        $lieferanten = "select l.name,l.lieferanten_id,o.orte_id,o.name as ort,o.postleitzahl from lieferanten l join buecher_has_lieferanten bhl on 
        bhl.lieferanten_lieferanten_id = l.lieferanten_id 
        join orte o on l.orte_orte_id = o.orte_id 
        where bhl.buecher_buecher_id = $bookId 
        and l.orte_orte_id = o.orte_id";
        $this->query($lieferanten);
        return $this->fetchAssoc();
    }

}

?>