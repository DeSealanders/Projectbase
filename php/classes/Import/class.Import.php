<?php

class Import {

    private $baseUrl;
    private $data;

    public function __construct($region) {
        $this->data = false;
        $this->baseUrl = 'http://status.leagueoflegends.com/shards';
        $url = $this->baseUrl . '/' . $region;
        if(!isLive()) {
            if($region == 'euw') {
                //$url = 'txt/json-euw-1409842410.txt';
            }
            else {
                //$url = 'txt/json-na-1410015979.txt';
            }
        }
        $this->import($url);
    }

    private function import($url = false) {
        if($url) {
            $json = file_get_contents($url);
            if(!empty($json)) {
                //file_put_contents('txt/json-' . substr($url, strlen($this->baseUrl)+1) . '-' . time() . '.txt', $json);
                $this->data = json_decode($json);
            }
        }
    }

    private function saveToDb($data) {
        // TODO data wegschrijven naar database
    }

    public function getData() {
        return $this->data;
    }

} 