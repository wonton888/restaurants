<?php
    class Restaurant
    {
        private $id;
        private $name;
        private $cuisine_id;
        private $description;


        function __construct($id = null, $name, $cuisine_id, $description)
        {
            $this->id = $id;
            $this->name = $name;
            $this->cuisine_id = $cuisine_id;
            $this->description = $description;

        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }







    }
?>
