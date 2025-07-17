// -----------------------------------------------------------------------------
// IMPORTACIONES DE LIBRERÍAS
// -----------------------------------------------------------------------------
// Importamos las librerías desde nuestra carpeta local 'vendor' en el orden correcto.
// Esta sintaxis simplemente ejecuta cada script, haciendo que jQuery ($) y
// DataTable estén disponibles globalmente para los scripts que los necesiten.

import "./vendor/jquery.js";
import "./vendor/select2.min.js";
import "./vendor/dataTables.js";
import "./vendor/dataTables.tailwindcss.js";
import "./vendor/dataTables.rowGroup.min.js";

// -----------------------------------------------------------------------------
// INICIALIZADOR PRINCIPAL
// -----------------------------------------------------------------------------
// Usamos jQuery para esperar a que el documento esté completamente cargado.
$(function () {
    // --- 1. Lógica Global (se ejecuta en todas las páginas) ---

    // Inicializador para cualquier <select> con la clase .select2-enable
    if ($(".select2-enable").length) {
        $(".select2-enable").select2({
            placeholder: "Seleccione una opción",
            allowClear: true,
        });
    }

    // --- 2. Lógica Específica para DataTables ---

    // Opciones por defecto que compartirán todas nuestras DataTables
    const defaultDtOptions = {
        layout: {
            topStart: "pageLength",
            topEnd: "search",
        },
        language: {
            url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json",
        },
        responsive: true,
        columnDefs: [
            {
                targets: "no-sort", // Desactiva el ordenamiento en columnas con esta clase
                orderable: false,
            },
        ],
    };

    // Buscamos todas las tablas con la clase ".datatable" y las inicializamos una por una
    $("table.datatable").each(function () {
        let options = { ...defaultDtOptions }; // Empezamos con una copia de las opciones por defecto
        const tableId = $(this).attr("id");

        // --- AÑADIMOS CONFIGURACIONES ESPECIALES BASADAS EN EL ID DE LA TABLA ---

        // Configuración para la tabla de Lotes (agrupación por remito)
        if (tableId === "lotesDataTable") {
            options.rowGroup = {
                dataSrc: 3, // Agrupa por la columna 4 (índice 3), que es "Remito Asociado"
                startRender: function (rows, group) {
                    return $("<tr/>").append(
                        '<td colspan="7" class="p-2 font-bold text-slate-200 bg-gray-900/50">Remito: ' +
                            group +
                            "</td>"
                    );
                },
            };
            options.order = [[3, "desc"]]; // Ordena por defecto por la columna de agrupación
            options.columnDefs.push({ targets: 3, visible: false }); // Oculta la columna original
        }

        // Configuración para la tabla de Historial de Análisis (agrupación por lote)
        else if (tableId === "historialAnalisisTable") {
            options.rowGroup = {
                dataSrc: 2,
                startRender: function (rows, group) {
                    var rowData = rows.data()[0];
                    var analisisId = rowData[0];
                    var loteId = rowData[2]; // Obtenemos el ID del lote
                    var productName = rowData[3];

                    // Creamos las URLs manualmente
                    var urlTimeline = `/analisis/${analisisId}`;
                    var urlReanalisis = `/lotes/${loteId}/reanalizar`; // Ruta para la acción de re-análisis

                    var title = `Lote: ${group} (${productName})`;

                    // Creamos ambos botones
                    var timelineButton = `<a href="${urlTimeline}" class="bg-sky-600/50 hover:bg-sky-700/50 text-sky-300 font-bold py-1 px-3 rounded-lg text-xs">Ver Timeline</a>`;
                    var reanalisisButton = `
                <form action="${urlReanalisis}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que quieres habilitar un nuevo análisis para este lote?');">
                    <input type="hidden" name="_token" value="${$(
                        'meta[name="csrf-token"]'
                    ).attr("content")}">
                    <button type="submit" class="bg-amber-600/50 hover:bg-amber-700/50 text-amber-300 font-bold py-1 px-3 rounded-lg text-xs">Re-Analizar</button>
                </form>
            `;

                    // Los ponemos en la celda de la derecha
                    return $(`<tr class="dtrg-group"></tr>`)
                        .append(
                            `<td colspan="3" class="p-2 font-bold text-slate-200">${title}</td>`
                        )
                        .append(
                            `<td colspan="3" class="p-2 text-right space-x-2">${timelineButton}${reanalisisButton}</td>`
                        );
                },
            };
            options.order = [[2, "desc"]];
            options.columnDefs.push({ targets: [2], visible: false });
        }

        // Finalmente, inicializamos la tabla con sus opciones finales
        const dataTableInstance = new DataTable(this, options);

        // --- AÑADIMOS EVENTOS ESPECIALES DESPUÉS DE LA INICIALIZACIÓN ---

        // Lógica de los botones de filtro solo para la tabla de Productos
        if (tableId === "productsDataTable") {
            $(".category-filter-btn").on("click", function () {
                const categoryFilter = $(this).data("category") || "";
                const searchTerm = categoryFilter
                    ? "^\\s*" + categoryFilter + "\\s*$"
                    : "";
                dataTableInstance
                    .column(3)
                    .search(searchTerm, true, false)
                    .draw();

                $(".category-filter-btn").removeClass(
                    "ring-2 ring-red-500 scale-105"
                );
                $(this).addClass("ring-2 ring-red-500 scale-105");
            });
            $(".category-filter-btn:first").addClass(
                "ring-2 ring-red-500 scale-105"
            );
        }
    });
});
