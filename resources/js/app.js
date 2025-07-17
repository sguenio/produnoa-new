// =============================================================================
// APP.JS - ARCHIVO ÚNICO Y PRINCIPAL
// =============================================================================

// --- 1. IMPORTACIONES DE LIBRERÍAS ---
import "./vendor/jquery.js";
import "./vendor/select2.min.js";
import "./vendor/dataTables.js";
import "./vendor/dataTables.tailwindcss.js";
import "./vendor/dataTables.rowGroup.min.js";
import "./vendor/dataTables.responsive.min.js";
import Chart from "chart.js/auto";

// --- 2. INICIALIZADOR PRINCIPAL ---
$(function () {
    // --- Lógica Global para Select2 ---
    if ($(".select2-enable").length) {
        $(".select2-enable").select2({
            placeholder: "Seleccione una opción",
            allowClear: true,
        });
    }

    // --- Lógica para DataTables ---
    const defaultDtOptions = {
        layout: { topStart: "pageLength", topEnd: "search" },
        language: {
            url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json",
        },
        responsive: {
            details: {
                type: "column",
                target: "tr",
                renderer: function (api, rowIdx, columns) {
                    var data = $.map(columns, (col) =>
                        col.hidden
                            ? `<li class="flex items-center gap-2 p-2"><span class="font-bold text-slate-300">${col.title}:</span> <span>${col.data}</span></li>`
                            : ""
                    ).join("");
                    return data
                        ? $(
                              '<ul class="space-y-2 p-3 bg-gray-900/50"/>'
                          ).append(data)
                        : false;
                },
            },
        },
        columnDefs: [
            { targets: "no-sort", orderable: false, className: "dt-center" },
        ],
    };

    $("table.datatable").each(function () {
        let options = { ...defaultDtOptions };
        const tableId = $(this).attr("id");

        // CORRECCIÓN: Se ajusta la función startRender para que sea más robusta
        if (tableId === "lotesDataTable") {
            options.rowGroup = {
                dataSrc: 3,
                startRender: (rows, group) => {
                    const title = `Remito: ${group}`;
                    // Usamos el constructor de jQuery y un estilo consistente
                    return $(
                        `<tr class="dtrg-group"><td colspan="7" class="p-3 font-bold text-base text-slate-100 bg-gray-900">${title}</td></tr>`
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
                    var title = `<p class="text-base font-bold text-slate-100 truncate">Lote: ${group} (${productName})</p>`;
                    var buttons = `<div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-2 shrink-0"><a href="${urlTimeline}" class="bg-sky-600 hover:bg-sky-700 text-white font-semibold py-2 px-3 rounded-lg inline-flex items-center justify-center text-xs transition-colors">Ver Timeline</a><form action="${urlReanalisis}" method="POST" class="w-full sm:w-auto" onsubmit="return confirm('¿Habilitar un nuevo análisis para este lote?');"><input type="hidden" name="_token" value="${$(
                        'meta[name="csrf-token"]'
                    ).attr(
                        "content"
                    )}"><button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-3 rounded-lg text-xs transition-colors">Re-Analizar</button></form></div>`;
                    var responsiveWrapper = `<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">${title}${buttons}</div>`;
                    return $(
                        `<tr class="dtrg-group"><td colspan="6" class="p-3">${responsiveWrapper}</td></tr>`
                    );
                },
            };
            options.order = [[2, "desc"]];
            options.columnDefs.push({ targets: [2, 7], visible: false });
        }

        const dataTableInstance = new DataTable(this, options);

        if (tableId === "productsDataTable") {
            const filterButtons = $(".category-filter-btn");
            filterButtons.first().addClass("ring-2 ring-red-500 scale-105");
            filterButtons.on("click", function () {
                const clickedButton = $(this);
                const categoryFilter = clickedButton.data("category") || "";
                const searchTerm = categoryFilter
                    ? "^\\s*" + categoryFilter + "\\s*$"
                    : "";
                dataTableInstance
                    .column(3)
                    .search(searchTerm, true, false)
                    .draw();
                filterButtons.removeClass("ring-2 ring-red-500 scale-105");
                clickedButton.addClass("ring-2 ring-red-500 scale-105");
            });
        }

        if (tableId === "lotesDataTable") {
            const filterButtons = $(".lote-status-filter-btn");
            filterButtons.first().addClass("ring-2 ring-red-500 scale-105");
            filterButtons.on("click", function () {
                const clickedButton = $(this);
                const statusFilter = clickedButton.data("status") || "";
                const searchTerm = statusFilter
                    ? "^\\s*" + statusFilter + "\\s*$"
                    : "";
                dataTableInstance
                    .column(5)
                    .search(searchTerm, true, false)
                    .draw();
                filterButtons.removeClass("ring-2 ring-red-500 scale-105");
                clickedButton.addClass("ring-2 ring-red-500 scale-105");
            });
        }
    });

    // --- 3. Lógica para el Gráfico del Dashboard ---
    const chartCanvas = document.getElementById("lotesPorEstadoChart");
    if (chartCanvas && chartCanvas.dataset.chartData) {
        try {
            const chartData = JSON.parse(chartCanvas.dataset.chartData);
            const colorMap = {
                "En Cuarentena": "rgba(251, 191, 36, 0.8)",
                "Pendiente de Aprobación": "rgba(56, 189, 248, 0.8)",
                "Listo para Producción": "rgba(74, 222, 128, 0.8)",
                Rechazado: "rgba(248, 113, 113, 0.8)",
                Agotado: "rgba(107, 114, 128, 0.8)",
            };
            const backgroundColors = chartData.labels.map(
                (label) => colorMap[label] || "#9ca3af"
            );
            new Chart(chartCanvas, {
                type: "doughnut",
                data: {
                    labels: chartData.labels,
                    datasets: [
                        {
                            label: "Lotes",
                            data: chartData.data,
                            backgroundColor: backgroundColors,
                            borderColor: "#1f2937",
                            borderWidth: 4,
                            hoverOffset: 8,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: "right",
                            labels: {
                                color: "#d1d5db",
                                boxWidth: 20,
                                padding: 20,
                                font: { size: 14 },
                            },
                        },
                    },
                },
            });
        } catch (e) {
            console.error("Error al inicializar el gráfico:", e);
        }
    }
});
