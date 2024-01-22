CREATE DATABASE IF NOT EXISTS Pedidos;
USE Pedidos;
 
CREATE TABLE IF NOT EXISTS Estados ( 
    Cod_Estado INT(11) NOT NULL AUTO_INCREMENT, 
    Descripcion VARCHAR (90) NOT NULL, 
    PRIMARY KEY (Cod_Estado)
); 

    INSERT INTO Estados (Cod_Estado, Descripcion) VALUES 
    (1, 'Enviado'), 
    (2, 'Entregado'), 
    (3, 'Cancelado'); 

CREATE TABLE IF NOT EXISTS Rol ( 
    Cod_Rol INT(11) NOT NULL AUTO_INCREMENT, 
    Rol VARCHAR(90) NOT NULL, 
    PRIMARY KEY (Cod_Rol)
); 

    INSERT INTO Rol (Cod_Rol, Rol) VALUES
    (1, 'Cliente');

CREATE TABLE IF NOT EXISTS Categorias (
    CodCat INT(11) NOT NULL AUTO_INCREMENT,
    Nombre VARCHAR(150) NOT NULL,
    Descripcion VARCHAR(150) NOT NULL,
    Activo BOOLEAN,
    PRIMARY KEY (CodCat),
    UNIQUE KEY (Nombre)
);  

INSERT INTO Categorias (CodCat, Nombre, Descripcion, Activo) VALUES 
(1, 'Comida', 'Platos e ingredientes', true),
(2, 'Bebidas sin', 'Bebidas sin alcohol', true),
(3, 'Bebidas con', 'Bebidas con alcohol', true);

CREATE TABLE IF NOT EXISTS Productos (
    CodProduct INT(11) NOT NULL AUTO_INCREMENT,
    Nombre VARCHAR(150) NOT NULL,
    Descripcion VARCHAR(150) NOT NULL,
    Peso INT(11),
    Stock INT(11),
    CodCat INT(11) NOT NULL, 
    Precio DECIMAL (10, 2) NOT NULL,
    Activo BOOLEAN,
    PRIMARY KEY (CodProduct),
    FOREIGN KEY (CodCat) REFERENCES Categorias(CodCat)
); 

INSERT INTO Productos (CodProduct, Nombre, Descripcion, Stock, CodCat, Precio, Activo) VALUES 
(1, 'Harina', '8 paquetes de 1kg de harina cada uno', 100, 1, 10, true),
(2, 'Azúcar', '20 paquetes de 1kg cada uno', 3, 1, 8, true),
(3, 'Agua 0.5', '100 botellas de 0.5 litros cada una', 100, 2, 5, true),
(4, 'Agua 1.5', '20 botellas de 1.5 litros cada una', 50, 2, 7, true),
(5, 'Cerveza Alhambra tercio', '24 botellas de 33cl', 0, 3, 12, true),
(6, 'Vino tinto Rioja 0.75', '6 botellas de 0.75', 10, 3, 20, true);

CREATE TABLE IF NOT EXISTS Restaurantes (
    CodRes INT(11) NOT NULL AUTO_INCREMENT, 
    Cod_Rol INT(11) NOT NULL,
    Nombre VARCHAR(150) NOT NULL,
    Clave VARCHAR(50) NOT NULL,
    Pais VARCHAR(150) NOT NULL,
    CP INT(11) NOT NULL,
    Ciudad VARCHAR(150) NOT NULL,
    Direccion VARCHAR(150) NOT NULL,
    Activo BOOLEAN,
    UNIQUE KEY (Nombre),
    PRIMARY KEY (CodRes), 
    FOREIGN KEY (Cod_Rol) REFERENCES Rol(Cod_Rol)
); 

INSERT INTO Restaurantes (CodRes, Cod_Rol, Nombre, Clave, Pais, CP, Ciudad, Direccion, Activo) VALUES 
(1, 1, 'david', '1234', 'España', 28002, 'Madrid', 'C/ Padre Claret, 8', TRUE),
(2, 1, 'antonio', '1234', 'España', 11001, 'Cádiz', 'C/ Portales, 2', TRUE);

CREATE TABLE IF NOT EXISTS Pedidos (
    CodPed INT(11) NOT NULL AUTO_INCREMENT,
    Fecha DATE, 
    Precio_Total DECIMAL (10, 2) NOT NULL,
    Cod_Estado INT(11) NOT NULL,
    CodRes INT(11) NOT NULL,
    PRIMARY KEY (CodPed),
   FOREIGN KEY (CodRes) REFERENCES Restaurantes(CodRes), 
   FOREIGN KEY (Cod_Estado) REFERENCES Estados(Cod_Estado)
); 

INSERT INTO Pedidos (CodPed, Fecha, Precio_Total, Cod_Estado , CodRes) VALUES 
(1, '2022-11-27',130, 1, 2),
(2, '2022-11-28',30, 1, 2),
(3, '2022-11-29',50,  2, 2);

CREATE TABLE IF NOT EXISTS PedidosProductos (
    CodPedProduct INT(11) NOT NULL AUTO_INCREMENT,
    CodPed INT(11) NOT NULL,
    CodProduct INT(11) NOT NULL,
    Unidades INT(11) NOT NULL,
    PRIMARY KEY (CodPedProduct),
    FOREIGN KEY (CodProduct) REFERENCES Productos(CodProduct),
    FOREIGN KEY (CodPed) REFERENCES Pedidos(CodPed) 
); 

INSERT INTO PedidosProductos (CodPedProduct, CodPed, CodProduct, Unidades) VALUES
(1, 1, 1, 2),
(2, 2, 3, 3),
(3, 2, 1, 5),
(4, 2, 2, 4),
(5, 3, 4, 3); 

CREATE TABLE IF NOT EXISTS Logg ( 
    Cod_Log INT (11) NOT NULL AUTO_INCREMENT, 
    CodRes INT (11) NOT NULL, 
    Descripcion VARCHAR (90) NOT NULL, 
    Fecha DATE, 
    PRIMARY KEY (cod_Log), 
    FOREIGN KEY (CodRes) REFERENCES Restaurantes(CodRes)
    );  

    INSERT INTO Logg (Cod_Log, CodRes, Descripcion, Fecha) VALUES  
      (1, 2, 'Inicio de sesión exitoso', '2024-01-20'),
  (2, 2, 'Cambio de contraseña', '2024-01-21'),
  (3, 2, 'Registro de nuevo pedido', '2024-01-22');



COMMIT; 