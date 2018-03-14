<?php
//exercice one

// Create a table in PHP containing the following information:
//● First name  ● Last name ● Address ● Postal code ● City ● Email ● Telephone ● Date of birth in English format (YYYY-MM-DD)

$exercice1Array = [
    'firstname' => 'Nathalie',
    'lastname' => 'Montois',
    'address' => '8, rue Centrale',
    'postalcode' => '4499',
    'city' => 'Limpach',
    'email' => 'nathalie.montois@outlook.com',
    'phone' => '691.813.203',
    //The date is to be displayed in French format (DD / MM / YYYY).
    'dateofbirth' => date('d/m/Y', strtotime('1964-02-18'))

];

//exercice two

//Create a function to convert an amount in euros to an amount in US dollars. 
//This function will take two parameters: ● Amount (of type int or float) ● Currency of exit (only EUR or USD).
//If the second parameter is "USD", the result of the function will be, for example: 1 euro = 1.085965 US dollars
$currency = 'EUR' || 'USD';
function convertEuroToDollar($amount, $currency){
    //The necessary checks must be made to validate the parameters. 
    if((is_int($amount) || is_float($amount)) && ($currency == 'EUR' || 'eur')){
        $functionResult = $amount * 1.085965 . ' ' . 'US dollars';
        return $amount . ' ' . $currency . ' = ' . $functionResult;
    } else {
        if((is_int($amount) || is_float($amount)) && ($currency == 'USD' || 'usd')){
            $functionResult = $amount * 0;
        }
        return $amount . ' ' . $currency . ' = ' . $amount . ' ' .$currency;
    }
}



?>
<!DOCTYPE html>
<html lang="en">

    <head>
    	<meta charset="utf-8">
    	<title>PHP Table</title>
    </head>
<!--  Using a loop, display the contents of this array (keys + values) in an HTML list. -->
    <body>
    	<h1>My PHP table</h1>
    
    	<ul>
<?php	
$myTable = ['<ul>'];

foreach($exercice1Array as $key => $value) {

    echo "<li>$key / $value</li>";
    
}
$myTable = ['</ul>'];
?>
		</ul>
	</body>
</html>     