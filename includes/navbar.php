<?php
$db = db();
checkSession();
$userData = $_SESSION["userData"];
$path = $GLOBALS["_path"];
$rID = $GLOBALS["_rid"];

$roleId = 1;
$result = mysqli_query(
  $db,
  "SELECT * FROM user_role WHERE id = $roleId"
);
$row = mysqli_fetch_assoc($result);
$_SESSION['user_access'] = $row;
$resource = explode("-", $row["resource"]);

$result = mysqli_query(
  $db,
  "SELECT DISTINCT(res_group) FROM m_resource WHERE STATUS ='1'"
);
$group = [];
while ($row = mysqli_fetch_assoc($result)) {
  $group[] = $row;
}
?>

<nav class="navbar navbar-vertical navbar-expand-lg" style="display:none;">
  <script>
    var navbarStyle = window.config.config.phoenixNavbarStyle;
    if (navbarStyle && navbarStyle !== 'transparent') {
      document.querySelector('body').classList.add(`navbar-${navbarStyle}`);
    }
  </script>
  <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
    <!-- scrollbar removed-->
    <div class="navbar-vertical-content">

      <?php foreach ($group as $g) {
        echo "
                    <ul class='navbar-nav flex-column' id='navbarVerticalNav'>
                        <li class='nav-item'>
                            <p class='navbar-vertical-label'>$g[res_group]</p>
                            <hr class='navbar-vertical-line' />
                            ";

        $result = mysqli_query(
          $db,
          "SELECT * FROM m_resource WHERE STATUS = '1' and res_group ='$g[res_group]' order by sort_id"
        );
        $menu = [];
        while ($row = mysqli_fetch_assoc($result)) {
          $menu[] = $row;
        }
        foreach ($menu as $m) {
          if ($rID == $m["id"]) {
            $active = "menu-active";
          } else {
            $active = "";
          }
          if (in_array($m['id'], $resource)) {
            echo "<div class='nav-item-wrapper'>
                             <a
                                class='nav-link label-1 $active'
                                href='$path/src/$m[link]'
                                role='button'
                                data-bs-toggle=''
                                aria-expanded='false'
                            >
                            <div style='padding: 10px 0px' class='d-flex align-items-center'>
                                <span class='nav-link-icon'><span style='padding-bottom:2px' height='19px' width='20px' data-feather='$m[img]'></span>
                                </span><span class='nav-link-text-wrapper'>
                                <span style='font-size: 17px' class='nav-link-text'>$m[label]</span></span>
                            </div>
                            </a>
                        </div>";
          }
        }
        echo "</li></ul>";
      } ?>


    </div>
  </div>
  <div class="navbar-vertical-footer"><button
      class="btn navbar-vertical-toggle border-0 fw-semi-bold w-100 white-space-nowrap d-flex align-items-center"><span
        class="uil uil-left-arrow-to-left fs-0"></span><span class="uil uil-arrow-from-right fs-0"></span><span
        class="navbar-vertical-footer-text ms-2">Collapsed View</span></button></div>
</nav>
<nav class="navbar navbar-top fixed-top navbar-expand" id="navbarDefault" style="display:none;">
  <div class="collapse navbar-collapse justify-content-between">
    <div class="navbar-logo">
      <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
        data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse"
        aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
            class="toggle-line"></span></span></button>
      <a class="navbar-brand me-1 me-sm-3" href="index-2.html">
        <div class="d-flex align-items-center">
          <div class="d-flex align-items-center"><img src="<?php echo $path ?>/assets/img/icons/logo.png" alt="phoenix"
              width="27" />
            <p class="logo-text ms-2 d-none d-sm-block">Project Manager</p>
          </div>
        </div>
      </a>
    </div>
    <div class="search-box navbar-top-search-box d-none d-lg-block" style="width:25rem;">
      <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input
          class="form-control search-input fuzzy-search rounded-pill form-control-sm" type="search"
          placeholder="Search..." aria-label="Search" />
        <span class="fas fa-search search-box-icon"></span>
      </form>
      <div class="btn-close position-absolute end-0 top-50 translate-middle cursor-pointer shadow-none"
        data-bs-dismiss="search"><button class="btn btn-link btn-close-falcon p-0" aria-label="Close"></button></div>
    </div>
    <ul class="navbar-nav navbar-nav-icons flex-row">
      <li class="nav-item">
        <div class="theme-control-toggle fa-icon-wait px-2"><input
            class="form-check-input ms-0 theme-control-toggle-input" type="checkbox" data-theme-control="phoenixTheme"
            value="dark" id="themeControlToggle" /><label
            class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
            data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon"
              data-feather="moon"></span></label><label
            class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
            data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon"
              data-feather="sun"></span></label></div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="#" style="min-width: 2.5rem" role="button" data-bs-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside"><span data-feather="bell"
            style="height:20px;width:20px;"></span></a>
        <div
          class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
          id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
          <div class="card position-relative border-0">
            <div class="card-header p-2">
              <div class="d-flex justify-content-between">
                <h5 class="text-black mb-0">Notificatons</h5><button class="btn btn-link p-0 fs--1 fw-normal"
                  type="button">Mark all as read</button>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="scrollbar-overlay" style="height: 27rem;">
              </div>
            </div>
            <div class="card-footer p-0 border-top border-0">
              <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder" href="">Notification history</a>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button"
          data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
          <div class="avatar avatar-l ">
            <img class="rounded-circle " src="<?php echo $path ?>/assets/img/team/avatar.webp" alt="" />
          </div>
        </a>
        <div
          class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
          aria-labelledby="navbarDropdownUser">
          <div class="card position-relative border-0">
            <div class="card-body p-0">
              <div class="text-center pt-4 pb-3">
                <div class="avatar avatar-xl ">
                  <img class="rounded-circle " src="<?php echo $path; ?>/assets/img/team/avatar.webp" alt="" />
                </div>
                <h6 class="mt-2 text-black">
                  <?php echo $userData["name"]; ?>
                </h6>
              </div>
            </div>
            <div class="overflow-auto scrollbar" style="height: 10rem;">
              <ul class="nav d-flex flex-column mb-2 pb-1">
                <!-- <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/profile"> <span class="me-2 text-900" data-feather="user"></span><span>Profile</span></a></li> -->
                <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>/src/dashboard"><span
                      class="me-2 text-900" data-feather="pie-chart"></span>Dashboard</a></li>
                <!-- <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/help"> <span class="me-2 text-900" data-feather="help-circle"></span>Help Center</a></li> -->
              </ul>
            </div>
            <div class="card-footer p-0 border-top">
              <br>
              <div class="px-3"> <a class="btn btn-phoenix-secondary d-flex flex-center w-100"
                  href="<?php echo $path; ?>/auth/logout"> <span class="me-2" data-feather="log-out"> </span>Sign
                  out</a></div>
              <!-- <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1" href="<?php echo $path; ?>resource/instruction">Protal Instruction</a>&bull;</div> -->
              <br>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>
