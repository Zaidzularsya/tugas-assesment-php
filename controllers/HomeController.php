<?php
namespace ZF\Controllers;

use ZF\App\Database;
use ZF\App\Storage;
use ZF\Models\Tasks;

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
        $task_collection = new Tasks();
        
        // Contoh query SELECT
        $list_tasks = $task_collection->findAll(['user_id' => $session->get('user_id')]);
        $count_task = $db->fetchAll('SELECT COUNT(*) AS total_tasks FROM ZM_TASK')[0];
        $count_uncompleted = $db->fetchAll('SELECT COUNT(*) AS total_tasks FROM ZM_TASK WHERE COMPLETED = 0')[0];
        $count_completed = $db->fetchAll('SELECT COUNT(*) AS total_tasks FROM ZM_TASK WHERE COMPLETED = 1')[0];
        // Logika untuk halaman about
        // require 'views/dashboard.php';
        $response->view('dashboard', [
            'list_tasks' => $list_tasks,
            'count_task' => $count_task,
            'count_uncompleted' => $count_uncompleted,
            'count_completed' => $count_completed
        ]);
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
        return $response->json($data);
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
        return $response->json($data);
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
        return $response->json($data);
    }

    public function uploadAttachment($request, $response, $session)
    {
        $storage = new Storage();
        try {
            $do_upload = $storage->validate('lampiran')->upload();
            $fileDescription = explode('_', $do_upload['fileName']);
            $db = new Database();
            $db->query('
                        INSERT INTO zaidsource.ZT_OBJECTS (name,description,reference)
                        VALUES (:filename, :description, :uploadId)
                        ', [
                            'filename' => $fileDescription[1],
                            'description' => 'File attachment',
                            'uploadId' => $fileDescription[0]
                    ]);
            $response->json($do_upload);
        } catch (\Throwable $th) {
            $data = [
                'status' => false,
                'message' => $th->getMessage(),
                'data' => $th->getMessage()
            ];
            return $response->json($data);
        }
        
    }
}
