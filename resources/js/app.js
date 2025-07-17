// resources/js/app.js

// 1. IMPORTACIONES DE LIBRERÍAS
import "./vendor/jquery.js";
import "./vendor/select2.min.js";
import "./vendor/dataTables.js";
import "./vendor/dataTables.tailwindcss.js";
import "./vendor/dataTables.rowGroup.min.js";
import "./vendor/dataTables.responsive.min.js";

// 2. INICIALIZADOR PRINCIPAL
$(function () {
    // Inicializador global para Select2
    if ($(".select2-enable").length) {
        $(".select2-enable").select2({
            placeholder: "Seleccione una opción",
            allowClear: true,
        });
    }

    // Opciones por defecto para TODAS las DataTables
    const defaultDtOptions = {
        layout: {
            topStart: "pageLength",
            topEnd: "search",
        },
        language: {
            url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json",
        },
        responsive: {
            details: {
                type: "column",
                target: "tr",
                renderer: function (api, rowIdx, columns) {
                    var data = $.map(columns, function (col, i) {
                        return col.hidden
                            ? '<li class="flex items-center gap-2 p-2" data-dt-row="' +
                                  col.rowIndex +
                                  '" data-dt-column="' +
                                  col.columnIndex +
                                  '">' +
                                  '<span class="font-bold">' +
                                  col.title +
                                  ":" +
                                  "</span> " +
                                  "<span>" +
                                  col.data +
                                  "</span>" +
                                  "</li>"
                            : "";
                    }).join("");

                    return data
                        ? $(
                              '<ul class="space-y-2 p-3 bg-gray-900/50"/>'
                          ).append(data)
                        : false;
                },
            },
        },
        columnDefs: [
            {
                targets: "no-sort",
                orderable: false,
                className: "dt-center",
            },
        ],
    };

    // Inicializador para CUALQUIER tabla con la clase .datatable
    $("table.datatable").each(function () {
        let options = { ...defaultDtOptions };
        const tableId = $(this).attr("id");

        // --- LÓGICA ESPECIALIZADA POR TABLA ---

        // CORRECCIÓN: Estilo mejorado para la fila de agrupación de Lotes
        if (tableId === "lotesDataTable") {
            options.rowGroup = {
                dataSrc: 3,
                startRender: (rows, group) => {
                    const title = `<p class="text-base font-bold text-slate-100">Remito: ${group}</p>`;
                    return $(
                        `<tr class="dtrg-group"><td colspan="7" class="p-3">${title}</td></tr>`
                    );
                },
            };
            options.order = [[3, "desc"]];
            options.columnDefs.push({ targets: 3, visible: false });
        } else if (tableId === "historialAnalisisTable") {
            options.rowGroup = {
                dataSrc: 2,
                startRender: function (rows, group) {
                    var rowData = rows.data()[0];
                    var analisisId = rowData[0];
                    var loteId = rowData[2];
                    var productName = rowData[3];
                    var urlTimeline = `/analisis/${analisisId}`;
                    var urlReanalisis = `/lotes/${loteId}/reanalizar`;

                    var title = `<p class="text-base font-bold text-slate-100">Lote: ${group} (${productName})</p>`;

                    var buttons = `
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-2 shrink-0">
                            <a href="${urlTimeline}" class="bg-sky-600 hover:bg-sky-700 text-white font-semibold py-2 px-3 rounded-lg inline-flex items-center justify-center text-xs transition-colors">Ver Timeline</a>
                            <form action="${urlReanalisis}" method="POST" class="w-full sm:w-auto" onsubmit="return confirm('¿Habilitar un nuevo análisis para este lote?');">
                                <input type="hidden" name="_token" value="${$(
                                    'meta[name="csrf-token"]'
                                ).attr("content")}">
                                <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-3 rounded-lg text-xs transition-colors">Re-Analizar</button>
                            </form>
                        </div>`;

                    var responsiveWrapper = `<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">${title}${buttons}</div>`;

                    return $('<tr class="dtrg-group"></tr>').append(
                        `<td colspan="6" class="p-3">${responsiveWrapper}</td>`
                    );
                },
            };
            options.order = [[2, "desc"]];
            options.columnDefs.push({ targets: [2, 7], visible: false });
        } else if (tableId === "analisisIndexTable") {
            options.columnDefs.push({ responsivePriority: 1, targets: 0 });
            options.columnDefs.push({ responsivePriority: 2, targets: -1 });
        } else if (tableId === "disposicionesHistorialTable") {
            options.columnDefs.push({ responsivePriority: 1, targets: 2 });
            options.columnDefs.push({ responsivePriority: 2, targets: 3 });
        }

        const dataTableInstance = new DataTable(this, options);

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
