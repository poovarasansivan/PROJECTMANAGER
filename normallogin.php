<?php
include '../../includes/init.php';
$path = $GLOBALS['_path'];
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<title>Login</title>
<?php head(); ?>

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<body>

   <main class="main" id="top">
      <div class="container-fluid bg-300 dark__bg-1200">
         <div class="bg-holder bg-auth-card-overlay"
            style="background-image:url(<?php echo $path ?>/assets/img/bg/37.png);"></div>
         <div class="row flex-center position-relative min-vh-100 g-0 py-5">
            <div class="col-11 col-sm-10 col-xl-8">
               <div class="card border border-200 auth-card">
                  <div class="card-body pe-md-0">
                     <div class="row align-items-center gx-0 gy-7">
                        <div
                           class="col-auto bg-100 dark__bg-1100 rounded-3 position-relative overflow-hidden auth-title-box">
                           <div class="bg-holder"
                              style="background-image:url(<?php echo $path ?>/assets/img/bg/38.png);"></div>
                           <div
                              class="position-relative px-4 px-lg-7 pt-7 pb-7 pb-sm-5 text-center text-md-start pb-lg-7 pb-md-7">
                              <h3 id="hea" class="mb-3 text-black fs-1">Project Management</h3>
                              <p class="text-700">it's not just about the numbers, but the story they tell and the
                                 decisions they empower!</p>

                           </div>
                           <div class="position-relative z-index--1 mb-6 d-none d-md-block text-center mt-md-15"><img
                                 class="auth-title-box-img d-dark-none"
                                 src="<?php echo $path ?>//assets/img/spot-illustrations/auth.png" alt="" /><img
                                 class="auth-title-box-img d-light-none"
                                 src="<?php echo $path ?>//assets/img/spot-illustrations/auth-dark.png" alt="" /></div>
                        </div>
                        <div class="col mx-auto">
                           <div class="auth-form-box">
                              <div class="text-center mb-7">
                                 <a class="d-flex flex-center text-decoration-none mb-4"
                                    href="<?php echo $path ?>//index-2.html">
                                    <div class="d-flex align-items-center fw-bolder fs-5 d-inline-block"><img
                                          src="<?php echo $path ?>//assets/img/icons/logo.png" alt="phoenix"
                                          width="58" /></div>
                                 </a>
                                 <h3 class="text-1000">Sign In</h3>
                                 <p class="text-700">Get access to your account</p>
                              </div>
                              <div class="position-relative">
                                 <hr class="bg-200 mt-5 mb-4" />
                              </div>
                              <div class="mb-3 text-start">
                                 

                                    <input type="hidden" id="action" value="login">
                                    <label class="form-label" for="User_Id">user id</label>
                                    <div class="form-icon-container"><input class="form-control form-icon-input"
                                          id="username" type="text" placeholder="name" /><span
                                          class="fas fa-user text-900 fs--1 form-icon"></span></div>
                              </div>
                              <div class="mb-3 text-start">
                                 <label class="form-label" for="password">Password</label>
                                 <div class="form-icon-container"><input class="form-control form-icon-input"
                                       id="password" type="password" placeholder="Password" /><span
                                       class="fas fa-key text-900 fs--1 form-icon"></span></div>
                              </div>

                              <button id="btn" onclick="submitdata()" class="btn btn-primary w-100 mb-3">Sign
                                 In</button>

                              <!-- <button class="btn btn-primary w-100 mb-3" onclick="loginWithGoogle();">Login with Google</button> -->

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </main>

   <?php script(); ?>
</body>
<script>

   function submitdata() {
      $.ajax({
         url: 'api/login.php',
         method: 'post',
         data: {
            "username": $('#username').val(),
            "password": $('#password').val(),
         },
         dataType: 'json',
         success: function (result) {
            console.log(result)
            if (result.success) {
               window.location.href = result.starting;
            } else {
               window.location.href = window.location.href + '?error=' + result.message;
            }
         },
         error: function (error) {
            console.log
            window.location.href = window.location.href + '?error=Connection Error';
         }
      });
   }
</script>

</html>