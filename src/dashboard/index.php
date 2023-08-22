<?php
include '../../includes/init.php';
$path = $GLOBALS['_path'];
$_rid = 1;
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
      <div class="row gy-3 mb-6 justify-content-between">
        <div class="col-md-9 col-auto">
          <h2 class="mb-2 text-1100">Projects Dashboard</h2>
          <h5 class="text-700 fw-semi-bold">Here’s what’s going on at your business right now</h5>
        </div>

      </div>
      <div class="row mb-3 gy-6">
        <div class="col-12 col-xxl-2">
          <div class="row align-items-center g-3 g-xxl-0 h-100 align-content-between">
            <div class="col-12 col-sm-6 col-md-3 col-lg-6 col-xl-3 col-xxl-12">
              <div class="d-flex align-items-center"><span class="fs-4 lh-1 uil uil-books text-primary-500"></span>
                <div class="ms-2">
                  <?php
                  $query = "SELECT COUNT(title) AS project_count FROM m_projects WHERE title IS NOT NULL";
                  $result = mysqli_query($db, $query);

                  if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $projectCount = $row['project_count'];
                  }
                  ?>
                  <div class="d-flex align-items-end">
                    <h2 class="mb-0 me-2" id="projectCount">
                      <?php echo $projectCount; ?>
                    </h2>
                    <span class="fs-1 fw-semi-bold text-900">Projects</span>
                  </div>

                  <p class="text-800 fs--1 mb-0">Total projects</p>
                </div>
              </div>

            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-6 col-xl-3 col-xxl-12">
              <div class="d-flex align-items-center"><span class="fs-4 lh-1 uil uil-users-alt text-success-500"></span>
                <div class="ms-2">
                  <?php
                  $query = "SELECT COUNT(user_id) FROM m_user WHERE user_id IS NOT NULL AND STATUS='1'";
                  $result = mysqli_query($db, $query);

                  if ($result) {
                    $row = mysqli_fetch_array($result);
                    $userCount = $row[0];
                  }
                  ?>
                  <div class="d-flex align-items-end">
                    <h2 class="mb-0 me-2">
                      <?php echo $userCount; ?>
                    </h2><span class="fs-1 fw-semi-bold text-900">Members</span>
                  </div>
                  <p class="text-800 fs--1 mb-0">Working hard</p>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-6 col-xl-3 col-xxl-12">
              <div class="d-flex align-items-center"><span class="fs-4 lh-1 uil uil-invoice text-warning-500"></span>
                <div class="ms-2">
                  <div class="d-flex align-items-end">
                    <?php
                    $query = "SELECT COUNT(title) AS project_count FROM m_projects WHERE title IS NOT NULL AND STATUS = '1'";
                    $result = mysqli_query($db, $query);

                    if ($result) {
                      $row = mysqli_fetch_assoc($result);
                      $projectCount = $row['project_count'];
                    }
                    ?>
                    <h2 class="mb-0 me-2" id="projectCount">
                      <?php echo $projectCount; ?>
                    </h2><span class="fs-1 fw-semi-bold text-900">Projects</span>
                  </div>
                  <p class="text-800 fs--1 mb-0">So far completed</p>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-6 col-xl-3 col-xxl-12">
              <div class="d-flex align-items-center"><span class="fs-4 lh-1 uil uil-refresh text-danger-500"></span>
                <div class="ms-2">
                  <div class="d-flex align-items-end">
                    <?php
                    $query = "SELECT COUNT(title) AS project_count FROM m_projects WHERE title IS NOT NULL AND STATUS = '2'";
                    $result = mysqli_query($db, $query);

                    if ($result) {
                      $row = mysqli_fetch_assoc($result);
                      $projectCount = $row['project_count'];
                    }
                    ?>
                    <h2 class="mb-0 me-2" id="projectCount">
                      <?php echo $projectCount; ?>
                    </h2><span class="fs-1 fw-semi-bold text-900">On going</span>
                  </div>
                  <p class="text-800 fs--1 mb-0">Fresh start</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-6 col-xxl-5">
          <div class="mx-xxl-0">
            <h3>Monthly Working Hours</h3>
            <p class="text-700"></p>
            <div class="monthly-work-duration" style="min-height:300px"></div>

          </div>
        </div>
        <div class="col-12 col-xl-6 col-xxl-5">
          <div class="card border border-300 h-100 w-100 overflow-hidden">
            <div class="bg-holder d-block bg-card"
              style="background-image:url(<?php echo $path ?>/assets/img/spot-illustrations/32.png);background-position: top right;">
            </div>
            <!--/.bg-holder-->
            <div class="d-dark-none">
              <div class="bg-holder d-none d-sm-block d-xl-none d-xxl-block bg-card"
                style="background-image:url(<?php echo $path ?>/assets/img/spot-illustrations/21.png);background-position: bottom right; background-size: auto;">
              </div>
              <!--/.bg-holder-->
            </div>
            <div class="d-light-none">
              <div class="bg-holder d-none d-sm-block d-xl-none d-xxl-block bg-card"
                style="background-image:url(<?php echo $path ?>/assets/img/spot-illustrations/dark_21.png);background-position: bottom right; background-size: auto;">
              </div>
              <!--/.bg-holder-->
            </div>
            <div class="card-body px-5 position-relative">
              <div class="badge badge-phoenix fs--2 badge-phoenix-warning mb-4"><span class="fw-bold">Road to
                  Achieve</span><span class="fa-solid fa-award ms-1"></span></div>
              <h3 class="mb-5">The only way to learn a code is to write a lot of code!</h3>
              <p class="text-700 fw-semi-bold">Project Management Dashboard is coming to <br
                  class="d-none d-sm-block" />Usage soon for monitoring every interns <br class="d-none d-sm-block" />
              </p>
            </div>
            <div class="card-footer border-0 py-0 px-5 z-index-1">
              <!-- <p class="text-700 fw-semi-bold">projec ThemeWagon </a>at <br class="d-none d-xxl-block" />Bootstrap Marketplace for updates.</p> -->
            </div>
          </div>
        </div>
      </div>

      <br>
      <br>
      <div class="col-xl-12">
        <div class="card shadow-none border border-300" data-component-card="data-component-card">
          <div class="card-header p-4 border-bottom border-300 bg-soft">
            <div class="row g-3 justify-content-between align-items-center">
              <div class="col-12 col-md">
                <h4 class="text-900 mb-0">Daily Working Hours</h4>
              </div>

            </div>
          </div>
          <div class="card-body p-0">

            <div class="p-4 code-to-copy">
              <div class="daily-work-duration" style="min-height:300px"></div>
            </div>
          </div>
        </div>
      </div>



      <div class="row mt-3">
        <div class="col-12">
          <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-white pt-6 border-top border-300">
            <div id="projectSummary"
              data-list='{"valueNames":["project","assigness","start","deadline","calculation","projectprogress","status","action"],"page":6,"pagination":true}'>
              <div class="row align-items-end justify-content-between pb-4 g-3">
                <div class="col-auto">
                  <h3>Projects</h3>
                  <p class="text-700 lh-sm mb-0">Brief summary of all projects</p>
                </div>
              </div>
              <div class="table-responsive ms-n1 ps-1 scrollbar">
                <table class="table fs--1 mb-0 border-top border-200">
                  <thead>
                    <tr>
                      <th class="sort align-middle ps-3" data-sort="id" style="width:5%;">S.No</th>
                      <th class="sort white-space-nowrap align-middle ps-0" scope="col" data-sort="projectTitle"
                        style="width:25%;">PROJECT Title</th>
                      <th class="sort align-middle ps-3" scope="col" data-sort="incharge" style="width:10%;">INCHARGE
                      </th>
                      <th class="sort align-middle ps-3" scope="col" data-sort="startDate" style="width:10%;">START DATE
                      </th>
                      <th class="sort align-middle ps-3" scope="col" data-sort="endDtae" style="width:15%;">DEADLINE
                      </th>
                      <th class="sort align-middle ps-3" scope="col" data-sort="projectprogress" style="width:5%;">
                        PROGRESS</th>
                      <th class="sort align-middle ps-8" scope="col" data-sort="status" style="width:10%;">STATUS</th>
                      <th class="sort align-middle text-end" scope="col" style="width:10%;"></th>
                    </tr>
                  </thead>
                  <tbody class="list" id="project-summary-table-body">
                    <?php
                    $checkSql = "SELECT p.*,m.name FROM m_projects p INNER JOIN m_user m ON p.incharge=m.user_id";
                    $checkResult = mysqli_query($db, $checkSql);
                    $i = 0;
                    while ($row = $checkResult->fetch_assoc()) {
                      $i++;
                      // echo json_encode($row);
                      echo "<tr class='position-static'>
                        <td class='align-middle ps-3 name'>$i</td>
                        <td class='align-middle time white-space-nowrap ps-0 project'>
                        <a class='fw-bold fs-0' id='projectTitle'>$row[title]</a>
                        </td>
                        <td class='align-middle white-space-nowrap assigness ps-3'>
                        <a class='fw-bold fs-0' id='projectTitle'>$row[name]</a>
                        </td>
                        <td class='align-middle white-space-nowrap start ps-3'>
                          <p class='mb-0 fs--1 text-900'>$row[start_date]</p>
                        </td>
                        <td class='align-middle white-space-nowrap deadline ps-3'>
                          <p class='mb-0 fs--1 text-900'>$row[end_date]</p>
                        </td>
                        <td class='align-middle white-space-nowrap ps-3 projectprogress'>
                          <p class='text-800 fs--2 mb-0'>145 / 145</p>
                          <div class='progress' style='height:3px;'>
                            <div class='progress-bar bg-success' style='width: 100%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100' role='progressbar'></div>
                          </div>
                        </td>
                        <td class='align-middle white-space-nowrap ps-8 status'>";

                      if ($row['status'] == '1') {
                        echo "<span class='badge badge-phoenix fs--2 badge-phoenix-success'>ACTIVE</span>";
                      } else if ($row['status'] == '2') {
                        echo "<span class='badge badge-phoenix fs--2 badge-phoenix-warning'>ONGOING</span>";
                      } else {
                        echo "<span class='badge badge-phoenix fs--2 badge-phoenix-secondary'>NON_ACTIVE</span>";
                      }
                      ;
                      echo " </td>
                        <td class='align-middle text-end white-space-nowrap pe-0 action'>
                          <div class='font-sans-serif btn-reveal-trigger position-static'><button class='btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2' type='button' data-bs-toggle='dropdown' data-boundary='window' aria-haspopup='true' aria-expanded='false' data-bs-reference='parent'><span class='fas fa-ellipsis-h fs--2'></span></button>
                            <div class='dropdown-menu dropdown-menu-end py-2'><a class='dropdown-item' href='#!'>View</a><a class='dropdown-item' href='#!'>Export</a>
                              <div class='dropdown-divider'></div><a class='dropdown-item text-danger' href='#!'>Remove</a>
                            </div>
                          </div>
                        </td>
                      </tr>"
                      ;
                    } ?>

                  </tbody>
                </table>
              </div>
              <div class="row align-items-center justify-content-between py-2 pe-0 fs--1">
                <div class="col-auto d-flex">
                  <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900" data-list-info="data-list-info"></p><a
                    class="fw-semi-bold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1"
                      data-fa-transform="down-1"></span></a><a class="fw-semi-bold d-none" href="#!"
                    data-list-view="less">View Less<span class="fas fa-angle-right ms-1"
                      data-fa-transform="down-1"></span></a>
                </div>
                <div class="col-auto d-flex"><button class="page-link" data-list-pagination="prev"><span
                      class="fas fa-chevron-left"></span></button>
                  <ul class="mb-0 pagination"></ul><button class="page-link pe-0" data-list-pagination="next"><span
                      class="fas fa-chevron-right"></span></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php footer(); ?>
    </div>
  </main>
