--datos de prueba categoria

USE localconnect;

INSERT INTO
    categorias (
        nombre_categoria,
        descripcion,
        estado
    )
VALUES (
        'Restaurantes',
        'Negocios dedicados a la venta de alimentos y bebidas preparados.',
        'activo'
    ),
    (
        'Tiendas de abarrotes',
        'Comercios que venden productos de consumo básico y alimentos envasados.',
        'activo'
    ),
    (
        'Servicios de limpieza',
        'Empresas o personas que ofrecen limpieza de hogares, oficinas o locales.',
        'activo'
    ),
    (
        'Salones de belleza',
        'Negocios enfocados en el cuidado personal, peluquería y estética.',
        'activo'
    ),
    (
        'Tecnología y electrónica',
        'Tiendas y servicios relacionados con productos electrónicos y tecnología.',
        'activo'
    ),
    (
        'Salud y bienestar',
        'Negocios enfocados en la salud física y mental, como farmacias, gimnasios, etc.',
        'activo'
    ),
    (
        'Educación y formación',
        'Instituciones y personas que ofrecen servicios educativos o de capacitación.',
        'activo'
    ),
    (
        'Transporte y logística',
        'Empresas dedicadas al traslado de personas o mercancías.',
        'activo'
    ),
    (
        'Eventos y entretenimiento',
        'Negocios que organizan o proveen servicios para eventos y actividades recreativas.',
        'activo'
    );

-- Categorías de características
INSERT INTO
    categorias_caracteristica (
        nombre_categoria,
        descripcion,
        estado
    )
VALUES (
        'Pagos y Financiero',
        'Características relacionadas con métodos de pago y opciones financieras',
        'activo'
    ),
    (
        'Infraestructura',
        'Características físicas y de infraestructura del negocio',
        'activo'
    ),
    (
        'Tecnología y Comunicación',
        'Características relacionadas con tecnología y comunicación',
        'activo'
    ),
    (
        'Horarios y Servicio',
        'Características relacionadas con horarios y tipos de servicio',
        'activo'
    ),
    (
        'Políticas Especiales',
        'Políticas y características especiales del negocio',
        'activo'
    );

-- Características por categoría
INSERT INTO
    caracteristicas (
        id_categoria_caracteristica,
        nombre,
        descripcion,
        estado
    )
