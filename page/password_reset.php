<?php

use Index\php\classes\{ DataBaseConnect, DataBaseRequest, VerifyIdentification, AutoLoading };

require(__DIR__ . "/../php/classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const VERIFY_IDENTIFICATION = new VerifyIdentification();
const DATABASE_CONNECT = new DataBaseConnect();
$dataBaseRequest = new DataBaseRequest(DATABASE_CONNECT->getLink());

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = VERIFY_IDENTIFICATION->start();

VERIFY_IDENTIFICATION->isProfileVerified($response, "../php/controller/logout_processing.php");

if (!isset($_GET['tu']) || !isset($_GET['t']) || empty($_GET['tu']) || empty($_GET['t'])) {
    header("Location: " . "../index.php");
    return;
}

$row = $dataBaseRequest->existTokens(base64_decode($_GET['t']), base64_decode($_GET['tu']));

if(!$row){
    header("Location: " . "../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="./../assets/img/apple-icon.png" />
    <title>Password Reset</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <!-- Nucleo Icons -->
    <link href="./../css/nucleo-icons.css" rel="stylesheet" />
    <link href="./../css/nucleo-svg.css" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="./../css/soft-ui-dashboard-tailwind.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500">

    <!-- Navbar -->
    <nav class="absolute top-0 z-30 flex flex-wrap items-center justify-between w-full px-4 py-2 mt-6 mb-4 shadow-none lg:flex-nowrap lg:justify-start">
        <div class="container flex items-center justify-between py-0 flex-wrap-inherit">
            <button navbar-trigger class="px-3 py-1 ml-2 leading-none transition-all bg-transparent border border-transparent border-solid rounded-lg shadow-none cursor-pointer text-lg ease-soft-in-out lg:hidden" type="button" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="inline-block mt-2 align-middle bg-center bg-no-repeat bg-cover w-6 h-6 bg-none">
                    <span bar1 class="w-5.5 rounded-xs duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
                    <span bar2 class="w-5.5 rounded-xs mt-1.75 duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
                    <span bar3 class="w-5.5 rounded-xs mt-1.75 duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
                </span>
            </button>
            <div navbar-menu class="items-center flex-grow transition-all ease-soft duration-350 lg-max:bg-white lg-max:max-h-0 lg-max:overflow-hidden basis-full rounded-xl lg:flex lg:basis-auto">
                <ul class="flex flex-col pl-0 mx-auto mb-0 list-none lg:flex-row xl:ml-auto">
                    <li>
                        <a class="block px-4 py-2 mr-2 font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out text-sm lg:px-2 lg:hover:text-white/75" href="./sign-in.php">
                            <i class="mr-1 fa fa-key opacity-60"></i>
                            Sign In
                        </a>
                    </li>
                    <li>
                        <a class="block px-4 py-2 mr-2 font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out text-sm lg:px-2 lg:hover:text-white/75" href="./../index.php">
                            <i class='fa fa-plus mr-1 opacity-60'></i>
                            Sign Up
                        </a>
                    </li>
                </ul>
                <!-- online builder btn  -->
                <!-- <li class="flex items-center">
            <a
              class="leading-pro ease-soft-in border-white/75 text-xs tracking-tight-soft rounded-3.5xl hover:border-white/75 hover:scale-102 active:hover:border-white/75 active:hover:scale-102 active:opacity-85 active:shadow-soft-xs active:border-white/75 bg-white/10 hover:bg-white/10 active:hover:bg-white/10 mr-2 mb-0 inline-block cursor-pointer border border-solid py-2 px-8 text-center align-middle font-bold uppercase text-white shadow-none transition-all hover:text-white hover:opacity-75 hover:shadow-none active:scale-100 active:bg-white active:text-black active:hover:text-white active:hover:opacity-75 active:hover:shadow-none"
              target="_blank"
              href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053"
              >Online Builder</a
            >
          </li> -->
            </div>
        </div>
    </nav>

    <main class="mt-0 transition-all duration-200 ease-soft-in-out">
        <section class="min-h-screen mb-24">
            <div class="relative flex items-start pt-12 pb-56 m-4 overflow-hidden bg-center bg-cover min-h-50-screen rounded-xl" style="background-image: url('./../assets/img/curved-images/curved14.jpg')">
                <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-60"></span>
                <div class="container z-10">
                    <div class="flex flex-wrap justify-center -mx-3">
                        <div class="w-full max-w-full px-3 mx-auto mt-0 text-center lg:flex-0 shrink-0 lg:w-5/12">
                            <h1 class="mt-12 mb-2 text-white text-3xl font-bold">Choose a new password !</h1>
                            <p class="text-white text-2xl">We have found your account, follow the instructions below !</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="flex flex-wrap -mx-3 -mt-48 md:-mt-56 lg:-mt-48">
                    <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                        <div class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="flex-auto p-6">

                                <form action="./../php/controller/password_reset_processing.php" method="post">
                                    <input type="hidden" name="form_token" value="<?php echo htmlspecialchars($_GET['tu']); ?>">

                                    <div class="mb-4">
                                        <input type="password" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Password" aria-label="Password" name="form_change_new_password" minlength="8" required="required" maxlength="100" autocomplete="off" />
                                    </div>
                                    <div class="mb-4">
                                        <input type="password" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Password repeat" aria-label="Password" name="form_change_retype_password" minlength="8" required="required" maxlength="100" autocomplete="off" />
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="inline-block w-full px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:border-slate-700 hover:bg-slate-700 hover:text-white">Confirm</button>
                                    </div>
                                    <p class="mt-4 mb-0 leading-normal text-sm">Already have an account? <a href="./sign-in.php" class="font-bold text-slate-700">Sign in</a></p>
                                </form>

                                <form action="./../php/controller/cancel_reset_processing.php" method="post">
                                    <div class="mb-4">
                                        <input type="hidden" name="form_token" value="<?php echo htmlspecialchars($_GET['tu']); ?>">
                                        <button type="submit" class="inline-block w-full px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-red-500 hover:border-slate-700 hover:bg-slate-700 hover:text-white">You did not initiate this request?</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
        <footer class="py-12">
            <div class="container">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-shrink-0 w-full max-w-full mx-auto mb-6 text-center lg:flex-0 lg:w-8/12">
                        <a href="#" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0"> About Us </a> <!-- xl:mr-12 -->
                    </div>
                    <div class="flex-shrink-0 w-full max-w-full mx-auto mt-2 mb-6 text-center lg:flex-0 lg:w-8/12">
                        <a href="#" target="_blank" class="mr-6 text-slate-400">
                            <span class="text-lg fab fa-dribbble"></span>
                        </a>
                        <a href="#" target="_blank" class="mr-6 text-slate-400">
                            <span class="text-lg fab fa-twitter"></span>
                        </a>
                        <a href="#" target="_blank" class="mr-6 text-slate-400">
                            <span class="text-lg fab fa-instagram"></span>
                        </a>
                        <a href="#" target="_blank" class="mr-6 text-slate-400">
                            <span class="text-lg fab fa-pinterest"></span>
                        </a>
                        <a href="#" target="_blank" class="mr-6 text-slate-400">
                            <span class="text-lg fab fa-github"></span>
                        </a>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3">
                    <div class="w-8/12 max-w-full px-3 mx-auto mt-1 text-center flex-0">
                        <p class="mb-0 text-slate-400">
                            Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    </main>
</body>
<!-- plugin for scrollbar  -->
<script src="./../js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="./../js/soft-ui-dashboard-tailwind.js" async></script>

</html>