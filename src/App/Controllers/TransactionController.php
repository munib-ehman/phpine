<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\TransactionService;
use App\Services\ValidatorService;
use Framework\TemplateEngine;

class TransactionController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validateService,
        private TransactionService $transactionService
    ) {
    }

    public function createView()
    {
        echo $this->view->render('transaction/create.php');
    }

    public function create()
    {
        $this->validateService->validateTransaction($_POST);
        $this->transactionService->create($_POST);
        redirectTo('/');
    }

    public function editView(array $params)
    {
        $transaction = $this->transactionService->getUserTransaction((int) $params['transaction']);
        if (!$transaction) {
            redirectTo('/');
        }

        echo $this->view->render('transaction/edit.php', [
            'transaction' => $transaction
        ]);
    }

    public function update(array $params)
    {
        $transaction = $this->transactionService->getUserTransaction((int) $params['transaction']);
        if (!$transaction) {
            redirectTo('/');
        }
        $this->validateService->validateTransaction($_POST);
        $this->transactionService->update($_POST, (int) $params['transaction']);

        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function delete(array $params)
    {
        $this->transactionService->delete((int) $params['transaction']);
        redirectTo('/');
    }
}
