<!DOCTYPE html> 
<html> 
<head> 
    <title>REGISTRO</title> 
</head> 
<body align="center" > 
    <h1>REGISTRO DE EMPLEADOS</h1> 
    <form method="post" action=""> 
        <?php 
        $estadosCiviles = array( 
            "Soltero(a)", 
            "Casado(a)", 
            "Viudo(a)" 
        ); 
        $sueldos = array( 
            "Menos de 1000 Bs.", 
            "Entre 1000 y 2500 Bs.", 
            "Más de 2500 Bs." 
        ); 
        $empleados = array(); 

        $sumaEdadesHombres = 0; 
        $totalHombres = 0; 
 
        for ($i = 1; $i <= 5; $i++) { 
            echo "<h3>EMPLEADO $i</h3>"; 
            echo "<label>NOMBRE:</label>"; 
            echo "<input type='text' pattern='[A-Za-z]+' minlength='3' maxlength='25' name='nombre_$i'><br><br>"; 

            echo "<label>APELLIDO:</label>"; 
            echo "<input type='text' pattern='[A-Za-z]+' minlength='3' maxlength='25' name='apellido_$i'><br><br>"; 
 
            echo "<label>EDAD:</label>"; 
            echo "<input type='number' min='18' max='65' name='edad_$i'><br><br>"; 
 
            echo "<label>ESTADO CIVIL:</label>"; 
            echo "<select name='estado_civil_$i'>"; 
            foreach ($estadosCiviles as $estadoCivil) { 
                echo "<option value='$estadoCivil'>$estadoCivil</option>"; 
            } 
            echo "</select><br><br>"; 
 
            echo "<label>SEXO:</label>"; 
            echo "<input type='radio' name='sexo_$i' value='Femenino'>Femenino"; 
            echo "<input type='radio' name='sexo_$i' value='Masculino'>Masculino<br><br>"; 
 
            echo "<label>SUELDO:</label>"; 
            echo "<select name='sueldo_$i'>"; 
            foreach ($sueldos as $sueldo) { 
                echo "<option value='$sueldo'>$sueldo</option>"; 
            } 
            echo "</select><br><br><br>"; 
        } 
 
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
            for ($i = 1; $i <= 5; $i++) { 
                $empleado = array( 
                    "nombre" => $_POST["nombre_$i"], 
                    "apellido" => $_POST["apellido_$i"], 
                    "edad" => $_POST["edad_$i"], 
                    "estado_civil" => $_POST["estado_civil_$i"], 
                    "sexo" => $_POST["sexo_$i"], 
                    "sueldo" => $_POST["sueldo_$i"] 
                ); 
 
                $empleados[] = $empleado; 
 
                if ($empleado["sexo"] == "Masculino") { 
                    $sumaEdadesHombres += $empleado["edad"]; 
                    $totalHombres++; 
                } 
            } 
 
            $totalMujeres = 0; 
            $totalHombresCasados = 0; 
            $totalMujeresViudas = 0; 
 
            foreach ($empleados as $empleado) { 
                if ($empleado["sexo"] == "Femenino") { 
                    $totalMujeres++; 
                } 
 
                if ($empleado["sexo"] == "Masculino" && $empleado["estado_civil"] == "Casado(a)" && $empleado["sueldo"] == "Más de 2500 Bs.") { 
                    $totalHombresCasados++; 
                } 
 
                if ($empleado["sexo"] == "Femenino" && $empleado["estado_civil"] == "Viudo(a)" && $empleado["sueldo"] == "Entre 1000 y 2500 Bs." || $empleado["sueldo"] == "Más de 2500 Bs.") { 
                    $totalMujeresViudas++; 
                } 
            } 
 
            $edadPromedioHombres = $sumaEdadesHombres / $totalHombres; 
 
            echo "<h2>RESULTADOS</h2>"; 
            echo "<p>Empleados del sexo femenino: $totalMujeres</p>"; 
            echo "<p>Hombres casados que ganan más de 2500 Bs: $totalHombresCasados</p>"; 
            echo "<p>Mujeres viudas que ganan más de 1000 Bs: $totalMujeresViudas</p>"; 
            echo "<p>Edad promedio de los hombres: $edadPromedioHombres</p>"; 
        } 
        ?> 
 
        <input type="submit" value="Calcular"> 
        <input type="reset" value="Limpiar"> 
    </form> 
</body> 
</html>