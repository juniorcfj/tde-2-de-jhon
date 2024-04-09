<?php

// Classe abstrata Pessoa
abstract class Pessoa {
    protected $id;
    protected $nome;
    protected $cpf;

    public function __construct($id, $nome, $cpf) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }
}

// Classe Motorista
class Motorista extends Pessoa {
    private $carteiraMotorista;
    private $salario;

    public function __construct($id, $nome, $cpf, $carteiraMotorista, $salario) {
        parent::__construct($id, $nome, $cpf);
        $this->carteiraMotorista = $carteiraMotorista;
        $this->salario = $salario;
    }

    public function iniciarViagem($onibus) {
        echo "Motorista " . $this->nome . " iniciou a viagem do ônibus " . $onibus->getId() . ".\n";
    }

    public function finalizarViagem($onibus) {
        echo "Motorista " . $this->nome . " finalizou a viagem do ônibus " . $onibus->getId() . ".\n";
    }

    public function relatarProblema($onibus) {
        echo "Motorista " . $this->nome . " relatou um problema com o ônibus " . $onibus->getId() . ".\n";
    }

    public function visualizarRota($rota) {
        echo "Motorista " . $this->nome . " está visualizando a rota " . $rota->getId() . ".\n";
    }
}

// Classe Passageiro
class Passageiro extends Pessoa {
    private $bilhetesComprados;

    public function __construct($id, $nome, $cpf) {
        parent::__construct($id, $nome, $cpf);
        $this->bilhetesComprados = array();
    }

    public function comprarBilhete($rota, $horario) {
        $bilhete = new Bilhete(count($this->bilhetesComprados) + 1, $rota, $horario, $this->getId());
        $this->bilhetesComprados[] = $bilhete;
        echo "Passageiro " . $this->nome . " comprou um bilhete para a rota " . $rota->getNome() . " no horário " . $horario . ".\n";
        return $bilhete;
    }

    public function cancelarBilhete($bilheteId) {
        foreach ($this->bilhetesComprados as $key => $bilhete) {
            if ($bilhete->getId() == $bilheteId) {
                $bilhete->cancelar();
                unset($this->bilhetesComprados[$key]);
                echo "Passageiro " . $this->nome . " cancelou o bilhete #" . $bilheteId . ".\n";
                return;
            }
        }
        echo "Bilhete #" . $bilheteId . " não encontrado para o passageiro " . $this->nome . ".\n";
    }
}

// Classe Ônibus
class Onibus {
    private $id;
    private $modelo;
    private $capacidade;
    private $estado;

    public function __construct($id, $modelo, $capacidade, $estado) {
        $this->id = $id;
        $this->modelo = $modelo;
        $this->capacidade = $capacidade;
        $this->estado = $estado;
    }

    public function alterarEstado($estado) {
        $this->estado = $estado;
        echo "Estado do ônibus " . $this->id . " alterado para " . $estado . ".\n";
    }

    public function obterEstado() {
        return $this->estado;
    }

    public function getId() {
        return $this->id;
    }
}

// Classe Rota
class Rota {
    private $id;
    private $nome;
    private $origem;
    private $destino;
    private $horarios;
    private $onibusAlocados;

    public function __construct($id, $nome, $origem, $destino) {
        $this->id = $id;
        $this->nome = $nome;
        $this->origem = $origem;
        $this->destino = $destino;
        $this->horarios = array();
        $this->onibusAlocados = array();
    }

    public function adicionarOnibus($onibus) {
        $this->onibusAlocados[] = $onibus;
        echo "Ônibus " . $onibus->getId() . " alocado para a rota " . $this->nome . ".\n";
    }

    public function removerOnibus($onibusId) {
        foreach ($this->onibusAlocados as $key => $onibus) {
            if ($onibus->getId() == $onibusId) {
                unset($this->onibusAlocados[$key]);
                echo "Ônibus #" . $onibusId . " removido da rota " . $this->nome . ".\n";
                return;
            }
        }
        echo "Ônibus #" . $onibusId . " não encontrado na rota " . $this->nome . ".\n";
    }

    public function adicionarHorario($horario) {
        $this->horarios[] = $horario;
        echo "Horário " . $horario . " adicionado à rota " . $this->nome . ".\n";
    }

    public function removerHorario($horario) {
        $key = array_search($horario, $this->horarios);
        if ($key !== false) {
            unset($this->horarios[$key]);
            echo "Horário " . $horario . " removido da rota " . $this->nome . ".\n";
        } else {
            echo "Horário " . $horario . " não encontrado na rota " . $this->nome . ".\n";
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }
}

// Classe Bilhete
class Bilhete {
    private $id;
    private $rota;
    private $horario;
    private $passageiroId;
    private $estado;

