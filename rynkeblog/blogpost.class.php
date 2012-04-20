<?php
class blogpost {
        private $file_name;
        private $xml;
        
        function __construct($filename) {
            $this->file_name = $filename;
        }
        
        public function readFile() { $this->xml = simplexml_load_file($this->file_name); }
        
        public function printFile() { 
            
            /* Skriv ut tittel og rating for alle filmer  */
            foreach ($this->xml->hilsen as $hilsen) {
                echo "<h2>" . utf8_decode($hilsen->tittel) . "</h2>";
                echo "<blockquote>" . utf8_decode($hilsen->tekst) . "</blockquote>";
                
                echo utf8_decode($hilsen->dato) . "<br />";  
                echo "<hr>";
            }
        }
            
        public function addToFile( $post) {  

            $xml_ny = "<gjestebok>";
            $xml_ny .=  "<hilsen>\n".
                    "<tittel>" . utf8_encode($post->visTittel()). "</tittel>\n" .               
                    "<tekst>" .utf8_encode($post->visTekst()). "</tekst>\n" .
                    "<dato>" .utf8_encode($post->visDato()). "</dato>\n" . 
                    "</hilsen>\n";
            foreach ($this->xml->hilsen as $hilsen) {
                $xml_ny .= "<hilsen>\n";
                $xml_ny .= "<tittel>" . $hilsen->tittel . "</tittel>\n";             
                $xml_ny .=  "<tekst>" . $hilsen->tekst . "</tekst>\n";
                $xml_ny .=  "<dato>" . $hilsen->dato . "</dato>\n";
                $xml_ny .= "</hilsen>\n";
            }
            $xml_ny .= "</gjestebok>";
            
                    

            //debug
            //var_dump($xml_ny);
            $xml_1 = simplexml_load_string($xml_ny);

        // Lagre endrede XML data til fil, skrivekasess til fil nødvendig for apache web tjener
            file_put_contents('gjestebok.xml',$xml_1->asXML());
        }

    }
?>