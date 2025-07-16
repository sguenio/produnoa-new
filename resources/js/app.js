// Importamos las librerías desde nuestra carpeta local 'vendor' en el orden correcto
import "./vendor/jquery.js";
import "./vendor/select2.min.js";
import "./vendor/dataTables.js";
import "./vendor/dataTables.tailwindcss.js";
import "./vendor/dataTables.rowGroup.min.js";

// Cuando el documento esté completamente cargado...
$(function () {
    // Inicializador global para cualquier <select> con la clase .select2-enable
    if ($(".select2-enable").length) {
        $(".select2-enable").select2({
            placeholder: "Seleccione una opción",
            allowClear: true,
        });
    }

    // Opciones por defecto para TODAS las DataTables de la aplicación
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
                targets: "no-sort",
                orderable: false,
            },
        ],
    };

    // Inicializador para CUALQUIER tabla con la clase .datatable
    $("table.datatable").each(function () {
        let options = { ...defaultDtOptions }; // Empezamos con las opciones por defecto
        const tableId = $(this).attr("id");

        // --- LÓGICA ESPECIALIZADA POR TABLA ---

        // Si la tabla es la de Lotes, añadimos la opción de agrupar filas
        if (tableId === "lotesDataTable") {
            options.rowGroup = {
                dataSrc: 3, // Agrupa por la columna 4 (índice 3), que es "Remito Asociado"
                startRender: function (rows, group) {
                    // Estilo para la fila del grupo
                    return $("<tr/>").append(
                        '<td colspan="7" class="p-2 font-bold text-slate-200 bg-gray-900/50"> Remito: ' +
                            group +
                            "</td>"
                    );
                },
            };
            options.order = [[3, "desc"]]; // Ordena inicialmente por la columna de Remito
            // Ocultamos la columna original de Remito porque ya se usa para agrupar
            options.columnDefs.push({ targets: 3, visible: false });
        }

        // Inicializamos la tabla con sus opciones finales
        const dataTableInstance = new DataTable(this, options);

        // Si la tabla es la de Productos, añadimos la lógica para los botones de filtro
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

        if (tableId === "historialAnalisisTable") {
            options.rowGroup = {
                dataSrc: 2, // Agrupamos por la columna 3 (índice 2), que es "Lote ID"
                startRender: function (rows, group) {
                    // Obtenemos los datos de la primera fila de este grupo
                    var rowData = rows.data()[0];
                    // Obtenemos el nombre del producto de la columna 4 (índice 3)
                    var productName = rowData[3];
                    // Creamos el título del grupo combinado
                    return $("<tr/>").append(
                        '<td colspan="8" class="p-2 font-bold text-slate-200 bg-gray-900/50">Lote: ' +
                            group +
                            " (" +
                            productName +
                            ")</td>"
                    );
                },
            };
            options.order = [[2, "desc"]]; // Ordena por la columna de agrupación
            options.columnDefs.push({ targets: 2, visible: false });
        }

        // Si la tabla es la de Lotes, usa la agrupación simple
        else if (tableId === "lotesDataTable") {
            options.rowGroup = {
                dataSrc: 3,
                startRender: function (rows, group) {
                    return $("<tr/>").append(
                        '<td colspan="7" class="p-2 font-bold text-slate-200 bg-gray-900/50">Remito: ' +
                            group +
                            "</td>"
                    );
                },
            };
            options.order = [[3, "desc"]];
            options.columnDefs.push({ targets: 3, visible: false });
        }
    });
});
