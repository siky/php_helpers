<?php

if(!function_exists('trimName')){
    function trimName($name){
        $exp = explode(' ', $name);
        return rtrim(ltrim($exp[0].' '.$exp[1], '('), ')');
    }
}

if(!function_exists('serviceLevel')){
    /**
     * @param $service_level_code
     * @param bool $database
     * @return string
     */
    function serviceLevel($service_level_code, $database = false){
        if($database){
            switch($service_level_code){
                case 0:  $price_type = ''           ; break; //recepciós
                case 1:  $price_type = 'standard'   ; break; //műkörmös senior
                case 2:  $price_type = 'standard'   ; break; //pedikűrös senior
                case 11: $price_type = 'gyakornok'  ; break; //műkörmös gyakornok
                case 12: $price_type = 'junior'     ; break; //műkörmös junior
                case 13: $price_type = 'top'        ; break; //műkörmös top
                case 21: $price_type = 'gyakornok'  ; break; //pedikűrös gyakornok
                case 22: $price_type = 'junior'     ; break; //pedikűrös junior
                case 23: $price_type = 'top'        ; break; //pedikűrös top
                default: $price_type = 'standard'   ; break;
            }
            return $price_type;
        }
        switch($service_level_code){
            case 0:  $price_type = ''           ; break; //recepciós
            case 1:  $price_type = 'Senior'     ; break; //műkörmös senior
            case 2:  $price_type = 'Senior'     ; break; //pedikűrös senior
            case 11: $price_type = 'Gyakornok'  ; break; //műkörmös gyakornok
            case 12: $price_type = 'Junior'     ; break; //műkörmös junior
            case 13: $price_type = 'TOP'        ; break; //műkörmös top
            case 21: $price_type = 'Gyakornok'  ; break; //pedikűrös gyakornok
            case 22: $price_type = 'Junior'     ; break; //pedikűrös junior
            case 23: $price_type = 'TOP'        ; break; //pedikűrös top
            default: $price_type = 'Senior'     ; break;
        }
        return $price_type;
    }
}

if(!function_exists('preferredTimes')){

    /**
     * @param array $times
     * @return array
     */
    function preferredTimes(array $times){
        if(empty($times)) return null;
        $return = [];
        for($hour = 8; $hour<=21; $hour++){
            if(isset($times[$hour])){
                $return[$hour] = $times[$hour];
            }else{
                end($return);
                $return[$hour] = isset($return[key($return)]) ? $return[key($return)] : 0;
            }
        }
        return $return;
    }
}

if(!function_exists('reOrderArray')){

    /**
     * @param array $array
     * @return array
     */
    function reOrderArray(array $array){
        $return = [];
        foreach($array as $v){
            $return[] = $v;
        }
        return $return;
    }
}

if(!function_exists('dd')){

    /**
     * @param null $item
     * @param null $live
     * @param bool $multiple
     */
    function dd($item = null, $live = null, $multiple = false){
        if($multiple && is_array($item)){
            foreach($item as $value){
//                echo '<pre style="margin-top: 25px; height: 70vh; overflow: scroll;">';
                var_dump($value);
//                echo '</pre>';
            }
        }else{
//            echo '<pre style="margin-top: 25px; height: 70vh; overflow: scroll;">';
            var_dump($item);
//            echo '</pre>';
        }
        if(!$live) die();
    }
}

if(!function_exists('super_isset')){
    /**
     * @param $array
     * @param array $keys
     * @return bool
     */
    function super_isset($array, array $keys){
        $return = false;
        foreach($keys as $k => $key){
            if(isset($array[$key])){
                $return = true;
                if(1 < count($keys)){
                    unset($keys[$k]);
                    $return = super_isset($array[$key], $keys);
                }
                if(!$return) return false;
            }
        }
        return $return;
    }
}

