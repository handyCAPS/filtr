<?php

$tempArray = [];

echo "<input list='name' class='form-control dlist-search' />";
echo "<datalist class='dlist' name='name' id='name'>";
	while ($nameRow = $nameResult->fetch_assoc()) {
		$tempArray['nameId'] = $nameRow['nameId'];
		$tempArray['familyId'] = $nameRow['familyId'];
		$tempArray['firstName'] = $nameRow['firstName'];
		$tempArray['lastName'] = $nameRow['lastName'];
		$tempArray['cityName'] = $nameRow['cityName'];
		$nameArray[] = $tempArray;
		echo "<option value='{$nameRow['firstName']} {$nameRow['lastName']} - {$nameRow['cityName']}' data-reference='{$nameRow['nameId']}' data-belongsto='{$nameRow['familyId']}'>";
	}
echo "</datalist>";

echo "<select size='30' class='list form-control' data-list='name' id='select-name'>";

foreach ($nameArray as $name) {
	echo "<option value='{$name['nameId']}' data-reference='{$name['nameId']}' data-belongsto='{$name['familyId']}'>{$name['firstName']} {$name['lastName']} - {$name['cityName']}</option>";
}

echo "</select>";