</body>
<?php script() ?>
<script>
  let data = []
  let data1 = []
  function drawGraph() {
    const { merge: merge } = window._; const echartSetOption = (e, t, o, n) => { const { breakpoints: r, resize: a } = window.phoenix.utils, s = t => { Object.keys(t).forEach((o => { window.innerWidth > r[o] && e.setOption(t[o]); })); }, i = document.body; e.setOption(merge(o(), t)); const c = document.querySelector(".navbar-vertical-toggle"); c && c.addEventListener("navbar.vertical.toggle", (() => { e.resize(), n && s(n); })), a((() => { e.resize(), n && s(n); })), n && s(n), i.addEventListener("clickControl", (({ detail: { control: n } }) => { "phoenixTheme" === n && e.setOption(window._.merge(o(), t)); })); }; const echartTabs = document.querySelectorAll("[data-tab-has-echarts]"); echartTabs && echartTabs.forEach((e => { e.addEventListener("shown.bs.tab", (e => { const t = e.target, { hash: o } = t, n = o || t.dataset.bsTarget, r = document.getElementById(n.substring(1))?.querySelector("[data-echart-tab]"); r && window.echarts.init(r).resize(); })); })); const tooltipFormatter = (e, t = "MMM DD") => { let o = ""; return e.forEach((e => { o += `<div class='ms-1'>\n        <h6 class="text-700"><span class="fas fa-circle me-1 fs--2" style="color:${e.borderColor ? e.borderColor : e.color}"></span>\n          ${e.seriesName} : ${"object" == typeof e.value ? e.value[1] : e.value}\n        </h6>\n      </div>`; })), `<div>\n            <p class='mb-2 text-600'>\n              ${window.dayjs(e[0].axisValue).isValid() ? window.dayjs(e[0].axisValue).format(t) : e[0].axisValue}\n            </p>\n            ${o}\n          </div>` }; const handleTooltipPosition = ([e, , t, , o]) => { if (window.innerWidth <= 540) { const n = t.offsetHeight, r = { top: e[1] - n - 20 }; return r[e[0] < o.viewSize[0] / 2 ? "left" : "right"] = 5, r } return null };

    const basicBarChartInit = () => { const { getColor: r, getData: t } = window.phoenix.utils, o = document.querySelector(".monthly-work-duration"), e = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], a = data; if (o) { const i = t(o, "echarts"), s = window.echarts.init(o); echartSetOption(s, i, (() => ({ tooltip: { trigger: "axis", padding: [7, 10], backgroundColor: r("gray-100"), borderColor: r("gray-300"), textStyle: { color: r("dark") }, borderWidth: 1, formatter: r => tooltipFormatter(r), transitionDuration: 0, axisPointer: { type: "none" } }, xAxis: { type: "category", data: e, axisLine: { lineStyle: { color: r("gray-300"), type: "solid" } }, axisTick: { show: !1 }, axisLabel: { color: r("gray-400"), formatter: r => r.substring(0, 3), margin: 15 }, splitLine: { show: !1 } }, yAxis: { type: "value", boundaryGap: !0, axisLabel: { show: !0, color: r("gray-400"), margin: 15 }, splitLine: { show: !0, lineStyle: { color: r("gray-200") } }, axisTick: { show: !1 }, axisLine: { show: !1 }, min: 0 }, series: [{ type: "bar", name: "Total", data: a, lineStyle: { color: r("primary") }, itemStyle: { color: r("primary"), barBorderRadius: [3, 3, 0, 0] }, showSymbol: !1, symbol: "circle", smooth: !1, hoverAnimation: !0 }], grid: { right: "3%", left: "10%", bottom: "10%", top: "5%" } }))); } };
    const basicAreaLineChartInit = () => { const { getColor: r, getData: e, rgbaColor: o } = window.phoenix.utils, t = document.querySelector(".daily-work-duration"), a = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"], i = data1; if (t) { const l = e(t, "echarts"), n = window.echarts.init(t); echartSetOption(n, l, (() => ({ tooltip: { trigger: "axis", padding: [7, 10], backgroundColor: r("gray-100"), borderColor: r("gray-300"), textStyle: { color: r("dark") }, borderWidth: 1, formatter: r => (r => `\n    <div>\n        <h6 class="fs--1 text-700 mb-0">\n          <span class="fas fa-circle me-1" style='color:${r[0].borderColor}'></span>\n          ${r[0].name} : ${r[0].value}\n        </h6>\n    </div>\n    `)(r), transitionDuration: 0, axisPointer: { type: "none" } }, xAxis: { type: "category", data: a, boundaryGap: !1, axisLine: { lineStyle: { color: r("gray-300"), type: "solid" } }, axisTick: { show: !1 }, axisLabel: { color: r("gray-400"), formatter: r => r.substring(0, 3), margin: 15 }, splitLine: { show: !1 } }, yAxis: { type: "value", splitLine: { lineStyle: { color: r("gray-200") } }, boundaryGap: !1, axisLabel: { show: !0, color: r("gray-400"), margin: 15 }, axisTick: { show: !1 }, axisLine: { show: !1 }, min: 0 }, series: [{ type: "line", data: i, itemStyle: { color: r("white"), borderColor: r("primary"), borderWidth: 2 }, lineStyle: { color: r("primary") }, showSymbol: !1, symbolSize: 10, symbol: "circle", smooth: !1, hoverAnimation: !0, areaStyle: { color: { type: "linear", x: 0, y: 0, x2: 0, y2: 1, colorStops: [{ offset: 0, color: o(r("primary"), .5) }, { offset: 1, color: o(r("primary"), 0) }] } } }], grid: { right: "3%", left: "10%", bottom: "10%", top: "5%" } }))); } };

    const { docReady: docReady } = window.phoenix.utils; docReady(basicBarChartInit), docReady(basicAreaLineChartInit);
  }




  graphData()
  function graphData() {
    $.ajax({
      url: 'api/monthlyData.php',
      method: 'post',
      dataType: 'json',
      success: function (result) {
        // console.log(result);
        data = result
        drawGraph()
      },
      error: function (err) {
        console.log(err);
      }
    });
  }
  dailyData()
  function dailyData() {
    $.ajax({
      url: 'api/dailyData.php',
      method: 'post',
      dataType: 'json',
      success: function (result1) {
        console.log(result1);
        data1 = result1
        drawGraph()
      },
      error: function (err) {
        console.log(err);
      }
    });
  }

</script>

</html>