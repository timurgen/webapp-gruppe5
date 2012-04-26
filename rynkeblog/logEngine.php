<?php
/**
 * Description of logEngine
 * 
 *
 * 
 */
class logEngine {
    private $logfile;
    /**
     *konstruktør 
     */
    public function __construct() {
        include 'config.php';
        $this->logfile = $LOGFILE;
        fopen($this->logfile, 'a') or die('can\'t open log file');
    }
    
    public function addLine($line) {
        $line = date(DATE_RSS)." ".$line.PHP_EOL;
        fwrite($this->logfile, $line);
    }
    
    public function __destruct() {
        fclose($this->logfile);
    }
    
    
}

?>
