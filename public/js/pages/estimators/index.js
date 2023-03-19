$(document).on('click', '.delete-datatable-record', function(e){
    let url  = site_url + "/estimators/" + $(this).attr('data-id');
    let tableId = 'estimatorsTable';
    deleteDataTableRecord(url, tableId);
});

$(document).ready(function() {
    console.log(site_url, '======site_url');
    $('#estimatorsTable').DataTable({
        ...defaultDatatableSettings,
        ajax: site_url + "/estimators/",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at'},
            { data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});