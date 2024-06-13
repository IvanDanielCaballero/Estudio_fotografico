var $table = $('#fresh-table')


$(function () {
    $table.bootstrapTable({
        classes: 'table table-hover table-striped',
        toolbar: '.toolbar',
        search: true,
        showPaginationSwitch: true,
        showRefresh: true,
        showToggle: true,
        showColumns: false,
        pagination: true,
        striped: true,
        sortable: true,
        pageSize: 5,
        pageList: [8, 10],

        formatShowingRows: function (pageFrom, pageTo, totalRows) {
            return 'Mostrando ' + pageFrom + ' a ' + pageTo + ' de ' + totalRows + ' filas';
        },
        formatRecordsPerPage: function (pageNumber) {
            return ''
        }
    })
})