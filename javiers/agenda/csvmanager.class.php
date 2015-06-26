<?php
namespace Javiers\Agenda;
/**
 *
 * @author E355352 Javier Moniz
 *
 * Class that will add delete insert and update registers from a given CSV.
 * Its primary key would be its telephone number [2]
 * Data Example given
 * Michal,506088156,Michalowskiego 41
 * Marcin,502145785,Opata Rybickiego 1
 * Piotr,504212369,Horacego 23
 * Albert,605458547,Jan PawÅ‚a 67
 *
 */
class csvmanager
{
    /**
     * @var csvmanager  Singleton instance
     */
    protected static $instance;
    /**
     * @var stdClass CSV to memory
     */
    protected $csv;
    /**
     * Singleton returns Instanced class
     * @return csvmanager
     */
    static function getInstance($path)
    {
        if (!isset(self::$instance))
        {
            self::$instance = new self($path);
        }
        return self::$instance;
    }
    /**
     * Singleton avoids cloning the object
     */
    function __clone() {
        trigger_error( "Cannot clone instance of Singleton pattern.", E_USER_ERROR );
    }
   
    /**
     * Constructor that Instances CSV object in memory
     * @param string $path
     */
    protected function __construct($path)
    {
        $this->csv = new \stdClass;
        $this->csv->path = $path;
        //  create de CSV pointer
        $fp = @fopen($this->csv->path, 'r') or die('The file cannot be opened');
        $i=0;// this is added to give IDs to the list that are not include, we will use it as PRIMARY key to fecht correct 
        // data in case of duplicated items 
        while (($row = fgetcsv($fp, 4096, ',', '"')) !== false)
        {
            array_push($row,"$i"); // add the id to the data
            //$row = array_map("addslashes", $row);
            $row = array_map("utf8_encode", $row);
            // http://stackoverflow.com/questions/8882090/utf-8-problems-while-reading-csv-file-with-fgetcsv
            $this->csv->contact[] = array_combine(array("name","telephone","address","id"), $row);
            $i++;
        }
        // close file pointer
        fclose($fp);
    }
    /**
     * Returns CSV loaded in memory
     * @return array
     */
    function getCsv()
    {
        return  $this->csv;
    }
    /**
     * will add new contact
     * @param array $contact
     */
    function add(array $contact)
    {
        $this->csv->contact[] = $contact;
        return $this;
    }
    /**
     * Updates contact information , we use the added ID as primary Key
     * @param array $contact
     */
    function update(array $contact)
    {
        foreach($this->csv->contact as $key => &$value)
        {
             if($value['id'] == $contact['id'])
            {
                 $value=$contact;
                break;
            }
        }
        return $this;
    }
    /**
     * Deletes a contact by its added id
     * @param string $id
     */
    function delete($id)
    {
        foreach($this->csv->contact as $key => &$value)
        {
            if($value['id'] == $id)
            {
                unset($this->csv->contact[$key]);
                break;
            }
        }
        return $this;
    }
    /**
     * Write the data back to the file 
     */
    function write()
    {
        $fp = @fopen($this->csv->path, 'w') or die('The file cannot be opened');
        foreach($this->csv->contact as $contact)
        {
                array_pop($contact); // here we remove the added ID from the liste to keep the Original version 
                $contact = array_map("utf8_decode", $contact);
                fputcsv($fp, $contact);
        }
        fclose($fp);
    }
}