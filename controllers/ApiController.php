<?php
namespace ZF\Controllers;

use ZF\App\Database;
use ZF\App\Storage;
use ZF\Models\Tasks;

class ApiController
{
    public function index()
    {
        // Logika untuk halaman utama
        require 'views/signIn.php';
    }

    public function getTasks($request, $response, $session)
    {
        if( !$request->basicAuth_verify() )
        {
            $data = [
                "guid" => 0,
                "code" => 1,
                "data" => "Invalid basic auth"
            ];
    
            return $response->json($data);
        }
        
        $task_collection = new Tasks();

        $list = $task_collection->getAll();

        return $request->json([
            'guid' => 0, 'code' => 0, 'data' => $list
        ]);

    }


    public function getTaskById($request, $response, $session)
    {
        $result = [
            'guid' => 0, 'code' => 1, 'data' => null
        ];
        if (!$request->basicAuth_verify()) {
            $data = [
                "guid" => 0,
                "code" => 1,
                "data" => "Invalid basic auth"
            ];

            return $response->json($data);
        }

        $formData = $request->getForm() != [] ? $request->getForm() : $request->getJson();
        try {
            
            if (!isset($formData['id'])) {
                throw new \Exception("Error Processing Request: parameter id mandatory", 1);
            }
            
            if ( !is_integer($formData['id']) ) {
                throw new \Exception("Error Processing Request: Invalid data type", 1);
            }
            
            $task_collection = new Tasks();
            
            $list = $task_collection->getTaskById($formData);
            $result['code'] = 0;
            $result['data'] = $list;
        } catch (\Throwable $th) {
            $result['code'] = 1;
            $result['data'] = $th->getMessage();
        }

        return $request->json($result);
    }

    public function updateTask($request, $response, $session)
    {
        if (!$request->basicAuth_verify()) {
            $data = [
                "guid" => 0,
                "code" => 1,
                "data" => "Invalid basic auth"
            ];

            return $response->json($data);
        }
        
        
        // Contoh query SELECT
        try {
            $formData = $request->getForm() != [] ? $request->getForm() : $request->getJson();
            $task_collection = new Tasks();

            $do_upload = $task_collection->updateQuery($formData);
            
            $data = [
                'status' => true,
                'message' => 'Update Success',
                'data' => $do_upload
            ];
            
        } catch (\Throwable $th) {
            $data = [
                'status' => false,
                'message' => 'Failed Update',
                'data' => $th
            ];
            
        }

        return $request->json([
            'guid' => 0, 'code' => 0, 'data' => $data
        ]);
    }

    public function insertTask($request, $response, $session)
    {
        if (!$request->basicAuth_verify()) {
            $data = [
                "guid" => 0,
                "code" => 1,
                "data" => "Invalid basic auth"
            ];

            return $response->json($data);
        }

        // Contoh query SELECT
        try {

            $formData = $request->getForm() != [] ? $request->getForm() : $request->getJson();
            $task_collection = new Tasks();

            $do_insert = $task_collection->insertQuery($formData, $session->get('user_id'));
            $data = [
                'status' => true,
                'message' => 'Insert Success',
                'data' => $do_insert
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => false,
                'message' => 'Failed Insert',
                'data' => $th
            ];
        }

        return $request->json([
            'guid' => 0, 'code' => 0, 'data' => $data
        ]);
    }

    public function deleteTask($request, $response, $session)
    {
        $db = new Database();
        $formData = $request->getForm();

        // Contoh query SELECT
        try {

            $formData = $request->getForm() != [] ? $request->getForm() : $request->getJson();
            $task_collection = new Tasks();
            
            $do_delete = $task_collection->deleteQuery($formData);

            $data = [
                'status' => true,
                'message' => 'Delete Success',
                'data' => $do_delete
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => false,
                'message' => 'Failed Delete',
                'data' => $th
            ];
        }
        return $request->json([
            'guid' => 0, 'code' => 0, 'data' => $data
        ]);
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
            echo $th;
        }
        
    }
}
