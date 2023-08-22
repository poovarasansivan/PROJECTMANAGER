<?php
include '../../includes/init.php';
$path = $GLOBALS['_path'];
$_rid = 2;
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
    <div class="content px-0 pt-9">
      <div class="row g-0">
        <div class="col-12 col-xxl-8 px-0 bg-soft">
          <div class="px-4 px-lg-6 pt-6 pb-9">
            <div class="mb-5">
              <div class="d-flex justify-content-between">
                <h2 class="text-black fw-bolder mb-2" id="title"></h2>
                <div class="font-sans-serif btn-reveal-trigger">
                </div>
              </div><span class="badge badge-phoenix badge-phoenix-primary">Ongoing<span
                  class="ms-1 uil uil-stopwatch"></span></span>
            </div>
            <div class="row gx-0 gx-sm-5 gy-8 mb-8">
              <div class="col-12 col-xl-3 col-xxl-4 pe-xl-0">
                <div class="mb-4 mb-xl-7">
                  <div class="row gx-0 gx-sm-7">
                    <div class="col-12 col-sm-auto">
                      <table class="lh-sm mb-4 mb-sm-0 mb-xl-4">
                        <tbody>
                          <tr>
                            <td class="py-1" colspan="2">

                            </td>
                          </tr>
                          <tr>
                            <td class="align-top py-1">
                              <div class="d-flex"><span class="fa-solid fa-user me-2 text-700 fs--1"></span>
                                <h5 class="text-900 mb-0 text-nowrap">Incharge:</h5>
                              </div>
                            </td>
                            <td class="ps-1 py-1"><a class="fw-semi-bold d-block lh-sm" id="name"></a></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-12 col-sm-auto">
                      <table class="lh-sm">
                        <tbody>
                          <tr>
                            <td class="align-top py-1 text-900 text-nowrap fw-bold">Started Date : </td>
                            <td class="text-600 fw-semi-bold ps-3" id="startDate"></td>
                          </tr>
                          <tr>
                            <td class="align-top py-1 text-900 text-nowrap fw-bold">Deadline :</td>
                            <td class="text-600 fw-semi-bold ps-3" id="endDate"></td>
                          </tr>
                          <tr>
                            <td class="align-top py-1 text-900 text-nowrap fw-bold">Progress :</td>
                            <td class="text-warning fw-semi-bold ps-3">80%</td>
                          </tr>
                          <tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-12 col-sm-7 col-lg-8 col-xl-5">
                    <h4 class="text-1100 mb-4" style="margin-top: 20px;">Project Description</h4>
                    <p class="text-800 mb-4 justify-content-between" id="description" style="text-align: justify;">
                    </p>
                  </div>
                </div>

                <div>

                </div>
              </div>
              <div class="col-12 col-xl-9 col-xxl-8">
                <div class="row flex-between-center mb-3 g-3">
                  <div class="col-auto">
                    <h4 class="text-black">Task completed over time</h4>
                    <p class="text-700 mb-0">Hard works done across all projects</p>
                  </div>
                  <div class="col-8 col-sm-4">
                    </select></div>
                </div>
                <div class="project-wise-work-hours" style="min-height:300px"></div>

              </div>


            </div>
            <div style="margin-top: -20px;" class="col-12 col-xl-12 order-1 order-xl-0">
              <div class="mb-9">
                <div class="card shadow-none border border-300 my-4" data-component-card="data-component-card">
                  <div class="card-header p-4 border-bottom border-300 bg-soft">
                    <div class="row g-3 justify-content-between align-items-center">
                      <div class="col-12 col-md">
                        <h4 class="text-900 mb-0">Students Task Log</h4>
                      </div>
                    </div>
                  </div>
                  <div class="p-4 code-to-copy">
                    <div class="d-flex align-items-center justify-content-end">
                      <div class="card shadow-none border border-300 my-1" data-component-card="data-component-card">
                        <div class="card-body p-0">
                        </div>
                      </div>
                      <div class="d-none ms-3" id="bulk-select-actions">
                        <div class="d-flex"><select class="form-select form-select-sm" aria-label="Bulk actions">
                            <option selected="selected">Bulk actions</option>
                            <option value="Delete">Delete</option>
                            <option value="Archive">Archive</option>
                          </select><button class="btn btn-phoenix-danger btn-sm ms-2" type="button">Apply</button></div>
                      </div>
                    </div>
                    <div id="tableExample"
                      data-list='{"valueNames":["s.No","User Id","Name","Check In","Check Out","Status","Action"],"page":10,"pagination":true}'>
                      <div class="table-responsive mx-n1 px-1">
                        <table class="table table-sm border-top border-200 fs--1 mb-0">
                          <thead>
                            <tr>
                              <th class="white-space-nowrap fs--1 align-middle ps-0"
                                style="max-width:20px; width:18px;">
                                <div class="form-check mb-0 fs-0"><input class="form-check-input"
                                    id="bulk-select-example" type="checkbox"
                                    data-bulk-select='{"body":"bulk-select-body","actions":"bulk-select-actions","replacedElement":"bulk-select-replace-element"}' />
                                </div>
                              </th>
                              <th class="sort align-middle ps-3" data-sort="id">S.No</th>
                              <th class="sort align-middle ps-6" data-sort="userId">User Id</th>
                              <th class="sort align-middle ps-8" data-sort="name">Name</th>
                              <th class="sort align-middle ps-15" data-sort="status">Status</th>
                              <th class="sort text-end align-middle pe-0" scope="col">ACTION</th>
                            </tr>
                          </thead>
                          <tbody class="list" id="bulk-select-body">
                            <?php
                            $checkSql = "SELECT p.*, u.name FROM project_user_mapping p INNER JOIN m_user u ON p.user_id = u.user_id where project_id = $_GET[id]";
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
                             <td class='align-middle ps-3 name'>$i</td>
                             <td class='align-middle email ps-6'>$row[user_id]</td>
                             <td class='align-middle email ps-8'>$row[name]</td>
                             <td class='align-middle email ps-15'>";
                              if ($row['status'] == '1') {
                                echo "<span class='badge badge-phoenix fs--2 badge-phoenix-success'>Active</span>";
                              } else {
                                echo "<span class='badge badge-phoenix fs--2 badge-phoenix-warning'>Non-Active</span>";
                              }
                              echo "<td class='align-middle white-space-nowrap text-end pe-0'>";
                              if ($row['status'] == '0') {
                                echo "
                             <button class='btn btn-phoenix-success btn-sm' type='button' onclick='activeStatus($row[id],1)'
                             id='active'>Active</button>";
                              } else
                                echo "
                         <button class='btn btn-phoenix-success btn-sm' type='button' onclick='activeStatus($row[id],0)'
                             id='nonActive'>Non Active</button>";
                              echo "
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

                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php footer(); ?>
        </div>
      </div>
    </div>
  </main>
  <?php script() ?>
