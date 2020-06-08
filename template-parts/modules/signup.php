<?php

//Whitelabel Basic Signup Page.
ini_set("display_errors", "on");

//SETUP VARIABLES
$setup["username"] = "SmartCloudPhone";
$setup["API_KEY"] = "hdAw16Pui7ihKLfd7rt0";
$setup["strict"] = 1; //Allow incomplete information and minor errors
$setup["success_URL"] = "https://www.smartcloudphone.com.au/thank-you/";
$setup["API_BASE_URL"] = "https://api.maxo.com.au/wla/?user=" . $setup["username"] . "&key=" . $setup["API_KEY"];
$setup['plan_list_cache_file'] = 'cache_plans.txt'; //File used to keep a local cache of the plan list

/*
NEVER ACTIVATE WEB-ORIGINATED SIGNUPS DIRECTLY THROUGH THE API.

This script is designed to insert signups to the PENDING SIGNUPS area of MADMIN. You can then
verify the account-holder information and activate the account if you wish.

YOU SHOULD SCRUTINIZE ALL WEB-ORIGINATED SIGNUPS. Fraud in the VoIP industry is ubiquitous and
every signup should be treated as suspicious until you can verify the customer's identity or
payment method.
*/

ignore_user_abort(); //If user presses stop button, the script continues anyway

if (file_exists($setup['plan_list_cache_file'])) {

    if (!$plans = json_decode(file_get_contents($setup['plan_list_cache_file']))) {
        echo "Error Decoding Plans from Cache. Attempting to write new cache.";
        $plan_raw = file_get_contents($setup["API_BASE_URL"] . "&action=newCustomer&list_plans=1") or die("Error fetching plans from API");;
        if (!$plans = json_decode($plan_raw)) {
            echo "Error Decoding Plans from API. Contact the site administrator.";
        } else {
            file_put_contents($setup['plan_list_cache_file'], $plan_raw); //new cache written
        }
    } else { //File exists, fetch new copy
        if (filemtime($setup['plan_list_cache_file']) + 3600 < time()) { //cache expired
            $plan_raw = file_get_contents($setup["API_BASE_URL"] . "&action=newCustomer&list_plans=1") or die("Error fetching plans from API");;
            if (!$plans = json_decode($plan_raw)) {
                echo "Error Decoding Plans from API. Contact the site administrator.";
            } else {
                file_put_contents($setup['plan_list_cache_file'], $plan_raw); //new cache written
            }
        }
    }
} else {

    $plan_raw = file_get_contents($setup["API_BASE_URL"] . "&action=newCustomer&list_plans=1") or die("Error fetching plans from API");;
    if (!$plans = json_decode($plan_raw)) {
        echo "Error Decoding Plans from API. Contact the site administrator.";
    } else {
        file_put_contents($setup['plan_list_cache_file'], $plan_raw); //new cache written
    }
}

