<?php
require_once ("assets/includes/global.php");
require_once ("assets/database/MysqliDb.php");
require_once ("assets/database/dbconnect.php");



//get current userid
$prov_no= '100087629';

//get current username
/*
$db->where ("userId", $userid);
$user = $db->getOne ("tblusers");
$username = $user['username'];
*/

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

      <p class="lead">Provider Details</p>
      <div class="container">


          <form class="form">
            <div class="form-group row">
              <label for="first_name" class="col-sm-2 form-control-label">First Name</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $providerData['first_name']?>" placeholder="First Name">
              </div>

              <label for="last_name" class="col-sm-2 form-control-label">Last Name</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $providerData['last_name']?>" placeholder="Last Name">
              </div>
            </div>

            <div class="form-group row">
              <label for="sex" class="col-sm-2 form-control-label">Gender</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="sex" id="sex" value="<?php echo $providerData['sex']?>" placeholder="Gender">
              </div>
            </div>

            <div class="form-group row">
              <label for="address1" class="col-sm-2 form-control-label">Address</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="address1" id="address1" value="<?php echo $providerData['address1']?>" placeholder="Address 1">
              </div>

              <label for="address2" class="col-sm-2 form-control-label">Address 2</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="address2" id="address2" value="<?php echo $providerData['address1']?>" placeholder="Address 2">
              </div>
            </div>

            <div class="form-group row">
              <label for="city" class="col-sm-2 form-control-label">City</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="city" id="city" value="<?php echo $providerData['city']?>" placeholder="City">
              </div>

              <label for="state" class="col-sm-2 form-control-label">State</label>
              <div class="col-sm-2">
                <select class="form-control" name="state" id="state">
                  <option>Select One</option>
                  <option value="LA" selected="true">Louisiana</option>
                </select>
              </div>

              <label for="zip" class="col-sm-2 form-control-label">Zip Code</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="zip" id="zip" value="<?php echo $providerData['zip']?>" placeholder="Zip Code">
              </div>
            </div>

            <div class="form-group row">
              <label for="phone_1" class="col-sm-2 form-control-label">Phone 1:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="phone_1" id="phone_1" value="<?php echo $providerData['zip']?>" placeholder="Primary Phone Number">
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-sm-2 form-control-label">Email:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $providerData['email']?>" placeholder="Email Address">
              </div>
            </div>

            <div class="form-group row">
              <label for="website" class="col-sm-2 form-control-label">Web Site URL:</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <span class="input-group-addon">http://</span>
                  <input type="text" class="form-control" name="website" id="website" value="<?php echo $providerData['website']?>" placeholder="Web Site URL">
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2">Handicap Accessible</label>
              <div class="col-sm-10">
                <div class="radio">
                  <label>
                    <input type="radio" name="handicapAccessible" id="handicapAccessible1" value="Y" checked>
                    Yes
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="handicapAccessible" id="handicapAccessible2" value="N">
                    No
                  </label>
                </div>
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
