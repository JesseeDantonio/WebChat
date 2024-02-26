<?php

use Index\php\classes\{DataBaseConnect, DataBaseRequest, VerifyIdentification, Profile};

require_once(__DIR__ . "/../classes/DataBaseConnect.php");
require_once(__DIR__ . "/../classes/DataBaseRequest.php");
require_once(__DIR__ . "/../classes/VerifyIdentification.php");
require_once(__DIR__ . "/../classes/Profile.php");

$dataBaseConnect = new DataBaseConnect();
$dataBaseRequest = new DataBaseRequest($dataBaseConnect->getLink());
$verifyIdentification = new VerifyIdentification();


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = $verifyIdentification->start();

$verifyIdentification->isProfileNotVerified($response, "/../../index.php");

$messages = $dataBaseRequest->getMessages();

$messagesReverse = array_reverse($messages);

foreach ($messagesReverse as $message) : ?>
    <div class="message">

        <div class="px-3 mb-2 sm:flex-none xl:mb-0">
            <div class="relative flex flex-col min-w-0 break-words bg-purple-700 shadow-soft-xl rounded-2xl bg-clip-border mb-2 w-auto">
                <div class="flex-auto p-4">
                    <div class="flex-auto justify-between flex-row -mx-3 ">
                        <div class="flex px-4 py-2">

                            <span class="mx-1 text-white"><?= date('H:i', strtotime(htmlspecialchars($message["registration_at"]))) ?></span>
                            <form action="/../../php/controller/processingUser/send_report_processing.php" method="POST">
                                <input class="w-30" type="hidden" name="form_report_id_message" value="<?= htmlspecialchars($message['id']) ?>">
                                <input class="w-30" type="hidden" name="form_report_uuid_concerned" value="<?= htmlspecialchars($message['uuid_user']) ?>">

                                <?php if ($response->getUUID() !=  htmlspecialchars($message['uuid_user'])) { ?>
                                    <button type="submit" class="bg-violet-500 hover:bg-violet-600 text-white font-bold px-2 rounded">
                                        Report
                                    </button>
                                <?php } ?>

                            </form>
                            <span class="font-bold mx-1 text-white"><?= htmlspecialchars($message['username'])  ?> :</span>
                        </div>
                    </div>
                    <span class="text-white"><?= htmlspecialchars($message['contains']) ?></span>
                </div>
            </div>
        </div>

    </div>
<?php endforeach; ?>