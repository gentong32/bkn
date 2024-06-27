<?php

namespace App\Controllers;

use App\Models\M_bkn;

class Residu extends BaseController
{

    function __construct()
    {
        $this->M_bkn = new M_bkn();
        helper('bkn');
    }

    public function index()
    {
        //
    }

    public function kependudukan()
    {
        return $this->loaddata('kependudukan');
    }

    public function kepegawaian()
    {
        return $this->loaddata('kepegawaian');
    }

    public function nuptk()
    {
        return $this->loaddata('nuptk');
    }

    public function satminkal()
    {
        return $this->loaddata('satminkal');
    }

    private function loaddata($sasaran)
    {
        $request = \Config\Services::request();
        $wilayah = $request->getVar('wilayah') ?? '000000';
        $npsn = $request->getVar('npsn') ?? '';
        $level = $request->getVar('level') ?? '0';
        $param = $request->getVar('param') ?? '1';

        $data = array();
        if ($level == 3) {
            $data_wilayah = $this->M_bkn->get_list_sekolah($wilayah, $sasaran);
        } else if ($level == 4) {
            $data_wilayah = $this->M_bkn->get_list_ptk($npsn, $sasaran);
        } else
            $data_wilayah = $this->M_bkn->get_rekap_wilayah($wilayah, $level);

        $breadcrumb = "";

        if ($level == 1) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $breadcrumb = "<a href='" . base_url('residu/' . $sasaran) . "?param=" . $param . "'>Nasional</a> > " . $wilayah_level1->wilayah;
        } else if ($level == 2) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $breadcrumb = "<a href='" . base_url('residu/' . $sasaran) . "?param=" . $param . "'>Nasional</a> > <a href='" . base_url('residu/' . $sasaran . '?wilayah=' . $mstkode . '&level=1') . "&param=" . $param . "'>" . $wilayah_level1->wilayah . "</a> > " . $wilayah_level2->wilayah;
        } else if ($level == 3) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $wilayah_level3 = $this->M_bkn->get_nama_wilayah($wilayah, 3);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $mstkode2 = substr($wilayah, 0, 4) . "00";
            $breadcrumb = "<a href='" . base_url('residu/' . $sasaran) . "?param=" . $param . "'>Nasional</a> > <a href='" . base_url('residu/' . $sasaran . '?wilayah=' . $mstkode . '&level=1') . "&param=" . $param . "'>" . $wilayah_level1->wilayah . "</a> > <a href='" . base_url('residu/' . $sasaran . '?wilayah=' . $mstkode2 . '&level=2') . "&param=" . $param . "'>" . $wilayah_level2->wilayah . "</a> > " . $wilayah_level3->wilayah;
        } else if ($level == 4) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $wilayah_level3 = $this->M_bkn->get_nama_wilayah($wilayah, 3);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $mstkode2 = substr($wilayah, 0, 4) . "00";
            $mstkode3 = substr($wilayah, 0, 6);
            $breadcrumb = "<a href='" . base_url('residu/' . $sasaran) . "?param=" . $param . "'>Nasional</a> > <a href='" . base_url('residu/' . $sasaran . '?wilayah=' . $mstkode . '&level=1') . "&param=" . $param . "'>" . $wilayah_level1->wilayah . "</a> > <a href='" . base_url('residu/' . $sasaran . '?wilayah=' . $mstkode2 . '&level=2') . "&param=" . $param . "'>" . $wilayah_level2->wilayah .
                "</a> > <a href='" . base_url('residu/' . $sasaran . '?wilayah=' . $mstkode3 . '&level=3') . "&param=" . $param . "'>" . $wilayah_level3->wilayah . "</a> > " . $data_wilayah[0]['sekolah'];
        }

        $data['wilayah'] = $wilayah;
        $data['npsn'] = $npsn;
        $data['level'] = $level;
        $data['param'] = $param;
        $data['data_wilayah'] = $data_wilayah;
        $data['breadcrumb'] = $breadcrumb;

        if ($level == 3)
            return view('res_' . $sasaran . '_sekolah', $data);
        else if ($level == 4)
            return view('res_' . $sasaran . '_ptk', $data);
        else
            return view('res_' . $sasaran, $data);
    }

    public function kepegawaians()
    {
        $request = \Config\Services::request();
        $wilayah = $request->getVar('wilayah') ?? '000000';
        $npsn = $request->getVar('npsn') ?? '';
        $level = $request->getVar('level') ?? '0';

        $data = array();
        if ($level == 3)
            $data_wilayah = $this->M_bkn->get_list_sekolah($wilayah, "nip");
        else if ($level == 4)
            $data_wilayah = $this->M_bkn->get_list_ptk($npsn, "residu");
        else
            $data_wilayah = $this->M_bkn->get_rekap_wilayah($wilayah, $level);

        $breadcrumb = "";

        if ($level == 1) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $breadcrumb = "<a href='" . base_url('residu/kepegawaian') . "'>Nasional</a> > " . $wilayah_level1->wilayah;
        } else if ($level == 2) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $breadcrumb = "<a href='" . base_url('residu/kepegawaian') . "'>Nasional</a> > <a href='" . base_url('residu/kepegawaian?wilayah=' . $mstkode . '&level=1') . "'>" . $wilayah_level1->wilayah . "</a> > " . $wilayah_level2->wilayah;
        } else if ($level == 3) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $wilayah_level3 = $this->M_bkn->get_nama_wilayah($wilayah, 3);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $mstkode2 = substr($wilayah, 0, 4) . "00";
            $breadcrumb = "<a href='" . base_url('residu/kepegawaian') . "'>Nasional</a> > <a href='" . base_url('residu/kepegawaian?wilayah=' . $mstkode . '&level=1') . "'>" . $wilayah_level1->wilayah . "</a> > <a href='" . base_url('residu/kepegawaian?wilayah=' . $mstkode2 . '&level=2') . "'>" . $wilayah_level2->wilayah . "</a> > " . $wilayah_level3->wilayah;
        } else if ($level == 4) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $wilayah_level3 = $this->M_bkn->get_nama_wilayah($wilayah, 3);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $mstkode2 = substr($wilayah, 0, 4) . "00";
            $mstkode3 = substr($wilayah, 0, 6);
            $breadcrumb = "<a href='" . base_url('residu/kepegawaian') . "'>Nasional</a> > <a href='" . base_url('residu/kepegawaian?wilayah=' . $mstkode . '&level=1') . "'>" . $wilayah_level1->wilayah . "</a> > <a href='" . base_url('residu/kepegawaian?wilayah=' . $mstkode2 . '&level=2') . "'>" . $wilayah_level2->wilayah .
                "</a> > <a href='" . base_url('residu/kepegawaian?wilayah=' . $mstkode3 . '&level=3') . "'>" . $wilayah_level3->wilayah . "</a> > " . $data_wilayah[0]['sekolah'];
        }

        $data['wilayah'] = $wilayah;
        $data['npsn'] = $npsn;
        $data['level'] = $level;
        $data['data_wilayah'] = $data_wilayah;
        $data['breadcrumb'] = $breadcrumb;

        if ($level == 3)
            return view('res_kepegawaian_sekolah', $data);
        else if ($level == 4)
            return view('res_kepegawaian_ptk', $data);
        else
            return view('res_kepegawaian', $data);
    }

    public function satminkal2()
    {
        $request = \Config\Services::request();
        $wilayah = $request->getVar('wilayah') ?? '000000';
        $npsn = $request->getVar('npsn') ?? '';
        $level = $request->getVar('level') ?? '0';

        $data = array();
        if ($level == 3)
            $data_wilayah = $this->M_bkn->get_list_sekolah($wilayah);
        else if ($level == 4)
            $data_wilayah = $this->M_bkn->get_list_ptk($npsn);
        else
            $data_wilayah = $this->M_bkn->get_rekap_wilayah($wilayah, $level);

        $breadcrumb = "";

        if ($level == 1) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $breadcrumb = "<a href='" . base_url('data_ptk') . "'>Nasional</a> > " . $wilayah_level1->wilayah;
        } else if ($level == 2) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $breadcrumb = "<a href='" . base_url('data_ptk') . "'>Nasional</a> > <a href='" . base_url('data_ptk?wilayah=' . $mstkode . '&level=1') . "'>" . $wilayah_level1->wilayah . "</a> > " . $wilayah_level2->wilayah;
        } else if ($level == 3) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $wilayah_level3 = $this->M_bkn->get_nama_wilayah($wilayah, 3);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $mstkode2 = substr($wilayah, 0, 4) . "00";
            $breadcrumb = "<a href='" . base_url('data_ptk') . "'>Nasional</a> > <a href='" . base_url('data_ptk?wilayah=' . $mstkode . '&level=1') . "'>" . $wilayah_level1->wilayah . "</a> > <a href='" . base_url('data_ptk?wilayah=' . $mstkode2 . '&level=2') . "'>" . $wilayah_level2->wilayah . "</a> > " . $wilayah_level3->wilayah;
        } else if ($level == 4) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $wilayah_level3 = $this->M_bkn->get_nama_wilayah($wilayah, 3);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $mstkode2 = substr($wilayah, 0, 4) . "00";
            $mstkode3 = substr($wilayah, 0, 6);
            $breadcrumb = "<a href='" . base_url('data_ptk') . "'>Nasional</a> > <a href='" . base_url('data_ptk?wilayah=' . $mstkode . '&level=1') . "'>" . $wilayah_level1->wilayah . "</a> > <a href='" . base_url('data_ptk?wilayah=' . $mstkode2 . '&level=2') . "'>" . $wilayah_level2->wilayah .
                "</a> > <a href='" . base_url('data_ptk?wilayah=' . $mstkode3 . '&level=3') . "'>" . $wilayah_level3->wilayah . "</a> > " . $data_wilayah[0]['sekolah'];
        }

        $data['wilayah'] = $wilayah;
        $data['npsn'] = $npsn;
        $data['level'] = $level;
        $data['data_wilayah'] = $data_wilayah;
        $data['breadcrumb'] = $breadcrumb;

        if ($level >= 3)
            return view('data_kosong', $data);
        else
            return view('res_satminkal', $data);
    }

    public function nuptk2()
    {
        $request = \Config\Services::request();
        $wilayah = $request->getVar('wilayah') ?? '000000';
        $npsn = $request->getVar('npsn') ?? '';
        $level = $request->getVar('level') ?? '0';

        $data = array();
        if ($level == 3)
            $data_wilayah = $this->M_bkn->get_list_sekolah($wilayah, "nuptk");
        else if ($level == 4)
            $data_wilayah = $this->M_bkn->get_list_ptk($npsn, "residu");
        else
            $data_wilayah = $this->M_bkn->get_rekap_wilayah($wilayah, $level);

        $breadcrumb = "";

        if ($level == 1) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $breadcrumb = "<a href='" . base_url('residu/nuptk') . "'>Nasional</a> > " . $wilayah_level1->wilayah;
        } else if ($level == 2) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $breadcrumb = "<a href='" . base_url('residu/nuptk') . "'>Nasional</a> > <a href='" . base_url('residu/nuptk?wilayah=' . $mstkode . '&level=1') . "'>" . $wilayah_level1->wilayah . "</a> > " . $wilayah_level2->wilayah;
        } else if ($level == 3) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $wilayah_level3 = $this->M_bkn->get_nama_wilayah($wilayah, 3);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $mstkode2 = substr($wilayah, 0, 4) . "00";
            $breadcrumb = "<a href='" . base_url('residu/nuptk') . "'>Nasional</a> > <a href='" . base_url('residu/nuptk?wilayah=' . $mstkode . '&level=1') . "'>" . $wilayah_level1->wilayah . "</a> > <a href='" . base_url('residu/nuptk?wilayah=' . $mstkode2 . '&level=2') . "'>" . $wilayah_level2->wilayah . "</a> > " . $wilayah_level3->wilayah;
        } else if ($level == 4) {
            $wilayah_level1 = $this->M_bkn->get_nama_wilayah($wilayah, 1);
            $wilayah_level2 = $this->M_bkn->get_nama_wilayah($wilayah, 2);
            $wilayah_level3 = $this->M_bkn->get_nama_wilayah($wilayah, 3);
            $mstkode = substr($wilayah, 0, 2) . "0000";
            $mstkode2 = substr($wilayah, 0, 4) . "00";
            $mstkode3 = substr($wilayah, 0, 6);
            $breadcrumb = "<a href='" . base_url('residu/nuptk') . "'>Nasional</a> > <a href='" . base_url('residu/nuptk?wilayah=' . $mstkode . '&level=1') . "'>" . $wilayah_level1->wilayah . "</a> > <a href='" . base_url('residu/nuptk?wilayah=' . $mstkode2 . '&level=2') . "'>" . $wilayah_level2->wilayah .
                "</a> > <a href='" . base_url('residu/nuptk?wilayah=' . $mstkode3 . '&level=3') . "'>" . $wilayah_level3->wilayah . "</a> > " . $data_wilayah[0]['sekolah'];
        }

        $data['wilayah'] = $wilayah;
        $data['npsn'] = $npsn;
        $data['level'] = $level;
        $data['data_wilayah'] = $data_wilayah;
        $data['breadcrumb'] = $breadcrumb;

        if ($level == 3)
            return view('res_nuptk_sekolah', $data);
        else if ($level == 4)
            return view('res_nuptk_ptk', $data);
        else
            return view('res_nuptk', $data);
    }
}
