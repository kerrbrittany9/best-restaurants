<?php
    class Review
    {
        private $title;
        private $summary;
        private $id;

        function __construct($title, $summary, $id = null)
        {
            $this->title = $title;
            $this->summary = $summary;
            $this->id = $id;

        }

        function setTitle($new_title)
        {
          $this->title = (string) $new_title;
        }

        function getTitle()
        {
          return $this->title;
        }

        function setSummary($new_summary)
        {
          $this->summary = (string) $new_summary;
        }

        function getSummary()
        {
          return $this->summary;
        }

        function getId()
        {
          return $this->id;
        }

        function save()
        {
              $executed = $GLOBALS['DB']->exec("INSERT INTO reviews (title, summary) VALUES ('{$this->getTitle()}', '{$this->getSummary()}');");
              if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
              } else {
                return false;
              }
        }


    }


?>
