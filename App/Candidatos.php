<?php


namespace Desenv\Aula11;

class Candidatos extends Connect
{



    public function setCandidato($nome, $email, $tel, $cidade, $estado, $idioma, $resumoProf, $presencial, $statusCandidato){
        $con = $this->con;
        $rs=$con->prepare("INSERT INTO candidatos (nome_candidato, email_candidato, telefone_candidato,
         cidade_candidato, estado_candidato, idioma_candidato, resumo_candidato, presencial, status_candidato)
          VALUE(:nomeCandidato, :emailCandidato, :telCandidato, :cidadeCandidato, :estadoCandidato, :idiomaCandidato,
          :resumoCandidato, :presencialCandidato, :statusCandidato)");

        $rs->bindParam('nomeCandidato', $nome);
        $rs->bindParam('emailCandidato', $email);
        $rs->bindParam('telCandidato', $tel);
        $rs->bindParam('cidadeCandidato', $cidade);
        $rs->bindParam('estadoCandidato', $estado);
        $rs->bindParam('idiomaCandidato', $idioma);
        $rs->bindParam('resumoCandidato', $resumoProf);
        $rs->bindParam('presencialCandidato', $presencial);
        $rs->bindParam('statusCandidato', $statusCandidato);

        return $this->insert($rs);
    }

    public function getCandidatos(){
        $con = $this->con;
        $rs = $con->prepare("SELECT * FROM candidatos" );
        return $this->select($rs);
    }
    public function getCandidatosByName($nomeCandidato){
        $con = $this->con;
        $rs = $con->prepare("SELECT id_candidato, nome_candidato
                             FROM candidatos WHERE nome_candidato = ?" );

        $rs->bindParam(1, $nomeCandidato);
        return $this->select($rs);
    }

    public function updateCandidatos($id, $nome, $email, $tel, $cidade, $estado, $idioma, $resumoProf, $presencial, $status){
        $con = $this->con;
        $rs=$con->prepare("UPDATE candidatos SET nome_candidato= ?, email_candidato  = ?, 
                        telefone_candidato = ?, cidade_candidato = ?,
                        estado_candidato = ?, idioma_candidato = ?,
                        resumo_candidato = ?, presencial = ?,
                        status_candidato =? WHERE id_candidato = ?");
                        
        $rs->bindParam(1, $nome);
        $rs->bindParam(2, $email);
        $rs->bindParam(3, $tel);
        $rs->bindParam(4, $cidade);
        $rs->bindParam(5, $estado);
        $rs->bindParam(6, $idioma);
        $rs->bindParam(7, $resumoProf);
        $rs->bindParam(8, $presencial);
        $rs->bindParam(9, $status);
        $rs->bindParam(10, $id);

         return $this->update($rs);
        /* $this->update($rs);
        $rs->debugDumpParams(); */
    }
    public function exclusaoLogicaCandidato($id){
        $con = $this->con;
        $rs=$con->prepare("UPDATE candidatos SET status_candidato = 'F' WHERE id_candidato = ? ");

        $rs->bindParam(1, $id);
        return $this->update($rs);
    }

    public function searchCandidatosByName($nomeDoCandidato){
        $con= $this->con;
        $rs=$con->prepare("SELECT * FROM candidatos WHERE nome_candidato or email_candidato LIKE ? ");
        

        $var = '%' . $nomeDoCandidato . '%';

        $rs->bindParam(1, $var);
        return $this->select($rs); 
    }

 





}