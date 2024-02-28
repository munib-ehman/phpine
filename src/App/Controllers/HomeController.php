<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;
use App\Services\TransactionService;

class HomeController
{




    public function __construct(private TemplateEngine $view, private TransactionService $transactionServic)
    {

        // $this->view = new TemplateEngine(Paths::VIEW);
    }

    public function home()
    {
        $page =  $_GET['p'] ?? 1;
        $limit = 3;
        $offset = ($page - 1) * $limit;
        $searchTerm = $_GET['s'] ?? null;

        [$transactions, $count] = $this->transactionServic->getUserTransactions($limit, $offset);
        $lastPage = ceil($count / $limit);

        $totalPage = $lastPage ? range(1, $lastPage) : [];
        $pageLink = array_map(fn ($pageNum) => http_build_query([
            'p' => $pageNum,
            's' => $searchTerm
        ]), $totalPage);


        echo $this->view->render(
            'index.php',
            [
                'transactions' => $transactions,
                'currentPage' => $page,
                'previousPageQuery' => http_build_query([
                    'p' => $page - 1,
                    's' => $searchTerm
                ]),
                'lastPage' => $lastPage,
                'nextPageQuery' => http_build_query([
                    'p' => $page + 1,
                    's' => $searchTerm
                ]),
                'pageLink' => $pageLink,
                'searchTerm' => $searchTerm
            ]
        );
    }
}
