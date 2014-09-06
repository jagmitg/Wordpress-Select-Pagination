<?php
	$paginationType = 1; // 0 = select // 1 = default pagination (numerical)
	$prevnext = true; //for select option only
	$middleSize = 4;
	$totalPageNumber = true;

	if($paginationType == 0){
		$typeOfArray = 'array';
	}elseif($paginationType == 1 || $paginationType > 1 ){
		$typeOfArray = 'list';
	}
?>