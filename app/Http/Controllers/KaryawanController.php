<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Routing\Annotation\Route;


class KaryawanController extends Controller
{
    public function generate_json() {
        $karyawans = DB::Table('m_karyawan')->get();
        $jabatan = DB::Table('m_jabatan')->get();
        $family = DB::Table('m_keluarga')->get();

        $data = [
            'EMP' => []
        ];

        foreach ($karyawans as $key => $karyawan) {
            $jabatan_karyawan = $jabatan->where('KD_JABATAN','=', $karyawan->KD_JABATAN)->first();
            $family_karyawans = $family->where('NO_BADGE', '=', $karyawan->NO_BADGE);

            $data['EMP'][$key] = [
                'NO_BADGE' => $karyawan->NO_BADGE,
                'NAMA' => $karyawan->NAMA,
                'SALUTATION' => $karyawan->SALUTATION,
                'TEMPAT_LAHIR' => $karyawan->TEMPAT_LAHIR,
                'DATE_OF_BIRTH' => $karyawan->DATE_OF_BIRTH,
                'JK' => $karyawan->JK,
                'STATUS_KAWIN' => $karyawan->STATUS_KAWIN,
                'UNIT_KERJA' => $karyawan->UNIT_KERJA,
                'KD_JABATAN' => $karyawan->KD_JABATAN,
                'STATUS' => $karyawan->STATUS,
                'DETAIL_JABATAN' => [
                    'KD_JABATAN' => $jabatan_karyawan->KD_JABATAN,
                    'DESC' => $jabatan_karyawan->DESC,
                    'RANK' => $jabatan_karyawan->RANK
                ],
                'FAMILY' => []
            ];

            foreach ($family_karyawans as $family_karyawan) {
                $data['EMP'][$key]['FAMILY'][] = [
                    'FAMILY_ID' => $family_karyawan->FAMILY_ID,
                    'NO_BADGE' => $family_karyawan->NO_BADGE,
                    'RELATIVE' => $family_karyawan->RELATIVE,
                    'NAMA' => $family_karyawan->NAMA,
                    'GENDER' => $family_karyawan->GENDER
                ];
            }
        }
        return $data;
    }

    public function dashboard() {
        $request = Request::create('/api/karyawan-json', 'GET');
        $response = app()->handle($request);

        $json = $response->getContent();

        $json = json_decode($json, true);

        $karyawan_male = count(array_filter($json["EMP"],function($a) {return $a["JK"]=="Male";}));
        $karyawan_female = count(array_filter($json["EMP"],function($a) {return $a["JK"]=="Female";}));

        $jabatan = array_map(function ($a) {return $a['DETAIL_JABATAN']["DESC"];}, $json["EMP"]);
        $jabatan = array_count_values($jabatan);


        $collection = collect($jabatan);
        $jabatan = $collection->chunk(1);
        $jabatan = $jabatan->toArray();
        //$jabatan = array_chunk($jabatan, 1, true);
        array_unshift($jabatan, ['Jabatan', 'Jumlah']);

        $jabatan = json_encode($jabatan);
        $jabatan = str_replace('{','[', $jabatan);
        $jabatan = str_replace('}',']', $jabatan);
        $jabatan = str_replace(':',',', $jabatan);

        return view('dashboard', compact(  'karyawan_male','karyawan_female', 'jabatan'));
    }
}


