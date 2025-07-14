// resources/js/pages/datatables.js

// 1. Importamos las librerías desde nuestra carpeta local 'vendor'.
import "../vendor/jquery.js";
import DataTable from "../vendor/dataTables.js";
import "../vendor/dataTables.tailwindcss.js";

// 2. Creamos y exportamos la función de inicialización.
export function initDataTables() {
    console.log("Módulo DataTables cargado e inicializado.");

    $("table.datatable").each(function () {
        const dataTableInstance = new DataTable(this, {
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

        // Lógica de filtrado (SOLO si estamos en la tabla de productos)
        if ($(this).attr("id") === "productsDataTable") {
            $(".category-filter-btn").on("click", function () {
                const categoryFilter = $(this).data("category") || "";

                // --- INICIO: LA CORRECCIÓN DEFINITIVA ---

                // Creamos una búsqueda con "expresión regular" que ignora los espacios en blanco
                // al principio (^\s*) y al final (\s*$) de la celda.
                const searchTerm = categoryFilter
                    ? "^\\s*" + categoryFilter + "\\s*$"
                    : "";

                // El 'true' activa la búsqueda con expresión regular.
                dataTableInstance
                    .column(3)
                    .search(searchTerm, true, false)
                    .draw();

                // --- FIN: LA CORRECCIÓN DEFINITIVA ---

                // Estilo para el botón activo
                $(".category-filter-btn").removeClass(
                    "ring-2 ring-red-500 scale-105"
                );
                $(this).addClass("ring-2 ring-red-500 scale-105");
            });

            // Activar el filtro "Todos" por defecto al cargar la página
            $(".category-filter-btn:first").addClass(
                "ring-2 ring-red-500 scale-105"
            );
        }
    });
}
