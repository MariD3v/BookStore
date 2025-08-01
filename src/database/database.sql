
CREATE DATABASE IF NOT EXISTS biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;


create table autor(
	codigo_autor int auto_increment,
  nombre varchar(50) not null,
  pais varchar(30) not null,
  fecha_nac date not null,
  fallecido boolean default 0 not null,
  descripcion_autor text not null,
  primary key (codigo_autor)
);

create table libro(
  codigo_libro int auto_increment,
  titulo varchar(40) unique not null,
  genero varchar(40) not null,
  editorial varchar(30) not null,
  n_pag int not null,
  idioma enum('Inglés','Español') not null,
  fecha_publ date not null,
  encuadernacion enum('Tapa blanda','Tapa dura') not null,
  precio decimal(10,2) not null,
  descripcion_libro text not null,
  serie varchar(100),
  numero int,
  codigo_autor int not null,
  activado tinyint default 1 not null,
  primary key(codigo_libro),
  foreign key (codigo_autor) references autor(codigo_autor) ON UPDATE CASCADE ON DELETE CASCADE
);

create table cliente(
  codigo_cliente int auto_increment,
  nombre varchar(50) not null,
  apellidos varchar(50) not null,
  email varchar(100) unique not null,
  contraseña varchar(100),
  administrador boolean default 0 not null,
  primary key(codigo_cliente)
);

create table compra(
  codigo_compra int auto_increment,
  estado enum('Pendiente de pago', 'Pendiente de envío', 'Pagado', 'Enviado', 'En tránsito', 'Entregado', 'Cancelada') NOT NULL,
  fecha datetime not null,
  nombre varchar(50) not null,
  apellidos varchar(50) not null,
  telefono int not null,
  direccion varchar(100) not null,
  direccion_adicional varchar(100) not null,
  codigo_postal int not null,
  poblacion varchar(30) not null,
  provincia varchar(30) not null,
  codigo_cliente int not null,
  total decimal(5,2) not null,
  primary key (codigo_compra),
  foreign key (codigo_cliente) references cliente(codigo_cliente) ON UPDATE CASCADE ON DELETE CASCADE
);

