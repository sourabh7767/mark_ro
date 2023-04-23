$(document).on('click', '.delete-datatable-record', function(e){
    let url  = site_url + "/users/" + $(this).attr('data-id');
    let tableId = 'formsTable';
    deleteDataTableRecord(url, tableId);
});

$(document).ready(function() {
    console.log(site_url, '======site_url');
    var table = $('#formsTable').DataTable({
        ...defaultDatatableSettings,
        ajax: {
            url: site_url + "/forms/",
            data: function (d) {
                  d.status = $('#status').val(),
                  d.search = $('input[type="search"]').val()
              }
        },
        dom: 'Blfrtip',
              buttons: [
                   {
                       extend: 'csv',
                       text : 'Export to Csv'
                   },
                   {
                       extend: 'excel',
                       text : 'Export to Excel'
                   }
              ],
        columns: [
            { data: 'ro', name: 'ro' },//{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'full_name', name: 'full_name' },
            { data: 'year', name: 'year' },
            { data: 'make', name: 'make' },
            { data: 'model', name: 'model' },
            { data: 'exterior_color', name: 'exterior_color' },
            { data: 'estimator_name', name: 'estimator_name' },
            { data: 'insurance_company', name: 'insurance_company' },
            { data: 'due_date', name: 'due_date' },
            { data: 'target_date', name: 'target_date' },
            { data: 'is_wheel', name: 'is_wheel' },
            { data: 'wheel_date', name: 'wheel_date' },
            { data: 'is_alignment', name: 'is_alignment' },
            { data: 'alignment_date', name: 'alignment_date' },
            { data: 'is_decals', name: 'is_decals' },
            { data: 'decals_date', name: 'decals_date' },
            { data: 'is_glass', name: 'is_glass' },
            { data: 'glass_date', name: 'glass_date' },
            { data: 'is_adas', name: 'is_adas' },
            { data: 'adas_date', name: 'adas_date' },

            // { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        "responsive": true
    }).buttons().container().appendTo('.my_button_wrapper');

    $('#status').on("change", function(){
        table.draw();
    });
});