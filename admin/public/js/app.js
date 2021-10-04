$(document).ready(function() {
    $('.nav-link.active .sub-menu').slideDown();
    // $("p").slideUp();

    $('#sidebar-menu .arrow').click(function() {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });

    $("input[name='checkall']").click(function() {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });

    $(".addCat").click(function(){
        var categoryName = $('#name').val();
        var parentId = $('#parentId option:selected').val();
        var addCat = "asdasd";
        $.ajax({
            url: "http://localhost/market/admin/category/product/controller/indexController.php",
            type: "post",
            data: {
                categoryName: categoryName,
                parentId:parentId,
                addCat : addCat
            },
            dataType: "json",
            success: function(result) {
                if (result['success'] == true) {
                    alert(result['message']);

                } else {
                    alert(result['message']);
                }
            },
        });
    })
    
});