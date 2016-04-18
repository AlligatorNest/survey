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
    'accept' => $accept,
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

      <div class="container">
        <div class="form-group row">
          <div class="col-sm-12">
            <p class="bg-info"><?php echo $msg ?></p>
          </div>
        </div>

          <form method="post" class="form">
            <!-- Group 1 -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="panel panel-primary">
                    <div class="panel-heading clearfix">

                      <a data-toggle="collapse" href="#providerInfo"><button id="btnProvider" class="btn btn-default pull-right">
                        <span class="glyphicon glyphicon-collapse-down"></span>Close</button>
                      </a>
                      <h3 class="panel-title">Provider Name</h3>
                    </div>
                    <div id="providerInfo" class="panel-collapse collapse in">
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
              </div>

              <!-- Group 2 -->
              <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                      <div class="panel-heading clearfix">
                        <a data-toggle="collapse" href="#addressInfo"><button id="btnAddress" class="btn btn-default pull-right">
                          <span class="glyphicon glyphicon-collapse-down"></span>Close</button>
                        </a>
                        <h3 class="panel-title">Address</h3>
                      </div>
                      <div id="addressInfo" class="panel-collapse collapse in">
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
                            <div class="col-lg-4 col-sm-4">
                              <div class="input-group">
                                <label for="address1" class="form-control-label">State</label>
                                <select class="form-control input-sm" name="state" id="state">
                                  <option>Select One</option>
                                  <option value="LA" selected="true">Louisiana</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-4 col-sm-4">
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
                </div>

                <!-- Group 3 -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="panel panel-primary">
                        <div class="panel-heading clearfix">
                          <a data-toggle="collapse" href="#contactInfo"><button id="btnContact" class="btn btn-default pull-right">
                            <span class="glyphicon glyphicon-collapse-down"></span>Close</button>
                          </a>
                          <h3 class="panel-title">Contact</h3>
                        </div>
                        <div id="contactInfo" class="panel-collapse collapse in">
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
                  </div>

            <!--Group 4-->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="panel panel-primary">
                    <div class="panel-heading clearfix">
                      <a data-toggle="collapse" href="#accessibilityInfo"><button id="btnAccessibility" class="btn btn-default pull-right">
                        <span class="glyphicon glyphicon-collapse-down"></span>Close</button>
                      </a>
                      <h3 class="panel-title">Accessibility</h3>
                    </div>
                    <div id="accessibilityInfo" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-lg-6 col-sm-6">
                            <div class="input-group">
                              <label for="handicapAccessible" class="form-control-label">Handicap Accessible</label><br>
                              <input type="radio" name="handicapAccessible" id="handicapAccessible1" value="Y" <?=$providerData['handicapAccessible'] == 'Y' ? 'checked' : '';?>>Yes
                              <input type="radio" name="handicapAccessible" id="handicapAccessible2" value="N" <?=$providerData['handicapAccessible'] == 'N' ? 'checked' : '';?>>No
                            </div>
                          </div>
                          <div class="col-lg-6 col-sm-6">
                            <div class="input-group">
                              <label for="handicapAccessible" class="form-control-label">Welcoming New Patients</label><br>
                              <input type="radio" name="accept" id="accept1" value="Y" <?=$providerData['accept'] == 'Y' ? 'checked' : '';?>>Yes
                              <input type="radio" name="accept" id="accept2" value="N" <?=$providerData['accept'] == 'N' ? 'checked' : '';?>>No
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Group 5 -->
              <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                      <div class="panel-heading clearfix">
                        <a data-toggle="collapse" href="#languageInfo"><button id="btnLanguage" class="btn btn-default pull-right">
                          <span class="glyphicon glyphicon-collapse-down"></span>Close</button>
                        </a>
                        <h3 class="panel-title">Languages</h3>
                      </div>
                      <div id="languageInfo" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-lg-3 col-sm-3">
                              <div class="input-group">
                                <input type="hidden" name="action" value="update">
                                <label for="lang01" class="form-control-label">Language 1</label>
                                <select class="form-control" name="lang01" id="lang01">
                                  <option value="">Select</option>
                                  <option value="EN" <?=$providerData['lang01'] == 'EN' ? ' selected="selected"' : '';?>>English</option>
                                  <option value="SP" <?=$providerData['lang01'] == 'SP' ? ' selected="selected"' : '';?>>Spanish</option>
                                  <option value="GR" <?=$providerData['lang01'] == 'GR' ? ' selected="selected"' : '';?>>German</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-3 col-sm-3">
                              <div class="input-group">
                                <label for="lang02" class="form-control-label">Language 2</label>
                                <select class="form-control" name="lang02" id="lang02">
                                  <option value="">Select</option>
                                  <option value="EN" <?=$providerData['lang02'] == 'EN' ? ' selected="selected"' : '';?>>English</option>
                                  <option value="SP" <?=$providerData['lang02'] == 'SP' ? ' selected="selected"' : '';?>>Spanish</option>
                                  <option value="GR" <?=$providerData['lang02'] == 'GR' ? ' selected="selected"' : '';?>>German</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-3 col-sm-3">
                              <div class="input-group">
                                <label for="lang03" class="form-control-label">Language 3</label>
                                <select class="form-control" name="lang03" id="lang03">
                                  <option value="">Select</option>
                                  <option value="EN" <?=$providerData['lang03'] == 'EN' ? ' selected="selected"' : '';?>>English</option>
                                  <option value="SP" <?=$providerData['lang03'] == 'SP' ? ' selected="selected"' : '';?>>Spanish</option>
                                  <option value="GR" <?=$providerData['lang03'] == 'GR' ? ' selected="selected"' : '';?>>German</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-3 col-sm-3">
                              <div class="input-group">
                                <label for="lang04" class="form-control-label">Language 4</label>
                                <select class="form-control" name="lang04" id="lang04">
                                  <option value="">Select</option>
                                  <option value="EN" <?=$providerData['lang04'] == 'EN' ? ' selected="selected"' : '';?>>English</option>
                                  <option value="SP" <?=$providerData['lang04'] == 'SP' ? ' selected="selected"' : '';?>>Spanish</option>
                                  <option value="GR" <?=$providerData['lang04'] == 'GR' ? ' selected="selected"' : '';?>>German</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

            <div class="form-group row">
              <div class="col-sm-10">
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