//Process submitted data
if ($_REQUEST["form_submitted"]) {

    $planid = $_REQUEST["selectbusplan"];
    $account_autotopup_amount = (substr($_REQUEST["account_autotopup_amount"], 0, 10) > 0 && substr($_REQUEST["account_autotopup_amount"], 0, 10) < 500 ? substr($_REQUEST["account_autotopup_amount"], 0, 10) : 20); //default Auto Topup
    $account_autotopup_at = (substr($_REQUEST["account_autotopup_at"], 0, 10) > 0 && substr($_REQUEST["account_autotopup_at"], 0, 10) < 500 ? substr($_REQUEST["account_autotopup_at"], 0, 10) : 10); //default Auto Topup

    $sb = array(
        "account_invoicing"                     => 1,
        "account_invoice_email"                 => 1,
        "account_balance_auto_credit"           => 1,
        // "strict"                                => $setup["strict"],
        "sendemail"                             => $setup["sendemail"],
        "sendsms"                               => $setup["sendsms"],
        "account_cust_id"                       => substr($_REQUEST["account_cust_id"], 0, 20),
        "account_title"                         => substr($_REQUEST["account_title"], 0, 10),
        "account_username"                      => substr($_REQUEST["account_username"], 0, 50),
        "account_password"                      => substr($_REQUEST["account_password"], 0, 128),
        "account_first_name"                    => substr($_REQUEST["account_first_name"], 0, 50),
        "account_middle_name"                   => substr($_REQUEST["account_middle_name"], 0, 50),
        "account_last_name"                     => substr($_REQUEST["account_last_name"], 0, 50),
        "account_email"                         => substr($_REQUEST["account_email"], 0, 50),
        "account_mobile"                        => substr($_REQUEST["account_mobile"], 0, 20),
        "account_phone"                         => substr($_REQUEST["account_phone"], 0, 20),
        "account_abn"                           => substr($_REQUEST["account_abn"], 0, 50),
        "account_business_name"                 => substr($_REQUEST["account_business_name"], 0, 50),
        "account_address"                       => substr($_REQUEST["account_address"], 0, 50),
        "account_city"                          => substr($_REQUEST["account_city"], 0, 50),
        "account_post_code"                     => substr($_REQUEST["account_post_code"], 0, 50),
        "account_state"                         => substr($_REQUEST["account_state"], 0, 50),
        "account_country"                       => substr($_REQUEST["account_country"], 0, 50),
        "account_timezone"                      => substr($_REQUEST["account_timezone"], 0, 50),
        "account_autotopup_at"                  => $account_autotopup_at,
        "account_autotopup_amount"              => $account_autotopup_amount,
        "account_credit_limit"                  => "0",
        "account_postpaid"                    => "0",

        "account_acc_full_name"               => substr($_REQUEST["account_acc_full_name"], 0, 50),
        "account_acc_email"                   => substr($_REQUEST["account_acc_email"], 0, 50),
        "account_acc_phone"                     => substr($_REQUEST["account_acc_phone"], 0, 20),
        "account_acc_fax"                        => substr($_REQUEST["account_acc_fax"], 0, 20),
        "account_acc_mobile"                   => substr($_REQUEST["account_acc_mobile"], 0, 20),

        "account_tech_full_name"               => substr($_REQUEST["account_tech_full_name"], 0, 50),
        "account_tech_email"                    => substr($_REQUEST["account_tech_email"], 0, 50),
        "account_tech_phone"                    => substr($_REQUEST["account_tech_phone"], 0, 20),
        "account_tech_mobile"                   => substr($_REQUEST["account_tech_mobile"], 0, 20),

        "account_plan_id"                       => substr($planid, 0, 10),
        "account_plan_prorated"                 => $setup["account_plan_prorated"],

        "creditcard_number"                     => substr($_REQUEST["creditcard_number"], 0, 20),
        "creditcard_month"                  => substr($_REQUEST["creditcard_month"], 0, 2),
        "creditcard_year"                    => substr($_REQUEST["creditcard_year"], 0, 4),
        "creditcard_ccv"                        => substr($_REQUEST["creditcard_ccv"], 0, 4),
        "creditcard_name"                       => substr($_REQUEST["creditcard_name"], 0, 50),
        "creditcard_type"                       => substr($_REQUEST["creditcard_type"], 0, 20),

        "ipnd_service_building_type"                            => substr($_REQUEST["ipnd_service_building_type"], 0, 50),
        "ipnd_service_subunit_first_number"                     => substr($_REQUEST["ipnd_service_subunit_first_number"], 0, 50),
        "ipnd_service_subunit_first_number_suffix"              => substr($_REQUEST["ipnd_service_subunit_first_number_suffix"], 0, 50),
        "ipnd_service_building_floor_type"                      => substr($_REQUEST["ipnd_service_building_floor_type"], 0, 50),
        "ipnd_service_building_floor_number"                    => substr($_REQUEST["ipnd_service_building_floor_number"], 0, 50),
        "ipnd_service_building_floor_number_suffix"             => substr($_REQUEST["ipnd_service_building_floor_number_suffix"], 0, 50),
        "ipnd_service_street_house_number_1"                    => substr($_REQUEST["ipnd_service_street_house_number_1"], 0, 50),
        "ipnd_service_street_house_number_2"                    => substr($_REQUEST["ipnd_service_street_house_number_2"], 0, 50),
        "ipnd_service_street_house_first_number_suffix"         => substr($_REQUEST["ipnd_service_street_house_first_number_suffix"], 0, 50),
        "ipnd_service_street_name_1"                            => substr($_REQUEST["ipnd_service_street_name_1"], 0, 50),
        "ipnd_service_street_type_1"                            => substr($_REQUEST["ipnd_service_street_type_1"], 0, 50),
        "ipnd_service_street_suffix_1"                          => substr($_REQUEST["ipnd_service_street_suffix_1"], 0, 50),
        "ipnd_service_address_locality"                         => substr($_REQUEST["ipnd_service_address_locality"], 0, 50),
        "ipnd_service_address_post_code"                        => substr($_REQUEST["ipnd_service_address_post_code"], 0, 50),
        "ipnd_service_province_id"                              => substr($_REQUEST["ipnd_service_province_id"], 0, 50),
        "ipnd_service_country_id"                               => substr($_REQUEST["ipnd_service_country_id"], 0, 50)
    );


    //If a field is null then make it an empty string - prevents JSON from setting the value to 0
    foreach ($sb as $sbk => $sbv) if ($sbv === false) $sb[$sbk] = (string) '';

    //Turn array of values into HTTP GET string
    $sbq = http_build_query($sb);

    //Submit to the API
    $newcustomer_raw = file_get_contents($setup["API_BASE_URL"] . "&action=newCustomer&" . $sbq) or die("Error posting to newCustomer API");;

    //Decode the JSON response
    $json = json_decode($newcustomer_raw, true);

    //Check we got a valid JSON response
    if (!is_array($json)) {
        die('Invalid response received from the API');
    };

    if ($json["response"] == "OK") {
        echo "<script>window.location = '" . $setup["success_URL"] . "';";
    } else {
        if ($json["errors"]) {
            echo '<b>Errors:</b><br>';
            foreach ($json["errors"] as $error) {
                echo $error["error_msg"] . "<br>";
            }
            echo '<br>';
        }

        // if ($json["warnings"]) {
        //     echo '<b>Warnings:</b><br>';
        //     foreach ($json["warnings"] as $error) {
        //         echo $error["error_msg"] . "<br>";
        //     }
        //     echo '<br>';
        // }
        echo '<a href="#" onclick="$(\'#overlay\').hide();">Back</a>';
    }
    exit;
}