    public function __construct($id, $rota, $horario, $passageiroId) {
        $this->id = $id;
        $this->rota = $rota;
        $this->horario = $horario;
        $this->passageiroId = $passageiroId;
        $this->estado = "ativo";
    }

    public function cancelar() {
        $this->estado = "cancelado";
        echo "Bilhete #" . $this->id . " cancelado.\n";
    }

    public function getId() {
        return $this->id;
    }
}

// Classe CompaniaDeOnibus
class CompaniaDeOnibus {
    private $nome;
    private $cnpj;
    private $onibus;
    private $rotas;
    private $motoristas;

    public function __construct($nome, $cnpj) {
        $this->nome = $nome;
        $this->cnpj = $cnpj;
        $this->onibus = array();
        $this->rotas = array();
        $this->motoristas = array();
    }

    public function adicionarOnibus($onibus) {
        $this->onibus[] = $onibus;
        echo "Ônibus " . $onibus->getId() . " adicionado à companhia.\n";
    }

    public function removerOnibus($onibusId) {
        foreach ($this->onibus as $key => $onibus) {
            if ($onibus->getId() == $onibusId) {
                unset($this->onibus[$key]);
                echo "Ônibus #" . $onibusId . " removido da companhia.\n";
                return;
            }
        }
        echo "Ônibus #" . $onibusId . " não encontrado na companhia.\n";
    }

    public function adicionarRota($rota) {
        $this->rotas[] = $rota;
        echo "Rota " . $rota->getNome() . " adicionada à companhia.\n";
    }

    public function removerRota($rotaId) {
        foreach ($this->rotas as $key => $rota) {
            if ($rota->getId() == $rotaId) {
                unset($this->rotas[$key]);
                echo "Rota #" . $rotaId . " removida da companhia.\n";
                return;
            }
        }
        echo "Rota #" . $rotaId . " não encontrada na companhia.\n";
    }

    public function adicionarMotorista($motorista) {
        $this->motoristas[] = $motorista;
        echo "Motorista " . $motorista->getNome() . " adicionado à companhia.\n";
    }

    public function removerMotorista($motoristaId) {
        foreach ($this->motoristas as $key => $motorista) {
            if ($motorista->getId() == $motoristaId) {
                unset($this->motoristas[$key]);
                echo "Motorista #" . $motoristaId . " removido da companhia.\n";
                return;
            }
        }
        echo "Motorista #" . $motoristaId . " não encontrado na companhia.\n";
    }
}

// Exemplo de utilização das classes

// Criando motoristas
$motorista1 = new Motorista(1, "João", "123.456.789-00", "CNH123", 2000);
$motorista2 = new Motorista(2, "Maria", "987.654.321-00", "CNH456", 2200);

// Criando passageiros
$passageiro1 = new Passageiro(1, "Pedro", "111.222.333-44");
$passageiro2 = new Passageiro(2, "Ana", "555.666.777-88");

// Criando ônibus
$onibus1 = new Onibus(1, "Modelo A", 50, "disponível");
$onibus2 = new Onibus(2, "Modelo B", 40, "disponível");

// Criando rotas
$rota1 = new Rota(1, "Rota 1", "Cidade A", "Cidade B");
$rota2 = new Rota(2, "Rota 2", "Cidade B", "Cidade C");

// Criando companhia de ônibus
$companhia = new CompaniaDeOnibus("Empresa XYZ", "1234567890001");

// Adicionando ônibus à companhia
$companhia->adicionarOnibus($onibus1);
$companhia->adicionarOnibus($onibus2);

// Adicionando motoristas à companhia
$companhia->adicionarMotorista($motorista1);
$companhia->adicionarMotorista($motorista2);

// Adicionando rotas à companhia
$companhia->adicionarRota($rota1);
$companhia->adicionarRota($rota2);

// Alocando ônibus para rotas
$rota1->adicionarOnibus($onibus1);
$rota2->adicionarOnibus($onibus2);

// Passageiro comprando bilhetes
$bilhete1 = $passageiro1->comprarBilhete($rota1, "08:00");
$bilhete2 = $passageiro2->comprarBilhete($rota2, "09:00");

// Cancelando bilhete
$passageiro1->cancelarBilhete($bilhete1->getId());

// Iniciando e finalizando viagem
$motorista1->iniciarViagem($onibus1);
$motorista1->relatarProblema($onibus1);
$motorista1->finalizarViagem($onibus1);

?>
