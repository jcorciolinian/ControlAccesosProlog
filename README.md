# PROLOG Access System Final

Sistema web académico para el proyecto **Sistema de Control de Accesos PROLOG**.

## Tecnologías
- PHP 8+
- MySQL / MariaDB
- HTML, CSS
- Arquitectura MVC modular simplificada

## Módulos incluidos
- Login y sesión
- Dashboard
- Usuarios
- Roles y permisos
- Visitantes
- Validación QR mediante token
- Control de accesos
- Áreas restringidas
- Alertas
- Reportes
- Bitácora de auditoría

## Instalación en XAMPP
1. Copiar la carpeta `prolog_access_system_final` en:
   `C:\xampp\htdocs\`
2. Abrir XAMPP e iniciar Apache y MySQL.
3. Abrir phpMyAdmin.
4. Importar el archivo:
   `sql/prolog_access.sql`
5. Entrar a:
   `http://localhost/prolog_access_system_final/login.php`

## Credenciales
- Usuario: `admin`
- Clave: `Admin123*`

También:
- `seguridad` / `Admin123*`
- `supervisor` / `Admin123*`

## QR de demo
Usar el código:
`VIS-DEMO-001`

en el módulo:
Control de accesos → Validar QR

## Nota
La validación QR es mediante token textual para facilitar pruebas académicas.
La integración con cámara, biometría y RFID queda preparada como mejora futura.
