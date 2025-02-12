@extends('Layout.main-layout')

@section('styles')
<style>
    .small-image {
        width: 70px;
        height: 70px;
    }
</style>
@endsection


@section('content')
<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-4">
      <div class="card author-box">
        <div class="card-body">
          <div class="author-box-center text-center">
            <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle small-image">
            <div class="clearfix"></div>
            <div class="author-box-name">
              <a href="#">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</a>
            </div>
            <div class="author-box-job">Web Developer</div>
          </div>
          <div class="text-center">
            <div class="author-box-description">
              <p>
                {{Auth::user()->bio}}
              </p>
            </div>
            <div class="mb-2 mt-3">
              <div class="text-small font-weight-bold">Follow Hasan On</div>
            </div>
            <a href="#" class="btn btn-social-icon mr-1 btn-facebook">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="btn btn-social-icon mr-1 btn-twitter">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="btn btn-social-icon mr-1 btn-github">
              <i class="fab fa-github"></i>
            </a>
            <a href="#" class="btn btn-social-icon mr-1 btn-instagram">
              <i class="fab fa-instagram"></i>
            </a>
            <div class="w-100 d-sm-none"></div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h4>Personal Details</h4>
        </div>
        <div class="card-body">
          <div class="py-4">
            <p class="clearfix">
              <span class="float-left">
                Birthday
              </span>
              <span class="float-right text-muted">
                {{Auth::user()->birthday}}
              </span>
            </p>
            <p class="clearfix">
              <span class="float-left">
                Phone
              </span>
              <span class="float-right text-muted">
                {{Auth::user()->phone}}
              </span>
            </p>
            <p class="clearfix">
              <span class="float-left">
                Mail
              </span>
              <span class="float-right text-muted">
                {{Auth::user()->email}}
              </span>
            </p>
            <p class="clearfix">
              <span class="float-left">
                Facebook
              </span>
              <span class="float-right text-muted">
                <a href="#">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</a>
              </span>
            </p>
            <p class="clearfix">
              <span class="float-left">
                Twitter
              </span>
              <span class="float-right text-muted">
                <a href="#">@_{{Auth::user()->firstname}}{{Auth::user()->lastname}}</a>
              </span>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-12 col-lg-8">
      <div class="card">
        <div class="padding-20">
          <ul class="nav nav-tabs" id="myTab2" role="tablist">
            <li class="nav-item" style="margin-left:50px; width:10%;">
              <a class="nav-link active" id="home-tab2"  data-toggle="tab" href="#about" role="tab"
                aria-selected="true">About</a>
            </li>
          </ul>
          <div class="tab-content tab-bordered" id="myTab3Content">
            <div class="tab-pane fade show active" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
              <form method="post" class="needs-validation">
                <div class="card-header">
                  <h4>Edit Profile</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6 col-12">
                      <label>First Name</label>
                      <input type="text" class="form-control" value="{{Auth::user()->firstname}}">
                      <div class="invalid-feedback">
                        Please fill in the first name
                      </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>Last Name</label>
                      <input type="text" class="form-control" value="{{Auth::user()->lastname}}">
                      <div class="invalid-feedback">
                        Please fill in the last name
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-7 col-12">
                      <label>Email</label>
                      <input type="email" class="form-control" value="{{Auth::user()->email}}">
                      <div class="invalid-feedback">
                        Please fill in the email
                      </div>
                    </div>
                    <div class="form-group col-md-5 col-12">
                      <label>Phone</label>
                      <input type="tel" class="form-control" value="{{Auth::user()->phone}}">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-12">
                      <label>Bio</label>
                      <textarea
                        class="form-control summernote-simple" value="{{Auth::user()->bio}}"></textarea>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection



@section('scripts')

@endsection

