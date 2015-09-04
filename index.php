<?php
require 'vendor/autoload.php';

Epi::init('template','route');

Epi::setPath('view', 'templates');

getRoute()->get('/', array('DomainChecker', 'Run'));
getRoute()->run();

class DomainChecker {
    static public function Run() {

        if(file_exists("cache.json"))
            $cache = json_decode(file_get_contents("cache.json"), true);
        else
            $cache = array();

        $tlds = explode(",", (isset($_GET['tlds'])) ? $_GET['tlds'] : "com,co.uk,net,org" );

        $domains = explode(",", isset($_GET['domains']) ? $_GET['domains'] : "");

        $whois = new Whois();

        $rows = array();

        foreach($domains as $domain) {
            if(strlen($domain) == 0)
                continue;

            $results = array();
            $domain = trim($domain);

            $alltaken = true;

            foreach($tlds as $tld) {

                if(array_key_exists($domain . "." . $tld, $cache) && $cache[$domain . "." . $tld]['time'] > time() - 60*60*24) {
                    $info = $cache[$domain . "." . $tld]['data'];
                } else {
                    $info = $whois->lookup($domain . "." . $tld);
                    $cache[$domain . "." . $tld] = array('time' => time(), 'data' => $info);
                }

                $expires = "";

                switch($info['regrinfo']['registered']) {
                    case "yes":
                        if(isset($info['regrinfo']['domain']['expires'])) {
                            $expires = date("jS F Y", strtotime($info['regrinfo']['domain']['expires']));
                        } else {
                            $expires = "Unknown";
                        }
                        break;

                    case "unknown":
                        $expires = "???";
                        break;

                    case "no":
                        $alltaken = false;
                        break;
                }

                $results[] = array(
                    'tld' => $tld,
                    'registered' => $info['regrinfo']['registered'],
                    'expires' => $expires,
                );

            }

            $params = array(
                'domain' => $domain,
                'results' => $results,
                'classes' => $alltaken ? "danger" : "",
            );

            $rows[] = getTemplate()->get('domain-row.php', $params);
        }

        $params = array(
            'rows' => $rows,
            'cols' => $tlds
        );

        getTemplate()->display('page.php', $params);

        file_put_contents("cache.json", json_encode($cache));
    }
}
?>
