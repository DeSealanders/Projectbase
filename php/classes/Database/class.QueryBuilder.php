<?php

/**
 * Class QueryBuilder
 * This class is repsonsible for converting a Query object into actual SQL
 * It does so by constructing the query part by part
 */
class QueryBuilder {

    private function __construct() {

    }
    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return QueryBuilder
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new QueryBuilder();
        }
        return $instance;
    }

    /**
     * Convert a query object to sql
     * @param $query the object to build converted to sql
     * @return string the sql string matching the query object
     */
    public function build($query) {

        // If a select statement should be generated
        if($query->hasSelect()) {
            $sql = $this->getSelectPart($query->getSelect());
            $sql .= $this->getFromPart($query->getFrom());
            $sql .= $this->getJoinPart($query->getJoin());
            $sql .= $this->getWherePart($query->getWhere());
            $sql .= $this->getGroupByPart($query->getGroupBy());
            $sql .= $this->getOrderByPart($query->getOrderBy());
            return $sql;
        }

        // If an insert statement should be generated
        else if($query->hasInsert()) {
            $sql = $this->getInsertPart($query->getInsert());
            return $sql;
        }

        // If an update statement should be generated
        else if($query->hasUpdate()) {
            $sql = $this->getUpdatePart($query->getUpdate());
            $sql .= $this->getWherePart($query->getWhere());
            return $sql;
        }
        else {
            Logger::getInstance()->writeMessage('Unable to execute query which has not been built yet!');
        }
    }

    /**
     * Create the select part of the sql statement
     * @param $select the select string from the query object
     * @return string the sql generated based on the query object
     */
    private function getSelectPart($select) {
        return $this->formatSql('SELECT', $select);
    }

    /**
     * Create the from part of the sql statement
     * @param $from the from string from the query object
     * @return string the sql generated based on the query object
     */
    private function getFromPart($from) {
        return $this->formatSql('FROM', $from, true);
    }

    /**
     * Create the where part of the sql statement
     * @param $where the where string from the query object
     * @return string the sql generated based on the query object
     */
    private function getWherePart($where) {
        return $this->formatSql('WHERE ', $where, false, ' AND ');
    }

    /**
     * Create the joins part of the sql statement
     * @param $joins the joins string from the query object
     * @return string the sql generated based on the query object
     */
    private function getJoinPart($joins) {
        if(!empty($joins)) {
            $sql = '';
            foreach($joins as $join) {
                $sql .= ' ' . $join['type'] . ' JOIN ' . $join['table'] . ' ON ' . $join['on'];
            }
            return $sql;
        }
        else {
            return '';
        }
    }

    /**
     * Create the group by part of the sql statement
     * @param $groupBy the group by string from the query object
     * @return string the sql generated based on the query object
     */
    private function getGroupByPart($groupBy) {
        return $this->formatSql('GROUP BY', $groupBy);
    }

    /**
     * Create the order by part of the sql statement
     * @param $orderBy the order by string from the query object
     * @return string the sql generated based on the query object
     */
    private function getOrderByPart($orderBy) {
        return $this->formatSql('ORDER BY', $orderBy);
    }

    /**
     * Create an insert statement based on a query object
     * @param $insert the insert string from the query object
     * @return string the sql generated based on the query object
     */
    private function getInsertPart($insert) {
        // Insert into people
        $sql = "INSERT INTO " . $insert['table'];

        // (firstname, lastname, dob, email)
        $sql .= " (" . implode(', ', array_keys($insert['data'])) . ")";

        // VALUES ("Henk", "De tank", "26-10-1991", "henk@tank.de");
        $sql .= ' VALUES ("' . implode('", "', array_values($insert['data'])) . '")';
        return $sql;
    }

    /**
     * Create an update statement based on a query object
     * @param $update the update string from the query object
     * @return string the sql generated based on the query object
     */
    private function getUpdatePart($update) {
        $sql = "UPDATE "  . $update['table'];
        $sql .= " SET ";
        $updates = array();
        foreach($update['data'] as $column => $value) {
            $updates[] = $column . ' = "' . $value . '"';
        }
        $sql .= implode(',', $updates);
        return $sql;
    }

    /**
     * This function generates some generic sql code
     * Example:
     *      formatSql('SELECT', array('firstname, 'lastname'));
     * will result in:
     *      SELECT firstname, lastname
     *
     * @param $keyword keyword to be put in front of sql (SELECT, WHERE, FROM, GROUP BY, ORDER BY etc)
     * @param $values a string or array of values which need to be split by commas
     * @param bool $required when true is given an error will be thrown if no values are found
     * @param string $seperator the seperator used in combining all values
     * @return string an sql valid string
     */
    private function formatSql($keyword, $values, $required = false, $seperator = ', ') {
        if(!empty($values)) {
            $sql = ' ' . $keyword . ' ';
            if(is_array($values)) {
                $sql .= implode($seperator, $values);
            }
            else {
                $sql .= $values;
            }
            return $sql;
        }
        else {
            if($required) {
                //var_dump('No ' . $keyword . ' specified in query');
                Logger::getInstance()->writeMessage('No ' . $keyword . ' specified in query');
            }
            else {
                return '';
            }
        }
    }
} 