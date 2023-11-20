use vido_shop;

ALTER TABLE empleado
MODIFY COLUMN salario INT(10) CHECK (salario > 0) NOT NULL;
CREATE TABLE empleado( 
  cedula INT(10) PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  fecha_contratacion DATE NOT NULL, 
  salario INT(10) CHECK (salario > 0) NOT NULL
);

DROP TABLE pedido;

CREATE TABLE pedido( 
  codigo INT AUTO_INCREMENT PRIMARY KEY,
  fecha_compra DATE NOT NULL, 
  costo_total INT(8) CHECK(costo_total > 0) NOT NULL,
  tipo_pedido VARCHAR(10) CHECK (tipo_pedido IN ('Virtual', 'Presencial')) NOT NULL, 
  direccion_envio VARCHAR(50) NULL, 
  empleado_atiende INT(10) NULL, 
  empleado_envia INT(10) NULL, 
  FOREIGN KEY (empleado_atiende) REFERENCES empleado(cedula),
  FOREIGN KEY (empleado_envia) REFERENCES empleado(cedula),
  CHECK (
    (tipo_pedido = 'Virtual' AND direccion_envio IS NOT NULL)
    OR 
    (tipo_pedido = 'Presencial' AND direccion_envio IS NULL)
  ),
  CHECK (empleado_atiende <> empleado_envia)
);

