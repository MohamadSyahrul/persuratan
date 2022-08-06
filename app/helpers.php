<?php

use Carbon\Carbon;
use App\Models\SuratKeluar;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

function getBulanRomawi($bln){
    switch ($bln){
        case "01": 
            return "I";
            break;
        case "02":
            return "II";
            break;
        case "03":
            return "III";
            break;
        case "04":
            return "IV";
            break;
        case "05":
            return "V";
            break;
        case "06":
            return "VI";
            break;
        case "07":
            return "VII";
            break;
        case "08":
            return "VIII";
            break;
        case "09":
            return "IX";
            break;
        case "10":
            return "X";
            break;
        case "11":
            return "XI";
            break;
        case "12":
            return "XII";
            break;
    }
}
function bulanIndo($bln){
	switch ($bln){
		case 1: 
			return "Januari";
			break;
		case 2:
			return "Februari";
			break;
		case 3:
			return "Maret";
			break;
		case 4:
			return "April";
			break;
		case 5:
			return "Mei";
			break;
		case 6:
			return "Juni";
			break;
		case 7:
			return "Juli";
			break;
		case 8:
			return "Agustus";
			break;
		case 9:
			return "September";
			break;
		case 10:
			return "Oktober";
			break;
		case 11:
			return "November";
			break;
		case 12:
			return "Desember";
			break;
	}
} 

function tglIndo($tgl){
    $hari = date('l',strtotime($tgl));

    if ($hari == "Monday") {
        $hari = "Senin";
    } elseif ($hari == "Tuesday") {
        $hari = "Selasa";
    } elseif ($hari == "Wednesday") {
        $hari = "Rabu";
    } elseif ($hari == "Thursday") {
        $hari = "Kamis";
    } elseif ($hari == "Friday") {
        $hari = "Jumat";
    } elseif ($hari == "Saturday") {
        $hari = "Sabtu";
    } elseif ($hari == "Sunday") {
        $hari = "Minggu";
    } else {
        $hari = "-";
    }

    $tanggal = substr($tgl,8,2);
    $bulan = bulanIndo(substr($tgl,5,2));
    $tahun = substr($tgl,0,4);
    return $hari.', '.$tanggal.' '.$bulan.' '.$tahun;		 
}

function generateKode($kode){

    return $value = strtoupper(preg_replace("/[^bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ]/", "", $kode));

}

function GenerateNomorSurat($tanggal, $sifat, $perihal) {
    $date = strtotime($tanggal);
    $date_format = date('Y-m-d',$date);
    $tanggal = substr($date_format,8,2);
    $bulan = substr($date_format,5,2);
    $bulan_romawi = getBulanRomawi($bulan);
    $tahun = substr($date_format,2,2);

    $sft = generateKode($sifat);
    $nama = generateKode($perihal);

    return $kode = $nama . '/' . $sft . '/' . $tanggal . '/' . $bulan_romawi . '/' . $tahun;
}