<?php

namespace App\Models;

use CodeIgniter\Model;

class PacienteModel extends Model
{
    protected $table      = 'paciente';

    protected $primaryKey       = 'id_paciente';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre', 'direccion','correo', 'created_at','updated_at'];

    
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'adicionado_por';
    protected $updatedField  = 'modificado_por';

    
    // Validation
    protected $validationRules      = ['nombre' => 'required|min_length[4]|max_length[150]',
                                       'direccion' => 'min_length[5]|max_length[200]',
                                       'correo' => 'required|min_length[4]|max_length[255]|valid_email'];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
    

  
    public function getPaciente($id)
    {
        return $this->where("id_paciente=" . $id)->find();
    }
    public function getPacientes()
    {
        return $this->findAll();
    }
    public function addPaciente($data)
    {
        $inserta = $this->insert($data, false);
        if ($inserta) {
            return $this->getInsertID();
        }
    }
    public function updatePaciente($data, $id)
    {
        $this->update($id, $data);
    }
    public function deletePaciente($id)
    {
        $this->delete($id);
    }
}
