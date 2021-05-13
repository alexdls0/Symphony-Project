{"filter":false,"title":"GeneralHelper.php","tooltip":"/symfony4/src/Utils/GeneralHelper.php","undoManager":{"mark":13,"position":13,"stack":[[{"start":{"row":0,"column":0},"end":{"row":31,"column":1},"action":"insert","lines":["<?php","","namespace App\\Utils;","","/**"," * Extra classes for cURL"," * @author irom"," */","class CurlHelper {","","    /**","     * Checks if an url is accessible","     * @param string $url","     * @return boolean","     */","    static function urlExists($url) {","        $handle = curl_init($url);","        if (false === $handle) {","            return false;","        }","        curl_setopt($handle, CURLOPT_HEADER, false);","        curl_setopt($handle, CURLOPT_FAILONERROR, true);","        //Some servers wont respond if no header","        curl_setopt($handle, CURLOPT_HTTPHEADER, Array(\"User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15\"));","        curl_setopt($handle, CURLOPT_NOBODY, true);","        curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);","        $connectable = curl_exec($handle);","        curl_close($handle);","        return $connectable;","    }","","}"],"id":1}],[{"start":{"row":8,"column":9},"end":{"row":8,"column":10},"action":"remove","lines":["l"],"id":2},{"start":{"row":8,"column":8},"end":{"row":8,"column":9},"action":"remove","lines":["r"]},{"start":{"row":8,"column":7},"end":{"row":8,"column":8},"action":"remove","lines":["u"]},{"start":{"row":8,"column":6},"end":{"row":8,"column":7},"action":"remove","lines":["C"]}],[{"start":{"row":8,"column":6},"end":{"row":8,"column":7},"action":"insert","lines":["G"],"id":3},{"start":{"row":8,"column":7},"end":{"row":8,"column":8},"action":"insert","lines":["e"]},{"start":{"row":8,"column":8},"end":{"row":8,"column":9},"action":"insert","lines":["n"]},{"start":{"row":8,"column":9},"end":{"row":8,"column":10},"action":"insert","lines":["e"]},{"start":{"row":8,"column":10},"end":{"row":8,"column":11},"action":"insert","lines":["r"]},{"start":{"row":8,"column":11},"end":{"row":8,"column":12},"action":"insert","lines":["a"]},{"start":{"row":8,"column":12},"end":{"row":8,"column":13},"action":"insert","lines":["l"]}],[{"start":{"row":16,"column":0},"end":{"row":28,"column":28},"action":"remove","lines":["        $handle = curl_init($url);","        if (false === $handle) {","            return false;","        }","        curl_setopt($handle, CURLOPT_HEADER, false);","        curl_setopt($handle, CURLOPT_FAILONERROR, true);","        //Some servers wont respond if no header","        curl_setopt($handle, CURLOPT_HTTPHEADER, Array(\"User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15\"));","        curl_setopt($handle, CURLOPT_NOBODY, true);","        curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);","        $connectable = curl_exec($handle);","        curl_close($handle);","        return $connectable;"],"id":4}],[{"start":{"row":16,"column":0},"end":{"row":17,"column":0},"action":"insert","lines":["",""],"id":5}],[{"start":{"row":15,"column":19},"end":{"row":15,"column":29},"action":"remove","lines":[" urlExists"],"id":6}],[{"start":{"row":15,"column":19},"end":{"row":15,"column":20},"action":"insert","lines":[" "],"id":7}],[{"start":{"row":15,"column":20},"end":{"row":15,"column":21},"action":"insert","lines":["f"],"id":8},{"start":{"row":15,"column":21},"end":{"row":15,"column":22},"action":"insert","lines":["r"]},{"start":{"row":15,"column":22},"end":{"row":15,"column":23},"action":"insert","lines":["s"]}],[{"start":{"row":15,"column":22},"end":{"row":15,"column":23},"action":"remove","lines":["s"],"id":9},{"start":{"row":15,"column":21},"end":{"row":15,"column":22},"action":"remove","lines":["r"]}],[{"start":{"row":15,"column":21},"end":{"row":15,"column":22},"action":"insert","lines":["i"],"id":10},{"start":{"row":15,"column":22},"end":{"row":15,"column":23},"action":"insert","lines":["r"]},{"start":{"row":15,"column":23},"end":{"row":15,"column":24},"action":"insert","lines":["s"]},{"start":{"row":15,"column":24},"end":{"row":15,"column":25},"action":"insert","lines":["t"]}],[{"start":{"row":17,"column":0},"end":{"row":17,"column":4},"action":"insert","lines":["    "],"id":11}],[{"start":{"row":17,"column":4},"end":{"row":17,"column":8},"action":"insert","lines":["    "],"id":12}],[{"start":{"row":17,"column":8},"end":{"row":17,"column":9},"action":"insert","lines":["r"],"id":13},{"start":{"row":17,"column":9},"end":{"row":17,"column":10},"action":"insert","lines":["e"]},{"start":{"row":17,"column":10},"end":{"row":17,"column":11},"action":"insert","lines":["t"]},{"start":{"row":17,"column":11},"end":{"row":17,"column":12},"action":"insert","lines":["u"]},{"start":{"row":17,"column":12},"end":{"row":17,"column":13},"action":"insert","lines":["r"]},{"start":{"row":17,"column":13},"end":{"row":17,"column":14},"action":"insert","lines":["n"]}],[{"start":{"row":17,"column":14},"end":{"row":17,"column":15},"action":"insert","lines":[" "],"id":14},{"start":{"row":17,"column":15},"end":{"row":17,"column":16},"action":"insert","lines":["1"]},{"start":{"row":17,"column":16},"end":{"row":17,"column":17},"action":"insert","lines":[";"]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":17,"column":17},"end":{"row":17,"column":17},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1557769496478,"hash":"8e0d60fab7c5193b7172268cb13a7e4018c78802"}