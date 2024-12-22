<?php
namespace App\Controllers;

class Coba extends BaseController
{
    public function index()
    {
        echo view('latihan');
    }

    public function simpan()
    {
        $db=\Config\Database::connec();
        $data = [

        ]
    }
}
?>

