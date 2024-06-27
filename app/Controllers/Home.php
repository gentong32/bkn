<?php

namespace App\Controllers;

use App\Models\M_bkn;

class Home extends BaseController
{

    function __construct()
    {
        $this->M_bkn = new M_bkn();
        helper('bkn');
    }

    public function index()
    {
        return redirect()->to('beranda');
    }

    public function beranda()
    {
        // session()->destroy('role');
        // session()->set('role', 'userNotLogin');
        return view('beranda');
    }

    public function data_ptk()
    {
        $request = \Config\Services::request();
        $wilayah = $request->getVar('wilayah') ?? '000000';
        $npsn = $request->getVar('npsn') ?? '';
        $level = $request->getVar('level') ?? '0';
        $param = $request->getVar('param') ?? '1';

        $data = array();
        if ($level == 3)
            $data_wilayah = $this->M_bkn->get_list_sekolah($wilayah);
        else if ($level == 4) {
            // $data_wilayah = $this->M_bkn->get_data_sekolah($npsn);
            $data_wilayah = $this->M_bkn->get_list_ptk($npsn);
        } else
            $data_wilayah = $this->M_bkn->get_rekap_wilayah($wilayah, $level);

        $breadcrumb = "";

        if ($level == 1) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $breadcrumb = "<a href='" . base_url('data_ptk') . "?param=" . $param . "'>Nasional</a> > " . $wilayah_level1->wilayah;
        } else if ($level == 2) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $breadcrumb = "<a href='" . base_url('data_ptk') . "?param=" . $param . "'>Nasional</a> > <a href='" . base_url('data_ptk?wilayah=' . $mstkode . '&level=1') . "&param=" . $param . "'>" . $wilayah_level1->wilayah . "</a> > " . $wilayah_level2->wilayah;
        } else if ($level == 3) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $wilayah_level3 = $this->M_bkn->get_nama_wilayah($wilayah, 3);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $mstkode2 = substr($wilayah, 0, 4) . "00";
            $breadcrumb = "<a href='" . base_url('data_ptk') . "?param=" . $param . "'>Nasional</a> > <a href='" . base_url('data_ptk?wilayah=' . $mstkode . '&level=1') . "&param=" . $param . "'>" . $wilayah_level1->wilayah . "</a> > <a href='" . base_url('data_ptk?wilayah=' . $mstkode2 . '&level=2') . "&param=" . $param . "'>" . $wilayah_level2->wilayah . "</a> > " . $wilayah_level3->wilayah;
        } else if ($level == 4) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $wilayah_level3 = $this->M_bkn->get_nama_wilayah($wilayah, 3);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $mstkode2 = substr($wilayah, 0, 4) . "00";
            $mstkode3 = substr($wilayah, 0, 6);
            $breadcrumb = "<a href='" . base_url('data_ptk') . "?param=" . $param . "'>Nasional</a> > <a href='" . base_url('data_ptk?wilayah=' . $mstkode . '&level=1') . "&param=" . $param . "'>" . $wilayah_level1->wilayah . "</a> > <a href='" . base_url('data_ptk?wilayah=' . $mstkode2 . '&level=2') . "&param=" . $param . "'>" . $wilayah_level2->wilayah .
                "</a> > <a href='" . base_url('data_ptk?wilayah=' . $mstkode3 . '&level=3') . "&param=" . $param . "'>" . $wilayah_level3->wilayah . "</a> > " . $data_wilayah[0]['sekolah'];
        }

        $data['wilayah'] = $wilayah;
        $data['npsn'] = $npsn;
        $data['level'] = $level;
        $data['param'] = $param;
        $data['data_wilayah'] = $data_wilayah;
        $data['breadcrumb'] = $breadcrumb;

        if ($level == 3) {
            return view('data_list_sekolah', $data);
        } else if ($level == 4) {
            return view('data_list_ptk', $data);
        } else
            return view('data_ptk', $data);
    }

    public function fetchdata_ptk()
    {

        $npsn = $this->request->getGet('npsn');
        $data = $this->M_bkn->get_list_ptk($npsn);

        $formattedData = [];
        $nomor = 0;
        foreach ($data as $row) {
            $nomor++;
            $formattedData[] = [
                $nomor,
                $row['nama'],
                $row['status_kepegawaian'],
                $this->formatValidity($row['valid_ptk']),
                $this->formatValidity($row['asn_vld_siak']),
                $this->formatValidity($row['asn_vld_bkn']),
                $this->formatValidity($row['asn_padan_nik_valid_nuptk']),
                $this->formatValidity($row['satminkal_valid']),
            ];
        }

        return $this->response->setJSON(['data' => $formattedData]);
    }

    private function formatValidity($value)
    {
        return ($value == 1) ? "✔" : "✘";
    }
}
