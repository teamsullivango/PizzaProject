<?php 
/*
	* Confirmation page to display to screen and send to Swiftmailer 
	*
	* Description Long
	*
	* @author			Tony Gaudio, David Sullivan
	* @category   ANM293
	* @package    PizzaProject
	* @version    1
	* @link				git@github.com:Wireman131/PizzaProject
	* @link       git@github.com:teamsullivango/PizzaProject
	* @since      Mar 11, 2011-2011
*/

@session_start();
$customerName = $_SESSION['customerName'];
$customerEmail = $_SESSION['customerEmail'];
$orderSummary = $_SESSION['orderSummary'];
$timeOfOrder = $_SESSION['timeOfOrder'];
$customerAddress = $_SESSION['customerAddress'];
$customerBillingAddress = $_SESSION['customerBillingAddress'];
$payMethod = $_SESSION['payMethod'];
?>

<div id='confirmEmail'>
<div id='container'>
<div id='header'><img src='images/header.png'/></div>
<div id='hElement'></div>
<div id='content'>
<div id='orderSummary'>Order Summary for: 
<?php 
//print_r($_SESSION);
try {
$dbh = new PDO('sqlite:../database/pizzaOrders.db'); //SQLite by default is UTF-8
//$dbh->exec('SET NAMES utf8');
//
//build a string with the statement and evaluated session v's
$dbh->exec('CREATE TABLE orders(id INTEGER PRIMARY KEY, name CHAR(20), email CHAR(30), 
						orderSummary CHAR(255), timeOfOrder CHAR(40), address CHAR(30), 
						billingAddress CHAR(30), payMethod CHAR(10), processed INTEGER(1) ) ');
$insertStatement = "INSERT INTO orders (name, email, orderSummary, timeOfOrder,
 address, billingAddress, payMethod, processed)" .
	"VALUES('" . $customerName ."','".	$customerEmail ."','". $orderSummary ."','".
	$timeOfOrder ."','". $customerAddress ."','".	$customerBillingAddress ."','". $payMethod."','0')";

$dbh->exec($insertStatement);

$dbh = NULL;

}
catch(PDOException $e)
{
die($e->getMessage());
}


echo $_SESSION['customerName'] . " :<br/><br/>";
echo "Customer Email : " .$_SESSION['customerEmail'] . " <br/><br/>";
echo $_SESSION['orderSummary'] . "<br/><br/>";
echo "Order processed At :" . $_SESSION['timeOfOrder'] . "<br/><br/>";
echo $_SESSION['delivery'] . $_SESSION['deliveryTime'] . "<br/><br/>";
echo "Customer Address : " . $_SESSION['customerAddress'] . "<br/>";
echo "Billing Address : " . $_SESSION['customerBillingAddress'] . "<br/>";
echo "Please be ready to pay with " . $_SESSION['payMethod'] . "<br/>";
//echo "Value of your coupon : $0.00 - Sorry, coupon code " . $_SESSION['emailCoupon'] . " is expired!<br/>";
echo"Coupon Value : " . $_SESSION['couponValue'] . "<br/>";
echo "Total amount for your order : $" . $_SESSION['orderTotal'] . "<br/>";
echo "Thank You!! Please Visit Again!<br/>";
echo "<a href='index.php'>Order Another</a>";
ob_flush();
    ?>
    
    
    </div>
</div>
</div>
<div id='footer'>&copy; 2011 &mdash; <strong>Tony & Dave's Pizza</strong></div>
</div>
