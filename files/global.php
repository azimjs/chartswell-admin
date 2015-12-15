<script src="../js/parse-1.6.7.min.js"></script>
<script type="text/javascript">
    Parse.initialize("qQbKbAOfCCv21GorToroCgmZSFRUzNfjKphATSgR", "qA320hR1s86oFIdMOfkeQ0bQgxGPrefielB0qFHF");
</script>
<?php
/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 10/22/2015
 * Time: 11:51 AM
 */

//error_reporting(0);


$SITE_NAME = "Chartswell Admin Panel";
$VERSION = 1.0;

include("../parse.php");
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseException;
use Parse\ParseFile;

session_start();
if(!isset($_SESSION['login_user'])){
    header("location: login.php"); // Redirecting To Other Page
}

/*$query = new ParseQuery("Brand");
$pObj = $query->get("DFoXCU9Xtj");


$myPost = new ParseObject("Coupon");
$myPost->set("brandName", "az");
$myPost->set("currentUsage", 10);
$myPost->set("brand", $pObj);

$myPost->save();
exit;*/

/**
 * Function which returns an ArrayList of Brands
 * @return array
 */
function getBrands(){
    $query = new ParseQuery("Brand");
    $results = $query->find();

    $brandsList = array();
    // Do something with the returned ParseObject values
    for ($i = 0; $i < count($results); $i++) {
        $brand = getABrand($results[$i]);
        array_push($brandsList, $brand);
    }
    return $brandsList;

}

/**
 * @param ParseObject $object
 * @return stdClass
 * @throws Exception
 */
function getABrand(ParseObject $object){
    $brand = new stdClass();
    $brand->objectId = $object->getObjectId();
    $brand->brandImage = ($object->get('brandImage')!=null)?$object->get('brandImage')->getUrl():"";
    $brand->description = $object->get('description');
    $brand->location = $object->get('location');
    $brand->multiplier = $object->get('multiplier');
    $brand->name = $object->get('name');
    $brand->createdAt = $object->getCreatedAt();
    $brand->updatedAt = $object->getUpdatedAt();
    return $brand;
}

function getACoupon(ParseObject $object){
    $coupon = new stdClass();
    $coupon->objectId = $object->getObjectId();
    if($object->get('brand')!=null) {
        $couponBrand = $object->get('brand')->fetch();
        $coupon->brand = getABrand($couponBrand);
    }
else{
    $coupon->brand = null;
}

    $coupon->currentUsage = $object->get('currentUsage');
    $coupon->endDateTime = $object->get('endDateTime');
    $coupon->file = ($object->get('file')!=null)?$object->get('file')->getUrl():"";

    $coupon->maxUsage = $object->get('maxUsage');
    $coupon->startDateTime = $object->get('startDateTime');
    $coupon->title = $object->get('title');
    $coupon->type = $object->get('type');
    $coupon->visitThreshold = $object->get('visitThreshold');

    return $coupon;
}
function getCoupons(){
    $query = new ParseQuery("Coupon");
    $results = $query->find();

    $couponsList = array();
    // Do something with the returned ParseObject values
    for ($i = 0; $i < count($results); $i++) {
        $coupon = getACoupon($results[$i]);
        array_push($couponsList, $coupon);
    }
    return $couponsList;
}

function getARegion(ParseObject $object){
    $region = new stdClass();
    $region->objectId = $object->getObjectId();
    $region->name = $object->get('name');
    $region->createdAt = $object->getCreatedAt();
    $region->updatedAt = $object->getUpdatedAt();

    return $region;
}

//$obj = getBeacons();


/**
 * @return array
 */
function getBeacons(){
    $query = new ParseQuery("Beacon");
    $results = $query->find();

    $beaconsList = array();
    // Do something with the returned ParseObject values
    for ($i = 0; $i < count($results); $i++) {

        $beacon = getABeacon($results[$i]);
        array_push($beaconsList, $beacon);
//        echo $object->getObjectId() . ' - ' . $object->get('foo');
    }

    return $beaconsList;
}

function getABeacon(ParseObject $object){

    $beacon = new stdClass();
    $beacon->objectId = $object->getObjectId();
    $beacon->uuid = $object->get('UUID');
    $beacon->beaconColor = $object->get('beaconColor');

    if(count($object->getRelation("brand")->getQuery()->find())!=0) {
        $beaconBrand = $object->getRelation("brand")->getQuery()->find();
        $beacon->brand = getABrand($beaconBrand[0]);
    }
    else{
        $beacon->brand =null;
    }

    $beacon->major = $object->get('major');
    $beacon->minor = $object->get('minor');
    $beacon->name = $object->get('name');

    if($object->get('region')!=null) {
        $beaconRegion = $object->get('region')->fetch();
        $beacon->region = getARegion($beaconRegion);
    }
    else
        $beacon->region = null;

    $beacon->type = $object->get('type');
    $beacon->createdAt = $object->getCreatedAt();
    $beacon->upadtedAt = $object->getUpdatedAt();

    return $beacon;
}


/*$parseObj = new ParseClass;

//print_r($parseObj->brandObject);
echo $parseObj->getBrand()->brandId;
exit;

class ParseClass {

    public $brandObject;

    public function __construct(){
        //echo "class initialized";
        $brandObject = new ParseObject("Brand");
        $this ->brandObject = $brandObject;
    }

    public function getBrand(){
        $brandId =  $this->brandObject->get("objectId");
    }
}*/