// Street Type
require_once('streetTypes.array.php');

$default_streets = "";
foreach ($street_types as $key => $value) {
    if ($key == "ST") {
        $dstreetsel = "";
    } else {
        $dstreetsel = "";
    }
    $default_streets = $default_streets . '<option value="' . $key . '"' . $dstreetsel . '>' . $value . '</option>';
}

// print_r($default_streets);
$busplans = '';
$plan_id = array(
    2590, 2589, 2584, 2582, 2588, 2587, 2586, 2585, 2579, 2578
);
// sort($plans->plans);
// print_r($plans->plans);
// function compare($a, $b)
// {
//     return strcmp($a["name"], $b["name"]);
// }
// usort($plans->plans, "compare");

$array_plan = array();
foreach ($plans->plans as $plan) {
    if ($plan->active == "1") {
        if (in_array($plan->account_plan_id, $plan_id)) {
            // $busplans .= '<option value="' . $plan->account_plan_id . '">' . $plan->name . ' @ $' . $plan->price . '/month </option>';
            $array_plan_store = array(
                'account_plan_id' => $plan->account_plan_id,
                'name' => $plan->name,
                'price' => $plan->price,
                'active' => $plan->active
            );

            array_push($array_plan, $array_plan_store);
        }
    }
}
function compare($a, $b)
{
    return strcmp($a["name"], $b["name"]);
}
usort($array_plan, "compare");
foreach ($array_plan as $plan) {
    if ($plan['active'] == "1") {
        if (in_array($plan['account_plan_id'], $plan_id)) {
            $busplans .= '<option value="' . $plan['account_plan_id'] . '">' . $plan['name'] . ' @ $' . $plan['price'] . '/month </option>';
        }
    }
}
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#signlookup').submit(function() { // catch the form's submit event
            $('#signresult').html('<img src="https://www.smartcloudphone.com.au/wp-content/uploads/2020/06/loading.gif">');
            $('#overlay').show();

            $.ajax({ // create an AJAX call...
                data: $(this).serialize(), // get the form data
                type: $(this).attr('method'), // GET or POST
                url: $(this).attr('action'), // the file to call
                success: function(response) { // on success..
                    $('#signresult').html(response); // update the DIV
                    console.log(response)
                }
            });

            return false; // cancel original event to prevent form submitting
        });




        //attach handler
        $("#overlay").click(function(ev) {
            //did they click the correct div
            if ($(ev.target).attr("id") == "overlay") {
                $('#overlay').hide();
            }
        });

    });
