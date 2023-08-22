<?php
include '../../includes/init.php';
$path = $GLOBALS['_path'];
$_rid = 4;
$db = db();
checkSession();
$userData = $_SESSION['userData'];
$selectedUserId = '';
if (isset($_POST['userId'])) {
    $selectedUserId = $_POST['userId'];
}
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<?php
head();

?>

<body>
    <main class="main" id="top">



        <?php menu() ?>

        <div class="content">
            <div class="row gy-3 mb-6 justify-content-between">
                <div class="col-md-9 col-auto">
                    <h2 class="mb-2 text-1100">Students Dashboard</h2>
                    <h5 class="text-700 fw-semi-bold">Here’s what’s going on at your performance right now</h5>
                </div>
                <div class="col-sm-6 col-md-6">

                    <label for="organizerSingle">Students</label><select class="form-select" id="selectUsers"
                        data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>

                        <option value="">Select Students...</option>
                        <?php

                        $checkSql = "SELECT user_id, name FROM m_user WHERE STATUS='1'";
                        $checkResult = mysqli_query($db, $checkSql);
                        while ($row = $checkResult->fetch_assoc()) {
                            echo "<option value=$row[user_id]>$row[name]</option>";
                        }
                        if (isset($_POST['userId'])) {
                            $selectedUserId = $_POST['userId'];
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3 gy-6">
                <div class="col-12 col-xxl-2">
                    <div class="row align-items-center g-3 g-xxl-0 h-100 align-content-between">
                        <div class="col-12 col-sm-6 col-md-3 col-lg-6 col-xl-3 col-xxl-12">
                            <div class="d-flex align-items-center"><span
                                    class="fs-4 lh-1 uil uil-books text-primary-500"></span>
                                <div class="ms-2">
                                    <div class="d-flex align-items-end">
                                        <h2 class="mb-0 me-2" id="projectCount">0
                                        </h2>
                                        <span class="fs-1 fw-semi-bold text-900">Projects</span>
                                    </div>

                                    <p class="text-800 fs--1 mb-0">Total projects</p>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-sm-6 col-md-3 col-lg-6 col-xl-3 col-xxl-12">
                            <div class="d-flex align-items-center"><span
                                    class="fs-4 lh-1 uil uil-users-alt text-success-500"></span>
                                <div class="d-flex align-items-center"><span
                                        class="fs-4 lh-1 uil uil-invoice text-warning-500"></span>
                                    <div class="ms-2">
                                        <div class="d-flex align-items-end">
                                            <h2 class="mb-0 me-2" id="completecount">
                                                0
                                            </h2><span class="fs-1 fw-semi-bold text-900">Projects</span>
                                        </div>
                                        <p class="text-800 fs--1 mb-0">So far completed</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3 col-lg-6 col-xl-3 col-xxl-12">
                            <div class="d-flex align-items-center"><span
                                    class="fs-4 lh-1 uil uil-refresh text-danger-500"></span>
                                <div class="ms-2">
                                    <div class="d-flex align-items-end">
                                        <h2 class="mb-0 me-2" id="ongoingCount">
                                            0
                                        </h2><span class="fs-1 fw-semi-bold text-900">On going</span>
                                    </div>
                                    <p class="text-800 fs--1 mb-0">Fresh start</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-12 col-xxl-5">
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

            </div>

            <br>
            <br>

            <div class="row gy-3 mb-6 justify-content-between">
                <div class="col-xl-6">

                    <div class="mx-xxl-0">
                        <h3>Monthly Working Hours</h3>
                        <p class="text-700"></p>
                        <div class="monthly-work-duration" style="min-height:300px"></div>

                    </div>

                </div>
                <div style="margin-top: 10px;" class="col-12 col-xl-6 order-1 order-xl-0">
                    <div class="mb-9">
                        <div class="card shadow-none border border-300 my-4" data-component-card="data-component-card">
                            <div class="card-header p-4 border-bottom border-300 bg-soft">
                                <div class="row g-3 justify-content-between align-items-center">
                                    <div class="col-12 col-md">
                                        <h4 class="text-900 mb-0">Students Log</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 code-to-copy">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="card shadow-none border border-300 my-1"
                                        data-component-card="data-component-card">
                                        <div class="card-body p-0">
                                        </div>
                                    </div>
                                    <div class="d-none ms-3" id="bulk-select-actions">
                                        <div class="d-flex"><select class="form-select form-select-sm"
                                                aria-label="Bulk actions">
                                                <option selected="selected">Bulk actions</option>
                                                <option value="Delete">Delete</option>
                                                <option value="Archive">Archive</option>
                                            </select><button class="btn btn-phoenix-danger btn-sm ms-2"
                                                type="button">Apply</button></div>
                                    </div>
                                </div>
                                <div id="tableExample"
                                    data-list='{"valueNames":["s.No","User Id","Name","Check In","Check Out","Status","Action"],"page":10,"pagination":true}'>
                                    <div class="table-responsive">
                                   <table class="table table-sm border-top border-200 fs--1 mb-0" class="table table-striped">
                                    
            
                                            <thead>
                                                <tr>
                                                    <th class="white-space-nowrap fs--1 align-middle ps-0"
                                                        style="max-width:20px; width:18px;">
                                                        <div class="form-check mb-0 fs-0"><input
                                                                class="form-check-input" id="bulk-select-example"
                                                                type="checkbox"
                                                                data-bulk-select='{"body":"bulk-select-body","actions":"bulk-select-actions","replacedElement":"bulk-select-replace-element"}' />
                                                        </div>
                                                    </th>
                                                    <th class="sort align-middle ps-3" data-sort="id">S.No</th>
                                                    <th class="sort align-middle ps-8" data-sort="name">Project Title
                                                    </th>
                                                    <th class="sort align-middle ps-8" data-sort="duration">Duration
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="list" id="bulk-select-body">
                                                <!--  -->
                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="d-flex flex-between-center pt-3 mb-3">
                                        <div class="pagination d-none"></div>
                                        <p class="mb-0 fs--1">
                                            <span class="d-none d-sm-inline-block"
                                                data-list-info="data-list-info"></span>
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
    </main>
</body>
<?php script() ?>
<script>
    let data = [];
    let data1 = [];
    let selectedUser = '';

    function drawGraph() {
        const { merge: merge } = window._; const echartSetOption = (e, t, o, n) => { const { breakpoints: r, resize: a } = window.phoenix.utils, s = t => { Object.keys(t).forEach((o => { window.innerWidth > r[o] && e.setOption(t[o]); })); }, i = document.body; e.setOption(merge(o(), t)); const c = document.querySelector(".navbar-vertical-toggle"); c && c.addEventListener("navbar.vertical.toggle", (() => { e.resize(), n && s(n); })), a((() => { e.resize(), n && s(n); })), n && s(n), i.addEventListener("clickControl", (({ detail: { control: n } }) => { "phoenixTheme" === n && e.setOption(window._.merge(o(), t)); })); }; const echartTabs = document.querySelectorAll("[data-tab-has-echarts]"); echartTabs && echartTabs.forEach((e => { e.addEventListener("shown.bs.tab", (e => { const t = e.target, { hash: o } = t, n = o || t.dataset.bsTarget, r = document.getElementById(n.substring(1))?.querySelector("[data-echart-tab]"); r && window.echarts.init(r).resize(); })); })); const tooltipFormatter = (e, t = "MMM DD") => { let o = ""; return e.forEach((e => { o += `<div class='ms-1'>\n        <h6 class="text-700"><span class="fas fa-circle me-1 fs--2" style="color:${e.borderColor ? e.borderColor : e.color}"></span>\n          ${e.seriesName} : ${"object" == typeof e.value ? e.value[1] : e.value}\n        </h6>\n      </div>`; })), `<div>\n            <p class='mb-2 text-600'>\n              ${window.dayjs(e[0].axisValue).isValid() ? window.dayjs(e[0].axisValue).format(t) : e[0].axisValue}\n            </p>\n            ${o}\n          </div>` }; const handleTooltipPosition = ([e, , t, , o]) => { if (window.innerWidth <= 540) { const n = t.offsetHeight, r = { top: e[1] - n - 20 }; return r[e[0] < o.viewSize[0] / 2 ? "left" : "right"] = 5, r } return null };

        const basicBarChartInit = () => { const { getColor: r, getData: t } = window.phoenix.utils, o = document.querySelector(".monthly-work-duration"), e = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], a = data; if (o) { const i = t(o, "echarts"), s = window.echarts.init(o); echartSetOption(s, i, (() => ({ tooltip: { trigger: "axis", padding: [7, 10], backgroundColor: r("gray-100"), borderColor: r("gray-300"), textStyle: { color: r("dark") }, borderWidth: 1, formatter: r => tooltipFormatter(r), transitionDuration: 0, axisPointer: { type: "none" } }, xAxis: { type: "category", data: e, axisLine: { lineStyle: { color: r("gray-300"), type: "solid" } }, axisTick: { show: !1 }, axisLabel: { color: r("gray-400"), formatter: r => r.substring(0, 3), margin: 15 }, splitLine: { show: !1 } }, yAxis: { type: "value", boundaryGap: !0, axisLabel: { show: !0, color: r("gray-400"), margin: 15 }, splitLine: { show: !0, lineStyle: { color: r("gray-200") } }, axisTick: { show: !1 }, axisLine: { show: !1 }, min: 0 }, series: [{ type: "bar", name: "Total", data: a, lineStyle: { color: r("primary") }, itemStyle: { color: r("primary"), barBorderRadius: [3, 3, 0, 0] }, showSymbol: !1, symbol: "circle", smooth: !1, hoverAnimation: !0 }], grid: { right: "3%", left: "10%", bottom: "10%", top: "5%" } }))); } };
        const basicAreaLineChartInit = () => { const { getColor: r, getData: e, rgbaColor: o } = window.phoenix.utils, t = document.querySelector(".daily-work-duration"), a = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"], i = data1; if (t) { const l = e(t, "echarts"), n = window.echarts.init(t); echartSetOption(n, l, (() => ({ tooltip: { trigger: "axis", padding: [7, 10], backgroundColor: r("gray-100"), borderColor: r("gray-300"), textStyle: { color: r("dark") }, borderWidth: 1, formatter: r => (r => `\n    <div>\n        <h6 class="fs--1 text-700 mb-0">\n          <span class="fas fa-circle me-1" style='color:${r[0].borderColor}'></span>\n          ${r[0].name} : ${r[0].value}\n        </h6>\n    </div>\n    `)(r), transitionDuration: 0, axisPointer: { type: "none" } }, xAxis: { type: "category", data: a, boundaryGap: !1, axisLine: { lineStyle: { color: r("gray-300"), type: "solid" } }, axisTick: { show: !1 }, axisLabel: { color: r("gray-400"), formatter: r => r.substring(0, 3), margin: 15 }, splitLine: { show: !1 } }, yAxis: { type: "value", splitLine: { lineStyle: { color: r("gray-200") } }, boundaryGap: !1, axisLabel: { show: !0, color: r("gray-400"), margin: 15 }, axisTick: { show: !1 }, axisLine: { show: !1 }, min: 0 }, series: [{ type: "line", data: i, itemStyle: { color: r("white"), borderColor: r("primary"), borderWidth: 2 }, lineStyle: { color: r("primary") }, showSymbol: !1, symbolSize: 10, symbol: "circle", smooth: !1, hoverAnimation: !0, areaStyle: { color: { type: "linear", x: 0, y: 0, x2: 0, y2: 1, colorStops: [{ offset: 0, color: o(r("primary"), .5) }, { offset: 1, color: o(r("primary"), 0) }] } } }], grid: { right: "3%", left: "10%", bottom: "10%", top: "5%" } }))); } };

        const { docReady: docReady } = window.phoenix.utils; docReady(basicBarChartInit), docReady(basicAreaLineChartInit);
    }

    $(document).ready(function () {
        $("#selectUsers").change(function () {
            selectedUser = $(this).val();
            loadData(selectedUser);
            loadTableData(selectedUser);
        });

    });
    function loadData(userId) {
        // console.log(userId)
        if (userId) {

            graphData(userId);
            dailyData(userId);
            fetchProjectCounts(userId);
            ongoingprojects(userId);
            completedCount(userId)
        } else {
            data = [];
            data1 = [];
            drawGraph();
        }
    }

    // graphData()
    function graphData(userId) {
        $.ajax({
            url: 'api/monthlyData.php',
            method: 'post',
            data: { userId: userId },
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
    // dailyData()
    function dailyData(userId) {
        $.ajax({
            url: 'api/dailyData.php',
            method: 'post',
            data: { userId: userId },
            dataType: 'json',
            success: function (result1) {
                // console.log(result1);
                data1 = result1
                drawGraph()
            },
            error: function (err) {
                console.log(err);
            }
        });
    }
    function fetchProjectCounts(userId) {
        $.ajax({
            url: 'api/getCount.php',
            method: 'post',
            data: {
                userId: userId
            },
            dataType: 'json',
            success: function (counts) {
                $("#projectCount").text(counts.projectCount);
            },
            error: function (err) {
                console.log(err);
            }
        });
    }
    function ongoingprojects(userId) {
        $.ajax({
            url: 'api/ongoingProjects.php',
            method: 'post',
            data: {
                userId: userId
            },
            dataType: 'json',
            success: function (counts) {
                $("#ongoingCount").text(counts.ongoingCount);
            },
            error: function (err) {
                console.log(err);
            }
        });
    }
    function completedCount(userId) {
        $.ajax({
            url: 'api/completedCount.php',
            method: 'post',
            data: {
                userId: userId
            },
            dataType: 'json',
            success: function (counts) {
                $("#completecount").text(counts.completecount);
            },
            error: function (err) {
                console.log(err);
            }
        });
    }

    function loadTableData(userId) {
        $.ajax({
            url: 'api/getTableData.php',
            method: 'post',
            data: { userId: userId },
            dataType: 'json',
            success: function (data) {
                $('#bulk-select-body').empty();
                // console.log(data)
                $.each(data, function (i, row) {

                    var html = `
                    <tr>
                        <td class='fs--1 align-middle'>
                            <div class='form-check mb-0 fs-0'>
                                <input class='form-check-input' type='checkbox'
                                    data-bulk-select-row='{"name":"Anna","email":"anna@example.com","age":18}' />
                            </div>
                        </td>
                        <td class='align-middle ps-3 name'>${i + 1}</td>
                        <td class='align-middle email ps-6'>${row.title}</td>
                        <td class='align-middle email ps-8'>${row.duration}</td>
                    </tr>`;
                    $('#bulk-select-body').append(html);
                });
            },
            error: function (err) {
                console.log(err);
            }
        });
    }

</script>

</html>