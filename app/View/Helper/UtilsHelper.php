<?php

class UtilsHelper extends AppHelper {

    function yesOrNo($string) {
        //debug($string);
        if ($string==='0'||$string===0||$string===false ) return __("No");
        if ($string==='1'||$string===1||$string===true ) return __("Yes");
        if ($string===''||empty($string)) return '';
        return '';
        
        
        
               
            
    }

    function formatDate($date) {

        $monthMap = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
        // Delimiters may be slash, dot, or hyphen
        //$date = "04/30/1973";
        list($day, $month, $year) = split('[/.-]', $date);
        $monthDescription = $monthMap[$month - 1];

        return $day . " de " . $monthDescription . " de " . $year;
    }

    function imageExist($file, $sizeType='default') {
        $noImage = 'noimage.png';
        $noImageLow = 'noimage.png';
        $noImageHigh = 'noimage.png';
        if (!is_file(WWW_ROOT . $file)) {
            switch ($sizeType) {
                case 'low':
                    $file = $noImageLow;
                    break;
                case 'high':
                    $file = $noImageHigh;
                    break;
                default:
                    $file = $noImage;
                    break;
            }
        }
        return $file;
    }

    


}
?>