<nav class="navbar navbar-top navbar-slim fixed-top navbar-expand" id="topNavSlim" style="display:none;">
  <div class="collapse navbar-collapse justify-content-between">
    <div class="navbar-logo">
      <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
        data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse"
        aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
            class="toggle-line"></span></span></button>
      <a class="navbar-brand navbar-brand" href="">Personalized Skill</a>
    </div>
    <ul class="navbar-nav navbar-nav-icons flex-row">
      <li class="nav-item">
        <div class="theme-control-toggle fa-ion-wait pe-2 theme-control-toggle-slim"><input
            class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle" type="checkbox"
            data-theme-control="phoenixTheme" value="dark" /><label
            class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
            data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
              class="icon me-1 d-none d-sm-block" data-feather="moon"></span><span
              class="fs--1 fw-bold">Dark</span></label><label
            class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
            data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
              class="icon me-1 d-none d-sm-block" data-feather="sun"></span><span
              class="fs--1 fw-bold">Light</span></label></div>
      </li>
      <li class="nav-item"> <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchBoxModal"><span
            data-feather="search" style="height:12px;width:12px;"></span></a></li>
      <li class="nav-item dropdown">
        <a class="nav-link" id="navbarDropdownNotification" href="#" role="button" data-bs-toggle="dropdown"
          data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false"><span data-feather="bell"
            style="height:12px;width:12px;"></span></a>
        <div
          class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
          id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
          <div class="card position-relative border-0">
            <div class="card-header p-2">
              <div class="d-flex justify-content-between">
                <h5 class="text-black mb-0">Notificatons</h5><button class="btn btn-link p-0 fs--1 fw-normal"
                  type="button">Mark all as read</button>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="scrollbar-overlay" style="height: 27rem;">


              </div>
              <div class="card-footer p-0 border-top border-0">
                <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder"
                    href="notifications.html">Notification history</a></div>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0 white-space-nowrap" id="navbarDropdownUser" href="#!"
          role="button" data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="outside"
          aria-expanded="false">
          <?php echo $userData["name"]; ?><span class="fa-solid fa-chevron-down fs--2"></span>
        </a>
        <div
          class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
          aria-labelledby="navbarDropdownUser">
          <div class="card position-relative border-0">
            <div class="card-body p-0">
              <div class="text-center pt-4 pb-3">
                <div class="avatar avatar-xl ">
                  <img class="rounded-circle " src="<?php echo $path; ?>/assets/img/team/avatar.webp" alt="" />
                </div>
                <h6 class="mt-2 text-black">
                  <?php echo $userData["name"]; ?>
                </h6>
              </div>
            </div>
            <div class="overflow-auto scrollbar" style="height: 10rem;">
              <ul class="nav d-flex flex-column mb-2 pb-1">
                <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/profile"> <span
                      class="me-2 text-900" data-feather="user"></span><span>Profile</span></a></li>
                <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/SDashboard"><span
                      class="me-2 text-900" data-feather="pie-chart"></span>Dashboard</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/help"> <span
                      class="me-2 text-900" data-feather="help-circle"></span>Help Center</a></li>
              </ul>
            </div>
            <div class="card-footer p-0 border-top">
              <br>
              <div class="px-3"> <a class="btn btn-phoenix-secondary d-flex flex-center w-100"
                  href="<?php echo $path; ?>auth/logout.php"> <span class="me-2" data-feather="log-out"> </span>Sign
                  out</a></div>
              <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                  href="<?php echo $path; ?>resource/instruction">Protal Instruction</a>&bull;</div>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>
