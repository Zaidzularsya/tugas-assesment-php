<?php

namespace ZF\Controllers;

use ZF\App\Database;


class AuthController
{
    public function auth($request, $response, $session)
    {
        $isValid = false;
        
        
        $db = new Database();

        // Contoh query SELECT
        $result = $db->fetchAll('SELECT x.*
                                 FROM zaidsource.ZT_USERS x
                                 WHERE USERNAME = :username', ['username' => $_POST['username']])[0];
        
        $hash = $result['PASSWORD'];
        $isValid = password_verify($_POST['password'], $hash);
        
        if ($isValid) {
            setcookie('user_id', $result['USER_ID'], time() + 3600, '/');

            $session->set([
                'user_id' => $result['USER_ID'],
                'username' => $result['USERNAME'],
                'name' => $result['NAME'],
                'email' => $result['EMAIL'],
                'create_dtm' => $result['CREATE_DTM'],
                'user_status_id' => $result['USER_STATUS_ID'],
                'remark' => $result['REMARK'],
                'avatar' => $result['AVATAR'],
                'update_by' => $result['UPDATE_BY'],
                'update_dtm' => $result['UPDATE_DTM'],
                'user_level' => $result['USER_LEVEL'],
                'is_verify' => $result['IS_VERIFY']
            ]);
            $data = [
                'status' => true,
                'message' => 'Auth berhasil',
                'data' => $session->getAll()
            ];
            $response->json($data);
        }else{
            
            $response->addHeader('Content-Type', 'application/json');
            $data = [
                'status' => false,
                'message' => 'Invalid Username or Passwrod',
                'data' => null
            ];
            // Mengembalikan data dalam format JSON
            $response->json($data);
        }

    }

    public function logout($request){
        $this->clearSession();
        $this->clearCookie("user_id");
        $request->redirect('');
    }

    /**
     * Membersihkan (menghapus) session
     */
    private function clearSession()
    {
        session_unset();  // Membersihkan variabel session
        session_destroy(); // Menghancurkan sesi
    }

    /**
     * Membersihkan (menghapus) cookie
     *
     * @param string $cookieName Nama cookie yang akan dihapus
     */
    private function clearCookie($cookieName)
    {
        setcookie($cookieName, "", time() - 3600, "/"); // Mengatur waktu kedaluwarsa satu jam yang lalu
    }
}
