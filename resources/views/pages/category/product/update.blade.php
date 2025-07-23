

<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="productNameModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('pages.category.product.update') }}" method="POST">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <a href="{{ route('pages.general.home') }}">
                        <img src="{{ asset('img/iconstella.svg') }}" style="opacity: 0.8; max-width:45px;">
                    </a>

                    <h4 class="modal-title w-100 text-center" id="productNameModalLabel" style="color: #CDC717">
                        Cập Nhật Danh Mục Sản Phẩm Kiểm Nghiệm
                    </h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    {{-- ID --}}
                    <input type="hidden" class="form-control" name="id" value="{{ old('id') }}">

                    {{-- CODE --}}
                    <div class="form-group">
                        <label for="code">Mã sản phẩm</label>
                        <input type="text" class="form-control" name="code" value="{{ old('code') }}" id = "update_code" disabled>
                        @error('code', 'createErrors')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NAME --}}
                    <div class="form-group">
                        <label for="update_name">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" id = "update_name" disabled>
            
                        @error('productName', 'createErrors')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TESTING --}}
                    <div class="form-group">
                        <label for="update_testing">Chỉ Tiêu</label>
                        <input type="text" class="form-control" name="testing" value="{{ old('testing') }}" id = "update_testing" disabled>
              
                        @error('testing', 'createErrors')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                        @error('testing_code', 'createErrors')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror

                    </div>

                    {{-- testing_code --}}
              
                    <input type="hidden" class="form-control" name="testing_code" id="update_testing_code"
                            value="{{ old('testing_code') }}">

                    

                    <div class="row">
                        <div class="col-md-6">
                            {{-- Amout --}}
                            <div class="form-group">
                                <label for="sample_Amout">Số Lượng Mẫu</label>
                                <input type="number" step="0.01" class="form-control" name="sample_Amout"
                                    value="{{ old('sample_Amout') }}">
                                @error('sample_Amout', 'createErrors')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- unit --}}
                            <div class="form-group">
                                <label for="unit">Đơn Vị</label>
                                <select class="form-control" name="unit" id="unit">
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->name }}"
                                            {{ old('unit') == $unit->name ? 'selected' : '' }}>
                                            {{ $unit->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('unit', 'createErrors')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {{-- Instrument --}}
                            <div class="form-group">
                                <label for="update_instrument">Thiết Bị</label>
                                <select class="form-control" name="instrument" id="update_instrument">
                                    @foreach ($instruments as $instrument)
                                        <option value="{{ $instrument->name }}"
                                            {{ old('instrument') == $instrument->name ? 'selected' : '' }}>
                                            {{ $instrument->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('instrument', 'createErrors')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- excution_time --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="excution_time">Thời Gian Thực Hiện (h)</label>
                                <input type="number" step="0.25" class="form-control" name="excution_time"
                                    value="{{ old('excution_time') }}">
                                @error('excution_time', 'createErrors')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
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

{{-- Tự động mở modal nếu có lỗi --}}
@if ($errors->updateErrors->any())
    <script>
        $(document).ready(function() {
            $('#updateModal').modal('show');
        });
    </script>
@endif

{{-- Gán mã chỉ tiêu tương ứng với chọn lựa --}}
<script>
    $(document).ready(function() {
        $("#update_testing").on('change', function() {
            var selectedOption = $(this).find("option:selected");
            var testingCode = $("#update_code").val() + "-" + selectedOption.data("update_id");
            $("#update_testing_code").val(testingCode);
        });
    });
</script>