</script>

<script type="text/javascript">
    function showhide() {
        if ($('#selectaccounts').val() == "YES") {
            $('#accounts').show();
        } else {
            $('#accounts').hide();
        }

        if ($('#selecttech').val() == "YES") {
            $('#tech').show();
        } else {
            $('#tech').hide();
        }


        return 0;
    };
</script>
<a name="signuptop"></a>
<form id="signlookup" method="post" action="">
    <h3>Account Information</h3>
    <fieldset>
        <p class="title"><span>Account Holder Details</span></p>
        <div class="row">
            <div class="col col-md-6">
                <label>Title:</label>
                <select name="account_title" id="title">
                    <option value="Dr">Dr</option>
                    <option value="Miss">Miss</option>
                    <option value="Mr" selected>Mr</option>
                    <option value="Mrs">Mrs</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col col-md-6">
                <label class="required">First Name:</label>
                <input name="account_first_name" type="text" id="account_first_name" minlength="2" required>
                <!-- <span id="business3"><strong>Business Owner Details</strong></span> -->
                <!-- <label>Middle Name:</label> -->
            </div>
            <!-- <div class="col col-md-4">
                    <input name="account_middle_name" type="text" id="account_middle_name" placeholder="Middle Name">
                   
                </div> -->
            <div class="col col-md-6">
                <label class="required">Last Name:</label>
                <input name="account_last_name" type="text" id="account_last_name" minlength="2" required>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <label class="required">Email:</label>
                <input name="account_email" type="email" id="account_email" required>
            </div>
            <div class="col col-md-6">
                <label class="required">Mobile No.:</label>
                <input name="account_mobile" type="number" id="account_mobile" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required minlength="10">
                <em></em>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-12">
                <p class='title'><span>Add Additional Contact (Optional)</span></p>
            </div>
            <div class="col col-md-6">
                <label>Accounts Payable Contact:</label>
                <select id="selectaccounts" name="selectaccounts" onclick="javascript:showhide();">
                    <option>NO</option>
                    <option>YES</option>
                </select>
            </div>
            <div class="col col-md-6">
                <label>Technical Contact:</label>
                <select id="selecttech" name="selecttech" onclick="javascript:showhide();">
                    <option>NO</option>
                    <option>YES</option>
                </select>
            </div>
        </div>
        <div id="accounts" style="display: none;">
            <P class="title"><span>Accounts Contact</span></p>
            <!-- <div>Full Name:</div> -->

            <div class="row">
                <div class="col col-md-12">
                    <label>Full Name:</label>
                    <input name="account_acc_full_name" type="text" id="account_acc_full_name">
                </div>
                <div class="col col-md-6">
                    <label>Email:</label>
                    <input name="account_acc_email" type="text" id="account_acc_email">
                </div>
                <div class="col col-md-6">
                    <label>Phone No.:</label>
                    <input name="account_acc_phone" type="text" id="account_acc_phone">
                </div>
            </div>
            <div class="row">
                <div class="col col-md-6">
                    <label>Fax No.:</label>
                    <input name="account_acc_fax" type="text" id="account_acc_fax">
                </div>
                <div class="col col-md-6">
                    <label>Mobile No.:</label>
                    <input name="account_acc_mobile" type="text" id="account_acc_mobile">
                </div>
            </div>
        </div>
        <div id="tech" style="display: none;">
            <P class="title"><span>Tech Contact</span></p>
            <div class="row">
                <div class="col col-md-6">
                    <label>Full Name:</label>
                    <input name="account_tech_full_name" type="text" id="account_tech_full_name">
                </div>
                <div class="col col-md-6">
                    <label>Email:</label>
                    <input name="account_tech_email" type="text" id="account_tech_email">
                </div>
            </div>
            <div class="row">
                <div class="col col-md-6">
                    <label>Phone No.:</label>
                    <input name="account_tech_phone" type="text" id="account_tech_phone">
                </div>
                <div class="col col-md-6">
                    <label>Mobile No.:</label>
                    <input name="account_tech_mobile" type="text" id="account_tech_mobile">
                </div>
            </div>
            <!-- <label for="userName-2">User name *</label>
            <input id="userName-2" name="userName" type="text" class="required">
            <label for="password-2">Password *</label>
            <input id="password-2" name="password" type="text" class="required">
            <label for="confirm-2">Confirm Password *</label>
            <input id="confirm-2" name="confirm" type="text" class="required">
            <p>(*) Mandatory</p> -->
    </fieldset>

    <!-- <h3>Profile</h3>
        <fieldset>
            <legend>Profile Information</legend>

        </fieldset> -->

    <h3>Business Information</h3>
    <fieldset>
        <p class='title'><span>Business Details:</span></p>
        <div class="row">
            <div class="col col-md-12">
                <label>Business Name:</label>
                <input name="account_business_name" type="text" id="account_business_name">
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <label>ABN:</label>
                <input name="account_abn" type="text" id="account_abn">
            </div>
            <div class="col col-md-6">
                <label>Phone No.:</label>
                <input name="account_phone" type="text" id="account_phone">
            </div>
        </div>
        <div class="row">
            <div class="col col-md-12">
                <label class="required">Postal Address (PO Box or your street address)</label>
                <input name="account_address" type="text" id="account_address" required minlength="7">
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <label class="required">City:</label>
                <input name="account_city" type="text" id="account_city" required minlength="2">
            </div>
            <div class="col col-md-6">
                <label class="required">Post Code:</label>
                <input name="account_post_code" type="text" id="account_post_code" placeholder="Post Code" required minlength="4">
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <label class="required">State:</label>
                <select name="account_state" id="account_state" required>
                    <option value="" disabled selected>State</option>
                    <option value="NSW">NSW</option>
                    <option value="VIC">VIC</option>
                    <option value="QLD">QLD</option>
                    <option value="SA">SA</option>
                    <option value="WA">WA</option>
                    <option value="ACT">ACT</option>
                    <option value="TAS">TAS</option>
                    <option value="NT">NT</option>
                </select>
            </div>
            <div class="col col-md-6">
                <label>Country:</label>
                <input name="account_country" type="text" id="account_country" value="Australia" placeholder="Country">
            </div>
        </div>
        <p class="title"><span>Service Address Details</span></p>
        <div class="r1c2">
            <div colspan="2">IPND Address: Enter the address where the VoIP service will be located.
                These are the details emergency services will receive when you call 000.</div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <label class="required">Building type:</label>
                <select name="ipnd_service_building_type" id="ipnd_service_building_type" required>
                    <option value="" selected>Select Building Type</option>
                    <option value="APT">Apartment</option>
                    <option value="F">Flat</option>
                    <option value="FY">Factory</option>
                    <option value="MB">Marine berth</option>
                    <option value="OFF">Office</option>
                    <option value="RM">Room</option>
                    <option value="SE">Suite</option>
                    <option value="SHED">Shed</option>
                    <option value="SHOP">Shop</option>
                    <option value="SITE">Site / House</option>
                    <option value="SL">Stall</option>
                    <option value="U">Unit</option>
                    <option value="VLLA">Villa</option>
                    <option value="WE">Warehouse</option>
                </select>
            </div>
            <div class="col col-md-6">
                <label>Sub-unit Number: </label>
                <input name="ipnd_service_subunit_first_number" type="text" id="ipnd_service_subunit_first_number" size="5" maxlength="5">
                <p class="description">eg 2 (For Unit <font color="#FF0000">2</font>A)</p>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <label>Sub-unit Suffix:</label>
                <input name="ipnd_service_subunit_first_number_suffix" type="text" id="ipnd_service_subunit_first_number_suffix" size="5" maxlength="1">
                <p class="description">eg A (For Unit 2<font color="#FF0000">A</font>)</p>
            </div>
            <div class="col col-md-6">
                <label class="">Floor Type:</label>
                <select name="ipnd_service_building_floor_type" required>
                    <option value="" selected>Select Floor Type</option>
                    <option value="B">Basement</option>
                    <option value="FL">Floor</option>
                    <option value="G">Ground Floor</option>
                    <option value="L">Level</option>
                    <option value="LG">Lower Ground Floor</option>
                    <option value="M">Mezzanine</option>
                    <option value="UG">Upper Ground Floor</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <label>Floor Number:</label>
                <input name="ipnd_service_building_floor_number" type="text" id="ipnd_service_building_floor_number" size="5" maxlength="5">
                <!-- <font color="#000000">&nbsp;</font><strong>)</strong>"> -->
                <p class="description">eg 15 (For Level <font color="#FF0000">15</font>)
                </p>
            </div>
            <div class="col col-md-6">
                <label>Floor Suffix:</label>
                <input name="ipnd_service_building_floor_number_suffix" type="text" id="ipnd_service_building_floor_number_suffix" size="5" maxlength="5">
                <p class="description">eg leave it blank (For Level<font color="#000000"><strong>15</strong></font>)</p>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <label class="required">Street Number:</label>
                <div class="row">
                    <div class="col col-md-5">
                        <input name="ipnd_service_street_house_number_1" type="text" id="ipnd_service_street_house_number_1" size="5" maxlength="5" required minlength="1">
                    </div>
                    <div class="col col-md-2" style="height: 60px;display: flex;align-items: center;justify-content: center;">
                        to
                    </div>
                    <div class="col col-md-5">
                        <input name="ipnd_service_street_house_number_2" type="text" id="ipnd_service_street_house_number_2" size="5" maxlength="5">
                    </div>
                </div>
            </div>
            <div class="col col-md-6">
                <label>Street Number Suffix:</label>
                <input name="ipnd_service_street_house_first_number_suffix" type="text" id="ipnd_service_street_house_first_number_suffix" size="5" maxlength="1">
                <p class="description">eg A (For 58<font color="#FF0000">A</font> Short St)</p>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <label class="required">Street Name:</label>
                <input name="ipnd_service_street_name_1" type="text" id="ipnd_service_street_name_1" size="30" maxlength="50" maxlength="25" required>
            </div>
            <div class="col col-md-6">
                <label class="required">Street Type:</label>
                <select name="ipnd_service_street_type_1" id="ipnd_service_street_type_1" required>
                    <option value="" selected>Select Street Type</option>
                    <?= $default_streets; ?>
                </select></div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <label>Street Suffix:</label>
                <select name="ipnd_service_street_suffix_1" id="ipnd_service_street_suffix_1">
                    <option value="" selected>Select Street Suffix</option>
                    <option value="North">North</option>
                    <option value="South">South</option>
                    <option value="East">East</option>
                    <option value="West">West</option>
                    <option value="">(None)</option>
                </select>
            </div>
            <div class="col col-md-6">
                <label class="required">City/Suburb/Town:</label>
                <input name="ipnd_service_address_locality" type="text" id="ipnd_service_address_locality" size="30" maxlength="50" required>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <label>State:</label>
                <select name="ipnd_service_province_id" id="ipnd_service_province_id">
                    <option value="" selected>Select State</option>
                    <option value="NSW">New South Wales</option>
                    <option value="QLD">Queensland</option>
                    <option value="VIC">Victoria</option>
                    <option value="TAS">Tasmania</option>
                    <option value="SA">South Australia</option>
                    <option value="WA">Western Australia</option>
                    <option value="NT">Northern Territory</option>
                    <option value="ACT">Australia Capital Territory</option>
                </select>
            </div>
            <div class="col col-md-6">
                <label class="required">Post Code:</label>
                <input name="ipnd_service_address_post_code" type="text" id="ipnd_service_address_post_code" size="10" maxlength="10" required minlength="4">
                <input name="ipnd_service_country_id" type="hidden" id="ipnd_service_country_id" value="AU" size="30" maxlength="50">
            </div>
    </fieldset>

    <!-- <h3>Finish</h3>
        <fieldset>
            
        </fieldset> -->
    <h3>Billing Information</h3>
    <fieldset>
        <p class='title'><span>Create My Account</span></p>
        <div class="row">
            <div class="col col-md-6">
                <label class="required">Username:</label>
                <input name="account_username" type="text" id="account_username" maxlength="20" minlength="6" required>
                <p class="description">(min: 6 characters including 1 number)</p>
            </div>

            <div class="col col-md-6">
                <label class="required">Password:</label>
                <input name="account_password" type="password" id="account_password" maxlength="20" minlength="6" required>
                <p class="description">(min: 6 characters including 1 number)</p>
            </div>
            <div class="col col-md-12">
                <label class="required">Your Plan:</label>
                <select name="selectbusplan" id="selectbusplan" required>
                    <option value="" selected>Choose a plan!</option>
                    <?= $busplans; ?>
                </select>
            </div>

        </div>

        <p class='title'><span>Credit Card Information (Optional)</span></p>
        <div class="row">
            <div class="col col-md-12">
                <label>Name On Card:</label>
                <input name="creditcard_name" type="text" id="creditcard_name" size="20">
            </div>
            <div class="col col-md-12">
                <label>Card Number:</label>
                <input name="creditcard_number" type="text" size="20" maxlength="16">
            </div>
            <div class="col col-md-12">
                <label>Card Type:</label>
                <select name="creditcard_type">
                    <option value="" selected>Select Card Type</option>
                    <option>Visa</option>
                    <option>MasterCard</option>
                    <option>American Express</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-12">
                <label>Expiry Date:</label>
            </div>
            <div class="col col-md-6">

                <select name="creditcard_month">
                    <option>01</option>
                    <option>02</option>
                    <option>03</option>
                    <option>04</option>
                    <option>05</option>
                    <option>06</option>
                    <option>07</option>
                    <option>08</option>
                    <option>09</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                </select>
            </div>
            <div class="col col-md-6">
                <?php
                $yearExpires = "<select id='creditcard_year' name='creditcard_year'>";
                $selectyear = $currentyear = date("Y");
                while ($currentyear <= (date("Y") + 10)) {
                    $yearExpires .= "<option value='{$currentyear}'" . ($currentyear == $selectyear ? " selected='selected'" : "") . ">{$currentyear}</option>";
                    $currentyear++;
                }
                $yearExpires .= "</select>";
                echo $yearExpires;
                ?>
            </div>
        </div>
        <label>CCV No.:</label>
        <input name="creditcard_ccv" type="text" size="5" maxlength="4">
        <p class="description">(On signature panel for Visa/Mastercard, front of card for American Express)
        </p>
        <label>Prepaid Auto Topup Amount:</label>
        <select id="account_autotopup_amount" name="account_autotopup_amount">
            <option value="" selected> Select Prepaid Auto Topup Amount</option>
            <option value="20">$20</option>
            <option value="30">$30</option>
            <option value="40">$40</option>
            <option value="50">$50</option>
            <option value="75">$75</option>
            <option value="100">$100</option>
            <option value="250">$250</option>
            <option value="500">$500</option>
        </select>
    </fieldset>
    <!-- <h3>Finish</h3>
        <fieldset>
            <legend>Terms and Conditions</legend>

            <input id="acceptTerms-2" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
        </fieldset> -->
    <input type="hidden" name="form_submitted" value="1"><input style='display:none' type="submit" id="submit" name="signup_submitted" value="Process Application">
