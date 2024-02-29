<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ReceiptService, RecieptService, TransactionService};

class ReceiptController
{
    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService,
        private ReceiptService $receiptService
    ) {
    }

    public function uploadView(array $params)
    {
        $transaction = $this->transactionService->getUserTransaction((int) $params['transaction']);

        if (!$transaction) {
            redirectTo("/");
        }

        echo $this->view->render("receipts/create.php");
    }

    public function upload(array $params)
    {
        $transaction = $this->transactionService->getUserTransaction((int) $params['transaction']);

        if (!$transaction) {
            redirectTo("/");
        }
        $receiptFile = $_FILES['receipt'] ?? null;
        $this->receiptService->validateFile($receiptFile);

        $this->receiptService->upload($receiptFile, $transaction['id']);

        redirectTo("/");
    }

    public function download(array $params)
    {
        $transaction = $this->transactionService->getUserTransaction((int) $params['transaction']);

        if (empty($transaction)) {
            redirectTo("/");
        }

        $reciept = $this->receiptService->getReceipt($params['receipt']);

        if (empty($reciept)) {
            redirectTo('/');
        }


        if ($reciept['transaction_id'] !== $transaction['id']) {
            redirectTo('/');
        }

        $this->receiptService->read($reciept);
    }

    public function delete(array $params)
    {
        $transaction = $this->transactionService->getUserTransaction((int) $params['transaction']);

        if (empty($transaction)) {
            redirectTo("/");
        }

        $reciept = $this->receiptService->getReceipt($params['receipt']);

        if (empty($reciept)) {
            redirectTo('/');
        }

        if ($reciept['transaction_id'] !== $transaction['id']) {
            redirectTo('/');
        }
        $this->receiptService->delete($reciept);
        redirectTo('/');
    }
}
