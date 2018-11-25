<?php

class Sorter {
    public static function insertionSort($my_array) {
	for($i=0;$i<count($my_array);$i++){              
		$obj = $my_array[$i];
		$j = $i-1;
		while($j>=0 && $my_array[$j]->milesAway > $obj->milesAway){
			$my_array[$j+1] = $my_array[$j];
			$j--;
		}
		$my_array[$j+1] = $obj;
            }
    return $my_array;
    }
}
