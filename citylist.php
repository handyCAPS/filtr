<?php

echo "<input list='city' class='form-control dlist-search' />";
echo "<datalist class='dlist' name='city' id='city'>";
while ($cityRow = $cityresult->fetch_assoc()) {
	$tempArray['id'] = $cityRow['id'];
	$tempArray['name'] = $cityRow['name'];
	$cityArray[] = $tempArray;
	echo "<option value='{$cityRow['name']}' data-reference='{$cityRow['id']}' />";
}
echo "</datalist>";

echo "<select size='30' class='list form-control'>";
foreach ($cityArray as $city) {
	// echo "<li data-reference='{$city['id']}'>{$city['name']}</li>";
	echo "<option value='{$city['id']}'>{$city['name']}</option>";
}
echo "</select>";
