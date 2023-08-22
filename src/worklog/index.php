<?php
include '../../includes/init.php';

$path = $GLOBALS['_path'];
$_rid = 3;
$db = db();
checkSession();
$userData = $_SESSION['userData'];
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<?php
head(); ?>

<body>
  <main class="main" id="top">
    <?php menu() ?>

    <div class="content">

      <div style="margin-top: -20px;" class="col-12 col-xl-12 order-1 order-xl-0">
        <div class="mb-9">
          <div class="card shadow-none border border-300 my-4" data-component-card="data-component-card">
            <div class="card-header p-4 border-bottom border-300 bg-soft">
              <div class="row g-3 justify-content-between align-items-center">
                <div class="col-12 col-md">
                  <h4 class="text-900 mb-0">Students WorkLog</h4>
                </div>
              </div>
            </div>


            <div class="p-4 code-to-copy">
              <div id="tableExample3"
                data-list='{"valueNames":["id","userid","name","checkin","checkout","status"],"page":10,"pagination":true}'>

                <div class="d-flex align-items-center justify-content-end">
                  <div class="search-box mb-3 mx-auto">
                    <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                      <input class="form-control search-input search form-control-sm" type="search" placeholder="Search"
                        aria-label="Search" />
                      <span class="fas fa-search search-box-icon"></span>
                    </form>
                  </div>
                  <div class="card shadow-none border border-300 my-1" data-component-card="data-component-card">
                    <div class="card-body p-1">
                      <div><button class="btn btn-phoenix-success btn-sm" type="button" onclick="checkIn()"
                          id="checkIn">Check IN</button>
                        <a href="api/download.php"><button class="btn btn-phoenix-success btn-sm" type="button"
                            id="download" style="border-200">Download</button></a>
                      </div>
                    </div>
                  </div>


                </div>
                <div id="tableExample">
                  <div class="table-responsive mx-n1 px-1">
                    <table class="table table-sm border-top border-200 fs--1 mb-0">
                      <thead>
                        <tr>
                          <th class="white-space-nowrap fs--1 align-middle ps-0" style="max-width:20px; width:18px;">
                          </th>
                          <th class="sort align-middle ps-3" data-sort="id">S.No</th>
                          <th class="sort align-middle" data-sort="userid">User Id</th>
                          <th class="sort align-middle" data-sort="name">Name</th>
                          <th class="sort align-middle" data-sort="checkin">Check In</th>
                          <th class="sort align-middle" data-sort="checkout">Check Out</th>
                          <th class="sort align-middle" data-sort="status">Status</th>
                          <th class="sort text-end align-middle pe-0" scope="col">ACTION</th>
                        </tr>
                      </thead>
                      <tbody class="list" id="bulk-select-body">
                        <?php
                        if ($_SESSION['user_access']['all_worklog'] == '1') {
                          $checkSql = "SELECT w.*,u.name AS 'user_name',w.status AS 'work_status' FROM work_log w INNER JOIN m_user u ON u.user_id=w.user_id order by w.id desc";
                        } else {
                          $checkSql = "SELECT w.*,u.name AS 'user_name',w.status AS 'work_status' FROM work_log w INNER JOIN m_user u ON u.user_id=w.user_id  where w.user_id = '$userData[user_id]' order by w.id desc";
                        }
                        $checkResult = mysqli_query($db, $checkSql);
                        $i = 0;
                        while ($row = $checkResult->fetch_assoc()) {
                          $i++;
                          // echo json_encode($row);
                          echo " <tr>
                             <td class='fs--1 align-middle'>
                                 <div class='form-check mb-0 fs-0'><input class='form-check-input' type='checkbox'
                                         data-bulk-select-row='{&quot;name&quot;:&quot;Anna&quot;,&quot;email&quot;:&quot;anna@example.com&quot;,&quot;age&quot;:18}' />
                                 </div>
                             </td>
                             <td class='align-middle ps-3 id'>$i</td>
                             <td class='align-middle userid'>$row[user_id]</td>
                             <td class='align-middle name'>$row[user_name]</td>
                             <td class='align-middle checkin'>$row[check_in]</td>
                             <td class='align-middle checkout'>$row[check_out]</td>
                             <td class='align-middle status'>";
                          if ($row['status'] == '1') {
                            echo "<span class='badge badge-phoenix fs--2 badge-phoenix-success'>Approved</span>";
                          } else if ($row['status'] == '0') {
                            echo "<span class='badge badge-phoenix fs--2 badge-phoenix-warning'>Pending</span>";
                          } else if ($row['status'] == '3') {
                            echo "<span class='badge badge-phoenix fs--2 badge-phoenix-secondary'>Waiting for Checkout</span>";
                          } else {
                            echo "<span class='badge badge-phoenix fs--2 badge-phoenix-danger'>Rejected</span>";
                          }
                          echo "<td class='align-middle white-space-nowrap text-end pe-0'>";
                          if ($row['status'] == '3') {
                            echo "
                             
                             <button class='btn btn-phoenix-success btn-sm' type='button' onclick='checkOut($row[id])'
                             id='checkOut'>Check Out</button>";
                          }
                          echo "
                         <button class='btn btn-phoenix-success btn-sm' type='button' onclick='view($row[id])'
                             id='view'>View</button>
                             ";
                          echo "</td>
                             </tr>";
                        } ?>

                      </tbody>
                    </table>
                  </div>
                  <div class="d-flex flex-between-center pt-3 mb-3">
                    <div class="pagination d-none"></div>
                    <p class="mb-0 fs--1">
                      <span class="d-none d-sm-inline-block" data-list-info="data-list-info"></span>
                      <span class="d-none d-sm-inline-block"> &mdash; </span>
                      <a class="fw-semi-bold" href="#!" data-list-view="*">
                        View all
                        <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
                      </a><a class="fw-semi-bold d-none" href="#!" data-list-view="less">
                        View Less
                        <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
                      </a>
                    </p>
                    <div class="d-flex">
                      <button class="btn btn-sm btn-primary" type="button"
                        data-list-pagination="prev"><span>Previous</span></button>
                      <button class="btn btn-sm btn-primary px-4 ms-2" type="button"
                        data-list-pagination="next"><span>Next</span></button>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Student Worklog</h5><button class="btn p-1"
                          type="button" data-bs-dismiss="modal" aria-label="Close"><span
                            class="fas fa-times fs--1"></span></button>
                      </div>
                      <div class="modal-body">
                        <div class="col-12 gy-6">
                          <label class="form-label" for="basic-form-textarea">CheckOut Description</label>
                          <textarea class="form-control" id="description" rows="3" placeholder="Description"></textarea>
                        </div>
                        <div class="col-sm-6 col-md-12">
                          <div class="form-floating" style="margin-top:10px">
                            <select id="projectTitle" class="form-select" id="floatingSelectAssignees">
                              <option selected="selected" disabled>Select projectTitle </option>
                            </select><label for="floatingSelectAssignees">projectTitle </label>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer"><button class="btn btn-primary" type="button"
                          onclick="submit()">Submit</button><button class="btn btn-outline-primary" type="button"
                          data-bs-dismiss="modal">Cancel</button></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="projectsCardViewModal" tabindex="-1" aria-labelledby="projectsCardViewModal"
          aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content overflow-hidden">
              <div class="d-flex bg-200">
                <div class="p-2 flex-fill bg-200  border-400">
                  <div id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
                    <div id="map"></div>
                  </div>
                </div>

                <div class="p-2 flex-fill bg-200 border border-400">
                  <div id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
                    <div id="maps"></div>
                  </div>
                </div>
              </div>
              <div class="modal-body p-5 px-md-6">
                <div class="row g-12">
                  <div class="col-12 col-md-12">
                    <div class="mb-4">
                      <h1 id="name" class="me-3" style="font-size:15px;margin-bottom:10px">Name: POOVARASAN</h1>
                      <h1 id="rollno" class="me-3" style="font-size:15px;">Roll No:7376211CS239</h1 style="">
                    </div>
                    <div class="mb-6">
                      <div class="d-flex align-items-center mb-2">
                        <h4 class="me-3" style="font-size:15px">Project Title</h4><button
                          class="btn btn-link p-0"></button>
                      </div>
                      <p class="text-1000" id="viewTitle"></p>
                      <div class="d-flex align-items-center mb-2">
                        <h4 class="me-3" style="font-size:15px">Description</h4><button
                          class="btn btn-link p-0"></button>
                      </div>

                      <p class="text-1000" id="viewDescription"></p>
                      <h1 class="me-3" style="font-size:15px;margin-bottom:10px">Check IN Time:</h1>
                      <p id="checkin"></p>
                      <h1 class="me-3" style="font-size:15px">Check Out Time: </h1>
                      <p id="checkout"></p>
                      <h1 class="me-3" style="font-size:15px">Duration: </h1>
                      <p id="duration"></p>
                    </div>
                    <div class="modal-footer"><button class="btn btn-primary" type="button" id="approve"
                        onclick="approve('1')">Approve</button><button class="btn btn-outline-primary" type="button"
                        onclick="approve('2')" id="reject" data-bs-dismiss="modal">Reject</button></div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
        <div class="toast align-items-center text-white bg-dark border-0 light" id="icon-copied-toast" role="alert"
          aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <div class="toast-body p-3"></div><button class="btn-close btn-close-white me-2 m-auto" type="button"
              data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      </div>
      <?php footer(); ?>
    </div>

  </main>

  <?php script(); ?>
