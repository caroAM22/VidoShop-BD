use vido_shop;

CREATE TABLE cliente( 
  cedula INT(10) PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  numero_contacto INT(10) CHECK(numero_contacto > 0) NOT NULL, 
  saldo INT(8) CHECK (saldo > 0) NOT NULL,
  correo_electronico VARCHAR(50)
);

CREATE TABLE bono_regalo( 
  codigo INT AUTO_INCREMENT PRIMARY KEY,
  fecha_creacion DATE NOT NULL, 
  valor INT(6) CHECK(valor > 0) NOT NULL,
  mes VARCHAR(10) CHECK(mes IN ("Enero","Febrero","Marzo","Septiembre","Noviembre")) NOT NULL, 
  cliente_dueno INT(10), 
  cliente_utiliza INT(10), 
  FOREIGN KEY (cliente_dueno) REFERENCES cliente(cedula),
  FOREIGN KEY (cliente_utiliza) REFERENCES cliente(cedula),
  CHECK (cliente_dueno <> cliente_utiliza)
);