create table detalle_compra(
  codigo_compra int auto_increment,
  codigo_libro int not null,
  unidades int not null,
  precio_unitario decimal(10,2) not null,
  primary key (codigo_compra,codigo_libro),
  foreign key (codigo_libro) references libro(codigo_libro) ON UPDATE CASCADE ON DELETE CASCADE,
  foreign key (codigo_compra) references compra(codigo_compra) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE visitas (
  visitas INT NOT NULL DEFAULT 0
);

INSERT INTO autor VALUES (1, 'Sarah J Mass','Estados Unidos','1986-03-05',0,'Autora número 1 del New York Times, y su obra, en la que destaca la saga Trono de cristal, es un fenómeno superventas internacional. Se han vendido más de nueve millones de ejemplares de sus libros y estos se publican en treinta y siete idiomas. Sarah nació en Nueva York, pero actualmente vive en Pensilvania con su marido, su hijo y su perro.');
INSERT INTO autor VALUES (2, 'Stephen King','Estados Unidos','1947-09-21',0,'Stephen King (nacido el 21 de septiembre de 1947 en Portland, Maine) es un destacado escritor estadounidense de terror, ficción sobrenatural y más. Con más de 500 millones de libros vendidos, ha publicado 65 novelas y numerosas adaptaciones cinematográficas y televisivas.');
INSERT INTO autor VALUES (3, 'Marie Lu','China','1984-07-11',0,'Marie Lu nació en China, pero se mudó junto con su familia a Texas en 1989. En 2006 se graduó en Ciencias políticas en la Universidad del Sur de California, aunque acabó trabajando en el campo de la literatura y de la animación. Actualmente vive en Los Ángeles, California, con su marido y sus perros.');
INSERT INTO autor VALUES (4, 'V.E. Schwab', 'Estados Unidos', '1987-07-07',0, 'Victoria E. Schwab (1987) es una escritora estadounidense con varios números 1 en el New York Times y un Goodreads Choice Award (Best Science Fiction). Entre sus obras destacan la bilogía El Archivo o la trilogía Sombras de Magia (Minotauro, 2019). Su catálogo ha sido traducido exitosamente a más de 15 idiomas. Además, tiene varios proyectos para adaptar sus novelas al mundo audiovisual: El universo de El Archivo está siendo desarrollado por la cadena de televisión CW y Sombras de Magia por Sony Pictures. Por todo ello, Schwab está considerada una de las autoras principales de Fantasía y Ciencia Ficción de la actualidad');
INSERT INTO autor VALUES (5, 'Susan Ee', 'Estados Unidos', '1980-01-01',0, 'SUSAN EE es una escritora y directora de cine ampliamente reconocida. Es una entusiasta de la ciencia ficción, de la fantasía y del terror, especialmente cuando existe un toque romántico. La trilogía con la que la autora debutó, Penryn y el fin de los tiempos, le ha llevado a ser finalista de los Cybils Awards. Además, ha recibido excelentes puntuaciones por parte de la revista Entertainement Weekly y se ha situado en el top 5 de los eBooks más vendidos de Amazon. Sus libros han sido bestsellers internacionales que se han traducido a veintiséis idiomas y que la han convertido en una de las grandes voces del género fantástico.');
INSERT INTO autor VALUES (6, 'Emily McIntire', 'Estados Unidos', '1988-09-01',0, 'EMILY MCINTIRE es una autora best seller de Amazon, conocida sobre todo por su serie Never After, en la que da finales felices a nuestros villanos favoritos. Sus obras se centran siempre en el romance, aunque en diferentes formatos: no le gusta encasillarse, pero el corazón de sus novelas siempre es el amor. Cuando no está escribiendo, podría estar esperando la carta de Hogwarts, disfrutando con su familia o sumergida en las páginas de un buen libro.');
INSERT INTO autor VALUES (7, 'Alexandra Christo', 'Reino Unido', '1994-04-01',0, 'Alexandra Christo es una autora británica cuyos personajes siempre son más divertidos y mucho más mortíferos que ella. Estudió Escritura Creativa en la universidad y se graduó con el deseo de no dejar nunca de dejar volar su imaginación. Actualmente vive en Hertfordshire con un jardín que no para de crecer y una pila interminable de libros. Su novela debut, Matar un reino, es un éxito de ventas internacional y sus libros de fantasía para jóvenes adultos se han traducido a más de una docena de idiomas en todo el mundo.');
INSERT INTO autor VALUES (8, 'Josh Malerman', 'Estados Unidos', '1970-02-24',0, 'Josh Malerman es un autor de terror y ficción, es el cantante y compositor de la banda de rock The High Strung. Vive en Ferndale, Michigan. Es conocido por su novela "A ciegas", que se convirtió en un fenómeno cultural y fue adaptada a una película exitosa. Su estilo inquietante y original ha capturado la atención de los lectores.');
INSERT INTO autor VALUES (9, 'Tahereh Mafi', 'Estados Unidos', '1988-11-09',0, 'Tahereh Mafi es una autora de fantasía y ciencia ficción. Afirmó que antes de escribir su primera novela, Shatter Me, escribió cinco manuscritos para comprender mejor cómo escribir un libro. Shatter Me fue publicado en 2011. Desde entonces, se han publicado Unravel Me e Ignite Me. Mafi también tiene dos novelas que van con la serie Shatter Me, Destroy Me y Fracture Me.​ Los derechos cinematográficos de Shatter Me han sido comprados por 20th Century Fox. En agosto de 2016, lanzó Furthermore, una novela de ficción de grado medio sobre una niña pálida que vive en un mundo de gran color y magia que ella no tiene.');
INSERT INTO autor VALUES (10, 'Gillian Flynn', 'Estados Unidos', '1982-02-24',0, 'Gillian Flynn es la autora de Perdida, best seller número uno de The New York Times. Su guión para la adaptación cinematográfica de la novela fue nominado a los Globos de Oro. También ha publicado los best sellers La llamada del Kill Club y Heridas abiertas. Anteriormente crítica del Entertainment Weekly, en la actualidad vive en Chicago con su marido e hijos.');
INSERT INTO autor VALUES (11, 'Iain Banks', 'Reino Unido', '1985-02-10', 1,'Pensador, ensayista y escritor escocés, Iain M. Banks fue un destacado autor de literatura mainstream y también de ciencia ficción o fantasía, con el nombre de Iain M. Banks. A lo largo de su carrera, Banks recibió numerosos premios y galardones, como el Arthur C. Clarke, el BSFA o el BFA, entre otros. Banks fue muy activo políticamente, vinculado a posiciones de izquierdas y a favor del laicismo, temas que se pueden apreciar de manera clara también en su obra literaria. De entre la interesante producción literaria de Banks habría que destacar la Serie de La Cultura y títulos como La fábrica de avispas.');
INSERT INTO autor VALUES (12, 'Rebecca Yaros', 'Estados Unidos', '1990-06-15',0, 'Rebecca Yarros es autora bestseller de The New York Times, de USA Today y de The Wall Street Journal. Sus más de veinte novelas han sido aclamadas tanto por medios como Publishers Weekly y Kirkus Reviews como por los lectores. Su familia ha servido en el ejército durante dos generaciones, por lo que Rebecca admira a los héroes militares y tiene la fortuna de estar casada con uno desde hace más de veinte años. Es madre de seis niños y vive en Colorado en compañía de su terco bulldog inglés, sus dos feroces chinchillas y su gata Artemis, que reina sobre toda la familia. En 2019 Yarros fundó, junto con su marido, la organización sin ánimo de lucro One October, dedicada a una de sus pasiones: ayudar a niños y niñas del sistema de acogida y adopciones familiares de Estados Unidos.');
INSERT INTO autor VALUES (13, 'Carmen Mola', 'España', '2021-10-01',0,'Carmen Mola es el seudónimo con el que los escritores españoles Jorge Díaz, Agustín Martínez y Antonio Mercero publicaron la saga de novelas iniciada con La novia gitana en la editorial Alfaguara a partir de 2018, con el personaje de la inspectora Elena Blanco como protagonista. La identidad verdadera de estos autores se conoció en octubre de 2021, cuando ganaron el Premio Planeta con su nueva novela La Bestia.');
INSERT INTO autor VALUES (14, 'Paula Hawkins', 'Reino Unido', '1971-08-26',0, 'Paula Hawkins es una autora británica famosa por su novela de suspense psicológico "La chica del tren", que se convirtió en un bestseller internacional y fue adaptada al cine. Su escritura se centra en las complejidades de las relaciones humanas y el oscuro lado de la vida cotidiana.');
INSERT INTO autor VALUES (15, 'Carlos Ruiz Zafón', 'España', '1964-09-25',1, 'Carlos Ruiz Zafón fue un destacado escritor español, nacido en Barcelona en 1964 y fallecido en 2020. Comenzó su carrera literaria escribiendo novelas juveniles, pero alcanzó la fama internacional con La sombra del viento (2001), parte de la tetralogía El cementerio de los libros olvidados. Su estilo literario combina el misterio, el drama y el realismo mágico, ambientado en una Barcelona gótica y llena de secretos. A lo largo de su carrera, su obra ha sido traducida a más de 40 idiomas, convirtiéndolo en uno de los autores españoles contemporáneos más leídos en el mundo. Además de su labor como escritor, también trabajó como guionista en Hollywood.');
INSERT INTO autor VALUES (16, 'Harlan Coben', 'Estados Unidos', '1962-01-04',0, 'Harlan Coben es un autor de thrillers que ha vendido millones de copias en todo el mundo. Sus novelas, a menudo llenas de giros inesperados, han sido adaptadas a series de televisión y películas, destacando su habilidad para mantener a los lectores al borde de sus asientos.');
INSERT INTO autor VALUES (17, 'Karin Slaughter', 'Estados Unidos', '1971-01-06',0, 'Escritora americana, Karin Slaughter estudió en la Universidad de Georgia State y trabajó como diseñadora y vendedora antes de poder dedicarse por completo a la literatura. Es conocida por sus novelas de intriga y suspense, con las que ha logrado un gran éxito internacional. Slaughter comenzó su carrera en 2001 iniciando la serie de novelas ambientadas en el Condado de Grant y que ya han sido traducidas a treinta idiomas. Además, su serie protagonizada por el agente especial Will Trent consiguió una gran popularidad y la autora mezcló los personajes en una única historia a partir del año 2009.');
INSERT INTO autor VALUES (18, 'Ruth Ware', 'Reino Unido', '1977-09-28',0, 'Ruth Ware, alias de Ruth Warburton, es una autora británica de suspenso psicológico. Sus novelas incluyen In a Dark, Dark Wood (2015), The Woman in Cabin 10 (2016), The Lying Game (2017), The Death of Mrs Westaway (2018), The Turn of the Key (2019), One By One (2020), The It Girl (2022) and Zero Days (2023).. Tanto In a Dark, Dark Wood como The Woman in Cabin 10 estuvieron en las listas de los diez libros más vendidos del The Sunday Times del Reino Unido y del The New York Times.');
INSERT INTO autor VALUES (19, 'H. P. Lovecraft', 'Estados Unidos', '1890-08-20', 1,'Howard Phillips Lovecraft fue un escritor estadounidense, pionero del género de horror cósmico. Sus obras influyeron profundamente en la literatura de terror, destacándose por la creación de mitologías y criaturas sobrenaturales como Cthulhu. Lovecraft desarrolló un universo literario que explora la insignificancia del ser humano ante fuerzas cósmicas incomprensibles.');
INSERT INTO autor VALUES (20, 'Edgar Allan Poe', 'Estados Unidos', '1809-01-19',1, 'Fue un escritor, poeta, crítico y periodista romántico estadounidense, generalmente reconocido como uno de los maestros universales del relato corto, del cual fue uno de los primeros practicantes en su país. Fue renovador de la novela gótica, recordado especialmente por sus cuentos de terror. Considerado el inventor del relato detectivesco, contribuyó asimismo con varias obras al género emergente de la ciencia ficción. Por otra parte, fue el primer escritor estadounidense de renombre que intentó hacer de la escritura su modus vivendi, lo que tuvo para él lamentables consecuencias.');
INSERT INTO autor VALUES (21, 'Clive Barker', 'Reino Unido', '1952-10-05',0, 'Estudió Inglés y Filosofía en la Universidad de Liverpool. Barker es uno de los más aclamados autores en los géneros de horror y fantasía. Inició su carrera con diversos relatos de horror recopilados en la serie Libros de Sangre (Books of Blood) y la novela faustiana El libro de las maldiciones (The damnation game). Posteriormente se trasladó hacia el género de la fantasía moderna con toques de horror.1​ El estilo más característico de Barker es la idea de que existe un mundo subyacente y oculto que convive con el nuestro (idea que comparte con Neil Gaiman), el rol de la sexualidad en lo sobrenatural y la construcción de mitologías coherentes, complejas y detalladas.');
INSERT INTO autor VALUES (22, 'Shirley Jackson', 'Estados Unidos', '1916-12-14',1, 'Shirley Jackson estudió en la Universidad de Syracuse. En 1948 publicó su primera novela, "The Road Through the Wall", y el cuento «La lotería» (incluido en el volumen "Cuentos escogidos", que apareció en esta colección), un clásico del siglo xx. Su obra que también incluye las novelas "Hangsaman" (1951), "The Bird’s Nest" (1954), "El reloj de sol" (1958), "La maldición de Hill House" (1959) y los ensayos autobiográficos "Life Among the Savages" y "Raising Demons" ha ejercido una gran influencia en A. M. Homes, Stephen King, Jonathan Lethem, Richard Matheson y Donna Tartt, entre otros escritores. En 1962 publicó "Siempre hemos vivido en el castillo", que fue considerada por la revista "Time" una de las diez mejores novelas del año y que editorial minúscula recuperó en 2012.');
INSERT INTO autor VALUES (23, 'Bram Stoker', 'Irlanda', '1847-11-08',1, 'Novelista irlandés autor de Drácula, obra clásica y de las más influyentes dentro de la literatura de terror. Hijo de un funcionario público, hasta los siete años de edad sufrió una grave parálisis que le impedía andar. Los problemas de salud de su niñez no le impidieron distinguirse como atleta y futbolista en la Universidad de Dublín, donde cursó con excelentes resultados la carrera de matemáticas y fue presidente de la Sociedad Filosófica. ');
INSERT INTO autor VALUES (24, 'Mary Shelley', 'Reino Unido', '1797-08-30',1, 'La británica Mary Shelley fue hija del filósofo y político William Godwin y de la filósofa y pionera feminista Mary Wollstonecraft. Se crió en un ambiente profundamente literario y bohemio. Su madre murió al dar a luz pero su defensa de los derechos de las mujeres y de la libertad fueron el espejo donde siempre se miró la joven, que a menudo acudía a escribir a la tumba de Wollstonecraft. Los historiadores han redescubierto a Mary Shelley como una de las principales figuras del romanticismo, creadora significativa por sus logros literarios y por su importancia política como mujer y militante liberal.​ El dolor, la soledad y el sentimiento de pérdida, sufrió la muerte de tres hijos sumada a su propia orfandad, atraviesan todas sus obras. Un espíritu que plasmó con tan solo 18 años en Frankenstein.');
INSERT INTO autor VALUES (25, 'Runyx', 'España', '1985-03-12',0, 'RuNyx es autora de novelas románticas del New York Times y USA Today y de bestsellers internacionales. Sus historias abarcan subgéneros que van desde lo oscuro contemporáneo hasta lo gótico, lo histórico, lo fantástico y más, y actualmente se están traduciendo a más de 10 idiomas. Su seudónimo tiene un significado muy especial para ella. Cuando no escribe, lee, viaja, medita, sueña despierta y, sobre todo, pospone las cosas.');

INSERT INTO libro VALUES (1,'Trono de cristal', 'Fantasía', 'Hidra', 528, 'Español', '2020-11-02', 'Tapa blanda', 18.15, 'En las tenebrosas minas de sal de Endovier, una muchacha de dieciocho años cumple cadena perpetua. Es una asesina profesional, la mejor en lo suyo, pero ha cometido un error fatal. La han capturado. El joven capitán Westfall le ofrece un trato: la libertad a cambio de un enorme sacrificio. Celaena debe representar al príncipe en un torneo a muerte, en el que deberá luchar con los asesinos y ladrones más peligrosos del reino. Viva o muerta, Celaena será libre. Tanto si gana como si pierde, está a punto de descubrir su verdadero destino. Pero ¿qué pasará entretanto con su corazón de asesina?','Trono de cristal',1,1,1);
INSERT INTO libro VALUES (2,'Corona de medianoche', 'Fantasía', 'Hidra', 512, 'Español', '2021-03-08', 'Tapa blanda', 18.15, 'Cargada de acción y personajes inolvidables, la segunda parte de esta saga superventas que se ha convertido en un fenómeno en todo el mundo entusiasmará a la enorme base de fans de Sarah J. Maas.Celaena Sardothien se ha convertido en la campeona del rey, aunque dista mucho de ser leal a la Corona. El rey es perverso, y Celaena, atrapada en la red de intrigas y misterios del castillo de cristal, no puede confiar en nadie, ni siquiera en el príncipe Dorian, en el capitán de la guardia, Chaol, o en su amiga, la princesa Nehemia.Cuando algo absolutamente inesperado suceda, Celaena se verá obligada a decidir de una vez por todas a quién ofrecerle su lealtad… y por quién luchar.','Trono de cristal',2,1,1);
INSERT INTO libro VALUES (3,'Heredera de fuego', 'Fantasía', 'Hidra', 672, 'Español', '2021-09-06', 'Tapa blanda', 18.15, 'Como asesina del rey, Celaena Sardothien está obligada a servir al tirano que asesinó a su mejor amiga. Pero se ha prometido a sí misma que se lo hará pagar. Las respuestas que Celaena necesita para destruir al rey se encuentran más allá del mar, en Wendlyn. Y Chaol, capitán de la guardia real, ha puesto su futuro en peligro al enviarla allí.Y mientras Celaena busca su destino en Wendlyn, una nueva amenaza se prepara para asaltar los cielos. ¿Encontrará Celaena las fuerzas necesarias no solo para ganar sus propias batallas, sino para ir a una guerra que podría poner a prueba la lealtad hacia los suyos y enfrentarla a aquellos que han llegado a convertirse en sus seres más queridos?','Trono de cristal',3,1,1);
INSERT INTO libro VALUES (4, 'Reina de sombras', 'Fantasía', 'Hidra', 648, 'Español', '2015-09-01', 'Tapa blanda', 18.15, 'Celaena Sardothien, ahora como Aelin Ashryver Galathynius, debe reunir a sus aliados y enfrentarse a una nueva amenaza mientras busca recuperar su reino y descubrir su verdadero destino.', 'Trono de cristal', 4, 1,1);
INSERT INTO libro VALUES (5, 'Imperio de tormentas', 'Fantasía', 'Hidra', 720, 'Español', '2016-09-06', 'Tapa blanda', 18.15, 'Aelin debe luchar contra la oscuridad y las traiciones mientras se prepara para la guerra que determinará el futuro de su reino y de todos los reinos.', 'Trono de cristal', 5, 1,1);
INSERT INTO libro VALUES (6, 'Torre del alba', 'Fantasía', 'Hidra', 480, 'Español', '2017-09-07', 'Tapa blanda', 18.15, 'Mientras Aelin se recupera de sus heridas, su grupo de amigos debe enfrentarse a sus propios desafíos y peligros, preparando el terreno para la batalla final.', 'Trono de cristal', 6, 1,1);
INSERT INTO libro VALUES (7, 'Reino de cenizas', 'Fantasía', 'Hidra', 720, 'Español', '2018-10-23', 'Tapa blanda', 18.15, 'Aelin y sus amigos deben unir fuerzas para enfrentar a la oscuridad en una guerra que cambiará el destino de todos. La lucha por la libertad y la justicia está en juego.', 'Trono de cristal', 7, 1,1);
INSERT INTO libro VALUES (8,'Misery', 'Terror', 'Debolsillo', 376, 'Español', '2003-03-20', 'Tapa blanda', 14.59, 'Paul Shledon es un escritor que sufre un grave accidente y recobra el conocimiento en una apartada casa en la que vive una misteriosa mujer, corpulenta y de extraño carácter. Se trata de una antigua enfermera, involucrada en varias muertes misteriosas ocurridas en diversos hospitales. Fanática de un personaje de una serie de libros que él ha decido dejar de escribir, está dispuesta a hacer todo lo necesario para "convencerlo" de que retome la escritura. Esta mujer es capaz de los mayores horrores, y Paul, con las piernas rotas y entre terribles dolores, tendrá que luchar por su vida.', null ,null,2,1);
INSERT INTO libro VALUES (9, 'Legend', 'Distopía', 'Putnam', 368, 'Español', '2011-11-29', 'Tapa dura', 11.99, 'En una sociedad dividida por la guerra, dos jóvenes con orígenes opuestos se cruzan en un mundo lleno de secretos y conspiraciones.', 'Legend', 1, 3,1);
INSERT INTO libro VALUES (10, 'Prodigy', 'Distopía', 'Putnam', 384, 'Español', '2013-01-29', 'Tapa dura', 11.99, 'June y Day deben decidir en quién confiar mientras luchan por la libertad en un mundo donde la traición está a la vuelta de la esquina.', 'Legend', 2, 3,1);
INSERT INTO libro VALUES (11, 'Champion', 'Distopía', 'Putnam', 368, 'Español', '2013-11-05', 'Tapa dura', 11.99, 'El destino de la República y su futuro están en manos de June y Day mientras enfrentan decisiones difíciles que cambiarán el curso de sus vidas.', 'Legend', 3, 3,1);
INSERT INTO libro VALUES (12, 'The Invisible Life of Addie LaRue', 'Fantasía', 'Tor Books', 448, 'Inglés', '2020-10-06', 'Tapa blanda', 24.99, 'Una joven hace un trato para vivir eternamente, pero es olvidada por todos. Su historia se desarrolla a lo largo de los siglos.', null, null, 4,1);
INSERT INTO libro VALUES (13, 'Angelfall', 'Distopía', 'Skyscape', 368, 'Inglés', '2011-05-01', 'Tapa blanda', 16.99, 'En un mundo devastado por una guerra entre ángeles y humanos, la joven Penryn se encuentra en una lucha desesperada por salvar a su hermana y a sí misma.', 'Ángeles Caídos', 1, 5,1);
INSERT INTO libro VALUES (14, 'World After', 'Distopía', 'Skyscape', 384, 'Inglés', '2013-11-19', 'Tapa blanda', 16.99, 'Penryn y su compañero ángel Raffe deben enfrentar nuevos peligros y traiciones mientras buscan sobrevivir en un mundo donde los ángeles son tanto enemigos como aliados.', 'Ángeles Caídos', 2, 5,1);
INSERT INTO libro VALUES (15, 'End of Days', 'Distopía', 'Skyscape', 480, 'Inglés', '2014-05-12', 'Tapa blanda', 16.99, 'La batalla final por la humanidad se acerca, y Penryn debe decidir en quién confiar y qué sacrificios está dispuesta a hacer para salvar a los que ama.', 'Ángeles Caídos', 3, 5,1);
INSERT INTO libro VALUES (16, 'Hooked', 'Romance', 'Montena', 300, 'Inglés', '2021-06-15', 'Tapa blanda', 14.99, 'Una reimaginación oscura del cuento de Peter Pan, donde Wendy se enfrenta a un mundo de magia y peligro para salvar a sus seres queridos.', 'Never after series', 1, 6,1);
INSERT INTO libro VALUES (17, 'Scarred', 'Romance', 'Montena', 320, 'Inglés', '2022-02-22', 'Tapa blanda', 14.99, 'La historia de un amor prohibido que desafía las normas de un mundo mágico y peligroso, explorando la redención y la lucha por el amor.', 'Never after series', 2, 6,1);
INSERT INTO libro VALUES (18, 'Wretched', 'Romance', 'Montena', 380, 'Inglés', '2021-12-05', 'Tapa blanda', 14.99, 'La historia de una sirena atrapada entre dos mundos, luchando por encontrar su lugar mientras navega por el amor y la traición.', 'Never after series', 3, 6,1);
INSERT INTO libro VALUES (19, 'Twisted', 'Romance', 'Montena', 350, 'Inglés', '2021-05-10', 'Tapa blanda', 14.99, 'Una reimaginación oscura de la historia de Rapunzel, donde los secretos y la pasión se entrelazan en una lucha por la libertad.', 'Never after series', 4, 6,1);
INSERT INTO libro VALUES (20, 'Matar un reino', 'Fantasía', 'Gran travesía', 400, 'Español', '2018-03-06', 'Tapa blanda', 17.99, 'Una reimaginación oscura del cuento de la sirenita, donde la princesa de los mares se ve atrapada en un mundo de traiciones y secretos mientras busca venganza.', null, null, 7,1);
INSERT INTO libro VALUES (21, 'A ciegas', 'Terror', 'Planeta', 300, 'Español', '2014-05-13', 'Tapa blanda', 16.99, 'En un mundo post-apocalíptico donde una presencia desconocida lleva a las personas a la locura si la ven, una madre y sus dos hijos deben emprender un peligroso viaje a ciegas para sobrevivir.', null, null, 8,1);
INSERT INTO libro VALUES (22, 'Shatter Me', 'Distopía', 'HarperCollins', 338, 'Español', '2011-11-15', 'Tapa blanda', 16.99, 'Juliette tiene un don mortal: su toque puede matar. Atrapada en una prisión, su vida cambia cuando se encuentra con Adam, un soldado que podría ser su única esperanza.', 'Shatter Me', 1, 9,1);
INSERT INTO libro VALUES (23, 'Unravel Me', 'Distopía', 'HarperCollins', 461, 'Español', '2013-02-05', 'Tapa blanda', 17.99, 'Juliette lucha con su poder y su identidad mientras se enfrenta a nuevos enemigos y descubre más sobre su pasado.', 'Shatter Me', 2, 9,1);
INSERT INTO libro VALUES (24, 'Ignite Me', 'Distopía', 'HarperCollins', 416, 'Español', '2014-02-04', 'Tapa blanda', 17.99, 'Juliette debe elegir entre su amor por Adam y su conexión con Warner, mientras enfrenta una nueva amenaza para su mundo.', 'Shatter Me', 3, 9,1);
INSERT INTO libro VALUES (25, 'Restore Me', 'Distopía', 'HarperCollins', 368, 'Español', '2018-03-06', 'Tapa blanda', 17.99, 'Después de los eventos de "Ignite Me", Juliette lucha por mantener el control en un mundo que se tambalea entre la paz y la guerra.', 'Shatter Me', 4, 9,1);
INSERT INTO libro VALUES (26, 'Una corte de rosas y espinas', 'Fantasía', 'Cross books', 432, 'Español', '2015-05-05', 'Tapa dura', 26.15, 'Cuando Feyre, una cazadora, mata a un lobo, es llevada a Prythian, un mundo mágico, donde se enfrenta a un alto fae que le revela secretos sobre su propio destino.', 'Una corte de rosas y espinas', 1, 1,1);
INSERT INTO libro VALUES (27, 'Una corte de niebla y furia', 'Fantasía', 'Cross books', 640, 'Español', '2016-05-03', 'Tapa dura', 26.15, 'Feyre se enfrenta a nuevos retos y debe encontrar su lugar en un mundo lleno de fae y antiguas profecías, mientras la amenaza de la guerra se cierne sobre Prythian.', 'Una corte de rosas y espinas', 2, 1,1);
INSERT INTO libro VALUES (28, 'Una corte de alas y ruina', 'Fantasía', 'Cross books', 704, 'Español', '2017-05-02', 'Tapa dura', 26.15, 'La guerra ha llegado a Prythian y Feyre y sus amigos deben luchar por la supervivencia mientras enfrentan enemigos que desean destruir todo lo que aman.', 'Una corte de rosas y espinas', 3, 1,1);
INSERT INTO libro VALUES (29, 'Una corte de hielo y estrellas', 'Fantasía', 'Cross books', 272, 'Español', '2018-05-01', 'Tapa dura', 26.15, 'Una colección de historias que expanden el universo de Prythian, explorando a fondo a los personajes y su desarrollo tras los eventos de la serie principal.', 'Una corte de rosas y espinas', 4, 1,1);
INSERT INTO libro VALUES (30, 'Una corte de llamas plateadas', 'Fantasía', 'Cross books', 560, 'Español', '2021-01-26', 'Tapa dura', 26.15, 'La historia sigue a Feyre y sus amigos mientras enfrentan nuevos desafíos en el mundo de Prythian, explorando temas de amor, traición y poder.', 'Una corte de rosas y espinas', 5, 1,1);
INSERT INTO libro VALUES (31, 'Mr. Mercedes', 'Thriller', 'Sinma', 432, 'Español', '2015-06-02', 'Tapa blanda', 14.99, 'Un exdetective de la policía se obsesiona con un caso sin resolver sobre un asesino que se escapó tras una masacre. Ahora debe enfrentarse al criminal antes de que ataque de nuevo.', null, null, 2,1);
INSERT INTO libro VALUES (32, 'Heridas abiertas', 'Thriller', 'Salamandra', 368, 'Español', '2012-04-10', 'Tapa blanda', 18.99, 'Una periodista regresa a su pueblo natal para cubrir el asesinato de dos adolescentes, enfrentándose a su oscuro pasado y a secretos familiares que podrían destruirla.', null, null, 10,1);
INSERT INTO libro VALUES (33, 'La fábrica de avispas', 'Thriller', 'Planeta', 512, 'Español', '2018-07-10', 'Tapa blanda', 17.99, 'En un mundo donde las personas pueden convertirse en avispas, un joven debe enfrentarse a su destino mientras desentraña los secretos de su familia y su propia identidad.', null, null, 11,1);
INSERT INTO libro VALUES (34, 'Alas de sangre', 'Fantasía', 'Planeta', 432, 'Español', '2015-09-01', 'Tapa blanda', 19.99, 'Una joven descubre que tiene el poder de controlar las sombras mientras se enfrenta a una antigua amenaza que busca desatar el caos en su mundo.', 'Empireo',1, 12,1);
INSERT INTO libro VALUES (35, 'Alas de hierro', 'Fantasía', 'Planeta', 480, 'Español', '2016-04-25', 'Tapa blanda', 19.99, 'La batalla entre los seres de luz y de sombra se intensifica mientras la protagonista debe elegir entre su amor y su deber, enfrentándose a sacrificios inimaginables.','Empireo', 2, 12,1);
INSERT INTO libro VALUES (36, 'La Bestia', 'Thriller', 'Alfaguara', 544, 'Español', '2021-10-28', 'Tapa dura', 22.90, 'En el Madrid de 1834, una misteriosa epidemia asola la ciudad y una bestia sanguinaria comienza a sembrar el terror, mientras tres personajes muy diferentes entre sí se unen en una lucha desesperada por sobrevivir.', null, null, 13,1);
INSERT INTO libro VALUES (37, 'La chica del tren', 'Thriller', 'Planeta', 496, 'Español', '2015-06-15', 'Tapa blanda', 16.99, 'Rachel viaja en el tren todos los días, observando a una pareja desde la ventana. Un día, presencia algo sorprendente que la lleva a involucrarse en un misterio que cambiará su vida para siempre.', null, null, 14,1);
INSERT INTO libro VALUES (38, 'El juego del ángel', 'Thriller', 'Planeta', 608, 'Español', '2008-04-15', 'Tapa blanda', 19.99, 'En la Barcelona de los años 1920, un joven escritor recibe una oferta que lo sumergirá en un mundo de conspiraciones y misterios literarios.', null, null, 15,1);
INSERT INTO libro VALUES (39, 'No se lo digas a nadie', 'Thriller', 'RBA', 512, 'Español', '2016-04-01', 'Tapa blanda', 16.99, 'Una madre luchadora debe enfrentarse a un oscuro secreto del pasado que amenaza con destruir su vida y la de su familia.', null, null, 16,1);
INSERT INTO libro VALUES (40, 'La buena hija', 'Thriller', 'HarperCollins', 512, 'Español', '2017-08-01', 'Tapa blanda', 18.99, 'Dos hermanas quedan atrapadas en un violento crimen que cambiará sus vidas para siempre, enfrentándose a un oscuro pasado y a decisiones desgarradoras.', null, null, 17,1);
INSERT INTO libro VALUES (41, 'En un bosque muy oscuro', 'Thriller', 'RBA', 416, 'Español', '2016-07-26', 'Tapa blanda', 17.99, 'Una mujer es invitada a un fin de semana en una casa de campo, pero lo que comienza como una escapada relajante se convierte en una pesadilla cuando surgen secretos del pasado.', null, null, 18,1);
INSERT INTO libro VALUES (42, 'El llamado de Cthulhu', 'Terror', 'Alma Clásicos ilustrados', 128, 'Español', '1928-10-01', 'Tapa dura', 12.99, 'Una de las obras más emblemáticas de H. P. Lovecraft, en la que se narra el descubrimiento de una antigua y maligna entidad conocida como Cthulhu, que yace dormida en las profundidades del océano, esperando su despertar.', null, null, 19,1);
INSERT INTO libro VALUES (43, 'La caída de la casa Usher', 'Terror', 'Alianza Editorial', 104, 'Español', '1845-04-15', 'Tapa blanda', 7.99, 'Un inquietante relato de Edgar Allan Poe en el que el protagonista visita la casa de un amigo enfermo, solo para ser arrastrado a un espiral de locura y destrucción junto con la maldita mansión.', null, null, 20,1);
INSERT INTO libro VALUES (44, 'El cuervo', 'Terror', 'Alma Clásicos ilustrados', 64, 'Español', '1845-01-29', 'Tapa blanda', 5.99, 'El poema más famoso de Edgar Allan Poe, "El cuervo", relata el encuentro entre un hombre solitario y un cuervo que repite la palabra "Nunca más", explorando la desesperación, la pérdida y la locura.', null, null, 20,1);
INSERT INTO libro VALUES (45, 'El gato negro', 'Terror', 'Alianza Editorial', 128, 'Español', '1843-08-19', 'Tapa blanda', 6.99, 'Un perturbador relato de Poe en el que un hombre, acosado por su culpa y paranoia tras cometer un crimen atroz, ve cómo su vida se desmorona debido a la aparición recurrente de un misterioso gato negro.', null, null, 20,1);
INSERT INTO libro VALUES (46, 'El corazón delator', 'Terror', 'Planeta', 96, 'Español', '1843-01-01', 'Tapa blanda', 5.49, 'Uno de los cuentos más célebres de Poe, que narra la historia de un hombre que, obsesionado por el ojo de un anciano, lo asesina, pero su locura lo lleva a confesar debido al sonido persistente de un corazón latiendo bajo el suelo.', null, null, 20,1);
INSERT INTO libro VALUES (47, 'La máscara de la muerte roja', 'Terror', 'Saga', 96, 'Español', '1842-05-01', 'Tapa dura', 7.99, 'En este macabro cuento, Poe narra la historia de un príncipe que intenta escapar de una plaga mortal refugiándose en su castillo, solo para descubrir que ni la riqueza ni el poder pueden salvarlo de la muerte.', null, null, 20,1);
INSERT INTO libro VALUES (48, 'El pozo y el péndulo', 'Terror', 'Del Fondo', 144, 'Español', '1842-01-01', 'Tapa blanda', 6.99, 'Relato de horror psicológico en el que un prisionero de la Inquisición Española enfrenta una muerte lenta y angustiosa en una celda llena de trampas mortales, destacando el estilo oscuro y opresivo de Poe.', null, null, 20,1);
INSERT INTO libro VALUES (49, 'Los crímenes de la calle Morgue', 'Terror', 'Austral', 160, 'Español', '1841-04-01', 'Tapa blanda', 8.99, 'Considerado uno de los primeros relatos de detectives, Poe presenta al detective Dupin, quien resuelve un misterioso asesinato en París, sentando las bases para el género policíaco.', null, null, 20,1);
INSERT INTO libro VALUES (50, 'El retrato oval', 'Terror', 'Elejandria', 80, 'Español', '1842-04-01', 'Tapa blanda', 4.99, 'Un breve pero intenso relato de Poe, en el que un hombre descubre un retrato tan realista que parece poseer una parte del alma de la modelo, en una historia que explora el arte, la obsesión y la muerte.', null, null, 20,1);
INSERT INTO libro VALUES (51, 'Berenice', 'Terror', 'Elejandria', 112, 'Español', '1835-03-01', 'Tapa blanda', 6.49, 'Este relato narra la historia de un hombre que, obsesionado con la dentadura perfecta de su prima Berenice, comete un acto atroz, sumergiéndose en un abismo de locura.', null, null, 20,1);
INSERT INTO libro VALUES (52, 'Ligeia', 'Terror', 'Elejandria', 144, 'Español', '1838-09-01', 'Tapa blanda', 7.49, 'Un cuento de horror gótico en el que el narrador se obsesiona con su primera esposa, Ligeia, quien parece regresar de la muerte para atormentar a su segunda esposa, en una historia que mezcla el amor, la muerte y lo sobrenatural.', null, null, 20,1);
INSERT INTO libro VALUES (53, 'Hellraiser', 'Terror', 'HarperCollins', 224, 'Inglés', '1986-11-01', 'Tapa blanda', 14.99, 'En esta novela de Clive Barker, Frank Cotton abre una caja que promete placeres más allá de lo imaginable, pero en lugar de éxtasis, desata una horrorosa dimensión de dolor y tortura a manos de los cenobitas.', null, null, 21,1);
INSERT INTO libro VALUES (54, 'La maldición de Hill House', 'Terror', 'Minúscula', 256, 'Inglés', '1959-10-16', 'Tapa blanda', 16.99, 'Una de las novelas más influyentes del terror moderno, donde un grupo de personas se enfrenta a los horrores sobrenaturales que se manifiestan en una antigua y misteriosa mansión.', null, null, 22,1);
INSERT INTO libro VALUES (55, 'Drácula', 'Terror', 'Alma Clásicos ilustrados', 576, 'Español', '1897-05-26', 'Tapa dura', 19.99, 'La icónica novela de Bram Stoker que narra la historia del conde Drácula, un vampiro que viaja desde Transilvania a Inglaterra para expandir su reino de terror.', null, null, 23,1);
INSERT INTO libro VALUES (56, 'Frankenstein', 'Terror', 'Random house', 280, 'Inglés', '1818-01-01', 'Tapa blanda', 11.99, 'La revolucionaria obra de Mary Shelley, en la que el científico Víctor Frankenstein crea una criatura a partir de cadáveres, solo para ser perseguido por las consecuencias de jugar con la vida y la muerte.', null, null, 24,1);
INSERT INTO libro VALUES (57, 'El juego de Gerald', 'Thriller', 'DeBolsillo', 496, 'Español', '1992-05-19', 'Tapa blanda', 8.99, 'Un juego sexual entre un matrimonio en una cabaña aislada sale terriblemente mal cuando Gerald muere inesperadamente, dejando a su esposa Jessie esposada a la cama sin posibilidad de escapar, mientras sus demonios internos resurgen.', null, null, 2,1);
INSERT INTO libro VALUES (58, 'La milla verde', 'Thriller', 'DeBolsillo', 448, 'Español', '1996-03-28', 'Tapa blanda', 9.49, 'En el corredor de la muerte, los guardias se ven obligados a confrontar lo inexplicable cuando un prisionero condenado, John Coffey, parece tener poderes sobrenaturales. Un thriller emotivo que también es una reflexión sobre el castigo y la compasión.', null, null, 2,1);
INSERT INTO libro VALUES (59, 'El visitante', 'Thriller', 'Plaza & Janés', 592, 'Español', '2018-05-22', 'Tapa dura', 11.49, 'Cuando un respetado maestro de escuela es acusado de un asesinato brutal con pruebas innegables en su contra, el detective Ralph Anderson se enfrenta a un caso desconcertante que desafía la lógica, llevando la investigación a un terreno paranormal.', null, null, 2,1);
INSERT INTO libro VALUES (60, 'Una obsesión perversa', 'Fantasía', 'Umbriel', 432, 'Español', '2018-09-25', 'Tapa blanda', 17.95, 'Victor Vale y Eli Ever, dos jóvenes brillantes pero arrogantes, descubren una forma de desarrollar habilidades extraordinarias tras experimentar cercanas a la muerte. Sin embargo, sus caminos se separan y pronto se convierten en enemigos, cada uno obsesionado con derrotar al otro en este thriller psicológico lleno de moral ambigua y acción trepidante.', 'Villains', 1, 4,1);
INSERT INTO libro VALUES (61, 'Una venganza mortal', 'Fantasía', 'Umbriel', 480, 'Español', '2019-02-26', 'Tapa blanda', 18.95, 'En esta secuela de "Una obsesión perversa", Victor y Eli, ahora con sus poderes al máximo, enfrentan las consecuencias de sus decisiones pasadas mientras nuevos personajes con habilidades sobrenaturales entran en juego. La lucha por el control y la venganza alcanza su punto culminante en una trama llena de giros, oscuridad y emociones intensas.', 'Villains', 2, 4,1);
INSERT INTO libro VALUES (62, 'Perdida', 'Thriller', 'Random House', 576, 'Español', '2013-05-28', 'Tapa blanda', 19.90, 'Nick y Amy Dunne parecen tener el matrimonio perfecto hasta que, en su quinto aniversario, Amy desaparece misteriosamente. Las sospechas rápidamente recaen sobre Nick, cuya conducta sospechosa y comportamiento errático lo convierten en el principal sospechoso. En este thriller psicológico cargado de tensión, las mentiras, manipulaciones y oscuros secretos se desvelan para mostrar que las apariencias engañan.', null, null, 10,1);
INSERT INTO libro VALUES (63, 'La novia gitana', 'Thriller', 'DeBolsillo', 408, 'Español', '2018-05-17', 'Tapa blanda', 18.90, 'La inspectora Elena Blanco se enfrenta a un caso aterrador: una joven de origen gitano desaparece y es hallada brutalmente asesinada de una forma que recuerda a otro crimen no resuelto.', ' Novia Gitana', 1, 13,1);
INSERT INTO libro VALUES (64, 'La red púrpura', 'Thriller', 'DeBolsillo', 400, 'Español', '2019-04-04', 'Tapa blanda', 19.90, 'Elena Blanco sigue las pistas de una red criminal que difunde contenido violento en la deep web mientras lucha contra sus propios demonios personales, con giros inesperados que la pondrán al borde de la ley.', 'Novia Gitana', 2, 13,1);
INSERT INTO libro VALUES (65, 'La nena', 'Thriller', 'DeBolsillo', 432, 'Español', '2020-09-17', 'Tapa dura', 20.90, 'La inspectora Blanco y su equipo se enfrentan a un nuevo caso en el que la desaparición de una mujer se convierte en el eje de una trama retorcida y peligrosa que amenaza sus propias vidas.', 'Novia Gitana', 3, 13,1);
INSERT INTO libro VALUES (66, 'The predator', 'Romance', 'B', 360, 'Español', '2023-01-12', 'Tapa dura', 20.90, 'Tristan Caine es una anomalía en los bajos fondos de la mafia. Es el único miembro de los Tenebrae que no pertenece a la familia. Sus habilidades no tienen igual, su moralidad es más que cuestionable y sus motivaciones son todo un enigma. Es letal, y lo sabe.Morana Vitalio tambien es consciente de ello. Es la hija de la familia rival, una mente tecnológica brillante capaz de hacer con un ordenador lo que Tristan con una pistola. Cuando un misterio de hace más de veinte años vuelve a salir a la luz, Morana se infiltra en la casa de Caine dispuesta a matarlo…, aunque ignora los lazos que los unen y que harán que el odio, el deseo y el pasado los aten sin remedio.', 'Darkverse', 1, 25,1);
INSERT INTO libro VALUES (67, 'The reaper', 'Romance', 'B', 355, 'Español', '2023-04-15', 'Tapa dura', 16.90, 'Tristan Caine, el Cazador, no estaba preparado para la llegada de Morana Vitalio. Tras romper una promesa que llevaba defendiendo años, dentro de él se origina una batalla encarnizada entre su futuro y su pasado. La única certeza que tiene es que la vida de Morana aún le pertenece.A Morana Vitalio, la línea entre enemigos y aliados cada vez le parece más difusa. Su mundo se ha desintegrado ante sus ojos y, ahora, se enfrenta al vacío de lo desconocido en territorio hostil. La única certeza que tiene es que ella es la dueña de su propia vida.', 'Darkverse', 2, 25,1);
INSERT INTO libro VALUES (68, 'The emperor', 'Romance', 'B', 393, 'Español', '2023-11-25', 'Tapa dura', 16.90, 'Dante Maroni ha sido entrenado desde su nacimiento. Un rebelde silencioso en las sombras, ha aprendido a ocultar su crueldad bajo su encanto, su brutalidad bajo sus trajes y su amor por una mujer bajo su silencio. Al infiltrarse en el sindicato responsable de los niños desaparecidos, Dante descubre información que destroza su realidad y lo obliga a desencadenar un juego letal. Hija del ama de llaves de Maroni, Amara ama a Dante desde hace más tiempo del que lo conoce. Secuestrada y torturada a la temprana edad de quince años, se pierde a sí misma, a su vida y a su hogar tal como lo conoce. Años después, protegida sin saberlo, encuentra algo parecido a la normalidad cuando su mundo vuelve a colapsar, lo que la obliga a unirse al juego.', 'Darkverse', 3, 25,1);
INSERT INTO libro VALUES (69, 'The finisher', 'Romance', 'B', 420, 'Español', '2024-01-03', 'Tapa dura', 16.90, 'Al crecer en las calles de Los Fortis, Alessandro,Alpha Villanova se abrió camino hasta la cima, luchando por su supervivencia, perdiendo todo en el proceso. Una ciudad que entonces lo rechazó es ahora la que él gobierna, aunque solo, como el rey de un imperio oscuro que pocos conocen.Lejos del mundo de Alpha, Zephyr de la Vega tiene una vida normal, una familia normal, un drama normal. Su mayor problema es que la gente intenta hacerla perder algunos kilos. Cuando un encuentro casual la pone en su camino, ella le hace una propuesta que cambiará el curso de sus vidas.', 'Darkverse', 4, 25,1);
INSERT INTO libro VALUES (70, 'The annihilator', 'Romance', 'B', 324, 'Español', '2024-06-25', 'Tapa dura', 16.90, 'Ella vive en las sombras. Él los gobierna. Ella es la luna y él la noche oscura que la envuelve.Ella está rodeada de demonios y él es el demonio más grande de todos.Y ella es suya. Pasión, obsesión, posesión. La suya es una historia de peligro, desviación, temor, deseos y los sabores más oscuros del amor.', 'Darkverse', 5, 25,1);

INSERT INTO cliente VALUES (1, 'Mari', 'Salar Garcia', 'mari.d3v@gmail.com', '4297f44b13955235245b2497399d7a93', 1);
INSERT INTO cliente VALUES (2, 'Juan', 'Rodríguez Toral', 'imrivenbot@gmail.com', '4297f44b13955235245b2497399d7a93', 1);
INSERT INTO cliente VALUES 
(6, 'Lucía', 'Martínez Pérez', 'luciamartinez@example.com', 'e99a18c428cb38d5f260853678922e03', 0),
(7, 'Carlos', 'González Ruiz', 'cgonzalez@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 0),
(8, 'María', 'López Díaz', 'mlopez123@correo.com', '098f6bcd4621d373cade4e832627b4f6', 0),
(9, 'Andrés', 'Fernández Romero', 'andres.fernandez@dominio.com', '25f9e794323b453885f5181f1b624d0b', 0),
(10, 'Elena', 'Morales Sánchez', 'elena.morales@example.org', '827ccb0eea8a706c4c34a16891f84e7b', 0),
(11, 'David', 'Ramírez Torres', 'd.ramirez@email.org', '21232f297a57a5a743894a0e4a801fc3', 0),
(12, 'Sandra', 'Jiménez Vargas', 'sandrajv@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 0),
(13, 'Pablo', 'Navarro León', 'pnavarro@email.com', '5ebe2294ecd0e0f08eab7690d2a6ee69', 0),
(14, 'Laura', 'Castro Molina', 'laura.castro@correo.net', '6cb75f652a9b52798eb6cf2201057c73', 0),
(15, 'Jorge', 'Serrano Cruz', 'j.serrano@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0),
(16, 'Raquel', 'Peña Muñoz', 'raquelpm@hotmail.com', '7c6a180b36896a0a8c02787eeafb0e4c', 0),
(17, 'Alberto', 'Iglesias Ríos', 'aiglesias@ejemplo.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 0),
(18, 'Natalia', 'Reyes Cabrera', 'nreyes@correo.org', '5f4dcc3b5aa765d61d8327deb882cf99', 0),
(19, 'Rubén', 'Delgado Suárez', 'rubensuarez@mail.com', '9e3669d19b675bd57058fd4664205d2a', 0),
(20, 'Claudia', 'Ortega Paredes', 'claudia.ortega@example.com', '1c383cd30b7c298ab50293adfecb7b18', 0),
(21, 'Mario', 'Vega Bravo', 'mvegab@example.org', '3c59dc048e8850243be8079a5c74d079', 0),
(22, 'Patricia', 'Campos Herrera', 'pcampos@dominio.com', 'b2e98ad6f6eb8508dd6a14cfa704bad7', 0),
(23, 'Víctor', 'Gil Marín', 'victorgilm@example.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(24, 'Isabel', 'Ramos Nieto', 'isabelramos@correo.net', 'a87ff679a2f3e71d9181a67b7542122c', 0),
(25, 'Hugo', 'Méndez Barrios', 'hmendez@ejemplo.com', '0cc175b9c0f1b6a831c399e269772661', 0);

-- Datos probar la web
INSERT INTO compra (codigo_compra, estado, fecha, nombre, apellidos, telefono, direccion, direccion_adicional, codigo_postal, poblacion, provincia, codigo_cliente, total) VALUES
(1, 'Entregado', '2025-06-01 10:45:00', 'Lucía', 'Martínez Pérez', 611223344, 'Calle Falsa 123', 'Piso 1B', 28001, 'Madrid', 'Madrid', 6, 36.30),
(2, 'En tránsito', '2025-06-02 15:20:00', 'Carlos', 'González Ruiz', 655778899, 'Av. Principal 45', 'Portal 4', 08021, 'Barcelona', 'Barcelona', 7, 18.15),
(3, 'Pendiente de envío', '2025-06-03 09:00:00', 'Sandra', 'Jiménez Vargas', 622334455, 'Calle Luna 76', 'Esc. Dcha', 41012, 'Sevilla', 'Sevilla', 12, 35.98),
(4, 'Enviado', '2025-06-01 12:00:00', 'David', 'Ramírez Torres', 612345678, 'Calle Mayor 10', '2ºA', 28010, 'Madrid', 'Madrid', 11, 157.42),
(5, 'Entregado', '2025-06-01 16:30:00', 'Elena', 'Morales Sánchez', 623456789, 'Av. del Sol 55', '3ºB', 08020, 'Barcelona', 'Barcelona', 10, 189.85),
(6, 'Pagado', '2025-06-02 09:00:00', 'María', 'López Díaz', 634567890, 'Calle Luna 21', '', 41013, 'Sevilla', 'Sevilla', 8, 144.99),
(7, 'En tránsito', '2025-06-02 14:15:00', 'Rubén', 'Delgado Suárez', 645678901, 'Camino Real 89', 'Chalet 1', 46001, 'Valencia', 'Valencia', 19, 128.79),
(8, 'Pendiente de pago', '2025-06-03 10:45:00', 'Claudia', 'Ortega Paredes', 656789012, 'Paseo del Parque 8', 'Ático D', 29001, 'Málaga', 'Málaga', 20, 117.91);

INSERT INTO detalle_compra (codigo_compra, codigo_libro, unidades, precio_unitario) VALUES
(1, 1, 1, 18.15),
(1, 2, 1, 18.15),
(2, 3, 1, 18.15),
(3, 5, 2, 17.99),
(4, 1, 1, 18.15),
(4, 2, 1, 18.15),
(4, 3, 1, 18.15),
(4, 4, 1, 18.15),
(4, 5, 1, 18.15),
(4, 6, 1, 18.15),
(4, 7, 1, 18.52),
(5, 8, 1, 14.59),
(5, 9, 1, 11.99),
(5, 10, 1, 11.99),
(5, 11, 1, 11.99),
(5, 12, 1, 24.99),
(5, 13, 1, 16.99),
(5, 14, 1, 16.99),
(5, 15, 1, 16.99),
(5, 16, 1, 14.99),
(5, 17, 1, 16.73),
(6, 18, 1, 14.99),
(6, 19, 1, 14.99),
(6, 20, 1, 17.99),
(6, 21, 1, 16.99),
(6, 22, 1, 16.99),
(6, 23, 1, 17.99),
(7, 24, 1, 17.99),
(7, 25, 1, 17.99),
(7, 26, 1, 26.15),
(7, 27, 1, 26.15),
(7, 28, 1, 26.51),
(8, 29, 1, 26.15),
(8, 30, 1, 26.15),
(8, 31, 1, 14.99),
(8, 32, 1, 18.99),
(8, 33, 1, 17.99),
(8, 34, 1, 13.64);

INSERT INTO visitas (visitas) VALUES (0);