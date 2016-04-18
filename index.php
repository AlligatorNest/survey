<?php
require_once ("assets/includes/global.php");
require_once ("assets/database/MysqliDb.php");
require_once ("assets/database/dbconnect.php");



//get current userid
$prov_no= '100087629';
$msg = '';

//update record
if($_POST && isset($_POST['action']))

{
  $action = $_POST["action"];

  if ($action == 'update') {

    $accept ='';
    $handicapAccessible = '';

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $sex = $_POST["sex"];
    $address1 = $_POST["address1"];
    $address2 = $_POST["address2"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $lang01 = $_POST["lang01"];
    $lang02 = $_POST["lang02"];
    $lang03 = $_POST["lang03"];
    $lang04 = $_POST["lang04"];
    $hosp01 = $_POST["hosp01"];
    $hosp02 = $_POST["hosp02"];
    $hosp03 = $_POST["hosp03"];
    $hosp04 = $_POST["hosp04"];
    $phone_1 = $_POST["phone_1"];
    $phone_1_info = $_POST["phone_1_info"];
    $email = $_POST["email"];
    $website = $_POST["website"];
    $specfix = $_POST["specfix"];
    if (isset($_POST['accept'])) {$accept = $_POST["accept"];}
    if (isset($_POST['handicapAccessible'])) {$handicapAccessible = $_POST["handicapAccessible"];}

    $data = Array (
    'first_name' => $first_name,
    'last_name' => $last_name,
    'sex' => $sex,
    'address1' => $address1,
    'address2' => $address2,
    'city' => $city,
    'state' => $state,
    'zip' => $zip,
    'lang01' => $lang01,
    'lang02' => $lang02,
    'lang03' => $lang03,
    'lang04' => $lang04,
    'hosp01' => $hosp01,
    'hosp02' => $hosp02,
    'hosp03' => $hosp03,
    'hosp04' => $hosp04,
    'accept' => $accept,
    'phone_1' => $phone_1,
    'phone_1_info' => $phone_1_info,
    'email' => $email,
    'website' => $website,
    'specfix' => $specfix,
    'handicapAccessible' => $handicapAccessible,
    'moddate' => $db->now()
    );


    //update the record
    $db->where ('prov_no', $prov_no);
    if ($db->update ('tblproviderdata', $data))
        if ($db->count > 0) {
        $msg = 'Your Profile has been updated.';
      } else {
        $msg = 'Thank you for reviewing your profile.';
      }
    else
        $msg = 'update failed: ' . $db->getLastError();
  };
};

//get details for provider
$db->where ("prov_no", $prov_no);
$providerData = $db->getOne ("tblproviderdata");



//html page header and menu
require_once ("assets/includes/header.php");
?>


    <!-- Begin page content -->
    <div class="container">

      <div class="page-header">
        <h3>Current User: <?php echo $providerData['first_name'] . ' ' . $providerData['last_name']; ?></h3>
      </div>
      <p class="bg-success"><?php echo $msg ?></p>
      <p class="lead">Provider Details</p>
      <div class="container">


          <form method="post" class="form">
            <div class="form-group row">
              <label for="first_name" class="col-sm-2 form-control-label">First Name</label>
              <div class="col-sm-4">
                <input type="text" class="form-control input-sm" name="first_name" id="first_name" value="<?php echo $providerData['first_name']?>" placeholder="First Name">
                <input type="hidden" name="action" value="update">
              </div>

              <label for="last_name" class="col-sm-2 form-control-label">Last Name</label>
              <div class="col-sm-4">
                <input type="text" class="form-control input-sm" name="last_name" id="last_name" value="<?php echo $providerData['last_name']?>" placeholder="Last Name">
              </div>
            </div>

            <div class="form-group row">
              <label for="sex" class="col-sm-2 form-control-label">Gender</label>
              <div class="col-xs-4">
                <select class="form-control input-sm" name="sex" id="sex">
                  <option value="M" <?=$providerData['sex'] == 'M' ? ' selected="selected"' : '';?>>M</option>
                  <option value="F" <?=$providerData['sex'] == 'F' ? ' selected="selected"' : '';?>>F</option>
                </select>
              </div>

              <label for="sex" class="col-sm-2 form-control-label">Specialty</label>
              <div class="col-xs-4">
                <select class="form-control" name="specfix" id="specfix">
                  <option value="">Select</option>
                  <option value="Ophthalmic Plastic Reconstructive Surgery" <?=$providerData['specfix'] == 'Ophthalmic Plastic Reconstructive Surgery' ? ' selected="selected"' : '';?>>Ophthalmic Plastic Reconstructive Surgery</option>
                  <option value="Radiation Oncology" <?=$providerData['specfix'] == 'Radiation Oncology' ? ' selected="selected"' : '';?>>Radiation Oncology</option>
                  <option value="Dermatology" <?=$providerData['specfix'] == 'Dermatology' ? ' selected="selected"' : '';?>>Dermatology</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="address1" class="col-sm-2 form-control-label">Address</label>
              <div class="col-sm-4">
                <input type="text" class="form-control input-sm" name="address1" id="address1" value="<?php echo $providerData['address1']?>" placeholder="Address 1">
              </div>

              <label for="address2" class="col-sm-2 form-control-label">Address 2</label>
              <div class="col-sm-4">
                <input type="text" class="form-control input-sm" name="address2" id="address2" value="<?php echo $providerData['address1']?>" placeholder="Address 2">
              </div>
            </div>

            <div class="form-group row">
              <label for="city" class="col-sm-2 form-control-label">City</label>
              <div class="col-sm-2">
                <input type="text" class="form-control input-sm" name="city" id="city" value="<?php echo $providerData['city']?>" placeholder="City">
              </div>

              <label for="state" class="col-sm-2 form-control-label">State</label>
              <div class="col-sm-2">
                <select class="form-control input-sm" name="state" id="state">
                  <option>Select One</option>
                  <option value="LA" selected="true">Louisiana</option>
                </select>
              </div>

              <label for="zip" class="col-sm-2 form-control-label">Zip Code</label>
              <div class="col-sm-2">
                <input type="text" class="form-control input-sm" name="zip" id="zip" value="<?php echo $providerData['zip']?>" placeholder="Zip Code">
              </div>
            </div>

            <div class="form-group row">
              <label for="phone_1" class="col-sm-2 form-control-label">Phone 1:</label>
              <div class="col-sm-4">
                <input type="tel" class="form-control input-sm" name="phone_1" id="phone_1" value="<?php echo $providerData['phone_1']?>" placeholder="Primary Phone Number">
              </div>

              <label for="phone_1_info" class="col-sm-2 form-control-label">Type:</label>
              <div class="col-sm-4">
                <select class="form-control input-sm" name="phone_1_info" id="phone_1_info">
                  <option>Select One</option>
                  <option value="Office" <?=$providerData['phone_1_info'] == 'Office' ? ' selected="selected"' : '';?>>Office</option>
                  <option value="Cell" <?=$providerData['phone_1_info'] == 'Cell' ? ' selected="selected"' : '';?>>Cell</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-sm-2 form-control-label">Email:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control input-sm" name="email" id="email" value="<?php echo $providerData['email']?>" placeholder="Email Address">
              </div>
            </div>

            <div class="form-group row">
              <label for="website" class="col-sm-2 form-control-label">Web Site URL:</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <span class="input-group-addon">http://</span>
                  <input type="text" class="form-control input-sm" name="website" id="website" value="<?php echo $providerData['website']?>" placeholder="Web Site URL">
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2">Handicap Accessible</label>
              <div class="col-sm-2">
                <div class="radio">
                  <label>
                    <input type="radio" name="handicapAccessible" id="handicapAccessible1" value="Y" <?=$providerData['handicapAccessible'] == 'Y' ? 'checked' : '';?>>
                    Yes
                  </label>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="radio">
                  <label>
                    <input type="radio" name="handicapAccessible" id="handicapAccessible2" value="N" <?=$providerData['handicapAccessible'] == 'N' ? 'checked' : '';?>>
                    No
                  </label>
                </div>
              </div>

              <label class="col-sm-2">Welcoming New Patients</label>
              <div class="col-sm-2">
                <div class="radio">
                  <label>
                    <input type="radio" name="accept" id="accept1" value="Y" <?=$providerData['accept'] == 'Y' ? 'checked' : '';?>>
                    Yes
                  </label>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="radio">
                  <label>
                    <input type="radio" name="accept" id="accept2" value="N" <?=$providerData['accept'] == 'N' ? 'checked' : '';?>>
                    No
                  </label>
                </div>
              </div>

            </div>

            <!--Launguages-->
            <div class="form-group row">
              <label for="languages" class="col-sm-2 form-control-label">Languages:</label>
              <div class="col-sm-2">
                <div class="input-group">
                  <p class="help-block">Language 1</p>
                  <select class="form-control" name="lang01" id="lang01">
                    <option value="">Select</option>
                    <option value="EN" <?=$providerData['lang01'] == 'EN' ? ' selected="selected"' : '';?>>English</option>
                    <option value="SP" <?=$providerData['lang01'] == 'SP' ? ' selected="selected"' : '';?>>Spanish</option>
                    <option value="GR" <?=$providerData['lang01'] == 'GR' ? ' selected="selected"' : '';?>>German</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="input-group">
                  <p class="help-block">Language 2</p>
                  <select class="form-control" name="lang02" id="lang02">
                    <option value="">Select</option>
                    <option value="EN" <?=$providerData['lang02'] == 'EN' ? ' selected="selected"' : '';?>>English</option>
                    <option value="SP" <?=$providerData['lang02'] == 'SP' ? ' selected="selected"' : '';?>>Spanish</option>
                    <option value="GR" <?=$providerData['lang02'] == 'GR' ? ' selected="selected"' : '';?>>German</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="input-group">
                  <p class="help-block">Language 3</p>
                  <select class="form-control" name="lang03" id="lang03">
                    <option value="">Select</option>
                    <option value="EN" <?=$providerData['lang03'] == 'EN' ? ' selected="selected"' : '';?>>English</option>
                    <option value="SP" <?=$providerData['lang03'] == 'SP' ? ' selected="selected"' : '';?>>Spanish</option>
                    <option value="GR" <?=$providerData['lang03'] == 'GR' ? ' selected="selected"' : '';?>>German</option>

                  </select>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="input-group">
                  <p class="help-block">Language 4</p>
                  <select class="form-control" name="lang04" id="lang04">
                    <option value="">Select</option>
                    <option value="EN" <?=$providerData['lang04'] == 'EN' ? ' selected="selected"' : '';?>>English</option>
                    <option value="SP" <?=$providerData['lang04'] == 'SP' ? ' selected="selected"' : '';?>>Spanish</option>
                    <option value="GR" <?=$providerData['lang04'] == 'GR' ? ' selected="selected"' : '';?>>German</option>

                  </select>
                </div>
              </div>
            </div>

            <!--Hospitals-->
            <div class="form-group row">
              <label for="languages" class="col-sm-2 form-control-label">Hospital Affiliations:</label>
              <div class="col-sm-2">
                <div class="input-group">
                  <p class="help-block">Hospital 1</p>
                  <select class="form-control" name="hosp01" id="hosp01">
                    <option value="">Select</option>
                    <option value="OCHSNER BAPTIST MED CT" <?=$providerData['hosp01'] == 'OCHSNER BAPTIST MED CT' ? ' selected="selected"' : '';?>>OCHSNER BAPTIST MED CT</option>
                    <option value="CHILDRENS HOSPITAL" <?=$providerData['hosp01'] == 'CHILDRENS HOSPITAL' ? ' selected="selected"' : '';?>>CHILDRENS HOSPITAL</option>
                    <option value="EAST JEFFERSON HOSPITAL" <?=$providerData['hosp01'] == 'EAST JEFFERSON HOSPITAL' ? ' selected="selected"' : '';?>>EAST JEFFERSON HOSPITAL</option>
                    <option value="THIBODAUX REGIONAL" <?=$providerData['hosp01'] == 'THIBODAUX REGIONAL' ? ' selected="selected"' : '';?>>THIBODAUX REGIONAL</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="input-group">
                  <p class="help-block">Hospital 2</p>
                  <select class="form-control" name="hosp02" id="hosp02">
                    <option value="">Select</option>
                    <option value="OCHSNER BAPTIST MED CT" <?=$providerData['hosp02'] == 'OCHSNER BAPTIST MED CT' ? ' selected="selected"' : '';?>>OCHSNER BAPTIST MED CT</option>
                    <option value="CHILDRENS HOSPITAL" <?=$providerData['hosp02'] == 'CHILDRENS HOSPITAL' ? ' selected="selected"' : '';?>>CHILDRENS HOSPITAL</option>
                    <option value="EAST JEFFERSON HOSPITAL" <?=$providerData['hosp02'] == 'EAST JEFFERSON HOSPITAL' ? ' selected="selected"' : '';?>>EAST JEFFERSON HOSPITAL</option>
                    <option value="THIBODAUX REGIONAL" <?=$providerData['hosp02'] == 'THIBODAUX REGIONAL' ? ' selected="selected"' : '';?>>THIBODAUX REGIONAL</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="input-group">
                  <p class="help-block">Hospital 3</p>
                  <select class="form-control" name="hosp03" id="hosp03">
                    <option value="">Select</option>
                    <option value="OCHSNER BAPTIST MED CT" <?=$providerData['hosp03'] == 'OCHSNER BAPTIST MED CT' ? ' selected="selected"' : '';?>>OCHSNER BAPTIST MED CT</option>
                    <option value="CHILDRENS HOSPITAL" <?=$providerData['hosp03'] == 'CHILDRENS HOSPITAL' ? ' selected="selected"' : '';?>>CHILDRENS HOSPITAL</option>
                    <option value="EAST JEFFERSON HOSPITAL" <?=$providerData['hosp03'] == 'EAST JEFFERSON HOSPITAL' ? ' selected="selected"' : '';?>>EAST JEFFERSON HOSPITAL</option>
                    <option value="THIBODAUX REGIONAL" <?=$providerData['hosp03'] == 'THIBODAUX REGIONAL' ? ' selected="selected"' : '';?>>THIBODAUX REGIONAL</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="input-group">
                  <p class="help-block">Hospital 4</p>
                  <select class="form-control" name="hosp04" id="hosp04">
                    <option value="">Select</option>
                    <option value="OCHSNER BAPTIST MED CT" <?=$providerData['hosp04'] == 'OCHSNER BAPTIST MED CT' ? ' selected="selected"' : '';?>>OCHSNER BAPTIST MED CT</option>
                    <option value="CHILDRENS HOSPITAL" <?=$providerData['hosp04'] == 'CHILDRENS HOSPITAL' ? ' selected="selected"' : '';?>>CHILDRENS HOSPITAL</option>
                    <option value="EAST JEFFERSON HOSPITAL" <?=$providerData['hosp04'] == 'EAST JEFFERSON HOSPITAL' ? ' selected="selected"' : '';?>>EAST JEFFERSON HOSPITAL</option>
                    <option value="THIBODAUX REGIONAL" <?=$providerData['hosp04'] == 'THIBODAUX REGIONAL' ? ' selected="selected"' : '';?>>THIBODAUX REGIONAL</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Confirm</button>
              </div>
            </div>
          </form>
      </div>

    </div>


    <?php
    //html page footer
    require_once ("assets/includes/footer.php");
    ?>
