<?php

namespace App\Controllers;

use App\Models\M_bkn;

class Login extends BaseController
{

    function __construct()
    {
        $this->model_bkn = new M_bkn();
    }

    public function index()
    {
        $params = [
            'role' => "userLogin",
            'jenis_instansi_id' => 100,
            'nama' => "Logged User",
        ];
        session()->set($params);
        return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function loginsso()
    {
        session()->destroy();
        if (isset($_GET['tokenKey'])) {
            $asal = "internal";
            $tokenKey = $_GET['tokenKey'];
        } else {
            echo "Failed";
        }

        if ($asal == "internal") {
            $checkToken = $this->model_bkn->getTokenSSO($tokenKey);

            if ($checkToken->tokenStatus > 0) {
                $akun = $this->model_bkn->getAkunSSO($tokenKey);
                $user = $akun->pengguna_id;
                if ($user) {
                    $params = [
                        'role' => "userLogin",
                        'jenis_instansi_id' => $akun->jenis_instansi_id,
                        'nama' => str_replace("'", "_", $akun->nama),
                    ];
                    session()->set($params);
                    // $this->model_bkn->simpan_log_userlogin();
                }

                return redirect()->to('/');
            }
        } else {
            return redirect()->to('/');
        }
    }
}