</body>
<script>
  var pId = window.location.search.slice(1).split("&")[0].split("=")[1]
  view()
  function view() {
    $.ajax({
      url: 'api/fetchDetails.php',
      method: 'post',
      dataType: 'json',
      data: {
        'id': pId
      },
      success: function (result) {
        if (result.success) {
          let data = result.data
          console.log(result)
          $('#title').text(data.title)
          $('#description').text(data.description)
          $('#startDate').text(data.start_date)
          $('#endDate').text(data.end_date)
          $('#name').text(data.name)
        }

      }, error: function (err) {
        console.log(err)
      }
    });
  }
  details()
  function details() {
    $.ajax({
      url: 'api/userDetails.php',
      method: 'post',
      dataType: 'json',
      data: {
        'id': pId
      },
      success: function (result) {
        if (result.success) {
          let data = result.data
          $('#projectId').text(data.project_id)
          $('#userId').text(data.user_id)
          $('#name').text(data.name)
          $('#duration').text(data.duration)
          $('#status').text(data.status)

          if (data.status == '1') {
            $('#active').hide();
            $('#nonactive').show();
          }
          else {
            $('#active').show();
            $('#nonactive').hide();
          }
        }
      }, error: function (err) {
        console.log(err)
      }
    });
  }
  function activeStatus(id, state) {
    $.ajax({
      url: 'api/updateDetails.php',
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
  let data = []
  function drawGraph() {
    const { merge: merge } = window._; const echartSetOption = (e, t, o, n) => { const { breakpoints: r, resize: a } = window.phoenix.utils, s = t => { Object.keys(t).forEach((o => { window.innerWidth > r[o] && e.setOption(t[o]); })); }, i = document.body; e.setOption(merge(o(), t)); const c = document.querySelector(".navbar-vertical-toggle"); c && c.addEventListener("navbar.vertical.toggle", (() => { e.resize(), n && s(n); })), a((() => { e.resize(), n && s(n); })), n && s(n), i.addEventListener("clickControl", (({ detail: { control: n } }) => { "phoenixTheme" === n && e.setOption(window._.merge(o(), t)); })); }; const echartTabs = document.querySelectorAll("[data-tab-has-echarts]"); echartTabs && echartTabs.forEach((e => { e.addEventListener("shown.bs.tab", (e => { const t = e.target, { hash: o } = t, n = o || t.dataset.bsTarget, r = document.getElementById(n.substring(1))?.querySelector("[data-echart-tab]"); r && window.echarts.init(r).resize(); })); })); const tooltipFormatter = (e, t = "MMM DD") => { let o = ""; return e.forEach((e => { o += `<div class='ms-1'>\n        <h6 class="text-700"><span class="fas fa-circle me-1 fs--2" style="color:${e.borderColor ? e.borderColor : e.color}"></span>\n          ${e.seriesName} : ${"object" == typeof e.value ? e.value[1] : e.value}\n        </h6>\n      </div>`; })), `<div>\n            <p class='mb-2 text-600'>\n              ${window.dayjs(e[0].axisValue).isValid() ? window.dayjs(e[0].axisValue).format(t) : e[0].axisValue}\n            </p>\n            ${o}\n          </div>` }; const handleTooltipPosition = ([e, , t, , o]) => { if (window.innerWidth <= 540) { const n = t.offsetHeight, r = { top: e[1] - n - 20 }; return r[e[0] < o.viewSize[0] / 2 ? "left" : "right"] = 5, r } return null };

    const stackedAreaChartInit = () => {
      const { getColor: e, getData: o, rgbaColor: r } = window.phoenix.utils, t =
        document.querySelector(".project-wise-work-hours"), a = ["1", "2", "3", "4", "5", "6", "7",
          "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"]; if (t) {
            const i = o(t, "echarts"), l = window.echarts.init(t); echartSetOption(l, i, (() => ({
              tooltip: {
                trigger: "axis", padding: [7, 10], backgroundColor: e("gray-100"), borderColor: e("gray-300"), textStyle: {
                  color: e("dark")
                }, borderWidth: 1, transitionDuration: 0, axisPointer: { type: "none" }, position: (...e) =>
                  handleTooltipPosition(e), formatter: e => tooltipFormatter(e)
              }, xAxis: {
                type: "category", data: a, boundaryGap: !1,
                axisLine: { lineStyle: { color: e("gray-300"), type: "solid" } }, axisTick: { show: !1 }, axisLabel: {
                  color:
                    e("gray-400"), margin: 15, formatter: e => e.substring(0, 3)
                }, splitLine: { show: !1 }
              }, yAxis: {
                type: "value",
                splitLine: { lineStyle: { color: e("gray-200") } }, boundaryGap: !1, axisLabel: {
                  show: !0, color: e("gray-400"),
                  margin: 15
                }, axisTick: { show: !1 }, axisLine: { show: !1 }
              }, series: [{
                name: "Hours", type: "line",
                symbolSize: 10, stack: "product", data: data, areaStyle: { color: r(e("info"), .3) },
                itemStyle: { color: e("white"), borderColor: e("info"), borderWidth: 2 }, lineStyle: { color: e("info") }, symbol:
                  "circle"
              }], grid:
                { right: 10, left: 5, bottom: 5, top: 8, containLabel: !0 }
            })));
          }
    };

    const { docReady: docReady } = window.phoenix.utils; docReady(stackedAreaChartInit);
  }
  graphData()
  function graphData() {
    $.ajax({
      url: 'api/getWorkhours.php',
      method: 'post',
      dataType: 'json',
      data: {
        'id': pId
      },
      success: function (result) {
        console.log(result)
        data = result
        drawGraph()
      },
      error: function (err) {
        console.log(err);
      }
    });
  }
</script>

</html>