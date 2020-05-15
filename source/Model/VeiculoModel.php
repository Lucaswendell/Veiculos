<?php

namespace Source\Model;

class VeiculoModel
{
    private $id;
    private $marca;
    private $modelo;
    private $placa;
    private $dataCadastro;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getMarca(): string
    {
        return $this->marca;
    }
    public function setMarca(string $marca): void
    {
        $this->marca = $marca;
    }

    public function getModelo(): string
    {
        return $this->modelo;
    }
    public function setModelo(string $modelo): void
    {
        $this->modelo = $modelo;
    }

    public function getPlaca(): string
    {
        return $this->placa;
    }
    public function setPlaca(string $placa): void
    {
        $this->placa = $placa;
    }

    public function getDataCadastro(): ?string
    {
        return $this->dataCadastro;
    }
    public function setDataCadastro(string $dataCadastro): void
    {
        $this->dataCadastro = $dataCadastro;
    }
}