<nav class="navbar navbar-top fixed-top navbar-expand-lg" id="navbarTop" style="display:none;">
  <div class="navbar-logo">
    <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
      data-bs-toggle="collapse" data-bs-target="#navbarTopCollapse" aria-controls="navbarTopCollapse"
      aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
          class="toggle-line"></span></span></button>
    <a class="navbar-brand me-1 me-sm-3" href="<?php echo $path; ?>">
      <div class="d-flex align-items-center">
        <div class="d-flex align-items-center"><img src="<?php echo $path; ?>/assets/img/icons/logo.png" alt="phoenix"
            width="27" />
          <p class="logo-text ms-2 d-none d-sm-block">Personalized Skill</p>
        </div>
      </div>
    </a>
  </div>
  <div class="collapse navbar-collapse navbar-top-collapse order-1 order-lg-0 justify-content-center"
    id="navbarTopCollapse">
    <ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">

      <?php foreach ($group as $g) {
        echo "           
                 <li class='nav-item dropdown'><a class='nav-link dropdown-toggle lh-1' href='#!' role='button' data-bs-toggle='dropdown' data-bs-auto-close='outside' aria-haspopup='true' aria-expanded='false'><span class='uil fs-0 me-2 uil-chart-pie'></span>$g[res_group]</a>
                <ul class='dropdown-menu navbar-dropdown-caret'>";

        $result = mysqli_query(
          $db,
          "SELECT * FROM m_resource WHERE STATUS = '1' and res_group ='$g[res_group]' order by sort_id"
        );
        $menu = [];
        while ($row = mysqli_fetch_assoc($result)) {
          $menu[] = $row;
        }
        foreach ($menu as $m) {
          if ($rID == $m["id"]) {
            $active = "menu-active";
          } else {
            $active = "";
          }
          echo "
                    <li><a class='dropdown-item' href='$path/src/$m[link]'>
                            <div class='dropdown-item-wrapper'><span class='me-2 uil' data-feather='$m[img]'></span>$m[label]</div>
                        </a></li>";
        }

        echo "</ul>
            </li>";
      } ?>
    </ul>
  </div>
  <ul class="navbar-nav navbar-nav-icons flex-row">
    <li class="nav-item">
      <div class="theme-control-toggle fa-icon-wait px-2"><input
          class="form-check-input ms-0 theme-control-toggle-input" type="checkbox" data-theme-control="phoenixTheme"
          value="dark" id="themeControlToggle" /><label
          class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
          data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon"
            data-feather="moon"></span></label><label class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
          for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
            class="icon" data-feather="sun"></span></label></div>
    </li>
    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchBoxModal"><span
          data-feather="search" style="height:19px;width:19px;margin-bottom: 2px;"></span></a></li>
    <li class="nav-item dropdown">
      <a class="nav-link" href="#" style="min-width: 2.5rem" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside"><span data-feather="bell"
          style="height:20px;width:20px;"></span></a>
      <div
        class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
        id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
        <div class="card position-relative border-0">
          <div class="card-header p-2">
            <div class="d-flex justify-content-between">
              <h5 class="text-black mb-0">Notificatons</h5><button class="btn btn-link p-0 fs--1 fw-normal"
                type="button">Mark all as read</button>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="scrollbar-overlay" style="height: 27rem;">

            </div>
          </div>
          <div class="card-footer p-0 border-top border-0">
            <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder" href="">Notification history</a>
            </div>
          </div>
        </div>
      </div>
    </li>
    <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button"
        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
        <div class="avatar avatar-l ">
          <img class="rounded-circle " src="<?php echo $path; ?>/assets/img/team/avatar.webp" alt="" />
        </div>
      </a>
      <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
        aria-labelledby="navbarDropdownUser">
        <div class="card position-relative border-0">
          <div class="card-body p-0">
            <div class="text-center pt-4 pb-3">
              <div class="avatar avatar-xl ">
                <img class="rounded-circle " src="<?php echo $path; ?>/assets/img/team/avatar.webp" alt="" />
              </div>
              <h6 class="mt-2 text-black">
                <?php echo $_SESSION["isStudent"]
                  ? $userData["name"]
                  : $userData["f_name"]; ?>
              </h6>
            </div>
          </div>
          <div class="overflow-auto scrollbar" style="height: 10rem;">
            <ul class="nav d-flex flex-column mb-2 pb-1">
              <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/profile"> <span
                    class="me-2 text-900" data-feather="user"></span><span>Profile</span></a></li>
              <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/SDashboard"><span
                    class="me-2 text-900" data-feather="pie-chart"></span>Dashboard</a></li>
              <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/help"> <span
                    class="me-2 text-900" data-feather="help-circle"></span>Help Center</a></li>
            </ul>
          </div>
          <div class="card-footer p-0 border-top">
            <br>
            <div class="px-3"> <a class="btn btn-phoenix-secondary d-flex flex-center w-100"
                href="<?php echo $path; ?>auth/logout.php"> <span class="me-2" data-feather="log-out"> </span>Sign
                out</a></div>
            <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                href="<?php echo $path; ?>resource/instruction">Protal Instruction</a>&bull;</div>

          </div>
        </div>
    </li>
  </ul>
