<?php

namespace ZF\Models;

use \Countable;
use \Iterator;
use \ArrayAccess;
use ZF\App\Database;

class Tasks implements Countable, Iterator, ArrayAccess
{
    public $id;
    public $description;
    public $completed;
    public $create_at;
    public $update_at;
    public $username;
    public $email;
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    private $tasks = []; // Array untuk menyimpan data

    public function findAllBackup(array $filters){
        // Buat array untuk menyimpan klausa WHERE
        $whereClauses = [];
        // Bind parameter dan tambahkan klausa WHERE untuk setiap filter
        foreach ($filters as $filterColumn => $filterValue) {
            $whereClauses[] = "$filterColumn = :$filterColumn";
        }
        // Gabungkan klausa WHERE menjadi satu string
        $whereClause = implode(' AND ', $whereClauses);
        // Kueri SQL
        $sql = "
            SELECT zt.ID, zt.DESCRIPTION, zt.COMPLETED, zt.CREATE_AT, zt.UPDATE_AT, zu.USERNAME, zu.EMAIL
            FROM ZM_TASK zt
            JOIN ZT_USERS zu ON zt.USER_ID = zu.USER_ID
            WHERE $whereClause
        ";

        $list = $this->db->fetchAll($sql, $filters);
        return $list;
    }

    public function findAll(array $filters)
    {
        // Kueri SQL
        $sql = "
            SELECT zt.ID, zt.DESCRIPTION, zt.COMPLETED, zt.CREATE_AT, zt.UPDATE_AT, zu.USERNAME, zu.EMAIL
            FROM ZM_TASK zt 
                JOIN ZT_USERS zu ON zt.USER_ID = zu.USER_ID
            WHERE zu.USER_ID = :user_id
        ";
        // print "<pre>";
        // print $sql;die;

        $list = $this->db->fetchAll($sql, $filters);
        $this->tasks = $list;
        return $this->tasks;
    }


    public function getTaskById(array $filters)
    {
        // Kueri SQL
        $sql = "
            SELECT zt.ID, zt.DESCRIPTION, zt.COMPLETED, zt.CREATE_AT, zt.UPDATE_AT, zu.USERNAME, zu.EMAIL
            FROM ZM_TASK zt 
                JOIN ZT_USERS zu ON zt.USER_ID = zu.USER_ID
            WHERE zt.ID = :id
        ";
        // print "<pre>";
        // print $sql;die;
        // print_r($filters);die;

        $list = $this->db->fetchAll($sql, $filters);
        $this->tasks = $list;
        return $this->tasks;
    }

    public function updateQuery($formData){
        return $this->db->query('UPDATE zaidsource.ZM_TASK
                SET COMPLETED=:completed, DESCRIPTION=:description,
                    UPDATE_AT=NOW()
                WHERE ID=:id', [
            'description' => $formData['description'],
            'completed' => intval(filter_var($formData['completed'], FILTER_VALIDATE_BOOLEAN)),
            'id' => $formData['id']
        ]);

    }

    public function insertQuery($formData, $userId){
        return $this->db->query('INSERT INTO ZM_TASK (user_id, description, completed, CREATE_AT, UPDATE_AT) VALUES
                (:user_id, :description, :completed, NOW(), NOW())', [
            'description' => $formData['description'],
            'completed' => intval(filter_var($formData['completed'], FILTER_VALIDATE_BOOLEAN)),
            'user_id' => $userId
        ]);
    }

    public function deleteQuery($formData){
        return $this->db->query('DELETE FROM zaidsource.ZM_TASK
	                    WHERE ID=:id', [
            'id' => $formData['id']
        ]);
    }

    public function getAll()
    {
        // Kueri SQL
        $sql = "
            SELECT zt.ID, zt.DESCRIPTION, zt.COMPLETED, zt.CREATE_AT, zt.UPDATE_AT, zu.USERNAME, zu.EMAIL
            FROM ZM_TASK zt 
                JOIN ZT_USERS zu ON zt.USER_ID = zu.USER_ID
        ";
        // print "<pre>";
        // print $sql;die;

        $list = $this->db->fetchAll($sql, []);
        $this->tasks = $list;
        return $this->tasks;
    }

    // Implementasi metode dari Countable
    public function count()
    {
        return count($this->tasks);
    }

    // Implementasi metode dari Iterator
    public function current()
    {
        return current($this->tasks);
    }

    public function key()
    {
        return key($this->tasks);
    }

    public function next()
    {
        return next($this->tasks);
    }

    public function rewind()
    {
        reset($this->tasks);
    }

    public function valid()
    {
        return key($this->tasks) !== null;
    }

    // Implementasi metode dari ArrayAccess
    public function offsetExists($offset)
    {
        return isset($this->tasks[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->tasks[$offset] ?? null;
    }

    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $this->tasks[] = $value;
        } else {
            $this->tasks[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->tasks[$offset]);
    }
}