if(!function_exists('ekezettelenit')){

    /**
     * @param $str
     * @return mixed|string
     */
    function ekezettelenit($str) {
        $bad = array('á', 'ä', 'é', 'í', 'ó', 'ö', 'ő', 'ú', 'ü', 'ű', 'Á', 'Ä', 'É', 'Í', 'Ó', 'Ö', 'Ő', 'Ú', 'Ü', 'Ű', ' ');
        $good = array('a', 'a', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'u', 'a', 'a', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'u', '-');
        $str = mb_strtolower($str, "utf8"); //kisbetűsre

        $str = str_replace($bad, $good, $str); //karakterek cseréje

        $str = preg_replace("/[^A-Za-z0-9_.]/", "-", $str); //maradék eltávolítása
        return $str;
    }
}

if(!function_exists('array_intersect_recursive')){

    /**
     * Két tömböt hasonlít össze, és csak azokat az elemeket
     * adja vissza, amelyek mindkét tőmbben szerepelnek.
     * Fontos, hogy a két tömbbnek ugyanolyan mélységűnek kell lennie!
     * @param $array1
     * @param $array2
     * @return mixed
     */
    function array_intersect_recursive($array1, $array2){
        foreach($array1 as $key => $value){
            if(!isset($array2[$key])){
                unset($array1[$key]);
            }else{
                if(is_array($array1[$key])){
                    $array1[$key] = array_intersect_recursive($array1[$key], $array2[$key]);
                }elseif($array2[$key] !== $value){
                    unset($array1[$key]);
                }
            }
        }
        return $array1;
    }
}

if(!function_exists('fetch_result_to_array')){

    /**
     * @param $result
     * @param string $keyID
     * @return array
     */
    function fetch_result_to_array($result, $keyID = 'id'){
        $return = [];
        while($asc = $result->fetch_assoc()){
            if($keyID && array_key_exists($keyID, $asc)){
                $return[ $asc[$keyID] ] = $asc;
            }else{
                $return[] = $asc;
            }
        }
        return $return;
    }
}

if(!function_exists('nextOpenDayOffset')){
    /**
     * @param string $date
     * @return int
     */
    function nextOpenDayOffset($date = ''){
        if($date){
            $date = strtotime($date);
        }else{
            $date = time();
        }

        $current_week_day_nr = date('w',$date);

        $next_open_day = 2;
        if($current_week_day_nr != 6){
            $next_open_day = 1;
        }
        return $next_open_day;
    }
}

if(!function_exists('urlSegment')){
    /**
     * Visszaadja a kívánt url szegmenst
     * @param $segment int
     * az url visszakapni kívánt szegmensének sorszáma
     * @return bool|string
     */
    function urlSegment($segment){
        $url = $_SERVER['REQUEST_URI'];
        $exp = explode('?', $url);
        $url = $exp[0];
        $aUrl = explode('/', $url);
        unset($aUrl[0]);

        if(array_key_exists($segment, $aUrl)){
            return $aUrl[$segment];
        }
        return false;
    }
}

if(!function_exists('isDateInAllowedInterval')){
    /**
     * Ellenőrzi, hogy a megadott dátum az engedélyezett
     * intervallumon belül van-e
     * @param $date
     * ellenőrizendő dátum
     * @param $intervalStart
     * napok a mai naphoz viszonyítva
     * @param $intervalEnd
     * napok a mai naphoz viszonyítva
     * @return bool
     */
    function isDateInAllowedInterval($date, $intervalStart, $intervalEnd){
        if(strtotime($date) < mktime(null, null, null, date('m'), date('d')+$intervalStart, date('y'))
            || strtotime($date) > mktime(null, null, null, date('m'), date('d')+$intervalEnd, date('y'))){
            return false;
        }else{
            return true;
        }
    }
}

if(!function_exists('mergeArray')){
    /**
     * Összefésül két tömböt úgy,
     * hogy az azonos kulcsok felülíródnak
     * a második tömbben
     * (az első tömb minden eleme megmarad)
     * @param $array1
     * @param $array2
     * @return mixed
     */
    function mergeArray($array1, $array2){
        foreach($array1 as $k => $v){
            $array2[$k] = $v;
        }
        return $array2;
    }
}

