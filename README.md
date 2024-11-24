# **Instrucciones**

## **Preparación del proyecto**
1. Antes de correr el proyecto, asegúrese de tener la base de datos creada y lista.
2. Descomprima el proyecto y colóquelo en la carpeta `htdocs`.

## **Ejecución del proyecto**
1. Abra el archivo `index.php`, haga clic derecho y seleccione la opción **PHP Server: Serve Project**.
2. En caso de que el paso anterior no funcione, siga estos pasos:
   - Abra la terminal en **Visual Studio Code**.
   - Escriba el siguiente comando:  
     ```bash
     php -S localhost:3000
     ```
   - Presione **Enter**.

3. Listo, el proyecto estará disponible en `http://localhost:3000`.

---

## **Creación de usuario administrador**

### **Nota importante:**
El registro de usuario permite crear cuentas, pero estas no serán administradores por defecto.

### **Pasos para crear un usuario administrador:**

1. Diríjase a la carpeta `models/` y abra el archivo `Usuario.php`.
2. Modifique la siguiente línea:
   ```php
   $this->admin = '0';
   ```
por 
   ```php
   $this->admin = '1';
   ```

3. Registre un nuevo usuario utilizando la funcionalidad de registro del sistema.
4. Una vez registrado el usuario administrador, vuelva al archivo Usuario.php y restablezca la línea original:
   ```php
   $this->admin = '0';
   ```
5. ¡Listo! Ahora tendrá un usuario administrador y podrá registrar otros usuarios con roles normales.
