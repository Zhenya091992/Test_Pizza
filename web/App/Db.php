<?php

namespace App;

use Exception;
use PDO;

class Db
{
    /**
     * contain PDO object
     *
     * @var PDO $dbh
     */
    protected $dbh;

    /**
     * creates a connection to the database
     */
    public function __construct($dsn, $host, $port, $dbName, $user, $password)
    {
        $this->dbh = new \PDO($dsn . ':host=' . $host . ':' . $port . ';dbname=' . $dbName, $user, $password);
    }

    /**
     * executes the request
     *
     * @param string $sql request
     * @param array|null $data array with placeholders|null
     * @return bool
     */
    public function execute(string $sql, array $data = null): bool
    {
        $sth = $this->dbh->prepare($sql);

        if ($result = $sth->execute($data)) {
            if (!empty($result)) {
                return $result;
            } else {
                throw new Exception('нет совпадений в базе данных');
            }
        } else {
            $err = $sth->errorInfo();
            throw new Exception(implode(' | ', $err) . ' SQL:' . $sql);
        }
    }

    /**
     * executes the request and returns the data
     *
     * @param string $sql request
     * @param string|null $class name class
     * @param array|null $data array with placeholders|null
     * @return array
     */
    public function query(string $sql, $data = null, $class = null)
    {
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute($data)) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class) ?: [];
        } else {
            throw new Exception('ошибка в запросе');
        }
    }

    public function simpleQuery(string $sql, $data = null): array
    {
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute($data)) {
            $result = $sth->fetch();
            if (!empty($result)) {
                return $result;
            } else {
                throw new Exception('нет совпадений в базе данных');
            }
        } else {
            throw new Exception('ошибка в запросе');
        }
    }

    public function queryEach(string $sql, string $class, $data = null)
    {
        $sth = $this->dbh->prepare($sql);
        if ($sth->execute($data)) {
            $sth->setFetchMode(PDO::FETCH_CLASS, $class);
            while ($result = $sth->fetch()) {
                yield $result;
            }
        } else {
            throw new Exception('ошибка в запросе');
        }
    }

    /**
     * return last insert id
     *
     * @return string
     */
    public function lastInsertId(): int
    {
        return $this->dbh->lastInsertId();
    }
}