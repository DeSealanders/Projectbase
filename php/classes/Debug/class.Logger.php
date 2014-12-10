<?php
/**
 * Class Logger
 * This class is responsible for creating a log file
 *
 */
class Logger extends Singleton {

    private $sessionLog;
    private $logFile;

    protected  function __construct() {

        // Setup log file path from conf.default.php
        $this->logFile = DefaultConfig::getInstance()->getLogfile();

        // Start off with an empty log
        $this->sessionLog = false;
    }

    /**
     * Write a log message to a text file and
     * @param $message the message to be written
     * @param bool $logtodb flag to see if db logging is prefered
     */
    public function writeMessage($message, $logtodb = true) {

        // Write to db if possible, otherwise fallback to a text file
        if($logtodb && DatabaseManager::getInstance()->isConnected()) {
            $this->writeToDatabase($message);
        }
        else {
            $this->writeToFile($message);
        }

        // Add the report to this session log
        $this->sessionLog[] = $this->generateDebugReport($message, true);
    }

    /**
     * Write the debug report to a text file
     * @param $message the message which will be logged
     */
    private function writeToFile($message) {
        // Generate a debug report
        $debugReport = $this->generateDebugReport($message, true);

        // Create the correct folders for the logfile if they don't exist
        createIfNotExists($this->logFile);

        // Add marker to the log file for clarity
        if(!$this->hasMessages()) {
            file_put_contents($this->logFile, "\r\n\r\n" .'------- Page refreshed -------' . "\r\n", FILE_APPEND);
        }

        // Write the formated message to the logfile
        file_put_contents($this->logFile, $debugReport . "\r\n\r\n", FILE_APPEND);
    }
    /**
     * Write the debug report to the database
     * @param $message the message which will be logged
     */
    private function writeToDatabase($message) {

        // Generate a debug report
        $debugReport = $this->generateDebugReport($message, false);

        // Call the correct query to save the report
        QueryManager::getInstance()->saveDebugReport($debugReport);
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
     * Print a list of all local logged messages
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
    /**
     * Generate a debugreport from the message
     * This includes the last called class,
     * the file from which it is called,
     * the corresponding line
     * and a timestamp
     * @param $message the message to be reported
     * @param bool $asString a message enriched with debug information
     * @return array|string the debug report
     */
    private function generateDebugReport($message, $asString = false) {

        // Retrieve debug info
        $debuginfo = debug_backtrace();

        // If possible, use the root call of the function writing a log
        if(count($debuginfo) > 2) {
            $class = $debuginfo[2]['class'];
            $function = $debuginfo[2]['function'];
        }
        else {
            $class = $debuginfo[1]['class'];
            $function = $debuginfo[1]['function'];
        }

        // Return formatted debug information
        $debugArray = array(
            'Message' => addslashes($message),
            'File' => $debuginfo[1]['file'],
            'Line' => $debuginfo[1]['line'],
            'Class' => $class,
            'Function' => $function,
            'Timestamp' => date('Y-m-d H:i:s')
        );

        if($asString) {

            // Format the debugarray into a message
            $messageArray = array();
            foreach($debugArray as $key => $value) {
                $messageArray[] = $key . ' -  ' . $value;
            }

            // Return the debugreport split by newlines
            return implode("\r\n" , $messageArray);
        }
        else {

            // Return the debureport as array
            return $debugArray;
        }
    }

} 