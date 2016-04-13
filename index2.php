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
    $lang01 = $_POST["lang01"];
    $lang02 = $_POST["lang02"];
    $lang03 = $_POST["lang03"];
    $lang04 = $_POST["lang04"];
    $newPatients = $_POST["newPatients"];
    $phone_1 = $_POST["phone_1"];
    $phone_1_info = $_POST["phone_1_info"];
    $email = $_POST["email"];
    $website = $_POST["website"];
    $handicapAccessible = $_POST["handicapAccessible"];


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
    'newPatients' => $newPatients,
    'phone_1' => $phone_1,
    'phone_1_info' => $phone_1_info,
    'email' => $email,
    'website' => $website,
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
            <!-- Group 1 -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                      <i class="icon-calendar"></i>
                      <h3 class="panel-title">Input Group 1</h3>
                    </div>

                    <div class="panel-body">
                      <div class="row">
                        <div class="col-lg-4 col-sm-4">
                          <div class="input-group">
                            <input type="hidden" name="action" value="update">
                            <label for="first_name" class="form-control-label">First Name</label>
                            <input type="text" class="form-control input-sm" name="first_name" id="first_name" value="<?php echo $providerData['first_name']?>" placeholder="First Name">
                          </div>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                          <div class="input-group">
                            <label for="last_name" class="form-control-label">Last Name</label>
                            <input type="text" class="form-control input-sm" name="last_name" id="last_name" value="<?php echo $providerData['last_name']?>" placeholder="Last Name">
                          </div>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                          <div class="input-group">
                            <label for="sex" class="form-control-label">Gender</label>
                              <select class="form-control input-sm" name="sex" id="sex">
                                <option value="M" <?=$providerData['sex'] == 'M' ? ' selected="selected"' : '';?>>M</option>
                                <option value="F" <?=$providerData['sex'] == 'F' ? ' selected="selected"' : '';?>>F</option>
                              </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Group 2 -->
              <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                      <div class="panel-heading clearfix">
                        <i class="icon-calendar"></i>
                        <h3 class="panel-title">Input Group 2</h3>
                      </div>

                      <div class="panel-body">
                        <div class="row">
                          <div class="col-lg-4 col-sm-4">
                            <div class="input-group">
                              <label for="address1" class="form-control-label">Address</label>
                              <input type="text" class="form-control input-sm" name="address1" id="address1" value="<?php echo $providerData['address1']?>" placeholder="Address 1">
                            </div>
                          </div>
                          <div class="col-lg-4 col-sm-4">
                            <div class="input-group">
                              <label for="address2" class="form-control-label">Address 2</label>
                              <input type="text" class="form-control input-sm" name="address2" id="address2" value="<?php echo $providerData['address1']?>" placeholder="Address 2">
                            </div>
                          </div>
                          <div class="col-lg-4 col-sm-4">
                            <div class="input-group">
                              <label for="city" class="form-control-label">City</label>
                              <input type="text" class="form-control input-sm" name="city" id="city" value="<?php echo $providerData['city']?>" placeholder="City">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-sm-6">
                            <div class="input-group">
                              <label for="address1" class="form-control-label">State</label>
                              <select class="form-control input-sm" name="state" id="state">
                                <option>Select One</option>
                                <option value="LA" selected="true">Louisiana</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-6 col-sm-6">
                            <div class="input-group">
                              <label for="address2" class="form-control-label">Zip Code</label>
                                <input type="text" class="form-control input-sm" name="zip" id="zip" value="<?php echo $providerData['zip']?>" placeholder="Zip Code">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Group 3 -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                          <i class="icon-calendar"></i>
                          <h3 class="panel-title">Input Group 3</h3>
                        </div>

                        <div class="panel-body">
                          <div class="row">
                            <div class="col-lg-6 col-sm-6">
                              <div class="input-group">
                                <label for="phone_1" class="form-control-label">Primary Phone</label>
                                <input type="tel" class="form-control input-sm" name="phone_1" id="phone_1" value="<?php echo $providerData['phone_1']?>" placeholder="Primary Phone Number">
                              </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                              <div class="input-group">
                                <label for="phone_1_info" class="form-control-label">Phone Type</label>
                                <select class="form-control input-sm" name="phone_1_info" id="phone_1_info">
                                  <option>Select One</option>
                                  <option value="Office" <?=$providerData['phone_1_info'] == 'Office' ? ' selected="selected"' : '';?>>Office</option>
                                  <option value="Cell" <?=$providerData['phone_1_info'] == 'Cell' ? ' selected="selected"' : '';?>>Cell</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6 col-sm-6">
                              <div class="input-group">
                                <label for="email" class="form-control-label">Email</label>
                                  <input type="email" class="form-control input-sm" name="email" id="email" value="<?php echo $providerData['email']?>" placeholder="Email Address">
                              </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                              <div class="input-group">
                                <label for="website" class="form-control-label">Web Site</label>
                                
                                <input type="text" class="form-control input-sm" name="website" id="website" value="<?php echo $providerData['website']?>" placeholder="Web Site URL">
                              </div>
                            </div>
                          </div>
                        </div>
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
                    <input type="radio" name="newPatients" id="newPatients1" value="Y" <?=$providerData['newPatients'] == 'Y' ? 'checked' : '';?>>
                    Yes
                  </label>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="radio">
                  <label>
                    <input type="radio" name="newPatients" id="newPatients2" value="N" <?=$providerData['newPatients'] == 'N' ? 'checked' : '';?>>
                    No
                  </label>
                </div>
              </div>

            </div>

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
