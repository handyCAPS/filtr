<?php
require_once 'header.php';
// set_time_limit(300);
// require_once './vendor/autoload.php';

// $faker = Faker\Factory::create();

// echo $faker->city;

require_once 'connection.php';

$fullQuery = "SELECT 
		name.id as nameId,
		family.city_id as cityId,
		family.id as familyId,
		name.name as firstName,
		family.name as lastName,
		city.name as cityName FROM name 
		inner join (family, city) on family.id = family_id 
		and city.id = family.city_id";

$cityQuery = "SELECT * from city";

$familyQuery= "SELECT * from family";

$nameQuery = "SELECT 
		name.name as firstName,
		family.name as lastName,
		name.id as nameId,
		family.id as familyId,
		city.name as cityName
		from name inner join (family, city) on name.family_id = family.id and family.city_id = city.id";

$cityresult = $db->query($cityQuery);
$cityArray = [];

$familyResult = $db->query($familyQuery);
$familyArray = [];

$nameResult = $db->query($nameQuery);
$nameArray = [];

?>

<div class="container">

	<h1>Find a family</h1>
	
	<div class="row">

		<div class="col-md-4">
			<?php include_once 'citylist.php'; ?>
		</div>

		<div class="col-md-4">
			<?php include_once 'familylist.php'; ?>
		</div>

		<div class="col-md-4">
			<?php include_once 'namelist.php'; ?>
		</div>

	</div>

</div>

<?php

include_once 'footer.php';