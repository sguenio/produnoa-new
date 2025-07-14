// Este archivo contiene la lógica exclusiva de la página de listado de productos

// Importamos las dependencias que este módulo necesita
import $ from "jquery";
import DataTable from "datatables.net-dt";

// Creamos y exportamos una función que se encargará de inicializar todo
export function initProductosPage() {
    console.log("Módulo de Productos cargado e inicializado.");

    const productsTable = new DataTable("#productsDataTable", {
        layout: {
            topStart: "pageLength",
            topEnd: "search",
        },
        language: {
            url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json",
        },
        columnDefs: [
            {
                targets: "no-sort",
                orderable: false,
            },
        ],
    });

    // Lógica de los botones de filtro de categoría
    $(".category-filter-btn").on("click", function () {
        const categoryFilter = $(this).data("category") || ""; // Usa '' para el botón "Todos"

        // El filtro busca una coincidencia exacta en la columna 4 (índice 3)
        productsTable
            .column(3)
            .search(
                categoryFilter ? "^" + categoryFilter + "$" : "",
                true,
                false
            )
            .draw();

        // Estilo para el botón activo
        $(".category-filter-btn").removeClass("ring-2 ring-red-500 scale-105");
        $(this).addClass("ring-2 ring-red-500 scale-105");
    });

    // Activar el filtro "Todos" por defecto
    $(".category-filter-btn:first").addClass("ring-2 ring-red-500 scale-105");
}
