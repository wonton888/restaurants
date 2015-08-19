<?php
    class Cuisine
    {
        private $id;
        private $type;

        function __construct($id = null, $type)
        {
            $this->id = $id;
            $this->type = $type;

        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines;");
        }







    }
