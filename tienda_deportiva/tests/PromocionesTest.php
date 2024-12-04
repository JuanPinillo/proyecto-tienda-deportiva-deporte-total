<?php
namespace Tests;
use PHPUnit\Framework\TestCase;

class PromocionesTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        // Configuración inicial: establecer conexión a la base de datos
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'usuarios';

        $this->$conn = new \mysqli($host, $username, $password, $dbname);

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

    public function testCargarPromociones(): void {
        // Ejecutar el script de promociones
        ob_start();
        include 'promociones.php';
        $output = ob_get_clean();

        // Verificar que se cargaron datos correctamente
        $this->assertStringContainsString('<div class="four columns">', $output, "No se encontraron productos en las promociones.");
    }
}
?>
