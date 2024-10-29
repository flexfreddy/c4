<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PacienteModel;
use CodeIgniter\RESTful\ResourceController;

class Paciente extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        //$this->model=$this->setModel(new PacienteModel());
        
    }
    public function index()
    {

        try{
            $pacientes = new PacienteModel();
            return $this->respond(['pacientes'=>$pacientes->getPacientes()],200);
        }
    catch (\Exception $ex){
        exit($ex->getMessage());
        return $this->respond(['message' => 'Error:'+$ex->getMessage()], 500);
    }
    }

    public function pacienteBy($id=null)
    {
        try{
            $pacientes = new PacienteModel();
            return $this->respond(['paciente'=>$pacientes->getPaciente($id)],200);
        }
    catch (\Exception $ex){
        exit($ex->getMessage());
        return $this->respond(['message' => 'Error:'+$ex->getMessage()], 500);
    }
    }

    public function crearPaciente()
    {
        try{
            $paciente=$this->request->getJSON();
            $pacientes = new PacienteModel();
            if($pacientes->insert($paciente)){
                $paciente->id_paciente=$pacientes->insertID();
                return $this->respondCreated($paciente);
            }else{
            return $this->failValidationErrors($pacientes->validation->listErrors());
            }

        }
    catch (\Exception $ex){
        exit($ex->getMessage());
        return $this->respond(['message' => 'Error:'+$ex->getMessage()], 500);
    }
    }

    public function modificarPaciente($id=null)
    {
        try{
            $pacientes = new PacienteModel();
            if($id==null){
                return $this->failValidationError("No se ha pasado ningun id valido!");
            }
                

            $paciente=$this->request->getJSON();
           
            if($pacientes->update($id,$paciente)){
                $paciente->id_paciente=$id;
                return $this->respondUpdated($paciente);
            }else{
            return $this->failValidationErrors($pacientes->validation->listErrors());
            }
        }
    catch (\Exception $ex){
        exit($ex->getMessage());
        return $this->respond(['message' => 'Error:'+$ex->getMessage()], 500);
    }
    }

}
?>