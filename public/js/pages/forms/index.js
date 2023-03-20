$(document).on('click', '.delete-datatable-record', function(e){
    let url  = site_url + "/users/" + $(this).attr('data-id');
    let tableId = 'formsTable';
    deleteDataTableRecord(url, tableId);
});

$(document).ready(function() {
    console.log(site_url, '======site_url');
    $('#formsTable').DataTable({
        ...defaultDatatableSettings,
        ajax: site_url + "/forms/",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'full_name', name: 'full_name' },
            { data: 'year', name: 'year' },
            { data: 'make', name: 'make' },
            { data: 'estimator_name', name: 'estimator_name' },
            { data: 'insurance_company', name: 'insurance_company' },
            { data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});