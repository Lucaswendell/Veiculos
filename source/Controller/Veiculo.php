<?php

namespace Source\Controller;

use Source\Model\VeiculoDao;
use Source\Model\VeiculoModel;

class Veiculo extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function home(): void
    {
        $veiculo = new VeiculoDao();
        $veiculos = $veiculo->fetch();

        echo $this->view->render("home", [
            "title" => "Veiculos",
            "veiculos" => $veiculos
        ]);
    }

    public function pesquisa(array $data)
    {
        $q = strtoupper(addslashes(htmlspecialchars_decode($data['q'])));
        $modo =  addslashes(htmlspecialchars_decode($data['modo']));

        if (empty($q) || empty($modo)) {
            http_response_code(400);
            echo $this->ajaxResponse("veiculo", ["error" => "Pesquisa vazia."]);
            die();
        }

        $veiculoDao = new VeiculoDao();

        if ($modo === "placa") {
            $veiculo = $veiculoDao->fetchPlaca($q);

            if (!$veiculo) {
                http_response_code(400);
                echo $this->ajaxResponse("veiculo", ["error" => "Placa não encontrada no registro."]);
                die();
            }

            echo $this->ajaxResponse("veiculo", [
                "id" => $veiculo->id,
                "placa" => $veiculo->placa,
                "modelo" => $veiculo->modelo,
                "dataCadastro" => date("d/m/yy", strtotime($veiculo->dataCadastro)),
                "marca" =>  $veiculo->marca
            ]);
        } else {
            $veiculos = $veiculoDao->fetchMarca($q);

            if (!$veiculos) {
                http_response_code(400);
                echo $this->ajaxResponse("veiculo", ["error" => "Marca não encontrada no registro."]);
                die();
            }

            $veiculoArray = [];
            foreach ($veiculos as $veiculo) {
                array_push($veiculoArray, [
                    "id" => $veiculo->getId(),
                    "placa" => $veiculo->getPlaca(),
                    "modelo" => $veiculo->getModelo(),
                    "dataCadastro" => date("d/m/yy", strtotime($veiculo->getDataCadastro())),
                    "marca" =>  $veiculo->getMarca()
                ]);
            }
            echo $this->ajaxResponse("veiculos", $veiculoArray);
        }
    }

    public function adicionar(array $data): void
    {

        $veiculo = new VeiculoDao();
        $veiculoModel = new VeiculoModel();

        if (empty($data["placa"]) || empty($data["modelo"]) || empty($data["marca"])) {
            http_response_code(400);
            echo $this->ajaxResponse("veiculo", ["error" => "Preencha todos os campos."]);
            die();
        }

        $veiculoModel->setPlaca(strtoupper($data["placa"]));
        $veiculoModel->setModelo(strtoupper($data["modelo"]));
        $veiculoModel->setMarca(strtoupper($data["marca"]));

        if ($veiculo->fetchPlaca($veiculoModel->getPlaca())) {
            http_response_code(400);
            echo $this->ajaxResponse("veiculo", ["error" => "Placa já cadastrada."]);
            die();
        }

        $veiculoModel = $veiculo->save($veiculoModel);
        if ($veiculoModel) {
            echo $this->ajaxResponse("veiculo", [
                "id" => $veiculoModel->getId(),
                "placa" => $veiculoModel->getPlaca(),
                "modelo" => $veiculoModel->getModelo(),
                "dataCadastro" => $veiculoModel->getDataCadastro(),
                "marca" =>  $veiculoModel->getMarca()
            ]);
        } else {
            http_response_code(400);
            echo $this->ajaxResponse("veiculo", ["error" => "Erro ao cadastrar veiculo."]);
            die();
        }
    }



    public function excluir(array $data)
    {
        $id = addslashes($data["id"]);
        $id = htmlspecialchars_decode($id);

        if (empty($id)) {
            http_response_code(400);
            echo $this->ajaxResponse("veiculo", ["error" => "Veiculo invalido."]);
            die();
        }

        $veiculo = new VeiculoDao();
        if ($veiculo->delete($id)) {
            echo $this->ajaxResponse("veiculo", ["success" => "Veiculo deletado com sucesso."]);
        } else {
            http_response_code(400);
            echo $this->ajaxResponse("veiculo", ["error" => "Erro ao deletar veiculo."]);
            die();
        }
    }

    public function editar(array $data)
    {
        if (empty($data["placa"]) || empty($data["modelo"]) || empty($data["marca"])) {
            http_response_code(400);
            echo $this->ajaxResponse("veiculo", ["error" => "Preencha todos os campos."]);
            die();
        }


        $veiculoDao = new VeiculoDao();
        $veiculo = new VeiculoModel();
        $veiculo->setId($data["id"]);
        $veiculo->setPlaca(strtoupper($data["placa"]));
        $veiculo->setModelo(strtoupper($data["modelo"]));
        $veiculo->setMarca(strtoupper($data["marca"]));

        $veiculoAntigo = $veiculoDao->fetchPlaca($veiculo->getPlaca());

        if ($veiculoAntigo && $veiculoAntigo->id != $veiculo->getId()) {
            http_response_code(400);
            echo $this->ajaxResponse("veiculo", ["error" => "Placa já cadastrada."]);
            die();
        }

        if ($veiculoDao->save($veiculo)) {
            echo $this->ajaxResponse("veiculo", ["success" => "Veiculo editado com sucesso."]);
        } else {
            http_response_code(400);
            echo $this->ajaxResponse("veiculo", ["error" => "Erro ao editar veiculo."]);
        }
    }

    public function formEditar(array $data)
    {
        $id = addslashes($data["id"]);
        $id = htmlspecialchars_decode($id);

        if (empty($id)) {
            http_response_code(400);
            echo $this->ajaxResponse("veiculo", ["error" => "Veiculo invalido."]);
            die();
        }

        $veiculoDao = new VeiculoDao();
        $veiculo = $veiculoDao->fetch($id);

        echo $this->view->render("formEditar", [
            "title" => "Veiculo | Editar",
            "veiculo" => $veiculo
        ]);
    }

    public function formAdicionar(): void
    {
        echo $this->view->render("formAdicionar", [
            "title" => "Veiculos | Adicionar veiculos"
        ]);
    }



    public function error(array $data): void
    {
        echo $data["errcode"];
    }
}
