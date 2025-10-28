// --- INICIO DE main.js CORREGIDO ---

// Función para mostrar animaciones de scroll
function activarClasesVisibles(selector, claseActiva) {
    const elementos = document.querySelectorAll(selector);
    elementos.forEach((elemento) => {
        const rect = elemento.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            elemento.classList.add(claseActiva);
        }
    });
}

function manejarScroll() {
    activarClasesVisibles('.fade-in', 'active');
    activarClasesVisibles('.fade-in-scale', 'active');
}

// Función para mostrar el mensaje "Añadido al carrito"
function mostrarMensajeCarrito(mensaje) {
    const mensajeCarrito = document.getElementById('mensaje-carrito');
    if (mensajeCarrito) {
        mensajeCarrito.textContent = mensaje;
        mensajeCarrito.classList.add('mostrar');
        setTimeout(() => {
            mensajeCarrito.classList.remove('mostrar');
        }, 2000);
    }
}

// Función para guardar el carrito en localStorage
function guardarCarritoEnLocalStorage(carrito) {
    localStorage.setItem('carrito', JSON.stringify(carrito));
}

// Función para obtener el carrito de localStorage
function obtenerCarritoDeLocalStorage() {
    return JSON.parse(localStorage.getItem('carrito')) || [];
}

// Función para AÑADIR un producto al carrito
function anadirAlCarrito(nombre, precio) {
    // 1. Obtenemos el carrito ACTUAL de localStorage
    const carrito = obtenerCarritoDeLocalStorage();

    // 2. Buscamos si el producto ya existe
    const index = carrito.findIndex(item => item.nombre === nombre);

    if (index !== -1) {
        // Si existe, solo aumentamos la cantidad
        carrito[index].cantidad += 1;
    } else {
        // Si no existe, lo añadimos
        carrito.push({ nombre, precio, cantidad: 1 });
    }

    // 3. Guardamos el carrito MODIFICADO de vuelta en localStorage
    guardarCarritoEnLocalStorage(carrito);

    // 4. Mostramos el mensaje
    mostrarMensajeCarrito(`${nombre} añadido al carrito.`);
}

// Función para ELIMINAR un producto del carrito
function eliminarDelCarrito(index) {
    const carrito = obtenerCarritoDeLocalStorage();
    carrito.splice(index, 1); // Elimina el producto en esa posición
    guardarCarritoEnLocalStorage(carrito);
    cargarPaginaCarrito(); // Recargamos la tabla del carrito
}

// Función para dibujar la tabla en la PÁGINA DEL CARRITO
function cargarPaginaCarrito() {
    const carritoItems = document.getElementById("carrito-items");
    const totalCarrito = document.getElementById("total-carrito");

    // Si no estamos en la página del carrito, no hacemos nada
    if (!carritoItems || !totalCarrito) return;

    const carrito = obtenerCarritoDeLocalStorage();
    carritoItems.innerHTML = "";
    let total = 0;

    carrito.forEach((producto, index) => {
        const subtotal = producto.precio * producto.cantidad;
        total += subtotal;

        carritoItems.innerHTML += `
            <tr>
                <td>${producto.nombre}</td>
                <td>${producto.cantidad}</td>
                <td>$${producto.precio.toFixed(2)}</td>
                <td>$${subtotal.toFixed(2)}</td>
                <td><button class="btn-eliminar" data-index="${index}">Eliminar</button></td>
            </tr>
        `;
    });

    totalCarrito.textContent = `Total: $${total.toFixed(2)}`;
}

// --- EVENT LISTENERS (Controladores de eventos) ---

// Usamos UN solo DOMContentLoaded para organizar todo
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Manejador para los botones "Añadir al carrito"
    const botonesCarrito = document.querySelectorAll('.btn-carrito');
    botonesCarrito.forEach(boton => {
        boton.addEventListener('click', () => {
            const nombre = boton.dataset.nombre;
            const precio = parseFloat(boton.dataset.precio);
            anadirAlCarrito(nombre, precio);
        });
    });

    // 2. Cargar la tabla del carrito (si estamos en carrito.php)
    cargarPaginaCarrito();

    // 3. Manejador para el formulario "Finalizar Compra"
    const formCarrito = document.getElementById('form-carrito');
    if (formCarrito) {
        formCarrito.addEventListener('submit', (evento) => {
            const carritoString = localStorage.getItem('carrito');
            
            if (!carritoString || JSON.parse(carritoString).length === 0) {
                evento.preventDefault(); 
                alert("Tu carrito está vacío. Añade productos antes de finalizar la compra.");
                return;
            }

            // Creamos y añadimos el campo oculto
            const inputOculto = document.createElement('input');
            inputOculto.type = 'hidden';
            inputOculto.name = 'cart_data_json'; 
            inputOculto.value = carritoString;
            formCarrito.appendChild(inputOculto);
            // El formulario se envía...
        });
    }

    // 4. Inicializar las animaciones de scroll
    manejarScroll();
});

// Event listener para las animaciones de SCROLL
window.addEventListener('scroll', manejarScroll);

// Event listener para los botones "Eliminar" (usa delegación de eventos)
document.addEventListener("click", (e) => {
    if (e.target.classList.contains("btn-eliminar")) {
        const index = e.target.dataset.index;
        eliminarDelCarrito(index);
    }
});

// --- FIN DE main.js CORREGIDO ---