@extends('admin.admin_master')
@section('title','E-Commerce')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Edit Profile Page</h4>
                        
                    <form method="POST" action="{{ route('store.profile') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="name" value="{{$editData->name}}" type="search" placeholder="" id="example-text-input">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="email" value="{{$editData->email}}" type="search" placeholder="" id="example-text-input">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="image" name="profile_image"  type="file" placeholder="" id="example-text-input">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image</label>
                            <div class="col-sm-10">
                                <img class="rounded avatar-lg" id="showImage" src="{{(!empty($editData->profile_image))?  url('upload/admin_image/'.$editData->profile_image):url('upload/no_image.php') }}" alt="Card image cap">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Update Profile"/>
                    </form>
                        <!-- end row -->
                    </div>
                </div>
            </div> 
        </div>
    </div>
    
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#image').change(function (e) { 
        e.preventDefault();
        var reader = new FileReader();
        reader.onload = function(e){
            $('#showImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
})
</script>
@endsection