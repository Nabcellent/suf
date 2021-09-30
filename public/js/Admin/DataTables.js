const dt = $.extend(true, $.fn.dataTable.defaults, {
    scrollY: '50vh',
    scrollCollapse: true,
    responsive: true,
    select: {
        style: 'os',
        selector: 'td:first-child'
    },
})


$(document).on('select.dt deselect.dt', 'table.crud_table', function() {
    const itemsSelected = $(this).DataTable().rows({ selected:true }).count(),
        actions = $(this).closest('.table-responsive').prev();

    itemsSelected ? actions.show(300) : actions.hide(300)
})

$(document).on('change', '.select-all', function() {
    const dataTableRows = $($(this).closest('.table-responsive').prev().find($('button')).data('table')).DataTable().rows()

    if($(this).prop('checked')) {
        dataTableRows.select();
    } else {
        dataTableRows.deselect();
    }
})
