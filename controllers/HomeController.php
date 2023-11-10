<?php
namespace ZF\Controllers;

use ZF\App\Database;
use ZF\App\Storage;

class HomeController
{
    public function index()
    {
        // Logika untuk halaman utama
        require 'views/signIn.php';
    }

    public function home($request, $response, $session)
    {
        $db = new Database();
        
        // Contoh query SELECT
        $list_tasks = $db->fetchAll('
                                    SELECT zt.ID, zt.DESCRIPTION, zt.COMPLETED, zt.CREATE_AT, zt.UPDATE_AT, zu.USERNAME, zu.EMAIL
                                    FROM ZM_TASK zt 
                                        JOIN ZT_USERS zu ON zt.USER_ID = zu.USER_ID
                                    WHERE zt.USER_ID = :user_id', ['user_id' => $session->get('user_id')]);
        $count_task = $db->fetchAll('SELECT COUNT(*) AS total_tasks FROM ZM_TASK')[0];
        $count_uncompleted = $db->fetchAll('SELECT COUNT(*) AS total_tasks FROM ZM_TASK WHERE COMPLETED = 0')[0];
        $count_completed = $db->fetchAll('SELECT COUNT(*) AS total_tasks FROM ZM_TASK WHERE COMPLETED = 1')[0];

        
        // Logika untuk halaman about
        require 'views/dashboard.php';
    }

    public function updateTask($request, $response, $session)
    {
        $db = new Database();
        $formData = $request->getForm();
        
        // Contoh query SELECT
        try {
            $db->query('UPDATE zaidsource.ZM_TASK
                SET COMPLETED=:completed, DESCRIPTION=:description,
                    UPDATE_AT=NOW()
                WHERE ID=:id', [
                'description' => $formData['description'],
                'completed' => intval(filter_var($formData['completed'], FILTER_VALIDATE_BOOLEAN)),
                'id' => $formData['id']
            ]);
            $data = [
                'status' => true,
                'message' => 'Update Success',
                'data' => $formData
            ];
            
        } catch (\Throwable $th) {
            $data = [
                'status' => false,
                'message' => 'Failed Update',
                'data' => $th
            ];
            
        }
        $response->json($data);
    }

    public function insertTask($request, $response, $session)
    {
        $db = new Database();
        $formData = $request->getForm();

        // Contoh query SELECT
        try {
            $db->query('INSERT INTO ZM_TASK (user_id, description, completed, CREATE_AT, UPDATE_AT) VALUES
                (:user_id, :description, :completed, NOW(), NOW())', [
                'description' => $formData['description'],
                'completed' => intval(filter_var($formData['completed'], FILTER_VALIDATE_BOOLEAN)),
                'user_id' => $session->get('user_id')
            ]);
            $data = [
                'status' => true,
                'message' => 'Insert Success',
                'data' => $formData
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => false,
                'message' => 'Failed Insert',
                'data' => $th
            ];
        }
        $response->json($data);
    }

    public function deleteTask($request, $response, $session)
    {
        $db = new Database();
        $formData = $request->getForm();

        // Contoh query SELECT
        try {
            $db->query('DELETE FROM zaidsource.ZM_TASK
	                    WHERE ID=:id', ['id' => $formData['id']
            ]);
            $data = [
                'status' => true,
                'message' => 'Delete Success',
                'data' => $formData
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => false,
                'message' => 'Failed Delete',
                'data' => $th
            ];
        }
        $response->json($data);
    }

    public function uploadAttachment($request, $response, $session)
    {
        $db = new Database();
        // print BASE_DIR;die;
        $storage = new Storage();
        $files = $request->getFiles();
        // print_r($files);die;
        // Contoh query SELECT
        try {
            $db->query('DELETE FROM zaidsource.ZM_TASK
	                    WHERE ID=:id', [
                'id' => $formData['id']
            ]);
            $data = [
                'status' => true,
                'message' => 'Delete Success',
                'data' => $formData
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => false,
                'message' => 'Failed Delete',
                'data' => $th
            ];
        }
        $response->json($data);
    }
}
