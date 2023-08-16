CREATE TABLE IF NOT EXISTS `virtuajoint`.`Autos` (
  `idAutos` INT NOT NULL AUTO_INCREMENT COMMENT 'Es la clave primaria de la tabla de Autos',
  `nombreModelo` VARCHAR(50) CHARACTER SET 'utf8' NOT NULL COMMENT 'Nombre del vehiculo',
  `anioModelo` VARCHAR(45) NULL DEFAULT '0000',
  `fechaCompra` DATE NULL,
  `precioCompra` DECIMAL NULL DEFAULT 00.00,
  `codigoPieza` VARCHAR(8) NULL,
  `numeroPiezaSerie` VARCHAR(7) NULL,
  `añoColeccion` YEAR(4) NULL DEFAULT 0000,
  `altoAuto` DECIMAL(4) NULL,
  `anchoAuto` DECIMAL(4) NULL,
  `largoAuto` DECIMAL(4) NULL,
  `volumenCarro` DECIMAL(5) NULL,
  `pesoAuto` DECIMAL(5) NULL,
  `pesoCaja` DECIMAL(5) NULL,
  `pesoTotalAutoCaja` DECIMAL(5) NULL,
  `altoCaja` DECIMAL(5) NULL,
  `anchoCaja` DECIMAL(5) NULL,
  `profundidadCaja` DECIMAL(5) NULL,
  `volumenProyectadoCaja` DECIMAL(6) NULL,
  `rutaFoto` VARCHAR(100) NULL,
  `numRuedas` TINYINT(20) NULL,
  `valorEstimado` DECIMAL(20) NULL,
  `añoFabricacion` YEAR(4) NULL,
  `codigoBase` VARCHAR(5) NULL,
  `numPiezaAnioColeccion` VARCHAR(9) NULL,
  `urlWiki` VARCHAR(150) NULL,
  `idPaisesAutos` INT NOT NULL,
  `idSeriesAutos` INT NOT NULL,
  `idServiciosAutos` INT NOT NULL,
  `idLugarCompraAutos` INT NOT NULL,
  `idMarcaAutos` INT NOT NULL,
  `idEstadoAutos` INT NOT NULL,
  `idDueñosAutos` INT NOT NULL,
  `idImagenesAutos` INT NULL,
  PRIMARY KEY (`idAutos`),
  UNIQUE INDEX `idAutos_UNIQUE` (`idAutos` ASC) VISIBLE,
  INDEX `idPaisAuto_idx` (`idAutos` ASC, `idPaisesAutos` ASC) VISIBLE,
  INDEX `idSerieAutosFK_idx` (`idSeriesAutos` ASC) VISIBLE,
  INDEX `idServiciosAutosFK_idx` (`idServiciosAutos` ASC) VISIBLE,
  INDEX `idLugarCompraAutosFK_idx` (`idLugarCompraAutos` ASC) VISIBLE,
  INDEX `idMarcaAutosFK_idx` (`idMarcaAutos` ASC) VISIBLE,
  INDEX `idEstadoAutosFK_idx` (`idEstadoAutos` ASC) VISIBLE,
  INDEX `idDueñosAutosFK_idx` (`idDueñosAutos` ASC) VISIBLE,
  INDEX `idImagenesAutosFK_idx` (`idImagenesAutos` ASC) VISIBLE,
  CONSTRAINT `idPaisesAutosFK`
    FOREIGN KEY (`idAutos` , `idPaisesAutos`)
    REFERENCES `Autos`.`Paises` (`idPaises` , `idPaises`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idSeriesAutosFK`
    FOREIGN KEY (`idSeriesAutos`)
    REFERENCES `Autos`.`Series` (`idSeries`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idServiciosAutosFK`
    FOREIGN KEY (`idServiciosAutos`)
    REFERENCES `Autos`.`Servicios` (`idServicios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idLugarCompraAutosFK`
    FOREIGN KEY (`idLugarCompraAutos`)
    REFERENCES `Autos`.`lugarCompra` (`idLugarCompra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idMarcaAutosFK`
    FOREIGN KEY (`idMarcaAutos`)
    REFERENCES `Autos`.`Marca` (`idMarca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idEstadoAutosFK`
    FOREIGN KEY (`idEstadoAutos`)
    REFERENCES `Autos`.`Estado` (`idEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idDueñosAutosFK`
    FOREIGN KEY (`idDueñosAutos`)
    REFERENCES `Autos`.`Dueños` (`idDueños`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idImagenesAutosFK`
    FOREIGN KEY (`idImagenesAutos`)
    REFERENCES `Autos`.`Imagenes` (`idImagenes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
COMMENT = 'Tabla principal donde se registran los datos especificos de cada auto de la colección'