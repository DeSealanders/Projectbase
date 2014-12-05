<?php
/**
 * Class DatabaseManager
 * This class is used for establishing a database connection and executing queries
 */
class DatabaseManager extends Singleton
{

    private $connection;
    private $connected;

    protected function __construct()
    {
        $this->connected = false;
        $this->init();
    }

    /**
     * Setup the database connection using the config file
     */
    private function init() {

        // Throw erors instead of warnings
        mysqli_report(MYSQLI_REPORT_STRICT);

        // Load config
        $dbDetails = DatabaseConfig::getInstance()->getDbDetails();
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

            // Check if mysqlnd drivers are installed
            if(function_exists('mysqli_fetch_all')) {

                // Get results from statement through the (easy) mysqli way
                $result = $statement->get_result();
                if ($result) {
                    while ($returnValue = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $results[] = $returnValue;
                    }
                }
            }
            else {

                // Get results from statement through the (hard) way, by binding variables to each field
                $results = $this->getResultFromArray($statement);
            }


            // Return results
            if (isset($results)) {
                return $results;
            } else {
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
     * Getter to see wether a database connection has been made
     * @return bool true if a database connection is found
     */
    public function isConnected() {
        return $this->connected;
    }

    /**
     * Alternative (and outdated) way of getting results from a mysqli statement
     * @param $statement the statement which results will be extracted from
     * @return array the results of the query related to the statement
     */
    private function getResultFromArray($statement) {

        // Convert results into array
        $statement->store_result();
        $results = array();
        $allResults = array();
        $params = array();
        $meta = $statement->result_metadata();
        if ($meta)
        {
            // Get all fieldnames
            while ($field = $meta->fetch_field())
            {
                $allResults[$field->name] = null;
                $params[] = &$allResults[$field->name];
            }

            // Bind fieldnames to statement
            call_user_func_array(array($statement, 'bind_result'), $params);
        }

        // Create a copy function
        $copy = create_function('$a', 'return $a;');

        // Copy results into results
        while ($statement->fetch())
        {
            $results[] = array_map($copy, $allResults);
        }

        $statement->free_result();

        return $results;
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