</nav>
<nav class="navbar navbar-top navbar-slim justify-content-between fixed-top navbar-expand-lg" id="navbarTopSlim"
  style="display:none;">
  <div class="navbar-logo">
    <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
      data-bs-toggle="collapse" data-bs-target="#navbarTopCollapse" aria-controls="navbarTopCollapse"
      aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
          class="toggle-line"></span></span></button>
    <a class="navbar-brand navbar-brand" href="<?php echo $path; ?>">Personalized Skill</a>
  </div>
  <div class="collapse navbar-collapse navbar-top-collapse order-1 order-lg-0 justify-content-center"
    id="navbarTopCollapse">
    <ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">
      <?php foreach ($group as $g) {
        echo "<li class='nav-item dropdown'><a class='nav-link dropdown-toggle lh-1' href='#!' role='button' data-bs-toggle='dropdown' data-bs-auto-close='outside' aria-haspopup='true' aria-expanded='false'><span class='uil fs-0 me-2 uil-chart-pie'></span>$g[res_group]</a>
           <ul class='dropdown-menu navbar-dropdown-caret'>";

        $result = mysqli_query(
          $db,
          "SELECT * FROM m_resource WHERE STATUS = '1' and res_group ='$g[res_group]' order by sort_id"
        );
        $menu = [];
        while ($row = mysqli_fetch_assoc($result)) {
          $menu[] = $row;
        }
        foreach ($menu as $m) {
          if ($rID == $m["id"]) {
            $active = "menu-active";
          } else {
            $active = "";
          }

          echo "<li><a class='dropdown-item' href='$path/src/$m[link]'>
                    <div class='dropdown-item-wrapper'><span class='me-2 uil' data-feather='$m[img]'></span>$m[label]</div>
                </a></li>";
        }
        echo "</ul></li>";
      } ?>
    </ul>
  </div>
  <ul class="navbar-nav navbar-nav-icons flex-row">
    <li class="nav-item">
      <div class="theme-control-toggle fa-ion-wait pe-2 theme-control-toggle-slim"><input
          class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle" type="checkbox"
          data-theme-control="phoenixTheme" value="dark" /><label
          class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
          data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
            class="icon me-1 d-none d-sm-block" data-feather="moon"></span><span
            class="fs--1 fw-bold">Dark</span></label><label
          class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
          data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
            class="icon me-1 d-none d-sm-block" data-feather="sun"></span><span
            class="fs--1 fw-bold">Light</span></label></div>
    </li>
    <li class="nav-item"> <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchBoxModal"><span
          data-feather="search" style="height:12px;width:12px;"></span></a></li>
    <li class="nav-item dropdown">
      <a class="nav-link" id="navbarDropdownNotification" href="#" role="button" data-bs-toggle="dropdown"
        data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false"><span data-feather="bell"
          style="height:12px;width:12px;"></span></a>
      <div
        class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
        id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
        <div class="card position-relative border-0">
          <div class="card-header p-2">
            <div class="d-flex justify-content-between">
              <h5 class="text-black mb-0">Notificatons</h5><button class="btn btn-link p-0 fs--1 fw-normal"
                type="button">Mark all as read</button>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="scrollbar-overlay" style="height: 27rem;">


            </div>
          </div>
          <div class="card-footer p-0 border-top border-0">
            <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder" href="">Notification history</a>
            </div>
          </div>
        </div>
      </div>
    </li>
    <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0 white-space-nowrap" id="navbarDropdownUser" href="#!"
        role="button" data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="outside" aria-expanded="false">
        <?php echo $_SESSION["isStudent"]
          ? $userData["name"]
          : $userData["f_name"]; ?><span class="fa-solid fa-chevron-down fs--2"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
        aria-labelledby="navbarDropdownUser">
        <div class="card position-relative border-0">
          <div class="card-body p-0">
            <div class="text-center pt-4 pb-3">
              <div class="avatar avatar-xl ">
                <img class="rounded-circle " src="<?php echo $path; ?>/assets/img/team/avatar.webp" alt="" />
              </div>
              <h6 class="mt-2 text-black">
                <?php echo $_SESSION["isStudent"]
                  ? $userData["name"]
                  : $userData["f_name"]; ?>
              </h6>
            </div>
          </div>
          <div class="overflow-auto scrollbar" style="height: 10rem;">
            <ul class="nav d-flex flex-column mb-2 pb-1">
              <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/profile"> <span
                    class="me-2 text-900" data-feather="user"></span><span>Profile</span></a></li>
              <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/SDashboard"><span
                    class="me-2 text-900" data-feather="pie-chart"></span>Dashboard</a></li>
              <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/help"> <span
                    class="me-2 text-900" data-feather="help-circle"></span>Help Center</a></li>
            </ul>
          </div>
          <div class="card-footer p-0 border-top">
            <br>
            <div class="px-3"> <a class="btn btn-phoenix-secondary d-flex flex-center w-100"
                href="<?php echo $path; ?>auth/logout.php"> <span class="me-2" data-feather="log-out"> </span>Sign
                out</a></div>
            <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                href="<?php echo $path; ?>resource/instruction">Protal Instruction</a>&bull;</div>

          </div>
        </div>
      </div>
    </li>
  </ul>
