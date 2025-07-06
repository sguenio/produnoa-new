// resources/js/app.js

// 1. Importamos las librerías desde los archivos locales que descargamos.
//    Estos scripts se ejecutan y preparan jQuery ($) y DataTable.
import "./vendor/jquery.js";
import "./vendor/dataTables.js";
import "./vendor/dataTables.tailwindcss.js";

// 2. Usamos jQuery para esperar a que el documento esté completamente cargado.
$(function () {
    // 3. Buscamos CUALQUIER tabla que tenga la clase "datatable" y la inicializamos.
    //    Esto hace que el código sea reutilizable para todas tus tablas en el futuro.
    $("table.datatable").each(function () {
        new DataTable(this, {
            // Configuración general para todas tus DataTables
            layout: {
                topStart: "pageLength",
                topEnd: "search",
            },
            language: {
                url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json",
            },
            // Desactiva la capacidad de ordenar para cualquier columna que tenga la clase "no-sort"
            columnDefs: [
                {
                    targets: "no-sort",
                    orderable: false,
                },
            ],
        });
    });
});
