-- Tabela para o registro de vendas concluídas
CREATE TABLE IF NOT EXISTS Vendas (
    Cod_Venda INT AUTO_INCREMENT PRIMARY KEY,
    Data_Venda DATETIME NOT NULL,
    Total DECIMAL(10, 2) NOT NULL
);

-- Tabela para o controle de eventos
CREATE TABLE IF NOT EXISTS Eventos (
    Cod_Evento INT AUTO_INCREMENT PRIMARY KEY,
    Titulo VARCHAR(255) NOT NULL,
    Data_Inicio DATETIME NOT NULL,
    Data_Fim DATETIME NOT NULL
);

-- Tabela para o cadastro de peças
CREATE TABLE IF NOT EXISTS Pecas (
    Cod_Peca INT AUTO_INCREMENT PRIMARY KEY,
    Nome_Peca VARCHAR(100) NOT NULL,
    Fornecedor VARCHAR(100),
    Valor_Compra DECIMAL(10, 2) NOT NULL,
    Valor_Venda DECIMAL(10, 2) NOT NULL,
    Quantidade INT NOT NULL
);

-- Tabela para o controle do carrinho de compras
CREATE TABLE IF NOT EXISTS Carrinho (
    Cod_Carrinho INT AUTO_INCREMENT PRIMARY KEY,
    Cod_Peca INT NOT NULL,
    Nome_Peca VARCHAR(100) NOT NULL,
    Valor_Venda DECIMAL(10, 2) NOT NULL,
    Quantidade INT NOT NULL,
    Total_Item DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (Cod_Peca) REFERENCES Pecas(Cod_Peca)
);

-- Tabela para o registro dos itens vendidos
CREATE TABLE IF NOT EXISTS Itens_Venda (
    Cod_Item INT AUTO_INCREMENT PRIMARY KEY,
    Cod_Venda INT NOT NULL,
    Cod_Peca INT NOT NULL,
    Imagem_id INT,
    Nome_Peca VARCHAR(100) NOT NULL,
    Valor_Venda DECIMAL(10, 2) NOT NULL,
    Quantidade INT NOT NULL,
    Total_Item DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (Cod_Venda) REFERENCES Vendas(Cod_Venda),
    FOREIGN KEY (Cod_Peca) REFERENCES Pecas(Cod_Peca)
);