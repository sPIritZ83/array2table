<?php
/**
 * Date: 28.08.14
 * Time: 10:00
 */

class Array2Table {

    private $arrayStruct = array();
    private $array = array();
    private $tp;

    function __construct($tp, $array){

        $this->array = $array;
        $this->tp = $tp;

        $this->arrayStruct();




    }

     function arrayStruct($array = false, $tbl=0){

        if(!$array) $array = $this->array;
        $fields = array(); $internal = 0; $trow=1;

        foreach($array as $k=>$v){
            if(is_string($k)) {
                if (is_array($v)) {
                    //foreach ($v as $field => $v1) {
                        //if(is_array($v1)) $fields[$field] = (is_array($fields[$field]) ? array_unique(array_merge($fields[$field], $this->arrayStruct($v1, $tbl++))) : $this->arrayStruct($v1, $tbl++));
                        //else
                        //$fields[$field] = $field;
                    //}
                    $fields[$k][$trow] = "array";
                } else {
                    $fields[$k][$trow] = $v;
                }
            }else{ $internal++; $trow++; }

        }
         //str_repeat("[]", $internal).
         print_r($fields);
         $this->arrayStruct[$tbl] = $fields;
    }

    private function toHTML($array, $tp){

        foreach($this->arrayStruct as $field=>$field_data){

        }

        if($fields){

            $return .= ($hidden ? '<a href="#" onclick="$(this).hide().next(\'table\').show();return false;">Показать</a>' : '').'<table style="box-shadow:none;'.($hidden ? "display:none" : '').'">';

            $return .= '<tr><td></td>';
            foreach($fields as $field=>$field_data){
                $return .= '<td class="content_l">'.$field.'</td>';
            }
            $return .= '</tr>';

            foreach($array as $k=>$v) if(is_array($v)) {

                //if($k>$next_add && $next_add>=0) $next_add = $k+1;
                //if(!is_numeric($k)) $next_add = -1;

                $return .= '<tr><td class="content_l"><b>'.$k.':</b></td>';

                foreach($fields as $field=>$field_data){

                    $return .= '<td class="content">';
                    //$add .= '<td class="content add">';

                    if(is_array($v[$field])){

                        $return .= array2table($v[$field], $tp.'['.$k.']['.$field.']', 1);
                        //$add .= array2table($v[$field], $tp.'[]['.$field.']', 1);

                    }else{

                        $length=strlen($v[$field])+1;

                        if($length<3 && $length>1) $length=3;
                        if($length>28 || $length<1) $length=28;

                        $return .= '<input type="text" name="value'.$tp.'['.$k.']['.$field.']" value="'.$v[$field].'" size='.$length.' style="width:100%">';
                        //$add .= '<input type="text" name="value'.$tp.'[]['.$field.']" value="'.$v[$field].'" size=10 style="width:100%">';

                    }

                    //$add .= '</td>';
                    $return .= '</td>';

                }

                $return .= '</tr>';

            }else{

                $return .= '<tr><td class="content_l">Значения</td>';

                foreach($array as $k=>$v){

                    $length=strlen($v)+1;

                    if($length<3 && $length>1) $length=3;
                    if($length>28 || $length<1) $length=28;

                    $return .= '<td class="content"><input type="text" name="value'.$tp.'['.$k.']" value="'.$v.'" size='.$length.' style="width:100%"></td>';
                }

                $return .= '</tr>';

                break;

            }

            //if($next_add>=0) $return .= '<tr><td class="content_l"><b>+</b></td>'.$add.'</tr>';

            $return .= '</table>';

        }

        return $return;

    }
} 
