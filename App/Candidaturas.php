<?php

namespace Desenv\Aula11;

class Candidaturas extends Connect
{

    public function setCandidaturas($idCandidato, $idVaga, $dataHoje, $status){
        $con = $this->con;
        $rs=$con->prepare("INSERT INTO candidatura (fk_id_candidato_candidatos, fk_id_vaga_vagas, data_candidatura, status_candidatura)
                             VALUE(?, ?, ?, ?)");
    
        $rs->bindParam(1, $idCandidato);
        $rs->bindParam(2, $idVaga);
        $rs->bindParam(3, $dataHoje);
        $rs->bindParam(4, $status);
    
        return $this->insert($rs);
    }



    public function getCandidaturas(){
        $con = $this->con;
        $rs = $con->prepare("SELECT id_candidatura, nome_candidato, nome_vaga, data_candidatura, status_candidatura
                             FROM candidatura JOIN candidatos ON id_candidato = fk_id_candidato_candidatos
                             JOIN vagas ON id_vaga = fk_id_vaga_vagas" );
        return $this->select($rs);
    }

    public function updateCandidatura($idCandidatura, $statusCandidatura){
        $con = $this->con;
        $rs=$con->prepare("UPDATE candidatura SET status_candidatura = ? WHERE id_candidatura = ?");
        $rs->bindParam(1, $statusCandidatura);
        $rs->bindParam(2, $idCandidatura);

        return $this->update($rs);

    }
    
    public function exclusaoLogicaCandidatura($id){
        $con = $this->con;
        $rs=$con->prepare("UPDATE candidatura SET status_candidatura = 'F' WHERE id_candidatura = ?");
        $rs->bindParam(1, $id);
        return $this->update($rs);
    }

}    