VALUES
    -- Pagos y Financiero
    (
        1,
        'Acepta tarjetas de crédito',
        'El negocio acepta pagos con tarjetas de crédito',
        'activo'
    ),
    (
        1,
        'Acepta tarjetas de débito',
        'El negocio acepta pagos con tarjetas de débito',
        'activo'
    ),
    (
        1,
        'Acepta pagos digitales',
        'El negocio acepta pagos a través de aplicaciones digitales',
        'activo'
    ),
    (
        1,
        'Acepta efectivo',
        'El negocio acepta pagos en efectivo',
        'activo'
    ),
    (
        1,
        'Tiene cuotas sin interés',
        'El negocio ofrece opciones de pago en cuotas sin intereses',
        'activo'
    ),
    (
        2,
        'Tiene estacionamiento',
        'El negocio cuenta con estacionamiento para clientes',
        'activo'
    ),
    (
        2,
        'Tiene estacionamiento gratuito',
        'El negocio ofrece estacionamiento gratuito',
        'activo'
    ),
    (
        2,
        'Es accesible para discapacitados',
        'El negocio tiene acceso adaptado para personas con discapacidad',
        'activo'
    ),
    (
        2,
        'Tiene rampa de acceso',
        'El negocio cuenta con rampa de acceso',
        'activo'
    ),
    (
        2,
        'Tiene ascensor',
        'El negocio cuenta con ascensor',
        'activo'
    ),
    (
        2,
        'Tiene aire acondicionado',
        'El negocio cuenta con aire acondicionado',
        'activo'
    ),
    (
        2,
        'Tiene terraza',
        'El negocio cuenta con terraza o área al aire libre',
        'activo'
    ),
    (
        3,
        'Tiene WiFi gratuito',
        'El negocio ofrece conexión WiFi gratuita',
        'activo'
    ),
    (
        3,
        'Tiene WiFi de pago',
        'El negocio ofrece conexión WiFi con costo',
        'activo'
    ),
    (
        3,
        'Tiene aplicación móvil',
        'El negocio cuenta con aplicación móvil propia',
        'activo'
    ),
    (
        3,
        'Acepta pedidos online',
        'El negocio acepta pedidos a través de internet',
        'activo'
    ),
    (
        3,
        'Tiene sistema de reservas',
        'El negocio cuenta con sistema de reservas online',
        'activo'
    ),
    (
        4,
        'Es 24/7',
        'El negocio está abierto las 24 horas del día',
        'activo'
    ),
    (
        4,
        'Tiene servicio nocturno',
        'El negocio ofrece servicio durante la noche',
        'activo'
    ),
    (
        4,
        'Tiene delivery',
        'El negocio ofrece servicio de entrega a domicilio',
        'activo'
    ),
    (
        4,
        'Tiene take away',
        'El negocio ofrece servicio para llevar',
        'activo'
    ),
    (
        4,
        'Tiene servicio a domicilio',
        'El negocio ofrece servicios en el domicilio del cliente',
        'activo'
    ),
    (
        5,
        'Acepta mascotas',
        'El negocio permite la entrada de mascotas',
        'activo'
    ),
    (
        5,
        'Es pet-friendly',
        'El negocio es amigable con mascotas',
        'activo'
    ),
    (
        5,
        'Tiene área para niños',
        'El negocio cuenta con área especial para niños',
        'activo'
    ),
    (
        5,
        'Es familiar',
        'El negocio está orientado a familias',
        'activo'
    ),
    (
        5,
        'Es para adultos',
        'El negocio está orientado exclusivamente a adultos',
        'activo'
    );

INSERT INTO
    categorias_servicio (
        nombre_categoria_servicio,
        descripcion,
        estado
    )
VALUES (
        'Limpieza',
        'Servicios relacionados con la limpieza de espacios.',
        'activo'
    ),
    (
        'Mantenimiento',
        'Servicios de mantenimiento general y reparaciones.',
        'activo'
    ),
    (
        'Cuidado personal',
        'Servicios de estética, peluquería y cuidado personal.',
        'activo'
    ),
    (
        'Tecnología',
        'Servicios relacionados con la reparación y mantenimiento de dispositivos electrónicos.',
        'activo'
    ),
    (
        'Educación',
        'Clases particulares y servicios educativos.',
        'activo'
    );
-- Servicios predefinidos
INSERT INTO
    servicios_predefinidos (
        id_categoria_servicio,
        nombre_servicio,
        descripcion
    )
VALUES (
        1,
        'Limpieza profunda',
        'Servicio de limpieza a fondo de hogares y oficinas.'
    ),
    (
        1,
        'Limpieza regular',
        'Servicio de limpieza semanal o mensual para mantener el orden.'
    ),
    (
        2,
        'Mantenimiento eléctrico',
        'Reparación y mantenimiento de instalaciones eléctricas.'
    ),
    (
        2,
        'Mantenimiento de plomería',
        'Servicios de reparación y mantenimiento de sistemas de plomería.'
    ),
    (
        3,
        'Corte de cabello',
        'Servicio de peluquería para cortes y estilos de cabello.'
    ),
    (
        3,
        'Manicura y pedicura',
        'Servicios de cuidado de manos y pies.'
    ),
    (
        4,
        'Reparación de computadoras',
        'Servicio técnico para reparación y mantenimiento de computadoras.'
    ),
    (
        4,
        'Reparación de teléfonos móviles',
        'Servicio técnico para reparación de teléfonos móviles.'
    ),
    (
        5,
        'Clases particulares',
        'Clases personalizadas en diversas materias académicas.'
    );