</nav>
<nav class="navbar navbar-top fixed-top navbar-expand-lg" id="navbarCombo" data-navbar-top="combo"
  data-move-target="#navbarVerticalNav" style="display:none;">
  <div class="navbar-logo">
    <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
      data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse"
      aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
          class="toggle-line"></span></span></button>
    <a class="navbar-brand me-1 me-sm-3" href="<?php echo $path; ?>">
      <div class="d-flex align-items-center">
        <div class="d-flex align-items-center"><img src="<?php echo $path; ?>/assets/img/icons/logo.png" alt="bit"
            width="27" />
          <p class="logo-text ms-2 d-none d-sm-block">Personalized Skill</p>
        </div>
      </div>
    </a>
  </div>
  <div class="collapse navbar-collapse navbar-top-collapse order-1 order-lg-0 justify-content-center"
    id="navbarTopCollapse">
    <ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">
      <?php foreach ($group as $g) {
        echo "<li class='nav-item dropdown'><a class='nav-link dropdown-toggle lh-1' href='#!' role='button' data-bs-toggle='dropdown' data-bs-auto-close='outside' aria-haspopup='true' aria-expanded='false'><span class='uil fs-0 me-2 uil-chart-pie'></span>$g[res_group]</a>";

        $result = mysqli_query(
          $db,
          "SELECT * FROM m_resource WHERE STATUS = '1' and res_group ='$g[res_group]' order by sort_id"
        );
        $menu = [];
        while ($row = mysqli_fetch_assoc($result)) {
          $menu[] = $row;
        }
        foreach ($menu as $m) {
          if ($rID == $m["id"]) {
            $active = "menu-active";
          } else {
            $active = "";
          }

          echo "<ul class='dropdown-menu navbar-dropdown-caret'>
                        <li><a class='dropdown-item' href='$path/src/$m[link]'>
                                <div class='dropdown-item-wrapper'><span class='me-2 uil' data-feather='$m[img]'></span>$m[label]</div>
                            </a></li>
                    </ul>";
        }

        echo "</li>";
      } ?>
    </ul>
  </div>
  <ul class="navbar-nav navbar-nav-icons flex-row">
    <li class="nav-item">
      <div class="theme-control-toggle fa-icon-wait px-2"><input
          class="form-check-input ms-0 theme-control-toggle-input" type="checkbox" data-theme-control="phoenixTheme"
          value="dark" id="themeControlToggle" /><label
          class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
          data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon"
            data-feather="moon"></span></label><label class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
          for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
            class="icon" data-feather="sun"></span></label></div>
    </li>
    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchBoxModal"><span
          data-feather="search" style="height:19px;width:19px;margin-bottom: 2px;"></span></a></li>
    <li class="nav-item dropdown">
      <a class="nav-link" href="#" style="min-width: 2.5rem" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside"><span data-feather="bell"
          style="height:20px;width:20px;"></span></a>
      <div
        class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
        id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
        <div class="card position-relative border-0">
          <div class="card-header p-2">
            <div class="d-flex justify-content-between">
              <h5 class="text-black mb-0">Notificatons</h5><button class="btn btn-link p-0 fs--1 fw-normal"
                type="button">Mark all as read</button>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="scrollbar-overlay" style="height: 27rem;">

            </div>
          </div>
          <div class="card-footer p-0 border-top border-0">
            <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder" href="">Notification history</a>
            </div>
          </div>
        </div>
      </div>
    </li>
    <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button"
        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
        <div class="avatar avatar-l ">
          <img class="rounded-circle " src="<?php echo $path; ?>/assets/img/team/avatar.webp" alt="" />
        </div>
      </a>
      <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
        aria-labelledby="navbarDropdownUser">
        <div class="card position-relative border-0">
          <div class="card-body p-0">
            <div class="text-center pt-4 pb-3">
              <div class="avatar avatar-xl ">
                <img class="rounded-circle " src="<?php echo $path; ?>/assets/img/team/avatar.webp" alt="" />
              </div>
              <h6 class="mt-2 text-black">
                <?php echo $_SESSION["isStudent"]
                  ? $userData["name"]
                  : $userData["f_name"]; ?>
              </h6>
            </div>
          </div>
          <div class="overflow-auto scrollbar" style="height: 10rem;">
            <ul class="nav d-flex flex-column mb-2 pb-1">
              <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/profile"> <span
                    class="me-2 text-900" data-feather="user"></span><span>Profile</span></a></li>
              <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/SDashboard"><span
                    class="me-2 text-900" data-feather="pie-chart"></span>Dashboard</a></li>
              <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/help"> <span
                    class="me-2 text-900" data-feather="help-circle"></span>Help Center</a></li>
            </ul>
          </div>
          <div class="card-footer p-0 border-top">
            <br>
            <div class="px-3"> <a class="btn btn-phoenix-secondary d-flex flex-center w-100"
                href="<?php echo $path; ?>auth/logout.php"> <span class="me-2" data-feather="log-out"> </span>Sign
                out</a></div>
            <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                href="<?php echo $path; ?>resource/instruction">Protal Instruction</a>&bull;</div>
          </div>
        </div>
      </div>
    </li>
  </ul>
