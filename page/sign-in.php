<?php

use Index\php\classes\{ VerifyIdentification, AutoLoading };

require(__DIR__ . "/../php/classes/AutoLoading.php");

const AUTO_LOADING = new AutoLoading();
const VERIFY_IDENTIFICATION = new VerifyIdentification();

$response = VERIFY_IDENTIFICATION->start();

VERIFY_IDENTIFICATION->isProfileVerified($response, "../php/controller/logout_processing.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="apple-touch-icon" sizes="76x76" href="./../assets/img/apple-icon.png" />
  <title>Sign-in - Welcome back!</title>
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

<body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500">

  <main class="mt-0 transition-all duration-200 ease-soft-in-out">
    <section>
      <div class="relative flex items-center p-0 overflow-hidden bg-center bg-cover min-h-75-screen">
        <div class="container z-10">
          <div class="flex flex-wrap mt-0 -mx-3">
            <div class="flex flex-col w-full max-w-full px-3 mx-auto md:flex-0 shrink-0 md:w-6/12 lg:w-5/12 xl:w-4/12">
              <div class="relative flex flex-col min-w-0 mt-32 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-transparent border-b-0 rounded-t-2xl">
                  <h3 class="relative z-10 font-bold text-transparent bg-gradient-to-tl from-blue-600 to-cyan-400 bg-clip-text text-2xl">Welcome back</h3>
                  <p class="mb-0">Enter your email and password to sign in</p>
                </div>
                <div class="flex-auto p-6">
                  <form role="form" action="./../php/controller/login_processing.php" method="post">
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
                    <div class="mb-4">
                      <input type="email" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" name="form_login_email" placeholder="Email" aria-label="Email" required="required" autocomplete="on"/>
                    </div>
                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Password</label>
                    <div class="mb-4">
                      <input type="password" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" name="form_login_password" placeholder="Password" aria-label="Password" required="required" />
                    </div>
                    <a href="./../page/forgot.php" class="text-red-500 font-bold">Forgot password</a>
                    <div class="text-center">
                      <button type="submit" class="inline-block w-full px-6 py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Sign in</button>
                    </div>
                  </form>
                </div>
                <div class="p-6 px-1 pt-0 text-center bg-transparent border-t-0 border-t-solid rounded-b-2xl lg:px-2">
                  <p class="mx-auto mb-6 leading-normal text-sm">
                    Don't have an account?
                    <a href="./../index.php" class="relative z-10 font-semibold text-transparent bg-gradient-to-tl from-blue-600 to-cyan-400 bg-clip-text">Sign up</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="w-full max-w-full px-3 lg:flex-0 shrink-0 md:w-6/12">
              <div class="absolute top-0 hidden w-3/5 h-full -mr-32 overflow-hidden -skew-x-10 -right-40 rounded-bl-xl md:block">
                <div class="absolute inset-x-0 top-0 z-0 h-full -ml-16 bg-cover skew-x-10" style="background-image: url('../assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer class="py-12">
    <div class="container">
      <div class="flex flex-wrap -mx-3">
        <div class="flex-shrink-0 w-full max-w-full mx-auto mb-6 text-center lg:flex-0 lg:w-8/12">
          <a href="#" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0"> About Us </a>
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
</body>

</html>