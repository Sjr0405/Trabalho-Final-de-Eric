-- Tabela para o cadastro de peças
CREATE TABLE IF NOT EXISTS Pecas (
    Cod_Peca INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Peca VARCHAR(100),
    Fornecedor VARCHAR(100),
    Valor_Compra DECIMAL(10, 2),
    Valor_Venda DECIMAL(10, 2),
    Quantidade INT,
    Imagem VARCHAR(255)
);

-- Tabela para o registro de vendas concluídas
CREATE TABLE IF NOT EXISTS Vendas (
    Cod_Venda INT AUTO_INCREMENT PRIMARY KEY,
    Data_Venda DATE,
    Total DECIMAL(10, 2)
);

-- Tabela para o registro dos itens vendidos
CREATE TABLE IF NOT EXISTS Itens_Venda (
    Cod_Item INT AUTO_INCREMENT PRIMARY KEY,
    Cod_Venda INT,
    Cod_Peca INT,
    Nome_Peca VARCHAR(100),
    Valor_Venda DECIMAL(10, 2),
    Quantidade INT,
    Total_Item DECIMAL(10, 2),
    FOREIGN KEY (Cod_Venda) REFERENCES Vendas(Cod_Venda),
    FOREIGN KEY (Cod_Peca) REFERENCES Pecas(Cod_Peca)
);

-- Tabela para o controle do carrinho de compras
CREATE TABLE IF NOT EXISTS Carrinho (
    Cod_Carrinho INT AUTO_INCREMENT PRIMARY KEY,
    Cod_Peca INT,
    Nome_Peca VARCHAR(100),
    Valor_Venda DECIMAL(10, 2),
    Quantidade INT,
    Total_Item DECIMAL(10, 2),
    FOREIGN KEY (Cod_Peca) REFERENCES Pecas(Cod_Peca)
);

-- Tabela para o controle de eventos
CREATE TABLE IF NOT EXISTS Eventos (
    Cod_Evento INT AUTO_INCREMENT PRIMARY KEY,
    Titulo VARCHAR(255),
    Data_Inicio DATETIME,
    Data_Fim DATETIME
);

-- Tabela para o controle de imagens
CREATE TABLE Imagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    conteudo BLOB
);