// new DataTable('#datatables');
$(document).ready(function (){
    $('datatables').DataTable({
        pageLength: 10,
        filter: true,
        deferRender: true,
        scrollY: 200,
        scrollCollapse: true,
        scroller: true
    });
});
