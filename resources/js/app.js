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
    });
});
