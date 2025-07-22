
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Modal -->
<div class="modal fade " id="productNameModal" tabindex="-1" role="dialog" aria-labelledby="productNameModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
   
    <form 
      action="{{route('pages.materData.productName.store')}}" 
      method="POST">
      @csrf

      <div class="modal-content">
        <div class="modal-header">
          <a href="{{ route ('pages.general.home') }}">
              <img src="{{ asset('img/iconstella.svg') }}" style="opacity: 0.8 ; max-width:45px;">
          </a>

          <h4 class="modal-title w-100 text-center" id="productNameModalLabel" style="color: #CDC717">
              {{'Tạo Mới Qui Trình Kiểm Nghiệm' }}
          </h4>

          <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          {{-- CODE --}}
          <div class="form-group">
            <label for="code">Số Qui Trình</label>
            <input type="text" class="form-control" name="code" 
              value="{{ old('code') }}">
          </div>
          @error('code', 'createErrors')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror

          {{-- NAME --}}
          <div class="form-group">
            <label for="name">Tên Qui Trình</label>
            <input type="text" class="form-control" name="name" 
              value="{{ old('name') }}">
          </div>
          @error('name', 'createErrors')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
             
            {{-- USER GROUP --}}
            <div class="form-group">
                <label for="testing">Chỉ Tiêu</label>
                <select class="form-control" name="testing" id="testing" multiple>
                    @foreach ($testings as $testing)
                        <option value="{{ $testing->name }}" 
                            {{ old('userGroup') == $testing->name ? 'selected' : '' }}>
                            {{ $testing->name }}
                        </option>
                    @endforeach
                </select>
                @error('testing','createErrors')
                      <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            

      


          



 
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary">
            {{ isset($product) ? 'Cập Nhật' : 'Lưu' }}
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
@if ($errors->createErrors->any())
<script>
    $(document).ready(function () {
        $('#productNameModal').modal('show');
    });
</script>
@endif
