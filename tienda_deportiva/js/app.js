// Variables
const carrito = document.querySelector('#carrito');
const contenedorCarrito = document.querySelector('#lista-carrito tbody');
const vaciarCarritoBtn = document.querySelector('#vaciar-carrito');
const finalizarCompraBtn = document.querySelector('#finalizar-compra');
const listaCursos = document.querySelector('#lista-cursos');
const totalElement = document.querySelector('#total');
let articulosCarrito = [];

// Cargar eventos
cargarEventos();

function cargarEventos() {
    // Agregar curso al carrito
    listaCursos.addEventListener('click', agregarCurso);

    // Eliminar curso del carrito
    carrito.addEventListener('click', eliminarCurso);

    // Vaciar el carrito
    vaciarCarritoBtn.addEventListener('click', () => {
        articulosCarrito = [];
        limpiarHTML();
        actualizarTotal();
    });

    // Finalizar compra y generar factura
    finalizarCompraBtn.addEventListener('click', finalizarCompra);
}

// Funciones
function agregarCurso(e) {
    e.preventDefault();
    if (e.target.classList.contains('agregar-carrito')) {
        const cursoSeleccionado = e.target.parentElement.parentElement;
        leerDatosCurso(cursoSeleccionado);
    }
}

function eliminarCurso(e) {
    if (e.target.classList.contains('borrar-curso')) {
        const cursoId = e.target.getAttribute('data-id');
        articulosCarrito = articulosCarrito.filter(curso => curso.id !== cursoId);
        carritoHTML();
        actualizarTotal();
    }
}

function leerDatosCurso(curso) {
    const infoCurso = {
        imagen: curso.querySelector('img').src,
        titulo: curso.querySelector('h4').textContent,
        precio: curso.querySelector('.precio span').textContent,
        id: curso.querySelector('a').getAttribute('data-id'),
        cantidad: 1
    };

    const existe = articulosCarrito.some(curso => curso.id === infoCurso.id);
    if (existe) {
        const cursos = articulosCarrito.map(curso => {
            if (curso.id === infoCurso.id) {
                curso.cantidad++;
                return curso;
            } else {
                return curso;
            }
        });
        articulosCarrito = [...cursos];
    } else {
        articulosCarrito = [...articulosCarrito, infoCurso];
    }

    carritoHTML();
    actualizarTotal();
}

function carritoHTML() {
    limpiarHTML();

    articulosCarrito.forEach(curso => {
        const { imagen, titulo, precio, cantidad, id } = curso;
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <img src="${imagen}" width="100">
            </td>
            <td>${titulo}</td>
            <td>${precio}</td>
            <td>${cantidad}</td>
            <td>
                <a href="#" class="borrar-curso" data-id="${id}">X</a>
            </td>
        `;
        contenedorCarrito.appendChild(row);
    });
}

function limpiarHTML() {
    while (contenedorCarrito.firstChild) {
        contenedorCarrito.removeChild(contenedorCarrito.firstChild);
    }
}

function actualizarTotal() {
    const total = articulosCarrito.reduce((acc, curso) => {
        const precio = parseFloat(curso.precio.replace('$', '').replace(',', ''));
        return acc + (precio * curso.cantidad);
    }, 0);
    totalElement.textContent = `Total: $${total.toFixed(2)}`;
}

function finalizarCompra() {
    // Verificar si el carrito está vacío
    if (articulosCarrito.length === 0) {
        alert('El carrito está vacío');
        return;
    }

    // Verificar si los datos del comprador están completos
    const nombre = document.getElementById('nombre').value;
    const direccion = document.getElementById('direccion').value;
    const email = document.getElementById('email').value;

    if (!nombre || !direccion || !email) {
        alert('Completa los datos del comprador');
        return;
    }

    // Enviar datos del comprador a PHP y generar factura
    const facturaPDF = generarFacturaPDF(nombre, direccion, email);
    facturaPDF.save('factura.pdf');

    // Aquí puedes enviar los datos al servidor con fetch o un formulario oculto
    // Formulario de compra enviado mediante POST (puedes adaptarlo según necesites)
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'guardar_comprador.php'; // Ruta a tu archivo PHP

    form.innerHTML = `
        <input type="hidden" name="nombre" value="${nombre}">
        <input type="hidden" name="direccion" value="${direccion}">
        <input type="hidden" name="email" value="${email}">
    `;

    document.body.appendChild(form);
    form.submit();
}

function generarFacturaPDF(nombre, direccion, email) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Configuración básica
    const pageWidth = doc.internal.pageSize.getWidth();
    
    // Estilos del título
    doc.setFontSize(22);
    doc.setTextColor(40, 40, 40);
    doc.text('Factura', pageWidth / 2, 10, { align: 'center' });
    
    // Detalles del comprador
    doc.setFontSize(12);
    doc.setTextColor(0, 0, 0);
    doc.text(`Nombre: ${nombre}`, 10, 30);
    doc.text(`Dirección: ${direccion}`, 10, 40);
    doc.text(`Correo: ${email}`, 10, 50);

    // Línea divisoria
    doc.setDrawColor(0, 0, 0);
    doc.line(10, 55, pageWidth - 10, 55);  // Línea horizontal

    // Título de la sección de artículos
    doc.setFontSize(14);
    doc.setFont('helvetica', 'bold');
    doc.text('Detalle de los artículos', 10, 65);

    // Volver a la fuente regular
    doc.setFont('helvetica', 'normal');
    doc.setFontSize(12);

    // Listado de artículos
    let yPos = 75;
    articulosCarrito.forEach((curso, index) => {
        doc.text(`${index + 1}. ${curso.titulo}`, 10, yPos); // Título del curso
        doc.text(`Cantidad: ${curso.cantidad}`, 120, yPos);  // Cantidad
        doc.text(`Precio: ${curso.precio}`, 180, yPos, { align: 'right' });  // Precio
        yPos += 10;
    });

    // Línea divisoria antes del total
    doc.line(10, yPos, pageWidth - 10, yPos);

    // Total
    const total = articulosCarrito.reduce((acc, curso) => {
        // Eliminamos los separadores de miles (puntos)
        const precio = parseFloat(curso.precio.replace(/[.$]/g, '').replace(',', '.'));
        return acc + (precio * curso.cantidad);
    }, 0);

    // Mostrar total en negrita
    doc.setFont('helvetica', 'bold');
    doc.setFontSize(14);
    doc.text(`Total: $${total.toLocaleString('es-ES')}`, 180, yPos + 10, { align: 'right' });

    return doc;
}
