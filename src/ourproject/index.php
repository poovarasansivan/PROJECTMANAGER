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

<body>
  <main class="main" id="top">

    <?php menu() ?>

    <div class="content">

      <div class="row gx-6 gy-3 mb-4 align-items-center">
        <div class="col-auto">
          <h2 class="mb-0">Projects</h2>
        </div>
        <div class="col-auto"><a class="btn btn-primary px-5" href="../create/index.php"><i
              class="fa-solid fa-plus me-2"></i>Add new project</a></div>

      </div>
      <div class="row justify-content-between align-items-end mb-4 g-3">

        <div class="col-12 col-sm-auto">
          <div class="d-flex align-items-center">
            <div class="search-box me-3">
              <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input
                  class="form-control search-input search" type="search" placeholder="Search projects"
                  aria-label="Search" />
                <span class="fas fa-search search-box-icon"></span>
              </form>

            </div>
          </div>
        </div>
        <div class='row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xxl-4 g-3 mb-9'>

          <?php

          $checkSql = "SELECT p.*, u.name FROM m_projects p INNER JOIN m_user u ON p.incharge = u.user_id;";
          $checkResult = mysqli_query($db, $checkSql);
          while ($row = $checkResult->fetch_assoc()) {
            echo "
              <div class='col'>
            <div class='card h-100 hover-actions-trigger'>
              <div class='card-body'>
                 <div class='d-flex align-items-center'>
                    <h4 class='mb-2 line-clamp-1 lh-sm flex-1 me-5' hred>$row[title]</h4>
                    <div class='hover-actions top-0 end-0 mt-4 me-4'>
                    <a href='details.php?id=$row[id]' class='btn btn-primary btn-icon flex-shrink-0'>
                      <span class='fa-solid fa-chevron-right'></span>
                    </a>
                  </div>
                 </div>
                 <span class='badge badge-phoenix fs--2 mb-4 badge-phoenix-success'>completed</span>
                 <div class='d-flex align-items-center mb-2'>
                    <span class='fa-solid fa-user me-2 text-700 fs--1 fw-extra-bold'></span>
                    <p class='fw-bold mb-0 text-truncate lh-1'>Incharge : <span
                       class='fw-semi-bold text-primary ms-1'>$row[name]</span></p>
                 </div>
                 <div class='d-flex justify-content-between text-700 fw-semi-bold'>
                    <p class='mb-2'> Progress</p>
                    <p class='mb-2 text-1100'>100%</p>
                 </div>
                 <div class='progress bg-success-100'>
                    <div class='progress-bar rounded bg-success' role='progressbar' aria-label='Success example' style='width: 100%'
                       aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>
                 </div>
                 <div class='d-flex align-items-center mt-4'>
                    <p class='mb-0 fw-bold fs--1'>Started :<span class='fw-semi-bold text-600 ms-1'>$row[start_date]</span></p>
                 </div>
                 <div class='d-flex align-items-center mt-2'>
                    <p class='mb-0 fw-bold fs--1'>Deadline : <span class='fw-semi-bold text-600 ms-1'>$row[end_date]</span></p>
                 </div>
              </div>
            </div>
            </div>";
          } ?>
        </div>
        <?php footer(); ?>
      </div>
      <?php script() ?>
</body>

</html>