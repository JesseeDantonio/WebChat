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

$response = $verifyIdentification->start();

$verifyIdentification->isProfileNotVerified($response, "/../../index.php");

$arrayAdministrators = $dataBaseRequest->queryAllPermissions($response->getUUID());

foreach ($arrayAdministrators as $administrators) : ?>
    <!-- card1 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex justify-between flex-row -mx-3">
                    <div class="flex px-4">
                        <p class="font-bold pt-2"><?= $administrators['uuid'] ?> - <?= $dataBaseRequest->selectUsernameAccount($administrators['uuid'])['username'] ?></p>
                    </div>

                    <div class="flex px-4">
                        <button class="bg-red-400 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                            <a href="../../php/controller/processing-admin/retrograde_permission_processing.php?uuid=<?= $administrators['uuid'] ?>&list=admin">
                                Delete Permission
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>