@extends('admin.master')
@section('content')
<section class="content">
<style>
        .contentt {
            margin-top: 0px;
            width: 100%;
            height: calc(100vh - 60px);
            background-image: url('https://img4.thuthuatphanmem.vn/uploads/2019/11/07/background-ngan-ha-cho-powerpoint_113523222.jpg?fbclid=IwAR24qvpKnJ8HYtdvffG_pFA0jF-FYKwyPAMJEKHuLXLdQ1FRgtUni0P0A9A');
            background-repeat: no-repeat;
        }
        .form {
            position: relative;
            height: 100%;
        }
        .group-button {
            position: absolute;
            width: 200px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
           
        }
        .button {
            position:relative;
            width: 100%;
            height: 40px;
            border-radius: 10px;
            margin: 15px 0;
            padding-top: 10px;
            background-color: #20BDF7;
            text-align: center;
            box-shadow: none;
            cursor: pointer;
            border: none;
        }
    </style>
    <div class= "row">
    <div class="contentt">
        <form action="#" class="form">
            <div class="group-button">
                <div class = "button">
                    <a style = "color: white; display: inline-block" href= "admin/Post/Posts">Quản lý bài viết</a>
                </div>
                <div class = "button">
                    <a style = "color: white" href= "admin/Course/Courses">Quản lý khóa học</a>
                </div>
            </div>
        </form>
    </div>
    </div>

</section>
@endsection
