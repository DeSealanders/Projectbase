<?php
/**
 * Class Logger
 * This class is responsible for creating a log file
 *
 */
class Logger {

    private $sessionLog;
    private $logFile;

    private function __construct() {

        // Setup log file path from conf.default.php
        $this->logFile = DefaultConfig::getInstance()->getLogfile();

        // Start off with an empty log
        $this->sessionLog = false;
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

    /**
     * Write a log message to a text file and
     * @param $message
     */
    public function writeMessage($message) {

        // Create the correct folders for the logfile if they don't exist
        $this->createIfNotExists($this->logFile);

        // Add marker to the log file for clarity
        if(!$this->hasMessages()) {
            file_put_contents($this->logFile, "\r\n\r\n" .'------- Page refreshed -------' . "\r\n", FILE_APPEND);
        }

        // Generate a debug report
        $debugReport = $this->generateDebugReport($message);

        // Add the report to this session log
        $this->sessionLog[] = $debugReport;

        // Write the formated message to the logfile
        file_put_contents($this->logFile, $debugReport . "\r\n\r\n", FILE_APPEND);
    }

    /**
     * Checks wether or not any messages are logged
     * @return bool true if messages have been logged this session
     */
    private function hasMessages() {
        if($this->sessionLog) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Print a list of all logged messages
     */
    public function printMessages() {

        // Only print messages if there are any
        if($this->hasMessages()) {

            // Add proper styling classes
            echo '<div class="logger">'
                . '<h1>Logged messages</h1>';

            // Print each debugreport individually
            foreach($this->sessionLog as $logEntry) {

                // Print every debugreport with the correct style
                echo '<div class="entry">' . str_replace("\r\n", '<br>' , $logEntry) . '</div>';
            }
            echo '</div>';
        }
    }

    /**
     * Generate a debugreport from the message
     * This includes the last called class,
     * the file from which it is called,
     * the corresponding line
     * and a timestamp
     * @param $message the message to be reported
     * @return string a message enriched with debug information
     */
    private function generateDebugReport($message) {

        // Retrieve debug info
        $debuginfo = debug_backtrace();

        // Return formatted debug information
        $debugArray = array(
            'Message' => $message,
            'File' => $debuginfo[1]['file'],
            'Line' => $debuginfo[1]['line'],
            'Class' => $debuginfo[2]['class'],
            'Function' => $debuginfo[2]['function'],
            'Timestamp' => date('Y-m-d H:i:s')
        );

        // Format the debugarray into a message
        $messageArray = array();
        foreach($debugArray as $key => $value) {
            $messageArray[] = $key . ' -  ' . $value;
        }

        // Return the debugreport split by newlines
        return implode("\r\n" , $messageArray);
    }

    /**
     * Creates a file path if for a specified file if it does not exist yet
     * @param $file the file for which the folder structure should be created
     */
    private function createIfNotExists($file) {

        // Retrieve detailed information about the specified file
        $pathinfo = pathinfo($file);

        // Retrieve the folder path
        $folderstructure = $pathinfo['dirname'];

        // Create the folder path if it does not exist yet
        if (!file_exists($folderstructure)) {
            mkdir($folderstructure, 0777, true);
        }
    }

} 