<script>
$(document).ready(function(){
  $("#providerInfo").on("hide.bs.collapse", function(){
    $("#btnProvider").html('<span class="glyphicon glyphicon-collapse-down"></span> Open');
  });
  $("#providerInfo").on("show.bs.collapse", function(){
    $("#btnProvider").html('<span class="glyphicon glyphicon-collapse-up"></span> Close');
  });

  $("#addressInfo").on("hide.bs.collapse", function(){
    $("#btnAddress").html('<span class="glyphicon glyphicon-collapse-down"></span> Open');
  });
  $("#addressInfo").on("show.bs.collapse", function(){
    $("#btnAddress").html('<span class="glyphicon glyphicon-collapse-up"></span> Close');
  });

  $("#contactInfo").on("hide.bs.collapse", function(){
    $("#btnContact").html('<span class="glyphicon glyphicon-collapse-down"></span> Open');
  });
  $("#contactInfo").on("show.bs.collapse", function(){
    $("#btnContact").html('<span class="glyphicon glyphicon-collapse-up"></span> Close');
  });

  $("#accessibilityInfo").on("hide.bs.collapse", function(){
    $("#btnAccessibility").html('<span class="glyphicon glyphicon-collapse-down"></span> Open');
  });
  $("#accessibilityInfo").on("show.bs.collapse", function(){
    $("#btnAccessibility").html('<span class="glyphicon glyphicon-collapse-up"></span> Close');
  });

  $("#languageInfo").on("hide.bs.collapse", function(){
    $("#btnLanguage").html('<span class="glyphicon glyphicon-collapse-down"></span> Open');
  });
  $("#languageInfo").on("show.bs.collapse", function(){
    $("#btnLanguage").html('<span class="glyphicon glyphicon-collapse-up"></span> Close');
  });

});
</script>
