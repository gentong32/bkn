<?php

namespace App\Controllers;

use App\Models\M_bkn;

class Dasbor extends BaseController
{

    function __construct()
    {
        $this->M_bkn = new M_bkn();
    }

    public function index()
    {
        $request = \Config\Services::request();
        $hal = $request->getVar('hal') ?? '1';
        $data_nasional = $this->M_bkn->get_data_wilayah('000000', 0);
        $data['data_nasional'] = $data_nasional;
        $data['hal'] = $hal;
        if ($hal == 1)
            return view('dasbor', $data);
        else if ($hal == 2)
            return view('dasbor2', $data);
        else
            return view('dasbor3', $data);
    }

    public function tes()
    {
        return view('organisasi');
    }

    public function list_provinsi()
    {
        $provinsi = $this->M_bkn->get_provinsi();
        $html = '<option value="000000">Nasional</option>';
        foreach ($provinsi as $p) {
            $html .= '<option value="' . $p['kode_wilayah'] . '">' . $p['wilayah'] . '</option>';
        }
        echo $html;
    }

    public function list_kabupaten()
    {
        $request = \Config\Services::request();
        $provinsi = $request->getVar('provinsi');
        $kabupaten = $this->M_bkn->get_kabupaten($provinsi);
        $html = '<option value="0">Semua</option>';
        foreach ($kabupaten as $p) {
            $html .= '<option value="' . $p['kode_wilayah'] . '">' . $p['wilayah'] . '</option>';
        }
        echo $html;
    }

    public function get_data_wilayah()
    {
        $request = \Config\Services::request();
        $provinsi = $request->getVar('provinsi');
        $kabupaten = $request->getVar('kabupaten');
        $data_wilayah = $this->M_bkn->get_data_wilayah($provinsi, $kabupaten);

        echo json_encode($data_wilayah);
    }
}
