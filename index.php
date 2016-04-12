<?php
require_once ("assets/includes/global.php");
require_once ("assets/database/MysqliDb.php");
require_once ("assets/database/dbconnect.php");



//get current userid
$userid = 1;

//get current username
$db->where ("userId", $userid);
$user = $db->getOne ("tblusers");
$username = $user['username'];

//get categries for userid
$params = Array($userid);
$q = "(
SELECT c.category
FROM tblusers u
INNER JOIN tblusercategoryxref ucX ON u.userId = ucx.userId
INNER JOIN tblcategory c ON ucx.categoryId = c.categoryId
WHERE u.userId = ?
)";
$categories = $db->rawQuery ($q, $params);

// get available documents for this userid BY CATEGORY
$params = Array($userid,$userid);
$q = "(
SELECT DISTINCT d.documentName,d.documentId
FROM tblusers u
INNER JOIN tblusercategoryxref ucX ON u.userId = ucx.userId
INNER JOIN tblcategory c ON ucx.categoryId = c.categoryId
INNER JOIN tbldocumentcategoryxref dcx on c.categoryId = dcx.categoryId
INNER JOIN tbldocument d on dcx.documentId = d.documentId
WHERE d.documentId not in (SELECT documentid from tbldocumentuseraccess where userID = ?) AND
u.userId = ?
)";
$documents = $db->rawQuery ($q, $params);
$downloadCount = $db->count;

// get available documents for this userid BY USERID
// these are documents assigned to particular user
$params = Array($userid,$userid);
$q = "(
SELECT DISTINCT d.documentName,d.documentId
FROM tblusers u
INNER JOIN tbldocumentuserxref dux on u.userId = dux.userId
INNER JOIN tbldocument d on dux.documentId = d.documentId
WHERE d.documentId not in (SELECT documentid from tbldocumentuseraccess where userID = ?) AND
u.userId = ?
)";
$userdocuments = $db->rawQuery ($q, $params);

$downloadCount += $db->count;

if ($downloadCount > 0) {
  $msg = "You have " . $downloadCount . " new documents available for download!";
} else {
  $msg = "You have no new documents available for download";
};

//html page header and menu
require_once ("assets/includes/header.php");
?>


    <!-- Begin page content -->
    <div class="container">

      <div class="page-header">
        <h1>Current User: <?php echo $username ?></h1>

        <p><strong>Categories</strong>:
        <?php
        $str = '';
        foreach ($categories as $category) {
            $str.= $category['category'] .',';
        }
        $str = rtrim($str, ',');
        echo $str;
         ?>
       </p>

      </div>

      <p class="lead"><?php echo $msg?></p>
      <p>Documents Specific to these Categories:</p>
      <hr>
      <div class="container">
      <?php
      foreach ($documents as $document){
        echo '<div class="row">';
        echo '<div class="col-xs-4">' .$document['documentName'] . '</div><div class="col-xs-8">' . '<input id="' . $document['documentId'] . ',' . $userid . '" type="button" name="download" value="Download"> </div>';
        echo '</div>';
      }
      ?>
      </div>

      <hr>
      <p>Documents Specific to this User:</p>
      <hr>
      <div class="container">
      <?php
      foreach ($userdocuments as $userdocument){
        echo '<div class="row">';
        echo '<div class="col-xs-4">' .$userdocument['documentName'] . '</div><div class="col-xs-8">' . '<input id="' . $userdocument['documentId'] . ',' . $userid . '" type="button" name="download" value="Download"> </div>';
        echo '</div>';
      }
      ?>
      </div>

    </div>


    <?php
    //html page footer
    require_once ("assets/includes/footer.php");
    ?>

    <!-- Script to capture document downloaded. -->
    <script>
    $(document).ready(function() {
        $('[name="download"]').click(function() {

            //get documentid and user id (documentId,userId)
            var $strId = this.id;
            //split on comma
            var $ary = $strId.split(',');

            var $documentId = $ary[0];
            var $userId = $ary[1];

            //ajax post to script to record download
            var request = $.ajax({
              url: "process.php",
              type: "POST",
              data: {action: "download", userId : $userId, documentId : $documentId},
              dataType: "html",
              success: function(data) {
                  //alert(data);
                  location.reload();
              }
            });


        });
    });
    </script>
