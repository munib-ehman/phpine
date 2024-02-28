<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class TransactionService
{
    public function __construct(private Database $db)
    {
    }
    public function create(array $formData)
    {
        $formatedDate = "{$formData['date']} 00:00:00";
        $this->db->query("INSERT INTO transactions(user_id,amount,date,description)
        VALUES(:user_id,:amount,:date,:description)", [
            'user_id' => $_SESSION['user'],
            'amount' => $formData['amount'],
            'date' => $formatedDate,
            'description' => $formData['description']
        ]);
    }
    public function getUserTransactions(int $limit, int $offset)
    {
        $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
        $queryParams = [
            'user_id' => $_SESSION['user'],
            'description' => "%{$searchTerm}%"
        ];
        $transactions = $this->db->query(
            "SELECT *, DATE_FORMAT(date,'%Y-%m-%d') as formatted_date FROM transactions WHERE user_id=:user_id AND description LIKE :description LIMIT {$limit} OFFSET {$offset}",
            $queryParams
        )->findAll();
        $transactionCount = $this->db->query(
            "SELECT COUNT(*) FROM transactions WHERE user_id=:user_id AND description LIKE :description",
            $queryParams
        )->count();
        return [$transactions, $transactionCount];
    }

    public function getUserTransaction(int $id)
    {
        return $this->db->query(
            "SELECT * , DATE_FORMAT(date,'%Y-%m-%d') as formatedDate FROM transactions WHERE id=:id AND user_id=:user_id",
            [
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        )->find();
    }

    public function update(array $formData, int $id)
    {
        $formatedDate = "{$formData['date']} 00:00:00";
        $this->db->query(
            "UPDATE transactions SET description= :description,amount= :amount,date= :date WHERE id= :id AND user_id= :user_id",
            [
                'description' => $formData['description'],
                'amount' => $formData['amount'],
                'date' => $formatedDate,
                'id' => $id,
                'user_id' => (int) $_SESSION['user']
            ]
        );
    }

    public function delete(int $id)
    {
        $this->db->query(
            "DELETE FROM transactions WHERE id=:id AND user_id=:user_id",
            [
                'id' => $id,
                'user_id' => $_SESSION['user'],
            ]
        );
    }
}
