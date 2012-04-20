<?php
class hilsen {
        private $tittel;
        private $tekst;
        private $url;
        private $dato;
        
        function __construct($tittel, $tekst, $url) {
            $this->tittel = strip_tags($tittel);
            $this->tekst = strip_tags($tekst);
            $this->url = strip_tags($url);
            $this->dato = date("d-m-Y H:i"); 
        }
        public function visTittel() {return $this->tittel;} 
        public function visTekst() {return $this->tekst;} 
        
        public function visDato() {return $this->dato;}  
               
        public function skrivUt() { 

            echo "<h2>" . utf8_decode($this->tittel) . "</h2>";
            echo "<blockquote>" . utf8_decode($this->tekst) . "</blockquote>";
            echo "Bes&oslash;k min <a href='" . utf8_decode($this->web) . "'>hjemmeside</a>";
            echo "<hr>";
        }
            
    }
?>