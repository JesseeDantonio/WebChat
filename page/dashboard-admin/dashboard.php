<?php

use Index\php\classes\{VerifyIdentification, AutoLoading};

require(__DIR__ . "/../../php/classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const VERIFY_IDENTIFICATION = new VerifyIdentification();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {

    if (isset($_SESSION["userProfile"])) {
        $profile = unserialize($_SESSION["userProfile"]);
    } else {
        $profile = null;
    }

    VERIFY_IDENTIFICATION->isProfileNotVerified($profile, "../../index.php");
    VERIFY_IDENTIFICATION->isNotAdministrator($profile, "../../index.php");
} catch (\Throwable $th) {
    //throw $th;
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Nucleo Icons -->
    <link href="./../../css/nucleo-icons.css" rel="stylesheet" />
    <link href="./../../css/nucleo-svg.css" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="./../../css/soft-ui-dashboard-tailwind.css?v=1.0.4" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./../../js/ResponsiveDesign.js"></script>
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
                    <i class='fa-solid fa-user-astronaut' style="color: #DC24DC;"></i>
                </a>
                <button class="navbar-close">
                    <i class='fa fa-close' style="color: gray; font-size: 35px;"></i>
                </button>
            </div>
            <div>
                <ul>
                    <li class="mb-1">
                        <a class="block p-4 text-sm font-semibold text-gray-400 hover:bg-violet-50 hover:text-violet-600 rounded" href="./../dashboard-user/dashboard.php">Dashboard User</a>
                    </li>
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
                <i class='fa-solid fa-user-astronaut' style="font-size: 30px;"></i>
                <span class="ml-4 font-semibold transition-all duration-200 ease-nav-brand uppercase">panel admin</span>
            </a>
        </div>

        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

        <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
            <ul class="flex flex-col pl-0 mb-0">
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors" href="#">
                        <div class="bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class='fa-solid fa-house' style="color:white"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
                    </a>
                </li>

                <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="./../dashboard-user/dashboard.php">
                        <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class='fas fa-sign-out-alt'></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard User</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full flex justify-center">
                    <a class="inline-block w-1/2 px-6 py-3 my-4 font-bold text-center text-white uppercase align-middle transition-all ease-in border-0 rounded-lg select-none shadow-soft-md bg-150 bg-x-25 leading-pro text-xs bg-gradient-to-tl from-purple-700 to-red-500 hover:shadow-soft-2xl hover:scale-102" href="./../../php/controller/logout_processing.php">Log-out</a>
                </li>
    </aside>

    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">


        <!-- cards -->
        <div class="w-full px-6 py-6 mx-auto">
            <!-- row 1 -->
            <div class="flex flex-wrap -mx-3">

                <!-- card1 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex justify-between flex-row -mx-3">
                                <div class="flex px-4">
                                    <p class="font-bold pt-2">Users</p>
                                </div>
                                <div class="flex px-4">
                                    <button class="bg-violet-500 hover:bg-violet-600 text-white font-bold py-2 px-4 rounded">
                                        <a href="./list-users.php">
                                            Enter
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card2 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex justify-between flex-row -mx-3">
                                <div class="flex px-4">
                                    <p class="font-bold pt-2">Administrators</p>
                                </div>
                                <div class="flex px-4">
                                    <button class="bg-violet-500 hover:bg-violet-600 text-white font-bold py-2 px-4 rounded">
                                        <a href="./list-administrators.php">
                                            Enter
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card2 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex justify-between flex-row -mx-3">
                                <div class="flex px-4">
                                    <p class="font-bold pt-2">Reports</p>
                                </div>
                                <div class="flex px-4">
                                    <button class="bg-violet-500 hover:bg-violet-600 text-white font-bold py-2 px-4 rounded">
                                        <a href="./list-reports.php">
                                            Enter
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card2 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex justify-between flex-row -mx-3">
                                <div class="flex px-4">
                                    <p class="font-bold pt-2">Bans</p>
                                </div>
                                <div class="flex px-4">
                                    <button class="bg-violet-500 hover:bg-violet-600 text-white font-bold py-2 px-4 rounded">
                                        <a href="./list-bans.php">
                                            Enter
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>
    <script>
        const RESPONSIVE_DESIGN = new ResponsiveDesign();
    </script>
</body>

</html>