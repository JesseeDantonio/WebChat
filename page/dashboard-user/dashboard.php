<?php

use Index\php\classes\{ VerifyIdentification, AutoLoading };

require(__DIR__ . "/../../php/classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
$verifyIdentification = new VerifyIdentification();

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$response = $verifyIdentification->start();

$verifyIdentification->isProfileNotVerified($response, "../../index.php");

$permission = $response->getPermission();


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Nucleo Icons -->
  <link href="./../../css/nucleo-icons.css" rel="stylesheet" />
  <link href="./../../css/nucleo-svg.css" rel="stylesheet" />
  <!-- Main Styling -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="./../../css/soft-ui-dashboard-tailwind.css?v=1.0.4" rel="stylesheet" />
  <script type="module" src="./../../js/events/dashboard.js"></script>
</head>

<body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">

  <div class='loading h-1 w-[0%] bg-violet-500 transition-all duration-200 absolute z-40 top-0 '></div>

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
            <a class="block p-4 m-1 text-sm font-semibold text-gray-400 hover:bg-violet-50 hover:text-violet-600 rounded" href="./../dashboard-user/profile.php">Profile</a>
          </li>
          <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
          <?php if ($permission) { ?>
            <li>
              <a class="block p-4 m-1 text-sm font-semibold text-gray-400 hover:bg-violet-50 hover:text-violet-600 rounded" href="./../dashboard-admin/dashboard.php">Dashboard Admin</a>
            </li>
          <?php } ?>
        </ul>
      </div>
      <div class="mt-auto">
        <div class="flex justify-center pt-6">
          <a class=" inline-block w-1/2 px-6 py-3 my-4 font-bold text-center text-white uppercase align-middle transition-all ease-in border-0 rounded-lg select-none shadow-soft-md bg-150 bg-x-25 leading-pro text-xs bg-gradient-to-tl from-purple-700 to-red-500 hover:shadow-soft-2xl hover:scale-102" href="./../../php/controller/logout_processing.php">Log-out</a>
        </div>
      </div>
    </nav>
  </div>

  <!-- sidenav  -->
  <aside class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
    <div class="h-19.5">
      <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden" sidenav-close></i>
      <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="#">
        <i class='fa fa-user' style="font-size: 30px;"></i> <span class="ml-4 font-semibold transition-all duration-200 ease-nav-brand">PANEL USER</span>
      </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

    <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
      <ul class="flex flex-col pl-0 mb-0">
        <li class="mt-0.5 w-full">
          <a class="py-2.7 shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors" href="#">
            <div class="bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
              <i class='fa-solid fa-house' style="color:white"></i>
              <title>Dashboard</title>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
          </a>
        </li>

        <li class="mt-0.5 w-full">
          <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="./profile.php">
            <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
              <i class='fa fa-user'></i>
              <title>Profile</title>
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
          <a class="inline-block w-1/2 px-6 py-3 my-4 font-bold text-center text-white uppercase align-middle transition-all ease-in border-0 rounded-lg select-none shadow-soft-md bg-150 bg-x-25 leading-pro text-xs bg-gradient-to-tl from-purple-700 to-red-500 hover:shadow-soft-2xl hover:scale-102" href="./../../php/controller/logout_processing.php">Log-out</a>
        </li>
      </ul>
    </div>
  </aside>

  <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">

    <div class="flex flex-wrap mt-6 mx-3">

      <div class="w-full max-w-full px-3 mb-3">
        <div id="scroll-overflow" class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border h-[40rem] overflow-auto">
          <div class="flex-auto p-4">
            <div id="messages-container">

              <?php require("./../../php/controller/get_messages_processing.php") ?>

            </div>
          </div>
        </div>
      </div>

      <div class="w-full max-w-full px-3">
        <div class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
          <div class="flex-auto p-4">

            <div class="w-full">

              <div class="flex items-center border-b border-violet-500">
                <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" required="required" type="text" autocomplete="off" id="content" placeholder="Write your message !" aria-label="message" maxlength="1000">
                <button id="sendButton" class="flex-shrink-0 bg-violet-500 hover:bg-violet-600 hover:border-violet-600 border-violet-500 text-sm border-4 text-white py-1 px-2 rounded">
                  Send
                </button>
              </div>

            </div>

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
                <a href="#" class="block px-4 pt-0 pb-1 font-normal transition-colors ease-soft-in-out text-sm text-slate-500">About Us</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </main>

</body>

</html>