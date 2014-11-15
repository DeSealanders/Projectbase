<?php
/**
 * Class DatabaseManager
 * This class is used for establishing a database connection and executing queries
 */
class DatabaseManager
{

    private $connection;
    private $databaseConfig;
    private $connected;

    private function __construct()
    {
        $this->connected = false;
        $this->init();
    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return DatabaseManager
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new DatabaseManager();
        }
        return $instance;
    }

    /**
     * Setup the database connection using the config file
     */
    private function init() {

        // Throw erors instead of warnings
        mysqli_report(MYSQLI_REPORT_STRICT);

        // Load config
        $this->databaseConfig = new DatabaseConfig();
        $dbDetails = $this->databaseConfig->getDbDetails();
        try {
            $this->connection = mysqli_connect(
                $dbDetails['address'],
                $dbDetails['username'],
                $dbDetails['password'],
                $dbDetails['database']
            );
        }
        catch(Exception $e) {
            // Do nothing
        }

        // Log the error
        if (mysqli_connect_errno()) {
            Logger::getInstance()->writeMessage("Failed to connect to MySQL: " . mysqli_connect_error(), false);
        }
        else {
            $this->connected = true;
        }
    }

    /**
     * Getter to see wether a database connection has been made
     * @return bool true if a database connection is found
     */
    public function isConnected() {
        return $this->connected;
    }

    /**
     * Execute a specified query
     * @param $query the query to be executed
     * @param bool $params a list of parameters for prepared statements
     * @return array|null returns the result of the query in the form of an array
     */
    public function executeQuery($query, $params = false)
    {
        $statement = $this->connection->prepare($query);
        if (isset($statement) && $statement) {
            if ($params) {
                $params = array_merge(array(str_repeat('s', count($params))), array_values($params));
                $refs = array();
                foreach ($params as $key => $value) {
                    $refs[$key] = & $params[$key];
                }
                call_user_func_array(array(&$statement, 'bind_param'), $params);
            }
            //$this->printDebugInfo($query, $params);
            $statement->execute();
            $result = $statement->get_result();
            if ($result) {
                while ($returnValue = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $results[] = $returnValue;
                }
                if (isset($results)) {
                    return $results;
                } else {
                    return false;
                }
            }
            else {
                return false;
            }
        }
        else {
            if($params) {
                $params = ', with parameters: ' . implode(',', $params);
            }
            else {
                $params = '';
            }
            Logger::getInstance()->writeMessage('Unable to execute query: "' . $query . '"' . $params);
            //$this->printDebugInfo($query, $params);
        }
    }

    /**
     * When this function is called, all debug info will be vardumped on screen
     * @param $query the query to be printed
     * @param $params the parameters linked to the query
     */
    private function printDebugInfo($query, $params) {
        echo 'Query: ';
        var_dump($query);
        echo 'Parameters: ';
        var_dump($params);
    }

} 