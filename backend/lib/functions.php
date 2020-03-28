<?php


include_once dirname(__FILE__) .'../config/require.php';

// Suchfunktion
function php_grep($field,$searchQuery)
{
    GLOBAL $cachePath;

    // Überprüfe, ob Suchanfrage bereits im Cache vorhanden ist
    $cached = isCached($field,$searchQuery);
    if(!is_null($cached)) return $cached;


    $ret = array();
    // generiere Dateinamen für Cachedatei
    $filename = time() . random_int(0, 999);
    $ret['filename'] = $filename;
    $ret['searchQuery'] = $field.",".$searchQuery;
    // Bilde Query für die Suche
    $query = queryGenerator($searchQuery);

    // führt Query in der Shell aus - schnellere performance
     $hits = shell_exec($query);
     // teile Suchergebnisse in ein Array
     $hits = preg_split('/\s+/', trim($hits));

    $countResult = 0;
    // Filtern der Suchergebnisse
    $fields = explode("-",$field);

    foreach ($hits AS $f) {

        $err=0;
        // JSON dekodieren
        $ecodedText = json_decode(file_get_contents($f), TRUE);

        if(stristr($searchQuery,"\"RANGE\"")) {
            $q = explode("\"RANGE\"", $searchQuery);
            $year =  preg_replace("/[^0-9]/", '', ($fields[0]=="none" ? $ecodedText[$fields[1]] : $ecodedText[$fields[0]][$fields[1]]) );
            $q[0] = preg_replace("/[^0-9]/", "" ,$q[0]);
            $q[1] = preg_replace("/[^0-9]/", "" ,$q[1]);
            $from = $q[0] < $q[1] ? $q[0] : $q[1];
            $to = $q[0] < $q[1] ? $q[1] : $q[0];

            if ($year < $from || $year > $to) $err++;

        }

        $content=  $fields[0]=="none" ? $ecodedText[$fields[1]] : $ecodedText[$fields[0]][$fields[1]];
        if (is_array($content)){
            $tContent = "";
            foreach ($content as $dk => $dc){
                $tContent .= $dk." : ".$dc;
            }
            $content = $tContent;

        }
        $not = explode("\"NOT\"", $searchQuery);


        if (count($not[1]) > 0) {
            if (stristr($content,$not[1])) $err++;
        }
        if($not[0]!=""){

            $or = explode("\"OR\"",$not[0]);
            $and = explode("\"AND\"",$not[0]);


            if(count($or)>1) {
                foreach ($or as $o) {

                    $and = explode("\"AND\"", $o);
                    if(count($and)>1) {
                        foreach ($and as $a) {
                            if (!stristr($content,trim($a," "))) $err++;
                        }
                        if ($err == 0) break;
                    }else{
                        if (!stristr($content,trim($o," "))) $err++;
                        if ($err==0) break;
                    }

                }
            }
            else if(count($and)>1) {

                foreach ($and as $a) {


                    if (!stristr($content,trim($a," "))) $err++;
                }
            }


        }



        // falls alle Kriterien erfüllt wird Dokument in die Ergebnisliste aufgenommen
        if($err==0 && $f!="") {
            $docsFilename = end(explode("/", $f));
            $countResult++;

            $ret["$f"] = $docsFilename;
        }

    }
    $ret['count'] = $countResult;
    $ret['queryGen'] = $query;
    storeCache($ret, $filename);

    return $ret;
}

