use vido_shop;

CREATE TABLE empleado( 
  cedula INT(10) PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  fecha_contratacion DATE NOT NULL, 
  salario DECIMAL(10, 2) CHECK (salario > 0) NOT NULL
);

DROP TABLE pedido;

CREATE TABLE pedido( 
  codigo INT AUTO_INCREMENT PRIMARY KEY,
  fecha_compra DATE NOT NULL, 
  costo_total DECIMAL(8, 2) CHECK(costo_total > 0) NOT NULL,
  tipo_pedido VARCHAR(10) CHECK (tipo_pedido IN ('Virtual', 'Presencial')) NOT NULL, 
  direccion_envio VARCHAR(50), 
  CHECK (
    (tipo_pedido = 'Virtual' AND direccion_envio IS NOT NULL)
    OR 
    (tipo_pedido = 'Presencial' AND direccion_envio IS NULL)
  )
);

