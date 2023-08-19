$(document).ready(function(){

    fetch_user();
    // Đổ data ra bảng
    function fetch_user()
    {  
        $('#myTableUser').DataTable({
            'processing':true,
            'serverSide':true,
            'ajax':
            {
                url : '/admin/user-admin/fetch',
                // data : function (d){
                //     d.key = $('#keySearch').val();
                //     d.pricefrom = $('#price_from').val();
                //     d.priceto = $('#price_to').val();
                //     d.state = $('#state').val();
                // }
            },
            'columns':[
                {'data' : 'id','visible':false},
                {'data' : 'name'},
                {'data' : 'email'},
                {'data' : 'group_role'},
                {'data' : 'is_active'},
                {'data' : 'action', 'orderable' : false, 'searchable' : false}
            ],
            'order' : [[0, 'desc']],
            'searching':false,
        });
        // $('#formSearch').on('keyup change' ,function(e) {
        //     $('#myTable').DataTable().draw();
        //     e.preventDefault();
        // });
    }
});