</nav>
<nav class="navbar navbar-top fixed-top navbar-slim justify-content-between navbar-expand-lg" id="navbarComboSlim"
  data-navbar-top="combo" data-move-target="#navbarVerticalNav" style="display:none;">
  <div class="navbar-logo">
    <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
      data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse"
      aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
          class="toggle-line"></span></span></button>
    <a class="navbar-brand navbar-brand" href="<?php echo $path; ?>">Personalized Skill</a>
  </div>
  <div class="collapse navbar-collapse navbar-top-collapse order-1 order-lg-0 justify-content-center"
    id="navbarTopCollapse">
    <ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">
      <?php foreach ($group as $g) {
        echo "<li class='nav-item dropdown'><a class='nav-link dropdown-toggle lh-1' href='#!' role='button' data-bs-toggle='dropdown' data-bs-auto-close='outside' aria-haspopup='true' aria-expanded='false'><span class='uil fs-0 me-2 uil-chart-pie'></span>$g[res_group]</a>
                        <ul class='dropdown-menu navbar-dropdown-caret'>";

        $result = mysqli_query(
          $db,
          "SELECT * FROM m_resource WHERE STATUS = '1' and res_group ='$g[res_group]' order by sort_id"
        );
        $menu = [];

        while ($row = mysqli_fetch_assoc($result)) {
          $menu[] = $row;
        }
        foreach ($menu as $m) {
          if ($rID == $m["id"]) {
            $active = "menu-active";
          } else {
            $active = "";
          }
          echo "<li><a class='dropdown-item' href='$path/src/$m[link]'>
                            <div class='dropdown-item-wrapper'><span class='me-2 uil' data-feather='$m[img]'></span>$m[label]</div>
                        </a></li>";
        }

        echo "</ul>
                    </li>";
      } ?>
    </ul>
  </div>
  <ul class="navbar-nav navbar-nav-icons flex-row">
    <li class="nav-item">
      <div class="theme-control-toggle fa-ion-wait pe-2 theme-control-toggle-slim"><input
          class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle" type="checkbox"
          data-theme-control="phoenixTheme" value="dark" /><label
          class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
          data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
            class="icon me-1 d-none d-sm-block" data-feather="moon"></span><span
            class="fs--1 fw-bold">Dark</span></label><label
          class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
          data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span
            class="icon me-1 d-none d-sm-block" data-feather="sun"></span><span
            class="fs--1 fw-bold">Light</span></label></div>
    </li>
    <li class="nav-item"> <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchBoxModal"><span
          data-feather="search" style="height:12px;width:12px;"></span></a></li>
    <li class="nav-item dropdown">
      <a class="nav-link" id="navbarDropdownNotification" href="#" role="button" data-bs-toggle="dropdown"
        data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false"><span data-feather="bell"
          style="height:12px;width:12px;"></span></a>
      <div
        class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
        id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
        <div class="card position-relative border-0">
          <div class="card-header p-2">
            <div class="d-flex justify-content-between">
              <h5 class="text-black mb-0">Notificatons</h5><button class="btn btn-link p-0 fs--1 fw-normal"
                type="button">Mark all as read</button>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="scrollbar-overlay" style="height: 27rem;">
            </div>
          </div>
          <div class="card-footer p-0 border-top border-0">
            <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder" href="">Notification history</a>
            </div>
          </div>
        </div>
      </div>
    </li>
    <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0 white-space-nowrap" id="navbarDropdownUser" href="#!"
        role="button" data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="outside" aria-expanded="false">
        <?php echo $_SESSION["isStudent"]
          ? $userData["name"]
          : $userData["f_name"]; ?><span class="fa-solid fa-chevron-down fs--2"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
        aria-labelledby="navbarDropdownUser">
        <div class="card position-relative border-0">
          <div class="card-body p-0">
            <div class="text-center pt-4 pb-3">
              <div class="avatar avatar-xl ">
                <img class="rounded-circle " src="<?php echo $path; ?>/assets/img/team/avatar.webp" alt="" />
              </div>
              <h6 class="mt-2 text-black">
                <?php echo $_SESSION["isStudent"]
                  ? $userData["name"]
                  : $userData["f_name"]; ?>
              </h6>
            </div>
          </div>
          <div class="overflow-auto scrollbar" style="height: 10rem;">
            <ul class="nav d-flex flex-column mb-2 pb-1">
              <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/profile"> <span
                    class="me-2 text-900" data-feather="user"></span><span>Profile</span></a></li>
              <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/SDashboard"><span
                    class="me-2 text-900" data-feather="pie-chart"></span>Dashboard</a></li>
              <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/help"> <span
                    class="me-2 text-900" data-feather="help-circle"></span>Help Center</a></li>
            </ul>
          </div>
          <div class="card-footer p-0 border-top">
            <br>
            <div class="px-3"> <a class="btn btn-phoenix-secondary d-flex flex-center w-100"
                href="<?php echo $path; ?>auth/logout.php"> <span class="me-2" data-feather="log-out"> </span>Sign
                out</a></div>
            <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                href="<?php echo $path; ?>resource/instruction">Protal Instruction</a>&bull;</div>
          </div>
        </div>
      </div>
    </li>
  </ul>
