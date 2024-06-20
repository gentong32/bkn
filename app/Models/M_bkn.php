<?php

namespace App\Models;

use CodeIgniter\Model;

class M_bkn extends Model
{
    public function get_provinsi()
    {
        $sql = 'SELECT kode_wilayah, wilayah FROM BKN.report.agg_ptk  
                WHERE id_level_wilayah = 1';

        $query = $this->db->query($sql);

        return $query->getResultArray();
    }

    public function get_kabupaten($provinsi)
    {
        $sql = 'SELECT kode_wilayah, wilayah FROM BKN.report.agg_ptk  
                WHERE id_level_wilayah = 2 AND mst_kode_wilayah=:provinsi:';

        $query = $this->db->query($sql, [
            'provinsi' => $provinsi
        ]);

        return $query->getResultArray();
    }

    public function get_data_wilayah($provinsi, $kabupaten)
    {
        $kode_wilayah = $provinsi;
        if ($kabupaten != "0")
            $kode_wilayah = $kabupaten;

        $sql = 'SELECT * FROM BKN.report.agg_ptk  
                WHERE kode_wilayah = :kode_wilayah:';

        $query = $this->db->query($sql, [
            'kode_wilayah' => $kode_wilayah
        ]);

        return $query->getRowArray();
    }

    public function get_rekap_wilayah($wilayah, $level)
    {
        $sql = 'SELECT * FROM BKN.report.agg_ptk  
                WHERE mst_kode_wilayah = :wilayah:';

        $query = $this->db->query($sql, [
            'wilayah' => $wilayah
        ]);

        return $query->getResultArray();
    }

    public function get_data_sekolah($npsn)
    {
        $sql = 'SELECT * FROM Arsip.dbo.sekolah  
                WHERE npan = :npsn:';

        $query = $this->db->query($sql, [
            'npsn' => $npsn
        ]);

        return $query->getRowArray();
    }

    public function get_nama_wilayah($wilayah, $level)
    {
        $pj = $level * 2;
        $sql = 'SELECT wilayah FROM BKN.report.agg_ptk  
                WHERE LEFT(kode_wilayah,:pj:) = LEFT(:wilayah:,:pj:) AND id_level_wilayah=:level:';

        $query = $this->db->query($sql, [
            'wilayah' => $wilayah,
            'pj' => $pj,
            'level' => $level,
        ]);

        return $query->getRow();
    }

    public function get_list_sekolah($wilayah, $asal = null)
    {
        $sqlasal = "";
        if ($asal == "kependudukan")
            $sqlasal = " AND (asn - asn_vld_siak)>0";
        else if ($asal == "kepegawaian")
            $sqlasal = " AND (asn - asn_vld_bkn)>0";
        else if ($asal == "nuptk")
            $sqlasal = " AND (asn - asn_padan_nik_valid_nuptk)>0";
        else if ($asal == "satminkal")
            $sqlasal = " AND (asn - satminkal_valid)>0";

        $sql = 'SELECT * FROM BKN.dbo.fn_kec_ptk(:wilayah:) WHERE asn>0' . $sqlasal;

        $query = $this->db->query($sql, [
            'wilayah' => $wilayah,
        ]);

        return $query->getResultArray();
    }

    public function get_list_ptk($wilayah, $asal = null)
    {
        $sqlasal = "";
        if ($asal == "kependudukan")
            $sqlasal = " WHERE asn_vld_siak=0";
        else if ($asal == "kepegawaian")
            $sqlasal = " WHERE asn_vld_bkn=0";
        else if ($asal == "nuptk")
            $sqlasal = " WHERE asn_padan_nik_valid_nuptk=0";
        else if ($asal == "satminkal")
            $sqlasal = " WHERE satminkal_valid=0";

        $sql = "SELECT * from BKN.dbo.fn_npsn_ptk(:wilayah:)" . $sqlasal;

        $query = $this->db->query($sql, [
            'wilayah' => $wilayah,
        ]);

        return $query->getResultArray();
    }

    public function getTokenSSO($tokenKey)
    {
        $this->db = \Config\Database::connect("dbsso");
        $sql = "EXEC sdm.dbo.sp_sso_checkToken :token:";
        $query = $this->db->query($sql, ['token' => $tokenKey]);
        $result =  $query->getRow();
        return $result;
    }

    public function getAkunSSO($tokenKey)
    {
        $this->db = \Config\Database::connect("dbsso");
        $sql = "EXEC sdm.dbo.sp_sso_getUsername :token:";
        $query = $this->db->query($sql, ['token' => $tokenKey]);
        $result =  $query->getRow();
        return $result;
    }
}
