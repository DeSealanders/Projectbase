<?php

class Logger {

    private $log;

    private function __construct() {
        $this->log = false;
        $this->logFile = 'txt/errorlog.txt';
    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return DatabaseManager
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new Logger();
        }
        return $instance;
    }

    public function log($text) {
        $text = date('Y-m-d H:i:s') . ' - ' . $text . "\r\n";
        $this->log[] = $text;
        file_put_contents($this->logFile, $text, FILE_APPEND);
    }

    public function getLog() {
        if($this->log) {
            $log = '<h2>Log</h2>';
            if(is_array($this->log)) {
                $log .= implode("<br>", $this->log);
            }
            else {
                $log .= $this->log;
            }
            $log .= '<h2>End log</h2>';
        }
        else {
            $log = '<h2>No log</h2>';
        }
        return $log;
    }

    public function readLogFile($file = false) {
        if(!$file) {
            $file = $this->logFile;
        }
        return file_get_contents($file);

    }

} 