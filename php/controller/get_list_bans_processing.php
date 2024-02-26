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

$arrayBans = $dataBaseRequest->queryBanList();

foreach ($arrayBans as $ban) : ?>
    <!-- card1 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/4 sm:flex-none xl:mb-3">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex justify-between flex-row -mx-3">
                    <div class="flex px-4">
                        <span class="font-bold pt-2"><?= htmlspecialchars($ban['email']) ?></span>
                    </div>

                    <div class="flex px-4">
                        <button class="bg-violet-500 hover:bg-violet-600 text-white font-bold py-2 px-4 rounded">
                            <a href="../../php/controller/processingAdmin/remove_ban_processing.php?email=<?= htmlspecialchars($ban['email']) ?>">
                                Delete
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>