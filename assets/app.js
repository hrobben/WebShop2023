/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';
const $ = require('jquery');
global.$ = global.jQuery = $;
import 'popper.js';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/css/bootstrap.min.css';

import 'datatables.net-bs5';
import 'datatables.net-buttons-bs5';
import 'datatables.net-responsive-bs5';
import 'datatables.net-select-bs5';
import 'datatables.net-fixedheader-bs5';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-searchpanes-bs5';
import 'datatables.net-scroller-bs5';


$(document).ready(function () {
    // Put your jquery code here.
    const table = $('#lijst').DataTable({
        buttons: {
            buttons: ['copy', 'csv', 'excel', 'pdf']
        },
        order: [0, 'desc'],
        stateSave: true,
        responsive: true,
        language: {
            sEmptyTable: "Geen data gevonden in tabel",
            sInfo: "_START_ tot _END_ van _TOTAL_ Rijen",
            sInfoEmpty: "0 tot 0 van 0 Regels",
            sInfoFiltered: "(gefiltert van _MAX_ Rijen)",
            sInfoPostFix: "",
            sInfoThousands: ".",
            sLengthMenu: "Bekijk _MENU_ Rijen",
            sLoadingRecords: "Word geladen...",
            sProcessing: "Even wachten aub...",
            sSearch: "Zoeken",
            sZeroRecords: "Geen data voorhanden.",
            oPaginate: {
                sFirst: "Eerste",
                sPrevious: "Terug",
                sNext: "Volgende",
                sLast: "Laatste",
            },
            oAria: {
                sSortAscending:
                    ": aktiveren, om Kolom oplopend te sorteren",
                sSortDescending:
                    ": aktiveren, om Kolom aflopend te sorteren",
            },
        },
    });

    /*
        table.buttons().container()
            .appendTo($('.col-lg-6:eq(0)', table.table().container()));
        new $.fn.DataTable.FixedHeader(table);
    */
});