<?php

namespace Source\Model;

use Error;
use Exception;
use PDO;
use Source\Controller\Connection;
use Source\Model\VeiculoModel;

class VeiculoDao
{
    public function save(VeiculoModel $v)
    {
        try {

            $con = Connection::getConnection();
            if ($con == null) throw new Error("Conexão falhou.");

            if (!$v->getId()) {
                $sql = "INSERT INTO Veiculos(placa, modelo, marca) VALUES (:placa, :modelo, :marca);";

                $stmt = $con->prepare($sql);
                $stmt->bindValue(":placa", $v->getPlaca());
                $stmt->bindValue(":modelo", $v->getModelo());
                $stmt->bindValue(":marca", $v->getMarca());

                if ($stmt->execute()) {
                    $v->setId($con->lastInsertId());
                } else {
                    throw new Exception("Erro no cadastrar");
                }
            } else {
                $sql = "UPDATE Veiculos SET placa = :placa, modelo = :modelo, marca = :marca WHERE id = :id;";
                $stmt = $con->prepare($sql);

                $stmt->bindValue(":placa", $v->getPlaca());
                $stmt->bindValue(":modelo", $v->getModelo());
                $stmt->bindValue(":marca", $v->getMarca());
                $stmt->bindValue(":id", $v->getId());

                if ($stmt->execute()) {
                    $v = true;
                } else {
                    throw new Exception("Erro no cadastrar");
                }
            }
        } catch (Error $e) {
            echo $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        } finally {
            Connection::close($con);
        }
        return $v;
    }

    public function fetch(int $id = null)
    {
        try {
            $con = Connection::getConnection();
            if ($con == null) throw new Error("Conexão falhou.");

            $veiculos = null;

            if (!$id) {
                $sql = "SELECT id, placa, modelo, marca, dataCadastro FROM Veiculos ORDER BY dataCadastro DESC;";
                $stmt = $con->prepare($sql);
            } else {
                $sql = "SELECT id, placa, modelo, marca, dataCadastro FROM Veiculos WHERE id = :id;";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":id", $id);
            }

            if ($stmt->execute()) {
                if (!$id) {
                    $veiculos = $stmt->fetchAll(PDO::FETCH_CLASS, "Source\Model\VeiculoModel");
                } else {
                    $veiculos = $stmt->fetch(PDO::FETCH_OBJ);
                }
            } else {
                throw new Exception("Erro na busca.");
            }
        } catch (Error $e) {
            echo $e->getMessage();
            die();
        } catch (Exception $e) {
            return $veiculos;
        } finally {
            Connection::close($con);
        }
        return $veiculos;
    }

    public function fetchPlaca(string $placa)
    {
        try {
            $con = Connection::getConnection();
            if ($con == null) throw new Error("Conexão falhou.");

            $veiculo = null;
            $sql = "SELECT id, placa, modelo, marca, dataCadastro FROM Veiculos WHERE placa = :placa;";

            $stmt = $con->prepare($sql);
            $stmt->bindValue(":placa", $placa);

            if ($stmt->execute()) {
                $veiculo = $stmt->fetch(PDO::FETCH_OBJ);
            } else {
                throw new Exception("Erro na busca");
            }
        } catch (Error $e) {
            echo $e->getMessage();
            die();
        } catch (Exception $e) {
            return $veiculo;
        } finally {
            Connection::close($con);
        }
        return $veiculo;
    }

    public function fetchMarca(string $marca)
    {
        try {
            $con = Connection::getConnection();
            if ($con == null) throw new Error("Conexão falhou.");

            $veiculos = null;
            $sql = "SELECT id, placa, modelo, marca, dataCadastro FROM Veiculos WHERE marca = :marca;";

            $stmt = $con->prepare($sql);
            $stmt->bindValue(":marca", $marca);

            if ($stmt->execute()) {
                $veiculos = $stmt->fetchAll(PDO::FETCH_CLASS, "Source\Model\VeiculoModel");
            } else {
                throw new Exception("Erro na busca");
            }
        } catch (Error $e) {
            echo $e->getMessage();
            die();
        } catch (Exception $e) {
            return $veiculos;
        } finally {
            Connection::close($con);
        }
        return $veiculos;
    }

    public function delete(int $id): bool
    {
        try {
            $con = Connection::getConnection();
            if ($con == null) throw new Error("Conexão falhou.");
            
            $result = false;
            $sql = "DELETE FROM Veiculos WHERE id = :id";

            $stmt = $con->prepare($sql);
            $stmt->bindValue(":id", $id);
            if ($stmt->execute()) {
                $result = true;
            } else {
                throw new Exception("Erro no deletar");
            }
        } catch (Error $e) {
            echo $e->getMessage();
            die();
        } catch (Exception $e) {
            return $result;
        } finally {
            Connection::close($con);
        }
        return $result;
    }
}
