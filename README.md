<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Proyecto de Gestion de ventas de una muebleria

Descripcion

Este proyecto es una api para registrar usuarios, inventario de muebles y realizar ventas, desarrollada utilizando laravel y cuenta con los sigueintes modulo.

## Usuarios.
Registro de usuario: permite registrar nuevos usuarios.

Validaciones: 
    *Correo_electronico: debe ser unico, estar en formato de correo electrónico y             pertenecer a los dominio gmail.com o itoaxaca.edu.mx.
    *Contrasena: debe tener al menos 8 caracteres, incluir letras mayusculas, minúscular, números y caracteres especiales, ademas de ser confirmada.
procesos:
Si las credenciaels son correctas, se devuelve un mensaje de inicio de sesion exitos al correo y se ingresa al sistema.

Inicio de sesion: Para el ingreso al sistema el usuario debe aunticarse por medio del correo registrado y la contraseña.
Validaciones: 
*Correo_elecrtronico: debe existri en la base de datos.
*Contraseña: debe coincidir con la almacenada en la base de datos.



## Inventario

Registro: permite agregar un nuevo mueble al inventario con la siguientes validaciones:

*Se deben rellenar correctamente los campos de nombre, descripción, colo y cantidad en la cual cantidad debe ser un nuermo entero no negativo.

Proceso: Se validan los datos y si son correcto y ademas se han rellando todos los campos se guarda el nuevo mueble en la base de datos en caso contrario no se completa el registro.

Obtenener mueble: Recupera la informacion del mueble en especifico por medio del su id y devuelve los datos para poder modificarlos.

Eliminar mueble Elimina un mueble seleccionado en la tabla de inventario mediante la busqueda de su id para posteriormente eliminarlo de la base de datos.


## Ventas 

Registrar Ventas: permite registrar una nueva venta.

Validaciones:

*inventario_id: debe existir en la base de datos.

*fehca: debe ser una fecha válida.

*Cantidad_productos: debe ser un numero entero positivo y no exceder la cantidad disponible en el inventario.

*precio: No debe ser un numero negativo.

*tipo de pago: se debe selecionar entre credito o contado.

Una vez rellenado los datos del formulario compliendo con las validaciones se registra la venta y actualizando el inventario.


