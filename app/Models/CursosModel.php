<?php namespace App\Models;

use CodeIgniter\Model;


class CursosModel extends Model{
    protected $table = "cursos";
    protected $allowedFields = ['titulo','descripcion','instructor','imagen','precio'];
    protected $useTimestamps = true;
    protected $createField = 'created_at';
    protected $updatedField = 'updated_at';
}