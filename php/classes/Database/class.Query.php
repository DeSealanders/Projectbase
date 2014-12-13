<?php
/**
 * Class Query
 * This class represents a query with certain fields
 * It allows for building a query command by command instead of a large string
 * Example:
 *      $query = new Query();
 *      $query->select('*');
 *      $query->from('people as p');
 *      $query->join('LEFT', 'emails as e', 'p.email = e.email');
 *      $query->join('INNER', 'locations as l', 'p.address = l.address');
 *      $query->where('firstname = "henk"');
 *      $query->groupBy('lastname');
 *      $query->orderBy('email');
 * Will result in:
 *      SELECT *
 *      FROM people as p
 *      LEFT JOIN emails as e
 *      ON p.email = e.email
 *      INNER JOIN locations as l
 *      ON p.address = l.address
 *      WHERE firstname = "henk"
 *      GROUP BY lastname
 *      ORDER BY email
 */
class Query {

    private $select;
    private $from;
    private $where;
    private $join;
    private $groupBy;
    private $orderBy;
    private $insert;
    private $update;
    private $describe;

    public function __construct() {

        // Set default values of all variables to an empty array
        $this->select =
        $this->from =
        $this->where =
        $this->join =
        $this->where =
        $this->groupBy =
        $this->orderBy =
        $this->insert =
        $this->update =
        $this->create =
        $this->alter =
        $this->describe = array();
    }

    /**
     * When the query is printed build it using the QueryBuilder
     * @return string sql code generated based on all variables set
     */
    public function __toString() {
        return QueryBuilder::getInstance()->build($this);
    }

    /**
     * This function should be called when using a select statement
     * @param array $columns array or string of columns to select
     */
    public function select($columns = array('*')) {
        $this->select[] = $columns;
    }

    /**
     * Add desired tables to the query
     * @param $table array or string of tables to select data from
     */
    public function from($table) {
        $this->from[] = $table;
    }

    /**
     * Add desired conditions to the query
     * @param $conditions array or string of conditions to be met
     */
    public function where($conditions) {
        $this->where[] = $conditions;
    }

    /**
     * Add desired joins to the query
     * @param string $type the type of join (LEFT, INNER or RIGHT)
     * @param $table the table to join onto the existing query
     * @param $on the conditions to join on
     */
    public function join($type, $table, $on) {
        $this->join[] = array(
            'type' => $type,
            'table' => $table,
            'on' => $on
        );
    }

    /**
     * Add desired group by to the query
     * @param $groupBy array or string of group by statement
     */
    public function groupBy($groupBy) {
        $this->groupBy[] = $groupBy;
    }

    /**
     * Add desired order by to the query
     * @param $orderBy array or string of order by statement
     */
    public function orderBy($orderBy) {
        $this->orderBy[] = $orderBy;
    }

    /**
     * Create an insert statement
     * @param $table table which the data will be inserted into
     * @param $data array of data to be inserted
     */
    public function insert($table, $data) {
        $this->insert = array(
            'table' => $table,
            'data' => $data
        );
    }

    public function update($table, $data) {
        $this->update = array(
            'table' => $table,
            'data' => $data
        );
    }

    public function create($table, $columns) {
        $this->create = array(
            'table' => $table,
            'columns' => $columns
        );
    }

    public function describe($table) {
        $this->describe = $table;
    }

    public function alter($table, $columns) {
        $this->alter = array(
            'table' => $table,
            'add' => $columns['add'],
            'remove' => $columns['remove']
        );
    }

    /**
     * Used to see if a select statement has been built
     * @return bool true if a select statement has been built
     */
    public function hasSelect() {
        return !empty($this->select);
    }

    /**
     * Used to see if a insert statement has been built
     * @return bool
     */
    public function hasInsert() {
        return !empty($this->insert);
    }

    public function hasUpdate() {
        return !empty($this->update);
    }

    public function hasCreate() {
        return !empty($this->create);
    }

    public function hasDescribe() {
        return !empty($this->describe);
    }

    public function hasAlter() {
        return !empty($this->alter);
    }

    /**
     * Return the from part of the query
     * @return mixed array containing the from part
     */
    public function getFrom()
    {
        return $this->from;
    }
    /**
     * Return the group by part of the query
     * @return mixed array containing the group by part
     */
    public function getGroupBy()
    {
        return $this->groupBy;
    }

    /**
     * Return the insert query part
     * @return mixed array containing the insert part
     */
    public function getInsert()
    {
        return $this->insert;
    }

    /**
     * Return the update query part
     * @return mixed array containing the update part
     */
    public function getUpdate()
    {
        return $this->update;
    }

    public function getCreate()
    {
        return $this->create;
    }

    public function getDescribe()
    {
        return $this->describe;
    }

    public function getAlter() {
        return $this->alter;
    }

    /**
     * Return the join part of the query
     * @return mixed array containing the join part
     */
    public function getJoin()
    {
        return $this->join;
    }

    /**
     * Return the order by part of the query
     * @return mixed array containing the order by part
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * Return the select part of the query
     * @return mixed array containing the select part
     */
    public function getSelect()
    {
        return $this->select;
    }

    /**
     * Return the where part of the query
     * @return mixed array containing the where part
     */
    public function getWhere()
    {
        return $this->where;
    }
} 