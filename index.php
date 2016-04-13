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

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $sex = $_POST["sex"];
    $address1 = $_POST["address1"];
    $address2 = $_POST["address2"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $phone_1 = $_POST["phone_1"];
    $phone_1_info = $_POST["phone_1_info"];
    $email = $_POST["email"];
    $website = $_POST["website"];
    $handicapAccessible = $_POST["handicapAccessible"];


    //get selected languages
    $langAry = array();
    if (isset($_POST['lang'])) {

      $lang=$_POST["lang"];
      $i = 1;

      if ($lang)
      {
          foreach ($lang as $value)
          {
              $langAry['lang0'.$i] = $value;
              $i++;
          };
      };
    };


    $data = Array (
    'first_name' => $first_name,
    'last_name' => $last_name,
    'sex' => $sex,
    'address1' => $address1,
    'address2' => $address2,
    'city' => $city,
    'state' => $state,
    'zip' => $zip,
    'phone_1' => $phone_1,
    'phone_1_info' => $phone_1_info,
    'email' => $email,
    'website' => $website,
    'handicapAccessible' => $handicapAccessible
    );

    //add selected languages to insert array
    foreach ($langAry as $k => $v) {
        $data[$k] = $v;
    }


    //update the record
    $db->where ('prov_no', $prov_no);
    if ($db->update ('tblproviderdata', $data))
        $msg =  $db->count . ' records were updated';
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
              <div class="col-xs-2">
                <select class="form-control input-sm" name="sex" id="sex">
                  <option value="M" <?=$providerData['sex'] == 'M' ? ' selected="selected"' : '';?>>M</option>
                  <option value="F" <?=$providerData['sex'] == 'F' ? ' selected="selected"' : '';?>>F</option>
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
            </div>

            <div class="form-group row">
              <label for="languages" class="col-sm-2 form-control-label">Languages:</label>
              <div class="col-sm-4">
                <div class="input-group">
                  <select multiple class="form-control" name="lang[]" id="lang[]">
                    <option value="EN">English</option>
                    <option value="SP">Spanish</option>
                    <option value="GR">German</option>
                  </select>
                  <p class="help-block">Hold down CTRL Key to select multiple.</p>
                </div>
              </div>

              <div class="col-sm-2">
                    <label for="selected_languages" class="col-sm-2 form-control-label">Selected Languages:</label>
              </div>
              <div class="col-sm-4">
                    <?php
                    $x = 1;
                    $str = '';

                    while($x <= 9) {
                      if (!empty($providerData['lang' . '0' . $x])){
                        $str .= $providerData['lang' . '0' . $x] . '<br>';
                      }
                      $x++;
                    }
                    echo $str;
                    ?>
              </div>

            </div>

            <div class="form-group row">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-secondary">Confirm</button>
              </div>
            </div>
          </form>
      </div>

    </div>


    <?php
    //html page footer
    require_once ("assets/includes/footer.php");
    ?>
