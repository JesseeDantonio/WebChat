<?php

use Index\php\classes\{ DataBaseConnect, DataBaseRequest, VerifyIdentification };

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

$arrayReports = $dataBaseRequest->queryReports();

foreach ($arrayReports as $report) : ?>
    <tr class="bg-gray-300 border border-grey-500 md:border-none block md:table-row">
        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block md:hidden font-bold"></span><?= htmlspecialchars($report['uuid_sender']) ?></td>
        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block md:hidden font-bold"></span><?= htmlspecialchars($report['uuid_concerned']) ?></td>
        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell"><span class="inline-block md:hidden font-bold"></span><?= htmlspecialchars($dataBaseRequest->selectMessage($report['id_message'])['contains']) ?></td>
        <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
            <span class="inline-block md:hidden font-bold">Actions</span>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border rounded">
                <a href="../../php/controller/processingAdmin/ban_and_remove_report_processing.php?uuid=<?= htmlspecialchars($report['uuid_concerned']) ?>&id_report=<?= htmlspecialchars($report['id']) ?>">
                    Ban User
                </a>
            </button>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border rounded">
                <a href="../../php/controller/processingAdmin/delete_message_and_report_processing.php?id_message=<?= htmlspecialchars($report['id_message']) ?>&id_report=<?= htmlspecialchars($report['id']) ?>">
                    Delete Message
                </a>
            </button>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border rounded">
                <a href="../../php/controller/processingAdmin/delete_report_processing.php?id_report=<?= htmlspecialchars($report['id']) ?>">
                    No Action
                </a>
            </button>
        </td>
    </tr>
<?php endforeach; ?>