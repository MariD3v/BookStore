## Documentación de uso la API

Aquí podrás encontrar los Endpoints que tenemos disponibles desde de **BookStore** y cómo funcionan.
La API sigue una arquitectura sencilla basada en PHP con respuestas en formato JSON.

## Petición para obtener todos nuestros libros

- **URL:** `/api/Products.php`  
- **Método:** `GET`  
- **Descripción:** Devuelve un listado de objetos de todos los libros almacenados en la base de datos, ordenados por su código.

### Ejemplo de uso

```bash
GET /api/Products.php
```

<details>
  <summary>Respuesta esperada</summary>

```json
[
  {
    "codigo_libro": 1,
    "titulo": "Trono de cristal",
    "genero": "Fantasía",
    "editorial": "Hidra",
    "n_pag": 528,
    "idioma": "Español",
    "fecha_publ": "2020-11-02",
    "encuadernacion": "Tapa blanda",
    "precio": "18.15",
    "descripcion_libro": "Ejemplo de descripción",
    "serie": "Trono de cristal",
    "numero": 1,
    "codigo_autor": 1,
    "activado": 1
  },
  {
    "codigo_libro": 2,
    "titulo": "Corona de medianoche",
    "genero": "Fantasía",
    "editorial": "Hidra",
    "n_pag": 512,
    "idioma": "Español",
    "fecha_publ": "2021-03-08",
    "encuadernacion": "Tapa blanda",
    "precio": "18.15",
    "descripcion_libro": "Ejemplo de descripción",
    "serie": "Trono de cristal",
    "numero": 2,
    "codigo_autor": 1,
    "activado": 1
  }
]
```
</details>


## Petición para obtener un libro con ID especifico

- **URL:** `/api/ProductByID.php?id=1`  
- **Método:** `GET`  
- **Descripción:** Devuelve un objeto con los datos del libro.

### Ejemplo de uso

```bash
GET /api/ProductByID.php
```

<details>
  <summary>Respuesta esperada</summary>

```json
{
  "codigo_libro": 1,
  "titulo": "Trono de cristal",
  "genero": "Fantasía",
  "editorial": "Hidra",
  "n_pag": 528,
  "idioma": "Español",
  "fecha_publ": "2020-11-02",
  "encuadernacion": "Tapa blanda",
  "precio": "18.15",
  "descripcion_libro": "Ejemplo de descripción",
  "serie": "Trono de cristal",
  "numero": 1,
  "codigo_autor": 1,
  "activado": 1
}
```
</details>