</form>
<div id="overlay" style="display: none;      overflow-y: scroll;   position: fixed;     left: 0px;     top: 0px;     width:100%;     height:100%;     text-align:center;     z-index: 1000; background: #072036c4;">
    <div id="signresult" style=" width:500px;     margin: 100px auto;     background-color: #fff;     border:1px solid #000;     padding:15px;     text-align:left;"></div>
</div>
</body>

</html>
<script>
    var form = $("#signlookup").show();

    form.steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        onStepChanging: function(event, currentIndex, newIndex) {
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex) {
                return true;
            }
            // // Forbid next action on "Warning" step if the user is to young
            // if (newIndex === 3 && Number($("#age-2").val()) < 18) {
            //     return false;
            // }
            // Needed in some cases if the user went back (clean up)
            if (currentIndex < newIndex) {
                // To remove error styles
                form.find(".body:eq(" + newIndex + ") label.error").remove();
                form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onStepChanged: function(event, currentIndex, priorIndex) {
            // Used to skip the "Warning" step if the user is old enough.
            // if (currentIndex === 2 && Number($("#age-2").val()) >= 18) {
            //     form.steps("next");
            // }
            // // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
            // if (currentIndex === 2 && priorIndex === 3) {
            //     form.steps("previous");
            // }
        },
        onFinishing: function(event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function(event, currentIndex) {
            $("#submit").trigger("click");
        }
    }).validate({
        errorPlacement: function errorPlacement(error, element) {
            element.after(error);
        },
        rules: {
            confirm: {
                equalTo: "#password-2"
            }
        }
    });
</script>