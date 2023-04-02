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
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'full_name', name: 'full_name' },
            { data: 'year', name: 'year' },
            { data: 'make', name: 'make' },
            { data: 'model', name: 'model' },
            { data: 'estimator_name', name: 'estimator_name' },
            { data: 'insurance_company', name: 'insurance_company' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#status').on("change", function(){
        table.draw();
    });
});