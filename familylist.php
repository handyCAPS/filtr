<?php

$tempArray = [];

echo "<input list='family' class='form-control dlist-search' />";
echo "<datalist class='dlist' name='family' id='family'>";
	while ($familyRow = $familyResult->fetch_assoc()) {
		$tempArray['id'] = $familyRow['id'];
		$tempArray['name'] = $familyRow['name'];
		$familyArray[] = $tempArray;
		echo "<option value='{$familyRow['name']}' data-reference='{$familyRow['id']}' data-belongsto='{$familyRow['city_id']}'>";
	}
echo "</datalist>";

echo "<select size='30' class='list form-control'>";

foreach ($familyArray as $family) {
	// echo "<li data-reference='{$family['id']}'>{$family['name']}</li>";
	echo "<option value='{$family['id']}' data-belongsto=''>{$family['name']}</option>";
}

echo "</select>";