</body>

<script>
  var id = 0
  function checkIn() {
    $.ajax({
      url: 'api/checkIn.php',
      method: 'post',
      dataType: 'json',
      success: function (result) {
        window.location.reload()
      }, error: function (err) {
        console.log(err)
      }
    });
  }

  function checkOut(tempId) {
    $('#exampleModal').modal('show');
    id = tempId;
  }
  function view(tempId) {
    id = tempId
    $('#projectsCardViewModal').modal('show');
    $.ajax({
      url: 'api/viewDetails.php',
      method: 'post',
      dataType: 'json',
      data: {
        'id': tempId
      },
      success: function (result) {
        if (result.success) {
          let data = result.data
          $('#name').text("Name : " + data.name)
          $('#rollno').text("User ID : " + data.user_id)
          $('#viewDescription').text(data.checkout_description)
          $('#checkin').text(data.check_in)
          $('#checkout').text(data.check_out)
          $('#duration').text(data.duration + " Minutes")
          $('#viewTitle').text(data.title)
          if (data.work_status == '1') {
            $('#approve').hide();
            $('#reject').show();
          } else if (data.work_status == '2') {
            $('#approve').show();
            $('#reject').hide();
          }
          else {
            $('#approve').show();
            $('#reject').show();
          }
        }
      }, error: function (err) {
        console.log(err)
      }
    });
  }
  function submit() {
    console.log($('#description').val())
    $.ajax({
      url: 'api/checkOut.php',
      method: 'post',
      dataType: 'json',
      data: {
        'description': $('#description').val(),
        'id': id,
        'project_id': $('#projectTitle').val(),
      },
      success: function (result) {
        console.log(result)
        window.location.reload()
      }, error: function (err) {
        console.log(err)
      }
    });
  }
  function approve(state) {
    $.ajax({

      url: 'api/approve.php',
      method: 'post',
      dataType: 'json',
      data: {
        'id': id,
        'status': state,
      },

      success: function (result) {
        window.location.reload()
      }, error: function (err) {
        console.log(err)
      }
    });
  }
  getProjectid()
  function getProjectid() {
    $.ajax({
      url: 'api/getProjectid.php',
      method: 'post',
      dataType: 'json',
      success: function (result) {
        console.log(result)
        $('#projectTitle').empty()
        $('#projectTitle').append('<option selected="selected" disabled>Select Project Title </option>')
        result.data.forEach(element => {
          $('#projectTitle').append(
            `<option value="${element.project_id}">${element.title}</option>`
          )
        });
      }, error: function (err) {
        console.log(err)
      }
    });
  }

  $(document).ready(function () {
    $('#download').click(function () {
      $.ajax({
        url: 'api/download.php',
        method: 'POST',
        data: {
          download: true
        },
        success: function (data) {
          console.log(data)
        },
        error: function () {
          alert('Error occurred while downloading');
        }
      });
    });
  });



</script>

<script>
  (function () {
    var setting = { "width": "50%", "height": 200, "satellite": false, "zoom": 19, "lang": "en", "centerCoord": [11.494285, 77.277050], "id": "map", "embed_id": "9809" };
    var setting1 = { "width": "50%", "height": 200, "satellite": false, "zoom": 19, "lang": "en", "centerCoord": [11.494285, 77.277050], "id": "maps", "embed_id": "9809" };

    var d = document;
    var s = d.createElement('script');
    s.src = 'https://1map.com/js/script-for-user.js?embed_id=0969';
    s.async = true;
    s.onload = function (e) {
      window.OneMap.initMap(setting);
      window.OneMap.initMap(setting1);
    };
    var to = d.getElementsByTagName('script')[0];
    to.parentNode.insertBefore(s, to);
  })();

</script>
</html>