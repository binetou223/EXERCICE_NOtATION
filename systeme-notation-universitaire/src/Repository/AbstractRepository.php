<?php

namespace App\Repository;
use App\Repository\Database;
abstract class AbstractRepository
{
    protected \PDO $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    protected function query(string $sql, bool $bool = true): mixed
    {
        $query = $this->db->query($sql);

        return $bool ? $query->fetch(\PDO::FETCH_OBJ) : $query->fetchAll(\PDO::FETCH_OBJ);
    }

    protected function prepare(string $sql, array $data = []): \PDOStatement
    {
        $prepare = $this->db->prepare($sql);

        foreach ($data as $key => $value) {
            $type = \PDO::PARAM_STR;

            if (is_int($value)) {
                $type = \PDO::PARAM_INT;
            } elseif (is_bool($value)) {
                $type = \PDO::PARAM_BOOL;
            } elseif ($value === null) {
                $type = \PDO::PARAM_NULL;
            }

            $prepare->bindValue($key, $value, $type);
        }

        $prepare->execute();

        return $prepare;
    }

    protected function executeQuery(string $sql, array $data, bool $bool = true): mixed
    {
        $statement = $this->prepare($sql, $data);

        return $bool ? $statement->fetch() : $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    protected function executeUpdate(string $sql, array $datas): int|string
    {
        $statement = $this->db->prepare($sql);

        foreach ($datas as $key => $value) {
            $type = \PDO::PARAM_STR;

            if (is_int($value)) {
                $type = \PDO::PARAM_INT;
            } elseif (is_bool($value)) {
                $type = \PDO::PARAM_BOOL;
            } elseif ($value === null) {
                $type = \PDO::PARAM_NULL;
            }

            $statement->bindValue($key, $value, $type);
        }

        $statement->execute();

        return (str_starts_with(strtoupper(trim($sql)), 'INSERT')) ? (string) $this->db->lastInsertId() : (string) $statement->rowCount();
    }
}