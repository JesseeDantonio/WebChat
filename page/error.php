<?php

use Index\php\classes\{ VerifyIdentification, AutoLoading };

require(__DIR__ . "/../php/classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const VERIFY_IDENTIFICATION = new VerifyIdentification();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="./../assets/img/apple-icon.png" />
    <title>Error</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Nucleo Icons -->
    <link href="./../css/nucleo-icons.css" rel="stylesheet" />
    <link href="./../css/nucleo-svg.css" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="./../css/soft-ui-dashboard-tailwind.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <main class="h-screen w-full flex flex-col justify-center items-center bg-[#1A2238]">
        <h1 class="text-9xl font-extrabold text-white tracking-widest">ERROR</h1>
        <div class="bg-[#FF6A3D] px-2 text-sm rounded rotate-12 absolute">
            A critical error has occurred
        </div>
        <button class="mt-5">

            <?php if (VERIFY_IDENTIFICATION->isVerifyWithoutAction()) { ?>
                <a href="./dashboard-user/dashboard.php" class="relative inline-block text-sm font-medium text-[#FF6A3D] group active:text-orange-500 focus:outline-none focus:ring">
                    <span class="absolute inset-0 transition-transform translate-x-0.5 translate-y-0.5 bg-[#FF6A3D] group-hover:translate-y-0 group-hover:translate-x-0"></span>


                    <span class="relative block px-8 py-3 bg-[#1A2238] border border-current">
                        Go home
                    </span>
                </a>
            <?php } else { ?>
                <a href="./sign-in.php" class="relative inline-block text-sm font-medium text-[#FF6A3D] group active:text-orange-500 focus:outline-none focus:ring">
                    <span class="absolute inset-0 transition-transform translate-x-0.5 translate-y-0.5 bg-[#FF6A3D] group-hover:translate-y-0 group-hover:translate-x-0"></span>


                    <span class="relative block px-8 py-3 bg-[#1A2238] border border-current">
                        Go home
                    </span>
                </a>
            <?php } ?>
        </button>
    </main>
</body>

</html>