<?php
use PHPUnit\Framework\TestCase;

class GuardarCompradorTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        // Configuración inicial: establecer conexión a la base de datos
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'usuarios';

        $this->conn = new mysqli($host, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            $this->fail("Error al conectar a la base de datos: " . $this->conn->connect_error);
        }
    }

    protected function tearDown(): void {
        // Cierra la conexión después de cada prueba
        if ($this->conn) {
            $this->conn->close();
        }
    }

    public function testGuardarDatosComprador(): void {
        // Insertar datos simulados
        $_POST['nombre'] = 'Juan Pérez';
        $_POST['direccion'] = 'Calle Falsa 123';
        $_POST['email'] = 'juan.perez@example.com';
        $_SESSION['id'] = 1;

        ob_start();
        include 'guardar_comprador.php';
        ob_end_clean();

        // Verificar que los datos se guardaron en la base de datos
        $result = $this->conn->query("SELECT * FROM compradores WHERE nombre = 'Juan Pérez'");
        $this->assertTrue($result->num_rows > 0, "No se guardaron los datos del comprador correctamente.");
    }
}
?>
