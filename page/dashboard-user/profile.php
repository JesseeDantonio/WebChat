<?php

use Index\php\classes\{DataBaseConnect, DataBaseRequest, VerifyIdentification, AutoLoading};

require(__DIR__ . "/../../php/classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const DATABASE_CONNECT = new DataBaseConnect();
$dataBaseRequest = new DataBaseRequest(DATABASE_CONNECT->getLink());
$verifyIdentification = new VerifyIdentification();

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$response = $verifyIdentification->start();

$verifyIdentification->isProfileNotVerified($response, "../../index.php");

$permission = $response->getPermission();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Main Styling -->
  <script type="module" src="./../../js/events/profile.js"></script>
  <link href="./../../css/soft-ui-dashboard-tailwind.css" rel="stylesheet" />
</head>

<body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">

  <nav class="relative px-4 flex justify-end items-center">
    <div class="xl:hidden">
      <button class="navbar-burger flex items-center text-violet-500 p-3">
        <title>Mobile menu</title>
        <i class='fa-solid fa-bars' style="font-size: 30px;"></i>
      </button>
    </div>
  </nav>

  <div class="navbar-menu relative z-50 hidden">
    <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
    <nav class="fixed top-0 right-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-white border-r overflow-y-auto">
      <div class="flex items-center mb-8">
        <a class="mr-auto text-3xl font-bold leading-none" href="#">
          <i class='fa-solid fa-user'></i>
        </a>
        <button class="navbar-close">
          <i class='fa fa-close' style="font-size: 35px;"></i>
        </button>
      </div>
      <div>
        <ul>
          <li>
            <a class="block p-4 m-1 text-sm font-semibold text-gray-400 hover:bg-violet-50 hover:text-violet-500 rounded" href="./dashboard.php">Dashboard</a>
          </li>
          <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
          <?php if ($permission) { ?>

            <li>
              <a class="block p-4 m-1 text-sm font-semibold text-gray-400 hover:bg-violet-50 hover:text-violet-500 rounded" href="./../dashboard-admin/dashboard.php">Dashboard Admin</a>
            </li>

          <?php } ?>
        </ul>
      </div>
      <div class="mt-auto">
        <div class="flex justify-center pt-6">
          <a class=" inline-block w-1/2 px-6 py-3 my-4 font-bold text-center text-white uppercase align-middle transition-all ease-in border-0 rounded-lg select-none shadow-soft-md bg-150 bg-x-25 leading-pro text-xs bg-gradient-to-tl from-purple-700 to-red-500 hover:shadow-soft-2xl hover:scale-102" href="./../php/controller/logout_processing.php">Log-out</a>
        </div>
      </div>
    </nav>
  </div>

  <aside class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
    <div class="h-19.5">
      <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden" sidenav-close></i>
      <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="#">
        <i class='fa fa-user' style="font-size: 30px;"></i>
        <span class="ml-4 font-semibold transition-all duration-200 ease-nav-brand uppercase">panel user</span>
      </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

    <!-- change h-sidenav-no-pro to h-sidenav when pro is up -->
    <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
      <ul class="flex flex-col pl-0 mb-0">

        <li class="mt-0.5 w-full">
          <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="./dashboard.php">
            <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
              <i class='fa-solid fa-house'></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
          </a>
        </li>

        <li class="mt-0.5 w-full">
          <a class="py-2.7 text-sm shadow-soft-xl ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors" href="#">
            <div class="bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
              <i class='fa fa-user' style="color: white;"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Profile</span>
          </a>
        </li>

        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

        <?php if ($permission) { ?>

          <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="./../dashboard-admin/dashboard.php">
              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                <i class='fas fa-sign-in-alt'></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard Admin</span>
            </a>
          </li>

        <?php } ?>

        <li class="mt-0.5 w-full flex justify-center">
          <a class=" inline-block w-1/2 px-6 py-3 my-4 font-bold text-center text-white uppercase align-middle transition-all ease-in border-0 rounded-lg select-none shadow-soft-md bg-150 bg-x-25 leading-pro text-xs bg-gradient-to-tl from-purple-700 to-red-500 hover:shadow-soft-2xl hover:scale-102" href="./../../php/controller/logout_processing.php">Log-out</a>
        </li>
  </aside>

  <div class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen bg-gray-50 transition-all duration-200">

    <div class="w-full px-6 mx-auto">
      <div class="relative flex items-center p-0 mt-6 overflow-hidden bg-center bg-cover min-h-75 rounded-2xl" style="background-image: url('../../assets/img/curved-images/curved0.jpg'); background-position-y: 50%">
        <span class="absolute inset-y-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-purple-700 to-pink-500 opacity-60"></span>
      </div>
      <div class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 -mt-16 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
        <div class="flex flex-wrap -mx-3">
          <div class="flex-none w-auto max-w-full px-3">
            <div class="text-base ease-soft-in-out h-18.5 w-18.5 relative inline-flex items-center justify-center rounded-xl text-white transition-all duration-200">

              <?php if ($response->getPathImage() != null) { ?>
                <img src="<?= $response->getPathImage() ?>" alt="profile_image" class="w-full shadow-soft-sm rounded-xl" />
              <?php } else { ?>
                <img src="../../assets/img/default.jpg" alt="profile_image" class="w-full shadow-soft-sm rounded-xl" />
              <?php } ?>

            </div>
          </div>
          <div class="flex-none w-auto max-w-full px-3 my-auto">
            <div class="h-full">
              <h6 class="mb-1 text-2xl font-bold"><?= $response->getUsername() ?></h6>
              <p class="mb-0 font-semibold leading-normal text-sm">
                <?= $response->getEmail() ?>
              </p>
            </div>
          </div>
          <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
            <div class="relative right-0">
              <ul class="relative flex flex-wrap p-1 list-none bg-transparent rounded-xl" nav-pills role="tablist">

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full p-6 mx-auto">
      <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 xl:w-4/12">
          <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
              <h6 class="font-bold leading-tight uppercase text-xs text-slate-500">Change username</h6>
              <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                <li class="relative block px-0 py-2 bg-white border-0 rounded-t-lg text-inherit">

                  <form class="w-full max-w-sm" action="./../../php/controller/processingUser/username_update_processing.php" method="post">
                    <div class="flex items-center border-b border-violet-500 py-2">
                      <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" required="required" name="form_change_username" type="text" placeholder="Username" aria-label="username">
                      <button class="flex-shrink-0 bg-violet-500 hover:bg-violet-600 hover:border-violet-600 border-violet-500 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                        Confirm
                      </button>
                    </div>
                  </form>
                </li>
                <li class="relative block px-0 py-2 bg-white border-0 rounded-t-lg text-inherit">
                  <h6 class="font-bold leading-tight uppercase text-xs text-slate-500">Change Password</h6>
                  <form class="w-full max-w-sm" action="./../../php/controller/processingUser/password_update_processing.php" method="post">
                    <div class="flex items-center border-b border-violet-500 py-2">
                      <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" required="required" minlength="8" maxlength="100" name="form_change_old_password" type="password" placeholder="Old password" aria-label="password">
                      <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" required="required" minlength="8" maxlength="100" name="form_change_new_password" type="password" placeholder="New password" aria-label="password">
                      <button class="flex-shrink-0 bg-violet-500 hover:bg-violet-600 hover:border-violet-600 border-violet-500 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                        Confirm
                      </button>
                    </div>
                  </form>
                </li>
                <li>
                  <h6 class="font-bold leading-tight uppercase text-xs text-slate-500">Change E-mail</h6>
                  <form class="w-full max-w-sm" action="./../../php/controller/processing-user/email_update_processing.php" method="post">
                    <div class="flex items-center border-b border-violet-500 py-2">
                      <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" required="required" maxlength="100" name="form_update_new_email" type="email" placeholder="Email" aria-label="email">
                      <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" required="required" minlength="8" maxlength="100" name="form_update_email_password" type="password" placeholder="Password" aria-label="password">
                      <button class="flex-shrink-0 bg-violet-500 hover:bg-violet-600 hover:border-violet-600 border-violet-500 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                        Confirm
                      </button>
                    </div>
                  </form>
                </li>
                <li class="relative block px-0 py-2 bg-white border-0 rounded-t-lg text-inherit">
                  <h6 class="font-bold leading-tight uppercase text-xs text-slate-500">Delete Account</h6>
                  <form class="w-full max-w-sm" action="./../../php/controller/processingUser/delete_account_processing.php" method="post">
                    <div class="flex items-center border-b border-violet-500 py-2">
                      <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" required="required" minlength="8" maxlength="100" name="form_delete_password" type="password" placeholder="Password" aria-label="password">
                      <button class="flex-shrink-0 bg-violet-500 hover:bg-violet-600 hover:border-violet-600 border-violet-500 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                        Confirm
                      </button>
                    </div>
                  </form>
                </li>
                <li class="relative block px-0 py-2 bg-white border-0 rounded-t-lg text-inherit">
                  <h6 class="font-bold leading-tight uppercase text-xs text-slate-500">Update image</h6>
                  <form class="w-full max-w-sm" action="./../../php/controller/processingUser/img_update_processing.php" method="post" enctype="multipart/form-data">
                    <div class="flex items-center border-b border-violet-500 py-2">
                      <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" required="required" name="form_update_image" type="file" aria-label="Image file">
                      <button class="flex-shrink-0 bg-violet-500 hover:bg-violet-600 hover:border-violet-600 border-violet-500 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                        Confirm
                      </button>
                    </div>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-4/12">
          <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
              <div class="flex flex-wrap -mx-3">
                <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                  <h6 class="mb-0">Profile Information</h6>
                </div>
                <div class="w-full max-w-full px-3 text-right shrink-0 md:w-4/12 md:flex-none">
                  <a href="javascript:;" data-target="tooltip_trigger" data-placement="top">
                    <i class="leading-normal fas fa-user-edit text-sm text-slate-400"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="flex-auto p-4">
              <!-- <hr class="h-px my-6 bg-transparent bg-gradient-to-r from-transparent via-white to-transparent" /> -->
              <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                  <h6 class="font-bold leading-tight text-xl text-slate-500">Registration_at : <span class="font-normal"><?= $response->getREGISTRATION_DATE() ?></span></h6>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <footer class="pt-4">
        <div class="w-full px-6 mx-auto">
          <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
            <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
              <!-- -->
            </div>
            <div class="w-full max-w-full px-3 mt-0 shrink-0 lg:w-1/2 lg:flex-none">
              <ul class="flex flex-wrap justify-center pl-0 mb-0 list-none lg:justify-end">
                <li class="nav-item">
                  <a href="#" class="block px-4 pt-0 pb-1 font-normal transition-colors ease-soft-in-out text-sm text-slate-500" target="_blank">About Us</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
</body>

</html>