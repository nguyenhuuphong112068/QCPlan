<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

<div class="modal fade" id="selectProductModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Danh mục sản phẩm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" style="max-height: 80vh; overflow-x: auto;">
        <div class="card">
          <div class="card-header mt-4">
            {{-- Có thể thêm nội dung tại đây --}}
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped w-100">
                <thead style="position: sticky; top: 60px; background-color: white; z-index: 1020">
                  <tr>
                    <th>STT</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Chỉ tiêu</th>
                    <th>Số lượng mẫu</th>
                    <th>Thời gian thực hiện</th>
                    <th>Thiết bị</th>
                    <th>Chọn</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($category as $data)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $data->code }}</td>
                      <td>{{ $data->name }}</td>
                      <td>{{ $data->testing }}</td>
                      <td>{{ $data->sample_Amout . ' ' . $data->unit }}</td>
                      <td>{{ $data->excution_time }} h</td>
                      <td>{{ $data->instrument }}</td>
                      <td class="text-center align-middle">
                        <button type="button" class="btn btn-success btn-plus"
                          data-id="{{ $data->id }}"
                          data-code="{{ $data->code }}"
                          data-name="{{ $data->name }}"
                          data-testing="{{ $data->testing }}"
                          data-sample_amout="{{ $data->sample_Amout }}"
                          data-unit="{{ $data->unit }}"
                          data-excution_time="{{ $data->excution_time }}"
                          data-instrument="{{ $data->instrument }}">
                          <i class="fas fa-plus"></i>
                        </button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
$(document).ready(function () {
  $('.btn-plus').click(function () {
    const button = $(this);
    const createModal = $('#createModal');
    const selectModal = $('#selectProductModal');

    // Ẩn modal danh sách sản phẩm
    selectModal.modal('hide');

    // Đợi modal cũ đóng xong thì mở modal mới
    selectModal.on('hidden.bs.modal', function () {
      createModal.modal('show');

      // Gán dữ liệu vào modal mới (nếu cần)
      createModal.find('input[name="id"]').val(button.data('id'));
      createModal.find('input[name="code"]').val(button.data('code'));
      createModal.find('input[name="name"]').val(button.data('name'));
      createModal.find('input[name="testing"]').val(button.data('testing'));
      createModal.find('input[name="sample_Amout"]').val(button.data('sample_amout'));
      createModal.find('input[name="unit"]').val(button.data('unit'));
      createModal.find('input[name="excution_time"]').val(button.data('excution_time'));
      createModal.find('input[name="instrument"]').val(button.data('instrument'));
        $('.modal-backdrop').remove();
    });
  });
});
</script>
