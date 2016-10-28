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

$familyQuery= "SELECT
		family.id as familyId,
		family.name as familyName,
		city.id as cityId from family
		inner join (city) on family.city_id = city.id";

$nameQuery = "SELECT 
		name.name as firstName,
		family.name as lastName,
		name.id as nameId,
		family.id as familyId,
		city.name as cityName from name 
		inner join (family, city) on name.family_id = family.id
		and family.city_id = city.id";

$cityresult = $db->query($cityQuery);
$cityArray = [];

$familyResult = $db->query($familyQuery);
$familyArray = [];

$nameResult = $db->query($nameQuery);
$nameArray = [];

?>

<div class="container">

	<div class="panel panel-primary">
		<div class="panel-heading collapsible">
			<h1 class="panel-title">Find a family</h1>
		</div>
		
		<div class="row panel-body" id="selectors">
			
			<div class="col-sm-12">
				<button type="button" id="btnClearAll" class="btn btn-danger">Clear All</button>
			</div>

			<div class="col-md-4 wrap">
				<button type="button" class="btn btn-secondary btn-clear">Clear</button>
				<?php include_once 'citylist.php'; ?>
			</div>

			<div class="col-md-4 wrap">
				<button type="button" class="btn btn-secondary btn-clear">Clear</button>
				<?php include_once 'familylist.php'; ?>
			</div>

			<div class="col-md-4 wrap">
				<button type="button" class="btn btn-secondary btn-clear">Clear</button>
				<?php include_once 'namelist.php'; ?>
			</div>

		</div>
	</div>

</div>

<?php

include_once 'footer.php';