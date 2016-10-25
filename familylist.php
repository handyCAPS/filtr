<?php

$tempArray = [];

echo "<input list='family' class='form-control dlist-search' />";
echo "<datalist class='dlist' name='family' id='family'>";
	while ($familyRow = $familyResult->fetch_assoc()) {
		$tempArray['familyName'] = $familyRow['familyName'];
		$tempArray['familyId'] = $familyRow['familyId'];
		$tempArray['cityId'] = $familyRow['cityId'];
		$familyArray[] = $tempArray;
		echo "<option value='{$familyRow['familyName']}' data-reference='{$familyRow['familyId']}' data-belongsto='{$familyRow['cityId']}'>";
	}
echo "</datalist>";

echo "<select size='30' class='list form-control' data-list='family' data-filters='name' id='select-family'>";

foreach ($familyArray as $family) {
	echo "<option value='{$family['familyId']}' data-belongsto='{$family['cityId']}' data-reference={$family['familyId']}>{$family['familyName']}</option>";
}

echo "</select>";