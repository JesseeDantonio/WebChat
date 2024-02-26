<?php

use Index\php\classes\{ DataBaseConnect, DataBaseRequest, VerifyIdentification, Profile };

require_once(__DIR__ . "/../classes/DataBaseConnect.php");
require_once(__DIR__ . "/../classes/DataBaseRequest.php");
require_once(__DIR__ . "/../classes/VerifyIdentification.php");
require_once(__DIR__ . "/../classes/Profile.php");

$verifyIdentification = new VerifyIdentification();
$dataBaseConnect = new DataBaseConnect();
$dataBaseRequest = new DataBaseRequest($dataBaseConnect->getLink());

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = VERIFY_IDENTIFICATION->start();

VERIFY_IDENTIFICATION->isProfileNotVerified($response, "/../../index.php");

$arrayUsers = $dataBaseRequest->queryAllAccounts($response->getUUID());

foreach ($arrayUsers as $user) : ?>
    <!-- card1 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-2">
                <div class="flex justify-around flex-row -mx-4">
                    <div class="flex-none w-auto max-w-full pt-2">
                        <div class="text-base ease-soft-in-out h-18.5 w-18.5 relative inline-flex items-center justify-center rounded-xl text-white transition-all duration-200">

                            <?php if (!empty($user['path_img'])) { ?>
                                <img src="<?= $user['path_img'] ?>" alt="profile_image" class="w-full shadow-soft-sm rounded-xl" />
                            <?php } else { ?>
                                <img src= "../../assets/img/default.jpg" alt="profile_image" class="w-full shadow-soft-sm rounded-xl" />
                            <?php } ?>

                        </div>
                    </div>
                    <div class="flex px-4 my-6">
                        <span class="font-bold pt-2"><?= $user['uuid'] ?></span>
                        <span class="font-bold mx-1 pt-2">-</span>
                        <span class="font-bold pt-2"><?= $user['username'] ?></span>
                    </div>
                    <div class="flex h-14 my-4">
                        <button class="bg-violet-500 hover:bg-violet-600 text-white font-bold py-2 px-4 rounded">
                            <a href="/watch-user.php?uuid=<?= $user['uuid'] ?>">
                                Edit
                            </a>
                        </button>
                        <?php if ($dataBaseRequest->existPermission($user['uuid'])) { ?>
                            <div class="flex">
                                <button class="bg-violet-500 hover:bg-violet-600 text-white font-bold py-2 px-4 rounded ml-1">
                                    <a href="../../php/controller/processing-admin/retrograde_permission_processing.php?uuid=<?= $user['uuid'] ?>&list=user">
                                        Admin
                                    </a>
                                </button>
                            </div>
                        <?php } else { ?>
                            <div class="flex">
                                <button class="bg-violet-500 hover:bg-violet-600 text-white font-bold py-2 px-4 rounded ml-1">
                                    <a href="../../php/controller/processing-admin/upgrade_permission_processing.php?uuid=<?= $user['uuid'] ?>&list=user">
                                        User
                                    </a>
                                </button>
                            </div>
                        <?php } ?>
                    </div>


                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>