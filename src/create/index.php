<?php
include '../../includes/init.php';
$path = $GLOBALS['_path'];
$_rid = 2;
checkSession();
$db = db()
  ?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php
head(); ?>
<style>

</style>

<body>

  <body>

    <main class="main" id="top">
      <?php menu() ?>

      <div class="content">

        <h2 class="mb-4">Create a project</h2>
        <div class="row">
          <div class="col-xl-9">
            <div class="row g-3 mb-6">
              <div class="col-sm-6 col-md-12">

                <div id="alert-container" class="animated-alert"></div>

                <div class="form-floating"><input class="form-control" id="projectTitle" type="text"
                    placeholder="Project title" /><label for="projectTitle">Project title</label></div>
              </div>
              <div class="col-12 gy-6">
                <div class="form-floating"><textarea class="form-control" id="projectDes"
                    placeholder="Leave a comment here" style="height: 100px"></textarea><label for="projectDes">project
                    description</label></div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="flatpickr-input-container">
                  <div class="form-floating"><input class="form-control datetimepicker" id="startdate" type="text"
                      placeholder="end date" data-options='{"disableMobile":true}' /><label class="ps-1"
                      for="startdate">Start date</label><span
                      class="uil uil-calendar-alt flatpickr-icon text-700"></span></div>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="flatpickr-input-container">
                  <div class="form-floating"><input class="form-control datetimepicker" id="enddate" type="text"
                      placeholder="deadline" data-options='{"disableMobile":true}' /><label class="ps-1"
                      for="enddate">End Date</label><span class="uil uil-calendar-alt flatpickr-icon text-700"></span>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-md-6">
                <div class="form-floating">
                  <select id="inchargeUser" class="form-select" id="floatingSelectAssignees">
                    <option selected="selected" disabled>Select Incharge </option>
                  </select><label for="floatingSelectAssignees">Incharge </label>
                </div>
              </div>
              <div class="col-sm-6 col-md-12">
                <label for="organizerMultiple">Students</label><select class="form-select" id="selectUsers"
                  data-choices="data-choices" multiple="multiple"
                  data-options='{"removeItemButton":true,"placeholder":true}'>
                  <option value="">Select Students...</option>
                  <?php

                  $checkSql = "SELECT user_id, name FROM m_user WHERE STATUS='1'";
                  $checkResult = mysqli_query($db, $checkSql);
                  while ($row = $checkResult->fetch_assoc()) {
                    echo "<option value=$row[user_id]>$row[name]</option>";
                  }

                  ?>
                </select>
              </div>

              <div class="col-12 gy-6">
                <div class="row g-3 justify-content-end">
                  <div class="col-auto"><button class="btn btn-phoenix-primary px-5" onclick="cancel()">Cancel</button>
                  </div>
                  <div class="col-auto"><button onclick="createProject()" id="create"
                      class="btn btn-primary px-5 px-sm-15">Create
                      Project</button></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>

    <?php script() ?>

  </body>
  <script>
    function cancel() {
      window.location.replace("../../src/ourproject/index.php");
    }
    getdata()
    function getdata() {
      $.ajax({
        url: 'api/getData.php',
        method: 'post',
        dataType: 'json',
        success: function (result) {
          console.log(result)
          $('#inchargeUser').empty()
          $('#inchargeUser').append('<option selected="selected" disabled>Select Incharge </option>')
          result.data.forEach(element => {
            $('#inchargeUser').append(
              `<option value="${element.user_id}">${element.name}</option>`
            )
          });
        }, error: function (err) {
          console.log(err)
        }
      });
    }
    function createProject() {
      if ($('#projectTitle').val() == '' || $('#projectDes').val() == '' || $('#startdate').val() == '' || $('#enddate').val() == '' || $('#incharge').val() == '') {
        var alertContainer = $('#alert-container');
        alertContainer.html("Please fill in all the required fields before creating a project.");
        alertContainer.addClass("animated-alert");
        setTimeout(function () {
          alertContainer.removeClass("animated-alert");
          alertContainer.html("");
        }, 5000);
      }
      else {
        $.ajax({
          url: 'api/newProject.php',
          method: 'post',
          dataType: 'json',
          data: {
            'title': $('#projectTitle').val(),
            'description': $('#projectDes').val(),
            'startDate': $('#startdate').val(),
            'endDate': $('#enddate').val(),
            'incharge': $('#inchargeUser').val()
          },
          success: function (result) {
            if (result.success) {
              window.location.href = '../ourproject'
            }
          }, error: function (err) {
            console.log(err)
          }
        });
      }
    }

  </script>

</html>