// Query für die Suchanfrage
function queryGenerator($searchQuery)
{
    GLOBAL $dbPath;

    $query = "egrep -ril --include=*.json --exclude-dir=_cache/  --exclude-dir=user/ ";
    // Falls ein Zeitraum angeben wurde
    if(stristr($searchQuery,"\"RANGE\"")){
        $q = explode("\"RANGE\"",$searchQuery);
        // egrep für ODER Pattern

        $q[0] = preg_replace("/[^0-9]/", "" ,$q[0]);
        $q[1] = preg_replace("/[^0-9]/", "" ,$q[1]);

        $from = $q[0] < $q[1] ? $q[0] : $q[1];
            $to = $q[0] < $q[1] ? $q[1] : $q[0];

           $tmp =$from;
            // Nehme alle Jahreszahlen im Zeitraum in das Pattern
            for ($i = $from+1; $i <= $to; $i++) {
                $tmp .= "|" . $i;
            }
            $query .= escapeshellarg($tmp);
            $query .= " ".$dbPath;

    }else {

        $not = explode("\"NOT\"", $searchQuery);
        $splitParams = explode("\"OR\"", $not[0]);
        $concat = "'";

        if (stristr($searchQuery, "\"NOT\"")) {
            if (count($not[1]) > 0) {
                $query .= "-L '" .  trim($not[1], " ") . "'";
            } else {
                $query .= "-L '" . trim($not[0], " ") . "'";
            }
        }
        if ($not[0] != "") {
            if (stristr($searchQuery, "\"NOT\"")) {
                $query .= " | ";
            }
            if (count($splitParams) > 1) {
                foreach ($splitParams AS $sp) {
                    $splitAnd = explode("\"AND\"", $sp);
                    if (count($splitAnd) > 1) {
                        $concat .= "" . trim($splitAnd[0], " ") . ".*" . trim($splitAnd[1], " ") . "|" . trim($splitAnd[1], " ") . ".*" . trim($splitAnd[0], " ") . " |";
                    } else {
                        $concat .= "" . trim($splitAnd[0], " ") . " |";

                    }
                }
                $query .= substr($concat, 0, strlen($concat) - 1) . "'";
            } else {
                $splitAnd = explode("\"AND\"", $not[0]);
                if (count($splitAnd) > 1) {
                    $concat .= "" . trim($splitAnd[0], " ") . ".*" . trim($splitAnd[1], " ") . "|" . trim($splitAnd[1], " ") . ".*" . trim($splitAnd[0], " ") . "";
                } else {
                    $concat .= "" . $splitAnd[0];

                }
                $query .= $concat . "' " . $dbPath;

            }
        } else {
            if ($searchQuery == "") {
                $query .= " '' " . $dbPath;
            } else {

                $query .= " " . $dbPath;
            }
        }
    }

    return $query;

}

// Sonderzeichen ersetzen in String
function sonderzeichen($string)
{
    $search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´");
    $replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "");
    return str_replace($search, $replace, $string);
}

// Prüft, ob Suchanfrage bereits im Cache
function isCached($field,$searchQuery)
{
    GLOBAL $cachePath;


    $cache = opendir($cachePath);
    $countCache = 0;
    // Liest alle Cachedateien aus
    while ($f = readdir($cache)) {
        $countCache++;
        if (preg_match("#^\.+$#", $f)) continue;
        // dekodieren der Cachedatei
        $ecodedText = json_decode(file_get_contents( $cachePath . $f), TRUE);
        // prüfe, ob searchQuery übereinstimmt - und gebe diese zurück
        if ($ecodedText['searchQuery'] == $field.",".$searchQuery) {
            return $ecodedText;
        }
        // falls zu viele Cachdateien -> bereinige Cacheordner
        if ($countCache == 400) {
            clearCache($cachePath);
        }
    }

    return NULL;

}

// erstellen einer Cachedatei
function storeCache($ret,$filename)
{
    GLOBAL $cachePath;
    // erstelle Cachedatei mit vorher generiertem Dateinamen
    $cacheFile = fopen($cachePath . $filename.".json", "w");
    // encodiere Array in Json
    fwrite($cacheFile, json_encode($ret, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    fclose($cacheFile);

}

// Cache bereinigen
function clearCache($path)
{
    $cache = opendir($path);
    while ($f = readdir($cache)) {

        // Lösche Cachedatei, falls älter als 7 Tage
        $timedif = (time() - filemtime($f));
        if ($timedif >= (3600 * 24)*7) {
            unlink($path . $f);
        }
    }

}
