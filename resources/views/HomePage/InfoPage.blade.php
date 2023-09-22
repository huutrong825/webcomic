@extends('HomePage/layout_home_page')
@section('contents')

    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="tab">
                <a class="tablinks active">Quy tắc</a>
                <a class="tablinks">Thông tin page</a>
            </div>
            
            <div id="Quy tắc" class="tabcontent">
                <h3></h3>
                <p></p>
            </div>
            
            <div id="Thông tin page" class="tabcontent">
                <h3></h3>
                <p></p> 
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
<style>
    
/* Định dạng phần tab */
div.tab {
    float: left;
    width: 20%;
}
 
/* định dạng các thẻ a dại diện cho từng tab */
div.tab a {
    display: block;
    color: black;
    padding: 22px 16px;
    width: 100%;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    font-size: 17px;
}
 
/* Đổi màu khi tab được hover */
div.tab a:hover {
    background-color: #ddd;
}
 
/* Đổi màu khi tab được active */
div.tab a.active {
    background-color: #ccc;
}
 
/* Định dạng cho phần nội dung */
.tabcontent {
    float: left;
    padding: 0px 12px;
    width: 70%;
    border-left: none;
    height: 300px;
}
</style>
<script type="text/javascript">
    //lấy các thẻ a đại diện cho các tab
    var buttons = document.getElementsByClassName('tablinks');
    //lấy các phần nội dung
    var contents = document.getElementsByClassName('tabcontent');
    //Định nghĩa hàm hiển thị nội dung theo id
    function showContent(id){
        for (var i = 0; i < contents.length; i++) {
            contents[i].style.display = 'none';
        }
        var content = document.getElementById(id);
        content.style.display = 'block';
    }
    //lặp qua các tab và gán sự kiện click
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function(){
            //lấy văn bản trong thẻ a đại diện cho id của nội dung
            var id = this.textContent;
            //bỏ active tất cả các tab
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].classList.remove("active");
            }
            //active tab được click
            this.className += " active";
            //show nội dung theo id lấy được
            showContent(id);
        });
    }
    //mặc định hiển thị tab PHP
    showContent('Quy tắc');
</script>
@endsection