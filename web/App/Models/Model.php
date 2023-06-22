<?php

namespace App\Models;

use App\Config;
use App\Db;

abstract class Model
{
    const TABLE = '';

    protected $data = [];

    protected static $db;

    public static function connectDB()
    {
        if (empty(static::$db)) {
            $config = Config::instance();

            static::$db = new Db(
                $config->configData['db']['mysql']['dsn'],
                $config->configData['db']['mysql']['host'],
                $config->configData['db']['mysql']['port'],
                $config->configData['db']['mysql']['dbName'],
                $config->configData['db']['mysql']['user'],
                $config->configData['db']['mysql']['password']
            );
        }
    }

    public static function findAll()
    {
        static::connectDB();

        return static::$db->queryEach(
            'SELECT * FROM ' . static::TABLE,
            static::class
        );
    }

    public static function findById(int $id)
    {
        static::connectDB();

        return static::$db->query(
            'SELECT * FROM ' . static::TABLE . ' WHERE id = :id',
            [':id' => $id],
            static::class
        )[0];
    }

    function findLast(int $quantity)
    {
        static::connectDB();

        return static::$db->query(
            'SELECT * FROM ' . static::TABLE . ' ORDER BY id DESC LIMIT ' . $quantity
        );
    }

    public function isNew(): bool
    {
        return empty($this->id);
    }

    public function insert()
    {
        $columns = [];
        $values = [];
        foreach ($this->data as $property => $value) {
            if ('id' == $property) {
                continue;
            }
            $columns[] = $property;
            $values[':' . $property] = $value;
        }

        $sql = 'INSERT INTO ' . static::TABLE . ' (' . implode(', ', $columns) . ') 
        VALUES (' . implode(', ', array_keys($values)) . ')';

        static::connectDB();
        if (static::$db->execute($sql, $values)) {
            $id = static::$db->lastInsertId();
            $this->id = $id;
        }
    }

    public function update()
    {
        $sqlShortFragment = [];
        foreach ($this->data as $property => $value) {
            $data[':' . $property] = $value;
            if ('id' == $property) {
                continue;
            }
            $sqlShortFragment[] = "$property = :$property ";
            $sqlFragment = implode(', ', $sqlShortFragment);
        }

        $sqlUpdate = (
            "UPDATE " . static::TABLE .
            " SET " . $sqlFragment .
            " WHERE " . "id = :id"
        );

        static::$db->execute($sqlUpdate, $data);
    }

    public function save()
    {
        $this->isNew() ? $this->insert() : $this->update();
    }

    public static function delete($id)
    {
        $data = [':id' => $id];
        $sqlDelete = ("DELETE FROM " . static::TABLE . " WHERE id = :id");
        static::$db->execute($sqlDelete, $data);
    }

    /**
     * get property
     *
     * @param string $name name property
     * @return mixed|null return property
     */
    public function __get(string $name)
    {
        return $this->data[$name] ?: null;
    }

    /**
     * set property
     *
     * @param string $name name property
     * @param mixed $value value property
     */
    public function __set(string $name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * isset property
     *
     * @param string $name name property
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->data[$name]);
    }
}