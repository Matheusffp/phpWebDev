<?php

namespace Desenv\Aula11;


class Vagas extends Connect
{


    public function getVagasAtivas(){
        $con = $this->con;
        $rs = $con->prepare("SELECT id_vaga, nome_vaga, descricao_vaga, salario_vaga
                             FROM vagas WHERE status_vaga = 'V'" );
        return $this->select($rs);
    }

    public function getVagas(){
        $con = $this->con;
        $rs = $con->prepare("SELECT id_vaga, nome_vaga, descricao_vaga, salario_vaga, status_vaga
                             FROM vagas" );
        return $this->select($rs);
    }
    public function getVagasByName($nomeVaga){
        $con = $this->con;
        $rs = $con->prepare("SELECT id_vaga, nome_vaga, descricao_vaga, salario_vaga, status_vaga
                             FROM vagas WHERE nome_vaga = ?" );

        $rs->bindParam(1, $nomeVaga);
        return $this->select($rs);
    }

    public function setVagas($nome, $descricao, $salario, $status){
        $con = $this->con;
        $rs=$con->prepare("INSERT INTO vagas (nome_vaga, descricao_vaga, salario_vaga, status_vaga) VALUE(:nomeVaga, :descricaoVaga, :salarioVaga, :statusVaga)");

        $rs->bindParam('nomeVaga', $nome);
        $rs->bindParam('descricaoVaga', $descricao);
        $rs->bindParam('salarioVaga', $salario);
        $rs->bindParam('statusVaga', $status);

        return $this->insert($rs);
    }

    public function updateVagas($idVaga, $nomeVaga, $descricaoVaga, $salarioVaga, $statusVaga){
        $con = $this->con;
        $rs=$con->prepare("UPDATE vagas SET nome_vaga= :nomeVaga, descricao_vaga  = :descricaoVaga, 
                            salario_vaga = :salarioVaga, status_vaga = :statusVaga WHERE id_vaga = :idVaga");
        $rs->bindParam('nomeVaga', $nomeVaga);
        $rs->bindParam('descricaoVaga', $descricaoVaga);
        $rs->bindParam('statusVaga', $statusVaga);
        $rs->bindParam('salarioVaga', $salarioVaga);
        $rs->bindParam('idVaga', $idVaga);

        return $this->update($rs);

    }

    public function exclusaoLogicaVaga($id){
        $con = $this->con;
        $rs=$con->prepare("UPDATE vagas SET status_vaga = 'F' WHERE id_vaga = ? ");

        $rs->bindParam(1, $id);

        return $this->update($rs);
    }

}