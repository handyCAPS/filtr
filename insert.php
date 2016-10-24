<?php
set_time_limit(300);

require_once 'connection.php';
require_once './vendor/autoload.php';

$faker = Faker\Factory::create();


$family_id = 1;

for ($i = 0; $i < 1000; $i++) {
	if ($i > 1 && $i % 10 == 0) { $family_id++; }
	$sql = "INSERT INTO name (name, family_id) VALUES ('{$faker->firstName}', '$family_id')";
	echo $sql;
	echo "<br>$i: ";
	// $db->query($sql);
}