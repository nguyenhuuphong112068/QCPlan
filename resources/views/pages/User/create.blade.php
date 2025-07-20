<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   
    <form 
      action="{{route('pages.User.store')}}" 
      method="POST">
      @csrf

      <div class="modal-content">
        <div class="modal-header">
          <a href="{{ route ('pages.general.home') }}">
              <img src="{{ asset('img/iconstella.svg') }}" style="opacity: 0.8 ; max-width:45px;">
          </a>

          <h4 class="modal-title w-100 text-center" id="pModalLabel" style="color: #CDC717">
              {{'Tạo Mới User' }}
          </h4>

          <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
        

            {{-- USER NAME --}}
            <div class="form-group">
              <label for="userName">Tên Đăng Nhập</label>
              <input type="text" class="form-control" name="userName" 
                value="{{ old('userName') }}" placeholder="Mã Số Nhân Viên">
            </div>
            @error('userName')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            {{-- PW--}}
            <div class="form-group">
              <label for="passWord">Mật Khẩu</label>
              <input type="text" class="form-control" name="passWord"  
                value="{{ old('passWord') }}">
            </div>
            @error('passWord')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


           {{-- Full Name--}}
            <div class="form-group">
              <label for="fullName">Tên Người Dùng</label>
              <input type="text" class="form-control" name="fullName"  placeholder="Tên Đầy Đủ"
                value="{{ old('fullName') }}">
            </div>
            @error('fullName')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          <div class="row">
              <div class="col-md-6">

                 {{-- USER GROUP --}}
                <div class="form-group">
                    <label for="userGroup">Phân Quyền</label>
                    <select class="form-control" name="userGroup" id="userGroup">
                        <option value="">-- Chọn phân quyền --</option>

                        @foreach ($userGroups as $userGroup)
                            <option value="{{ $userGroup->id }}" 
                                {{ old('userGroup') == $userGroup->id ? 'selected' : '' }}>
                                {{ $userGroup->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('userGroup')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

              </div>

              <div class="col-md-6">
                  {{-- Deprtment--}}
                  <div class="form-group">
                      <label for="deparment">Phòng Ban</label>
                      <select class="form-control" name="belongGroup_id" id="	deparment">
                          <option value="">-- Chọn phòng ban --</option>

                          @foreach ($deparments as $department)
                              <option value="{{ $department->id }}" 
                                  {{ old('deparment') == $department->id ? 'selected' : '' }}>
                                  {{ $department->name }}
                              </option>
                          @endforeach
                      </select>

                      @error('deparment')
                          <div class="alert alert-danger mt-1">{{ $message }}</div>
                      @enderror
                  </div>
              </div>
          </div>
           
            {{-- Mail--}}
            <div class="form-group">
              <label for="mail"> {{'Mail (Nếu Có)'}}</label>
              <input type="text" class="form-control" name="mail" placeholder="Không Bắt Buốc"
                value="{{ old('mail') }}">
            </div>
            @error('mail')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary">
              Lưu
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

{{-- //Show modal nếu có lỗi validation --}}
@if ($errors->any())
<script>
    $(document).ready(function () {
        $('#Modal').modal('show');
    });
</script>
@endif