</nav>
<nav class="navbar navbar-top fixed-top navbar-expand-lg" id="dualNav" style="display:none;">
  <div class="w-100">
    <div class="d-flex flex-between-center dual-nav-first-layer">
      <div class="navbar-logo">
        <button class="btn navbar-toggler navbar-toggler-humburger-icon hover-bg-transparent" type="button"
          data-bs-toggle="collapse" data-bs-target="#navbarTopCollapse" aria-controls="navbarTopCollapse"
          aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
              class="toggle-line"></span></span></button>
        <a class="navbar-brand me-1 me-sm-3" href="<?php echo $path ?>">
          <div class="d-flex align-items-center">
            <div class="d-flex align-items-center"><img src="<?php echo $path ?>/assets/img/icons/logo.png"
                alt="phoenix" width="27" />
              <p class="logo-text ms-2 d-none d-sm-block">Personalized Skill</p>
            </div>
          </div>
        </a>
      </div>
      <div class="search-box navbar-top-search-box d-none d-lg-block" style="width:25rem;">
        <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input
            class="form-control search-input fuzzy-search rounded-pill form-control-sm" type="search"
            placeholder="Search..." aria-label="Search" />
          <span class="fas fa-search search-box-icon"></span>
        </form>
        <div class="btn-close position-absolute end-0 top-50 translate-middle cursor-pointer shadow-none"
          data-bs-dismiss="search"><button class="btn btn-link btn-close-falcon p-0" aria-label="Close"></button></div>
      </div>
      <ul class="navbar-nav navbar-nav-icons flex-row">
        <li class="nav-item">
          <div class="theme-control-toggle fa-icon-wait px-2"><input
              class="form-check-input ms-0 theme-control-toggle-input" type="checkbox" data-theme-control="phoenixTheme"
              value="dark" id="themeControlToggle" /><label
              class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
              data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon"
                data-feather="moon"></span></label><label
              class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
              data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon"
                data-feather="sun"></span></label></div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" style="min-width: 2.5rem" role="button" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside"><span data-feather="bell"
              style="height:20px;width:20px;"></span></a>
          <div
            class="dropdown-menu dropdown-menu-end notification-dropdown-menu py-0 shadow border border-300 navbar-dropdown-caret"
            id="navbarDropdownNotfication" aria-labelledby="navbarDropdownNotfication">
            <div class="card position-relative border-0">
              <div class="card-header p-2">
                <div class="d-flex justify-content-between">
                  <h5 class="text-black mb-0">Notificatons</h5><button class="btn btn-link p-0 fs--1 fw-normal"
                    type="button">Mark all as read</button>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="scrollbar-overlay" style="height: 27rem;">
                </div>
              </div>
              <div class="card-footer p-0 border-top border-0">
                <div class="my-2 text-center fw-bold fs--2 text-600"><a class="fw-bolder" href="">Notification
                    history</a></div>
              </div>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown"><a class="nav-link lh-1 pe-0" id="navbarDropdownUser" href="#!" role="button"
            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
            <div class="avatar avatar-l ">
              <img class="rounded-circle " src="<?php echo $path ?>/assets/img/team/avatar.webp" alt="" />
            </div>
          </a>
          <div
            class="dropdown-menu dropdown-menu-end navbar-dropdown-caret py-0 dropdown-profile shadow border border-300"
            aria-labelledby="navbarDropdownUser">
            <div class="card position-relative border-0">
              <div class="card-body p-0">
                <div class="text-center pt-4 pb-3">
                  <div class="avatar avatar-xl ">
                    <img class="rounded-circle " src="<?php echo $path ?>/assets/img/team/avatar.webp" alt="" />
                  </div>
                  <h6 class="mt-2 text-black">
                    <?php echo $_SESSION["isStudent"]
                      ? $userData["name"]
                      : $userData["f_name"]; ?>
                  </h6>
                </div>
                <div class="mb-3 mx-3"><input class="form-control form-control-sm" id="statusUpdateInput" type="text"
                    placeholder="Update your status" /></div>
              </div>
              <div class="overflow-auto scrollbar" style="height: 10rem;">
                <ul class="nav d-flex flex-column mb-2 pb-1">
                  <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/profile"> <span
                        class="me-2 text-900" data-feather="user"></span><span>Profile</span></a></li>
                  <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/SDashboard"><span
                        class="me-2 text-900" data-feather="pie-chart"></span>Dashboard</a></li>
                  <li class="nav-item"><a class="nav-link px-3" href="<?php echo $path; ?>resource/help"> <span
                        class="me-2 text-900" data-feather="help-circle"></span>Help Center</a></li>
                </ul>
              </div>
              <div class="card-footer p-0 border-top">
                <br>
                <div class="px-3"> <a class="btn btn-phoenix-secondary d-flex flex-center w-100"
                    href="<?php echo $path; ?>auth/logout.php"> <span class="me-2" data-feather="log-out"> </span>Sign
                    out</a></div>
                <div class="my-2 text-center fw-bold fs--2 text-600"><a class="text-600 me-1"
                    href="<?php echo $path; ?>resource/instruction">Protal Instruction</a>&bull;</div>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
    <div class="collapse navbar-collapse navbar-top-collapse justify-content-center" id="navbarTopCollapse">
      <ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">
        <?php

        foreach ($group as $g) {
          echo "        <li class='nav-item dropdown'><a class='nav-link dropdown-toggle lh-1' href='#!' role='button' data-bs-toggle='dropdown' data-bs-auto-close='outside' aria-haspopup='true' aria-expanded='false'><span class='uil fs-0 me-2 uil-chart-pie'></span>$g[res_group]</a>
            <ul class='dropdown-menu navbar-dropdown-caret'>";

          $result = mysqli_query(
            $db,
            "SELECT * FROM m_resource WHERE STATUS = '1' and res_group ='$g[res_group]' order by sort_id"
          );
          $menu = [];
          while ($row = mysqli_fetch_assoc($result)) {
            $menu[] = $row;
          }
          foreach ($menu as $m) {
            if ($rID == $m["id"]) {
              $active = "menu-active";
            } else {
              $active = "";
            }

            echo "<li><a class='dropdown-item' href='$path/src/$m[link]'>
                          <div class='dropdown-item-wrapper'><span class='me-2 uil' data-feather='$m[img]'></span>$m[label]</div>
                      </a></li>";
          }

          echo "</ul>
          </li>";
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
<div class="modal fade" id="searchBoxModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="true"
  data-phoenix-modal="data-phoenix-modal" style="--phoenix-backdrop-opacity: 1">
  <div class="modal-dialog">
    <div class="modal-content mt-15 rounded-pill">
      <div class="modal-body p-0">
        <div class="search-box navbar-top-search-box" data-list='{"valueNames":["title"]}' style="width: auto">
          <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
            <input class="form-control search-input fuzzy-search rounded-pill form-control-lg" type="search"
              placeholder="Search..." aria-label="Search" />
            <span class="fas fa-search search-box-icon"></span>
          </form>
          <div class="btn-close position-absolute end-0 top-50 translate-middle cursor-pointer shadow-none"
            data-bs-dismiss="search">
            <button class="btn btn-link btn-close-falcon p-0" aria-label="Close"></button>
          </div>
          <div class="dropdown-menu border border-300 font-base start-0 py-0 overflow-hidden w-100">
            <div class="scrollbar-overlay" style="max-height: 30rem">
              <div class="list pb-3">
                <hr class="text-200 my-0" />
                <h6 class="dropdown-header text-1000 fs--1 border-bottom border-200 py-2 lh-sm">
                  Recently Searched
                </h6>
              </div>
              <div class="text-center">
                <p class="fallback fw-bold fs-1 d-none">
                  No Result Found.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  var navbarTopShape = window.config.config.phoenixNavbarTopShape;
  var navbarPosition = window.config.config.phoenixNavbarPosition;
  var body = document.querySelector("body");
  var navbarDefault = document.querySelector("#navbarDefault");
  var navbarTop = document.querySelector("#navbarTop");
  var topNavSlim = document.querySelector("#topNavSlim");
  var navbarTopSlim = document.querySelector("#navbarTopSlim");
  var navbarCombo = document.querySelector("#navbarCombo");
  var navbarComboSlim = document.querySelector("#navbarComboSlim");
  var dualNav = document.querySelector("#dualNav");

  var documentElement = document.documentElement;
  var navbarVertical = document.querySelector(".navbar-vertical");

  if (navbarPosition === "dual-nav") {
    topNavSlim.remove();
    navbarTop.remove();
    navbarVertical.remove();
    navbarTopSlim.remove();
    navbarCombo.remove();
    navbarComboSlim.remove();
    navbarDefault.remove();
    dualNav.removeAttribute("style");
    documentElement.classList.add("dual-nav");
  } else if (navbarTopShape === "slim" && navbarPosition === "vertical") {
    navbarDefault.remove();
    navbarTop.remove();
    navbarTopSlim.remove();
    navbarCombo.remove();
    navbarComboSlim.remove();
    topNavSlim.style.display = "block";
    navbarVertical.style.display = "inline-block";
    body.classList.add("nav-slim");
  } else if (
    navbarTopShape === "slim" &&
    navbarPosition === "horizontal"
  ) {
    navbarDefault.remove();
    navbarVertical.remove();
    navbarTop.remove();
    topNavSlim.remove();
    navbarCombo.remove();
    navbarComboSlim.remove();
    navbarTopSlim.removeAttribute("style");
    body.classList.add("nav-slim");
  } else if (navbarTopShape === "slim" && navbarPosition === "combo") {
    navbarDefault.remove();
    //- navbarVertical.remove();
    navbarTop.remove();
    topNavSlim.remove();
    navbarCombo.remove();
    navbarTopSlim.remove();
    navbarComboSlim.removeAttribute("style");
    navbarVertical.removeAttribute("style");
    body.classList.add("nav-slim");
  } else if (
    navbarTopShape === "default" &&
    navbarPosition === "horizontal"
  ) {
    navbarDefault.remove();
    topNavSlim.remove();
    navbarVertical.remove();
    navbarTopSlim.remove();
    navbarCombo.remove();
    navbarComboSlim.remove();
    navbarTop.removeAttribute("style");
    documentElement.classList.add("navbar-horizontal");
  } else if (navbarTopShape === "default" && navbarPosition === "combo") {
    topNavSlim.remove();
    navbarTop.remove();
    navbarTopSlim.remove();
    navbarDefault.remove();
    navbarComboSlim.remove();
    navbarCombo.removeAttribute("style");
    navbarVertical.removeAttribute("style");
    documentElement.classList.add("navbar-combo");
  } else {
    topNavSlim.remove();
    navbarTop.remove();
    navbarTopSlim.remove();
    navbarCombo.remove();
    navbarComboSlim.remove();
    navbarDefault.removeAttribute("style");
    navbarVertical.removeAttribute("style");
  }

  var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
  var navbarTop = document.querySelector(".navbar-top");
  if (navbarTopStyle === "darker") {
    navbarTop.classList.add("navbar-darker");
  }

  var navbarVerticalStyle =
    window.config.config.phoenixNavbarVerticalStyle;
  var navbarVertical = document.querySelector(".navbar-vertical");
  if (navbarVerticalStyle === "darker") {
    navbarVertical.classList.add("navbar-darker");
  }
</script>