if(!function_exists('telszam')){
    /**
     * Telefonszám formátum készító és ellenőrző
     * @param $telszam
     * @param bool $href
     * @return bool|string
     */
    function telszam($telszam, $orszagkod = '36', $href = FALSE){
        $telszam = preg_replace('/[^0-9]/', '', $telszam); // előbb kihajigálom a nem számjegyeket
        preg_match('/^((?:[03]|003)6)?(?(?=([237]0|1))([237]0|1)(\d{7})|(2[2-9]|3[1-7]|4[024-9]|5[234679]|6[23689]|7[2-9]|8[02-9]|9[92-69])(\d{6}))$/', $telszam, $result);
        if($result){
            $result = array_unique($result);    // kiütöm a szükségtelen tömbelemeket
            $orszag = (empty($result[1]) || $result[1] == '06') ? $orszagkod : $result[1];  // Beállítom az országkódot, ha nincs megadva, 06 vagy 0036
            $orszag = ($orszag == 36 || $orszag == '0036') ? "+36" : $orszag;
            $szam1 = substr(end($result), 0, 3);
            $szam2 = substr(end($result), 3);  // 'egységes' alakra hozom a számot
            $korzet = prev($result);

            if(!$href){
                return $orszag . "(" . $korzet . ") " . $szam1 . "-" . $szam2;
            }else{
                return $orszag . $korzet . $szam1 . $szam2;
            }
            //Ha a telefonszám esetleg külföldi szám, akkor visszatérünk simán a számokkal
        }elseif(intval($telszam) && 10 < strlen($telszam)){
            return $telszam;
        }else{
            return FALSE;
        }
    }
}

if(!function_exists('getPropertyIfExist')){
    /**
     * Ha létezik a tulajdonság visszatér az értékével
     * @param $property
     * @param $_this
     * @return null
     */
    function getPropertyIfExist($property, $_this){
        if(property_exists($_this, $property)){
            return $_this->$property;
        }else{
            return null;
        }
    }
}

if(!function_exists('arrayToString')){
    /**
     * @param array $array
     * @param string $glue
     * @return string
     */
    function arrayToString(array $array, $glue = ' | '){

        $string = '';
        foreach($array as $k => $v){
            if(is_array($v)){
                $string .= $k.': ['.arrayToString($v, $glue).']'.$glue;
            }else{
                $string .= $k.': '.$v.$glue;
            }
        }
        return trim($string, $glue);
    }
}

if(!function_exists('trimServiceName')){
    /**
     * @param $serviceName
     * @return string
     */
    function trimServiceName($serviceName){
        $exp = explode(' - ', $serviceName);
        $serviceName = $exp[1];
        $exp = explode('(', $serviceName);
        return trim($exp[0]);
    }
}

if(!function_exists('nextWorkday')){
    /**
     * Visszaadja a következő munkanapot
     * @param $today
     * Az a nap, amihez képest a következő munkanapok visszakapjuk
     * @param array $workdays
     * Munkanapok számmal (1-7)
     * @return false|int|string
     * Ha unix a $today akkor unix, ha string akkor string
     */
    function nextWorkday($today, array $workdays){
        $weekdays = [1,2,3,4,5,6,7];
        $string = false;
        if(!in_array($today, $weekdays) && !isValidTimeStamp($today)){
            $today = strtotime($today);
            $string = true;
        }

        $next_workday = $today;
        $i = 0;
        do{
            $next_workday = strtotime("+1 day", $next_workday);
            $i++;
        }while(!in_array(date('N', $next_workday), $workdays) && $i < 100);

        if($string){
            $next_workday = date('Y-m-d', $next_workday);
        }

        return $next_workday;

    }
}

if(!function_exists('isValidTimeStamp')){
    /**
     * @param $timestamp
     * @return bool
     */
    function isValidTimeStamp($timestamp)
    {
        return ((string) (int) $timestamp === $timestamp)
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }
}