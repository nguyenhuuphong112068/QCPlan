
<div class="modal fade" id="createModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('pages.Import.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tạo mẫu</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Mã SP</label>
            <input type="text" name="code" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Tên SP</label>
            <input type="text" name="name" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Chỉ tiêu</label>
            <input type="text" name="testing" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Số lượng mẫu</label>
            <input type="text" name="sample_amout" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Đơn vị</label>
            <input type="text" name="unit" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Thời gian thực hiện</label>
            <input type="text" name="excution_time" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Thiết bị</label>
            <input type="text" name="instrument" class="form-control" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Lưu</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
      </form>
    </div>
  </div>
</div>
