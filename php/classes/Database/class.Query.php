<?php

class Query {

    private $sql;
    private $parameters;

    public function __construct($sql, $parameters) {
        $this->sql = $sql;
        $this->parameters = $parameters;
    }

    public function getSQL() {
        return $this->sql;
    }

    public function getParameters() {
        return $this->parameters;
    }
} 